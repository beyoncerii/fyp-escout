<?php

namespace App\Models;

use App\Models\Athlete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'reason', 'athlete_id'];

    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

}
