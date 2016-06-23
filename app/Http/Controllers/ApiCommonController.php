<?php
/**
 * Created by PhpStorm.
 * User: jenish
 * Date: 02-05-2016
 * Time: PM 02:25
 */

namespace App\Http\Controllers;

use App\Events\ExampleEvent;
use App\Models\AuthToken;
use Carbon\Carbon;
use function Functional\drop_first;
use function Functional\drop_last;
use function Functional\every;
use function Functional\invoke;
use function Functional\map;
use function Functional\none;
use function Functional\reject;
use function Functional\select;
use function Functional\some;
use Stringy\Stringy as S;
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

        // Doc http://anahkiasen.github.io/underscore-php/
        /** @var Arrays $d */
        $d = Arrays::each($array, function ($value) {
            return $value * $value * $value;
        });


        $auth = AuthToken::all();

        // docs https://github.com/lstrojny/functional-php/blob/master/docs/functional-php.md
        // If all users token are Expired, extend them all
        if (every($auth, function ($a, $collectionKey, $collection) {
            /** @var AuthToken $a */
            return $a->isExpired();
        })) {
            invoke($auth, 'extendExpiry', [false]);
        }


        if (some($auth, function ($a, $collectionKey, $collection) {
            /** @var AuthToken $a */
            return $a->Id == '928ba90834c1dbe540371d3973dd64c8';
        })) {
            $r['some_message'] = "One of auth Id is 928ba90834c1dbe540371d3973dd64c8.";
        }

        if (
        none($auth, function ($a, $collectionKey, $collection) {
            return $a->Id == '928ba90834c1dbe540371d3973dd64c8d';
        })
        ) {
            $r['none_message'] = "none of auth Id is 928ba90834c1dbe540371d3973dd64c8d.";
        }


        $fn = function ($a, $collectionKey, $collection) {
            /** @var AuthToken $a */
            return $a->isExpired();
        };
        $r['expired_auth'] = select($auth, $fn);
        $r['valid_auth'] = reject($auth, $fn);


        $fn = function ($a, $index, $collection) {
            return $index <= 1;
        };

        // All auth except the first 2
        $r['except_first_two_auth'] = drop_first($auth, $fn);
        // All auth except the last 2
        $r['except_last_two_auth'] = drop_last($auth, $fn);

        //https://github.com/danielstjules/Stringy
        $r['a_string_manipulation'] = (string)S::create('Hello world')->reverse();

        $r['Data'] = $d;
        $r['Auth'] = $auth->toArray();
        $r['env'] = app()->environment();
        $r['timezone'] = config('app.timezone');
        $r['new_functional_php'] = map(range(0, 100), function ($v) {
            return $v + 1;
        });

        //$r['example_event'] = event(new ExampleEvent(['x' => 'y']));;

        $r['now'] = Carbon::now(new \DateTimeZone(config('app.timezone')));

        //\Log::addError("Hello world");
        \Log::addInfo("test", $r);

        $resp = RestResponseFactory::ok($r);
        return $resp->toJSON();

    }

}