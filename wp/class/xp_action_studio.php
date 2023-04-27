<?php

use Drupal\Component\Utility\Html;

class xp_action_studio
{
    static $json = [];

    static function init()
    {
        add_action('wp_head', 'xp_action_studio::wp_head_meta_description');

        // add new rest route for json data: xperia/v1/json
        add_action("rest_api_init", "xp_action_studio::rest_api_init");

        add_action("admin_init", "xp_action_studio::admin_init");
        // WARNING: admin_menu can't be inside admin_init
        add_action("admin_menu", "xp_action_studio::admin_menu");

    }

    static function admin_init ()
    {

    }

    static function admin_menu ()
    {
        // add a new menu in the admin panel under the Plugins menu
        // https://developer.wordpress.org/redesign-test/reference/functions/add_plugins_page/
        add_plugins_page (
            "XP Studio",
            "XP Studio",
            "read",
            "xperia-studio",
            "xp_action_studio::admin_page"
        );

    }

    static function admin_page ()
    {
        echo <<<html
        <h1>XP Studio</h1>
        <form>
            <input type="text" name="m" value="test">
            <textarea name="data"></textarea>
            <button type="submit">Submit</button>
        </form>
        <div id="app">{{ message }}</div>
        <script type="module">
        // load vue js
        let vue = await import("/wp-json/xp-studio/v1/media?src=vue.esm-browser.prod.js");
        // create app
        const app = vue.createApp({
            data: function () {
                return {
                    message: "Hello Vue!"
                }
            }
        });
        // mount app
        app.mount("#app");
        </script>
        html;
    }

    // add a meta description in the header of each page
    static function wp_head_meta_description()
    {
        // get the title of the page and the blog description
        $blog_description = get_bloginfo('description');
        $title = get_the_title();
        echo <<<html
        <meta name="description" content="$title - $blog_description">
        html;
    }

    static function rest_api_init()
    {
        register_rest_route(
            "studio/v1",
            "/json",
            array(
                'methods' => ['GET', 'POST'],
                // FIXME: SHOULD BE MORE SECURE 😱
                "permission_callback" => function () {
                    return true;
                },
                // WARNING: check the callback name
                "callback" => "xp_action_studio::wp_json"
            )
        );

        // /wp-json/xp-studio/v1/json
        register_rest_route(
            "xp-studio/v1",
            "/json",
            array(
                'methods' => ['GET', 'POST'],
                // FIXME: SHOULD BE MORE SECURE 😱
                "permission_callback" => function () {
                    return true;
                },
                // WARNING: check the callback name
                "callback" => "xp_action_studio::wp_json"
            )
        );

        // /wp-json/xp-studio/v1/media
        register_rest_route(
            "xp-studio/v1",
            "/media",
            array(
                'methods' => ['GET', 'POST'],
                // FIXME: SHOULD BE MORE SECURE 😱
                "permission_callback" => function () {
                    return true;
                },
                // WARNING: check the callback name
                "callback" => "xp_action_studio::wp_json_media"
            )
        );
    }

    static function wp_json_media ()
    {
        // get request param media
        $media = $_REQUEST['src'] ?? '';
        if ($media) {
            // search in zip archive class.zip for the file media/$media
            $zip = new ZipArchive;
            $res = $zip->open(__DIR__ . "/class.zip");
            if ($res === TRUE) {
                // get the content
                $content = $zip->getFromName("media/$media");
                $zip->close();
                // get extension from media
                $ext = pathinfo($media, PATHINFO_EXTENSION);

                $mimes = [
                    "js" => "application/javascript",
                    "css" => "text/css",
                    "html" => "text/html",
                    "jpg" => "image/jpeg",
                    "png" => "image/png",
                    "gif" => "image/gif",
                    "svg" => "image/svg+xml",
                    "json" => "application/json",
                    "txt" => "text/plain",
                    "pdf" => "application/pdf",
                    "zip" => "application/zip",
                    "webp" => "image/webp",
                    "avif" => "image/avif",
                ];
                // set the header
                $mime_type = $mimes[$ext] ?? "application/octet-stream";
                header("Content-Type: $mime_type");
                // return the content
                echo $content;
                // FIXME: hack to avoid WP_Rest_Response wrapper
                die();
            }

        }
        else {
            // return json
            static::$json = [];
            static::$json['request'] = $_REQUEST;
    
            return static::$json;    
        }
    }

    static function wp_json()
    {
        static::$json = [];
        static::$json['time'] = date("Y-m-d H:i:s");
        static::$json['request'] = $_REQUEST;
        static::$json['files'] = $_FILES;

        $c = "xp_rest_api";
        $m = $_REQUEST['m'] ?? '';

        $callback = "$c::$m";
        static::$json['callback'] = $callback;
        if (is_callable($callback)) {
            static::$json['result'] = $callback() ?? "";
        }

        return static::$json;
    }
}
