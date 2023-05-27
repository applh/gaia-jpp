<?php
/**
 * xpa_cms
 * 
 * created: 2023-05-25 20:22:59
 * author: applh/gaia
 * license: MIT
 */

/**
 * xpa_cms
 */
class xpa_cms
{
    //#class_start

    static function run ()
    {
        xpa_task::add("framework/setup", "xpa_framework::setup");
        xpa_task::add("os/mix", "xpa_os::mix");
    }

    //#class_end
}

//#file_end