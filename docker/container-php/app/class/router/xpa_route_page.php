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

    static $template = "";
    static $config = [];

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

        $lines = explode("\n", $content);
        $cur_line = 0;

        $tree_sections = [];
        $index_1 = 0;
        $index_2 = 0;
        $index_3 = 0;
        $index_4 = 0;
        $index_5 = 0;
        $index_6 = 0;
        foreach ($html_titles as $i => $html_title) {
            $text_title = $text_titles[$i];
            $level_title = $level_titles[$i];
            $bloc_infos = xpa_route_page::get_bloc($level_title, $text_title, $lines);
            $bloc = $bloc_infos["bloc"] ?? "";

            $titles[] = [
                "text" => $text_title,
                "level" => $level_title,
                "bloc" => $bloc,
            ];

            if ($level_title == 1) {
                $index_1++;
                $tree_sections[] = [
                    "text" => $text_title,
                    "bloc" => $bloc,
                    "level" => $level_title,
                    "children" => [],
                ];
            }

            if ($level_title == 2) {
                $index_2++;
                $tree_sections[$index_1 - 1]["children"][] = [
                    "text" => $text_title,
                    "bloc" => $bloc,
                    "level" => $level_title,
                    "children" => [],
                ];
            }

            if ($level_title == 3) {
                $index_3++;
                $tree_sections[$index_1 - 1]["children"][$index_2 - 1]["children"][] = [
                    "text" => $text_title,
                    "bloc" => $bloc,
                    "level" => $level_title,
                    "children" => [],
                ];
            }

            // HACK: as h4 are unused foe content, we use it for config
            // insert a codeblock in format 
            // ```json,meta
            // {
            //     "template": "uikit",
            //     "title": "my title",
            //     "description": "my description",
            //     "keywords": "my keywords",
            //     "image": "my image",
            //     "robots": "my robots",
            //     "canonical": "my canonical",
            //     "og:title": "my og:title",
            //     "og:description": "my og:description",
            //     "og:image": "my og:image",
            //     "og:url": "my og:url",
            //     "og:site_name": "my og:site_name",
            //     "og:type": "my og:type"
            // }
            if ($level_title == 4) {
                // get the markdown bloc
                $bloc_md = $bloc_infos["bloc_md"] ?? "";
                static::$config["bloc_md"] = $bloc_md;
                // FIXME: only one code bloc is allowed
                // extract the smallest json code bloc (not containing ```) betwwen lines starting with ```json,meta and ```
                $pattern = "/```json,meta\s(.*)```/s";
                $matches = [];
                preg_match($pattern, $bloc_md, $matches);                

                static::$config["matches"] = $matches;

                $json = trim($matches[1] ?? "");
                // decode json
                $json = json_decode($json, true);
                static::$config["page"] = $json;

                // find the bloc after the last ```
                // TODO: CHECK IF CODE IS CORRECT ?! 😱
                $pattern = "/.*```(.*)/s";
                preg_match($pattern, $bloc_md, $matches);
                static::$config["body_debug"] = $matches;
                static::$config["body_append"] = end($matches);
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

        static::$template = static::$config["page"]["template"] ?? "";
        $title = static::$config["page"]["title"] ?? "";
        $description = static::$config["page"]["description"] ?? $title;
        $body_append = static::$config["body_append"] ?? "";

        // debug header
        header("X-Xp-Template: " . static::$template);
        if (static::$template == "uikit") {
            $html_sections = xpa_route_page::build_sections_uikit($tree_sections);

            xpa_html::add_part("title", $title);
            xpa_html::add_part("description", $description);
            xpa_html::add_part("main", $html_sections);
            xpa_html::add_part("body_append", $body_append);

            static::$config["tree_sections"] = $tree_sections;
            $template_debug = json_encode(static::$config, JSON_PRETTY_PRINT);
            xpa_html::add_part("template_debug", $template_debug);

            xpa_os::template("uikit");
        }
        else if (static::$template != "") {
            $html_sections = xpa_route_page::build_sections($tree_sections);
            xpa_html::add_part("main", $html_sections);
            xpa_os::template(static::$template);
        }
        else {
            $html_sections = xpa_route_page::build_sections($tree_sections);
            $style =  '<link rel="stylesheet" href="/media/howto-style.css">';
    
            xpa_html::add_part("link", $style);
            xpa_html::add_part("main", $html_sections);
            xpa_html::page();    
        }
    }

    static function get_bloc ($level, $text, $lines)
    {
        static $parsedown = null;
        if ($parsedown == null) {
            $parsedown = new Parsedown();
        }

        static $cur_line = 0;
        static $lines_count = 0;
        // read each line and find start and end of bloc
        // start of bloc is the line after the title
        // end of bloc is the line before the next title
        if ($cur_line == 0) {
            $lines_count = count($lines);
        }
        $title = str_repeat("#", $level) . " " . $text;

        $bloc_start = $cur_line;
        $bloc_end = $lines_count;
        while ($cur_line < $lines_count) {
            $line = $lines[$cur_line];
            $cur_line++;
            // left pad $text with # to match the level
            if (trim($line) == $title) {
                $bloc_start = $cur_line;
                break;
            }
        }

        while ($cur_line < $lines_count) {
            $line = $lines[$cur_line];
            $cur_line++;
            // check: next title starts with ## as h1 is #
            if (strpos($line, "# ") > 0) {
                $bloc_end = $cur_line - 1;
                // warning: rewind to keep the next title
                $cur_line--; 
                break;
            }
        }
        $bloc_md = "";
        for ($i = $bloc_start; $i < $bloc_end; $i++) {
            // warning: don't remove left spaces (indentation)
            $bloc_md .= rtrim($lines[$i]) . "\n";
        }

        // $bloc = $parsedown->line($bloc);
        $bloc = $parsedown->text($bloc_md);

        return compact("bloc", "bloc_md");
    
    }

    static function build_sections($tree_sections, $tab = "", $tab0 = "    ")
    {
        $html = "";
        foreach ($tree_sections as $tree_section) {
            $text = $tree_section["text"];
            $level = $tree_section["level"];
            $hlevel = "h$level";
            $tag = ($level > 1) ? "section" : "main";

            $bloc = $tree_section["bloc"];

            $children = $tree_section["children"];
            $html_children = xpa_route_page::build_sections($children, $tab . $tab0);

            $html .=
            <<<HTML
            
            $tab<!--$level-->
            $tab<$tag class="s$level">
            $tab    <$hlevel>$text</$hlevel>
            $tab    $bloc
            $tab    $html_children
            $tab</$tag>

            HTML;
        }
        return $html;
    }

    static function build_sections_uikit ($tree_sections, $tab = "", $tab0 = "    ")
    {
        $html = "";
        $index_s2 = 0;
        $index_s3 = 0;
        foreach ($tree_sections as $tree_section) {
            $text = $tree_section["text"];
            $level = $tree_section["level"];
            $hlevel = "h$level";
            $bloc = $tree_section["bloc"];

            $children = $tree_section["children"];
            $html_children = xpa_route_page::build_sections_uikit($children, $tab . $tab0);

            if ($level == 1) {
                $html .=
                <<<HTML
                <main>
                    <div class="uk-section">
                        <div class="b1 uk-container">
                            <h1>$text</h1>
                            $bloc
                        </div>
                    </div>
                    $html_children
                </main>
                HTML;
            }

            if ($level == 2) {
                $index_s2++;
                $s2_class = "s2 uk-section s2-$index_s2";
                // check if config has extra css
                $extra_css = static::$config["page"]["css"]["s2-$index_s2"] ?? "";
                if ($extra_css) {
                    $s2_class .= " $extra_css";
                }

                $html .=
                <<<HTML
                $tab<section class="$s2_class" uk-parallax="bgy: -200">
                $tab    <div class="b2 uk-container">
                $tab        <h2>$text</h2>
                $tab        $bloc
                $tab    </div>
                $tab    <div class="uk-grid uk-flex-center uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@xl">
                $tab    $html_children
                $tab    </div>
                $tab</section>
                HTML;
            }

            if ($level == 3) {
                $index_s3++;
                $s3_class = "s3 uk-container s3-$index_s3";
                // check if config has extra css
                $extra_css = static::$config["page"]["css"]["s3-$index_s3"] ?? "";
                $s3_class .= $extra_css ?: " $extra_css";

                $html .=
                <<<HTML
                $tab    <div class="$s3_class">
                $tab        <h2>$text</h2>
                $tab        $bloc
                $tab    </div>
                HTML;
            }

        }
        return $html;

    }

    //#class_end
}

//#file_end