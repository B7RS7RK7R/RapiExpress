$(document).ready(function() {
  // tu código aquí

// ─── CARGO ─────────────────────────────────────────────────────────────
function recargarTablaCargo() {
  recargarTablaGenerica('#cargosTable', 'index.php?c=cargo&a=index', 'edit-cargo-modal');
}

$('#formRegistrarCargo').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  enviarFormularioAjax($form, function (r) {
    $('#cargoModal').modal('hide');
    mostrarAlerta(r);
    if (r.estado === 'success') recargarTablaCargo();
  });
});

$(document).on('submit', 'form[id^="formEditarCargo-"]', function (e) {
  e.preventDefault();
  const $form = $(this);
  const $input = $form.find('input[name="Cargo_Nombre"]');
  if ($input.val().trim() === $input.data('original')) {
    mostrarAlerta({ estado: 'info', mensaje: 'No se han realizado modificaciones.' });
    return;
  }
  enviarFormularioAjax($form, function (r) {
    $form.closest('.modal').modal('hide');
    mostrarAlerta(r);
    if (r.estado === 'success') recargarTablaCargo();
  });
});

$('#formEliminarCargo').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  enviarFormularioAjax($form, function (r) {
    $('#delete-cargo-modal').modal('hide');
    mostrarAlerta(r);
    if (r.estado === 'success') recargarTablaCargo();
  });
});

// ─── CASILLERO ─────────────────────────────────────────────────────────
function recargarTablaCasillero() {
  recargarTablaGenerica('#casillerosTable', 'index.php?c=casillero&a=index', 'edit-casillero-modal');
}

$('#formRegistrarCasillero').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  const $nombre = $form.find('input[name="Casillero_Nombre"]');
  const $direccion = $form.find('input[name="Direccion"]');

  aplicarValidacion($nombre, validarNombreCampo($nombre.val().trim()));
  aplicarValidacion($direccion, validarDireccionCampo($direccion.val().trim()));

  if ($form.find('.is-invalid').length) {
    firstInvalidFocus($form);
    mostrarAlerta({ estado: 'warning', mensaje: 'Revisa los campos marcados.' });
    return;
  }

  enviarFormularioAjax($form, function (r) {
    $('#casilleroModal').modal('hide');
    mostrarAlerta(r);
    if (r.estado === 'success') {
      limpiarFormulario($form);
      recargarTablaCasillero();
    }
  });
});

$(document).on('submit', '.formEditarCasillero', function (e) {
  e.preventDefault();
  const $form = $(this);
  const $nombre = $form.find('input[name="Casillero_Nombre"]');
  const $direccion = $form.find('input[name="Direccion"]');

  const sinCambios = $nombre.val().trim() === $nombre.data('original') &&
                     $direccion.val().trim() === $direccion.data('original');

  if (sinCambios) {
    mostrarAlerta({ estado: 'info', mensaje: 'No se han realizado modificaciones.' });
    return;
  }

  aplicarValidacion($nombre, validarNombreCampo($nombre.val().trim()));
  aplicarValidacion($direccion, validarDireccionCampo($direccion.val().trim()));

  if ($form.find('.is-invalid').length) {
    firstInvalidFocus($form);
    mostrarAlerta({ estado: 'warning', mensaje: 'Revisa los campos marcados.' });
    return;
  }

  enviarFormularioAjax($form, function (r) {
    $form.closest('.modal').modal('hide');
    mostrarAlerta(r);
    if (r.estado === 'success') recargarTablaCasillero();
  });
});

$('#formEliminarCasillero').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  enviarFormularioAjax($form, function (r) {
    $('#delete-casillero-modal').modal('hide');
    mostrarAlerta(r);
    if (r.estado === 'success') recargarTablaCasillero();
  });
});

// ─── CATEGORÍA ─────────────────────────────────────────────────────────
function recargarTablaCategoria() {
  recargarTablaGenerica('#categoriasTable', 'index.php?c=categoria&a=index', 'edit-categoria-modal');
}

$('#formRegistrarCategoria').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);

  if ($form.find('.is-invalid').length) {
    mostrarAlerta({ estado: 'warning', mensaje: 'Revisa los campos marcados.' });
    return;
  }

  enviarFormularioAjax($form, function (r) {
    $('#categoriaModal').modal('hide');
    $('#categoriaModal').one('hidden.bs.modal', function () {
      limpiarBackdropGlobal();
      mostrarAlerta({ estado: r.success ? 'success' : 'error', mensaje: r.mensaje });
      if (r.success) {
        limpiarFormulario($form);
        recargarTablaCategoria();
      }
    });
  }, function () {
    $('#categoriaModal').modal('hide');
    $('#categoriaModal').one('hidden.bs.modal', function () {
      limpiarBackdropGlobal();
      mostrarAlerta({ estado: 'error', mensaje: 'No se pudo registrar la categoría.' });
    });
  });
});

$(document).on('submit', '.formEditarCategoria', function (e) {
  e.preventDefault();
  const $form = $(this);
  const modal = $form.closest('.modal');

  const hayCambios = $form.find('input').toArray().some(input => {
    const $i = $(input);
    return $i.val() !== $i.data('original');
  });

  if (!hayCambios) {
    modal.modal('hide');
    modal.one('hidden.bs.modal', function () {
      limpiarBackdropGlobal();
      mostrarAlerta({ estado: 'info', mensaje: 'No se realizaron modificaciones.' });
    });
    return;
  }

  enviarFormularioAjax($form, function (r) {
    modal.modal('hide');
    modal.one('hidden.bs.modal', function () {
      limpiarBackdropGlobal();
      mostrarAlerta({ estado: r.success ? 'success' : 'error', mensaje: r.mensaje });
      if (r.success) recargarTablaCategoria();
    });
  }, function () {
    modal.modal('hide');
    modal.one('hidden.bs.modal', function () {
      limpiarBackdropGlobal();
      mostrarAlerta({ estado: 'error', mensaje: 'No se pudo actualizar la categoría.' });
    });
  });
});

