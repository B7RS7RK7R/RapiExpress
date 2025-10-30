<?php
use RapiExpress\Models\Casillero;
use RapiExpress\Helpers\Lang;

function casillero_index() {
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php');
        exit();
    }

    $casilleroModel = new Casillero();
    $casilleros = $casilleroModel->obtenerTodos();
    include __DIR__ . '/../../views/casillero/casillero.php';
}

function casillero_registrar() {
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Método no permitido']);
        exit();
    }

    $casilleroModel = new Casillero();
    $data = [
        'Casillero_Nombre' => trim($_POST['Casillero_Nombre'] ?? ''),
        'Direccion' => trim($_POST['Direccion'] ?? '')
    ];

    $resultado = $casilleroModel->registrar($data);

    switch ($resultado) {
        case 'registro_exitoso':
            $respuesta = ['estado' => 'success', 'mensaje' => 'Casillero registrado correctamente.'];
            break;
        case 'casillero_existente':
            $respuesta = ['estado' => 'info', 'mensaje' => 'El nombre del casillero ya está en uso.'];
            break;
        case 'campos_vacios':
            $respuesta = ['estado' => 'warning', 'mensaje' => 'Todos los campos son obligatorios.'];
            break;
        case 'nombre_invalido':
            $respuesta = ['estado' => 'warning', 'mensaje' => 'El nombre del casillero contiene caracteres inválidos.'];
            break;
        case 'direccion_invalida':
            $respuesta = ['estado' => 'warning', 'mensaje' => 'La dirección no cumple con el formato permitido.'];
            break;
        default:
            $respuesta = ['estado' => 'error', 'mensaje' => 'Error al registrar el casillero.'];
    }

    echo json_encode($respuesta);
}

function casillero_editar() {
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Método no permitido']);
        exit();
    }

    $casilleroModel = new Casillero();
    $data = [
        'ID_Casillero' => intval($_POST['ID_Casillero'] ?? 0),
        'Casillero_Nombre' => trim($_POST['Casillero_Nombre'] ?? ''),
        'Direccion' => trim($_POST['Direccion'] ?? '')
    ];

    $resultado = $casilleroModel->actualizar($data);

    switch ($resultado) {
        case 'actualizacion_exitosa':
            $respuesta = ['estado' => 'success', 'mensaje' => 'Casillero actualizado correctamente.'];
            break;
        case 'sin_cambios':
            $respuesta = ['estado' => 'info', 'mensaje' => 'No se realizaron cambios.'];
            break;
        case 'casillero_existente':
            $respuesta = ['estado' => 'warning', 'mensaje' => 'Ya existe un casillero con ese nombre.'];
            break;
        case 'nombre_invalido':
            $respuesta = ['estado' => 'warning', 'mensaje' => 'El nombre no cumple con el formato.'];
            break;
        case 'direccion_invalida':
            $respuesta = ['estado' => 'warning', 'mensaje' => 'La dirección no cumple con el formato.'];
            break;
        default:
            $respuesta = ['estado' => 'error', 'mensaje' => 'Error al actualizar el casillero.'];
    }

    echo json_encode($respuesta);
}

function casillero_eliminar() {
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Método no permitido']);
        exit();
    }

    $casilleroModel = new Casillero();
    $id = intval($_POST['ID_Casillero'] ?? 0);

    if ($id <= 0) {
        echo json_encode(['estado' => 'error', 'mensaje' => 'ID de casillero inválido.']);
        exit();
    }

    $resultado = $casilleroModel->eliminar($id);

    switch ($resultado) {
        case 'eliminado':
            $respuesta = ['estado' => 'success', 'mensaje' => 'Casillero eliminado correctamente.'];
            break;
        case 'no_existente':
            $respuesta = ['estado' => 'warning', 'mensaje' => 'El casillero no existe.'];
            break;
        case 'casillero_asignado':
            $respuesta = [
                'estado' => 'warning',
                'mensaje' => 'No se puede eliminar este casillero porque está asignado a clientes o prealertas.'
            ];
            break;
        default:
            $respuesta = [
                'estado' => 'error',
                'mensaje' => 'Error al intentar eliminar el casillero. Inténtalo nuevamente.'
            ];
    }

    echo json_encode($respuesta);
}
