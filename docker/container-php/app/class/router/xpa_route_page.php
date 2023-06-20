<?php

/**
 * xpa_route_page
 * 
 * created: 2023-05-15 16:29:56
 * author: applh/gaia
 * license: MIT
 */

/**
 * xpa_route_page
 */
class xpa_route_page
{
    //#class_start

    static function response($dirname = "", $filename = "", $extension = "")
    {
        // get the params from storage
        extract(xpa_os::kv("xpa_route_page::response") ?? []);

        $prefix = "pages";

        // echo "xp_route_blog::response($dirname)($filename)\n";
        // cut $dirname by /
        $dirname = trim($dirname, "/");
        $dirs = explode("/", $dirname);
        // print_r($dirs);

        $path_data = cli::kv("path_data");
        $article = "$path_data/$prefix/$filename.md";
        if (file_exists($article)) {
            xpa_route_page::response_md($article);
        }

        $notebook = "$path_data/$prefix/$filename.ipynb";
        if (file_exists($notebook)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            xpa_router::$mime_type = "text/javascript";

            $content = file_get_contents($notebook);
            $json = json_decode($content, true);
            $cells = $json["cells"] ?? [];
            print_r($cells);
        }

        $php_template = "$path_data/$prefix/$filename.php";
        if (file_exists($php_template)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            include $php_template;
        }
        $css_template = "$path_data/$prefix/$filename.css";
        if (file_exists($css_template)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            xpa_router::$mime_type = "text/css";

            header("Content-Type: text/css");
            include $css_template;
        }
        $js_template = "$path_data/$prefix/$filename.js";
        if (file_exists($js_template)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            xpa_router::$mime_type = "text/javascript";

            header("Content-Type: text/javascript");
            include $js_template;
        }
        // images extension
        $images = ["webp", "png", "svg", "jpg", "jpeg", "gif"];
        if (in_array($extension, $images)) {
            $image = "$path_data/$prefix/$filename.$extension";
            if (file_exists($image)) {
                // allow gaia cms mix with others cms
                xpa_router::$response_status = "200";
                xpa_router::$mime_type = "image/$extension";

                header("Content-Type: image/$extension");

                echo file_get_contents($image);
            }
        }
    }

    static function response_md($article)
    {
        // allow gaia cms mix with others cms
        xpa_router::$response_status = "200";
        xpa_router::$mime_type = "text/plain";

        $content = file_get_contents($article);
        // echo $content;
        $parsedown = new Parsedown();
        $html = $parsedown->text($content);

        // find all titles in $html
        $titles = [];
        $pattern = "/<h([1-6])>(.*)<\/h[1-6]>/";
        preg_match_all($pattern, $html, $matches);
        $html_titles = $matches[0];
        $text_titles = $matches[2];
        $level_titles = $matches[1];

        $tree_sections = [];
        $index_1 = 0;
        $index_2 = 0;
        $index_3 = 0;
        $index_4 = 0;
        $index_5 = 0;
        $index_6 = 0;
        foreach($html_titles as $i => $html_title) {
            $text_title = $text_titles[$i];
            $level_title = $level_titles[$i];
            $titles[] = [
                "text" => $text_title,
                "level" => $level_title,
            ];

            if ($level_title == 1) {
                $index_1++;
                $tree_sections[] = [
                    "text" => $text_title,
                    "level" => $level_title,
                    "children" => [],
                ];
            }

            if ($level_title == 2) {
                $index_2++;
                $tree_sections[$index_1 -1]["children"][] = [
                    "text" => $text_title,
                    "level" => $level_title,
                    "children" => [],
                ];
            }

            if ($level_title == 3) {
                $index_3++;
                $tree_sections[$index_1 -1]["children"][$index_2 -1]["children"][] = [
                    "text" => $text_title,
                    "level" => $level_title,
                    "children" => [],
                ];
            }

            // if ($level_title == 4) {
            //     $index_4++;
            //     $tree_sections[$index_1]["children"][$index_2]["children"][$index_3]["children"][] = [
            //         "text" => $text_title,
            //         "level" => $level_title,
            //         "children" => [],
            //     ];
            // }

            // if ($level_title == 5) {
            //     $index_5++;
            //     $tree_sections[$index_1]["children"][$index_2]["children"][$index_3]["children"][$index_4]["children"][] = [
            //         "text" => $text_title,
            //         "level" => $level_title,
            //         "children" => [],
            //     ];
            // }

            // if ($level_title == 6) {
            //     $index_6++;
            //     $tree_sections[$index_1]["children"][$index_2]["children"][$index_3]["children"][$index_4]["children"][$index_5]["children"][] = [
            //         "text" => $text_title,
            //         "level" => $level_title,
            //         "children" => [],
            //     ];
            // }

        }
        // print_r($tree_sections);

        $html_sections = xpa_route_page::build_sections($tree_sections);
        // echo $html_sections;

        // echo $html;
        $style =  '<link rel="stylesheet" href="/media/howto-style.css">';

        xpa_html::add_part("link", $style);
        xpa_html::add_part("main", $html_sections);
        xpa_html::page();
    }


    static function build_sections ($tree_sections, $tab="")
    {
        $html = "";
        foreach($tree_sections as $tree_section) {
            $text = $tree_section["text"];
            $level = $tree_section["level"];
            $hlevel = "h$level";
            $tag = ($level > 1) ? "section" : "main";

            $children = $tree_section["children"];

            // $html .= "<section>";
            // $html .= "<h$level>$text</h$level>";
            // $html .= xpa_route_page::build_sections($children);
            // $html .= "</section>";

            $html_children = xpa_route_page::build_sections($children, $tab . "    ");

            $html .=
            <<<HTML
            
            $tab<!--$level-->
            $tab<$tag class="s$level">
            $tab    <$hlevel>$text</$hlevel>
            $tab    $html_children
            $tab</$tag>

            HTML;
        }
        return $html;
    }

    //#class_end
}

//#file_end