<?php

/**
 * xpa_html
 * 
 * created: 2023-05-17 18:50:09
 * author: applh/gaia
 * license: MIT
 */

/**
 * xpa_html
 */
class xpa_html
{
    //#class_start
    static $html_parts = [];
    static $md_files =  [];


    static function add_part($name, $content)
    {
        static::$html_parts[$name] = $content;
    }

    static function page()
    {
        echo "<!DOCTYPE html>\n";
        echo "<html lang=\"en\">\n";
        static::head();
        static::body();
        echo "</html>\n";
    }

    static function head()
    {
        echo "<head>\n";
        static::meta();
        static::title0();
        static::link();
        static::script();
        echo "</head>\n";
    }

    static function meta()
    {
        echo "<meta charset=\"UTF-8\">\n";
        echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    }

    static function title0($text = "title")
    {
        // check if present in $html_parts
        $content = static::$html_parts["title"] ?? null;
        if ($content) {
            echo "<title>$content</title>\n";
        } else {
            echo "<title>$text</title>\n";
        }
    }

    static function description($text = "description")
    {
        // check if present in $html_parts
        $content = static::$html_parts["description"] ?? null;
        if ($content) {
            echo
            <<<HTML
            <meta name="description" content="$content">

            HTML;
        } else {
            echo
            <<<HTML
            <meta name="description" content="$text">

            HTML;
        }
    }

    static function link()
    {
        // check if present in $html_parts
        $content = static::$html_parts["link"] ?? null;
        if ($content) {
            echo $content;
        } else {
            echo <<<html

        <!--
        <link rel="stylesheet" href="/media/style.css">
        <link rel="stylesheet" href="/media/anime.css">
        -->

        html;
        }
    }

    static function script()
    {
        echo <<<html

        <!--
        <script type="module" src="/media/script.js"></script>
        -->

        html;
    }

    static function ld_json()
    {
        // https://developers.google.com/search/docs/appearance/structured-data/search-gallery
        // https://developers.google.com/search/docs/appearance/structured-data/how-to
        // https://search.google.com/test/rich-results
        // https://search.google.com/structured-data/testing-tool

        $home = "https://$_SERVER[HTTP_HOST]";
        $url = "$home$_SERVER[REQUEST_URI]";
        $type = "HowTo"; // "WebSite";
        $title = "title";

        $tools = [];
        $supplies = [];
        $steps = [];
        $step = [
            "@type" => "HowToStep",
            "name" => "step 1",
            "url" => "$url#step1",
            "text" => "step 1",
            "image" => [
                "@type" => "ImageObject",
                "url" => "$home/media/smile-1.jpg",
                "height" => 100,
                "width" => 100,
            ],
        ];
        $steps[] = $step;
        // add a step
        $step = [
            "@type" => "HowToStep",
            "name" => "step 2",
            "url" => "$url#step2",
            "text" => "step 2",
            "image" => [
                "@type" => "ImageObject",
                "url" => "$home/media/smile-2.jpg",
                "height" => 100,
                "width" => 100,
            ],
        ];
        $steps[] = $step;

        $totalTime = "PT1H";

        $ld_json = [
            "@context" => "https://schema.org",
            "@type" => $type,
            "name" => $title,
            "url" => $url,
            "supply" => $supplies, // "https://schema.org/ItemList
            "tool" => $tools,
            "step" => $steps,
            "totalTime" => $totalTime,
        ];
        $script = json_encode($ld_json, JSON_PRETTY_PRINT);
        // stripslashes
        $script = str_replace("\\/", "/", $script);
        echo <<<html
        <script type="application/ld+json">
        $script
        </script>

        html;
    }

    static function body()
    {
        echo "<body>\n";
        static::header();
        static::main();
        static::aside();
        static::footer();
        echo "</body>\n";
    }

    static function header()
    {
        echo "<header>\n";
        static::content("header");
        echo "</header>\n";
    }

    static function charset()
    {
        echo
        <<<HTML
        <meta charset="utf-8">
        HTML;
    }

    static function viewport()
    {
        echo
        <<<HTML
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        HTML;
    }

    static function footer()
    {
        echo "<footer>\n";
        static::content("footer");
        echo "</footer>\n";
    }

    static function aside()
    {
        echo "<aside>\n";
        static::content("aside");
        echo "</aside>\n";
    }

    static function nb_sections()
    {
        return mt_rand(4, 8);
    }

    static function main()
    {
        // check if present in $html_parts
        $content = static::$html_parts["main"] ?? null;
        if ($content) {
            echo $content;
        } else {
            echo "<main>\n";
            static::title(1);
            static::content("main");
            static::picture();
            $nb_section = static::nb_sections();
            for ($i = 0; $i < $nb_section; $i++) {
                static::section(2);
            }
            echo "</main>\n";
        }
    }

    static function head_append($default = "")
    {
        // check if present in $html_parts
        $content = static::$html_parts["head_append"] ?? $default;
        if ($content) {
            echo $content;
        }
    }

    static function body_append($default = "")
    {
        // check if present in $html_parts
        $content = static::$html_parts["body_append"] ?? $default;
        if ($content) {
            echo $content;
        }
    }

