<?php

class xp_action_studio
{
    static $json = [];

    static function init()
    {
        add_action('wp_head', 'xp_action_studio::wp_head_meta_description');

        // add new rest route for json data: xperia/v1/json
        add_action("rest_api_init", "xp_action_studio::rest_api_init");
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
