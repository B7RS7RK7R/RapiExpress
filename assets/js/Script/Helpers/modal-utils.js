function limpiarBackdropGlobal() {
  $('body').removeClass('modal-open');
  $('.modal-backdrop').remove();
}

function limpiarFormulario($form) {
  $form[0].reset();
  $form.find('input').each(function () {
    clearValidation($(this));
  });
}
