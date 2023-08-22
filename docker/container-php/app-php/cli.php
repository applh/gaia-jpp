<?php

class cli
{
    static $mix_steps = [];

    static function run()
    {
        cli::setup();
        cli::mix();
    }

    static function setup ()
    {
        // add spl_autoload_register
        spl_autoload_register("cli::autoloader_class");

        // fill $mix_steps from 0 to 100
        for ($i = 0; $i <= 100; $i++) {
            static::$mix_steps[$i] = [];
        }
        
        cli::step_add(10, "route", "cli::route");
        cli::step_add(90, "response", "response::send");
    }

    static function autoloader_class ($classname)
    {
        $filename = __DIR__ . "/class/$classname.php";
        $filename = realpath($filename);
        if ($filename !== false) {
            include $filename;
        }
    }

    static function step_add ($index, $key, $value)
    {
        // add $value to $mix_steps[$index][$key]
        static::$mix_steps[$index][$key] = $value;
    }

    static function mix ()
    {
        // loop $mix_steps
        foreach (static::$mix_steps as $i => $steps) {
            // loop $mix_step
            foreach ($steps as $step) {
                // if callable $step
                if (is_callable($step)) {
                    // call $step
                    $step();
                }
            }
        }
    }

    static function route ()
    {
        $now = date("Y-m-d H:i:s");
        $uri = $_SERVER["REQUEST_URI"] ?? "/";
        extract(parse_url($uri));
        $path ??= "/index.php";
        extract(pathinfo($path));
        $dirname ??= "/";
        empty($filename) && $filename = "index";
        $extension ??= "php";

        $dirname = trim($dirname, "/");
        // cut $dirname by /
        $dirparts = explode("/", $dirname) ?: [];

        // print_r($dirparts);
        // echo "$dirname/$filename.$extension\n";
        $router = $router_main ?? "router_main";
        if (!empty($dirparts)) {
            $subrouters = [
                "api" => "router_api",
                "admin" => "router_admin",
            ];
            $router = $subrouters[$dirparts[0]] ?? $router;
        }

        $method = str_replace("-", "_", $filename);
        // remove non alpha characters
        $method = preg_replace("/[^a-zA-Z0-9_]/", "", $method);
        $callable = "$router::$method";
        if (is_callable($callable)) {
            $params = [
                "now" => $now,
                "uri" => $uri,
                "dirname" => $dirname,
                "filename" => $filename,
                "extension" => $extension,
            ];
            $callable($params);
        }

    }

}



cli::run();
