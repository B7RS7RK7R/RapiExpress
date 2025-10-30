<?php
namespace RapiExpress\Models;

use PDOException;
use RapiExpress\Config\Conexion;

class Cargo extends Conexion {

    // ✅ Validar nombre de cargo: obligatorio, letras y espacios, max 20
    public function validarNombre(string $nombre): bool {
        $nombre = trim($nombre);
        return !empty($nombre) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,20}$/', $nombre);
    }

    // ✅ Verifica si un cargo existe (opcionalmente excluyendo un ID)
    public function verificarCargoExistente(string $nombreCargo, ?int $idCargo = null): bool {
        try {
            if ($idCargo) {
                $stmt = $this->db->prepare("SELECT COUNT(*) FROM cargos WHERE Cargo_Nombre = ? AND ID_Cargo != ?");
                $stmt->execute([$nombreCargo, $idCargo]);
            } else {
                $stmt = $this->db->prepare("SELECT COUNT(*) FROM cargos WHERE Cargo_Nombre = ?");
                $stmt->execute([$nombreCargo]);
            }
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Error al verificar cargo existente: " . $e->getMessage());
            return true; // Si falla, asumimos que existe por seguridad
        }
    }

    // ✅ Registrar cargo
    public function registrar(array $data): string {
        if (!$this->validarNombre($data['Cargo_Nombre'])) {
            return 'error_validacion';
        }
        try {
            $stmt = $this->db->prepare("INSERT INTO cargos (Cargo_Nombre) VALUES (?)");
            return $stmt->execute([$data['Cargo_Nombre']]) ? 'registro_exitoso' : 'error_bd';
        } catch (PDOException $e) {
            error_log("Error al registrar cargo: " . $e->getMessage());
            return 'error_bd';
        }
    }

    // ✅ Actualizar cargo
    public function actualizar(array $data): string {
        if (!$this->validarNombre($data['Cargo_Nombre'])) {
            return 'error_validacion';
        }
        try {
            $stmt = $this->db->prepare("UPDATE cargos SET Cargo_Nombre = ? WHERE ID_Cargo = ?");
            return $stmt->execute([$data['Cargo_Nombre'], $data['ID_Cargo']]) ? 'actualizado' : 'error_bd';
        } catch (PDOException $e) {
            error_log("Error al actualizar cargo: " . $e->getMessage());
            return 'error_bd';
        }
    }

    // ✅ Obtener todos los cargos
    public function obtenerTodos(): array {
        try {
            $stmt = $this->db->query("SELECT * FROM cargos ORDER BY ID_Cargo DESC");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener cargos: " . $e->getMessage());
            return [];
        }
    }

    // ✅ Obtener cargo por ID
    public function obtenerPorId(int $id): ?array {
        try {
            $stmt = $this->db->prepare("SELECT * FROM cargos WHERE ID_Cargo = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log("Error al obtener cargo por ID: " . $e->getMessage());
            return null;
        }
    }

    // ✅ Verifica si el cargo está asignado a algún usuario
    private function cargoAsignadoAUsuario(int $idCargo): bool {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM usuarios WHERE ID_Cargo = ?");
            $stmt->execute([$idCargo]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Error al verificar uso de cargo: " . $e->getMessage());
            return true; // seguridad
        }
    }

    // ✅ Eliminar cargo
    public function eliminar(int $id): string {
        try {
            if ($this->cargoAsignadoAUsuario($id)) {
                return 'cargo_en_uso';
            }
            $stmt = $this->db->prepare("DELETE FROM cargos WHERE ID_Cargo = ?");
            return $stmt->execute([$id]) ? 'eliminado' : 'error_bd';
        } catch (PDOException $e) {
            error_log("Error al eliminar cargo: " . $e->getMessage());
            return 'error_bd';
        }
    }
}
