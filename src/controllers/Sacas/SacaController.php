<?php
use RapiExpress\Models\Saca;
use RapiExpress\Models\Usuario;
use RapiExpress\Models\Sucursal;
use RapiExpress\Models\Paquete;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;



function saca_index() {
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php');
        exit();
    }
    

    $sacaModel = new Saca();
    $sacas = $sacaModel->obtenerTodas();
        // Cargar usuarios y sucursales para los selects
    $usuarioModel = new Usuario();
    $usuarios = $usuarioModel->obtenerTodos(); // función en Usuario.php que devuelve array

    $sucursalModel = new Sucursal();
    $sucursales = $sucursalModel->obtenerTodas();
$paqueteModel = new Paquete();
$paquetesDisponibles = $paqueteModel->obtenerSinSaca();

     // Generar código de saca para mostrar en el modal de registro
    $codigoSaca = $sacaModel->generarCodigo();
    include __DIR__ . '/../../views/saca/saca.php';
}

function saca_registrar() {
    $sacaModel = new Saca();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $codigoGenerado = $sacaModel->generarCodigo();

        $data = [
            'Codigo_Saca' => $codigoGenerado,
            'ID_Usuario'  => (int)$_POST['ID_Usuario'],
            'ID_Sucursal' => (int)$_POST['ID_Sucursal'],
            'Estado'      => $_POST['Estado'] ?? 'Pendiente',
            'Peso_Total'  => $_POST['Peso_Total'] ?? 0
        ];
        $resultado = $sacaModel->registrar($data);

        switch ($resultado) {
            case 'registro_exitoso':
                $_SESSION['mensaje'] = 'Saca registrada exitosamente. Código: '.$codigoGenerado;
                $_SESSION['tipo_mensaje'] = 'success';
                break;
            default:
                $_SESSION['mensaje'] = 'Error al registrar saca';
                $_SESSION['tipo_mensaje'] = 'error';
        }
        header('Location: index.php?c=saca');
        exit();
    }
}


function saca_editar() {
    $sacaModel = new Saca();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$data = [
    'ID_Saca'     => (int)$_POST['ID_Saca'],
    'Codigo_Saca' => $_POST['Codigo_Saca'], // <--- agregado
    'ID_Usuario'  => (int)$_POST['ID_Usuario'],
    'ID_Sucursal' => (int)$_POST['ID_Sucursal'],
    'Estado'      => $_POST['Estado'] ?? 'Pendiente',
    'Peso_Total'  => $_POST['Peso_Total'] ?? 0
];


        $resultado = $sacaModel->actualizar($data);

        switch ($resultado) {
            case true:
                $_SESSION['mensaje'] = 'Saca actualizada exitosamente';
                $_SESSION['tipo_mensaje'] = 'success';
                break;
            case 'codigo_duplicado':
                $_SESSION['mensaje'] = 'El código de saca ya existe';
                $_SESSION['tipo_mensaje'] = 'error';
                break;
            default:
                $_SESSION['mensaje'] = 'Error al actualizar saca';
                $_SESSION['tipo_mensaje'] = 'error';
        }
        header('Location: index.php?c=saca');
        exit();
    }
}

function saca_eliminar() {
    $sacaModel = new Saca();
    $id = $_POST['ID_Saca'];

    $resultado = $sacaModel->eliminar($id);

    if ($resultado === true) {
        $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Saca eliminada correctamente.'];
    } elseif ($resultado === 'saca_con_paquetes') {
        $_SESSION['mensaje'] = ['tipo' => 'warning', 'texto' => 'No se puede eliminar la saca, tiene paquetes relacionados.'];
    } else {
        $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Error al eliminar la saca.'];
    }

    header('Location: index.php?c=saca&a=index');
}


function saca_obtenerSaca() {
    $sacaModel = new Saca();
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int)$_GET['id'];
        $saca = $sacaModel->obtenerPorId($id);
        header('Content-Type: application/json');
        echo json_encode($saca);
        exit();
    }


}function saca_generarQR() {
    if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'ID de saca no válido'];
        header('Location: index.php?c=saca');
        exit();
    }

    $idSaca = (int)$_GET['id'];
    $sacaModel = new Saca();
    $saca = $sacaModel->obtenerPorId($idSaca);

    if (!$saca) {
        $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Saca no encontrada'];
        header('Location: index.php?c=saca');
        exit();
    }

    // 🔹 Obtener información adicional
    $usuarioModel  = new Usuario();
    $sucursalModel = new Sucursal();
    $detalleModel  =  new \RapiExpress\Models\DetalleSaca();

    $usuario = $usuarioModel->obtenerPorId($saca['ID_Usuario']);
    $sucursal = $sucursalModel->obtenerPorId($saca['ID_Sucursal']);
    $paquetes = $detalleModel->obtenerPorSaca($idSaca);
    $cantidadPaquetes = count($paquetes);

    // 🔹 Generar el QR
    $qrPath = generar_qr_code('saca', [
        'Codigo_Saca' => $saca['Codigo_Saca'],
        'Usuario' => $usuario['Nombres_Usuario'] . ' ' . $usuario['Apellidos_Usuario'],
        'Sucursal' => $sucursal['Sucursal_Nombre'],
        'Cantidad_Paquetes' => $cantidadPaquetes,
        'Peso_Total' => $saca['Peso_Total'],
        'Fecha_Creacion' => $saca['Fecha_Creacion'] ?? date('Y-m-d H:i:s')
    ], 'src/storage/sacaqr/');

    // 🔹 Mostrar el QR directamente
    header('Content-Type: image/png');
    readfile($qrPath);
    exit;
}
