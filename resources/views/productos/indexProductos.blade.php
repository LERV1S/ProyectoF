<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos</title>
</head>
<body>
    <h1>Listado de Productos</h1>

    <a href="enviar-reporte">Enviar Correo con Reporte de Productos</a> <br>

    {{-- <form action="POST" action="{{ route('logout') }}">
        @csrf

        <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        this.closest('form').submit();">
            Salir
        </a>
    </form> --}}

    <a href="/producto/create">Crear Nuevo Producto</a>

    <table border="2">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Pedido</th>
            <th>Describe tu encargo</th>
            <th>Categoria</th>
            <th>Etiqueta</th>
            <th>Acciones</th>
        </tr>

        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->user->nombre_correo }}</td>
                <td>{{ $producto->producto }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->categoria }}</td>
                <td>
                    @foreach ($producto->etiquetas as $etiqueta)
                        {{ $etiqueta->etiqueta }} <br>
                    @endforeach
                </td>
                {{-- 03/2200:50:54 --}}
                <td>
                    <a href="/producto/{{ $producto->id }}">Ver Detalle</a>
                    @can('view', $producto)
                        <a href="/producto/{{ $producto->id }}/edit">Editar</a>
                    @endcan
                    <form action="/producto/{{ $producto->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Borrar">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <a href="/bienvenida">Regresar al Inicio</a>
</body>
</html>
