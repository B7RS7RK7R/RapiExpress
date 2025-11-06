// ─── VALIDACIÓN DE CASILLEROS ──────────────────────────────────────────
function setDeleteId(id) {
  document.getElementById('delete_casillero_id').value = id;
}

// ─── HELPERS DE VALIDACIÓN ─────────────────────────────────────────────
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

// ─── REGLAS DE VALIDACIÓN ──────────────────────────────────────────────
const regexNombre = /^[A-Za-z0-9\sáéíóúÁÉÍÓÚñÑ.,\-()]{3,50}$/;

function validarNombreCampo(value) {
  if (value === '') return { ok: false, msg: 'El nombre es obligatorio.' };
  if (value.length < 3) return { ok: false, msg: 'Mínimo 3 caracteres.' };
  if (value.length > 50) return { ok: false, msg: 'Máximo 50 caracteres.' };
  if (!regexNombre.test(value)) return { ok: false, msg: 'Solo letras, números y (,.-()). 3-50 caracteres.' };
  return { ok: true, msg: '' };
}

function validarDireccionCampo(value) {
  if (value === '') return { ok: false, msg: 'La dirección es obligatoria.' };
  if (value.length < 5) return { ok: false, msg: 'La dirección debe tener al menos 5 caracteres.' };
  if (value.length > 100) return { ok: false, msg: 'Máximo 100 caracteres.' };
  return { ok: true, msg: '' };
}

// ─── VALIDACIÓN EN TIEMPO REAL ─────────────────────────────────────────
$(document).on('input', 'input[name="Casillero_Nombre"]', function () {
  const $this = $(this);
  const res = validarNombreCampo($this.val().trim());
  !res.ok ? markInvalid($this, res.msg) : markValid($this);
});

$(document).on('input', 'input[name="Direccion"]', function () {
  const $this = $(this);
  const res = validarDireccionCampo($this.val().trim());
  !res.ok ? markInvalid($this, res.msg) : markValid($this);
});

// ─── LIMPIEZA DE MODALES ───────────────────────────────────────────────
$('#casilleroModal').on('hidden.bs.modal', function () {
  const $form = $('#formRegistrarCasillero');
  $form[0].reset();
  $form.find('input').each(function () { clearValidation($(this)); });
  $('.modal-backdrop').remove();
});

$('[id^="edit-casillero-modal"]').on('hidden.bs.modal', function () {
  const $form = $(this).find('.formEditarCasillero');
  $form.find('input[type="text"]').each(function () { clearValidation($(this)); });
  $('.modal-backdrop').remove();
});
