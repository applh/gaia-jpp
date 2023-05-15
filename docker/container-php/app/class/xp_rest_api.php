<?php

class xp_rest_api
{
    static function admin_key ()
    {
        // get the key from the database
        $admin_key = get_option("xp_rest_api_admin_key");
        // if the key is not in the database
        if (!$admin_key) {
            // create a random md5 key
            $admin_key = md5(uniqid(rand(), true));
            // save the key in the database
            update_option("xp_rest_api_admin_key", $admin_key);
        }
    }

    static function admin_zip_upload ()
    {
        // get the admin key
        $admin_key = get_option("xp_rest_api_admin_key");
        // get the key from the request
        $xp_key = $_REQUEST['xp_key'] ?? '';
        // if the key is not the same
        if ($admin_key != $xp_key) {
            // return an error
            return "error: wrong key";
        }
        else {
            // check if the file is uploaded with name "class"
            $class_infos = $_FILES['class_zip'] ?? [];
            // if the file is uploaded
            if (!empty($class_infos)) {
                // rename the current file with a timestamp
                $now = date("Ymd-His");
                rename(__DIR__ ."/class.zip", __DIR__ ."/class-$now.zip");

                // WARNING: will overwrite the current file
                move_uploaded_file($class_infos['tmp_name'], __DIR__ ."/class.zip");
                // remove current class files class-*.php
                $files = glob(__DIR__ ."/class-*.php");
                foreach ($files as $file) {
                    unlink($file);
                }
            }
            else {
                // return an error
                return "error: no file uploaded";
            }
        }

    }

    static function task_json () 
    {
        // get uploaded file under name task_json
        $task_json_infos = $_FILES['task_json'] ?? [];
        // if the file is uploaded
        if (!empty($task_json_infos)) {
            extract($task_json_infos);
            // check if error code is 0
            if ($error != 0) {
                // return an error
                return "error: $error";
            }

            $code = file_get_contents($tmp_name);
            // decode the json
            $json = json_decode($code, true);
            // if the json is not valid
            if (!$json) {
                // return an error
                return "error: invalid json";
            }

            // get tasks from the json
            $tasks = $json['tasks'] ?? [];
            foreach($tasks as $task) {
                // get the task name
                $task_name = $task['name'] ?? '';
                // get the task code
                $task_code = $task['code'] ?? '';
                // if the task name is not empty
                if ($task_name) {
                    $task_cb = "xp_task::$task_name";
                    if (is_callable($task_cb)) {
                        // call the task
                        $task_cb($task_code, $task, $tasks);
                    }
                }
            }
            // return the json
            return $json;
        }
        else {
            // return an error
            return "error: no file uploaded";
        }
    }
}