<?php
namespace RapiExpress\Interface;

interface ICategoriaModel {
    public function registrar(array $data);
    public function obtenerTodos();
    public function obtenerPorId($id);
    public function actualizar(array $data);
    public function verificarCategoriaExistente($nombre, $idCategoria = null);
    public function eliminar($id);
}
