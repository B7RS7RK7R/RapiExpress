<?php
namespace RapiExpress\Interface;

/**
 * Interface ICourierModel
 * Define el contrato que debe cumplir el modelo Courier.
 */
interface ICourierModel
{
    /**
     * Registra un nuevo courier en la base de datos.
     * 
     * @param array $data Datos del courier.
     * @return string Resultado de la operación (por ejemplo: 'registro_exitoso', 'rif_duplicado', 'error_bd').
     */
    public function registrar(array $data);

    /**
     * Actualiza los datos de un courier existente.
     * 
     * @param array $data Datos actualizados del courier.
     * @return string Resultado de la operación.
     */
    public function actualizar(array $data);

    /**
     * Elimina un courier por su ID.
     * 
     * @param int $id ID del courier a eliminar.
     * @return bool|string true si se elimina correctamente, 'error_restriccion' si tiene relaciones, o 'error_bd' si falla.
     */
    public function eliminar($id);

    /**
     * Obtiene todos los couriers registrados.
     * 
     * @return array Lista de couriers (cada uno como un array asociativo).
     */
    public function obtenerTodos();

    /**
     * Obtiene los datos de un courier específico por su ID.
     * 
     * @param int $id ID del courier.
     * @return array|false Datos del courier o false si no existe.
     */
    public function obtenerPorId($id);
}
