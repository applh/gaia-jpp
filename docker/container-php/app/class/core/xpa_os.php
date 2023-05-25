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
            // warning: if not present, return null and let the caller handle it
            return static::$kv[$key] ?? null;
        }
    }

    static function log ($infos)
    {
        $mode_debug = xpa_os::kv("mode_debug") ?? false;
        if (!$mode_debug) {
            return;
        }
        
        if (is_array($infos)) {
            $infos = json_encode($infos, JSON_PRETTY_PRINT);
        }
        $text = date("Y-m-d H:i:s") . " $infos\n";

        $path_data = cli::kv("path_data");
        $path_log = "$path_data/logs";
        $time0 = time();
        $today = date("Y-m-d", $time0);
        $path_log_file = "$path_log/$today.log";
        file_put_contents($path_log_file, $text, FILE_APPEND);

    }

    //#class_end
}

//#file_end