<?php

class response 
{
    static $content_type = "application/json";
    static $content = "";

    static function send ()
    {
        // set header
        header("Content-Type: " . static::$content_type);
        // send content
        echo static::$content;
    }
}