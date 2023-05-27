<?php

class xpa_router
{
    static $response_status = "404";
    
    static $filename = "";
    static $routes = [];
    static $json = [];

    static function request()
    {
        // check if called from cli or index::web
        if (is_callable("index::web")) {
            // web server mode
            $uri = $_SERVER['REQUEST_URI'] ?? "";
            extract(parse_url($uri));

            $path ??= "/index.php";
            if ($path == "/") {
                $path = "/index.php";
            }

            $path_infos = (pathinfo($path));
            // print_r($path_infos);
            extract($path_infos);
            $filename ??= "index";
            $extension = strtolower($extension ?? "");

            static::$filename = $filename;
            // echo "filename: $filename\n$path\n";
            // check if there's a sub route 
            // (example: /news/may-2023 => sub_route is 'news')
            $sub_route = trim($dirname ?? "", "/");
            // sub_route is only the first part of the path (before the first /)
            $sub_route = explode("/", $sub_route)[0];
            if ($sub_route != "") {
                // change - by _ in sub_route
                $sub_route = str_replace("-", "_", $sub_route);
                // remove all non alpha numeric chars, _ is ok
                $sub_route = preg_replace("/[^a-zA-Z0-9_]/", "", $sub_route);
                $callback = "xpa_route_$sub_route::response";
                if (is_callable($callback)) {
                    // store the params $dirname, $filename, $extension
                    xpa_os::kv($callback, compact("dirname", "filename", "extension"));
                    xpa_os::task_add($callback, 50);
                    // xpa_task::add($filename, $callback);
                    // call sub route
                    // $callback($dirname, $filename, $extension ?? "");
                    // return;
                }

                // echo "route not found ($filename)($path)($dirname)\n";
            }
            else {
                // special routes defined in config
                $route = static::$routes[$filename] ?? "";
                if ($route) {
                    xpa_os::task_add($route, 50);
                    // add task 
                    // xpa_task::add($filename, $route);
                }
                else {
                    // use xpa_route_page as default
                    $sub_route = "page";
                    $callback = "xpa_route_$sub_route::response";
                    if (is_callable($callback)) {
                        // store the params $dirname, $filename, $extension
                        xpa_os::kv($callback, compact("dirname", "filename", "extension"));
                        xpa_os::task_add($callback, 50);
                        // xpa_task::add($filename, $callback);

                        // call sub route
                        // $callback($dirname, $filename, $extension ?? "");
                        // return;
                    }
    
                }  
                // case: 404 not found ?!  
            }
        } else {
            // cli mode
            // xpa_task::add("cli", "xpa_cli::run");
            xpa_os::task_add("xpa_cli::run", 50);
        }

        // xpa_task::add("response", "xpa_router::response");
        xpa_os::task_add("xpa_router::response", 80);
    }

    static function response ()
    {

    }

    static function add($key, $cmd)
    {
        $key = trim($key);
        if ($key != "") {
            static::$routes[$key] = $cmd;
        }
    }

    static function json()
    {
        // return json
        $json = static::$json;
        
        // add timestamp
        $json["timestamp"] = time();

        // add $_REQUEST, $_FILES and $_COOKIE
        $json["request"] = $_REQUEST;
        $json["files"] = $_FILES;
        $json["cookies"] = $_COOKIE;

        // set header
        header("Content-Type: application/json");
        echo json_encode($json, JSON_PRETTY_PRINT);
    }
}