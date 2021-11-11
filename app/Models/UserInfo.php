<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
	protected $connection = 'sqlsrv';

    protected $table = 'USERINFO';
    
}
