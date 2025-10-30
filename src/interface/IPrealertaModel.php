<?php
namespace RapiExpress\Interface;

interface IPrealertaModel {
    public function registrar(array $data);
    public function obtenerTodas();
    public function obtenerPorId($id);
    public function actualizar(array $data);
    public function eliminar($id);
}
