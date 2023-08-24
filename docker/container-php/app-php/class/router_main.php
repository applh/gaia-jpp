<?php

class router_main
{
    // add here specific routes
}


/**
 * Helper class to auomatically route to a template
 */
class etc_router_main
{
    /**
     */
    static function index ($params)
    {
        // if local web server, check if file exists
        $path_public = __DIR__ . "/../public";
        $dirname = $params["dirname"] ?? "";
        $filename = $params["filename"] ?? "";
        $extension = $params["extension"] ?? "";
        $path = "$dirname/$filename.$extension";

        // debug 
        header("X-Debug-Path: $path");

        $path = realpath("$path_public/$path");
        if ($filename 
            && ($path !== false) 
            && !in_array($extension, ["php"])) {
            $mimes = [
                "css" => "text/css",
                "js" => "text/javascript",
                "json" => "application/json",
                "jpg" => "image/jpeg",
                "jpeg" => "image/jpeg",
                "png" => "image/png",
                "gif" => "image/gif",
                "svg" => "image/svg+xml",
                "ico" => "image/x-icon",
                "pdf" => "application/pdf",
                "zip" => "application/zip",
                "txt" => "text/plain",
                "html" => "text/html",
            ];

            // get mime type
            $mime_type = $mimes[$extension] ?? mime_content_type($path);
            // set content type
            header("Content-Type: $mime_type");
            // if file exists, return it
            readfile($path);

            // FIXME: shoud be able to complete more code ?!
            // HARD EXIT
            exit;
        }

        // try automatic template from filename
        $template = $params["filename"] ?? "";
        // WARNING: COULD BE TOO DANGEROUS AS IT ALLOWS TO LOAD ANY FILE
        $template = basename($template);
                
        // find template file
        controller::load_template($template, $params);

    }
}
