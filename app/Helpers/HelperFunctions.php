<?php
/**
 * Created by PhpStorm.
 * User: jenish
 * Date: 29-04-2016
 * Time: PM 04:32.
 */
if (!function_exists('dump_die')) {
    function dump_die($obj, $die = true)
    {
        echo '<pre>';
        if (is_object($obj)) {
            var_dump($obj);
        } elseif (is_array($obj)) {
            print_r($obj);
        } else {
            echo $obj;
        }
        echo '</pre>';
        echo '<hr>';
        if ($die) {
            die(0);
        }
    }
}

if (!function_exists('get_request_json_arr')) {
    function get_request_json_arr()
    {
        $requestBody = file_get_contents('php://input');
        $request = json_decode($requestBody, true);
        if (!is_array($request)) {
            $request = Request::all();
        }

        return $request;
    }
}

if (!function_exists('sendMail')) {
    /**
     * Send Mail Helper Function that invoke send mail event
     * @param array $to
     * @param string $subject
     * @param bool $is_raw
     * @param string $view_name
     * @param array|null $view_data
     * @param string $raw_message
     * @return int
     */
    function sendMail($to, $subject, $is_raw, $view_name, $view_data, $raw_message)
    {
        $job = new App\Jobs\SendMailJob($to, $subject, $is_raw, $view_name, $view_data, $raw_message);
        $job->onQueue('email');
        //$job->delay(10);
        dispatch($job);
        //event(new \App\Events\SendMailEvent($to, $subject, $is_raw, $view_name, $view_data, $raw_message));
        return 0;
    }
}