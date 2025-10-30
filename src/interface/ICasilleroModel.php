<?php
namespace RapiExpress\Interface;

interface ICasilleroModel {
    public function registrar(array $data);
    public function obtenerTodos();
    public function eliminar(int $id);
    public function obtenerPorId(int $id);
    public function actualizar(array $data);
}
