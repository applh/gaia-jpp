<?php

class xp_cli 
{
    static function run($cmd)
    {
        $res = shell_exec($cmd);
        return $res;
    }

    static function test ()
    {
        $res = self::run("date");
        $res && $res = trim($res);
        echo "$res api is working \n";

        // there's a cron job calling htpp://gaia.test:8666/api every minute
        // log test into a file ./test.log
        $log = dirname(__DIR__) . "/my-data/cron.log";
        $uri = $_SERVER["REQUEST_URI"] ?? "";
        $msg = date("Y-m-d H:i:s") . " api is working ($uri)\n";

        file_put_contents($log, $msg, FILE_APPEND);
    }

    static function test_db ()
    {
        $timestamp = date("Y-m-d H:i:s");
        $data = [
            "title" => "title ($timestamp)",
            "created" => $timestamp,
        ];

        xp_sqlite::insert("geocms", $data);
        
    }
}