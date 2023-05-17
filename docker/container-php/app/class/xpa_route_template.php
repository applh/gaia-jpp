<?php

class xpa_route_template 
{

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
        $dir2 = $dirs[2] ?? "";
        $article = "$path_root/templates/$dir1/$filename.$extension";
        if ($dir2) {
            $article = "$path_root/templates/$dir1/$dir2/$filename.$extension";
            // dir3 needed ?!
        }

        if (file_exists($article)) {
            $content = file_get_contents($article);
            // get mime_type
            $mime_type = xp_os::$mimes[$extension] ?? mime_content_type($article);
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            header("Content-Type: $mime_type");
            echo $content;

            xp_os::log("media ($dirname)($filename)($extension)");
        }
        else {
            echo "article not found ($article)";
        }

    }
}