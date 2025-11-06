<?php
namespace RapiExpress\Interface;

/**
 * Interface IClienteModel
 * Define las operaciones del modelo Cliente.
 */
interface IClienteModel
{
    /**
     * Registra un nuevo cliente en la base de datos.
     * @param array $data Datos del cliente.
     * @return string Código de resultado (e.g., 'registro_exitoso', 'cedula_existente', 'error_bd').
     */
    public function registrar(array $data);

    /**
     * Actualiza los datos de un cliente existente.
     * @param array $data Datos del cliente actualizados.
     * @return string Código de resultado (e.g., 'actualizacion_exitosa', 'correo_existente', 'error_bd').
     */
    public function actualizar(array $data);

    /**
     * Elimina un cliente por su ID (si no tiene relaciones activas).
     * @param int|string $id ID del cliente.
     * @return string Código de resultado (e.g., 'eliminacion_exitosa', 'cliente_relacionado_paquete', 'error_bd').
     */
    public function eliminar($id);

    /**
     * Obtiene todos los clientes registrados.
     * @return array Lista de clientes con datos asociados.
     */
    public function obtenerTodos();

    /**
     * Obtiene un cliente específico por su ID.
     * @param int|string $id ID del cliente.
     * @return array|null Datos del cliente o null si no existe.
     */
    public function obtenerPorId($id);
}
