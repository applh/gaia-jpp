<?php

class xpa_route_api
{

    static function response($dirname, $filename, $extension)
    {
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);
        $path_root = cli::kv("root");

        // FIXME: only subdir are allowed ?! 
        $dir1 = $dirs[1] ?? "";

        if ($filename == "cron") {
            static::response_cron();
        }

        if ($filename == "json") {
            static::response_json();
        }

        if ($filename == "image") {
            static::response_image();
        }

        if ($filename == "scraps") {
            static::response_scraps();
        }

    }

    static function response_scraps ()
    {
        // get all rows in db/table scraps/news
        $rows = xpa_sqlite::read("zoom5/geocms", "WHERE z > 0 ORDER BY z DESC, id DESC LIMIT 100");
        // header
        header("Content-Type: application/json");
        echo json_encode($rows, JSON_PRETTY_PRINT);
    }

    static function response_cron()
    {
        // add tasks
        xpa_task::add("cron", "xpa_cron::minute");
        xpa_task::add("json", "xpa_router::json");
    }

    static function response_json()
    {
        $json = [];
        // timestamp
        $now = time();
        $json["timestamp"] = $now;
        $now2date = date("Y-m-d H:i:s", $now);
        // date
        $json["date"] = $now2date;
        // request
        $json["request"] = $_REQUEST;
        // files
        $json["files"] = $_FILES;

        // check if there's a uploaded file with name request
        if (!empty($_FILES["request"]) && empty($_FILES["request"]["error"])) {
            $file = $_FILES["request"];
            extract($file);
            // get file content
            $content = file_get_contents($tmp_name);
            // decode json
            $json_request = json_decode($content, true);

            $form_name = $json_request["form_name"] ?? "";
            $inputs = $json_request["inputs"] ?? [];
            // add date
            $inputs["date"] = $now2date;
            // add ip
            $inputs["ip"] = $_SERVER["REMOTE_ADDR"];
            // user agent
            $inputs["user_agent"] = $_SERVER["HTTP_USER_AGENT"];

            $inputs_json = json_encode($inputs, JSON_PRETTY_PRINT);
            // save to db contact/geocms
            if ($form_name == "contact") {
                $row = [
                    "path" =>  "form/contact",
                    "cat" => $form_name,
                    "code" => $inputs_json,
                    "created" => $now2date,
                ];
                xpa_sqlite::create("contact/geocms", $row);
            }
            if ($form_name == "newsletter") {
                // save to db contact/geocms
                $row = [
                    "path" =>  "form/newsletter",
                    "cat" => $form_name,
                    "code" => $inputs_json,
                    "created" => $now2date,
                ];
                xpa_sqlite::create("newsletter/geocms", $row);
            }
            if ($form_name == "register") {
                // save to db contact/geocms
                $row = [
                    "path" =>  "user",
                    "cat" => $form_name,
                    "code" => $inputs_json,
                    "created" => $now2date,
                ];
                xpa_sqlite::create("user/geocms", $row);
            }
            if ($form_name == "login") {
                // save to db contact/geocms
                $row = [
                    "path" =>  "login",
                    "cat" => $form_name,
                    "code" => $inputs_json,
                    "created" => $now2date,
                ];
                xpa_sqlite::create("login/geocms", $row);
            }
            if ($form_name == "post") {
                // save to db contact/geocms
                $row = [
                    "path" =>  "post",
                    "title" => $inputs["title"] ?? "",
                    "content" => $inputs["content"] ?? "",
                    "cat" => $form_name,
                    "code" => $inputs_json,
                    "created" => $now2date,
                ];
                xpa_sqlite::create("post/geocms", $row);
            }
            // debug
            $json["request_json"] = $json_request;
        }

        // header
        header("Content-Type: application/json");
        echo json_encode($json, JSON_PRETTY_PRINT);
    }

    static function response_image()
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
