<?php

namespace App\Http\Middleware;

use App;
use App\Models\AuthToken;
use Auth;
use Closure;
use RestResponseFactory;

class AuthMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            $auth_id = $request->header('Authorization');
            if (empty($auth_id)) {
                $resp = RestResponseFactory::unauthorized((object)array(), "Session token is required.");
                return $resp->toJSON();
            }
            $auth = AuthToken::where('Id', $auth_id)->first();
            if (!$auth) {
                $resp = RestResponseFactory::unauthorized((object)array(), "Invalid session token.");
                return $resp->toJSON();
            }
            if ($auth->isExpired()) {
                $resp = RestResponseFactory::unauthorized((object)array(), "Session token has expired.");
                return $resp->toJSON();
            }
        }
        return $next($request);
    }
}
