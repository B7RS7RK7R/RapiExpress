<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>RapiExpress - Sacas</title>
    <link rel="icon" href="assets/img/logo-rapi.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Aquí incluir CSS y JS de Bootstrap, DataTables y SweetAlert -->
</head>

<body>

    <?php include 'src/views/partels/barras.php'; ?>

    <div class="mobile-menu-overlay"></div>
    <div class="main-container">

        <!-- Encabezado de página -->
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Sacas</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php?c=dashboard">RapiExpress</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sacas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Lista de Sacas -->
        <div class="card-box mb-30">
            <div class="pd-30 d-flex justify-content-between align-items-center">
                <h4 class="text-blue h4">Lista de Sacas</h4>

                <div>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sacaModal">
                        <i class="fa fa-plus"></i> Agregar Saca
                    </button>

                    <!-- Botón para ir al detalle (inicialmente deshabilitado) -->
                    <button id="btnDetalle" class="btn btn-info btn-sm" disabled>
                        <i class="fa fa-eye"></i> Ver Detalle
                    </button>
                </div>
            </div>

            <?php include 'src/views/partels/notificaciones.php'; ?>

            <div class="pb-30">
                <table id="tablaSacas" class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th></th> <!-- columna para selección -->
                            <th>ID</th>
                            <th>Código</th>
                            <th>Usuario</th>
                            <th>Sucursal</th>
                            <th>Estado</th>
                            <th>Peso Total</th>
                            <th class="datatable-nosort">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sacas as $saca): ?>
                            <tr>
                                <td>
                                    <input type="radio" name="selectSaca" value="<?= $saca['ID_Saca'] ?>">
                                </td>

                                <td><?= $saca['ID_Saca'] ?></td>
                                <td><?= htmlspecialchars($saca['Codigo_Saca']) ?></td>
                                <td><?= htmlspecialchars($saca['Nombres_Usuario'] ?? 'Sin asignar') ?></td>
                                <td><?= htmlspecialchars($saca['Sucursal_Nombre'] ?? 'Sin asignar') ?></td>
                                <td><?= htmlspecialchars($saca['Estado']) ?></td>
                                <td><?= htmlspecialchars($saca['Peso_Total']) ?></td>
                              <td>
    <div class="table-actions">
        <!-- Botón QR -->
        <a href="index.php?c=saca&a=generarQR&id=<?= $saca['ID_Saca'] ?>"
            class="btn btn-sm btn-primary"
            title="Generar QR">
            <i class="bi bi-qr-code"></i>
        </a>

        <!-- Botón Editar -->
        <a href="#"
            data-color="#265ed7"
            data-toggle="modal"
            data-target="#edit-saca-modal-<?= $saca['ID_Saca'] ?>"
            title="Editar">
            <i class="icon-copy dw dw-edit2"></i>
        </a>

        <!-- Botón Eliminar -->
        <form method="POST" action="index.php?c=saca&a=eliminar" style="display:inline-block; margin:0;">
            <input type="hidden" name="ID_Saca" value="<?= $saca['ID_Saca'] ?>">
            <button type="submit"
                class="btn btn-link p-0"
                style="color:#e95959;"
                onclick="return confirm('¿Desea eliminar esta saca?')"
                title="Eliminar">
                <i class="icon-copy dw dw-delete-3"></i>
            </button>
        </form>
    </div>
</td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Registrar Saca -->
        <div class="modal fade" id="sacaModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" action="index.php?c=saca&a=registrar" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Nueva Saca</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <label>Código de Saca</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($codigoSaca) ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Usuario</label>
                            <select name="ID_Usuario" class="form-control" required>
                                <option value="">Seleccione usuario</option>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <option value="<?= $usuario['ID_Usuario'] ?>">
                                        <?= htmlspecialchars($usuario['Nombres_Usuario'] . ' ' . $usuario['Apellidos_Usuario']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label>Sucursal</label>
                            <select name="ID_Sucursal" class="form-control" required>
                                <option value="">Seleccione sucursal</option>
                                <?php foreach ($sucursales as $sucursal): ?>
                                    <option value="<?= $sucursal['ID_Sucursal'] ?>"><?= htmlspecialchars($sucursal['Sucursal_Nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label>Estado</label>
                            <select name="Estado" class="form-control">
                                <option value="Pendiente">Pendiente</option>
                                <option value="En tránsito">En tránsito</option>
                                <option value="Entregada">Entregada</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label>Peso Total</label>
                            <input type="number" step="0.01" name="Peso_Total" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Registrar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modales Editar -->
        <?php foreach ($sacas as $saca): ?>
            <div class="modal fade" id="edit-saca-modal-<?= $saca['ID_Saca'] ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <form method="POST" action="index.php?c=saca&a=editar" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Saca</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body row">
                            <input type="hidden" name="ID_Saca" value="<?= $saca['ID_Saca'] ?>">

                            <!-- 🔹 Campo de Código de Saca (ahora visible y readonly) -->
                            <div class="col-md-6">
                                <label>Código de Saca</label>
                                <input type="text" name="Codigo_Saca" class="form-control"
                                    value="<?= htmlspecialchars($saca['Codigo_Saca']) ?>" readonly>
                            </div>

                            <div class="col-md-6">
                                <label>Usuario</label>
                                <select name="ID_Usuario" class="form-control" required>
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <option value="<?= $usuario['ID_Usuario'] ?>"
                                            <?= $usuario['ID_Usuario'] == $saca['ID_Usuario'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($usuario['Nombres_Usuario'] . ' ' . $usuario['Apellidos_Usuario']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label>Sucursal</label>
                                <select name="ID_Sucursal" class="form-control" required>
                                    <?php foreach ($sucursales as $sucursal): ?>
                                        <option value="<?= $sucursal['ID_Sucursal'] ?>"
                                            <?= $sucursal['ID_Sucursal'] == $saca['ID_Sucursal'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($sucursal['Sucursal_Nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label>Estado</label>
                                <select name="Estado" class="form-control">
                                    <option value="Pendiente" <?= $saca['Estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                    <option value="En tránsito" <?= $saca['Estado'] == 'En tránsito' ? 'selected' : '' ?>>En tránsito</option>
                                    <option value="Entregada" <?= $saca['Estado'] == 'Entregada' ? 'selected' : '' ?>>Entregada</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label>Peso Total</label>
                                <input type="number" step="0.01" name="Peso_Total" class="form-control"
                                    value="<?= $saca['Peso_Total'] ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" type="submit">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>



    </div>

    <script>
        // Script para activar el botón "Ver Detalle"
        let selectedSaca = null;

        document.querySelectorAll('input[name="selectSaca"]').forEach(radio => {
            radio.addEventListener('change', function() {
                selectedSaca = this.value;
                document.getElementById('btnDetalle').disabled = false;
            });
        });

        document.getElementById('btnDetalle').addEventListener('click', function() {
            if (selectedSaca) {
                window.location.href = `index.php?c=detallesaca&a=index&id=${selectedSaca}`;
            }
        });
    </script>

</body>

</html>