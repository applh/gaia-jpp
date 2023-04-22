<?php

class index
{
    static function web()
    {
        require dirname(__DIR__) . "/cli.php";
    }
}

index::web();
