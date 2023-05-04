<?php

class xpa_task 
{
    static $tasks = [];
    // make a dynamic task list
    static $step = 0;

    static function work ()
    {
        // loop on tasks
        while (static::$step < count(static::$tasks)) 
        {
            $curtask = array_values(static::$tasks)[static::$step] ?? null;
            // check if callable then call
            $curtask ?? $curtask = trim($curtask);

            is_callable($curtask) && $curtask();

            // move to the next task 
            static::$step++;
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

