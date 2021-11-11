<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Designation;
use App\Models\Department;
use App\Models\Process;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'secret', 'attendance_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function attendance()
    {
        return $this->hasMany('App\Models\Attendance', 'attendance_id', 'attendance_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}
