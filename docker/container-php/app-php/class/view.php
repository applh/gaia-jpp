<?php

class view 
{
    static function read () 
    {
        model::read();
        $rows = response::$rows ?? [];

        $html_bloc = "";

        // test switch to compare performances
        $skip_template = TRUE;

        if (!$skip_template) {
            $tmp_dir = sys_get_temp_dir();

            // get the code from template item.php
            $code_item = file_get_contents(__DIR__ . "/../templates/item.php");
            // copy the code to a temporary file
            $tmp_file = tempnam($tmp_dir, "item");
            file_put_contents($tmp_file, $code_item);
    
            $html_bloc .= "<b>tmp_dir: $tmp_dir</b><br>";
            $html_bloc .= "<b>tmp_file: $tmp_file</b><br>";
    
        }

        foreach($rows as $index => $row) {

            // WARNING: VERY SLOW WITH DOCKER 😱
            // maybe looping and including files is not a good idea...
            // build html template item
            $html_item = view::load_template($tmp_file ?? "", [
                "skip" => $skip_template,
                "row" => $row,
                "index" => $index,
            ]);


            // OK: about same performance as json output
            if ($skip_template) {
                $html_item = 
                <<<HTML
                <section>
                    <h3>{$row["name"]}</h3>
                    <p>{$index}, {$row["id"]}, {$row["email"]}</p>
                </section>
                HTML;                
            }

            // add item to bloc
            $html_bloc .= $html_item ?? "";
        }

        // build html template
        echo $html_bloc;

    }

    static function load_template($template, $params = [])
    {
        // warning: create local variables from array keys
        extract($params);

        ob_start();
        // WARNING: VERY SLOW WITH DOCKER 😱
        // maybe looping and including files is not a good idea...
        $skip ??= false;
        if (!$skip) {
            include $template;
        }

        $html = ob_get_clean();

        return $html ?? "";
    }
}