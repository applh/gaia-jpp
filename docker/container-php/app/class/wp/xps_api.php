<?php
/**
 * xps_api
 * 
 * created: 2023-06-01 16:31:59
 * author: applh/gaia
 * license: MIT
 */

/**
 * xps_api
 */
class xps_api
{
    //#class_start

    static function process ()
    {
        if (function_exists('add_action')) {

            $now = xpa_os::now();
            $feedback = "error ($now)";
            // check capabilities 'manage_options'
            if (current_user_can('manage_options')) {
                $user = wp_get_current_user();
                $username = $user->user_login;
                $feedback = "welcome $username ($now)";

                // get request_json
                $json_request = xpa_form::request_json();
                if (!empty($json_request)) {
                    $code = $json_request["code"] ?? "";
                    $code = trim($code);
                    if (!empty($code)) {
                        // split lines
                        $lines = explode("\n", $code);
                        foreach($lines as $line) {
                            // trim line
                            $line = trim($line);
                            if (!empty($line)) {
                                // execute line
                                // split line by /
                                $parts = explode("/", $line);
                                $cmd = $parts[0] ?? "";
                                $cmd = trim($cmd);
                                if (!empty($cmd)) {
                                    $cmd = "xps_api::cmd_$cmd";
                                    if (is_callable($cmd)) {
                                        $cmd($parts);
                                    }
                                } 
                            }
                        }
                    }     
                }
                xpa_router::json_add("json_request", $json_request);

                // get xpa-admin-action
                $xpa_admin_action = xpa_form::request("xps-admin-action") ?? "";
                if ($xpa_admin_action == "upload") {
                    // get the files
                    foreach($_FILES as $index => $upload) {
                        extract($upload);
                        // https://developer.wordpress.org/reference/functions/media_handle_upload/
                        // check if function exists
                        if (!function_exists('media_handle_upload')) {
                            // WP... WTF ?!
                            require_once(ABSPATH . "/wp-admin/includes/image.php");
                            require_once(ABSPATH . "/wp-admin/includes/file.php");
                            require_once(ABSPATH . "/wp-admin/includes/media.php");
                        }
                        media_handle_upload($index, 0); 
                    }

                }
            }
            xpa_router::json_add("feedback", $feedback);

        }


    }

    static function cmd_option ($parts)
    {
        xpa_router::json_add("cmd_option:parts", $parts);
        // option name
        $option_name = $parts[1] ?? "";
        $option_value = $parts[2] ?? "";
        $option_value = trim($option_value);
        if (!empty($option_name)) {
            // get option
            $option = get_option($option_name);
            if (empty($option)) {
                // add option
                add_option($option_name, $option_value);
            } else {
                // update option
                update_option($option_name, $option_value);
            }
        }
    }

    static function cmd_backup ($parts)
    {
        // launch shell script mysqldump
        $db_host = DB_HOST;
        $db_name = DB_NAME;
        $db_user = DB_USER;
        $db_pass = DB_PASSWORD;
        $db_charset = DB_CHARSET;
        $db_collate = DB_COLLATE;
        $db_prefix = $GLOBALS["table_prefix"];
        $now = xpa_os::now("Ymd-His");
        $db_file = "$db_name-$now.sql";

        $db_file = xpa_os::kv("path_data") . "/$db_file";
        
        // $shell_cmd = "mysqldump --host=$db_host --user=$db_user --password=$db_pass --default-character-set=$db_charset --result-file=$db_file --databases $db_name";
        $shell_cmd = "which mysqldump";
        $shell_result = shell_exec($shell_cmd);

        xpa_router::json_add("cmd_backup", $shell_cmd);
        xpa_router::json_add("cmd_backup:result", $shell_result ?? "");

    }

    //#class_end
}

//#file_end