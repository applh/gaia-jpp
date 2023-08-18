<?php

class index
{
    static function web()
    {
        ob_start();

        // compute execution time
        $start = microtime(true);

        $now = date("Y-m-d H:i:s");
        // echo "Hello World! $now";
        // phpinfo();

        $path_data = __DIR__ . "/../../my-data";
        // https://www.php.net/manual/en/function.realpath.php
        $path_data = realpath($path_data);

        if ($path_data !== false) {
            // echo "<br>path_data: $path_data";
            $path_db_news = "$path_data/db-news.sqlite";
            if (file_exists($path_db_news)) {
                // echo "<br>path_db_news: $path_db_news";
            } else {
                echo "<br>path_db_news: not found";
                $path_db_news = null;
            }
        } else {
            echo "<br>path_data: not found";
        }


        if ($path_db_news ?? false) {
            // connect with PDO
            $pdo = new PDO("sqlite:$path_db_news");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        if ($pdo ?? false) {
            $limit = intval($_REQUEST["limit"] ?? 1000);

            $oups = mt_rand(1, 100000);

            // https://www.php.net/manual/en/pdo.query.php
            $stmt = $pdo->prepare("SELECT * FROM news WHERE id NOT IN ( '$oups' ) ORDER BY id DESC LIMIT $limit");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // echo "<br>rows: " . count($rows);
            // echo '<div class="list" style="display:none;">' . json_encode([ "data" => $rows ]) . '</div>';
        } else {
            echo "<br>pdo: not found";
        }

        // compute execution time 
        $end = microtime(true);
        $duration = $end - $start;
        // show duration is ms
        $duration = round($duration * 1000);

        // echo "<br>duration: $duration ms";
        header('Content-Type: application/json');
        echo json_encode([
            "now" => $now,
            "total" => count($rows ?? []),
            "duration" => $duration,
            "oups" => $oups ?? "",
            "data" => $rows ?? [],
        ]);

        $html = ob_get_clean();
        echo $html;
    }
}

index::web();
