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

    static function map_tile_zip()
    {
        $path_data = cli::kv("path_data");
        $path_cache = "$path_data/cache";
        // find all files map-*.png in path_cache
        $files = glob("$path_cache/map-*.png");
        $max = 100;
        $done_files = [];
        $zip_targets = [];
        foreach ($files as $index => $file) {
            $filename = basename($file);
            // extract first number Z from filename
            // filename format map-Z_X_Y.png
            preg_match("/map-(\d+)_\d+_\d+\.png/", $filename, $matches);
            $z = $matches[1];

            // add the files to zip
            $path_zip = "$path_data/maps/map-$z.zip";
            // get zip target
            $zip = $zip_targets[$path_zip] ?? null;

            if (!$zip) {
                // create zip target
                $zip = new ZipArchive();
                $zip->open($path_zip, ZipArchive::CREATE);
                // add to zip_targets
                $zip_targets[$path_zip] = $zip;
            }

            // replace - and _ by /
            $filename = str_replace("-", "/", $filename);
            $filename = str_replace("_", "/", $filename);
            // check if file already exists in zip
            $found = $zip->locateName($filename);
            if ($found === false) {
                // add file to zip
                $zip->addFile($file, $filename);
                // add to done_files
                $done_files[] = $file;
            }

            // stop if max reached
            if ($index >= $max) {
                break;
            }
        }
        // close all zip targets
        foreach ($zip_targets as $zip) {
            $zip->close();
        }
        // remove $files
        foreach ($done_files as $file) {
            unlink($file);
        }
    }

    /**
     * script to transfer map tiles from map.zip to map-Z.zip
     * (DONE: only keep for code example)
     */
    static function map_zip_transfer()
    {
        $path_data = cli::kv("path_data");
        $zip_src = "$path_data/map.zip";
        if (file_exists($zip_src)) {
            // get all files in zip_src
            $zip = new ZipArchive();
            $zip->open($zip_src);
            $files = [];

            $zip_targets = [];

            for ($i = 0; $i < $zip->numFiles; $i++) {
                $file = $zip->getNameIndex($i);
                echo "$file\n";
                // $file name is in format map/Z/X/Y.png
                // extract Z
                preg_match("/map\/(\d+)\/\d+\/\d+\.png/", $file, $matches);
                $z = $matches[1];
                $zip_target = "$path_data/map-$z.zip";
                $zip_to = $zip_targets[$zip_target] ?? null;
                if (!$zip_to) {
                    // create zip target
                    $zip_to = new ZipArchive();
                    $zip_to->open($zip_target, ZipArchive::CREATE);
                    // add to zip_targets
                    $zip_targets[$zip_target] = $zip_to;
                }
                // add file to zip target if not already in $zip_to
                $found = $zip_to->locateName($file);
                if ($found === false) {
                    // get file content from $zip_src
                    $tile = $zip->getFromName($file);
                    // add file to $zip_to
                    $zip_to->addFromString($file, $tile);
                }
                // remove from source zip
                $zip->deleteName($file);

                // add file to files
                $files[] = $file;
            }

            // close source zip
            $zip->close();
            // close all zip targets
            foreach ($zip_targets as $zip_to) {
                $zip_to->close();
            }
        }
    }

    static function scrap_score()
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
            foreach ($rows as $row) {
                extract($row);
                $title ??= "";

                $score = null;
                if ($title) {
                    // lowercase
                    $title = strtolower($title);

                    // check if title contains a filter
                    foreach ($config_scrap_filters as $filter => $value) {
                        $filter = trim($filter);
                        if ($filter) {
                            // lowercase
                            $filter = strtolower($filter);
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

    static function select_zoom5 ()
    {
        $rows = xpa_sqlite::read("scraps/news", "WHERE z > 0 ORDER BY z DESC, id DESC");

        // loop on rows
        foreach ($rows as $row) {
            extract($row);
            echo "$id $z $title $date\n";
            $copy = [];
            $copy["path"] = "zoom5";
            $copy["filename"] = $md5;
            $copy["title"] = $title;        
            $copy["created"] = $date;
            $copy["z"] = $z;
            $copy["url"] = $url;
            $copy["hash"] = $md5;
        
            // check in table select5/geocms if there's a row with same md5
            $row2 = xpa_sqlite::read("zoom5/geocms", "WHERE hash = '$md5'");
            if (empty($row2)) {
                //print_r($row);
                // insert in table select5/geocms
                xpa_sqlite::create("zoom5/geocms", $copy);
            }
            else {
                // echo "already in table\n";
            }
        }
        
    }

    //#class_end
}

//#file_end