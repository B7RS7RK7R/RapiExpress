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

function aplicarValidacion($input, resultado) {
  if (!resultado.ok) markInvalid($input, resultado.msg);
  else markValid($input);
}
