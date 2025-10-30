$(document).ready(function () {

    // ============================================================
    // SUBMIT: REGISTRAR CASILLERO
    // ============================================================
    $('#formRegistrarCasillero').on('submit', function (e) {
        e.preventDefault();
        const $form = $(this);
        const $nombre = $form.find('input[name="Casillero_Nombre"]');
        const $direccion = $form.find('input[name="Direccion"]');

        const rNombre = validarNombreCampo($nombre.val().trim());
        const rDir = validarDireccionCampo($direccion.val().trim());

        !rNombre.ok ? markInvalid($nombre, rNombre.msg) : markValid($nombre);
        !rDir.ok ? markInvalid($direccion, rDir.msg) : markValid($direccion);

        if ($form.find('.is-invalid').length) {
            firstInvalidFocus($form);
            Swal.fire({ icon: 'warning', title: 'Corrige los errores', text: 'Revisa los campos marcados para continuar.', confirmButtonText: 'Entendido' });
            return;
        }

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function (r) {
                Swal.fire({ icon: r.estado || 'info', title: r.estado === 'success' ? '¡Éxito!' : 'Atención', text: r.mensaje || 'Operación completada.', timer: 2500, showConfirmButton: false });
                if (r.estado === 'success') {
                    $('#casilleroModal').modal('hide');
                    $form[0].reset();
                    $form.find('input').each(function() { clearValidation($(this)); });
                    recargarTabla();
                } else if (r.detalles && typeof r.detalles === 'object') {
                    if (r.detalles.Casillero_Nombre) markInvalid($nombre, r.detalles.Casillero_Nombre);
                    if (r.detalles.Direccion) markInvalid($direccion, r.detalles.Direccion);
                    firstInvalidFocus($form);
                }
            },
            error: function (xhr) {
                console.error("Error AJAX:", xhr.responseText);
                Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo registrar el casillero. Verifica tu conexión.', confirmButtonText: 'OK' });
            }
        });
    });

    // ============================================================
    // SUBMIT: EDITAR CASILLERO
    // ============================================================
    $(document).on('submit', '.formEditarCasillero', function (e) {
        e.preventDefault();
        const $form = $(this);
        const $nombre = $form.find('input[name="Casillero_Nombre"]');
        const $direccion = $form.find('input[name="Direccion"]');

        const rNombre = validarNombreCampo($nombre.val().trim());
        const rDir = validarDireccionCampo($direccion.val().trim());

        !rNombre.ok ? markInvalid($nombre, rNombre.msg) : markValid($nombre);
        !rDir.ok ? markInvalid($direccion, rDir.msg) : markValid($direccion);

        if ($form.find('.is-invalid').length) {
            firstInvalidFocus($form);
            Swal.fire({ icon: 'warning', title: 'Corrige los errores', text: 'Revisa los campos marcados para continuar.', confirmButtonText: 'Entendido' });
            return;
        }

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function (r) {
                Swal.fire({ icon: r.estado, title: r.estado === 'success' ? '¡Actualizado!' : (r.estado === 'info' ? 'Sin cambios' : 'Error'), text: r.mensaje, timer: 2500, showConfirmButton: false });
                if (r.estado === 'success') { $form.closest('.modal').modal('hide'); recargarTabla(); }
                else if (r.detalles && typeof r.detalles === 'object') {
                    if (r.detalles.Casillero_Nombre) markInvalid($nombre, r.detalles.Casillero_Nombre);
                    if (r.detalles.Direccion) markInvalid($direccion, r.detalles.Direccion);
                    firstInvalidFocus($form);
                }
            },
            error: function (xhr) {
                console.error("Error AJAX editar:", xhr.responseText);
                Swal.fire('Error', 'No se pudo actualizar el casillero. Verifica tu conexión.', 'error');
            }
        });
    });

    // ============================================================
    // SUBMIT: ELIMINAR CASILLERO
    // ============================================================
    $('#formEliminarCasillero').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (r) {
                Swal.fire({ icon: r.estado, title: r.estado === 'success' ? '¡Eliminado!' : 'Error', text: r.mensaje, timer: 2500, showConfirmButton: false });
                if (r.estado === 'success') { $('#delete-casillero-modal').modal('hide'); recargarTabla(); }
            },
            error: function (xhr) {
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
            success: function (html) {
                const nuevoTbody = $(html).find('#casillerosTable tbody').html();
                $('#casillerosTable tbody').html(nuevoTbody);
                const nuevosModales = $(html).find('.modal.fade[id^="edit-casillero-modal"]');
                $('.modal.fade[id^="edit-casillero-modal"]').remove();
                $('body').append(nuevosModales);
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
            error: function (xhr) {
                console.error("Error al recargar tabla:", xhr.responseText);
            }
        });
    }

    // ============================================================
    // LIMPIEZA GLOBAL DE BACKDROPS
    // ============================================================
    $(document).on('hidden.bs.modal', '.modal', function () {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });

});
