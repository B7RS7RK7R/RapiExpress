<?php
namespace RapiExpress\Helpers;

class Lang {
    private static $lang = 'es';
    private static $strings = [];

    public static function init($default = 'es') {
        // Si el navegador envía 'lang' por GET (redirección JS), úsalo
        if (isset($_GET['lang'])) {
            self::$lang = $_GET['lang'];
        } elseif (isset($_COOKIE['selectedLang'])) {
            self::$lang = $_COOKIE['selectedLang'];
        } else {
            self::$lang = $default;
        }

        // Guardar en cookie para persistencia
        setcookie('selectedLang', self::$lang, time() + 365*24*60*60, '/');

        // Cargar archivo de idioma
        $langFile = __DIR__ . '/../lang/' . self::$lang . '.php';
        if (file_exists($langFile)) {
            self::$strings = include $langFile;
        } else {
            self::$strings = include __DIR__ . '/../lang/es.php';
        }
    }

    public static function get($key) {
        return self::$strings[$key] ?? $key;
    }

    public static function current() {
        return self::$lang;
    }
}
