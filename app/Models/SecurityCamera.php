<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityCamera extends Model
{
    use HasFactory;

    public function safetyReports(){
        return $this->hasMany(SafetyReport::class);
    }
}
