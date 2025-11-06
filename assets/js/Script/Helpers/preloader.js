// ─── PRELOADER Y CAMBIO DE ESTADO DE CARGA ─────────────────────────────
window.addEventListener("load", () => {
  // Ocultar el preloader visual
  const preloader = document.getElementById('preloader');
  const tiempoDeEspera = 500;

  setTimeout(() => {
    if (preloader) {
      preloader.style.display = 'none';
    }

    // Cambiar clases del body
    document.body.classList.remove("loading");
    document.body.classList.add("loaded");
  }, tiempoDeEspera);
});
