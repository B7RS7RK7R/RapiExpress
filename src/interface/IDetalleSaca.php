<?php
namespace RapiExpress\Interface;

/**
 * Interface IDetalleSacaModel
 * Define los métodos que deben implementar los modelos encargados
 * de gestionar la relación entre sacas y paquetes (detalle_sacas).
 */
interface IDetalleSacaModel
{
    /**
     * Obtiene todos los paquetes asociados a una saca específica.
     * 
     * @param int $idSaca ID de la saca.
     * @return array Lista de paquetes con información del cliente, categoría, courier y sucursal.
     */
    public function obtenerPorSaca(int $idSaca): array;

    /**
     * Agrega un paquete a una saca, validando su estado y sucursal.
     * 
     * @param int $idSaca ID de la saca.
     * @param int $idPaquete ID del paquete.
     * @return string Resultado del proceso ('agregado_exitoso', 'paquete_no_existe', 'saca_no_existe', etc.).
     */
    public function agregarPaquete(int $idSaca, int $idPaquete): string ;

    /**
     * Quita un paquete de una saca y actualiza el peso total.
     * 
     * @param int $idPaquete ID del paquete a quitar.
     * @param int $idSaca ID de la saca a la que pertenece.
     * @return bool True si se quitó correctamente, false si ocurrió un error.
     */
    public function quitarPaquete(int $idPaquete, int $idSaca): bool;

    /**
     * Recalcula y actualiza el peso total de la saca según sus paquetes asociados.
     * 
     * @param int $idSaca ID de la saca.
     * @return bool True si se actualizó correctamente, false en caso de error.
     */
    public function actualizarPesoSaca(int $idSaca): bool;
}
