<?php
/**
 * xpa_framework
 * 
 * created: 2023-05-25 20:22:59
 * author: applh/gaia
 * license: MIT
 */

/**
 * xpa_framework
 */
class xpa_framework
{
    //#class_start


    static function setup ()
    {
        xpa_os::task_add("xpa_controller::cache_read", 10);
        xpa_os::task_add("xpa_controller::cache_start", 20);
        xpa_os::task_add("xpa_controller::run", 30);
        xpa_os::task_add("xpa_user::build", 40);
        xpa_os::task_add("xpa_router::request", 50);
        xpa_os::task_add("xpa_view::run", 70);
        xpa_os::task_add("xpa_controller::cache_end", 80);
    }


    //#class_end
}

//#file_end