$('#formEliminarCategoria').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);

  enviarFormularioAjax($form, function (r) {
    $('#delete-categoria-modal').modal('hide');
    $('#delete-categoria-modal').one('hidden.bs.modal', function () {
      limpiarBackdropGlobal();
      mostrarAlerta({ estado: r.success ? 'success' : 'error', mensaje: r.mensaje });
      if (r.success) recargarTablaCategoria();
    });
  }, function () {
    $('#delete-categoria-modal').modal('hide');
    $('#delete-categoria-modal').one('hidden.bs.modal', function () {
      limpiarBackdropGlobal();
      mostrarAlerta({ estado: 'error', mensaje: 'No se pudo eliminar la categoría.' });
    });
  });
});

function setDeleteId(id) {
  $('#delete_categoria_id').val(id);
}

// ─── CLIENTE ───────────────────────────────────────────────────────────
function recargarTablaCliente() {
  recargarTablaGenerica('#clientesTable', 'index.php?c=cliente&a=index', 'edit-cliente-modal');
}

$('#formRegistrarCliente').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);

  if ($form.find('.is-invalid').length) {
    mostrarAlerta({ estado: 'warning', mensaje: 'Revisa los campos marcados.' });
    return;
  }

  const datos = new FormData(this);
  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      $('#clienteModal').modal('hide');
      $('#clienteModal').one('hidden.bs.modal', function () {
        mostrarAlerta({ estado: res.estado, mensaje: res.mensaje });
        if (res.estado === 'success') {
          limpiarFormularioCliente($form);
          recargarTablaCliente();
        }
      });
    },
    error: function () {
      $('#clienteModal').modal('hide');
      $('#clienteModal').one('hidden.bs.modal', function () {
        mostrarAlerta({ estado: 'error', mensaje: 'No se pudo registrar el cliente.' });
      });
    }
  });
});

let datosOriginalesCliente = {};

$(document).on('show.bs.modal', '.modal[id^="edit-cliente-modal"]', function () {
  const $modal = $(this);
  const $form = $modal.find('form[id^="formEditarCliente-"]');

  datosOriginalesCliente = {};
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name) datosOriginalesCliente[name] = $(this).val();
  });

  aplicarValidaciones($form);
});

$(document).on('submit', 'form[id^="formEditarCliente-"]', function (e) {
  e.preventDefault();
  const $form = $(this);
  const modal = $form.closest('.modal');

  let hayCambios = false;
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name && datosOriginalesCliente[name] !== $(this).val()) {
      hayCambios = true;
      return false;
    }
  });

  if (!hayCambios) {
    modal.modal('hide');
    modal.one('hidden.bs.modal', function () {
      mostrarAlerta({ estado: 'info', mensaje: 'No se detectaron modificaciones en los datos.' });
    });
    return;
  }

  const datos = new FormData(this);
  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      modal.modal('hide');
      modal.one('hidden.bs.modal', function () {
        mostrarAlerta({ estado: res.estado, mensaje: res.mensaje });
        if (res.estado === 'success') recargarTablaCliente();
      });
    },
    error: function () {
      modal.modal('hide');
      modal.one('hidden.bs.modal', function () {
        mostrarAlerta({ estado: 'error', mensaje: 'No se pudo actualizar el cliente.' });
      });
    }
  });
});

$(document).on('hidden.bs.modal', '.modal[id^="edit-cliente-modal"]', function () {
  datosOriginalesCliente = {};
});

$('#formEliminarCliente').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);

  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: $form.serialize(),
    dataType: 'json',
    success: function (res) {
      $('#delete-cliente-modal').modal('hide');
      $('#delete-cliente-modal').one('hidden.bs.modal', function () {
        mostrarAlerta({ estado: res.estado, mensaje: res.mensaje });
        if (res.estado === 'success') recargarTablaCliente();
      });
    },
    error: function () {
      $('#delete-cliente-modal').modal('hide');
      $('#delete-cliente-modal').one('hidden.bs.modal', function () {
        mostrarAlerta({ estado: 'error', mensaje: 'No se pudo eliminar el cliente.' });
      });
    }
  });
});

// ─── COURIER ───────────────────────────────────────────────────────────
function recargarTablaCourier() {
  recargarTablaGenerica('#couriersTable', 'index.php?c=courier&a=index', 'edit-courier-modal');
}

$('#formRegistrarCourier').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  const datos = new FormData(this);

  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      $('#courierModal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          limpiarFormulario($form);
          Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: res.mensaje,
            timer: 1500,
            showConfirmButton: false
          });
          recargarTablaCourier();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.mensaje });
        }
      }, 300);
    },
    error: function (xhr) {
      $('#courierModal').modal('hide');
      limpiarBackdropGlobal();
      setTimeout(() => {
        let mensaje = 'No se pudo registrar el courier.';
        try {
          const res = JSON.parse(xhr.responseText);
          mensaje = res.mensaje || mensaje;
        } catch (e) {}
        Swal.fire({ icon: 'error', title: 'Error', text: mensaje });
      }, 300);
    }
  });
});

