<?php
namespace RapiExpress\Interfaces;

interface IUsuario
{
    /**
     * Inicia sesión con usuario y contraseña.
     * @param string $username
     * @param string $password
     * @return array Estado y datos del usuario o mensaje de error.
     */
    public function login(string $username, string $password): array;

    /**
     * Registra un nuevo usuario con validaciones.
     * @param array $data
     * @return array Resultado del registro.
     */
    public function registrar(array $data): array;

    /**
     * Actualiza los datos de un usuario existente.
     * @param array $data
     * @return array Resultado de la actualización.
     */
    public function actualizar(array $data): array;

    /**
     * Actualiza el perfil de un usuario (solo datos personales e imagen).
     * @param int $id
     * @param array $data
     * @return array Resultado de la actualización.
     */
    public function actualizarPerfil(int $id, array $data): array;

    /**
     * Sube una nueva imagen de perfil para el usuario.
     * @param array $file
     * @return array Resultado de la subida (estado, ID_Imagen, ruta...).
     */
    public function subirImagenPerfil(array $file): array;

    /**
     * Verifica si un usuario tiene dependencias en otras entidades.
     * @param int $id
     * @return array ['tiene' => bool, 'mensaje' => string]
     */
    public function tieneDependencias(int $id): array;

    /**
     * Elimina un usuario si no tiene dependencias.
     * @param int $id
     * @return array Resultado de la eliminación.
     */
    public function eliminar(int $id): array;

    /**
     * Obtiene todos los usuarios con relaciones (cargo, sucursal, imagen).
     * @return array Lista de usuarios.
     */
    public function obtenerTodos(): array;

    /**
     * Obtiene un usuario por su ID, incluyendo su imagen, cargo y sucursal.
     * @param int $id
     * @return array|null Datos del usuario o null si no existe.
     */
    public function obtenerPorId(int $id): ?array;

    /**
     * Obtiene todas las imágenes registradas.
     * @return array
     */
    public function obtenerTodasImagenes(): array;

    /**
     * Obtiene el nombre del archivo de imagen asociado a un ID de imagen.
     * @param int $idImagen
     * @return string|null
     */
    public function obtenerNombreArchivoPorIdImagen(int $idImagen): ?string;

    /**
     * Devuelve el nombre completo del usuario.
     * @return string
     */
    public function getNombreCompleto(): string;

    /**
     * Obtiene el último error registrado en las operaciones.
     * @return string
     */
    public function getLastError(): string;
}
