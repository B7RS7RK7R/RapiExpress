<?php
use RapiExpress\Helpers\Lang;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>RapiExpress - <?= Lang::get('categorias_title'); ?></title>
    <link rel="icon" href="assets/img/logo-rapi.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
</head>
<body>
<?php include 'src/views/partels/barras.php'; ?>

<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?= Lang::get('categorias_title'); ?></h4>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php?c=dashboard"><?= Lang::get('breadcrumb_home'); ?></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= Lang::get('categorias_title'); ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-30">
            <h4 class="text-blue h4"><?= Lang::get('categorias_list_title'); ?></h4>
            <?php include 'src/views/partels/notificaciones.php'; ?>
            <div class="pull-right">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#categoriaModal">
                    <i class="fa fa-plus"></i> <?= Lang::get('add_categoria'); ?>
                </button>
            </div>
        </div>

        <div class="pb-30">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        
                        <th><?= Lang::get('name'); ?></th>
                        <th><?= Lang::get('height'); ?> x <?= Lang::get('length'); ?> x <?= Lang::get('width'); ?></th>
                        <th><?= Lang::get('weight'); ?></th>
                        <th><?= Lang::get('pieces'); ?></th>
                        <th><?= Lang::get('price'); ?></th>
                        <th class="datatable-nosort"><?= Lang::get('actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                        <tr>                            
                            <td><?= htmlspecialchars($categoria['Categoria_Nombre']) ?></td>
                            <td><?= "{$categoria['Categoria_Altura']} x {$categoria['Categoria_Largo']} x {$categoria['Categoria_Ancho']}" ?></td>
                            <td><?= $categoria['Categoria_Peso'] ?></td>
                            <td><?= $categoria['Categoria_Piezas'] ?></td>
                            <td>$<?= number_format($categoria['Categoria_Precio'], 2) ?></td>
                            <td>
    <div class="table-actions">
        <!-- Botón Editar -->
        <a href="#"
            data-color="#265ed7"
            data-toggle="modal"
            data-target="#edit-categoria-modal-<?= $categoria['ID_Categoria'] ?>">
            <i class="icon-copy dw dw-edit2"></i>
        </a>

        <!-- Botón Eliminar -->
        <a href="#"
            data-color="#e95959"
            data-toggle="modal"
            data-target="#delete-categoria-modal"
            onclick="document.getElementById('delete_categoria_id').value = <?= $categoria['ID_Categoria'] ?>">
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

    <!-- Modal Registrar -->
    <div class="modal fade" id="categoriaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="index.php?c=categoria&a=registrar" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Lang::get('register_categoria_modal_title'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        <label><?= Lang::get('name'); ?></label>
                        <input type="text" class="form-control" name="nombre"
                               required maxlength="20"
                               pattern="[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ.,\-()]+"
                               title="Solo letras, números y (,.-()) permitidos. Máx 50 caracteres.">
                    </div>
                    <div class="col-md-6">
                        <label><?= Lang::get('price'); ?> ($)</label>
                        <input type="number" class="form-control" name="precio" required min="0" step="0.01">
                    </div>
                    <div class="col-md-3"><label><?= Lang::get('height'); ?> (cm)</label><input type="number" class="form-control" name="altura" required min="0" step="0.01"></div>
                    <div class="col-md-3"><label><?= Lang::get('length'); ?> (cm)</label><input type="number" class="form-control" name="largo" required min="0" step="0.01"></div>
                    <div class="col-md-3"><label><?= Lang::get('width'); ?> (cm)</label><input type="number" class="form-control" name="ancho" required min="0" step="0.01"></div>
                    <div class="col-md-3"><label><?= Lang::get('weight'); ?> (kg)</label><input type="number" class="form-control" name="peso" required min="0" step="0.01"></div>
                    <div class="col-md-3"><label><?= Lang::get('pieces'); ?></label><input type="number" class="form-control" name="piezas" required min="1" step="1"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal"><?= Lang::get('cancel'); ?></button>
                    <button class="btn btn-primary" type="submit"><?= Lang::get('register_cargo'); ?></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modales Ver / Editar -->
    <?php foreach ($categorias as $categoria): ?>
        

        <!-- Editar -->
        <div class="modal fade" id="edit-categoria-modal-<?= $categoria['ID_Categoria'] ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <form method="POST" action="index.php?c=categoria&a=editar" class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Lang::get('edit_categoria_modal_title'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body row">
                        <input type="hidden" name="ID_Categoria" value="<?= $categoria['ID_Categoria'] ?>">
                        <div class="col-md-6"><label><?= Lang::get('name'); ?></label><input class="form-control" name="nombre" value="<?= htmlspecialchars($categoria['Categoria_Nombre']) ?>" required></div>
                        <div class="col-md-6"><label><?= Lang::get('price'); ?></label><input class="form-control" name="precio" type="number" step="0.01" value="<?= $categoria['Categoria_Precio'] ?>" required></div>
                        <div class="col-md-3"><label><?= Lang::get('height'); ?></label><input class="form-control" name="altura" type="number" value="<?= $categoria['Categoria_Altura'] ?>" required></div>
                        <div class="col-md-3"><label><?= Lang::get('length'); ?></label><input class="form-control" name="largo" type="number" value="<?= $categoria['Categoria_Largo'] ?>" required></div>
                        <div class="col-md-3"><label><?= Lang::get('width'); ?></label><input class="form-control" name="ancho" type="number" value="<?= $categoria['Categoria_Ancho'] ?>" required></div>
                        <div class="col-md-3"><label><?= Lang::get('weight'); ?></label><input class="form-control" name="peso" type="number" value="<?= $categoria['Categoria_Peso'] ?>" required></div>
                        <div class="col-md-3"><label><?= Lang::get('pieces'); ?></label><input class="form-control" name="piezas" type="number" value="<?= $categoria['Categoria_Piezas'] ?>" required></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal"><?= Lang::get('cancel'); ?></button>
                        <button class="btn btn-primary" type="submit"><?= Lang::get('save_changes'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="delete-categoria-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" action="index.php?c=categoria&a=eliminar" class="modal-content text-center p-4">
                <div class="modal-body">
                    <i class="bi bi-exclamation-triangle-fill text-danger mb-3" style="font-size: 3rem;"></i>
                    <h4 class="mb-20 font-weight-bold text-danger"><?= Lang::get('delete_categoria_modal_title'); ?></h4>
                    <p class="mb-30 text-muted"><?= Lang::get('delete_categoria_modal_text'); ?></p>
                    <input type="hidden" name="id" id="delete_categoria_id">
                    <div class="row justify-content-center gap-2">
                        <div class="col-6 px-1"><button type="button" class="btn btn-secondary btn-block" data-dismiss="modal"><?= Lang::get('no'); ?></button></div>
                        <div class="col-6 px-1"><button type="submit" class="btn btn-danger btn-block"><?= Lang::get('yes'); ?></button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>


<script>
$(document).ready(function () {

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
    }

    function firstInvalidFocus($form) {
        const $first = $form.find('.is-invalid').first();
        if ($first.length) $first.focus();
    }

    // ============================================================
    // VALIDACIONES
    // ============================================================
    const regexNombre = /^[A-Za-z0-9\sáéíóúÁÉÍÓÚñÑ.,\-()]{3,50}$/;

    function validarNombre(value) {
        if (!value) return { ok: false, msg: 'El nombre es obligatorio.' };
        if (!regexNombre.test(value)) return { ok: false, msg: 'Solo letras, números y (,.-()).' };
        if (value.length < 3) return { ok: false, msg: 'Mínimo 3 caracteres.' };
        if (value.length > 50) return { ok: false, msg: 'Máximo 50 caracteres.' };
        return { ok: true, msg: '' };
    }

    function validarNumero(value, min = 0) {
        if (value === '' || isNaN(value)) return { ok: false, msg: 'Debe ser un número válido.' };
        if (parseFloat(value) < min) return { ok: false, msg: `Debe ser >= ${min}` };
        return { ok: true, msg: '' };
    }

    // ============================================================
    // VALIDACIÓN EN TIEMPO REAL
    // ============================================================
    $(document).on('input', 'input[name="nombre"]', function () {
        const res = validarNombre($(this).val().trim());
        if (!res.ok) markInvalid($(this), res.msg); else markValid($(this));
    });

    $(document).on('input', 'input[type="number"]', function () {
        const res = validarNumero($(this).val(), 0);
        if (!res.ok) markInvalid($(this), res.msg); else markValid($(this));
    });

    // ============================================================
    // SUBMIT REGISTRAR
    // ============================================================
    $('#categoriaModal form').on('submit', function (e) {
        e.preventDefault();
        const $form = $(this);

        let invalid = false;
        $form.find('input').each(function () {
            const $inp = $(this);
            if ($inp.attr('name') === 'nombre') {
                const res = validarNombre($inp.val().trim());
                if (!res.ok) { markInvalid($inp, res.msg); invalid = true; } else markValid($inp);
            } else {
                const res = validarNumero($inp.val(), 0);
                if (!res.ok) { markInvalid($inp, res.msg); invalid = true; } else markValid($inp);
            }
        });

        if (invalid) {
            firstInvalidFocus($form);
            Swal.fire('Corrige los errores', 'Revisa los campos marcados para continuar.', 'warning');
            return;
        }

        $.post($form.attr('action'), $form.serialize(), function (r) {
            Swal.fire({
                icon: r.success ? 'success' : 'error',
                title: r.success ? '¡Éxito!' : 'Error',
                text: r.mensaje,
                timer: 2500,
                showConfirmButton: false
            });

            if (r.success) {
                $('#categoriaModal').modal('hide');
                $form[0].reset();
                $form.find('input').each(function(){ clearValidation($(this)); });
                recargarTabla();
            }
        }, 'json').fail(function (xhr) {
            console.error(xhr.responseText);
            Swal.fire('Error', 'No se pudo registrar la categoría.', 'error');
        });
    });

    // ============================================================
    // SUBMIT EDITAR
    // ============================================================
    $(document).on('submit', '[id^="edit-categoria-modal"] form', function (e) {
        e.preventDefault();
        const $form = $(this);

        let invalid = false;
        $form.find('input').each(function () {
            const $inp = $(this);
            if ($inp.attr('name') === 'nombre') {
                const res = validarNombre($inp.val().trim());
                if (!res.ok) { markInvalid($inp, res.msg); invalid = true; } else markValid($inp);
            } else {
                const res = validarNumero($inp.val(), 0);
                if (!res.ok) { markInvalid($inp, res.msg); invalid = true; } else markValid($inp);
            }
        });

        if (invalid) {
            firstInvalidFocus($form);
            Swal.fire('Corrige los errores', 'Revisa los campos marcados para continuar.', 'warning');
            return;
        }

        $.post($form.attr('action'), $form.serialize(), function (r) {
            Swal.fire({
                icon: r.success ? 'success' : 'error',
                title: r.success ? '¡Actualizado!' : 'Error',
                text: r.mensaje,
                timer: 2500,
                showConfirmButton: false
            });

            if (r.success) {
                $form.closest('.modal').modal('hide');
                recargarTabla();
            }
        }, 'json').fail(function (xhr) {
            console.error(xhr.responseText);
            Swal.fire('Error', 'No se pudo actualizar la categoría.', 'error');
        });
    });

    // ============================================================
    // ELIMINAR
    // ============================================================
    $('#delete-categoria-modal form').on('submit', function (e) {
        e.preventDefault();
        const $form = $(this);

        $.post($form.attr('action'), $form.serialize(), function (r) {
            Swal.fire({
                icon: r.success ? 'success' : 'error',
                title: r.success ? '¡Eliminado!' : 'Error',
                text: r.mensaje,
                timer: 2500,
                showConfirmButton: false
            });

            if (r.success) {
                $('#delete-categoria-modal').modal('hide');
                recargarTabla();
            }
        }, 'json').fail(function (xhr) {
            console.error(xhr.responseText);
            Swal.fire('Error', 'No se pudo eliminar la categoría.', 'error');
        });
    });

    // ============================================================
    // RECARGAR TABLA DINÁMICAMENTE
    // ============================================================
 function recargarTabla() {
    $.get('index.php?c=categoria&a=index', function (html) {
        const nuevoTbody = $(html).find('table.data-table tbody').html();
        $('table.data-table tbody').html(nuevoTbody);

        const nuevosModales = $(html).find('[id^="edit-categoria-modal"]');
        $('[id^="edit-categoria-modal"]').remove();
        $('body').append(nuevosModales);

        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
}


    // ============================================================
    // LIMPIEZA BACKDROPS
    // ============================================================
    $(document).on('hidden.bs.modal', '.modal', function () {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });

});
</script>

  
</div>
</body>
</html>
