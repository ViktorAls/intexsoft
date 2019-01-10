<?php
/**
 * Created by PhpStorm.
 * User: vipvi_mc4
 * Date: 10.01.2019
 * Time: 10:46
 */

namespace app\lib;


class Request
{

    /**
     * @param $key
     * @return array|null
     */
    public static function get($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    /**
     * @param $key
     * @return array|null
     */
    public static function post($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    /**
     * @return string
     */
    private static function getMethod (){

        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }
        return 'GET';
    }

    /**
     * @return bool
     */
    public static function isGet()
    {
       return self::getMethod() === 'GET';
    }

    /**
     * @return bool
     */
    public static function isPost()
    {
        return self::getMethod() === 'POST';
    }
}