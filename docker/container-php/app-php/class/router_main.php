<?php

class router_main
{
    // add here specific routes
}


/**
 * Helper class to auomatically route to a template
 */
class etc_router_main
{
    /**
     */
    static function index ($params)
    {
        // try automatic template from filename
        $template = $params["filename"] ?? "";
        // WARNING: COULD BE TOO DANGEROUS AS IT ALLOWS TO LOAD ANY FILE
        $template = basename($template);
                
        // find template file
        controller::load_template($template, $params);

    }
}
