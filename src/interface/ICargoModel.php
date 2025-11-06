<?php
namespace RapiExpress\Interface;

/**
 * Interface CargoInterface
 * Define las operaciones que debe implementar el modelo de Cargos.
 */
interface CargoInterface
{
    /**
     * Valida el formato del nombre del cargo
     * @param string $nombre
     * @return bool
     */
    public function validarNombre(string $nombre): bool;

    /**
     * Verifica si un cargo con el mismo nombre ya existe
     * @param string $nombreCargo
     * @param int|null $idCargo
     * @return bool
     */
    public function verificarCargoExistente(string $nombreCargo, ?int $idCargo = null): bool;

    /**
     * Registra un nuevo cargo
     * @param array $data
     * @return string Resultado de la operación ('registro_exitoso', 'error_validacion', 'error_bd')
     */
    public function registrar(array $data): string;

    /**
     * Actualiza un cargo existente
     * @param array $data
     * @return string Resultado de la operación ('actualizado', 'error_validacion', 'error_bd')
     */
    public function actualizar(array $data): string;

    /**
     * Obtiene todos los cargos
     * @return array Lista de cargos
     */
    public function obtenerTodos(): array;

    /**
     * Obtiene un cargo por su ID
     * @param int $id
     * @return array|null Cargo encontrado o null si no existe
     */
    public function obtenerPorId(int $id): ?array;

    /**
     * Elimina un cargo si no está en uso por usuarios
     * @param int $id
     * @return string Resultado de la operación ('eliminado', 'cargo_en_uso', 'error_bd')
     */
    public function eliminar(int $id): string;
}
