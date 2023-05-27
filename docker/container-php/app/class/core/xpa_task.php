<?php

class xpa_task
{
    static $tasks = [];
    // make a dynamic task list
    static $step = 0;
    static $timer = [];

    static function work()
    {
        // loop on tasks
        while (static::$step < count(static::$tasks)) {
            // before each task

            $curtask = array_values(static::$tasks)[static::$step] ?? null;
            // check if callable then call
            $curtask ?? $curtask = trim($curtask);

            if (is_callable($curtask)) {
                // get timer start
                static::timer_start($curtask);

                // FIXME: should be array
                // call extra before
                $cb_before = xpa_os::kv("task/before/$curtask") ?? "";
                $cb_before = trim($cb_before);
                if (is_callable($cb_before)) {
                    $cb_before();
                }

                // call the task
                $curtask();

                // FIXME: should be array
                // call extra after
                $cb_after = xpa_os::kv("task/after/$curtask") ?? "";
                $cb_after = trim($cb_after);
                if (is_callable($cb_after)) {
                    $cb_after();
                }

                // after each task
                // get timer end
                static::timer_end($curtask);
            }

            // move to the next task 
            static::$step++;
        }

        // log the timer
        xpa_os::log(static::$timer);
    }

    static function timer_start($key)
    {
        static::$timer[$key] = microtime(true);
    }

    static function timer_end($key)
    {
        $start = static::$timer[$key] ?? 0;
        $end = microtime(true);
        $diff = ($end - $start) * 1000; // in ms
        $diff = round($diff, 3); // round to 3 decimals

        $memory = memory_get_usage();
        $memory = round($memory / 1024 / 1024, 3); // in MB
        // store the difference
        static::$timer[$key] = [
            "timer" => $diff,
            "memory" => $memory,
        ];

        // return the difference
        return $diff;
    }

    static function add($key, $cmd)
    {
        $key = trim($key);
        if ($key != "") {
            static::$tasks[$key] = $cmd;
        }
    }
}
