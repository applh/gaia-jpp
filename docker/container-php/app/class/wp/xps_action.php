<?php

class xps_action
{
    static $json = [];
    static $template = "";
    static $cms_mix = "";
    static $local_dir = "";

    static function init()
    {
        // setup data dir for domain name
        static::init_data_dir();

        xps_action::$cms_mix = get_option("xps_cms_mix", "wp");
        // WARNING: possible values "wp" or "gaia"

        // "gaia" 
        // will give priority to gaia cms on home page and other pages
        // then "wp" will handle 404 response status code from GAIA
        // "wp"
        // will give priority to WP cms on home page and other pages
        // then "gaia" will handle 404 response status code from WP
        // TODO: more complex mix integrations between CMS

        // WARNING: 🔥 maybe the plugin can override WP core (and kill WP code)
        xps_action::cms_priority();
        // activate cache
        xps_action::init_cache();
        // WARNING: CACHE CAN STOP WP HERE IF CACHE IS ACTIVE
        // (that's why cache is useful to consume less PHP resources... 🔥😱)

        // if WP is still active, then we can add our own actions
        add_action('wp_head', 'xps_action::wp_head_meta_description');

        // add new rest route for json data: xperia/v1/json
        add_action("rest_api_init", "xps_action::rest_api_init");

        add_action("admin_init", "xps_action::admin_init");
        // WARNING: admin_menu can't be inside admin_init
        add_action("admin_menu", "xps_action::admin_menu");

        // WARNING: cache build can happen here...
        add_filter("template_include", "xps_action::template_include");

    }

    static function init_cache ()
    {
        // only cache when not logged in
        xpa_controller::$cache_active = false;
        if (!is_user_logged_in()) {
            xpa_controller::$cache_active = true;
            xpa_controller::cache_read("wp@");
            xpa_controller::cache_start();
        }

        // FIXME: NOT WORKING ?!
        // setup cache capture at the end
        // add_action("shutdown", "xps_action::shutdown");
    }

    static function shutdown ()
    {
        // xpa_controller::cache_end("wp@");
    }

    static function init_data_dir()
    {
        $xp_data_dir = WP_PLUGIN_DIR . "/xps-data";
        // create the directory if it doesn't exist
        if (!is_dir($xp_data_dir)) {
            mkdir($xp_data_dir);
            // create index.php
            $plugin_header =
            <<<php
            <?php
            /**
             * Plugin Name: XP Studio Data 🔥
             */
            php;

            file_put_contents($xp_data_dir . "/index.php", $plugin_header);
        }


        // WARNING: WP admin is redirecting to default domain (installed...)
        $host = $_SERVER["HTTP_HOST"];
        // replace non alphanumeric characters with -
        $host = preg_replace("/[^a-zA-Z0-9]/", "-", $host);
        // lowercase
        $host = strtolower($host);
        $host = trim($host, "-");
        $search_local = "$xp_data_dir/$host-*";
        $dirs = glob($search_local);
        if (count($dirs) == 0) {
            // WARNING: 🔥 only one local dir is supported
            $md5 = xpa_os::randomd5();
            $local_dir = $xp_data_dir . "/$host-$md5";
            // if not exists create the directory
            if (!is_dir($local_dir)) {
                mkdir($local_dir);
            }
            // store the local dir for later use
            static::$local_dir = $local_dir;
        }
        else {
            // WARNING: 🔥 only one local dir is supported
            static::$local_dir = $dirs[0];
        }
    }


    static function cms_priority()
    {
        $uri = $_SERVER["REQUEST_URI"];
        $host = $_SERVER["HTTP_HOST"];

        // GAIA cms has priority over WP
        $path_root = xp_studio::$plugin_dir;

        // WARNING: when using GAIA as WP plugin, data dir is not the same
        xpa_os::kv("path_data", dirname(static::$local_dir));

        if (xps_action::$cms_mix == "gaia") {

            $path_index = "$path_root/public/index.php";

            ob_start();
            include_once $path_index;
            $content = ob_get_clean();
            if (xpa_router::$response_status == "200") {
                // TODO: add mix mode where WP would customize GAIA content
                echo $content;
                // GAIA has provided the content
                // don't run WP
                die();
            }
            // else {
            //     echo $path_index;
            //     echo "<br>";
            //     echo xpa_router::$response_status;
            //     die();
            // }
        }
        // TODO: add cache system form GAIA and WP pages
        // TODO: add mix mode where GAIA would cache then customize WP content
        // TODO: add mix mode where GAIA would load a different WP page
        //     (for example: multi-domains homepages are simply WP pages)
    }

