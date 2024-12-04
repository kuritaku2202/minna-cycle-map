<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityStaff extends Model
{
    use HasFactory;
    protected $table = 'security_staffs';

    public function safetyReports(){
        return $this->hasMany(SafetyReport::class);
    }
}
