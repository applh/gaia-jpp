<?php

class cli
{
    static $kv = [];
    static $autoloads = [
        "cli::autoload_file",
        "cli::autoload_zip",
        "cli::autoload_db",
    ];

    static function run()
    {
        static::kv("root", __DIR__);
        static::kv("path_class", __DIR__ . "/class");
        static::kv("path_data", __DIR__ . "/my-data");

        // add autoload
        spl_autoload_register("cli::autoload");

        // check if file my-config.php exists
        // then load it
        if (file_exists(__DIR__ . "/my-config.php")) {
            require_once __DIR__ . "/my-config.php";
        }

        // run tasks
        xpa_task::work();
    }

    static function autoload($classname)
    {
        foreach (static::$autoloads as $autoload) {
            if (is_callable($autoload)) {
                $found = $autoload($classname);
                if (class_exists($classname, false))
                    return;
            }
        }
    }

    static function autoload_file($classname)
    {
        // autoload classes
        $path_class = cli::kv("path_class");
        $file = "$path_class/" . $classname . ".php";
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
        else {
            // search also in subfolders
            $search_glob = "$path_class/*/$classname.php";
            $files = glob($search_glob);
            if (count($files) > 0) {
                require_once $files[0];
                return true;
            }
        }

        return false;
    }

    static function autoload_zip($classname)
    {
        $path_data = cli::kv("path_data");
        $target_file = "$path_data/class/$classname.php";

        // FIXME: should be used in autoload_cache
        // check if $target_file exists then include it
        if (file_exists($target_file)) {
            require_once $target_file;
            return true;
        }

        $path_zip = "$path_data/class.zip";
        $path_class = "zip://$path_zip#class/$classname.php";
        if (file_exists($path_zip)) {
            // copy the file to $path_data/class/$classname.php
            // don't want PHP warning is file doesn't exist 
            // (@ => don't show error)
            $code = @file_get_contents($path_class);
            $code = trim($code);
            if ($code) {
                file_put_contents($target_file, $code);
                require_once $target_file;
                return true;    
            }
        }

        return false;
    }

    /**
     * WARNING: need xpa_sqlite loaded before
     * Can't be the first autoload to be called
     */
    static function autoload_db ($classname)
    {
        $path_data = cli::kv("path_data");
        $target_file = "$path_data/class/$classname.php";

        // FIXME: should be used in autoload_cache
        // check if $target_file exists then include it
        if (file_exists($target_file)) {
            require_once $target_file;
            return true;
        }

        // need xpa_sqlite loaded before
        $rows = xpa_sqlite::read(
            "class/geocms", 
            "where `path` = 'class' and `filename` = '$classname' ORDER BY created DESC LIMIT 1", 
            // [ "filename" => $classname ]
        );
        // print_r($rows);
        foreach($rows as $row) {
            extract($row);
            $code = trim($code ?? "");
            if ($code) {
                file_put_contents($target_file, $code);
                require_once $target_file;
                return true;
            }
        }
        return false;
    }
    
    static function kv($key, $value = null)
    {
        if ($value) {
            static::$kv[$key] = $value;
        } else {
            return static::$kv[$key] ?? "";
        }
    }
}

cli::run();
