<?php

namespace App\Core;

class Session
{
    /**
     * Checks if current session has the provided key.
     */
    public static function has(string $key): bool
    {
        return (bool) static::get($key);
    }

    /**
     * Puts a data into current session.
     */
    public static function put(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Retrieves data from temporary session &
     * if data doesn't exists return the default data.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    /**
     * Puts a data into temporary session.
     */
    public static function flash(string $key, mixed $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    /**
     * Clears the temporary session.
     */
    public static function unflash()
    {
        unset($_SESSION['_flash']);
    }

    /**
     * Resets the session super global.
     */
    public static function flush()
    {
        $_SESSION = [];
    }

    /**
     * Destroys the current session.
     */
    public static function destroy()
    {
        static::flush();

        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
