<?php

class router_assets
{
    // add here specific routes
}


/**
 * Helper class to auomatically route to a template
 */
class etc_router_assets
{
    /**
     */
    static function index ($params)
    {
        extract($params);

        $extension ??= "html";
        // set header content type depending on extension
        $mimes = [
            "html" => "text/html",
            "css" => "text/css",
            "js" => "text/javascript",
            "json" => "application/json",
            "jpg" => "image/jpeg",
            "png" => "image/png",
            "gif" => "image/gif",
            "svg" => "image/svg+xml",
            "ico" => "image/x-icon",
            "pdf" => "application/pdf",
            "zip" => "application/zip",
            "mp3" => "audio/mpeg",
            "mp4" => "video/mp4",
        ];
        response::$content_type = $mimes[$extension] ?? "text/plain";
        // print_r(response::$content_type);

        // try automatic template from filename
        $template = $params["filename"] ?? "";
        // WARNING: COULD BE TOO DANGEROUS AS IT ALLOWS TO LOAD ANY FILE
        $template = basename($template);
        
        // find template file
        controller::load_asset("assets/$template", $params);

    }
}
