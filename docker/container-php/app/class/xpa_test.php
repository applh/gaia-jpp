<?php

class xpa_test 
{
    static function minute ()
    {
        static::task_python("minute");
        
    }

    static function opencv ()
    {
        static::task_python("opencv");
    }

    static function playwright ()
    {
        static::task_python("playwright");
    }

    static function news ()
    {
        static::task_python("news");
    }

    static function task_python ($name)
    {
        $timestamp = time();
        $now0 = date("Ymd-His", $timestamp);

        // launch command in shell
        // jupyter nbconvert --to notenook --execute --output-dir __DIR__ __DIR__/../media/task-minute.ipynb
        $path_root = cli::kv("root");
        $path_data = cli::kv("path_data");
        $src_nb = "$path_root/media/task-$name.ipynb";
        $path_ipython = "$path_data/cron/ipython";
        // copy notebook to ipython folder
        $dst_nb = "$path_ipython/task-$name.ipynb";
        copy($src_nb, $dst_nb);
        // change directory to ipython folder
        chdir($path_ipython);
        // launch command
        // KO: permission denied .jupyter ?!
        // $command = "IPYTHONDIR=$path_ipython jupyter nbconvert --to notebook --execute --output task-$name-$now0.ipynb --output-dir $path_ipython task-$name.ipynb";
        // FIXME: 
        // UserWarning: IPython parent '/var/www' is not a writable location, using a temp directory.
        $command = "jupyter nbconvert --to notebook -y --log-level 50 --execute --output task-$name-$now0.ipynb --output-dir $path_ipython task-$name.ipynb";

        // $command = "which jupyter";
        // $command = "ls -la";
        $output = shell_exec($command);

        // log line with timestamp in file test.log
        $file = "$path_data/cron/my-test.log";
        $now = date("Y-m-d H:i:s", $timestamp);
        $line = 
        <<<txt
        $now
        $command
        $output

        txt;
        file_put_contents($file, $line, FILE_APPEND);
        
        // hack
        // FIXME: use the server tmp folder ?!
        // remove all sub dir in ipython folder
        $files = glob("$path_ipython/*"); // get all file names
        $command = "rm -rf $path_ipython/tmp*";
        $output = shell_exec($command);

        return $output;
    }


}