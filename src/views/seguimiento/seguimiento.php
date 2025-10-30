<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seguimiento RapiExpress</title>
    <link rel="icon" href="assets/img/logo-rapi.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    <!-- Fonts y estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    
    <!-- Scripts -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
</head>
<body>
    <?php include 'src\views\partels\barras.php'; ?>
    <div class="mobile-menu-overlay"></div>
    <div class="main-container">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Seguimiento de Paquetes</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php?c=dashboard&a=index">RapiExpress</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Seguimiento</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">Buscar Paquete o Prealerta</h4>
        <?php include 'src/views/partels/notificaciones.php'; ?>
        
        <form id="formBuscarTracking" class="mt-3">
            <div class="row">
                <div class="col-md-10 col-sm-12">
                    <input type="text" name="tracking" class="form-control" placeholder="Ingrese código de tracking" required>
                </div>
                <div class="col-md-2 col-sm-12">
                    <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Contenedor para resultados -->
<div id="resultadoTracking"></div>

        
    </div>

    <script>
$(document).ready(function() {

    $('#formBuscarTracking').on('submit', function(e) {
        e.preventDefault();
        const tracking = $('input[name="tracking"]').val().trim();

        if (!tracking) return;

        $.ajax({
            url: 'index.php?c=seguimiento&a=buscar',
            type: 'POST',
            data: { tracking },
            dataType: 'json',
            success: function(respuesta) {
                let html = '';

                if (respuesta.prealerta) {
                    html += `
                        <div class="card-box mb-30">
                            <div class="pd-20">
                                <h5 class="mb-3">Prealerta encontrada</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr><th>Cliente:</th><td>${respuesta.prealerta.Nombres_Cliente} ${respuesta.prealerta.Apellidos_Cliente}</td></tr>
                                        <tr><th>Tienda:</th><td>${respuesta.prealerta.Tienda_Nombre}</td></tr>
                                        <tr><th>Piezas:</th><td>${respuesta.prealerta.Prealerta_Piezas}</td></tr>
                                        <tr><th>Peso:</th><td>${respuesta.prealerta.Prealerta_Peso}</td></tr>
                                        <tr><th>Descripción:</th><td>${respuesta.prealerta.Prealerta_Descripcion}</td></tr>
                                        <tr><th>Estado:</th><td><span class="badge badge-primary">${respuesta.prealerta.Estado}</span></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>`;
                } else if (respuesta.paquete) {
                    html += `
                        <div class="card-box mb-30">
                            <div class="pd-20">
                                <h5 class="mb-3">Paquete encontrado</h5>
                                <div class="row">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tr><th>Cliente:</th><td>${respuesta.paquete.Nombres_Cliente} ${respuesta.paquete.Apellidos_Cliente}</td></tr>
                                                <tr><th>Categoría:</th><td>${respuesta.paquete.Categoria_Nombre}</td></tr>
                                                <tr><th>Courier:</th><td>${respuesta.paquete.Courier_Nombre}</td></tr>
                                                <tr><th>Sucursal:</th><td>${respuesta.paquete.Sucursal_Nombre}</td></tr>
                                                <tr><th>Peso:</th><td>${respuesta.paquete.Paquete_Peso}</td></tr>
                                                <tr><th>Descripción:</th><td>${respuesta.paquete.Prealerta_Descripcion}</td></tr>
                                                <tr><th>Estado:</th><td><span class="badge badge-primary">${respuesta.paquete.Estado}</span></td></tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 text-center">
                                        ${respuesta.paquete.Qr_code ? 
                                            `<div class="border p-3 bg-light rounded">
                                                <img src="src/storage/qr/${respuesta.paquete.Qr_code}" class="img-fluid" style="max-width: 200px;">
                                                <p class="mt-2 text-muted">Escanea este código</p>
                                            </div>` :
                                            `<div class="border p-3 bg-light rounded text-center">
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
            error: function() {
                Swal.fire('Error', 'No se pudo buscar el tracking.', 'error');
            }
        });
    });

});
</script>

</body>
</html>