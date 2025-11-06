// ─── VALIDACIÓN DE CLIENTES ────────────────────────────────────────────

// Mostrar estado visual de validación
function mostrarEstado($input, estado, mensaje = '') {
  if (estado === 'ok') {
    $input.removeClass('is-invalid').addClass('is-valid');
    $input.next('.invalid-feedback').remove();
  } else {
    $input.removeClass('is-valid').addClass('is-invalid');
    if ($input.next('.invalid-feedback').length === 0) {
      $input.after(`<div class="invalid-feedback">${mensaje}</div>`);
    } else {
      $input.next('.invalid-feedback').text(mensaje);
    }
  }
}

// Limpiar formulario completo
function limpiarFormularioCliente($form) {
  $form[0].reset();
  $form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
  $form.find('.invalid-feedback').remove();
}

// Aplicar validaciones en tiempo real
function aplicarValidaciones($form) {
  $form.find('input[name="Cedula_Identidad"]').off('input').on('input', function () {
    const regex = /^\d{6,23}$/;
    mostrarEstado($(this), regex.test($(this).val().trim()) ? 'ok' : 'error', 'Cédula inválida (6-23 dígitos)');
  });

  $form.find('input[name="Nombres_Cliente"], input[name="Apellidos_Cliente"]').off('input').on('input', function () {
    const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    mostrarEstado($(this), regex.test($(this).val().trim()) ? 'ok' : 'error', 'Solo letras y espacios');
  });

  $form.find('input[name="Correo_Cliente"]').off('input').on('input', function () {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    mostrarEstado($(this), regex.test($(this).val().trim()) ? 'ok' : 'error', 'Correo inválido');
  });

  $form.find('input[name="Telefono_Cliente"]').off('input').on('input', function () {
    const regex = /^\d{7,15}$/;
    mostrarEstado($(this), regex.test($(this).val().trim()) ? 'ok' : 'error', 'Teléfono inválido (7-15 dígitos)');
  });
}

// Aplicar colores a íconos de acción
function aplicarColoresIconos() {
  $('.table-actions a').each(function () {
    const color = $(this).data('color');
    if (color) $(this).find('i').css('color', color);
  });
}

// Limpieza de backdrop al cerrar modales
$(document).on('hidden.bs.modal', '.modal', function () {
  setTimeout(function () {
    if ($('.modal.show').length === 0) {
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
      $('body').css('padding-right', '');
    }
  }, 100);
});

// Limpiar SweetAlert residual
$(document).on('click', '.swal2-confirm, .swal2-cancel', function () {
  setTimeout(function () {
    $('.swal2-container').remove();
  }, 100);
});

// Inicializar al cargar
$(document).ready(function () {
  aplicarValidaciones($('#formRegistrarCliente'));
  aplicarColoresIconos();
  $('.modal-backdrop').remove();
  $('body').removeClass('modal-open');
  $('body').css('padding-right', '');
});

// Función global para eliminar
function setDeleteId(id) {
  $('#delete_cliente_id').val(id);
}
