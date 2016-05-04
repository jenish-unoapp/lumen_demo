<?php
/**
 * Created by PhpStorm.
 * User: jenish
 * Date: 02-05-2016
 * Time: PM 02:25
 */

namespace App\Http\Controllers;

use Auth;
use Exception;

use RestResponseFactory;

class UserApiController extends BaseApiController
{
    public function __construct()
    {
    }

    public function me()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                $resp = RestResponseFactory::badrequest((object)array(), "User not found for provided auth token.");
                return $resp->toJSON();
            }
            $resp = RestResponseFactory::ok($user);
            return $resp->toJSON();
        } catch (Exception $e) {
            $resp = RestResponseFactory::error((object)array(), $e->getMessage());
            return $resp->toJSON();
        }
    }

}