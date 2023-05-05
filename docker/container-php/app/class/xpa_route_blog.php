<?php

class xpa_route_blog 
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

        $notebook = "$path_data/blog/$filename.ipynb";
        if (file_exists($notebook)) {
            $content = file_get_contents($notebook);
            $json = json_decode($content, true);
            $cells = $json["cells"] ?? [];
            print_r($cells);
        }
        
        if ($filename == "python") {
            echo "test python\n";
            $request = $_REQUEST;
            print_r($request);
            xpa_test::task_python("news");
        }

    }
}