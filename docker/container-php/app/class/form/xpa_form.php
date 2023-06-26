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

    static $errors = [];
    static $request_json = null;

    /**
     * WARNING: 
     * password will be stored in upload file
     * this could be a problem on shared server as tmp dir is shared
     * upload_tmp_dir should be set to a private dir ?!
     * MAYBE: isolate password only in POST parameters
     */
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

            // store for later use
            xpa_form::$request_json = $json_request;

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

    static function request_filename($name, $default = null) 
    {
        $res = $default;
        $input = xpa_form::$request_json[$name] ?? $default;
        if (!empty($input)) {
            $res = xpa_form::filter_filename($input);
        }
        else {
            // add error
            xpa_form::$errors[] = "input_filename: $name is empty";
        }
        return $res;
    }

    static function process ($form)
    {
        $now = xpa_os::now();
        $form ??= [];
        $form["feedback"] = "...(processing $now)...";

        $name = $form["name"] ?? "";
        if ($name) {
            $form_process = xpa_os::load_json("templates/vue/form-$name.json") ?? [];
            $action = $form_process["action"] ?? "create";
            $fields = $form_process["fields"] ?? [];

            $inputs = $form["fields"] ?? [];
            $cols = [];
            // CHECK: can $index be mixed by front ?
            // WARNING: front can't change fields index order 
            foreach($fields as $index => $field) {
                $input_name = $field["name"] ?? "";
                $input = $inputs[$index]["value"] ?? "";
                // trim 
                $input = trim($input);
                $cols[$input_name] = $input;

                // WARNING: SECURITY
                // CONFIDENTIALITY: if password, hash it
                if ($field["type"] == "password") {
                    $cols[$input_name] = password_hash($input, PASSWORD_DEFAULT);
                    $form["fields"][$index]["value"] = $cols[$input_name];
                } 
            }

            $form["cols"] = $cols;

            if (in_array($action, ["create", "register"])) {
                // save to db
                $row = [
                    "path" => "form/$name",
                    "cat" => $name,
                    "code" => json_encode($form, JSON_PRETTY_PRINT),
                    "created" => $now,
                ];
                xpa_sqlite::create("form/geocms", $row);

            }

            // feedback
            $ok = $form["labels"]["ok"] ?? "...(ok $now)...";
            $form["feedback"] = $ok;
        }

        return $form;
    }

    //#class_end
}

//#file_end