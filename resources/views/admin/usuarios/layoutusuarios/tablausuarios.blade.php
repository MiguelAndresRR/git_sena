<div class="container-productos-class">
    <table class="tableFixHead">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Documento</th>
                <th>
                    <button type="submit" class="btn" id='crear-modal'>
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </th>

            </tr>
        </thead>
        <tbody id="container-productos-table">
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id_usuario }}</td>
                    <td>{{ $usuario->user }}</td>
                    <td data-id-categoria="{{ $usuario->id_rol }}">{{ $usuario->rol->nombre_rol }}</td>
                    <td>{{$usuario->nombre_usuario}}</td>
                    <td>{{$usuario->apellido_usuario}}</td>
                    <td>{{$usuario->correo_usuario}}</td>
                    <td>{{$usuario->telefono_usuario}}</td>
                    <td>{{$usuario->documento_usuario}}</td>
                    <td id="botones">
                        <button type="button" class="btn-ver" id="btn-ver1" data-id_usuario="{{ $usuario->id_usuario}}">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button type="button" class="btn-editar" id="btn-editar1" data-id_usuario="{{$usuario->id_usuario}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="button" class="borrar-boton btn btn-danger"
                            data-id_usuario="{{ $usuario->id_usuario}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        @if ($usuario->id_usuario)
                            <form id="formEliminar{{ $usuario->id_usuario }}" method="POST"
                                action="{{ route('admin.usuarios.destroy',$usuario->id_usuario)}}"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="paginacion">
    @include('admin.usuarios.layoutusuarios.paginacion')
</div>
<script src="{{ asset('js/usuarios/borrar.js') }}"></script>
