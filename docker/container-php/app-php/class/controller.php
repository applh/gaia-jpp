<?php

class controller 
{
    static function load_template($template, $params = [])
    {
        // warning: create local variables from array keys
        extract($params);

        // find template file
        $path_template = __DIR__ . "/../templates/$template.php";
        $path_template = realpath($path_template);
        if ($path_template !== false) {
            // load template file and get html result in $html
            ob_start();
            include $path_template;
            $html = ob_get_clean();
        }

        if ($show_result ?? true) {
            response::$content_type = $content_type ?? "text/html";
            response::$content = $html;
        }

        return $html;
    }

}