<?php
namespace RapiExpress\Interfaces;

interface ITienda
{
    /**
     * Registra una nueva tienda con validaciones y verificación de duplicados.
     * @param array $data Datos de la tienda (nombre, dirección, teléfono, correo).
     * @return string Resultado de la operación ('registro_exitoso', 'nombre_existente', 'error_bd', etc.).
     */
    public function registrar(array $data): string;

    /**
     * Actualiza los datos de una tienda existente.
     * @param array $data Datos actualizados (id_tienda, nombre, dirección, teléfono, correo).
     * @return string|bool Resultado de la operación (true, 'nombre_existente', 'error_bd', etc.).
     */
    public function actualizar(array $data): string|bool;

    /**
     * Elimina una tienda del sistema, validando si está en uso.
     * @param int $id ID de la tienda a eliminar.
     * @return string|bool Resultado ('en_uso:mensaje', true, 'error_bd', etc.).
     */
    public function eliminar(int $id): string|bool;

    /**
     * Obtiene todas las tiendas registradas.
     * @return array Lista de tiendas (puede estar vacía si no existen registros).
     */
    public function obtenerTodas(): array;

    /**
     * Obtiene una tienda específica por su ID.
     * @param int $id ID de la tienda.
     * @return array|null Datos de la tienda o null si no existe.
     */
    public function obtenerPorId(int $id): ?array;
}
