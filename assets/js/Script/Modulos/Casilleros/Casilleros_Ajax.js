function setDeleteId(id) {
            document.getElementById('delete_casillero_id').value = id;
        }
 // ============================================================
            // RECARGAR TABLA DINÁMICAMENTE (ESTILO CARGO)
            // ============================================================
            function recargarTabla() {
                if ($.fn.DataTable.isDataTable('#casillerosTable')) {
                    $('#casillerosTable').DataTable().destroy();
                }

                $.ajax({
                    url: 'index.php?c=casillero&a=index',
                    type: 'GET',
                    success: function(html) {
                        const nuevoTbody = $(html).find('#casillerosTable tbody').html();
                        const nuevosModales = $(html).find('.modal.fade[id^="edit-casillero-modal"]');

                        $('#casillerosTable tbody').html(nuevoTbody);

                        $('.modal.fade[id^="edit-casillero-modal"]').remove();
                        $('body').append(nuevosModales);

                        $('#casillerosTable').DataTable({
                            destroy: true,
                            responsive: true,
                            autoWidth: false,
                            language: {
                                url: 'assets/Temple/src/plugins/datatables/js/es_es.json'
                            },
                            columnDefs: [
                                { targets: 'datatable-nosort', orderable: false }
                            ]
                        });

                        $('.table-actions a').each(function() {
                            const color = $(this).data('color');
                            if (color) $(this).find('i').css('color', color);
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo recargar la lista de casilleros.', 'error');
                    }
                });
            }

            // ============================================================
            // LIMPIEZA GLOBAL DE BACKDROPS
            // ============================================================
            $(document).on('hidden.bs.modal', '.modal', function() {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });
      

            // ============================================================
            // LIMPIEZA AL CERRAR MODAL DE REGISTRO
            // ============================================================
            $('#casilleroModal').on('hidden.bs.modal', function() {
                const $form = $('#formRegistrarCasillero');
                $form[0].reset();
                $form.find('input').each(function() {
                    clearValidation($(this));
                });
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            });

            // ============================================================
            // GUARDAR VALORES ORIGINALES AL ABRIR MODAL EDICIÓN
            // ============================================================
            $(document).on('show.bs.modal', '[id^="edit-casillero-modal-"]', function() {
                const $modal = $(this);
                $modal.find('input[name="Casillero_Nombre"]').data('original', $modal.find('input[name="Casillero_Nombre"]').val().trim());
                $modal.find('input[name="Direccion"]').data('original', $modal.find('input[name="Direccion"]').val().trim());
            });

            // ============================================================
            // SUBMIT: REGISTRAR CASILLERO
            // ============================================================
            $('#formRegistrarCasillero').on('submit', function(e) {
                e.preventDefault();
                const $form = $(this);

                const $nombre = $form.find('input[name="Casillero_Nombre"]');
                const $direccion = $form.find('input[name="Direccion"]');
                const nombre = $nombre.val().trim();
                const direccion = $direccion.val().trim();

                const rNombre = validarNombreCampo(nombre);
                const rDir = validarDireccionCampo(direccion);

                if (!rNombre.ok) markInvalid($nombre, rNombre.msg);
                else markValid($nombre);
                if (!rDir.ok) markInvalid($direccion, rDir.msg);
                else markValid($direccion);

                if ($form.find('.is-invalid').length) {
                    firstInvalidFocus($form);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Corrige los errores',
                        text: 'Revisa los campos marcados.',
                        confirmButtonText: 'Entendido'
                    });
                    return;
                }

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function(r) {
                        $('#casilleroModal').modal('hide');
                        
                        Swal.fire({
                            icon: r.estado === 'success' ? 'success' : 'error',
                            title: r.estado === 'success' ? 'Éxito' : 'Error',
                            text: r.mensaje,
                            timer: r.estado === 'success' ? 1500 : 2500,
                            showConfirmButton: r.estado !== 'success'
                        });

                        if (r.estado === 'success') {
                            $form[0].reset();
                            $form.find('input').each(function() {
                                clearValidation($(this));
                            });
                            recargarTabla();
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo registrar el casillero.', 'error');
                    }
                });
            });

            // ============================================================
            // SUBMIT: EDITAR CASILLERO
            // ============================================================
            $(document).on('submit', '.formEditarCasillero', function(e) {
                e.preventDefault();
                const $form = $(this);

                const $nombre = $form.find('input[name="Casillero_Nombre"]');
                const $direccion = $form.find('input[name="Direccion"]');
                const nombreOriginal = $nombre.data('original');
                const direccionOriginal = $direccion.data('original');
                const nombreActual = $nombre.val().trim();
                const direccionActual = $direccion.val().trim();

                // Verificar si hay cambios
                if (nombreOriginal === nombreActual && direccionOriginal === direccionActual) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Sin cambios',
                        text: 'No se han realizado modificaciones.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return;
                }

                const rNombre = validarNombreCampo(nombreActual);
                const rDir = validarDireccionCampo(direccionActual);

                if (!rNombre.ok) markInvalid($nombre, rNombre.msg);
                else markValid($nombre);
                if (!rDir.ok) markInvalid($direccion, rDir.msg);
                else markValid($direccion);

                if ($form.find('.is-invalid').length) {
                    firstInvalidFocus($form);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Corrige los errores',
                        text: 'Revisa los campos marcados.',
                        confirmButtonText: 'Entendido'
                    });
                    return;
                }

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function(r) {
                        const modal = $form.closest('.modal');
                        modal.modal('hide');

                        modal.off('hidden.bs.modal').on('hidden.bs.modal', function() {
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');

                            let icon = r.estado === 'success' ? 'success' : 'error';
                            Swal.fire({
                                icon: icon,
                                title: icon === 'success' ? 'Actualizado' : 'Error',
                                text: r.mensaje,
                                timer: icon === 'success' ? 1500 : 2500,
                                showConfirmButton: icon !== 'success'
                            });

                            if (r.estado === 'success') recargarTabla();
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo actualizar el casillero.', 'error');
                    }
                });
            });

            // ============================================================
            // SUBMIT: ELIMINAR CASILLERO
            // ============================================================
            $('#formEliminarCasillero').on('submit', function(e) {
                e.preventDefault();
                const datos = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: datos,
                    dataType: 'json',
                    success: function(r) {
                        $('#delete-casillero-modal').modal('hide');
                        $('#delete-casillero-modal').one('hidden.bs.modal', function() {
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');

                            let icon = r.estado === 'success' ? 'success' : 'error';
                            Swal.fire({
                                icon: icon,
                                title: icon === 'success' ? 'Eliminado' : 'Error',
                                text: r.mensaje,
                                timer: icon === 'success' ? 1500 : 2500,
                                showConfirmButton: icon !== 'success'
                            });

                            if (r.estado === 'success') recargarTabla();
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo eliminar el casillero.', 'error');
                    }
                });
            });

           