let datosOriginalesCourier = {};

$(document).on('show.bs.modal', '.modal[id^="edit-courier-modal"]', function () {
  const $form = $(this).find('form[id^="formEditarCourier-"]');
  datosOriginalesCourier = {};
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name) datosOriginalesCourier[name] = $(this).val();
  });
});

$(document).on('submit', 'form[id^="formEditarCourier-"]', function (e) {
  e.preventDefault();
  const $form = $(this);

  let hayCambios = false;
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name && datosOriginalesCourier[name] !== $(this).val()) {
      hayCambios = true;
      return false;
    }
  });

  if (!hayCambios) {
    Swal.fire({
      icon: 'info',
      title: 'Sin cambios',
      text: 'No se detectaron modificaciones en los datos.',
      timer: 2000,
      showConfirmButton: false
    });
    return;
  }

  const datos = new FormData(this);
  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      $form.closest('.modal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Actualizado',
            text: res.mensaje,
            timer: 1500,
            showConfirmButton: false
          });
          recargarTablaCourier();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.mensaje });
        }
      }, 300);
    },
    error: function () {
      Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo actualizar el courier.' });
    }
  });
});

$(document).on('hidden.bs.modal', '.modal[id^="edit-courier-modal"]', function () {
  datosOriginalesCourier = {};
});

$('#formEliminarCourier').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);

  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: $form.serialize(),
    dataType: 'json',
    success: function (res) {
      $('#delete-courier-modal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Eliminado',
            text: res.mensaje,
            timer: 1500,
            showConfirmButton: false
          });
          recargarTablaCourier();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.mensaje });
        }
      }, 300);
    },
    error: function () {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se puede eliminar el courier porque está asociado a paquetes.'
      });
    }
  });
});

function setDeleteId(id) {
  $('#delete_courier_id').val(id);
}

// ─── PAQUETE ───────────────────────────────────────────────────────────
function recargarTablaPaquete() {
  recargarTablaGenerica('#paquetesTable', 'index.php?c=paquete&a=index', 'edit-paquete');
  $('.paquete-check').prop('checked', false);
  const btnImprimir = document.getElementById("btnImprimirSeleccionado");
  if (btnImprimir) btnImprimir.disabled = true;
  inicializarCheckboxes();
}

$('#formRegistrarPaquete').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  const datos = new FormData(this);

  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      $('#paqueteModal').modal('hide');
      setTimeout(() => {
        if (res.success) {
          limpiarFormulario($form);
          Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: res.message,
            timer: 1500,
            showConfirmButton: false
          });
          recargarTablaPaquete();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.message });
        }
      }, 300);
    },
    error: function (xhr) {
      let mensaje = 'No se pudo registrar el paquete.';
      if (xhr.responseJSON?.message) mensaje = xhr.responseJSON.message;
      Swal.fire({ icon: 'error', title: 'Error', text: mensaje });
    }
  });
});

let datosOriginalesPaquete = {};

$(document).on('show.bs.modal', '.modal[id^="edit-paquete-"]', function () {
  const $form = $(this).find('form[id^="formEditarPaquete-"]');
  datosOriginalesPaquete = {};
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name) datosOriginalesPaquete[name] = $(this).val();
  });
});

$(document).on('submit', 'form[id^="formEditarPaquete-"]', function (e) {
  e.preventDefault();
  const $form = $(this);

  let hayCambios = false;
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name && datosOriginalesPaquete[name] !== $(this).val()) {
      hayCambios = true;
      return false;
    }
  });

  if (!hayCambios) {
    Swal.fire({
      icon: 'info',
      title: 'Sin cambios',
      text: 'No se detectaron modificaciones en los datos.',
      timer: 2000,
      showConfirmButton: false
    });
    return;
  }

  const datos = new FormData(this);
  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      $form.closest('.modal').modal('hide');
      setTimeout(() => {
        if (res.success) {
          Swal.fire({
            icon: 'success',
            title: 'Actualizado',
            text: res.message,
            timer: 1500,
            showConfirmButton: false
          });
          recargarTablaPaquete();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.message });
        }
      }, 300);
    },
    error: function (xhr) {
      let mensaje = 'No se pudo actualizar el paquete.';
      if (xhr.responseJSON?.message) mensaje = xhr.responseJSON.message;
      Swal.fire({ icon: 'error', title: 'Error', text: mensaje });
    }
  });
});

$(document).on('hidden.bs.modal', '.modal[id^="edit-paquete-"]', function () {
  datosOriginalesPaquete = {};
});

$('#formEliminarPaquete').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);

  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: $form.serialize(),
    dataType: 'json',
    success: function (res) {
      $('#delete-paquete-modal').modal('hide');
      setTimeout(() => {
        if (res.success) {
          Swal.fire({
            icon: 'success',
            title: 'Eliminado',
            text: res.message,
            timer: 1500,
            showConfirmButton: false
          });
          recargarTablaPaquete();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.message });
        }
      }, 300);
    },
    error: function (xhr) {
      let mensaje = 'No se puede eliminar el paquete porque está asociado a registros relacionados.';
      if (xhr.responseJSON?.message) mensaje = xhr.responseJSON.message;
      Swal.fire({ icon: 'error', title: 'Error', text: mensaje });
    }
  });
});

