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
        xpa_os::task_add("xpa_controller::run", 10);
        xpa_os::task_add("xpa_user::build", 20);
        xpa_os::task_add("xpa_router::request", 30);
        xpa_os::task_add("xpa_view::run", 60);
    }


    //#class_end
}

//#file_end