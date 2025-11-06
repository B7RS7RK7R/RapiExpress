function enviarFormularioAjax($form, onSuccess, onError) {
  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: $form.serialize(),
    dataType: 'json',
    success: onSuccess,
    error: onError || function () {
      Swal.fire('Error', 'No se pudo completar la operación.', 'error');
    }
  });
}

function mostrarAlerta(r) {
  const icon = r.estado === 'success' ? 'success' :
               r.estado === 'error' ? 'error' :
               r.estado === 'warning' ? 'warning' : 'info';

  Swal.fire({
    icon: icon,
    title: icon === 'success' ? 'Éxito' :
           icon === 'error' ? 'Error' :
           icon === 'warning' ? 'Advertencia' : 'Información',
    text: r.mensaje,
    timer: icon === 'success' ? 1500 : 2500,
    showConfirmButton: icon !== 'success'
  });
}