function inicializarCheckboxes() {
  const checkboxes = document.querySelectorAll(".paquete-check");
  const btnImprimir = document.getElementById("btnImprimirSeleccionado");

  checkboxes.forEach(chk => {
    const newChk = chk.cloneNode(true);
    chk.parentNode.replaceChild(newChk, chk);
  });

  document.querySelectorAll(".paquete-check").forEach(chk => {
    chk.addEventListener("change", function () {
      const selected = document.querySelectorAll(".paquete-check:checked");
      if (btnImprimir) btnImprimir.disabled = (selected.length !== 1);
    });
  });

  if (btnImprimir) {
    const selected = document.querySelectorAll(".paquete-check:checked");
    btnImprimir.disabled = (selected.length !== 1);
  }
}

function abrirModalImprimir() {
  const selected = document.querySelector(".paquete-check:checked");
  if (!selected) {
    Swal.fire({
      icon: 'warning',
      title: 'Atención',
      text: 'Debe seleccionar un paquete.',
      timer: 2000,
      showConfirmButton: false
    });
    return;
  }

  $('#imprimirPaqueteModal').modal('hide');
  setTimeout(() => {
    document.getElementById("detalleTracking").innerText = selected.dataset.tracking || '-';
    document.getElementById("detalleCliente").innerText = selected.dataset.cliente || '-';
    document.getElementById("detalleInstrumento").innerText = selected.dataset.instrumento || '-';
    document.getElementById("detalleCategoria").innerText = selected.dataset.categoria || '-';
    document.getElementById("detalleSucursal").innerText = selected.dataset.sucursal || '-';
    document.getElementById("detalleCourier").innerText = selected.dataset.courier || '-';
    document.getElementById("detalleDescripcion").innerText = selected.dataset.descripcion || '-';
    document.getElementById("detallePeso").innerText = selected.dataset.peso || '-';

    const detallePiezasElement = document.getElementById("detallePiezas");
    if (detallePiezasElement) detallePiezasElement.innerText = selected.dataset.piezas || '1';

    const qrCode = selected.dataset.qr;
    const qrContainer = document.getElementById("detalleQR");
    const timestamp = new Date().getTime();

    if (qrCode && qrCode !== '' && qrCode !== 'undefined' && qrCode !== 'null') {
      qrContainer.innerHTML = `<img src="src/storage/qr/${qrCode}?v=${timestamp}" width="120" alt="Código QR" onerror="this.parentElement.innerHTML='<p class="text-muted">Error al cargar QR</p>'">`;
    } else {
      qrContainer.innerHTML = '<p class="text-muted">No hay código QR disponible</p>';
    }

    $('#imprimirPaqueteModal').modal('show');
  }, 200);
}

$(document).on('click', '#btnImprimirSeleccionado', abrirModalImprimir);

$(document).on('hidden.bs.modal', '#imprimirPaqueteModal', function () {
  document.getElementById("detalleTracking").innerText = '-';
  document.getElementById("detalleCliente").innerText = '-';
  document.getElementById("detalleInstrumento").innerText = '-';
  document.getElementById("detalleCategoria").innerText = '-';
  document.getElementById("detalleSucursal").innerText = '-';
  document.getElementById("detalleCourier").innerText = '-';
  document.getElementById("detalleDescripcion").innerText = '-';
  document.getElementById("detallePeso").innerText = '-';
  document.getElementById("detalleQR").innerHTML = '';
  const detallePiezasElement = document.getElementById("detallePiezas");
  if (detallePiezasElement) detallePiezasElement.innerText = '-';
});

$(document).on('hidden.bs.modal', '#modalEtiqueta', function () {
  document.getElementById("etiquetaFrame").src = 'about:blank';
});

// ─── PREALERTA ─────────────────────────────────────────────────────────
function recargarTablaPrealerta() {
  recargarTablaGenerica('table.data-table', 'index.php?c=prealerta&a=index', 'edit-prealerta');
}

$(document).on('change', '.estado-select', function () {
  const $form = $(this).closest('form');
  const $campos = $form.find('.camposConsolidacion');
  const consolidado = $(this).val() === 'Consolidado';

  $campos.toggle(consolidado);
  $campos.find('select').prop('required', consolidado).val('');
});

$('#form-registrar-prealerta').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  if (!validarFormularioPrealerta($form)) return;

  const datos = new FormData(this);
  $.ajax({
    url: 'index.php?c=prealerta&a=registrar',
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      $('#prealertaModal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          limpiarFormulario($form);
          Swal.fire({ icon: 'success', title: 'Éxito', text: res.mensaje, timer: 1500, showConfirmButton: false });
          recargarTablaPrealerta();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.mensaje });
        }
      }, 300);
    },
    error: function () {
      Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo registrar la prealerta.' });
    }
  });
});

let datosOriginalesPrealerta = {};

$(document).on('show.bs.modal', '.modal[id^="edit-prealerta-"]', function () {
  const $form = $(this).find('.form-editar-prealerta');
  datosOriginalesPrealerta = {};
  $form.find('.campo-editable').each(function () {
    const name = $(this).attr('name');
    if (name) datosOriginalesPrealerta[name] = $(this).val();
  });
});

