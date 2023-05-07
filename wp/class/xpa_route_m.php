<?php

/**
 * route for members /m/user1, /m/user2, /m/user3, etc...
 */
class xpa_route_m 
{
    static function response ($dirname, $filename, $extension)
    {
        $subdir = "member";

        // echo "xp_route_blog::response($dirname)($filename)\n";
        // cut $dirname by /
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);
        // print_r($dirs);
        $path_data = cli::kv("path_data");
        $article = "$path_data/$subdir/$filename.md";
        if (file_exists($article)) {
            $content = file_get_contents($article);
            echo $content;
        }
        
        $php_template = "$path_data/$subdir/$filename.php";
        if (file_exists($php_template)) {
            include $php_template;
        }
    }
}