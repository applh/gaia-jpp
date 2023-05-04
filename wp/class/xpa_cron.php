<?php

class xpa_cron 
{

    static function minute ()
    {
        // sql select the last updated line table task
        $tasks = xpa_sqlite::read("task", "ORDER BY `updated` ASC LIMIT 1") ?? [];
        
        // xpa_router::$json["tasks"] = $tasks;
        // xpa_cli::test_db($sql);

        // if task is not null
        foreach($tasks as $task) {
            extract($task);
            $code = trim($code ?? "");
            if ($code) {
                is_callable($code) && $code();
            }
            // update the updated_at column with current datetime
            $tokens = [
                "updated" => date("Y-m-d H:i:s"),
                "id" => $task["id"]
            ];
            xpa_sqlite::update("task", $task['id'], $tokens);

            // log the task
            xpa_cli::test_db(json_encode($task, JSON_PRETTY_PRINT));
        }
    }
}