<?php

class index
{
    static function web ()
    {
        include __DIR__ . "/../cli.php";
    }
}

index::web();