<?php
/**
 * xpa_route_map
 * 
 * created: 2023-05-10 14:41:31
 * author: applh/gaia
 * license: MIT
 */

/**
 * xpa_route_map
 */
class xpa_route_map
{
    //#class_start

    static function response ($dirname, $filename, $extension)
    {
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);
        $path_root = cli::kv("root");
        $path_data = cli::kv("path_data");

        $coords = explode("_", $filename);
        $z = $coords[0] ?? 0;
        $x = $coords[1] ?? 0;
        $y = $coords[2] ?? 0;

        $zip_map = "$path_data/map.zip";
        // get tile in zip
        $zip = new ZipArchive();
        $zip->open($zip_map, ZipArchive::CREATE);
        // add file if not exists
        $zip_filename = "map/$z/$x/$y.$extension";
        $found = $zip->locateName($zip_filename);

        if ($found === false) {
            // get tile from openstreetmap server
            $url_tile = "https://tile.openstreetmap.org/$z/$x/$y.png";
            header("X-map-url: $url_tile");
    
            $tile = null;
            // get tile by curl request
            // with user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:88.0) Gecko/20100101 Firefox/88.0
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url_tile);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:88.0) Gecko/20100101 Firefox/88.0");
            $tile = curl_exec($curl);
            curl_close($curl);

            if ($tile) {
                $zip->addFromString($zip_filename, $tile);
            }

        }
        else {
            header("X-map-zip: $zip_filename");
            // get tile from zip
            $tile = $zip->getFromName($zip_filename);
        }
        $zip->close();

        if ($tile) {

            // header("X-map-zip: $zip_map");
            // save tile
            // file_put_contents($zip_map, $tile);
            
            // show tile
            header("Content-Type: image/png");
            // set cache control
            header("Cache-Control: max-age=86400");
            echo $tile;
        }
    }

    //#class_end
}

//#file_end