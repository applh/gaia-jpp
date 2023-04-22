<?php

class xp_cli 
{
    static function run($cmd)
    {
        $res = `$cmd`;
        return $res;
    }

    static function test ()
    {
        $res = self::run("date");
        echo $res;
    }
}