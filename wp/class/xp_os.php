<?php

class xp_os 
{
    static function log ($line) 
    {
        $now = date("Ymd");
        $file = __DIR__ ."/log-$now.txt";
        file_put_contents($file, "$line\n", FILE_APPEND);
    }

    static function create_xp_theme ($code) 
    {
        $theme_path = get_theme_root('');
        xp_os::log("theme_path: $theme_path");
        
        // create random md5
        $md5 = md5(uniqid(rand(), true));
        // only allow alphanumeric characters and - and .
        $code = preg_replace("/[^a-zA-Z0-9\.\-]/", "", $code);
        $code = trim($code);
        $new_theme_dir = "$theme_path/$code-$md5";
        // create the directory is not exists
        if (!file_exists($new_theme_dir)) {
            mkdir($new_theme_dir);
        }
        // add files index.php and style.css
        $index_php = "$new_theme_dir/index.php";
        $style_css = "$new_theme_dir/style.css";
        file_put_contents($index_php, "<?php\n// Silence is golden.\n");
        file_put_contents($style_css, "/*\nTheme Name: $code\n*/\n");
    }
}