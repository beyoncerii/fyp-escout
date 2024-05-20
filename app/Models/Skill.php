<?php

namespace App\Models;

use App\Models\Athlete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = [
        'strength',
        'speed',
        'endurance',
        'focus',
        'reflex',
        'athlete_id'

    ];
    public function user() {
        return $this->belongsTo(Athlete::class , 'athlete_id');
    }
}
