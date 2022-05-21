<h1>Reporte de Productos</h1>

<ul>
    @foreach ($productos as $producto)
    <li>{{ $producto->producto }}</li>
    @endforeach
</ul>
