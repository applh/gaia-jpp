<?php

class xpa_route_api 
{

    static function response ($dirname, $filename, $extension)
    {
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);
        $path_root = cli::kv("root");

        // FIXME: only subdir are allowed ?! 
        $dir1 = $dirs[1] ?? "";
        
        if ($filename == "json") 
        {
            $json = [];
            // timestamp
            $now = time();
            $json["timestamp"] = $now;
            // date
            $json["date"] = date("Y-m-d H:i:s", $now);
            // request
            $json["request"] = $_REQUEST;
            // files
            $json["files"] = $_FILES;

            // check if there's a uploaded file with name request
            if (!empty($_FILES["request"]) && empty($_FILES["request"]["error"]))
            {
                $file = $_FILES["request"];
                extract($file);
                // get file content
                $content = file_get_contents($tmp_name);
                // decode json
                $json_request = json_decode($content, true);
                // debug
                $json["request_json"] = $json_request;

            }

            // header
            header("Content-Type: application/json");
            echo json_encode($json, JSON_PRETTY_PRINT);
        }
        if ($filename == "image")
        {
            // build image
            xpa_dev::code("xpa_image");
            
            $img = imagecreatetruecolor(600, 600);
            $color = imagecolorallocate($img, 200, 200, 200);
            imagefill($img, 0, 0, $color);
            // header
            header("Content-Type: image/png");
            imagepng($img);
        }
    }
}