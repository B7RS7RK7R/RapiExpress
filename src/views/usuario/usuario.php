<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>RapiExpress</title>
    <link rel="icon" href="assets/img/logo-rapi.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php include 'src/views/partels/barras.php'; ?>
</head>

<body>
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Empleados</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php?c=dashboard&a=index">RapiExpress</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Empleados
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pd-30">
                <h4 class="text-blue h4">Gestión de Usuarios</h4>
                <?php include 'src/views/partels/notificaciones.php'; ?>
                <div class="pull-right">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#usuarioModal">
                        <i class="fa fa-user-plus"></i> Agregar Usuario
                    </button>
                </div>
            </div>

            <div class="pb-30">
                <table class="data-table table stripe hover nowrap" id="usuariosTable">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Usuario</th>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Sucursal</th>
                            <th>Cargo</th>
                            <th class="datatable-nosort">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['Cedula_Identidad']) ?></td>
                                <td><?= htmlspecialchars($usuario['Username']) ?></td>
                                <td><?= htmlspecialchars($usuario['Nombres_Usuario'] . ' ' . $usuario['Apellidos_Usuario']) ?></td>
                                <td><?= htmlspecialchars($usuario['Correo_Usuario']) ?></td>
                                <td><?= htmlspecialchars($usuario['Telefono_Usuario']) ?></td>
                                <td><?= htmlspecialchars($usuario['Sucursal_Nombre']) ?></td>
                                <td><?= htmlspecialchars($usuario['Cargo_Nombre']) ?></td>
                                <td>
                                    <div class="table-actions">
                                        <!-- Editar -->
                                        <a href="#"
                                            data-color="#265ed7"
                                            data-toggle="modal"
                                            data-target="#edit-usuario-modal-<?= $usuario['ID_Usuario'] ?>">
                                            <i class="icon-copy dw dw-edit2"></i>
                                        </a>

                                        <!-- Eliminar -->
                                        <?php if ($usuario['Username'] !== $_SESSION['usuario']): ?>
                                            <a href="#"
                                                data-color="#e95959"
                                                data-toggle="modal"
                                                data-target="#delete-usuario-modal"
                                                onclick="setDeleteUsuarioId(<?= $usuario['ID_Usuario'] ?>)">
                                                <i class="icon-copy dw dw-delete-3"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal para agregar usuario -->
        <div class="modal fade" id="usuarioModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="formRegistrarUsuario" method="POST" action="index.php?c=usuario&a=registrar">
                        <div class="modal-header">
                            <h5 class="modal-title">Registrar Nuevo Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Cedula_Identidad">Cédula de Identidad</label>
                                        <input type="text" pattern="\d{6,23}" title="Debe contener entre 6 y 23 dígitos" class="form-control" name="Cedula_Identidad" required maxlength="23">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Username">Nombre de Usuario</label>
                                        <input type="text" pattern="^[a-zA-Z0-9]{4,}$" title="Mínimo 4 caracteres, solo letras y números" class="form-control" name="Username" required maxlength="50">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Nombres_Usuario">Nombres</label>
                                        <input type="text" pattern="^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$" title="Solo letras" class="form-control" name="Nombres_Usuario" required maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Apellidos_Usuario">Apellidos</label>
                                        <input type="text" pattern="^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$" title="Solo letras" class="form-control" name="Apellidos_Usuario" required maxlength="20">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Correo_Usuario">Correo Electrónico</label>
                                        <input type="email" class="form-control" name="Correo_Usuario" required maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Telefono_Usuario">Teléfono</label>
                                        <input type="tel" class="form-control" name="Telefono_Usuario" maxlength="20" pattern="\d{7,15}" title="Debe contener entre 7 y 15 dígitos numéricos">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Direccion_Usuario">Dirección</label>
                                        <input type="text" class="form-control" name="Direccion_Usuario">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ID_Sucursal">Sucursal</label>
                                        <select class="form-control" name="ID_Sucursal" required>
                                            <option value="">Seleccione sucursal</option>
                                            <?php foreach ($sucursales as $sucursal): ?>
                                                <option value="<?= $sucursal['ID_Sucursal'] ?>">
                                                    <?= htmlspecialchars($sucursal['Sucursal_Nombre']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ID_Cargo">Cargo</label>
                                        <select class="form-control" name="ID_Cargo" required>
                                            <option value="">Seleccione un cargo</option>
                                            <?php foreach ($cargos as $cargo): ?>
                                                <option value="<?= $cargo['ID_Cargo'] ?>">
                                                    <?= htmlspecialchars($cargo['Cargo_Nombre']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Password">Contraseña</label>
                                        <div class="input-group custom mb-4">
                                            <input name="Password" type="password" class="form-control form-control-lg"
                                                placeholder="Contraseña"
                                                pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{6,}$"
                                                title="Mínimo 6 caracteres, al menos una letra y un número" required>
                                            <div class="input-group-append custom toggle-password" style="cursor: pointer;">
                                                <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para ver detalles -->
        <?php foreach ($usuarios as $usuario): ?>
            <div class="modal fade" id="view-usuario-modal-<?= $usuario['ID_Usuario'] ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detalles del Usuario</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Documento</label>
                                        <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['Cedula_Identidad']) ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['Username']) ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombres</label>
                                        <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['Nombres_Usuario']) ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Apellidos</label>
                                        <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['Apellidos_Usuario']) ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Correo Electrónico</label>
                                        <input type="email" class="form-control" value="<?= htmlspecialchars($usuario['Correo_Usuario']) ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['Telefono_Usuario']) ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sucursal</label>
                                        <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['Sucursal_Nombre'] ?? $usuario['ID_Sucursal']) ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['Cargo_Nombre'] ?? $usuario['ID_Cargo']) ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha de Registro</label>
                                        <input type="text" class="form-control" value="<?= date('d/m/Y', strtotime($usuario['Fecha_Registro'])) ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Modal para editar -->
        <?php foreach ($usuarios as $usuario): ?>
            <div class="modal fade" id="edit-usuario-modal-<?= $usuario['ID_Usuario'] ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form id="formEditarUsuario-<?= $usuario['ID_Usuario'] ?>" method="POST" action="index.php?c=usuario&a=editar">
                            <div class="modal-header">
                                <h4 class="modal-title">Editar Usuario</h4>
                                <button type="button" class="close" data-dismiss="modal">×</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="ID_Usuario" value="<?= $usuario['ID_Usuario'] ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Cédula de Identidad</label>
                                        <input type="text" class="form-control" name="Cedula_Identidad"
                                            value="<?= htmlspecialchars($usuario['Cedula_Identidad']) ?>"
                                            pattern="^\d{6,23}$"
                                            title="La cédula debe contener entre 6 y 23 dígitos."
                                            required maxlength="23">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nombre de Usuario</label>
                                        <input type="text" class="form-control" name="Username"
                                            value="<?= htmlspecialchars($usuario['Username']) ?>"
                                            pattern="^[a-zA-Z0-9_]{3,20}$"
                                            title="El nombre de usuario debe tener entre 3 y 20 caracteres y solo puede contener letras, números y guiones bajos."
                                            required maxlength="20">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nombres</label>
                                        <input type="text" class="form-control" name="Nombres_Usuario"
                                            value="<?= htmlspecialchars($usuario['Nombres_Usuario']) ?>"
                                            pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$"
                                            title="Los nombres solo pueden contener letras y espacios."
                                            required maxlength="50">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Apellidos</label>
                                        <input type="text" class="form-control" name="Apellidos_Usuario"
                                            value="<?= htmlspecialchars($usuario['Apellidos_Usuario']) ?>"
                                            pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$"
                                            title="Los apellidos solo pueden contener letras y espacios."
                                            required maxlength="20">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Correo Electrónico</label>
                                        <input type="email" class="form-control" name="Correo_Usuario"
                                            value="<?= htmlspecialchars($usuario['Correo_Usuario']) ?>"
                                            title="Debe ingresar un correo electrónico válido."
                                            required maxlength="100">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Teléfono</label>
                                        <input type="tel" class="form-control" name="Telefono_Usuario"
                                            value="<?= htmlspecialchars($usuario['Telefono_Usuario']) ?>"
                                            pattern="^\d{7,15}$"
                                            title="El número de teléfono debe contener solo dígitos (7 a 15 caracteres)."
                                            required maxlength="20">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Sucursal</label>
                                        <select class="form-control" name="ID_Sucursal" required>
                                            <option value="">Seleccione una sucursal</option>
                                            <?php foreach ($sucursales as $sucursal): ?>
                                                <option value="<?= $sucursal['ID_Sucursal'] ?>"
                                                    <?= $sucursal['Sucursal_Nombre'] == $usuario['Sucursal_Nombre'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($sucursal['Sucursal_Nombre']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Cargo</label>
                                        <select class="form-control" name="ID_Cargo" required>
                                            <option value="">Seleccione un cargo</option>
                                            <?php foreach ($cargos as $cargo): ?>
                                                <option value="<?= $cargo['ID_Cargo'] ?>"
                                                    <?= $cargo['Cargo_Nombre'] == $usuario['Cargo_Nombre'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($cargo['Cargo_Nombre']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control" name="Direccion_Usuario"
                                            value="<?= htmlspecialchars($usuario['Direccion_Usuario']) ?>"
                                            maxlength="255" pattern="^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ.,\-()_]{1,100}$"
                                            title="Solo letras, números y caracteres (,.-()_) son permitidos. Máximo 100 caracteres.">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Modal para Eliminar -->
        <div class="modal fade" id="delete-usuario-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-4">
                    <div class="modal-body">
                        <i class="bi bi-exclamation-triangle-fill text-danger mb-3" style="font-size: 3rem;"></i>
                        <h4 class="mb-20 font-weight-bold text-danger">¿Eliminar Usuario?</h4>
                        <p class="mb-30 text-muted">Esta acción no se puede deshacer. <br>¿Está seguro que desea eliminar este usuario?</p>

                        <form id="formEliminarUsuario" method="POST" action="index.php?c=usuario&a=eliminar">
                            <input type="hidden" name="ID_Usuario" id="delete_usuario_id">
                            <div class="row justify-content-center gap-2" style="max-width: 200px; margin: 0 auto;">
                                <div class="col-6 px-1">
                                    <button type="button" class="btn btn-secondary btn-lg btn-block border-radius-100" data-dismiss="modal">
                                        <i class="fa fa-times"></i> No
                                    </button>
                                </div>
                                <div class="col-6 px-1">
                                    <button type="submit" class="btn btn-danger btn-lg btn-block border-radius-100">
                                        <i class="fa fa-check"></i> Sí
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Scripts AJAX -->
    <script>
        function setDeleteUsuarioId(id) {
            $('#delete_usuario_id').val(id);
        }

        $(document).ready(function() {

            // ✅ Registrar Usuario
            $('#formRegistrarUsuario').on('submit', function(e) {
                e.preventDefault();
                const $form = $(this);
                const datos = $form.serialize();
                const modal = $('#usuarioModal');

                $.ajax({
                    url: 'index.php?c=usuario&a=registrar',
                    type: 'POST',
                    data: datos,
                    dataType: 'json',
                    success: function(respuesta) {
                        if (respuesta.estado === 'success') {
                            $form[0].reset();
                            modal.modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: respuesta.mensaje,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            recargarTablaUsuarios();
                        } else {
                            Swal.fire('Error', respuesta.mensaje, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo registrar el usuario.', 'error');
                    }
                });
            });

            // ✅ Editar Usuario
            // ✅ Editar Usuario (CORREGIDO)
            $(document).on('submit', 'form[id^="formEditarUsuario-"]', function(e) {
                e.preventDefault();
                const $form = $(this);
                const datos = $form.serialize();
                const modal = $form.closest('.modal');

                $.ajax({
                    url: 'index.php?c=usuario&a=editar',
                    type: 'POST',
                    data: datos,
                    dataType: 'json',
                    success: function(respuesta) {
                        if (respuesta.estado === 'success') {
                            // Oculta el modal correctamente
                            modal.modal('hide');

                            // ✅ Limpieza forzada del overlay
                            setTimeout(() => {
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                            }, 300);

                            Swal.fire({
                                icon: 'success',
                                title: 'Actualizado',
                                text: respuesta.mensaje,
                                timer: 2000,
                                showConfirmButton: false
                            });

                            recargarTablaUsuarios();
                        } else {
                            Swal.fire('Error', respuesta.mensaje, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo actualizar el usuario.', 'error');
                    }
                });
            });


            // ✅ Eliminar Usuario
            $('#formEliminarUsuario').on('submit', function(e) {
                e.preventDefault();
                const datos = $(this).serialize();
                const modal = $('#delete-usuario-modal');

                $.ajax({
                    url: 'index.php?c=usuario&a=eliminar',
                    type: 'POST',
                    data: datos,
                    dataType: 'json',
                    success: function(respuesta) {
                        if (respuesta.estado === 'success') {
                            modal.modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: respuesta.mensaje,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            recargarTablaUsuarios();
                        } else {
                            Swal.fire('Error', respuesta.mensaje, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo eliminar el usuario.', 'error');
                    }
                });
            });

            // ✅ Toggle password (único y funcional)
            $(document).on('click', '.toggle-password', function() {
                const input = $(this).siblings('input');
                const icon = $(this).find('i');
                const isPassword = input.attr('type') === 'password';
                input.attr('type', isPassword ? 'text' : 'password');
                icon.toggleClass('fa-eye fa-eye-slash');
            });

            // ✅ Recargar tabla sin recargar la página
            function recargarTablaUsuarios() {
                $.ajax({
                    url: 'index.php?c=usuario&a=index',
                    type: 'GET',
                    success: function(html) {
                        const nuevoTbody = $(html).find('#usuariosTable tbody').html();
                        $('#usuariosTable tbody').html(nuevoTbody);

                        // Actualizar modales
                        $('.modal.fade[id^="edit-usuario-modal"], .modal.fade[id^="view-usuario-modal"]').remove();
                        const nuevosModales = $(html).find('.modal.fade[id^="edit-usuario-modal"], .modal.fade[id^="view-usuario-modal"]');
                        $('body').append(nuevosModales);
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo recargar la lista de usuarios.', 'error');
                    }
                });
            }

            // ✅ Validación en tiempo real
            $(document).on('input', 'input[name="Nombres_Usuario"], input[name="Apellidos_Usuario"]', function() {
                const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
                $(this).toggleClass('is-invalid', !regex.test($(this).val()));
                $(this).toggleClass('is-valid', regex.test($(this).val()));
            });

            // ✅ Limpieza de backdrop al cerrar cualquier modal
            $(document).on('hidden.bs.modal', '.modal', function() {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });

        });
    </script>


</body>

</html>