<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class LeaveDetail extends Model
{
    protected $table = 'leave_details';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
