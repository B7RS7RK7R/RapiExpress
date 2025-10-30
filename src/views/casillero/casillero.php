<?php

use RapiExpress\Helpers\Lang;
?>
<!DOCTYPE html>
<html lang="<?= Lang::current() ?>">

<head>
    <meta charset="utf-8" />
    <title>RapiExpress - <?= Lang::get('casilleros_title') ?></title>
    <link rel="icon" href="assets/img/logo-rapi.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            <h4><?= Lang::get('casilleros_title') ?></h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.php?c=dashboard&a=index"><?= Lang::get('breadcrumb_home') ?></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><?= Lang::get('casilleros_title') ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Card principal -->
            <div class="card-box mb-30">
                <div class="pd-30 d-flex justify-content-between align-items-center">
                    <h4 class="text-blue h4"><?= Lang::get('casilleros_list_title') ?></h4>
                    <?php include 'src/views/partels/notificaciones.php'; ?>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#casilleroModal">
                        <i class="fa fa-plus"></i> <?= Lang::get('add_casillero') ?>
                    </button>
                </div>

                <div class="pb-30">
                    <table class="data-table table stripe hover nowrap" id="casillerosTable">
                        <thead>
                            <tr>
                                <th><?= Lang::get('name') ?></th>
                                <th><?= Lang::get('address') ?></th>
                                <th class="datatable-nosort"><?= Lang::get('actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($casilleros as $casillero): ?>
                                <tr>
                                    <td><?= htmlspecialchars($casillero['Casillero_Nombre']) ?></td>
                                    <td><?= htmlspecialchars($casillero['Direccion']) ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <!-- Botón Editar -->
                                            <a href="#"
                                                data-color="#265ed7"
                                                data-toggle="modal"
                                                data-target="#edit-casillero-modal-<?= $casillero['ID_Casillero'] ?>">
                                                <i class="icon-copy dw dw-edit2"></i>
                                            </a>

                                            <!-- Botón Eliminar -->
                                            <a href="#"
                                                data-color="#e95959"
                                                data-toggle="modal"
                                                data-target="#delete-casillero-modal"
                                                onclick="setDeleteId(<?= $casillero['ID_Casillero'] ?>)">
                                                <i class="icon-copy dw dw-delete-3"></i>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Registrar Casillero -->
            <div class="modal fade" id="casilleroModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <form id="formRegistrarCasillero" class="modal-content" method="POST" action="index.php?c=casillero&a=registrar">
                        <div class="modal-header">
                            <h5 class="modal-title"><?= Lang::get('register_casillero_modal_title') ?></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-6 form-group">
                                <label><?= Lang::get('name') ?> <span class="text-danger">*</span></label>
                                <input type="text"
                                    name="Casillero_Nombre"
                                    class="form-control"
                                    placeholder="Ej: Casillero Miami 001"
                                    required
                                    maxlength="50"
                                    autocomplete="off">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label><?= Lang::get('address') ?> <span class="text-danger">*</span></label>
                                <input type="text"
                                    name="Direccion"
                                    class="form-control"
                                    placeholder="Ej: 123 Main Street, Miami FL 33101"
                                    required
                                    maxlength="100"
                                    autocomplete="off">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Lang::get('cancel') ?></button>
                            <button type="submit" class="btn btn-primary"><?= Lang::get('register') ?></button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Editar Casillero -->
            <?php foreach ($casilleros as $casillero): ?>
                <div class="modal fade" id="edit-casillero-modal-<?= $casillero['ID_Casillero'] ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <form class="modal-content formEditarCasillero" method="POST" action="index.php?c=casillero&a=editar">
                            <div class="modal-header">
                                <h5 class="modal-title"><?= Lang::get('edit_casillero_modal_title') ?></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body row">
                                <input type="hidden" name="ID_Casillero" value="<?= $casillero['ID_Casillero'] ?>">
                                <div class="col-md-6 form-group">
                                    <label><?= Lang::get('name') ?> <span class="text-danger">*</span></label>
                                    <input type="text"
                                        name="Casillero_Nombre"
                                        class="form-control"
                                        placeholder="Ej: Casillero Miami 001"
                                        value="<?= htmlspecialchars($casillero['Casillero_Nombre']) ?>"
                                        required
                                        maxlength="50"
                                        autocomplete="off">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label><?= Lang::get('address') ?> <span class="text-danger">*</span></label>
                                    <input type="text"
                                        name="Direccion"
                                        class="form-control"
                                        placeholder="Ej: 123 Main Street, Miami FL 33101"
                                        value="<?= htmlspecialchars($casillero['Direccion']) ?>"
                                        required
                                        maxlength="100"
                                        autocomplete="off">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Lang::get('cancel') ?></button>
                                <button type="submit" class="btn btn-primary"><?= Lang::get('save_changes') ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Modal Eliminar -->
            <div class="modal fade" id="delete-casillero-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-center p-4">
                        <div class="modal-body">
                            <i class="bi bi-exclamation-triangle-fill text-danger mb-3" style="font-size: 3rem;"></i>
                            <h4 class="mb-20 font-weight-bold text-danger"><?= Lang::get('delete_casillero_modal_title') ?></h4>
                            <p class="mb-30 text-muted"><?= Lang::get('delete_casillero_modal_text') ?></p>
                            <form id="formEliminarCasillero" method="POST" action="index.php?c=casillero&a=eliminar">
                                <input type="hidden" name="ID_Casillero" id="delete_casillero_id">
                                <div class="row justify-content-center gap-2">
                                    <div class="col-6 px-1">
                                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal"><?= Lang::get('no') ?></button>
                                    </div>
                                    <div class="col-6 px-1">
                                        <button type="submit" class="btn btn-danger btn-block"><?= Lang::get('yes') ?></button>
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
        function setDeleteId(id) {
            document.getElementById('delete_casillero_id').value = id;
        }

        $(document).ready(function() {

            // ============================================================
            // HELPERS DE VALIDACIÓN
            // ============================================================
            function ensureFeedback($input) {
                let $fb = $input.siblings('.invalid-feedback').first();
                if ($fb.length === 0) {
                    $fb = $('<div class="invalid-feedback"></div>');
                    $input.after($fb);
                }
                return $fb;
            }

            function markInvalid($input, message) {
                const $fb = ensureFeedback($input);
                $input.addClass('is-invalid').removeClass('is-valid');
                $fb.text(message).show();
            }

            function markValid($input) {
                const $fb = ensureFeedback($input);
                $input.addClass('is-valid').removeClass('is-invalid');
                $fb.text('').hide();
            }

            function clearValidation($input) {
                const $fb = ensureFeedback($input);
                $input.removeClass('is-valid is-invalid');
                $fb.text('').hide();
                // Limitar a maxlength
                if (input.value.length > maxLength) {
                    input.value = input.value.substring(0, maxLength);
                }
            }

            function firstInvalidFocus($form) {
                const $first = $form.find('.is-invalid').first();
                if ($first.length) {
                    $first.focus();
                }
                // Limitar a maxlength
                if (input.value.length > maxLength) {
                    input.value = input.value.substring(0, maxLength);
                }
            }

            // ============================================================
            // REGLAS DE VALIDACIÓN CENTRALIZADAS
            // ============================================================
            const regexNombre = /^[A-Za-z0-9\sáéíóúÁÉÍÓÚñÑ.,\-()]{3,50}$/;

            function validarNombreCampo(value) {
                if (value === '') return {
                    ok: false,
                    msg: 'El nombre es obligatorio.'
                };
                if (value.length < 3) return {
                    ok: false,
                    msg: 'Mínimo 3 caracteres.'
                };
                if (value.length > 50) return {
                    ok: false,
                    msg: 'Máximo 50 caracteres.'
                };
                if (!regexNombre.test(value)) return {
                    ok: false,
                    msg: 'Solo letras, números y (,.-()). 3-50 caracteres.'
                };
                return {
                    ok: true,
                    msg: ''
                };
            }

            function validarDireccionCampo(value) {
                if (value === '') return {
                    ok: false,
                    msg: 'La dirección es obligatoria.'
                };
                if (value.length < 5) return {
                    ok: false,
                    msg: 'La dirección debe tener al menos 5 caracteres.'
                };
                if (value.length > 100) return {
                    ok: false,
                    msg: 'Máximo 100 caracteres.'
                };
                return {
                    ok: true,
                    msg: ''
                };
            }

            // ============================================================
            // VALIDACIÓN EN TIEMPO REAL
            // ============================================================
            $(document).on('input', 'input[name="Casillero_Nombre"]', function() {
                const $this = $(this);
                const v = $this.val().trim();
                const res = validarNombreCampo(v);
                if (!res.ok) markInvalid($this, res.msg);
                else markValid($this);
            });

            $(document).on('input', 'input[name="Direccion"]', function() {
                const $this = $(this);
                const v = $this.val().trim();
                const res = validarDireccionCampo(v);
                if (!res.ok) markInvalid($this, res.msg);
                else markValid($this);
            });

            // ============================================================
            // LIMPIEZA AL ABRIR/CERRAR MODALES
            // ============================================================
            $('#casilleroModal').on('hidden.bs.modal', function() {
                const $form = $('#formRegistrarCasillero');
                $form[0].reset();
                $form.find('input').each(function() {
                    clearValidation($(this));
                });
                $('.modal-backdrop').remove();
            });

            $('[id^="edit-casillero-modal"]').on('hidden.bs.modal', function() {
                const $form = $(this).find('.formEditarCasillero');
                $form.find('input[type="text"]').each(function() {
                    clearValidation($(this));
                });
                $('.modal-backdrop').remove();
            });

            // ============================================================
            // SUBMIT: REGISTRAR CASILLERO
            // ============================================================
            $('#formRegistrarCasillero').on('submit', function(e) {
                e.preventDefault();
                const $form = $(this);

                const $nombre = $form.find('input[name="Casillero_Nombre"]');
                const $direccion = $form.find('input[name="Direccion"]');
                const nombre = $nombre.val().trim();
                const direccion = $direccion.val().trim();

                // Validar campos
                const rNombre = validarNombreCampo(nombre);
                const rDir = validarDireccionCampo(direccion);

                if (!rNombre.ok) markInvalid($nombre, rNombre.msg);
                else markValid($nombre);
                if (!rDir.ok) markInvalid($direccion, rDir.msg);
                else markValid($direccion);

                // Si hay inválidos, detener
                if ($form.find('.is-invalid').length) {
                    firstInvalidFocus($form);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Corrige los errores',
                        text: 'Revisa los campos marcados para continuar.',
                        confirmButtonText: 'Entendido'
                    });
                    return;
                }

                // Enviar AJAX
                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function(r) {
                        Swal.fire({
                            icon: r.estado || 'info',
                            title: r.estado === 'success' ? '¡Éxito!' : 'Atención',
                            text: r.mensaje || 'Operación completada.',
                            timer: 2500,
                            showConfirmButton: false
                        });

                        if (r.estado === 'success') {
                            $('#casilleroModal').modal('hide');
                            $form[0].reset();
                            $form.find('input').each(function() {
                                clearValidation($(this));
                            });
                            recargarTabla();
                        } else {
                            // Mostrar errores específicos del servidor
                            if (r.detalles && typeof r.detalles === 'object') {
                                if (r.detalles.Casillero_Nombre) markInvalid($nombre, r.detalles.Casillero_Nombre);
                                if (r.detalles.Direccion) markInvalid($direccion, r.detalles.Direccion);
                                firstInvalidFocus($form);
                            }
                        }
                    },
                    error: function(xhr) {
                        console.error("Error AJAX:", xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo registrar el casillero. Verifica tu conexión.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // ============================================================
            // SUBMIT: EDITAR CASILLERO
            // ============================================================
            $(document).on('submit', '.formEditarCasillero', function(e) {
                e.preventDefault();
                const $form = $(this);

                const $nombre = $form.find('input[name="Casillero_Nombre"]');
                const $direccion = $form.find('input[name="Direccion"]');
                const nombre = $nombre.val().trim();
                const direccion = $direccion.val().trim();

                // Validar campos
                const rNombre = validarNombreCampo(nombre);
                const rDir = validarDireccionCampo(direccion);

                if (!rNombre.ok) markInvalid($nombre, rNombre.msg);
                else markValid($nombre);
                if (!rDir.ok) markInvalid($direccion, rDir.msg);
                else markValid($direccion);

                // Si hay inválidos, detener
                if ($form.find('.is-invalid').length) {
                    firstInvalidFocus($form);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Corrige los errores',
                        text: 'Revisa los campos marcados para continuar.',
                        confirmButtonText: 'Entendido'
                    });
                    return;
                }

                // Enviar AJAX
                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function(r) {
                        Swal.fire({
                            icon: r.estado,
                            title: r.estado === 'success' ? '¡Actualizado!' : (r.estado === 'info' ? 'Sin cambios' : 'Error'),
                            text: r.mensaje,
                            timer: 2500,
                            showConfirmButton: false
                        });

                        if (r.estado === 'success') {
                            $form.closest('.modal').modal('hide');
                            recargarTabla();
                        } else {
                            if (r.detalles && typeof r.detalles === 'object') {
                                if (r.detalles.Casillero_Nombre) markInvalid($nombre, r.detalles.Casillero_Nombre);
                                if (r.detalles.Direccion) markInvalid($direccion, r.detalles.Direccion);
                                firstInvalidFocus($form);
                            }
                        }
                    },
                    error: function(xhr) {
                        console.error("Error AJAX editar:", xhr.responseText);
                        Swal.fire('Error', 'No se pudo actualizar el casillero. Verifica tu conexión.', 'error');
                    }
                });
            });

            // ============================================================
            // SUBMIT: ELIMINAR CASILLERO
            // ============================================================
            $('#formEliminarCasillero').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(r) {
                        Swal.fire({
                            icon: r.estado,
                            title: r.estado === 'success' ? '¡Eliminado!' : 'Error',
                            text: r.mensaje,
                            timer: 2500,
                            showConfirmButton: false
                        });

                        if (r.estado === 'success') {
                            $('#delete-casillero-modal').modal('hide');
                            recargarTabla();
                        }
                    },
                    error: function(xhr) {
                        console.error("Error AJAX eliminar:", xhr.responseText);
                        Swal.fire('Error', 'No se pudo eliminar el casillero. Verifica tu conexión.', 'error');
                    }
                });
            });

            // ============================================================
            // RECARGAR TABLA DINÁMICAMENTE
            // ============================================================
            function recargarTabla() {
                $.ajax({
                    url: 'index.php?c=casillero&a=index',
                    type: 'GET',
                    success: function(html) {
                        const nuevoTbody = $(html).find('#casillerosTable tbody').html();
                        $('#casillerosTable tbody').html(nuevoTbody);

                        const nuevosModales = $(html).find('.modal.fade[id^="edit-casillero-modal"]');
                        $('.modal.fade[id^="edit-casillero-modal"]').remove();
                        $('body').append(nuevosModales);

                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    },
                    error: function(xhr) {
                        console.error("Error al recargar tabla:", xhr.responseText);
                    }
                });
            }

            // ============================================================
            // LIMPIEZA GLOBAL DE BACKDROPS
            // ============================================================
            $(document).on('hidden.bs.modal', '.modal', function() {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });

        });
    </script>

</body>

</html>