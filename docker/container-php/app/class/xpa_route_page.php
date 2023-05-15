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

    static function response ($dirname, $filename, $extension)
    {
        $prefix = "pages";

        // echo "xp_route_blog::response($dirname)($filename)\n";
        // cut $dirname by /
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);
        // print_r($dirs);
    
        $path_data = cli::kv("path_data");
        $article = "$path_data/$prefix/$filename.md";
        if (file_exists($article)) {
            $content = file_get_contents($article);
            echo $content;
        }

        $notebook = "$path_data/$prefix/$filename.ipynb";
        if (file_exists($notebook)) {
            $content = file_get_contents($notebook);
            $json = json_decode($content, true);
            $cells = $json["cells"] ?? [];
            print_r($cells);
        }
        
        $php_template = "$path_data/$prefix/$filename.php";
        if (file_exists($php_template)) {
            include $php_template;
        }
    }

    //#class_end
}

//#file_end