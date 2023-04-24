<?php

class xp_task 
{
    static $tasks = [];

    static function work ()
    {
        foreach(self::$tasks as $task) {
            // check if callable then call
            is_callable($task) && $task();
        }

    }

    static function add ($key, $cmd)
    {
        $key = trim($key);
        if ($key != "") {
            static::$tasks[$key] = $cmd;
        }
    }
}

