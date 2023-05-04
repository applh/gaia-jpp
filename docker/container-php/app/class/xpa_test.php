<?php

class xpa_test 
{
    static function minute ()
    {
        $timestamp = time();
        $now0 = date("Ymd-His", $timestamp);

        // launch command in shell
        // jupyter nbconvert --to notenook --execute --output-dir __DIR__ __DIR__/../media/task-minute.ipynb
        $command = "jupyter nbconvert --to notebook --execute --output task-$now0.ipynb --output-dir " . __DIR__ . "/../my-data/cron " . __DIR__ . "/../media/task-minute.ipynb";
        // $command = "which jupyter";
        // $command = "ls -la";
        $output = shell_exec($command);

        // log line with timestamp in file test.log
        $file = __DIR__ . "/../my-data/cron/my-test.log";
        $now = date("Y-m-d H:i:s", $timestamp);
        $line = 
        <<<txt
        $now
        $command
        $output

        txt;
        file_put_contents($file, $line, FILE_APPEND);
        
    }
}