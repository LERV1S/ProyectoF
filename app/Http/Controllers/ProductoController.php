<?php

namespace App\Http\Controllers;

use App\Mail\ReporteMd;
use App\Models\Etiqueta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class ProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    //private $reglas = []
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::with('etiquetas')
            ->with('user:id,name,email')
            ->get();
        //$productos = Producto::all();  //Muestra todos los datos
        //$productos = Auth::user()->productos; //Muestra solo productos del usuario logeado
        return view('productos.indexProductos', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', Producto::Class); //Aplicando la restriccion

        $etiquetas = Etiqueta::all();
        return view('productos.formProductos', compact('etiquetas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto' => 'required|min:2|max:25',
            'descripcion' => ['required', 'min:5'],
            'categoria' => 'required',
            'etiqueta_id' => 'required',
        ]);

        $request->merge([
            'user_id' => Auth::id()/*,
            'monto_total' => $request->costo * $request->cantidad,*/
            //03/10 1:00:00
        ]);
        $producto = Producto::create($request->all());
        //$producto->save(); //guarda en bd

        $producto->etiquetas()->attach($request->etiqueta_id);

        return redirect('/producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return view('productos.showProducto', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        /*if (! Gate::allows('administra')){
            abort(403);
        }*/
        //Gate::authorize('administra');



        $etiquetas = Etiqueta::all();
        return view('productos.formProductos', compact('producto', 'etiquetas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {

        $request->validate([
            'producto' => 'required|min:5|max:25',
            'descripcion' => ['required', 'min:5'],
            'categoria' => 'required',
        ]);

        Producto::where('id', $producto->id)
            ->update($request->except(['_token','_method', 'etiqueta_id']));

        $producto->etiquetas()->sync($request->etiqueta_id);
        /*
        $producto->producto = $request->producto;
        $producto->descripcion = $request->descripcion;
        $producto->categoria = $request->categoria;
        $producto->save();
        */
        return redirect('/producto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect('/producto');
    }

    public function enviarReporteMail()
    {
        Mail::to(Auth::user()->email)->send(new ReporteMd);
        return redirect()->back();
    }
}
