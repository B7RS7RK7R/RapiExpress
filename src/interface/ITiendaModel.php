<?php
namespace RapiExpress\Interface;

interface ITiendaModel {
    public function registrar(array $data): string;
        
    public function obtenerTodas(): array;
    public function obtenerPorId(int $id): ?array;
    public function actualizar(array $data): string|bool;

    public function eliminar(int $id): bool;
    
}
