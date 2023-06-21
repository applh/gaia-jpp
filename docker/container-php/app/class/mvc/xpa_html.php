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
                    console.log(decoded);
                });
            </script>
            HTML;
        }
    }

    //#class_end
}

//#file_end