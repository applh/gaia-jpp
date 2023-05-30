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

    static $step = 2;
    static $step_max = 100;
    static $step_current = 0;
    static $tasks = [];

    static $mimes = [
        "css" => "text/css",
        "mjs" => "text/javascript",
        "js" => "text/javascript",
        "json" => "application/json",
        "ttf" => "font/ttf",
        "jpg" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "png" => "image/png",
        "gif" => "image/gif",
        "svg" => "image/svg+xml",
        "webp" => "image/webp",
        "ico" => "image/x-icon",
        "mp4" => "video/mp4",
        "webm" => "video/webm",
        "ogg" => "video/ogg",

    ];

    static function randomd5()
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

    static function log($infos)
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

    static function task_add($task, $step)
    {
        // TODO: should allow order tasks for each step
        static::$tasks[$step][] = $task;
    }

    static function mix()
    {
        // loop from 0 to $step_max, increment by $step
        for ($i = 0; $i <= self::$step_max; $i += self::$step) {
            // loop through tasks
            $tasks = static::$tasks[$i] ?? [];
            foreach ($tasks as $task) {
                $task = trim($task);
                if ($task && is_callable($task)) {
                    // run task
                    $task();
                }
            }

            // increment step_current
            self::$step_current += self::$step;
        }
    }

    static function template($name)
    {
        // FIXME: should use xpa_os::kv() instead of cli::kv()
        $path_root = cli::kv("root");
        $path_template = "$path_root/templates/$name.php";

        if (is_file($path_template)) {
            include($path_template);
        } else {
            echo "no $name.php file found as $path_template\n";
        }
    }

    //#class_end
}

//#file_end