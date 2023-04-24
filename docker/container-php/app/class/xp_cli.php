<?php

class xp_cli
{
    static function run ()
    {
        // debug
        print_r(xp_task::$tasks);
        // get argv
        $argv = $_SERVER["argv"] ?? [];
        print_r($argv);
    }

    static function shell($cmd)
    {
        $res = shell_exec($cmd);
        return $res;
    }

    static function test()
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

    static function build_md($level, $level_max = 3)
    {
        static $nb_call = 0;
        $nb_call++;

        $code = "";
        $code .= "#";
        for ($i = 1; $i < $level; $i++) {
            $code .= "#";
        }
        $code .= " title $level\n\n";
        $code .= "text $level (call $nb_call)\n\n";

        // recursive call if level < level_max
        if ($level < $level_max) {
            // call a random number of times between 1 and 6
            $n = mt_rand(1, 6);
            for ($i = 0; $i < $n; $i++) {
                $code .= static::build_md($level + 1, $level_max);
            }
        }
        return $code;
    }

    static function test_db()
    {
        // hack
        $tags = $_REQUEST["tags"] ?? "";
        // strip_tags
        $tags = strip_tags($tags);

        $timestamp = time();
        $now = date("Y-m-d H:i:s", $timestamp);
        $content = static::build_md(1, 3);

        $data = [
            "title" => "title ($now)",
            "content" => $content,
            "cat" => "cron",
            "tags" => $tags,
            "created" => $now,
            "x" => 0.00001 * mt_rand(-17000000, 17000000),
            "y" => 0.00001 * mt_rand(-8000000, 8000000),
            "z" => 0.001 * mt_rand(0, 10000000), // mm
            "t" => $timestamp,
        ];

        xp_sqlite::insert("geocms", $data);
    }
}