    static function section($level = 2)
    {
        echo "<section class=\"s$level\">\n";
        static::title($level);

        $imgs = [
            "media/smile-1.jpg",
            "media/smile-2.jpg",
            "media/smile-3.jpg",
            "media/hand.webp",
            "media/cutout-1.webp",
            "media/cutout-2.webp",
            "media/cutout-3.webp",
            "media/cutout-4.webp",
            "media/html5.svg",
            "media/vue.svg",
            "media/graph-3d.svg",
            "media/tiger.svg",
            "media/earth.svg",
        ];
        $img = $imgs[mt_rand(0, count($imgs) - 1)];

        if ($level == 2) {
            static::content("section-$level");
            static::picture($img);
        } else {

            static::picture($img, "photo", "anim-scroll anim-pulse");
            // better layout if texts have different lengths
            static::content("section-$level");
        }
        // IMPORTANT: stop recursive call
        // max level = 6
        if ($level < 3) {
            $nb_section = static::nb_sections();
            for ($i = 0; $i < $nb_section; $i++) {
                static::section($level + 1);
            }
        }
        echo "</section>\n";
    }

    static function title($level)
    {
        echo "<h$level>title $level</h$level>\n";
    }

    static function content($name)
    {
        echo "<p>$name</p>\n";
    }

    static function picture($src = "photo.jpg", $alt = "photo", $class = "")
    {
        echo <<<html
        <picture>
            <source srcset="$src" type="image/jpg">
            <img  class="$class" loading="lazy" src="$src" alt="$alt">
        </picture>
        html;
    }

    static function template_debug()
    {
        // check if present in $html_parts
        $content = static::$html_parts["template_debug"] ?? null;

        if ($content) {
            // convert to base64 (to avoid code conflicts)
            $content = base64_encode($content);

            echo
            <<<HTML
            <template class="deb64">
            $content
            </template>
            <script type="module">
                document.querySelectorAll("template.deb64").forEach((template) => {
                    const content = template.innerHTML;
                    // convert from base64 to utf8
                    const decoded = atob(content);
                    // console.log(decoded);
                    // convert json to object
                    const obj = JSON.parse(decoded);
                    console.log(obj);
                });
            </script>
            HTML;
        }
    }

    static function get_bloc($path_markdown_file, $title, $show = true, $path_root = null)
    {
        $res = "";

        $path_root ??= xpa_os::kv("root");
        $search_file =  "$path_root/$path_markdown_file";
    
        // check if already loaded
        $blocs = static::$md_files[$search_file] ?? [];

        if (empty($blocs)) {

            if (file_exists($search_file)) {
                $content = file_get_contents($search_file);
                // trim
                $content = trim($content);
                if ($content) {
                    // split into rows
                    $rows = explode("\n", $content);
                    // loop on rows and extract blocs
                    $bloc = [];
                    foreach ($rows as $row) {
                        // rtrim
                        $row = rtrim($row);

                        // check if new bloc
                        if (preg_match("/^#/", $row)) {
                            // save previous bloc
                            if ($bloc) {
                                $bloc_title = $bloc["title"];
                                $blocs[$bloc_title] = $bloc;
                            }
                            // start new bloc
                            $bloc = [];
                            $bloc["title"] = $row;
                            $bloc["content"] = "";
                        } else {
                            // add row to current bloc
                            $bloc["content"] .= $row . "\n";
                        }
                    }

                    // save last bloc
                    if ($bloc) {
                        $bloc_title = $bloc["title"];
                        $blocs[$bloc_title] = $bloc;
                    }
                    // store the blocs for next calls
                    static::$md_files[$search_file] = $blocs;
                }
            }
        }

        // check if bloc exists
        if (isset($blocs[$title])) {
            $bloc = $blocs[$title];
            $res = $bloc["content"];
            // trim
            $res = trim($res);

            // strip tags ```html and ```
            // $res = preg_replace("/^```html/", "", $res);
            $res = ltrim($res, "```html");
            $res = rtrim($res, "```");
        }

        if ($show) echo $res;

        return $res;
    }

    static function lorem()
    {
        $lorem =
            <<<html
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Nulla vel odio vitae mag na aliquam aliquam. 
    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
    Nulla facilisi.
    il nec libero sit amet velit aliquet dictum.
    urba accumsan, nisl nec aliquam ultricies, nunc nisl aliquam nunc, id aliquam nunc nisl nec libero.
    
    html;

        echo $lorem;
    }

    static function template_markdown($template, $infos = [])
    {
        // fill missing path
        $template = "templates/markdown/$template.md";

        extract($infos);
        $lang ??= "en";
        $body_class ??= "";

        echo <<<HTML

        <!DOCTYPE html>
        <html lang="$lang">
        
        HTML;

        echo "\n<head>\n";

        xpa_html::charset();
        xpa_html::viewport();

        xpa_html::title0();
        xpa_html::description();

        xpa_html::ld_json();

        xpa_html::get_bloc($template, "## head");
        xpa_html::head_append();

        echo "\n</head>\n";
        echo <<<HTML
        <body class="$body_class">

        HTML;

        xpa_html::get_bloc($template, "## header");
        xpa_html::main();
        xpa_html::get_bloc($template, "## aside");
        xpa_html::get_bloc($template, "## footer");
        xpa_html::get_bloc($template, "## body");

        foreach($body_blocs ?? [] as $body_bloc) {
            $bloc_template = $body_bloc["template"] ?? "";
            $bloc_title = $body_bloc["title"] ?? "";
            $path_root = $body_bloc["path_root"] ?? null;
            xpa_html::get_bloc($bloc_template, $bloc_title, path_root: $path_root);
        }

        xpa_html::body_append();

        xpa_html::template_debug();

        echo "\n</body>\n";
        echo "\n</html>\n";
    }

    //#class_end
}

//#file_end