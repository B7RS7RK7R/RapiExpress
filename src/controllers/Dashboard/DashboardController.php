<?php
// src/controllers/dashboardController.php

use RapiExpress\models\Usuario;
use RapiExpress\models\Cliente;
use RapiExpress\models\Tienda;
use RapiExpress\models\Courier;
use RapiExpress\models\Cargo;
use RapiExpress\models\Sucursal;

/**
 * Función auxiliar para obtener todos los usuarios
 */
function obtenerTodosUsuarios() {
    try {
        $usuarioModel = new Usuario();
        return $usuarioModel->obtenerTodos();
    } catch (\Exception $e) {
        error_log("Error obteniendo usuarios: " . $e->getMessage());
        return [];
    }
}

/**
 * Función principal del dashboard: redirige según el rol
 */
function dashboard_index() {
    error_log("=== Ejecutando dashboard_index ===");
    
    if (!isset($_SESSION['usuario']) || !isset($_SESSION['ID_Cargo'])) {
        error_log("No hay sesión activa, redirigiendo a login");
        ob_clean();
        header('Location: index.php?c=auth&a=login', true, 302);
        exit();
    }

    if ((int)$_SESSION['ID_Cargo'] === 1) {
        error_log("Usuario es admin, redirigiendo a dashboard admin");
        ob_clean();
        header('Location: index.php?c=dashboard&a=admin', true, 302);
        exit();
    }

    error_log("Usuario es empleado, redirigiendo a dashboard empleado");
    ob_clean();
    header('Location: index.php?c=dashboard&a=empleado', true, 302);
    exit();
}

/**
 * Dashboard del administrador
 */
function dashboard_admin() {
    error_log("=== Ejecutando dashboard_admin ===");
    
    if (!isset($_SESSION['usuario'])) {
        error_log("No hay sesión en dashboard_admin");
        ob_clean();
        header('Location: index.php?c=auth&a=login', true, 302);
        exit();
    }

    // Verificar que sea admin
    if ((int)$_SESSION['ID_Cargo'] !== 1) {
        error_log("Usuario no es admin, redirigiendo");
        ob_clean();
        header('Location: index.php?c=dashboard&a=empleado', true, 302);
        exit();
    }

    try {
        // Obtener usuarios
        $usuarios = obtenerTodosUsuarios();
        $totalUsuarios = count($usuarios);
        error_log("Total usuarios obtenidos: $totalUsuarios");

        // Obtener clientes
        $clienteModel = new Cliente();
        $clientes = $clienteModel->obtenerTodos();
        $totalClientes = count($clientes);
        error_log("Total clientes obtenidos: $totalClientes");

        // Obtener tiendas
        $tiendaModel = new Tienda();
        $tiendas = $tiendaModel->obtenerTodas();
        $totalTiendas = count($tiendas);
        error_log("Total tiendas obtenidas: $totalTiendas");

        // Obtener cargos
        $cargoModel = new Cargo();
        $cargos = $cargoModel->obtenerTodos();
        error_log("Total cargos obtenidos: " . count($cargos));

        // Obtener couriers
        $courierModel = new Courier();
        $couriers = $courierModel->obtenerTodos();
        $totalCouriers = count($couriers);
        error_log("Total couriers obtenidos: $totalCouriers");

        error_log("Mostrando vista dashboard admin");
        include __DIR__ . '/../../views/dashboard/dashboard.php';

    } catch (\Throwable $e) {
        error_log("Error en Dashboard Admin: " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());
        
        // Mostrar error amigable
        ob_clean();
        echo "<div style='padding: 20px; background: #fee; border: 1px solid #c00; margin: 20px;'>";
        echo "<h2>Error en Dashboard</h2>";
        echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<p><strong>Archivo:</strong> " . htmlspecialchars($e->getFile()) . " (línea " . $e->getLine() . ")</p>";
        echo "<a href='index.php?c=auth&a=logout'>Cerrar sesión</a>";
        echo "</div>";
        exit();
    }
}

/**
 * Dashboard del empleado
 */
function dashboard_empleado() {
    error_log("=== Ejecutando dashboard_empleado ===");
    
    if (!isset($_SESSION['usuario'])) {
        error_log("No hay sesión en dashboard_empleado");
        ob_clean();
        header('Location: index.php?c=auth&a=login', true, 302);
        exit();
    }

    try {
        // Obtener usuarios
        $usuarios = obtenerTodosUsuarios();
        $totalUsuarios = count($usuarios);
        
        // Obtener clientes
        $clienteModel = new Cliente();
        $clientes = $clienteModel->obtenerTodos();
        $totalClientes = count($clientes);

        // Obtener tiendas
        $tiendaModel = new Tienda();
        $tiendas = $tiendaModel->obtenerTodas();
        $totalTiendas = count($tiendas);

        // Obtener couriers
        $courierModel = new Courier();
        $couriers = $courierModel->obtenerTodos();
        $totalCouriers = count($couriers);

        error_log("Mostrando vista dashboard empleado");
        include __DIR__ . '/../../views/dashboard/dashboard_empleado.php';

    } catch (\Throwable $e) {
        error_log("Error en Dashboard Empleado: " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());
        
        // Mostrar error amigable
        ob_clean();
        echo "<div style='padding: 20px; background: #fee; border: 1px solid #c00; margin: 20px;'>";
        echo "<h2>Error en Dashboard</h2>";
        echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<p><strong>Archivo:</strong> " . htmlspecialchars($e->getFile()) . " (línea " . $e->getLine() . ")</p>";
        echo "<a href='index.php?c=auth&a=logout'>Cerrar sesión</a>";
        echo "</div>";
        exit();
    }
}