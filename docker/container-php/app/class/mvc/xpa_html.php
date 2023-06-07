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

    static function page ()
    {
        echo "<!DOCTYPE html>\n";
        echo "<html lang=\"en\">\n";
        static::head();
        static::body();
        echo "</html>\n";
    }

    static function head ()
    {
        echo "<head>\n";
        static::meta();
        static::title0();
        static::link();
        static::script();
        echo "</head>\n";
    }

    static function meta ()
    {
        echo "<meta charset=\"UTF-8\">\n";
        echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    }

    static function title0 ($text = "title")
    {
        echo "<title>$text</title>\n";
    }

    static function link ()
    {
        echo <<<html
        <link rel="stylesheet" href="/media/style.css">
        html;
    }

    static function script ()
    {
        echo <<<html
        <script type="module" src="/media/script.js"></script>
        html;
    }

    static function body ()
    {
        echo "<body>\n";
        static::header();
        static::main();
        static::aside();
        static::footer();
        echo "</body>\n";
    }

    static function header ()
    {
        echo "<header>\n";
        static::content("header");
        echo "</header>\n";
    }

    static function footer ()
    {
        echo "<footer>\n";
        static::content("footer");
        echo "</footer>\n";
    }

    static function aside ()
    {
        echo "<aside>\n";
        static::content("aside");
        echo "</aside>\n";
    }

    static function nb_sections ()
    {
        return mt_rand(4, 8);
    }

    static function main ()
    {
        echo "<main>\n";
        static::title(1);
        static::content("main");
        static::picture();
        $nb_section = static::nb_sections();
        for ($i=0; $i<$nb_section; $i++) {
            static::section(2);
        }
        echo "</main>\n";
    }

    static function section ($level=2)
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
        $img = $imgs[mt_rand(0, count($imgs)-1)];

        if ($level == 2) {
            static::content("section-$level");
            static::picture($img);    
        }
        else {

            static::picture($img);
            // better layout if texts have different lengths
            static::content("section-$level");    
        }
        // IMPORTANT: stop recursive call
        // max level = 6
        if ($level < 3) {
            $nb_section = static::nb_sections();
            for ($i=0; $i<$nb_section; $i++) {
                static::section($level+1);
            }
        }
        echo "</section>\n";
    }

    static function title ($level)
    {
        echo "<h$level>title $level</h$level>\n";
    }

    static function content ($name)
    {
        echo "<p>$name</p>\n";
    }

    static function picture ($src="photo.jpg", $alt="photo")
    {
        echo <<<html
        <picture>
            <source srcset="$src" type="image/jpg">
            <img loading="lazy" src="$src" alt="$alt">
        </picture>
        html;
    }

    //#class_end
}

//#file_end