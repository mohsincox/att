<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = ['attendance_id', 'employee_name', 'department_name', 'entry_date', 'day_of_week', 'leave_or_absent', 'login', 'logout', 'created_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'attendance_id', 'attendance_id');
    }
}
