<?php
/**
 * xpa_route_page
 * 
 * created: 2023-05-15 16:29:56
 * author: applh/gaia
 * license: MIT
 */

/**
 * xpa_route_page
 */
class xpa_route_page
{
    //#class_start

    static function response ($dirname="", $filename="", $extension="")
    {
        // get the params from storage
        extract(xpa_os::kv("xpa_route_page::response") ?? []);

        $prefix = "pages";

        // echo "xp_route_blog::response($dirname)($filename)\n";
        // cut $dirname by /
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);
        // print_r($dirs);
    
        $path_data = cli::kv("path_data");
        $article = "$path_data/$prefix/$filename.md";
        if (file_exists($article)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            $content = file_get_contents($article);
            echo $content;
        }

        $notebook = "$path_data/$prefix/$filename.ipynb";
        if (file_exists($notebook)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            $content = file_get_contents($notebook);
            $json = json_decode($content, true);
            $cells = $json["cells"] ?? [];
            print_r($cells);
        }
        
        $php_template = "$path_data/$prefix/$filename.php";
        if (file_exists($php_template)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            include $php_template;
        }
        $css_template = "$path_data/$prefix/$filename.css";
        if (file_exists($css_template)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            header("Content-Type: text/css");
            include $css_template;
        }
        $js_template = "$path_data/$prefix/$filename.js";
        if (file_exists($js_template)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            header("Content-Type: text/javascript");
            include $js_template;
        }
        // images extension
        $images = ["webp", "png", "svg", "jpg", "jpeg", "gif"];
        if (in_array($extension, $images)) {
            $image = "$path_data/$prefix/$filename.$extension";
            if (file_exists($image)) {
                // allow gaia cms mix with others cms
                xpa_router::$response_status = "200";
                header("Content-Type: image/$extension");
                echo file_get_contents($image);
            }
        }
    }

    //#class_end
}

//#file_end