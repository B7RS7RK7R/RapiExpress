<?php
namespace RapiExpress\Interface;

interface ISucursalModel
{
    public function registrar(array $data);
    public function obtenerTodas(): array;
    public function obtenerPorId(int $id) ;

    public function actualizar(array $data);    
    public function eliminar(int $id);
    public function getLastError();
    
}
