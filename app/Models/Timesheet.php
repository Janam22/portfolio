<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;
    
    public function employee()
    {
        return $this->belongsTo(Admin::class, 'emp_id');
    }
}
