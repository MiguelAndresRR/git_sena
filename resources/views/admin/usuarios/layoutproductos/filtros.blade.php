<form id="filtro-form" method="GET">
    @csrf
    <div class="filtros">
        <select name="categoria" id="categoria" class="form-control">
            <option value="">Todas las categorias</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id_categoria_producto }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        <select name="unidad" id="unidad" class="form-control">
            <option value="">Todas las unidades</option>
            @foreach ($unidades as $unidad)
                <option value="{{ $unidad->id_unidad_peso_producto }}">{{ $unidad->unidad_peso }}</option>
            @endforeach
        </select>
        <select name="entries" id="entries" class="form-control">
            <option disabled selected>Selecciona datos a mostrar</option>
            <option value="15" {{ request('PorPagina') == 15 ? 'selected' : '' }}>15</option>
            <option value="20" {{ request('PorPagina') == 20 ? 'selected' : '' }}>20</option>
            <option value="25" {{ request('PorPagina') == 25 ? 'selected' : '' }}>25</option>
            <option value="30" {{ request('PorPagina') == 30 ? 'selected' : '' }}>30</option>
        </select>
        <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar producto...">
        <button type="button" id="limpiar-filtros" class="form-control"><i class="fa-solid fa-eraser"
                style="color: #ffffff;"></i></button>
    </div>
</form>
<script src="{{ asset('js/productos/filtrar.js')}}"></script>
