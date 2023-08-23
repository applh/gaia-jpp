<?php

class controller 
{
    static function load_template($template, $params = [])
    {
        // CHECK: force template to be .php
        $params["extension"] = "php";
        return controller::load_asset($template, $params); 
    }

    static function load_asset($template, $params = [])
    {
        // warning: create local variables from array keys
        extract($params);
        $extension ??= "php";

        // find template file
        $path_template = __DIR__ . "/../templates/$template.$extension";
        // print_r($path_template);
        $path_template = realpath($path_template);
        if ($path_template !== false) {
            // load template file and get html result in $html
            ob_start();
            include $path_template;
            $data = ob_get_clean();
        }

        $data ??= "template not found: $template.$extension ($path_template))";
        if ($show_result ?? true) {
            // response::$content_type = $content_type ?? "text/html";
            response::$content = $data;
        }

        return $data;
    }

}