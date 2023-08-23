<?php
// workaround headers already sent
ob_start();
include __DIR__ . "/lib/adminer.php";
response::$content = ob_get_clean();