<?php
/**
 * xpa_api
 * 
 * created: 2023-07-25 14:24:58
 * author: applh/gaia
 * license: MIT
 */

/**
 * xpa_api
 */
class xpa_api
{
    //#class_start

    static $durations = [];

    static function directus_create ($proxy, $row)
    {

        $data = xpa_api::curl_exec($proxy, "POST", $row);

        return $data;
    }

    static function directus_delete ($proxy, $ids)
    {
        $data = xpa_api::curl_exec($proxy, "DELETE", $ids);

        return $data;
    }

    static function directus_update ($proxy, $id, $row)
    {
        $data = xpa_api::curl_exec("$proxy/$id", "PATCH", $row);

        return $data;
    }

    static function directus_read ($proxy)
    {
        // sort results by id DESC
        $proxy .= "?sort=-id";
        $data = xpa_api::curl_exec($proxy);

        return $data;
    }

    static function duration_ms () {
        static $start = null;
        // init only once
        $start ??= microtime(true);
    
        $end = microtime(true);
        $duration = $end - $start;
        // convert from seconds to milliseconds
        $duration *= 1000;
        // keep 3 digits
        $duration = round($duration, 3);
    
        return $duration;
    }
    
    static function curl_exec ($proxy, $method="GET", $row=[])
    {
        if ($method == "GET") {
        }

        $ch = curl_init($proxy);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HEADER, true);

        if ($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($row));
        }

        if ($method == "DELETE") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($row));
        }

        if ($method == "PATCH") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($row));
        }


        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        
        static::$durations["proxy-before"] = static::duration_ms();
        
        $data = curl_exec($ch);
        // add to durations array
        static::$durations["proxy-after"] = static::duration_ms();
        
        curl_close($ch);
        
        return $data;
    }

    //#class_end
}

//#file_end