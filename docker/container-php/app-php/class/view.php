<?php

class view 
{
    static function read ($loop_template = null) 
    {
        model::read();
        $rows = response::$rows ?? [];

        $html_bloc = "";

        // test switch to compare performances
        $skip_template = TRUE;

        if (!$skip_template) {
            $tmp_dir = sys_get_temp_dir();

            // get the code from template parts/loop-item.php
            $loop_template ??= "loop-item";
            $code_item = file_get_contents(__DIR__ . "/../templates/parts/$loop_template.php");
            // copy the code to a temporary file
            $tmp_file = tempnam($tmp_dir, "item");
            file_put_contents($tmp_file, $code_item);
    
            $html_bloc .= 
            <<<HTML
            <div class="w100 text-center">
                <p>loop_template: $loop_template</p>
                <p>tmp_dir: $tmp_dir</p>
                <p>tmp_file: $tmp_file</p>
            </div>
            HTML;
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
                <section class="s3">
                    <h3>{$row["name"]}</h3>
                    <img src="/photo.jpg" alt="">
                    <p>{$index}, {$row["id"]}, {$row["email"]}</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam velit, magni odio, suscipit corrupti dicta totam deleniti sed adipisci necessitatibus sapiente dolorum optio eius nemo rerum. Maiores facere laboriosam perspiciatis.</p>
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