<?php
namespace RapiExpress\Helpers;

/**
 * Clase centralizada para validaciones
 * Soporta Venezuela, Ecuador y USA
 */
class Validator {

    // ==================== CÉDULAS/DOCUMENTOS ====================
    
    /**
     * Valida cédula venezolana (V-12345678 o E-12345678)
     */
    public static function validarCedulaVenezuela(string $cedula): bool {
        $cedula = strtoupper(trim($cedula));
        return preg_match('/^[VE]-\d{7,9}$/', $cedula) === 1;
    }

    /**
     * Valida cédula ecuatoriana (10 dígitos)
     */
    public static function validarCedulaEcuador(string $cedula): bool {
        $cedula = preg_replace('/\D/', '', $cedula);
        
        if (strlen($cedula) !== 10) return false;
        
        // Validación con algoritmo de módulo 10
        $provincia = (int)substr($cedula, 0, 2);
        if ($provincia < 1 || $provincia > 24) return false;
        
        $digitoVerificador = (int)substr($cedula, -1);
        $suma = 0;
        
        for ($i = 0; $i < 9; $i++) {
            $digito = (int)$cedula[$i];
            if ($i % 2 === 0) {
                $digito *= 2;
                if ($digito > 9) $digito -= 9;
            }
            $suma += $digito;
        }
        
        $modulo = $suma % 10;
        $resultado = $modulo === 0 ? 0 : 10 - $modulo;
        
        return $resultado === $digitoVerificador;
    }

    /**
     * Valida SSN de USA (formato XXX-XX-XXXX)
     */
    public static function validarSSN_USA(string $ssn): bool {
        $ssn = trim($ssn);
        // Formato con guiones
        if (preg_match('/^\d{3}-\d{2}-\d{4}$/', $ssn)) {
            $parts = explode('-', $ssn);
            // No puede empezar con 000, 666, o 9XX
            $first = (int)$parts[0];
            if ($first === 0 || $first === 666 || $first >= 900) return false;
            return $parts[1] !== '00' && $parts[2] !== '0000';
        }
        return false;
    }

    /**
     * Valida documento según país
     */
    public static function validarDocumento(string $documento, string $pais): array {
        $documento = trim($documento);
        
        switch (strtoupper($pais)) {
            case 'VE':
            case 'VENEZUELA':
                $valido = self::validarCedulaVenezuela($documento);
                $mensaje = $valido ? '' : 'Formato: V-12345678 o E-12345678';
                break;
                
            case 'EC':
            case 'ECUADOR':
                $valido = self::validarCedulaEcuador($documento);
                $mensaje = $valido ? '' : 'Cédula ecuatoriana inválida (10 dígitos)';
                break;
                
            case 'US':
            case 'USA':
            case 'EEUU':
                $valido = self::validarSSN_USA($documento);
                $mensaje = $valido ? '' : 'Formato SSN: XXX-XX-XXXX';
                break;
                
            default:
                $valido = false;
                $mensaje = 'País no soportado';
        }
        
        return ['valido' => $valido, 'mensaje' => $mensaje];
    }

    // ==================== TELÉFONOS ====================
    
    /**
     * Valida teléfono venezolano (0414-1234567 o +58 414-1234567)
     */
    public static function validarTelefonoVenezuela(string $telefono): bool {
        $telefono = preg_replace('/[\s\-()]/', '', $telefono);
        
        // Con código país: +58
        if (preg_match('/^\+?58(4(14|24|16|26|12)|2(12|41|42|43|44|51|52|53|61|62|63|64|65|66|67|68|81|82|83|84|85|86|87|88))\d{7}$/', $telefono)) {
            return true;
        }
        
        // Sin código país: 0414
        if (preg_match('/^0(4(14|24|16|26|12)|2(12|41|42|43|44|51|52|53|61|62|63|64|65|66|67|68|81|82|83|84|85|86|87|88))\d{7}$/', $telefono)) {
            return true;
        }
        
        return false;
    }

    /**
     * Valida teléfono ecuatoriano (09XXXXXXXX o +593 9XXXXXXXX)
     */
    public static function validarTelefonoEcuador(string $telefono): bool {
        $telefono = preg_replace('/[\s\-()]/', '', $telefono);
        
        // Con código país: +593
        if (preg_match('/^\+?593[2-7]\d{7}$/', $telefono) || 
            preg_match('/^\+?5939\d{8}$/', $telefono)) {
            return true;
        }
        
        // Sin código país: 09
        if (preg_match('/^0[2-7]\d{7}$/', $telefono) || 
            preg_match('/^09\d{8}$/', $telefono)) {
            return true;
        }
        
        return false;
    }

    /**
     * Valida teléfono USA (formato (XXX) XXX-XXXX o +1 XXX-XXX-XXXX)
     */
    public static function validarTelefonoUSA(string $telefono): bool {
        $telefono = preg_replace('/[\s\-()]/', '', $telefono);
        
        // +1 o sin prefijo, 10 dígitos
        if (preg_match('/^\+?1?\d{10}$/', $telefono)) {
            return true;
        }
        
        return false;
    }

