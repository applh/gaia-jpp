<?php

class router_main
{
    static function index($params = [])
    {
        $template = "home";

        // find template file
        controller::load_template($template, $params);
    }

    static function app($params = [])
    {
        $template = "app";

        // find template file
        controller::load_template($template, $params);
    }

    static function api($params = [])
    {
        $template = "api";
        $params["content_type"] = "application/json";
        $params["show_result"] = false;
        // find template file
        controller::load_template($template, $params);
    }

    static function admin($params = [])
    {
        $template = "admin";

        // find template file
        controller::load_template($template, $params);
    }

    static function test_sql($params = [])
    {
        $template = "test-sql";
        $params["content_type"] = "application/json";
        $params["show_result"] = false;
        // find template file
        controller::load_template($template, $params);
    }
}
