<?php
namespace RapiExpress\Interface;

/**
 * Interface ICasilleroModel
 * Define las operaciones del modelo Casillero.
 */
interface ICasilleroModel
{
    /**
     * Registra un nuevo casillero.
     * @param array $data
     * @return string Código de resultado ('registro_exitoso', 'casillero_existente', 'error_registro', etc.)
     */
    public function registrar(array $data);

    /**
     * Obtiene todos los casilleros.
     * @return array Lista de casilleros.
     */
    public function obtenerTodos();

    /**
     * Actualiza un casillero existente.
     * @param array $data
     * @return string Código de resultado ('actualizacion_exitosa', 'sin_cambios', 'error_actualizacion', etc.)
     */
    public function actualizar(array $data);

    /**
     * Elimina un casillero si no está asignado a clientes o prealertas.
     * @param int $id
     * @return string Código de resultado ('eliminado', 'casillero_asignado', 'error_eliminacion', etc.)
     */
    public function eliminar(int $id);

    /**
     * Obtiene un casillero por su ID.
     * @param int $id
     * @return array|null Datos del casillero o null si no existe.
     */
    public function obtenerPorId(int $id);
}
