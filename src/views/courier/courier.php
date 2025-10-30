<?php
use RapiExpress\Helpers\Lang;
?>
<!DOCTYPE html>
<html lang="<?= Lang::current() ?>">
<head>
    <meta charset="utf-8" />
    <title>RapiExpress - <?= Lang::get('couriers_title') ?></title>
    <link rel="icon" href="assets/img/logo-rapi.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Bootstrap CSS y DataTables -->
    
</head>
<body>
<?php include 'src/views/partels/barras.php'; ?>

<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <!-- Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4><?= Lang::get('couriers_title') ?></h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php?c=dashboard&a=index"><?= Lang::get('breadcrumb_home') ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Lang::get('couriers_title') ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="card-box mb-30">
            <div class="pd-30 d-flex justify-content-between align-items-center">
                <h4 class="text-blue h4"><?= Lang::get('couriers_list_title') ?></h4>
                <?php include 'src/views/partels/notificaciones.php'; ?>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#courierModal">
                    <i class="fa fa-plus"></i> <?= Lang::get('add_courier') ?>
                </button>
            </div>

            <div class="pb-30">
                <table class="data-table table stripe hover nowrap" id="courierTable">
                    <thead>
                        <tr>
                            <th><?= Lang::get('id') ?></th>
                            <th><?= Lang::get('rif') ?></th>
                            <th><?= Lang::get('name') ?></th>
                            <th><?= Lang::get('address') ?></th>
                            <th><?= Lang::get('phone') ?></th>
                            <th><?= Lang::get('email') ?></th>
                            <th class="datatable-nosort"><?= Lang::get('actions') ?></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- =================== MODAL REGISTRAR COURIER =================== -->
        <div class="modal fade" id="courierModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <form id="formRegistrarCourier" class="modal-content needs-validation" novalidate>
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-plus-circle"></i> <?= Lang::get('register_courier') ?>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body row">

                        <div class="col-md-6 mb-3">
                            <label>RIF <span class="text-danger">*</span></label>
                            <input type="text" name="RIF_Courier" class="form-control" required maxlength="20"
                                   placeholder="Ej: J-12345678-9">
                            <div class="valid-feedback">✓ Campo válido</div>
                            <div class="invalid-feedback">Formato: J-12345678-9</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="Courier_Nombre" class="form-control" required maxlength="50"
                                   placeholder="Nombre del courier">
                            <div class="valid-feedback">✓ Campo válido</div>
                            <div class="invalid-feedback">Solo letras y espacios (3-50 caracteres)</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Dirección <span class="text-danger">*</span></label>
                            <input type="text" name="Courier_Direccion" class="form-control" required maxlength="150"
                                   placeholder="Dirección completa">
                            <div class="valid-feedback">✓ Campo válido</div>
                            <div class="invalid-feedback">Dirección inválida (5-150 caracteres)</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Teléfono <span class="text-danger">*</span></label>
                            <input type="text" name="Courier_Telefono" class="form-control" required maxlength="20"
                                   placeholder="04121234567">
                            <div class="valid-feedback">✓ Campo válido</div>
                            <div class="invalid-feedback">Teléfono inválido (7-15 dígitos)</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Correo Electrónico <span class="text-danger">*</span></label>
                            <input type="email" name="Courier_Correo" class="form-control" required maxlength="100"
                                   placeholder="correo@ejemplo.com">
                            <div class="valid-feedback">✓ Campo válido</div>
                            <div class="invalid-feedback">Correo electrónico inválido</div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times"></i> <?= Lang::get('cancel') ?>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> <?= Lang::get('register') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- =================== MODAL EDITAR COURIER =================== -->
        <div class="modal fade" id="editCourierModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <form id="formEditarCourier" class="modal-content needs-validation" novalidate>
                    <input type="hidden" name="ID_Courier" id="edit_courier_id">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-edit"></i> <?= Lang::get('edit_courier') ?>
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body row">

                        <div class="col-md-6 mb-3">
                            <label>RIF <span class="text-danger">*</span></label>
                            <input type="text" name="RIF_Courier" id="edit_rif" class="form-control" 
                                   required maxlength="20" data-original="">
                            <div class="valid-feedback">✓ Campo válido</div>
                            <div class="invalid-feedback">Formato: J-12345678-9</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="Courier_Nombre" id="edit_nombre" class="form-control" 
                                   required maxlength="50" data-original="">
                            <div class="valid-feedback">✓ Campo válido</div>
                            <div class="invalid-feedback">Solo letras y espacios (3-50 caracteres)</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Dirección <span class="text-danger">*</span></label>
                            <input type="text" name="Courier_Direccion" id="edit_direccion" class="form-control" 
                                   required maxlength="150" data-original="">
                            <div class="valid-feedback">✓ Campo válido</div>
                            <div class="invalid-feedback">Dirección inválida (5-150 caracteres)</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Teléfono <span class="text-danger">*</span></label>
                            <input type="text" name="Courier_Telefono" id="edit_telefono" class="form-control" 
                                   required maxlength="20" data-original="">
                            <div class="valid-feedback">✓ Campo válido</div>
                            <div class="invalid-feedback">Teléfono inválido (7-15 dígitos)</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Correo Electrónico <span class="text-danger">*</span></label>
                            <input type="email" name="Courier_Correo" id="edit_correo" class="form-control" 
                                   required maxlength="100" data-original="">
                            <div class="valid-feedback">✓ Campo válido</div>
                            <div class="invalid-feedback">Correo electrónico inválido</div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times"></i> <?= Lang::get('cancel') ?>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> <?= Lang::get('save_changes') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- =================== MODAL ELIMINAR COURIER =================== -->
        <div class="modal fade" id="deleteCourierModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-4">
                    <div class="modal-body">
                        <i class="fa fa-exclamation-triangle text-danger mb-3" style="font-size: 3rem;"></i>
                        <h4 class="mb-20 font-weight-bold text-danger"><?= Lang::get('delete_courier_title') ?></h4>
                        <p class="mb-30 text-muted"><?= Lang::get('delete_courier_warning') ?></p>
                        <form id="formEliminarCourier">
                            <input type="hidden" name="ID_Courier" id="delete_courier_id">
                            <div class="row justify-content-center">
                                <div class="col-6 px-1">
                                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">
                                        <i class="fa fa-times"></i> <?= Lang::get('no') ?>
                                    </button>
                                </div>
                                <div class="col-6 px-1">
                                    <button type="submit" class="btn btn-danger btn-block">
                                        <i class="fa fa-trash"></i> <?= Lang::get('yes') ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function() {

    // =================== EXPRESIONES REGULARES (COINCIDEN CON PHP) ===================
    const REGEX = {
        RIF: /^[JGVEP]{1}-\d{8}-\d{1}$/,
        NOMBRE: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,50}$/,
        DIRECCION: /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ.,\-()_#]{5,150}$/,
        TELEFONO: /^(\+?\d{1,3})?\d{7,15}$/,
        EMAIL: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    };

    const MENSAJES = {
        RIF_Courier: 'Formato: J-12345678-9',
        Courier_Nombre: 'Solo letras y espacios (3-50 caracteres)',
        Courier_Direccion: 'Dirección inválida (5-150 caracteres)',
        Courier_Telefono: 'Teléfono inválido (7-15 dígitos)',
        Courier_Correo: 'Correo electrónico inválido'
    };

    // =================== VALIDACIÓN EN TIEMPO REAL ===================
    function validarCampo($input) {
        const nombre = $input.attr('name');
        const valor = $input.val().trim();
        let valido = false;

        switch(nombre) {
            case 'RIF_Courier':
                valido = REGEX.RIF.test(valor);
                break;
            case 'Courier_Nombre':
                valido = REGEX.NOMBRE.test(valor);
                break;
            case 'Courier_Direccion':
                valido = REGEX.DIRECCION.test(valor);
                break;
            case 'Courier_Telefono':
                valido = REGEX.TELEFONO.test(valor);
                break;
            case 'Courier_Correo':
                valido = REGEX.EMAIL.test(valor);
                break;
        }

        if (valor === '') {
            $input.removeClass('is-valid is-invalid');
        } else if (valido) {
            $input.removeClass('is-invalid').addClass('is-valid');
        } else {
            $input.removeClass('is-valid').addClass('is-invalid');
            if (MENSAJES[nombre]) {
                $input.siblings('.invalid-feedback').text(MENSAJES[nombre]);
            }
        }

        return valido;
    }

    // Validación en tiempo real
    $(document).on('input blur', '.needs-validation input', function() {
        validarCampo($(this));
    });

    // Validar formulario completo
    function validarFormulario($form) {
        let valido = true;
        $form.find('input[required]').each(function() {
            if (!validarCampo($(this))) {
                valido = false;
            }
        });
        return valido;
    }

    // =================== CARGAR TABLA ===================
    cargarCouriers();

    function cargarCouriers() {
        $.ajax({
            url: 'index.php?c=courier&a=index&ajax=1',
            type: 'GET',
            dataType: 'json',
            success: function(couriers) {
                let html = '';
                
                if (couriers.length === 0) {
                    html = `<tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fa fa-inbox fa-3x mb-3 d-block"></i>
                            <h5>No hay couriers registrados</h5>
                            <p class="mb-0">Comience agregando un nuevo courier</p>
                        </td>
                    </tr>`;
                } else {
                    couriers.forEach(c => {
                        html += `<tr>
                            <td><strong>#${c.ID_Courier}</strong></td>
                            <td>${c.RIF_Courier}</td>
                            <td>${c.Courier_Nombre}</td>
                            <td><small>${c.Courier_Direccion}</small></td>
                            <td>${c.Courier_Telefono}</td>
                            <td><small>${c.Courier_Correo}</small></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" 
                                       href="#" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item btn-edit" href="#" data-id="${c.ID_Courier}">
                                            <i class="dw dw-edit2"></i> Editar
                                        </a>
                                        <a class="dropdown-item btn-delete" href="#" data-id="${c.ID_Courier}">
                                            <i class="dw dw-delete-3"></i> Eliminar
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
                    });
                }
                
                $('#courierTable tbody').html(html);
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo cargar la lista de couriers.'
                });
            }
        });
    }

    // =================== REGISTRAR COURIER ===================
    $('#formRegistrarCourier').on('submit', function(e) {
        e.preventDefault();
        const $form = $(this);

        if (!validarFormulario($form)) {
            Swal.fire({
                icon: 'warning',
                title: 'Error de validación',
                text: 'Por favor corrija los campos marcados en rojo.'
            });
            return;
        }

        const $btn = $form.find('button[type="submit"]');
        const textoBtn = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Procesando...');

        $.ajax({
            url: 'index.php?c=courier&a=registrar',
            type: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.estado === 'success') {
                    $('#courierModal').modal('hide');
                    $form[0].reset();
                    $form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: res.mensaje,
                        timer: 2500,
                        showConfirmButton: false
                    });
                    cargarCouriers();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.mensaje
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error del servidor',
                    text: 'No se pudo conectar con el servidor.'
                });
            },
            complete: function() {
                $btn.prop('disabled', false).html(textoBtn);
            }
        });
    });

    // =================== ABRIR MODAL EDITAR ===================
    $(document).on('click', '.btn-edit', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        
        Swal.fire({
            title: 'Cargando...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.getJSON(`index.php?c=courier&a=obtenerCourier&id=${id}`, function(c) {
            Swal.close();
            
            if (!c || c.estado === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: c.mensaje || 'No se pudo cargar el courier'
                });
                return;
            }

            // Llenar formulario
            $('#edit_courier_id').val(c.ID_Courier);
            $('#edit_rif').val(c.RIF_Courier).attr('data-original', c.RIF_Courier);
            $('#edit_nombre').val(c.Courier_Nombre).attr('data-original', c.Courier_Nombre);
            $('#edit_direccion').val(c.Courier_Direccion).attr('data-original', c.Courier_Direccion);
            $('#edit_telefono').val(c.Courier_Telefono).attr('data-original', c.Courier_Telefono);
            $('#edit_correo').val(c.Courier_Correo).attr('data-original', c.Courier_Correo);

            // Limpiar validaciones previas
            $('#formEditarCourier').find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
            
            $('#editCourierModal').modal('show');
        }).fail(function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo cargar los datos'
            });
        });
    });

    // =================== EDITAR COURIER ===================
    $('#formEditarCourier').on('submit', function(e) {
        e.preventDefault();
        const $form = $(this);

        if (!validarFormulario($form)) {
            Swal.fire({
                icon: 'warning',
                title: 'Error de validación',
                text: 'Por favor corrija los campos marcados en rojo.'
            });
            return;
        }

        // Detectar cambios
        let hayCambios = false;
        let camposModificados = [];
        
        $form.find('input[data-original]').each(function() {
            const actual = $(this).val().trim();
            const original = $(this).attr('data-original').trim();
            const campo = $(this).prev('label').text().replace(' *', '');
            
            if (actual !== original) {
                hayCambios = true;
                camposModificados.push(campo);
            }
        });

        if (!hayCambios) {
            Swal.fire({
                icon: 'info',
                title: 'Sin cambios detectados',
                html: '<p>No se realizaron modificaciones en ningún campo.</p><p class="text-muted mb-0"><small>Los datos permanecen igual que antes.</small></p>',
                confirmButtonText: 'Entendido'
            });
            return;
        }

        // Confirmar cambios
        const lista = camposModificados.map(c => `• ${c}`).join('<br>');
        
        Swal.fire({
            icon: 'question',
            title: '¿Guardar cambios?',
            html: `<p>Se modificaron los siguientes campos:</p><div class="text-left" style="display: inline-block;">${lista}</div>`,
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-check"></i> Sí, guardar',
            cancelButtonText: '<i class="fa fa-times"></i> Cancelar',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                guardarEdicion($form);
            }
        });
    });

    function guardarEdicion($form) {
        const $btn = $form.find('button[type="submit"]');
        const textoBtn = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Guardando...');

        $.ajax({
            url: 'index.php?c=courier&a=editar',
            type: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.estado === 'success') {
                    $('#editCourierModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: '¡Actualizado!',
                        text: res.mensaje,
                        timer: 2500,
                        showConfirmButton: false
                    });
                    cargarCouriers();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.mensaje
                    });
                    $btn.prop('disabled', false).html(textoBtn);
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error del servidor',
                    text: 'No se pudo actualizar el courier.'
                });
                $btn.prop('disabled', false).html(textoBtn);
            }
        });
    }

    // =================== ABRIR MODAL ELIMINAR ===================
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        $('#delete_courier_id').val(id);
        $('#deleteCourierModal').modal('show');
    });

    // =================== ELIMINAR COURIER ===================
    $('#formEliminarCourier').on('submit', function(e) {
        e.preventDefault();
        const $form = $(this);
        const $btn = $form.find('button[type="submit"]');
        const textoBtn = $btn.html();
        
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Eliminando...');

        $.ajax({
            url: 'index.php?c=courier&a=eliminar',
            type: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function(res) {
                $('#deleteCourierModal').modal('hide');
                
                if (res.estado === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Eliminado!',
                        text: res.mensaje,
                        timer: 2500,
                        showConfirmButton: false
                    });
                    cargarCouriers();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo eliminar',
                        text: res.mensaje
                    });
                }
            },
            error: function() {
                $('#deleteCourierModal').modal('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'Error del servidor',
                    text: 'No se pudo eliminar el courier.'
                });
            },
            complete: function() {
                $btn.prop('disabled', false).html(textoBtn);
            }
        });
    });

    // =================== LIMPIAR MODALES AL CERRARSE ===================
    $('#courierModal').on('hidden.bs.modal', function() {
        const $form = $(this).find('form');
        $form[0].reset();
        $form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
    });

    $('#editCourierModal').on('hidden.bs.modal', function() {
        const $form = $(this).find('form');
        $form[0].reset();
        $form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
        $form.find('[data-original]').attr('data-original', '');
    });

});
</script>
</body>
</html>