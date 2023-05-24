<?php
/**
 * xpa_os
 * 
 * created: 2023-05-15 16:29:24
 * author: applh/gaia
 * license: MIT
 */

/**
 * xpa_os
 */
class xpa_os
{
    //#class_start

    static $kv = [];
    
    static function randomd5 ()
    {
        return md5(password_hash(md5(uniqid()), PASSWORD_DEFAULT));
    }

    static function kv($key, $value = null)
    {
        if ($value) {
            static::$kv[$key] = $value;
        } else {
            return static::$kv[$key] ?? "";
        }
    }
    //#class_end
}

//#file_end