    static function template_include($template)
    {
        // Old trick in WP to catch 404
        // then we can use our own template
        $uri = $_SERVER["REQUEST_URI"];
        // WP has priority then GAIA
        if (xps_action::$cms_mix == "wp") {
            // NOTE: many WP plugins could use 404 hook to add their own pages
            // better leave 404 pages to WP and WP plugins ?!

            // if wp doesn't want this uri, then we can use our own template
            if (is_404()) {
                // keep the original template
                xps_action::$template = $template;

                $template = xp_studio::$plugin_dir . "/templates/wp/template-catch-404.php";
            }
        }

        if (xpa_controller::$cache_active) {
            if ($template) {
                // HACK: build the response here
                include $template;
                xpa_controller::cache_end("wp@");
                $template = xp_studio::$plugin_dir . "/templates/wp/empty.php";
            }
        }

        return $template;
    }

    static function admin_init()
    {
    }

    static function admin_menu()
    {
        // add a new menu in the admin panel under the Plugins menu
        // https://developer.wordpress.org/redesign-test/reference/functions/add_plugins_page/
        add_plugins_page(
            "XP Studio",
            "XP Studio",
            "manage_options",
            "xperia-studio",
            "xps_action::admin_page"
        );
        // add css for the admin page
        add_action("admin_head", "xps_action::admin_head");
    }

    static function admin_head()
    {
        // add css for the admin page
        wp_enqueue_style(
            "xperia-studio",
            "/wp-json/xp-studio/v1/media?src=xp-studio-admin.css",
            [],
            "0.0.1"
        );
        // add css for element-plus
        wp_enqueue_style(
            "xps-element-plus",
            "/template/element-plus/index.css",
            [],
            "0.0.1"
        );
        // add css for element-plus
        wp_enqueue_style(
            "xps-admin-css",
            "/template/wp/template-admin.css",
            [],
            "0.0.1"
        );


    }

    static function admin_page()
    {
        $xp_admin_key = get_option("xp_rest_api_admin_key");
        // trim
        $xp_admin_key = trim($xp_admin_key);
        if (!$xp_admin_key) {
            // create a random md5 key
            $xp_admin_key = md5(uniqid(rand(), true));
            // save the key in the database
            update_option("xp_rest_api_admin_key", $xp_admin_key);
        }

        $cms_mix = get_option("xps_cms_mix", null);
        if ($cms_mix == null) {
            // default is WP
            xps_action::$cms_mix = "wp";
            update_option("xps_cms_mix", xps_action::$cms_mix);
            $cms_mix = xps_action::$cms_mix;
        }

        $template_admin = xp_studio::$plugin_dir . "/templates/wp/template-admin.php";
        ob_start();
        include_once $template_admin;
        $template_vue = ob_get_clean();

        $app_json = [
            "cms_mix" => $cms_mix,
            "xp_admin_key" => $xp_admin_key,
        ];
        $template_json = json_encode($app_json, JSON_PRETTY_PRINT);

        echo <<<html

        <div id="app" data-xp-admin-key="$xp_admin_key"></div>
        <template id="app-template">
        $template_vue
        </template>
        <template id="app-json">
        $template_json
        </template>
        <script type="importmap">
        {
            "imports": {
                "vue": "/template/vue/vue.esm-browser.js",
                "ElementPlus": "/template/element-plus/index.full.mjs",
                "XpwAdmin": "/template/wp/xpw-admin.js"
            }
        }
        </script>
        <script type="module" src="/template/wp/xp-studio-admin.js">
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
                "callback" => "xps_action::wp_json"
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
                "callback" => "xps_action::wp_json"
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
                "callback" => "xps_action::wp_json_media"
            )
        );
    }

    static function wp_json_media()
    {
        // get request param media
        $media = $_REQUEST['src'] ?? '';
        if ($media) {
            $zip_file = xp_studio::$plugin_dir . "/class.zip";
            // check if the zip file exists
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
            $content = null;
            if (!file_exists($zip_file)) {
                // check in folder media/wp 
                // FIXME: should be more secure
                $file = xp_studio::$plugin_dir . "/media/wp/$media";
                if (file_exists($file)) {
                    // get the content
                    $content = file_get_contents($file);
                }
            } else {
                // search in zip archive class.zip for the file media/$media
                $zip = new ZipArchive;
                $res = $zip->open($zip_file);
                if ($res === TRUE) {
                    // get the content
                    $content = $zip->getFromName("media/$media");
                    $zip->close();
                }
            }
            if ($content) {
                // get extension from media
                $ext = pathinfo($media, PATHINFO_EXTENSION);

                // set the header
                $mime_type = $mimes[$ext] ?? "application/octet-stream";
                header("Content-Type: $mime_type");
                // return the content
                echo $content;
                // FIXME: hack to avoid WP_Rest_Response wrapper
                die();
            }
        } else {
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
