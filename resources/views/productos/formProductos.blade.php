<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FormPedido</title>
</head>
<body>
    <h1>Agregar Pedido</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @isset($producto)
        <form action="/producto/{{ $producto->id }}" method="POST"> {{-- Editar --}}
            @method('PATCH')
    @else
        <form action="/producto" method="POST"> {{-- Crear --}}
    @endisset

        @csrf
        <label for="producto">Nombre del pedido:</label><br>
        <input type="text" name="producto" value="{{ isset($producto) ? $producto->producto : '' }} {{ old('producto') }}">
        <br>

        <br>
        <label for="descripcion">Descripcion del pedido</label><br>
        <textarea name="descripcion" id="descripcion" cols="10" rows="10">
            {{ isset($producto) ? $producto->descripcion : '' }} {{ old('descripcion') }}

        </textarea>
        <br>

        <br>
        <label for="categoria">Categoria</label><br>
        <select name="categoria" id="categoria">
            <option value="Cuadro" {{ isset($producto) && $producto->categoria == 'Cuadro' ? 'selected' : '' }}>Cuadro</option>
            <option value="Dibujo" {{ isset($producto) && $producto->categoria == 'Dibujo' ? 'selected' : '' }}>Dibujo</option>
            <option value="Dibujo Digital" {{ isset($producto) && $producto->categoria == 'Dibujo Digital' ? 'selected' : '' }}>Dibujo Digital</option>
        </select>

        <br>
        <label for="etiqueta_id">Etiqueta</label><br>
        <select name="etiqueta_id">
            @foreach ($etiquetas as $etiqueta)
                <option value="{{ $etiqueta->id }}" {{ isset($producto) && array_search($etiqueta->id, $producto->etiquetas->pluck('id')->toArray()) !== false ? 'selected' : '' }}>{{ $etiqueta->etiqueta }}</option>
            @endforeach
        </select>
        <br>

        <input type="submit" value="Guardar">


    </form>
</body>
</html>