$(document).on('submit', '.form-editar-prealerta', function (e) {
  e.preventDefault();
  const $form = $(this);
  if (!validarFormularioPrealerta($form)) return;

  let hayCambios = false;
  $form.find('.campo-editable').each(function () {
    const name = $(this).attr('name');
    if (name && datosOriginalesPrealerta[name] !== $(this).val()) {
      hayCambios = true;
      return false;
    }
  });

  if (!hayCambios) {
    Swal.fire({ icon: 'info', title: 'Sin cambios', text: 'No se detectaron modificaciones en los datos.', timer: 2000, showConfirmButton: false });
    return;
  }

  const datos = new FormData(this);
  $.ajax({
    url: 'index.php?c=prealerta&a=editar',
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      $form.closest('.modal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          Swal.fire({ icon: 'success', title: 'Actualizado', text: res.mensaje, timer: 1500, showConfirmButton: false });
          recargarTablaPrealerta();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.mensaje });
        }
      }, 300);
    },
    error: function () {
      Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo actualizar la prealerta.' });
    }
  });
});

$(document).on('hidden.bs.modal', '.modal[id^="edit-prealerta-"]', function () {
  datosOriginalesPrealerta = {};
});

$('#form-eliminar-prealerta').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  $.ajax({
    url: 'index.php?c=prealerta&a=eliminar',
    type: 'POST',
    data: $form.serialize(),
    dataType: 'json',
    success: function (res) {
      $('#delete-prealerta-modal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          Swal.fire({ icon: 'success', title: 'Eliminado', text: res.mensaje, timer: 1500, showConfirmButton: false });
          recargarTablaPrealerta();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.mensaje });
        }
      }, 300);
    },
    error: function () {
      Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo eliminar la prealerta. Puede estar asociada a otros registros.' });
    }
  });
});

function setDeletePrealertaId(id) {
  $('#delete_prealerta_id').val(id);
}

// ─── SACA ──────────────────────────────────────────────────────────────
function recargarTablaSaca() {
  recargarTablaGenerica('#tablaSacas', 'index.php?c=saca&a=index', 'edit-saca-modal');
  $('input[name="selectSaca"]').prop('checked', false);
  $('#btnDetalle').prop('disabled', true);
  const btnImprimir = document.getElementById("btnImprimirSaca");
  if (btnImprimir) btnImprimir.disabled = true;
  inicializarRadiosSaca();
}

$('#formRegistrarSaca, form[action*="saca&a=registrar"]').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  const datos = new FormData(this);

  $.ajax({
    url: 'index.php?c=saca&a=registrar',
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      $('#sacaModal').modal('hide');
      setTimeout(() => {
        if (res.success) {
          limpiarFormulario($form);
          Swal.fire({ icon: 'success', title: 'Éxito', text: res.message, timer: 2000, showConfirmButton: false });
          recargarTablaSaca();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.message });
        }
      }, 300);
    },
    error: function (xhr) {
      let mensaje = 'No se pudo registrar la saca.';
      if (xhr.responseJSON?.message) mensaje = xhr.responseJSON.message;
      Swal.fire({ icon: 'error', title: 'Error', text: mensaje });
    }
  });
});

let datosOriginalesSaca = {};

$(document).on('show.bs.modal', '.modal[id^="edit-saca-modal-"]', function () {
  const $form = $(this).find('form');
  datosOriginalesSaca = {};
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name) datosOriginalesSaca[name] = $(this).val();
  });
});

$(document).on('submit', 'form[action*="saca&a=editar"]', function (e) {
  e.preventDefault();
  const $form = $(this);

  let hayCambios = false;
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name && datosOriginalesSaca[name] !== $(this).val()) {
      hayCambios = true;
      return false;
    }
  });

  if (!hayCambios) {
    Swal.fire({ icon: 'info', title: 'Sin cambios', text: 'No se detectaron modificaciones en los datos.', timer: 2000, showConfirmButton: false });
    return;
  }

  const datos = new FormData(this);
  $.ajax({
    url: 'index.php?c=saca&a=editar',
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      $form.closest('.modal').modal('hide');
      setTimeout(() => {
        if (res.success) {
          Swal.fire({ icon: 'success', title: 'Actualizado', text: res.message, timer: 1500, showConfirmButton: false });
          recargarTablaSaca();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.message });
        }
      }, 300);
    },
    error: function (xhr) {
      let mensaje = 'No se pudo actualizar la saca.';
      if (xhr.responseJSON?.message) mensaje = xhr.responseJSON.message;
      Swal.fire({ icon: 'error', title: 'Error', text: mensaje });
    }
  });
});

$(document).on('submit', 'form[action*="saca&a=eliminar"]', function (e) {
  e.preventDefault();
  const $form = $(this);

  Swal.fire({
    title: '¿Está seguro?',
    text: "¿Desea eliminar esta saca?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: 'index.php?c=saca&a=eliminar',
        type: 'POST',
        data: $form.serialize(),
        dataType: 'json',
        success: function (res) {
          if (res.success) {
            Swal.fire({ icon: 'success', title: 'Eliminado', text: res.message, timer: 1500, showConfirmButton: false });
            recargarTablaSaca();
          } else {
            Swal.fire({ icon: 'error', title: 'Error', text: res.message });
          }
        },
        error: function (xhr) {
          let mensaje = 'No se puede eliminar la saca porque está relacionada con otros registros.';
          if (xhr.responseJSON?.message) mensaje = xhr.responseJSON.message;
          Swal.fire({ icon: 'error', title: 'Error', text: mensaje });
        }
      });
    }
  });
});

