<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckInOut extends Model
{
	protected $connection = 'sqlsrv';
	
   	protected $table = 'CHECKINOUT';

    public function userInfo()
    {
    	return $this->belongsTo(UserInfo::class, 'USERID', 'USERID');
    }
}
