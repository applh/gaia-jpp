<?php

class view 
{
    static function read () 
    {
        model::read();
        $rows = response::$rows ?? [];

        $html_bloc = "";
        foreach($rows as $index => $row) {

            // WARNING: VERY SLOW WITH DOCKER 😱
            // maybe looping and including files is not a good idea...
            // build html template item
            $html_item = view::load_template("item", [
                "row" => $row,
                "index" => $index
            ]);

            // OK: about same performance as json output
            $html_item = 
            <<<HTML
            <section>
                <h3>{$row["name"]}</h3>
                <p>{$index}, {$row["id"]}, {$row["email"]}</p>
            </section>
            HTML;

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

        // find template file
        $path_template = __DIR__ . "/../templates/$template.php";
        $path_template = realpath($path_template);
        if ($path_template !== false) {
            // // load template file and get html result in $html
            ob_start();
            // WARNING: VERY SLOW WITH DOCKER 😱
            // maybe looping and including files is not a good idea...
            // include $path_template;
            $html = ob_get_clean();
        }

        return $html ?? "";
    }
}