function inicializarRadiosSaca() {
  const radios = document.querySelectorAll('input[name="selectSaca"]');
  const btnImprimir = document.getElementById("btnImprimirSaca");
  const btnDetalle = document.getElementById("btnDetalle");

  radios.forEach(radio => {
    const newRadio = radio.cloneNode(true);
    radio.parentNode.replaceChild(newRadio, radio);
  });

  document.querySelectorAll('input[name="selectSaca"]').forEach(radio => {
    radio.addEventListener("change", function () {
      const selected = document.querySelector('input[name="selectSaca"]:checked');
      if (btnImprimir) btnImprimir.disabled = !selected;
      if (btnDetalle) btnDetalle.disabled = !selected;
    });
  });

  if (btnImprimir) btnImprimir.disabled = !document.querySelector('input[name="selectSaca"]:checked');
  if (btnDetalle) btnDetalle.disabled = !document.querySelector('input[name="selectSaca"]:checked');
}

function abrirModalImprimirSaca() {
  const selected = document.querySelector('input[name="selectSaca"]:checked');
  if (!selected) {
    Swal.fire({ icon: 'warning', title: 'Atención', text: 'Debe seleccionar una saca.', timer: 2000, showConfirmButton: false });
    return;
  }

  const idSaca = selected.value;
  const timestamp = new Date().getTime();
  const qrUrl = `index.php?c=saca&a=generarQR&id=${idSaca}&t=${timestamp}`;
  const qrContainer = document.getElementById("detalleSacaQR");

  Swal.fire({
    title: 'Cargando...',
    allowOutsideClick: false,
    didOpen: () => Swal.showLoading()
  });

  $.ajax({
    url: `index.php?c=saca&a=obtenerDatosImpresion&id=${idSaca}`,
    type: 'GET',
    dataType: 'json',
    success: function (res) {
      Swal.close();
      if (res.success) {
        const data = res.data;
        document.getElementById("detalleSacaCodigo").innerText = data.Codigo_Saca || '-';
        document.getElementById("detalleSacaUsuario").innerText = data.Usuario || '-';
        document.getElementById("detalleSacaSucursal").innerText = data.Sucursal || '-';
        document.getElementById("detalleSacaEstado").innerText = data.Estado || '-';
        document.getElementById("detalleSacaPeso").innerText = data.Peso_Total || '-';
        document.getElementById("detalleSacaCantidad").innerText = data.Cantidad_Paquetes || '0';
        document.getElementById("detalleSacaFecha").innerText = data.Fecha_Creacion || '-';

        qrContainer.innerHTML = `<img src="${qrUrl}" width="120" alt="Código QR" onerror="this.parentElement.innerHTML='<p class=\\'text-muted\\'>Error al cargar QR</p>'">`;

        $('#imprimirSacaModal').modal('show');
      } else {
        Swal.fire({ icon: 'error', title: 'Error', text: res.message });
      }
    },
    error: function (xhr) {
      Swal.close();
      Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudieron cargar los datos de la saca.' });
    }
  });
}

$(document).on('click', '#btnImprimirSaca', abrirModalImprimirSaca);

$(document).on('hidden.bs.modal', '#imprimirSacaModal', function () {
  document.getElementById("detalleSacaCodigo").innerText = '-';
  document.getElementById("detalleSacaUsuario").innerText = '-';
  document.getElementById("detalleSacaSucursal").innerText = '-';
  document.getElementById("detalleSacaEstado").innerText = '-';
  document.getElementById("detalleSacaPeso").innerText = '-';
  document.getElementById("detalleSacaCantidad").innerText = '-';
  document.getElementById("detalleSacaFecha").innerText = '-';
  document.getElementById("detalleSacaQR").innerHTML = '';
});

// ─── SUCURSAL ──────────────────────────────────────────────────────────
function recargarTablaSucursal() {
  recargarTablaGenerica('#sucursalesTable', 'index.php?c=sucursal&a=index', 'edit-sucursal-modal');
}

$('#formRegistrarSucursal').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  const datos = new FormData(this);

  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      $('#sucursalModal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          limpiarFormulario($form);
          Swal.fire({ icon: 'success', title: 'Éxito', text: res.mensaje, timer: 1500, showConfirmButton: false });
          recargarTablaSucursal();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.mensaje });
        }
      }, 300);
    },
    error: function () {
      Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo registrar la sucursal.' });
    }
  });
});

let datosOriginalesSucursal = {};

$(document).on('show.bs.modal', '.modal[id^="edit-sucursal-modal"]', function () {
  const $form = $(this).find('form[id^="formEditarSucursal-"]');
  datosOriginalesSucursal = {};
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name) datosOriginalesSucursal[name] = $(this).val();
  });
});

$(document).on('submit', 'form[id^="formEditarSucursal-"]', function (e) {
  e.preventDefault();
  const $form = $(this);

  let hayCambios = false;
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name && datosOriginalesSucursal[name] !== $(this).val()) {
      hayCambios = true;
      return false;
    }
  });

  if (!hayCambios) {
    Swal.fire({ icon: 'info', title: 'Sin cambios', text: 'No se detectaron modificaciones en los datos.', timer: 2000, showConfirmButton: false });
    return;
  }

  const datos = new FormData(this);
  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: datos,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
      $form.closest('.modal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          Swal.fire({ icon: 'success', title: 'Actualizado', text: res.mensaje, timer: 1500, showConfirmButton: false });
          recargarTablaSucursal();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.mensaje });
        }
      }, 300);
    },
    error: function () {
      Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo actualizar la sucursal.' });
    }
  });
});

$(document).on('hidden.bs.modal', '.modal[id^="edit-sucursal-modal"]', function () {
  datosOriginalesSucursal = {};
});

