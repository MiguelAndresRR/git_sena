<div class="container-modal-crear" >
    <div class="registrar-usuario-container">
        <h2>Registrar usuario</h2>
        <form action="{{ route('admin.usuarios.store') }}" method="POST" enctype="multipart/form-data"
            id="formularioUsuarios">
            @csrf
            <div class="contenedor-doble">
                <div class="form-group datosPersonales">
                    <h2>Datos Personales</h2>
                    <label for="nombre_usuario" class="form-label"><i class="fa-solid fa-user"></i> Nombre</label>
                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario"
                        placeholder="Nombre" maxlength="50" required>

                    <label for="apellido_usuario" class="form-label"><i class="fa-solid fa-user"></i> Apellido</label>
                    <input type="text" class="form-control" id="apellido_usuario" name="apellido_usuario"
                        placeholder="Apellido" maxlength="50" required>
                    <label for="documento_usuario" class="form-label"><i class="fa-solid fa-id-card"></i>
                        Documento</label>
                    <input type="number" class="form-control" id="documento_usuario" name="documento_usuario"
                        placeholder="Número de documento" required>

                    <label for="telefono_usuario" class="form-label"><i class="fa-solid fa-phone"></i> Teléfono</label>
                    <input type="tel" class="form-control" id="telefono_usuario" name="telefono_usuario"
                        placeholder="Teléfono" maxlength="10" pattern="[0-9]{7,10}" required>

                    <label for="correo_usuario" class="form-label"><i class="fa-solid fa-envelope"></i> Correo</label>
                    <input type="email" class="form-control" id="correo_usuario" name="correo_usuario"
                        placeholder="Correo electrónico" maxlength="50" required>
                </div>
                <div class="form-group datosAcceso">
                    <h2>Datos de Acceso</h2>
                    <label for="user" class="form-label"><i class="fa-solid fa-user"></i> Usuario</label>
                    <input type="text" class="form-control" id="user" name="user" placeholder="Usuario"
                        maxlength="50" required>
                    <label for="password" class="form-label"><i class="fa-solid fa-lock"></i> Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña"
                        required minlength="8" maxlength="60"
                        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                        title="Debe contener al menos una letra mayúscula, un carácter especial y mínimo 8 caracteres.">
                    <label for="id_rol" class="form-label"><i class="fa-solid fa-user-tag"></i> Rol</label>
                    <select name="id_rol" id="id_rol" class="form-control" required>
                        <option value="" disabled {{ old('id_rol') ? '' : 'selected' }}>
                            Selecciona rol
                        </option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id_rol }}" {{ old('id_rol') == $rol->id_rol ? 'selected' : '' }}>
                                {{ $rol->nombre_rol }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Crear</button>
        </form>
        <button type="close" class="btn btn-secondary" id="ocultar-modal-crear1">Cancelar</button>
    </div>
</div>

<script src="{{ asset('js/usuarios/crear.js') }}"></script>
