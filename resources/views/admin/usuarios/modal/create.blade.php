<div class="container-modal-crear">
    <div class="registrar-producto-container">
        <h2>Registrar producto</h2>
        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data"
            id="formularioProducto" class="necesita-validacion">
            @csrf
            <label for="nombre_producto" class="form-label"><i class="fa-solid fa-cubes"></i>Producto</label>
            <input type="text" class="form-control" id="nombre_producto" name="nombre_producto"
                placeholder="Nombre del producto" minlength="20" required>


            <label for="precio_producto" class="form-label"><i class="fa-sharp fa-solid fa-coins"
                    style="color: #FFD43B;"></i>Precio del
                producto</label>
            <input type="number" class="form-control" id="precio_producto"
                name="precio_producto"placeholder="Precio del producto" max="10" required>

            <label for="id_categoria_producto" class="form-label"><i class="fa-sharp fa-solid fa-layer-group"
                    style="color: #ff0000;"></i>Categoría</label>
            <select name="id_categoria_producto" id="id_categoria_producto" class="form-control" required>
                <option value="" disabled {{ old('id_categoria_producto') ? '' : 'selected' }}>
                    Selecciona categoría
                </option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria_producto }}"
                        {{ old('id_categoria_producto') == $categoria->id_categoria_producto ? 'selected' : '' }}>
                        {{ $categoria->categoria }}
                    </option>
                @endforeach
            </select>
            <br>

            <label for="id_unidad_peso_producto" class="form-label"><i class="fa-solid fa-scale-balanced"
                    style="color: #04fb56;"></i>Unidad de medida</label>
            <select name="id_unidad_peso_producto" id="id_unidad_peso_producto" class="form-control" required>
                <option value="" disabled {{ old('id_unidad_peso_producto') ? '' : 'selected' }}>
                    Selecciona unidad de medida</option>
                @foreach ($unidades as $unidad)
                    <option value="{{ $unidad->id_unidad_peso_producto }}"
                        {{ old('id_unidad_peso_producto') == $unidad->id_unidad_peso_producto ? 'selected' : '' }}>
                        {{ $unidad->unidad_peso }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Crear</button>
        </form>
        <button type="submit" class="btn" id='ocultar-modal-crear'>Cancelar</button>
    </div>
</div>
<script src="{{ asset('js/productos/crear.js') }}"></script>
