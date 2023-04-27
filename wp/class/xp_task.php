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
}