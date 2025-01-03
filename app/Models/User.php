<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    public function suspiciousReports(){
        return $this->hasMany(SuspiciousReport::class);
    }

    public function incidentReports(){
        return $this->hasMany(IncidentReport::class);
    }

    public function safetyReports(){
        return $this->hasMany(SafetyReport::class);
    }

    public function suspiciousReportComments(){
        return $this->hasMany(SuspiciousReportComment::class);
    }

    public function incidentReportComments(){
        return $this->hasMany(IncidentReportComment::class);
    }

    public function safetyReportComments(){
        return $this->hasMany(SafetyReportComment::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
