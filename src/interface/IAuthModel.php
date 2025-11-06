<?php
namespace RapiExpress\Interface;

/**
 * Interface AuthInterface
 * Define el contrato para los métodos de autenticación y gestión de usuarios.
 */
interface IAuthModel
{
    /**
     * Valida el formato del nombre de usuario
     * @param string $username
     * @return bool
     */
    public function validarUsername(string $username): bool;

    /**
     * Valida el formato de la contraseña
     * @param string $password
     * @return bool
     */
    public function validarPassword(string $password): bool;

    /**
     * Autentica un usuario con username y contraseña
     * @param string $username
     * @param string $password
     * @return array|null Retorna los datos del usuario si es válido, o null si falla
     */
    public function autenticar(string $username, string $password): ?array;

    /**
     * Actualiza la contraseña de un usuario existente
     * @param string $username
     * @param string $newPassword
     * @return bool Retorna true si se actualizó correctamente
     */
    public function actualizarPassword(string $username, string $newPassword): bool;

    /**
     * Verifica si un usuario existe en la base de datos
     * @param string $username
     * @return bool
     */
    public function usuarioExiste(string $username): bool;
}
