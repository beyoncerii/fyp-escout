<?php

namespace App\Models;

use App\Models\Sport;
use App\Models\Staff;
use App\Models\Athlete;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'venue',
        'capacity',
        'StartDate',
        'EndDate',
        'staff_id',
        'message',
        'sport_id',
    ];

    public function sports()
    {
        return $this->belongsTo(Sport::class, 'sport_id')->withDefault();
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function athlete()
    {
        return $this->belongsToMany(Athlete::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }


}
