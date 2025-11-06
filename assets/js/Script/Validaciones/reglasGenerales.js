function validarNombreCampo(value) {
  const regexNombre = /^[A-Za-z0-9\sáéíóúÁÉÍÓÚñÑ.,\-()]{3,50}$/;
  if (value === '') return { ok: false, msg: 'El nombre es obligatorio.' };
  if (value.length < 3) return { ok: false, msg: 'Mínimo 3 caracteres.' };
  if (value.length > 50) return { ok: false, msg: 'Máximo 50 caracteres.' };
  if (!regexNombre.test(value)) return { ok: false, msg: 'Solo letras, números y (,.-()).' };
  return { ok: true, msg: '' };
}

function validarDireccionCampo(value) {
  if (value === '') return { ok: false, msg: 'La dirección es obligatoria.' };
  if (value.length < 5) return { ok: false, msg: 'Mínimo 5 caracteres.' };
  if (value.length > 100) return { ok: false, msg: 'Máximo 100 caracteres.' };
  return { ok: true, msg: '' };
}

