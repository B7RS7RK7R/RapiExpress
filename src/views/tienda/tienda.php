<?php

use RapiExpress\Helpers\Lang;
?>
<!DOCTYPE html>
<html lang="<?= Lang::current() ?>">

<head>
    <meta charset="utf-8" />
    <title>RapiExpress - <?= Lang::get('stores_title'); ?></title>
    <link rel="icon" href="assets/img/logo-rapi.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</head>

<body>
    <?php include 'src/views/partels/barras.php'; ?>
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="title pb-20">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <h4><?= Lang::get('stores_title'); ?></h4>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php?c=dashboard&a=index"><?= Lang::get('breadcrumb_home') ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= Lang::get('stores_title'); ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Tiendas -->
            <div class="card-box mb-30">
                <div class="pd-30 d-flex justify-content-between align-items-center">
                    <h4 class="text-blue h4"><?= Lang::get('stores_list'); ?></h4>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tiendaModal">
                        <i class="fa fa-store"></i> <?= Lang::get('add_store'); ?>
                    </button>
                </div>
                <div class="pb-30">
                    <table class="data-table table stripe hover nowrap" id="tiendasTable">
                        <thead>
                            <tr>
                                <th><?= Lang::get('name'); ?></th>
                                <th><?= Lang::get('store_address'); ?></th>
                                <th><?= Lang::get('store_phone'); ?></th>
                                <th><?= Lang::get('store_email'); ?></th>
                                <th class="datatable-nosort"><?= Lang::get('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tiendas as $tienda): ?>
                                <tr>
                                    <td><?= htmlspecialchars($tienda['Tienda_Nombre']) ?></td>
                                    <td><?= htmlspecialchars($tienda['Tienda_Direccion']) ?></td>
                                    <td><?= htmlspecialchars($tienda['Tienda_Telefono']) ?></td>
                                    <td><?= htmlspecialchars($tienda['Tienda_Correo']) ?></td>
                                    <td>
                                        <div class="table-actions">                                            
                                            <!-- Editar -->
                                            <a href="#"
                                                data-color="#265ed7"
                                                data-toggle="modal"
                                                data-target="#edit-tienda-modal-<?= $tienda['ID_Tienda'] ?>"
                                                title="<?= Lang::get('edit') ?>">
                                                <i class="icon-copy dw dw-edit2"></i>
                                            </a>

                                            <!-- Eliminar -->
                                            <a href="#"
                                                data-color="#e95959"
                                                data-toggle="modal"
                                                data-target="#delete-tienda-modal"
                                                onclick="setDeleteId(<?= $tienda['ID_Tienda'] ?>)"
                                                title="<?= Lang::get('delete') ?>">
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

            <!-- Modal Registrar Tienda -->
            <div class="modal fade" id="tiendaModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="formRegistrarTienda">
                            <div class="modal-header">
                                <h5 class="modal-title"><?= Lang::get('register_new_store'); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="<?= Lang::get('close'); ?>">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php $campos = ['nombre_tienda' => 'store_name', 'direccion_tienda' => 'store_address', 'telefono_tienda' => 'store_phone', 'correo_tienda' => 'store_email']; ?>
                                <?php foreach ($campos as $name => $langKey): ?>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><?= Lang::get($langKey); ?></label>
                                        <div class="col-sm-9">
                                            <input type="<?= $name === 'correo_tienda' ? 'email' : 'text' ?>" class="form-control" name="<?= $name ?>" required>
                                            <div class="invalid-feedback"><?= Lang::get($langKey) ?> <?= Lang::get('invalid_field'); ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Lang::get('cancel'); ?></button>
                                <button type="submit" class="btn btn-primary"><?= Lang::get('register_store'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Editar Tienda -->
            <?php foreach ($tiendas as $ti): ?>
                <div class="modal fade" id="edit-tienda-modal-<?= $ti['ID_Tienda'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form class="formEditarTienda" id="formEditarTienda-<?= $ti['ID_Tienda'] ?>">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= Lang::get('edit_store'); ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="<?= Lang::get('close'); ?>">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_tienda" value="<?= $ti['ID_Tienda'] ?>">
                                    <?php foreach ($campos as $name => $langKey): ?>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label"><?= Lang::get($langKey); ?></label>
                                            <div class="col-sm-9">
                                                <input type="<?= $name === 'correo_tienda' ? 'email' : 'text' ?>" class="form-control" name="<?= $name ?>" value="<?= htmlspecialchars($ti[$name === 'nombre_tienda' ? 'Tienda_Nombre' : ($name === 'direccion_tienda' ? 'Tienda_Direccion' : ($name === 'telefono_tienda' ? 'Tienda_Telefono' : 'Tienda_Correo'))]) ?>" required>
                                                <div class="invalid-feedback"><?= Lang::get($langKey) ?> <?= Lang::get('invalid_field'); ?></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Lang::get('cancel'); ?></button>
                                    <button type="submit" class="btn btn-primary"><?= Lang::get('save_changes'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Modal Eliminar -->
            <!-- Modal Eliminar Tienda -->
            <div class="modal fade" id="delete-tienda-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content text-center p-4">
                        <div class="modal-body">
                            <i class="bi bi-exclamation-triangle-fill text-danger mb-3" style="font-size: 3rem;"></i>
                            <h4 class="mb-20 font-weight-bold text-danger"><?= Lang::get('delete_store'); ?></h4>
                            <p class="mb-30 text-muted"><?= Lang::get('delete_warning'); ?></p>
                            <form id="formEliminarTienda">
                                <input type="hidden" name="delete_tienda_id" id="delete_tienda_id">
                                <div class="row justify-content-center gap-2" style="max-width: 200px; margin: 0 auto;">
                                    <div class="col-6 px-1">
                                        <button type="button" class="btn btn-secondary btn-lg btn-block border-radius-100" data-dismiss="modal">
                                            <i class="fa fa-times"></i> <?= Lang::get('no_cancel'); ?>
                                        </button>
                                    </div>
                                    <div class="col-6 px-1">
                                        <button type="submit" class="btn btn-danger btn-lg btn-block border-radius-100">
                                            <i class="fa fa-check"></i> <?= Lang::get('yes_delete'); ?>
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

    <!-- JS -->

    <script>
        function setDeleteId(id) {
            document.getElementById('delete_tienda_id').value = id;
        }

        $(document).ready(function() {
            const campos = {
                nombre_tienda: 'texto',
                direccion_tienda: 'texto',
                telefono_tienda: 'telefono',
                correo_tienda: 'correo'
            };

            // ============================================================
            // FUNCIONES DE VALIDACIÓN
            // ============================================================
            function validarCampo($input, tipo) {
                const valor = $input.val().trim();
                let valido = false;

                switch (tipo) {
                    case 'texto':
                        valido = valor.length > 0;
                        break;
                    case 'telefono':
                        valido = /^\+?\d{7,20}$/.test(valor);
                        break;
                    case 'correo':
                        valido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor);
                        break;
                }

                $input.removeClass('is-invalid is-valid');
                if (valido) $input.addClass('is-valid');
                else $input.addClass('is-invalid');

                return valido;
            }

            function validarFormulario($form) {
                let valido = true;
                $form.find('input[name]').each(function() {
                    const name = $(this).attr('name');
                    if (campos[name]) valido &= validarCampo($(this), campos[name]);
                });
                return Boolean(valido);
            }

            // ============================================================
            // RECARGAR TABLA DINÁMICAMENTE
            // ============================================================
            function recargarTabla() {
                $.get('index.php?c=tienda&a=index', function(html) {
                    // Actualizar tabla
                    const nuevoTbody = $(html).find('#tiendasTable tbody').html();
                    $('#tiendasTable tbody').html(nuevoTbody);

                    // Actualizar modales de edición
                    const nuevosModales = $(html).find('.modal.fade[id^="edit-tienda-modal"]');
                    $('.modal.fade[id^="edit-tienda-modal"]').remove();
                    $('body').append(nuevosModales);

                    // Limpiar backdrops
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                });
            }

            // ============================================================
            // VALIDACIÓN EN TIEMPO REAL
            // ============================================================
            $(document).on('input', 'input[name]', function() {
                const name = $(this).attr('name');
                if (campos[name]) validarCampo($(this), campos[name]);
            });

            // ============================================================
            // REGISTRAR TIENDA
            // ============================================================
            $('#formRegistrarTienda').on('submit', function(e) {
                e.preventDefault();
                const $form = $(this);

                if (!validarFormulario($form)) {
                    Swal.fire('Error', 'Corrige los campos inválidos', 'error');
                    return;
                }

                $.post('index.php?c=tienda&a=registrar', $form.serialize(), function(respuesta) {
                    if (respuesta.estado === 'success') {
                        $('#tiendaModal').modal('hide');
                        $form[0].reset();
                        $form.find('input').removeClass('is-valid is-invalid');
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: respuesta.mensaje,
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true
                        });
                        recargarTabla();
                    } else {
                        Swal.fire('Error', respuesta.mensaje, 'error');
                    }
                }, 'json').fail(function() {
                    Swal.fire('Error', 'No se pudo conectar con el servidor', 'error');
                });
            });

            // ============================================================
            // EDITAR TIENDA
            // ============================================================
            $(document).on('submit', 'form[class^="formEditarTienda"]', function(e) {
                e.preventDefault();
                const $form = $(this);

                // Validar campos
                if (!validarFormulario($form)) {
                    Swal.fire('Error', 'Corrige los campos inválidos', 'error');
                    return;
                }

                // Revisar si hubo cambios
                const valoresIniciales = $form.data('valoresIniciales');
                const valoresActuales = $form.serialize();

                if (valoresActuales === valoresIniciales) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Sin cambios',
                        text: 'No se detectaron modificaciones en el formulario.'
                    });
                    return;
                }

                // Enviar AJAX
                $.post('index.php?c=tienda&a=editar', $form.serialize(), function(respuesta) {
                    if (respuesta.estado === 'success') {
                        $form.closest('.modal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Actualizado',
                            text: respuesta.mensaje,
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true
                        });
                        recargarTabla();
                    } else {
                        Swal.fire('Error', respuesta.mensaje, 'error');
                    }
                }, 'json').fail(function() {
                    Swal.fire('Error', 'No se pudo conectar con el servidor', 'error');
                });
            });

            // ============================================================
            // ELIMINAR TIENDA (CORREGIDO)
            // ============================================================
            $('#formEliminarTienda').on('submit', function(e) {
                e.preventDefault();
                const id = $('#delete_tienda_id').val();

                if (!id) {
                    Swal.fire('Error', 'ID de tienda no definido', 'error');
                    return;
                }

                $.post('index.php?c=tienda&a=eliminar', {
                    id_tienda: id
                }, function(respuesta) {
                    if (respuesta.estado === 'success') {
                        $('#delete-tienda-modal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            text: respuesta.mensaje,
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true
                        });
                        // ✅ USAR recargarTabla() en lugar de location.reload()
                        recargarTabla();
                    } else {
                        Swal.fire('Error', respuesta.mensaje, 'error');
                    }
                }, 'json').fail(function() {
                    Swal.fire('Error', 'No se pudo conectar con el servidor', 'error');
                });
            });

            // ============================================================
            // GUARDAR VALORES INICIALES AL ABRIR MODAL EDITAR
            // ============================================================
            $(document).on('show.bs.modal', '.modal.fade[id^="edit-tienda-modal"]', function() {
                const $form = $(this).find('form');
                $form.data('valoresIniciales', $form.serialize());
            });

            // ============================================================
            // LIMPIAR BACKDROPS AL CERRAR MODALES
            // ============================================================
            $(document).on('hidden.bs.modal', '.modal', function() {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            });
        });
    </script>
</body>

</html>