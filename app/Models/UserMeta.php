<?php
/**
 * Created by PhpStorm.
 * User: jenish
 * Date: 02-05-2016
 * Time: PM 12:28
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{

    protected $table = 'user_meta';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'FirstName', 'LastName', 'BirthDate'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function fullName()
    {
        return $this->FirstName . " " . $this->LastName;
    }

    public function age()
    {
        return date_diff(date_create($this->BirthDate), date_create('today'))->y;
    }

}