    /**
     * Valida teléfono según país
     */
    public static function validarTelefono(string $telefono, string $pais): array {
        $telefono = trim($telefono);
        
        switch (strtoupper($pais)) {
            case 'VE':
            case 'VENEZUELA':
                $valido = self::validarTelefonoVenezuela($telefono);
                $mensaje = $valido ? '' : 'Formato: 0414-1234567 o +58 414-1234567';
                break;
                
            case 'EC':
            case 'ECUADOR':
                $valido = self::validarTelefonoEcuador($telefono);
                $mensaje = $valido ? '' : 'Formato: 09XXXXXXXX o +593 9XXXXXXXX';
                break;
                
            case 'US':
            case 'USA':
            case 'EEUU':
                $valido = self::validarTelefonoUSA($telefono);
                $mensaje = $valido ? '' : 'Formato: (XXX) XXX-XXXX o +1 XXX-XXX-XXXX';
                break;
                
            default:
                $valido = false;
                $mensaje = 'País no soportado';
        }
        
        return ['valido' => $valido, 'mensaje' => $mensaje];
    }

    // ==================== CORREOS ====================
    
    /**
     * Valida correo electrónico estándar
     */
    public static function validarCorreo(string $correo): array {
        $correo = trim($correo);
        $valido = filter_var($correo, FILTER_VALIDATE_EMAIL) !== false;
        
        // Validación adicional de formato
        if ($valido) {
            $valido = preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $correo) === 1;
        }
        
        return [
            'valido' => $valido,
            'mensaje' => $valido ? '' : 'Formato de correo inválido'
        ];
    }

    // ==================== NOMBRES Y TEXTO ====================
    
    /**
     * Valida nombres y apellidos (letras, acentos, espacios)
     */
    public static function validarNombre(string $nombre, int $min = 2, int $max = 50): array {
        $nombre = trim($nombre);
        $longitud = mb_strlen($nombre);
        
        if ($longitud < $min || $longitud > $max) {
            return [
                'valido' => false,
                'mensaje' => "Debe tener entre $min y $max caracteres"
            ];
        }
        
        $valido = preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/u', $nombre) === 1;
        
        return [
            'valido' => $valido,
            'mensaje' => $valido ? '' : 'Solo se permiten letras y espacios'
        ];
    }

    /**
     * Valida direcciones (más permisivo)
     */
    public static function validarDireccion(string $direccion, int $min = 10, int $max = 200): array {
        $direccion = trim($direccion);
        $longitud = mb_strlen($direccion);
        
        if ($longitud < $min || $longitud > $max) {
            return [
                'valido' => false,
                'mensaje' => "Debe tener entre $min y $max caracteres"
            ];
        }
        
        $valido = preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s\.,#\-°]+$/u', $direccion) === 1;
        
        return [
            'valido' => $valido,
            'mensaje' => $valido ? '' : 'Caracteres no permitidos en la dirección'
        ];
    }

    // ==================== RIF ====================
    
    /**
     * Valida RIF venezolano (J-12345678-9)
     */
    public static function validarRIF(string $rif): array {
        $rif = strtoupper(trim($rif));
        $valido = preg_match('/^[JGVEPCLR]-\d{8,9}-\d$/', $rif) === 1;
        
        return [
            'valido' => $valido,
            'mensaje' => $valido ? '' : 'Formato RIF: J-12345678-9'
        ];
    }

    // ==================== NÚMEROS ====================
    
    /**
     * Valida número decimal positivo
     */
    public static function validarDecimalPositivo(float $numero, float $min = 0, float $max = PHP_FLOAT_MAX): array {
        $valido = $numero >= $min && $numero <= $max;
        
        return [
            'valido' => $valido,
            'mensaje' => $valido ? '' : "Debe estar entre $min y $max"
        ];
    }

    /**
     * Valida número entero positivo
     */
    public static function validarEnteroPositivo(int $numero, int $min = 0, int $max = PHP_INT_MAX): array {
        $valido = $numero >= $min && $numero <= $max;
        
        return [
            'valido' => $valido,
            'mensaje' => $valido ? '' : "Debe estar entre $min y $max"
        ];
    }

    // ==================== CÓDIGOS ====================
    
    /**
     * Valida formato de tracking
     */
    public static function validarTracking(string $tracking): array {
        $tracking = strtoupper(trim($tracking));
        $valido = preg_match('/^[A-Z0-9\-]{5,30}$/', $tracking) === 1;
        
        return [
            'valido' => $valido,
            'mensaje' => $valido ? '' : 'Formato de tracking inválido'
        ];
    }

    // ==================== VALIDACIÓN MÚLTIPLE ====================
    
    /**
     * Ejecuta múltiples validaciones y devuelve todos los errores
     */
    public static function validarMultiple(array $validaciones): array {
        $errores = [];
        
        foreach ($validaciones as $campo => $resultado) {
            if (!$resultado['valido']) {
                $errores[$campo] = $resultado['mensaje'];
            }
        }
        
        return [
            'valido' => empty($errores),
            'errores' => $errores
        ];
    }

    // ==================== SANITIZACIÓN ====================
    
    /**
     * Limpia y sanitiza una cadena de texto
     */
    public static function sanitizar(string $texto): string {
        $texto = trim($texto);
        $texto = strip_tags($texto);
        $texto = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
        return $texto;
    }

    /**
     * Formatea un teléfono para almacenamiento (solo números y +)
     */
    public static function formatearTelefono(string $telefono): string {
        return preg_replace('/[^\d+]/', '', $telefono);
    }

    /**
     * Formatea un documento para almacenamiento (mayúsculas, sin espacios extra)
     */
    public static function formatearDocumento(string $documento): string {
        return strtoupper(trim($documento));
    }
}