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

        return null;
    }

    static function request ($name, $default = null)
    {
        $value = $_REQUEST[$name] ?? $default;
        return $value;
    }

    /**
     * The code excerpt is a static PHP function called filter_filename() 
     * that takes two parameters: $input and $mask. 
     * The purpose of the function is to filter a filename 
     * by removing any characters that do not match the specified mask.
     * The function first uses the preg_replace() function with the $mask parameter 
     * to remove any characters that do not match the specified mask. 
     * The resulting string is then passed through a series of additional preg_replace() functions 
     * to remove any occurrences of .., ., and -- characters. 
     * Finally, the filtered string is returned.
     */
    static function filter_filename ($input, $mask="/[^a-zA-Z0-9\.\-\_]/")
    {
        $res = preg_replace($mask, "", $input);
        $res = preg_replace("/\.\./", "", $res);
        $res = preg_replace("/\./", "", $res);
        $res = preg_replace("/\-\-/", "-", $res);
        return $res;
        
    }
    //#class_end
}

//#file_end