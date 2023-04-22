<?php

// get text from GET request
$text = $_GET['text'] ?? 'Hello World!';

// build an image with the text
$image = imagecreatetruecolor(400, 30);
$background_color = imagecolorallocate($image, 0, 0, 0);

$text_color = imagecolorallocate($image, 255, 255, 255);
imagestring($image, 5, 5, 5,  $text, $text_color);

// output the image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
