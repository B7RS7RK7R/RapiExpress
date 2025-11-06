function recargarTablaGenerica(selector, url, modalPrefix) {
  if ($.fn.DataTable.isDataTable(selector)) {
    $(selector).DataTable().destroy();
  }

  $.ajax({
    url: url,
    type: 'GET',
    success: function (html) {
      const nuevoTbody = $(html).find(`${selector} tbody`).html();
      const nuevosModales = $(html).find(`.modal.fade[id^="${modalPrefix}"]`);

      $(`${selector} tbody`).html(nuevoTbody);
      $(`.modal.fade[id^="${modalPrefix}"]`).remove();
      $('body').append(nuevosModales);

      $(selector).DataTable({
        responsive: true,
        autoWidth: false,
        language: {
          url: 'assets/Temple/src/plugins/datatables/js/es_es.json'
        },
        columnDefs: [{ targets: 'datatable-nosort', orderable: false }]
      });

      $('.table-actions a').each(function () {
        const color = $(this).data('color');
        if (color) $(this).find('i').css('color', color);
      });
    },
    error: function () {
      Swal.fire('Error', 'No se pudo recargar la tabla.', 'error');
    }
  });
}
