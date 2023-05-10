<?php
/**
 * xpa_cron_task
 * 
 * created: 2023-05-10 23:13:16
 * author: applh/gaia
 * license: MIT
 */

/**
 * xpa_cron_task
 */
class xpa_cron_task
{
    //#class_start

    static function map_tile_zip ()
    {
        $path_data = cli::kv("path_data");
        $path_cache = "$path_data/cache";
        // find all files map-*.png in path_cache
        $files = glob("$path_cache/map-*.png");
        // add the files to zip
        $path_zip = "$path_data/map.zip";
        $zip = new ZipArchive();
        $zip->open($path_zip, ZipArchive::CREATE);
        foreach($files as $file) {
            $filename = basename($file);
            // replace - and _ by /
            $filename = str_replace("-", "/", $filename);
            $filename = str_replace("_", "/", $filename);
            
            $zip->addFile($file, $filename);
        }
        $zip->close();
        // remove $files
        foreach($files as $file) {
            unlink($file);
        }
    }

    static function scrap_score ()
    {
        $path_data = cli::kv("path_data");
        $config_scrap = json_decode(file_get_contents("$path_data/config-scrap.json"), true);
        // $debug_log = "$path_data/debug-scrap.log";

        if (empty($config_scrap)) {
            $config_scrap = [];
        }
        $config_scrap_filters = $config_scrap["filters"] ?? [];

        if (!empty($config_scrap_filters)) {
        // get rows in geocms table, in scraps db where z is null
        $rows = xpa_sqlite::read("scraps/news", "WHERE z IS NULL");
        // for each row
        foreach($rows as $row) {
            extract($row);
            $title ??= "";

            $score = null;
            if ($title) {

                // check if title contains a filter
                foreach($config_scrap_filters as $filter => $value) {
                    $filter = trim($filter);
                    if ($filter) {
                        if (strpos($title, $filter) !== false) {
                            $score = $value;
                            // debug
                            // file_put_contents($debug_log, "$id:$score: $title\n", FILE_APPEND);
                            break;
                        }
                    }
                }
            }
            if ($score != null) {
                // update row with score
                $tokens = [
                    "z" => $score
                ];
                xpa_sqlite::update("scraps/news", $id, $tokens);

            }
        }

        }
    }

    //#class_end
}

//#file_end