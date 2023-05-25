<?php

class xpa_route_blog 
{
    static function response ($dirname="", $filename="", $extension="")
    {
        // get the params from storage
        extract(xpa_os::kv("xpa_route_blog::response") ?? []);

        // echo "xp_route_blog::response($dirname)($filename)\n";
        // cut $dirname by /
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);
        // print_r($dirs);
        $path_data = cli::kv("path_data");
        $article = "$path_data/blog/$filename.md";
        if (file_exists($article)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            $content = file_get_contents($article);
            echo $content;
        }

        $notebook = "$path_data/blog/$filename.ipynb";
        if (file_exists($notebook)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            $content = file_get_contents($notebook);
            $json = json_decode($content, true);
            $cells = $json["cells"] ?? [];
            print_r($cells);
        }
        
        $php_template = "$path_data/blog/$filename.php";
        if (file_exists($php_template)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            include $php_template;
        }
    }
}