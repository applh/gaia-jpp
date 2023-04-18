<?php

class gaia_web
{
    static function server ()
    {
        require __DIR__ . "/../cli.php";
    }
}

gaia_web::server();
