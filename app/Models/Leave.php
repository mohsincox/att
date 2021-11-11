<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Leave extends Model
{
    protected $table = 'leaves';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function leaveDetails()
    {
        return $this->hasMany('App\Models\LeaveDetail', 'leave_id');
    }

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function lineManager()
    {
    	return $this->belongsTo(User::class, 'line_manager_id');
    }
}
