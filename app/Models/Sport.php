<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Athlete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sport extends Model
{
    public function events()
    {
        return $this->hasMany(Event::class, 'sport_id')->withDefault();
    }

    public function athletes()
    {
        return $this->belongsToMany(Athlete::class);
    }

}
