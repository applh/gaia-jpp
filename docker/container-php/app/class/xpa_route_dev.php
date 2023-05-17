<?php

class xpa_route_dev 
{
    static function response ($dirname, $filename, $extension)
    {
        // echo "xp_route_blog::response($dirname)($filename)\n";
        // cut $dirname by /
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);
        // print_r($dirs);
        $path_data = cli::kv("path_data");

        $request = $_REQUEST ?? [];
        $json_data = [];
        $json_data["request"] = $request;
        $json_data["date"] = date("Y-m-d H:i:s");

        $json = json_encode($json_data, JSON_PRETTY_PRINT);
        // log
        // $log = "$path_data/cron/dev-request.log";
        // file_put_contents($log, $json, FILE_APPEND);

        $url = $request["url"] ?? "";
        extract(parse_url($url));
        $host ??= "";

        // db log
        $db_row = [
            "path" => "chrome",
            "created" => date("Y-m-d H:i:s"),
            "code" => $json,
            "title" => $url,
            "tags" => $host,
        ];
        xpa_sqlite::create("chrome/geocms", $db_row);

        // allow gaia cms mix with others cms
        xpa_router::$response_status = "200";
        // CORS *
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        echo $json;
    }
}