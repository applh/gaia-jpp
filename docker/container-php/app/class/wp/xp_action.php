<?php

class xp_action
{
    static function plugins_loaded()
    {
        // https://developer.wordpress.org/reference/hooks/

        // register blocks before init 
        // as blocks are using init hook also
        xp_action::register_blocks();

        // add block
        add_action("init", "xp_action::init");
    }

    static function register_blocks ()
    {
        // register block in folder myblock/
        include dirname(__DIR__) . "/myblock/myblock.php";


        // register block with render callback
        // register_block_type(
        //     "xperia-bloc/render", 
        //     array(
        //         "api_version" => 2,
        //         "render_callback" => "xp_action::block_render"
        //     )
        // );
    }


    static function block_render ()
    {
        return date("Y-m-d H:i:s");
    }

    static function init () 
    {
        $plugin_url ??= plugin_dir_url(__DIR__);

        // add vue 
        $vue_js_url = "$plugin_url/media/vue-app.js";
        wp_register_script(
            "xperia/vue",
            $vue_js_url,
            [],
            "0.0.1"
        );
        // add vue as module
        // HACK: add type="module" to script tag
        add_filter("script_loader_tag", "xp_action::script_loader_tag", 10, 3);
        wp_enqueue_script("xperia/vue");

        // blocks need to enqueue scripts 
        // so don't register before init hook
        xp_action::register_block("render", "Render (xp)");

        // add new rest route for json data: xperia/v1/json
        add_action("rest_api_init", "xp_action::rest_api_init");
    }

    static function script_loader_tag ($tag, $handle, $src)
    {
        // HACK: add type="module" to script tag
        if ($handle == "xperia/vue") {
            $tag = str_replace('id=', 'type="module" id=', $tag);
        }
        return $tag;
    }

    static function rest_api_init ()
    {
        register_rest_route(
            "xperia/v1", 
            "/json",
            array(
                'methods' => ['GET', 'POST'],
                // FIXME: SHOULD BE MORE SECURE 😱
                "permission_callback" => function () { return true; },    
                "callback" => "xp_action::wp_json"
            )
        );
    }

    static function wp_json ()
    {
        $json = [];

        $json['time'] = date("Y-m-d H:i:s");
        $json['request'] = $_REQUEST;
        $json['files'] = $_FILES;

        return $json;
    }

    static function register_block($block_name, $title)
    {
        static $plugin_url = null;
        $plugin_url ??= plugin_dir_url(__DIR__);

        // dynamic block
        // https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/creating-dynamic-blocks/

        // automatically load dependencies and version
        $asset_file = array(
            'dependencies' =>
            array(
                'wp-blocks',
                'wp-element',
                'wp-polyfill'
            ),
            'version' => '0.1'
        );

        // get plugin_url
        $block_js_url = "$plugin_url/templates/block_js.php?block=$block_name&title=$title";
        // header("xp-block-js-url: $block_js_url");

        wp_register_script(
            "xperia/$block_name",
            $block_js_url,
            $asset_file['dependencies'],
            $asset_file['version']
        );

        register_block_type("xperia/$block_name", array(
            'api_version' => 2,
            'editor_script' => "xperia/$block_name", // The script name we gave in the wp_register_script() call.
            'render_callback' => 'xp_action::block_render',
        ));
    }

    static function admin_menu()
    {
        // add submenu in plugins
        add_plugins_page(
            "gaia-jpp", 
            "gaia-jpp",
             "manage_options", 
             "gaia-jpp", 
             "xp_action::admin_page"
        );
    }

    static function admin_page()
    {
        include dirname(__DIR__) . "/admin.php";
    }
    
}