<?php

class xpa_route_media 
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

    static function response ($dirname="", $filename="", $extension="")
    {
        // get the params from storage
        extract(xpa_os::kv("xpa_route_media::response") ?? []);

        // echo "xp_route_blog::response($dirname)($filename)\n";
        // cut $dirname by /
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);

        $path_root = cli::kv("root");
        $path_data = cli::kv("path_data");
        // FIXME: only subdir are allowed ?! 
        $dir1 = $dirs[1] ?? "";
        $dir2 = $dirs[2] ?? "";
        $article = "$path_root/media/$dir1/$filename.$extension";
        if ($dir2) {
            $article = "$path_root/media/$dir1/$dir2/$filename.$extension";
            // dir3 needed ?!
        }
        
        if (file_exists($article)) {
            $content = file_get_contents($article);
            // get mime_type
            $mime_type = static::$mimes[$extension] ?? mime_content_type($article);
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            header("Content-Type: $mime_type");
            echo $content;
        }
        else {
            echo "article not found ($article)";
        }

    }
}