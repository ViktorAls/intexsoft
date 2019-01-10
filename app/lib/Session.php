<?php
/**
 * Created by PhpStorm.
 * User: vipvi_mc4
 * Date: 10.01.2019
 * Time: 10:46
 */

namespace app\lib;


class Session
{

    public static function open()
    {
        if (!session_start()) {
            self::open();
        }
    }

    /**
     * @param int|string $key
     * @param mixed $value
     */
    public static function set($key, $value)
    {
        self::open();
        $_SESSION[$key] = $value;
    }

    /**
     * @param int|string $key
     * @param mixed $value
     * @return null
     */
    public static function get($key)
    {
        self::open();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * @param int|string $key
     */
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * @param $key
     * @return bool
     */
    public static function isNotNull($key)
    {
        return empty($_SESSION[$key]) ? false : true;
    }

}