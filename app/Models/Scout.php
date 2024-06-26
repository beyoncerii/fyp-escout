<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scout extends Model
{
    use HasFactory;

    protected $fillable = [
        'athlete_id',
        'coach_id',
    ];

    public function coach() {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function athlete() {
        return $this->belongsTo(Athlete::class, 'athlete_id');
    }
}
