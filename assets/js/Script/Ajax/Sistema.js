// ─── CARGO ─────────────────────────────────────────────────────────────

// Limpiar modal de registrar al cerrarlo
$('#cargoModal').on('hidden.bs.modal', function () {
  const $form = $('#formRegistrarCargo');
  $form[0].reset();
  $form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
  $form.find('.invalid-feedback').text('');
});

// Registrar cargo vía AJAX
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
      Swal.fire({
        icon: respuesta.estado === 'success' ? 'success' : 'error',
        title: respuesta.estado === 'success' ? 'Éxito' : 'Error',
        text: respuesta.mensaje,
        timer: respuesta.estado === 'success' ? 1500 : 2500,
        showConfirmButton: respuesta.estado !== 'success'
      });
      if (respuesta.estado === 'success') recargarTablaCargo();
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
  $input.data('original', $input.val().trim());
});

// Validar cambios antes de enviar edición
$(document).on('submit', 'form[id^="formEditarCargo-"]', function (e) {
  e.preventDefault();
  const $form = $(this);
  const $input = $form.find('input[name="Cargo_Nombre"]');
  const original = $input.data('original');
  const current = $input.val().trim();

  if (original === current) {
    Swal.fire({
      icon: 'info',
      title: 'Sin cambios',
      text: 'No se han realizado modificaciones en el cargo.',
      timer: 2000,
      showConfirmButton: false
    });
    return;
  }

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

        if (respuesta.estado === 'success') recargarTablaCargo();
      });
    },
    error: function () {
      Swal.fire('Error', 'No se pudo actualizar el cargo.', 'error');
    }
  });
});

// Eliminar cargo vía AJAX
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

        if (respuesta.estado === 'success') recargarTablaCargo();
      });
    },
    error: function () {
      Swal.fire('Error', 'No se pudo eliminar el cargo.', 'error');
    }
  });
});

// Recargar tabla de cargos
function recargarTablaCargo() {
  if ($.fn.DataTable.isDataTable('#cargosTable')) {
    $('#cargosTable').DataTable().destroy();
  }

  $.ajax({
    url: 'index.php?c=cargo&a=index',
    type: 'GET',
    success: function (html) {
      const nuevoTbody = $(html).find('#cargosTable tbody').html();
      const nuevosModales = $(html).find('.modal.fade[id^="edit-cargo-modal"]');

      $('#cargosTable tbody').html(nuevoTbody);
      $('.modal.fade[id^="edit-cargo-modal"]').remove();
      $('body').append(nuevosModales);

      $('#cargosTable').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
          url: 'assets/Temple/src/plugins/datatables/js/es_es.json'
        },
        columnDefs: [
          { targets: 'datatable-nosort', orderable: false }
        ]
      });

      $('.table-actions a').each(function () {
        const color = $(this).data('color');
        if (color) $(this).find('i').css('color', color);
      });
    },
    error: function () {
      Swal.fire('Error', 'No se pudo recargar la lista de cargos.', 'error');
    }
  });
}

// Asignar ID para eliminar
function setDeleteId(id) {
  document.getElementById('delete_cargo_id').value = id;
}