$('#formEliminarSucursal').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);

  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: $form.serialize(),
    dataType: 'json',
    success: function (res) {
      $('#delete-sucursal-modal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          Swal.fire({ icon: 'success', title: 'Eliminado', text: res.mensaje, timer: 1500, showConfirmButton: false });
          recargarTablaSucursal();
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: res.mensaje });
        }
      }, 300);
    },
    error: function () {
      Swal.fire({ icon: 'error', title: 'Error', text: 'No se puede eliminar la sucursal porque está asociada a registros relacionados.' });
    }
  });
});

function setDeleteSucursalId(id) {
  $('#delete_sucursal_id').val(id);
}

// ─── TIENDA ────────────────────────────────────────────────────────────
function recargarTablaTienda() {
  recargarTablaGenerica('#tiendasTable', 'index.php?c=tienda&a=index', 'edit-tienda-modal');
}

function setDeleteTiendaId(id) {
  $('#delete_tienda_id').val(id);
}

$('#tiendaModal').on('hidden.bs.modal', function () {
  const $form = $('#formRegistrarTienda');
  $form[0].reset();
  $form.find('input').removeClass('is-valid is-invalid');
});

$(document).on('show.bs.modal', '[id^="edit-tienda-modal-"]', function () {
  const $form = $(this).find('form');
  $form.data('original', $form.serialize());
});

$('#formRegistrarTienda').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);

  if (!validarFormularioTienda($form)) {
    Swal.fire('Error', 'Corrige los campos inválidos', 'error');
    return;
  }

  $.ajax({
    url: 'index.php?c=tienda&a=registrar',
    type: 'POST',
    data: $form.serialize(),
    dataType: 'json',
    success: function (r) {
      $('#tiendaModal').modal('hide');
      Swal.fire({
        icon: r.estado === 'success' ? 'success' : 'error',
        title: r.estado === 'success' ? 'Éxito' : 'Error',
        text: r.mensaje,
        timer: r.estado === 'success' ? 1500 : 2500,
        showConfirmButton: r.estado !== 'success'
      });
      if (r.estado === 'success') {
        $form[0].reset();
        $form.find('input').removeClass('is-valid is-invalid');
        recargarTablaTienda();
      }
    },
    error: function () {
      Swal.fire('Error', 'No se pudo registrar la tienda.', 'error');
    }
  });
});

$(document).on('submit', '.formEditarTienda', function (e) {
  e.preventDefault();
  const $form = $(this);

  if (!validarFormularioTienda($form)) {
    Swal.fire('Error', 'Corrige los campos inválidos', 'error');
    return;
  }

  const original = $form.data('original');
  const actual = $form.serialize();
  if (original === actual) {
    Swal.fire({ icon: 'info', title: 'Sin cambios', text: 'No se detectaron modificaciones.' });
    return;
  }

  $.ajax({
    url: 'index.php?c=tienda&a=editar',
    type: 'POST',
    data: $form.serialize(),
    dataType: 'json',
    success: function (r) {
      const modal = $form.closest('.modal');
      modal.modal('hide');
      modal.one('hidden.bs.modal', function () {
        Swal.fire({
          icon: r.estado === 'success' ? 'success' : 'error',
          title: r.estado === 'success' ? 'Actualizado' : 'Error',
          text: r.mensaje,
          timer: r.estado === 'success' ? 1500 : 2500,
          showConfirmButton: r.estado !== 'success'
        });
        if (r.estado === 'success') recargarTablaTienda();
      });
    },
    error: function () {
      Swal.fire('Error', 'No se pudo actualizar la tienda.', 'error');
    }
  });
});

$('#formEliminarTienda').on('submit', function (e) {
  e.preventDefault();
  const id = $('#delete_tienda_id').val();

  if (!id) {
    Swal.fire('Error', 'ID de tienda no definido', 'error');
    return;
  }

  $.post('index.php?c=tienda&a=eliminar', { id_tienda: id }, function (respuesta) {
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
      recargarTablaTienda();
    } else {
      Swal.fire('Error', respuesta.mensaje, 'error');
    }
  }, 'json').fail(function () {
    Swal.fire('Error', 'No se pudo conectar con el servidor', 'error');
  });
});

