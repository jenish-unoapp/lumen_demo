<?php
/**
 * Created by PhpStorm.
 * User: jenish
 * Date: 29-04-2016
 * Time: PM 04:32
 */

if (!function_exists('dump_die')) {
    function dump_die($obj, $die = true)
    {
        echo "<pre>";
        if (is_object($obj)) {
            var_dump($obj);
        } else if (is_array($obj)) {
            print_r($obj);
        } else {
            echo $obj;
        }
        echo "</pre>";
        echo "<hr>";
        if ($die) die(0);
    }
}

if (!function_exists('get_request_json_arr')) {
    function get_request_json_arr()
    {
        $requestBody = file_get_contents('php://input');
        $request = json_decode($requestBody, true);
        if (!is_array($request)) $request = Request::all();
        return $request;

    }
}