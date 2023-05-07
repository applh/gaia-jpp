<?php

class xp_os 
{
    static function log ($line) 
    {
        $now = date("Ymd");
        $path_data = cli::kv("path_data");
        $file = "$path_data/cron/log-$now.txt";
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

    static function install_dist_zip ($task)
    {
        $theme = $task['theme'] ?? '';
        if (empty($theme)) {
            xp_os::log("error: no theme");
            return;
        }

        $theme_path = get_theme_root('');
        // find a folder starting with "test.applh.com-"
        $files = glob("$theme_path/$theme-*");
        // take the first one
        $theme_dir = $files[0];
        // check if the folder exists
        if (is_dir($theme_dir)) {
            // remove the folder
            xp_os::log("found $theme_dir");
            // unzip ./dist.zip in the folder
            $dist_zip = __DIR__ ."/dist.zip";
            $zip = new ZipArchive;
            $res = $zip->open($dist_zip);
            if ($res === TRUE) {
                $zip->extractTo($theme_dir);
                $zip->close();
                xp_os::log("unzip $dist_zip in $theme_dir");
            } else {
                xp_os::log("error: cannot unzip $dist_zip in $theme_dir");
            }
        }
    }
}