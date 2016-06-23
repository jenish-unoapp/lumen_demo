<?php
/**
 * Created by PhpStorm.
 * User: jenish
 * Date: 02-05-2016
 * Time: PM 02:25
 */

namespace App\Http\Controllers;

use App\Models\AuthToken;
use RestResponseFactory;
use Underscore\Types\Arrays;

//use Underscore\Types\Functions

class ApiCommonController extends BaseApiController
{
    public function __construct()
    {
    }


    public function test()
    {
        $array = array(1, 2, 3);

        /** @var Arrays $d */
        $d = Arrays::each($array, function ($value) {
            return $value * $value * $value;
        });

        $auth = AuthToken::all();

        $r['Data'] = $d;
        $r['Auth'] = $auth->toArray();
        $r['env'] = app()->environment();
        $r['timezone'] = config('app.timezone');

        \Log::addInfo("test", $r);

        $resp = RestResponseFactory::ok($r);
        return $resp->toJSON();

    }

}