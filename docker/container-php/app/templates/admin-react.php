<?php

$path_js = glob(__DIR__. "/react/dist/assets/*.js")[0];
$path_css = glob(__DIR__. "/react/dist/assets/*.css")[0];
$path_js = basename($path_js);
$path_css = basename($path_css);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vite + React + TS</title>
    <script type="module" crossorigin src="/template/react/dist/assets/<?php echo $path_js ?>"></script>
    <link rel="stylesheet" href="/template/react/dist/assets/<?php echo $path_css ?>">
  </head>
  <body>
    <div id="react-root"></div>
    
  </body>
</html>
