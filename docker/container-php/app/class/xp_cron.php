<?php

class xp_cron 
{

    static function minute ()
    {
        // sql select the last updated line table task
        $sql = "SELECT * FROM `task` ";
        $tasks = xp_sqlite::read("task", "ORDER BY `updated` ASC LIMIT 1") ?? [];
        
        xp_router::$json["tasks"] = $tasks;
        // xp_cli::test_db($sql);

        // if task is not null
        foreach($tasks as $task) {
            // update the updated_at column with current datetime
            $tokens = [
                "updated" => date("Y-m-d H:i:s"),
                "id" => $task["id"]
            ];
            xp_sqlite::update("task", $task['id'], $tokens);

            // log the task
            xp_cli::test_db(json_encode($task, JSON_PRETTY_PRINT));
        }
    }
}