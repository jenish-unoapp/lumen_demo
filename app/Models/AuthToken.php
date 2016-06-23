<?php
/**
 * Created by PhpStorm.
 * User: jenish
 * Date: 02-05-2016
 * Time: PM 12:28
 */

namespace App\Models;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed Id
 */
class AuthToken extends Model
{

    protected $table = 'auth_tokens';
    protected $hidden = array('user','id');
    protected $appends = array('formatted_data');

    public static function loginAsUser($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if ($user) {
            $data = array();
            $data['demo_data'] = 'Hello world';

            $authToken = new AuthToken();
            $authToken->Id = md5(time() + $user->Email);
            $authToken->UserId = $user->Id;
            $authToken->Data = serialize($data);
            $authToken->ExpireAt = date('Y-m-d H:i:s', strtotime("+ 30 days"));
            $authToken->save();


            return $authToken;
        } else {
            return null;
        }
    }

    public static function login($username, $password)
    {
        $user = User::where('Email', $username)
            ->first();

        if ($user && Hash::check($password, $user->Password)) {
            $data = array();
            $data['demo_data'] = 'Hello world';
            $authToken = new AuthToken();
            $authToken->Id = md5(time() + $username);
            $authToken->UserId = $user->Id;
            $authToken->Data = serialize($data);
            $authToken->ExpireAt = date('Y-m-d H:i:s', strtotime("+ 30 days"));
            $authToken->save();


            return $authToken;
        } else {
            return null;
        }
    }

    public function isExpired()
    {
        //$sql = "DELETE FROM auth_tokens WHERE expired_at < '" . Carbon::now()->addMonths(-1)->toDateString() . "'";
        //DB::delete(DB::raw($sql));
        $now = time();
        $expired_at = strtotime($this->ExpireAt);
        if ($now > $expired_at) {
            return true;
        }

        return false;
    }

    public function extendExpiry()
    {
        $this->ExpireAt = date('Y-m-d H:i:s', strtotime("+ 30 days"));
        $this->save();
    }

    public function getFormattedDataAttribute()
    {
        return unserialize($this->Data);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}