// ─── TRACKING ──────────────────────────────────────────────────────────
$('#formBuscarTracking').on('submit', function (e) {
  e.preventDefault();
  const tracking = $('input[name="tracking"]').val().trim();
  if (!tracking) return;

  $.ajax({
    url: 'index.php?c=seguimiento&a=buscar',
    type: 'POST',
    data: { tracking },
    dataType: 'json',
    success: function (res) {
      let html = '';

      if (res.prealerta) {
        const p = res.prealerta;
        html += `
          <div class="card-box mb-30">
            <div class="pd-20">
              <h5 class="mb-3">Prealerta encontrada</h5>
              <div class="table-responsive">
                <table class="table table-striped">
                  <tr><th>Cliente:</th><td>${p.Nombres_Cliente} ${p.Apellidos_Cliente}</td></tr>
                  <tr><th>Tienda:</th><td>${p.Tienda_Nombre}</td></tr>
                  <tr><th>Piezas:</th><td>${p.Prealerta_Piezas}</td></tr>
                  <tr><th>Peso:</th><td>${p.Prealerta_Peso}</td></tr>
                  <tr><th>Descripción:</th><td>${p.Prealerta_Descripcion}</td></tr>
                  <tr><th>Estado:</th><td><span class="badge badge-primary">${p.Estado}</span></td></tr>
                </table>
              </div>
            </div>
          </div>`;
      } else if (res.paquete) {
        const p = res.paquete;
        html += `
          <div class="card-box mb-30">
            <div class="pd-20">
              <h5 class="mb-3">Paquete encontrado</h5>
              <div class="row">
                <div class="col-md-8 col-sm-12">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr><th>Cliente:</th><td>${p.Nombres_Cliente} ${p.Apellidos_Cliente}</td></tr>
                      <tr><th>Categoría:</th><td>${p.Categoria_Nombre}</td></tr>
                      <tr><th>Courier:</th><td>${p.Courier_Nombre}</td></tr>
                      <tr><th>Sucursal:</th><td>${p.Sucursal_Nombre}</td></tr>
                      <tr><th>Peso:</th><td>${p.Paquete_Peso}</td></tr>
                      <tr><th>Descripción:</th><td>${p.Prealerta_Descripcion}</td></tr>
                      <tr><th>Estado:</th><td><span class="badge badge-primary">${p.Estado}</span></td></tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12 text-center">
                  ${p.Qr_code ? `
                    <div class="border p-3 bg-light rounded">
                      <img src="src/storage/qr/${p.Qr_code}" class="img-fluid" style="max-width: 200px;">
                      <p class="mt-2 text-muted">Escanea este código</p>
                    </div>` : `
                    <div class="border p-3 bg-light rounded text-center">
                      <i class="dw dw-box-2" style="font-size: 5rem; color: #1845A2;"></i>
                      <p class="mt-2">Paquete registrado</p>
                    </div>`
                  }
                </div>
              </div>
            </div>
          </div>`;
      } else {
        html += `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            No se encontró ninguna prealerta o paquete con el código "${tracking}".
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>`;
      }

      $('#resultadoTracking').html(html);
    },
    error: function () {
      Swal.fire('Error', 'No se pudo buscar el tracking.', 'error');
    }
  });
});

// ─── USUARIO ───────────────────────────────────────────────────────────
function recargarTablaUsuario() {
  recargarTablaGenerica('#usuariosTable', 'index.php?c=usuario&a=index', 'edit-usuario-modal');
}

function setDeleteUsuarioId(id) {
  $('#delete_usuario_id').val(id);
}

$(document).on('click', '.toggle-password', function () {
  const input = $(this).siblings('input');
  const icon = $(this).find('i');
  const isPassword = input.attr('type') === 'password';
  input.attr('type', isPassword ? 'text' : 'password');
  icon.toggleClass('fa-eye fa-eye-slash');
});

$('#formRegistrarUsuario').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  const datos = $form.serialize();

  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: datos,
    dataType: 'json',
    success: function (res) {
      $('#usuarioModal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          limpiarFormulario($form);
          Swal.fire({ icon: 'success', title: 'Éxito', text: res.mensaje, timer: 1500, showConfirmButton: false });
          recargarTablaUsuario();
        } else {
          Swal.fire('Error', res.mensaje, 'error');
        }
      }, 300);
    },
    error: function () {
      Swal.fire('Error', 'No se pudo registrar el usuario.', 'error');
    }
  });
});

let datosOriginalesUsuario = {};

$(document).on('show.bs.modal', '.modal[id^="edit-usuario-modal"]', function () {
  const $form = $(this).find('form[id^="formEditarUsuario-"]');
  datosOriginalesUsuario = {};
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name) datosOriginalesUsuario[name] = $(this).val();
  });
});

$(document).on('submit', 'form[id^="formEditarUsuario-"]', function (e) {
  e.preventDefault();
  const $form = $(this);

  let hayCambios = false;
  $form.find('input, select, textarea').each(function () {
    const name = $(this).attr('name');
    if (name && datosOriginalesUsuario[name] !== $(this).val()) {
      hayCambios = true;
      return false;
    }
  });

  if (!hayCambios) {
    Swal.fire({ icon: 'info', title: 'Sin cambios', text: 'No se detectaron modificaciones en los datos.', timer: 2000, showConfirmButton: false });
    return;
  }

  const datos = $form.serialize();
  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: datos,
    dataType: 'json',
    success: function (res) {
      $form.closest('.modal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          Swal.fire({ icon: 'success', title: 'Actualizado', text: res.mensaje, timer: 1500, showConfirmButton: false });
          recargarTablaUsuario();
        } else {
          Swal.fire('Error', res.mensaje, 'error');
        }
      }, 300);
    },
    error: function () {
      Swal.fire('Error', 'No se pudo actualizar el usuario.', 'error');
    }
  });
});

$(document).on('hidden.bs.modal', '.modal[id^="edit-usuario-modal"]', function () {
  datosOriginalesUsuario = {};
  $(this).find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
  $(this).find('.invalid-feedback').remove();
});

$('#formEliminarUsuario').on('submit', function (e) {
  e.preventDefault();
  const $form = $(this);
  const datos = $form.serialize();

  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: datos,
    dataType: 'json',
    success: function (res) {
      $('#delete-usuario-modal').modal('hide');
      setTimeout(() => {
        if (res.estado === 'success') {
          Swal.fire({ icon: 'success', title: 'Eliminado', text: res.mensaje, timer: 1500, showConfirmButton: false });
          recargarTablaUsuario();
        } else {
          Swal.fire('Error', res.mensaje, 'error');
        }
      }, 300);
    },
    error: function () {
      Swal.fire('Error', 'No se pudo eliminar el usuario.', 'error');
    }
  });
});

$(document).on('hidden.bs.modal', '#usuarioModal', function () {
  const $form = $('#formRegistrarUsuario');
  limpiarFormulario($form);
});
});