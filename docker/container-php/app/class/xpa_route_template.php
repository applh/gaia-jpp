<?php

class xpa_route_template 
{
    static $mimes = [
        "css" => "text/css",
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

    static function response ($dirname, $filename, $extension)
    {
        // echo "xp_route_blog::response($dirname)($filename)\n";
        // cut $dirname by /
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);
        // print_r($dirs);
        $path_root = cli::kv("root");

        // FIXME: only subdir are allowed ?! 
        $dir1 = $dirs[1] ?? "";
        
        $article = "$path_root/templates/$dir1/$filename.$extension";
        if (file_exists($article)) {
            $content = file_get_contents($article);
            // get mime_type
            $mime_type = static::$mimes[$extension] ?? mime_content_type($article);
            header("Content-Type: $mime_type");
            echo $content;

            xp_os::log("media ($dirname)($filename)($extension)");
        }
        else {
            echo "article not found ($article)";
        }

    }
}