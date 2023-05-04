<?php

class xp_route_blog 
{
    static function response ($dirname, $filename, $extension)
    {
        // echo "xp_route_blog::response($dirname)($filename)\n";
        // cut $dirname by /
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);
        // print_r($dirs);
        $path_data = cli::kv("path_data");
        $article = "$path_data/blog/$filename.md";
        if (file_exists($article)) {
            $content = file_get_contents($article);
            echo $content;
        }
        else {
            echo "article not found ($article)";
        }

    }
}