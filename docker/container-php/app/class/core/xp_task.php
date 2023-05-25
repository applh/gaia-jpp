<?php

class xp_task 
{
    static function log ($code)
    {
        xp_os::log($code);
    }

    static function create_xp_theme ($code) 
    {
        xp_os::create_xp_theme($code);
    }

    static function send_email ($code, $task)
    {
        // get the email infos: from, to, subject, message
        $from = $task['from'] ?? '';
        $to = $task['to'] ?? '';
        $subject = $task['subject'] ?? '';
        $message = $task['message'] ?? '';
        // if the email infos are not empty
        if ($from && $to && $subject && $message) {
            // send the email
            $headers = "From: $from";
            $result = wp_mail($to, $subject, $message, $headers);
            // log the result
            xp_task::log("send_email: $result");
        }
    }

    static function sync_dist_zip ($code, $task)
    {
        $json = json_encode($task, JSON_PRETTY_PRINT);
        xp_os::log($json);

        // get the uploaded file
        $dist_zip_infos = $_FILES['dist_zip'] ?? [];
        // if the file is uploaded
        if (!empty($dist_zip_infos)) {
            extract($dist_zip_infos);
            // check if error code is 0
            if ($error != 0) {
                // return an error
                return "error: $error";
            }

            // move the uploaded file to the current folder
            move_uploaded_file($tmp_name, __DIR__ ."/dist.zip");
            xp_os::install_dist_zip($task);
        }
        else {
            // return an error
            return "error: no file uploaded";
        }
    }

}