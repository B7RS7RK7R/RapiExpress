// Limpiar modal de registrar al cerrarlo
$('#cargoModal').on('hidden.bs.modal', function () {
    const $form = $('#formRegistrarCargo');
    $form[0].reset(); // limpiar campos
    $form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid'); // limpiar clases de validación
    $form.find('.invalid-feedback').text(''); // limpiar mensajes de error
});

// Registrar cargo via AJAX
$('#formRegistrarCargo').on('submit', function (e) {
    e.preventDefault();
    const $form = $(this);
    const datos = $form.serialize();

    $.ajax({
        url: 'index.php?c=cargo&a=registrar',
        type: 'POST',
        data: datos,
        dataType: 'json',
        success: function (respuesta) {
            $('#cargoModal').modal('hide');

            // Mostrar alerta SOLO UNA VEZ
            Swal.fire({
                icon: respuesta.estado === 'success' ? 'success' : 'error',
                title: respuesta.estado === 'success' ? 'Éxito' : 'Error',
                text: respuesta.mensaje,
                timer: respuesta.estado === 'success' ? 1500 : 2500,
                showConfirmButton: respuesta.estado !== 'success'
            });

            if (respuesta.estado === 'success') recargarTabla();
        },
        error: function () {
            Swal.fire('Error', 'No se pudo registrar el cargo.', 'error');
        }
    });
});
// Guardar valor original al abrir modal de edición
$(document).on('show.bs.modal', '.modal[id^="edit-cargo-modal-"]', function () {
    const $modal = $(this);
    const $input = $modal.find('input[name="Cargo_Nombre"]');
    $input.data('original', $input.val().trim()); // Guardar valor original
});

// Guardar valor original al abrir modal de edición
$(document).on('show.bs.modal', '.modal[id^="edit-cargo-modal-"]', function () {
    const $modal = $(this);
    const $input = $modal.find('input[name="Cargo_Nombre"]');
    $input.data('original', $input.val().trim()); // Guardar valor original
});

// Validar cambios antes de enviar edición
$(document).on('submit', 'form[id^="formEditarCargo-"]', function (e) {
    e.preventDefault();
    const $form = $(this);
    const $input = $form.find('input[name="Cargo_Nombre"]');
    const original = $input.data('original');
    const current = $input.val().trim();

    if (original === current) {
        // Si no hay cambios, avisar y NO enviar AJAX
        Swal.fire({
            icon: 'info',
            title: 'Sin cambios',
            text: 'No se han realizado modificaciones en el cargo.',
            timer: 2000,
            showConfirmButton: false
        });
        return; // Salimos sin enviar
    }

    // Continuar con AJAX si hay cambios
    const datos = $form.serialize();
    $.ajax({
        url: 'index.php?c=cargo&a=editar',
        type: 'POST',
        data: datos,
        dataType: 'json',
        success: function (respuesta) {
            const modal = $form.closest('.modal');
            modal.modal('hide');

            modal.off('hidden.bs.modal').on('hidden.bs.modal', function () {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');

                let icon = respuesta.estado === 'success' ? 'success' : 'error';
                Swal.fire({
                    icon: icon,
                    title: icon === 'success' ? 'Actualizado' : 'Error',
                    text: respuesta.mensaje,
                    timer: icon === 'success' ? 1500 : 2500,
                    showConfirmButton: icon !== 'success'
                });

                if (respuesta.estado === 'success') recargarTabla();
            });
        },
        error: function () {
            Swal.fire('Error', 'No se pudo actualizar el cargo.', 'error');
        }
    });
});


$('#formEliminarCargo').on('submit', function (e) {
    e.preventDefault();
    const datos = $(this).serialize();

    $.ajax({
        url: 'index.php?c=cargo&a=eliminar',
        type: 'POST',
        data: datos,
        dataType: 'json',
        success: function (respuesta) {
            $('#delete-cargo-modal').modal('hide');
            $('#delete-cargo-modal').one('hidden.bs.modal', function () {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');

                let icon = respuesta.estado === 'success' ? 'success' : 'error';
                Swal.fire({
                    icon: icon,
                    title: icon === 'success' ? 'Eliminado' : 'Error',
                    text: respuesta.mensaje,
                    timer: icon === 'success' ? 1500 : 2500,
                    showConfirmButton: icon !== 'success'
                });

                if (respuesta.estado === 'success') recargarTabla();
            });
        },
        error: function () {
            Swal.fire('Error', 'No se pudo eliminar el cargo.', 'error');
        }
    });
});
function recargarTabla() {
    $.ajax({
        url: 'index.php?c=cargo&a=index',
        type: 'GET',
        success: function (html) {
            const nuevoTbody = $(html).find('#cargosTable tbody').html();
            $('#cargosTable tbody').html(nuevoTbody);

            const nuevosModales = $(html).find('.modal.fade[id^="edit-cargo-modal"]');
            $('.modal.fade[id^="edit-cargo-modal"]').remove();
            $('body').append(nuevosModales);
        },
        error: function () {
            Swal.fire('Error', 'No se pudo recargar la lista de cargos.', 'error');
        }
    });
}


function setDeleteId(id) {
    document.getElementById('delete_cargo_id').value = id;
}

$(document).ready(function () {

});
