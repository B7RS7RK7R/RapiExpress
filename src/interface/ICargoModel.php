<?php
namespace RapiExpress\Interface;

interface ICargoModel {
    public function verificarCargoExistente($nombreCargo, $idCargo = null): bool;
    public function registrar(array $data): string;
    public function obtenerTodos(): array;
    public function obtenerPorId($id): ?array;
    public function actualizar(array $data): bool;
    public function eliminar($id): bool;
}