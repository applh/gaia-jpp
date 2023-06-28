<?php

class xpa_route_api
{

    static function response($dirname="", $filename="", $extension="")
    {
        // disable cache
        xpa_os::$cache_active = false;

        // headers
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        // header("Access-Control-Allow-Headers:  Authorization, X-Requested-With, Accept, Origin, Accept-Language, Last-Modified, Cache-Control, Pragma, If-Modified-Since, Access-Control-Allow-Origin");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

        // get the params from storage
        extract(xpa_os::kv("xpa_route_api::response") ?? []);

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

        if ($filename == "wp") {
            static::response_wp();
        }

        if ($filename == "forms") {
            static::response_forms();
        }

    }

    static function response_forms ()
    {
        $forms = [];

        $request_json = xpa_form::request_json();
        $class = xpa_form::request_filename("class") ?? "";
        $method = xpa_form::request_filename("method") ?? "";

        if ($method == "load") {
            $name = xpa_form::request_filename("name") ?? "";
            if ($name) {
                $form = xpa_os::load_json("templates/vue/form-$name.json") ?? [];
                $forms[$name] = $form;
            }    
        }
        if ($method == "submit") {
            $form = $request_json["form"] ?? [];
            if (!empty($form)) {
                $name = $form["name"] ?? "";
                if ($name) {
                    $form = xpa_form::process($form);
                    $forms[$name] = $form;
                }
            }
        }
        if ($method == "update") {
            $post = $request_json["post"] ?? [];
            if (!empty($post)) {
                $id = intval($post["id"] ?? 0);
                if ($id > 0) {
                    xpa_router::json_add("post", $post);
                    // WARNING: all columns can be updated
                    // updated 
                    $post["updated"] = xpa_os::now();
                    xpa_sqlite::update("zoom5/geocms", $id, $post);
                }
            }
        }

        xpa_router::json_add("forms", $forms);
        xpa_router::json_add("errors", xpa_form::$errors);
        xpa_router::json_add("request_json", $request_json);

        xpa_router::json();

    }
    
    static function response_wp ()
    {
        xps_api::process();
        xpa_router::json();

    }

    static function response_scraps ()
    {
        // get all rows in db/table scraps/news
        $rows = xpa_sqlite::read("zoom5/geocms", "WHERE z > 0 ORDER BY z DESC, id DESC");
        // allow gaia cms mix with others cms
        xpa_router::$response_status = "200";
        // header
        header("Content-Type: application/json");
        echo json_encode($rows, JSON_PRETTY_PRINT);
    }

    static function response_cron()
    {
        // allow gaia cms mix with others cms
        xpa_router::$response_status = "200";
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
            if ($form_name == "crud_save_post") {
                // update row in table zoom5/geocms
                $id = $inputs["id"] ?? "";
                $title = $inputs["title"] ?? "";
                $row = [
                    "code" => $inputs["code"] ?? "",
                    "x" => $inputs["x"] ?? null,
                    "y" => $inputs["y"] ?? null,
                    "z" => $inputs["z"] ?? null,
                    "updated" => $now2date,
                ];
                xpa_sqlite::update("zoom5/geocms", $id, $row);
                $json["crud_save_post"] = [
                    "id" => $id,
                    "row" => $row,
                    "feedback" => "OK $id updated ($now2date): $title",
                ];
            }

            // debug
            $json["request_json"] = $json_request;
        }

        // allow gaia cms mix with others cms
        xpa_router::$response_status = "200";
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

        // allow gaia cms mix with others cms
        xpa_router::$response_status = "200";
        // header
        header("Content-Type: image/png");
        imagepng($img);
    }
}
