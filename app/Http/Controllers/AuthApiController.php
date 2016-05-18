<?php
/**
 * Created by PhpStorm.
 * User: jenish
 * Date: 02-05-2016
 * Time: PM 02:25
 */

namespace App\Http\Controllers;


use App\Models\AuthToken;
use App\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use RestResponseFactory;

class AuthApiController extends BaseApiController
{
    public function __construct()
    {
    }

    public function login()
    {
        try {
            $req = get_request_json_arr();
            $errors = array();
            $validator = Validator::make(
                $req,
                array(
                    'email' => 'required|email',
                    'password' => 'required'
                )
            );
            if ($validator->fails())
                $errors = array_merge($errors, $validator->messages()->all(':message'));
            if (count($errors) > 0) {
                $resp = RestResponseFactory::badrequest((object)array(), "" . implode("", $errors) . "");
                return $resp->toJSON();
            }
            dump_die($req);

            if ($auth = AuthToken::login($req['email'], $req['password'])) {
                //dump_die($auth->UserId);
                $result = User::with('meta')->find($auth->UserId);
                unset($result->Password);
                $resp = RestResponseFactory::ok($result);
                $resp->session = $auth->toArray();
                return $resp->toJSON();
            } else {
                $resp = RestResponseFactory::badrequest((object)array(), "Invalid Username/Password");
                return $resp->toJSON();
            }

        } catch (Exception $e) {
            $resp = RestResponseFactory::error((object)array(), $e->getMessage());
            return $resp->toJSON();
        }
    }

}