<?php

class xp_action_studio
{
    static function init ()
    {
        add_action('wp_head', 'xp_action_studio::wp_head_meta_description');

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
    
}