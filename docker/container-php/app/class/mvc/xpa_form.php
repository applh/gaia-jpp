<?php
/**
 * xpa_form
 * 
 * created: 2023-05-25 17:47:34
 * author: applh/gaia
 * license: MIT
 */

/**
 * xpa_form
 */
class xpa_form
{
    //#class_start

    static function request_json ()
    {
        // get $_FILES["request_json"] 
        $request_json = $_FILES["request_json"] ?? [];
        // xpa_router::json_add("debug_request_json", $request_json);
        if (!empty($request_json)) {
            extract($request_json);
            // get content
            $content = file_get_contents($tmp_name);

            // xpa_router::json_add("debug_content", $content);
            // decode json
            $json_request = json_decode($content, true);
            return $json_request;
        }

    }

    static function request ($name, $default = null)
    {
        $value = $_REQUEST[$name] ?? $default;
        return $value;
    }

    //#class_end
}

//#file_end