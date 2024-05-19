<?php

namespace App\Models;

use App\Models\Level;
use App\Models\Athlete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Level extends Model
{
    use HasFactory;

    public function athletes()
    {
        return $this->hasMany(Athlete::class, 'level_id')->withDefault();
    }
}
