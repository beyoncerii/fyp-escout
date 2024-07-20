<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Level;
use App\Models\Skill;
use App\Models\Athlete;
use App\Models\Activity;
use App\Models\Schedule;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Athlete extends Authenticatable

{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'athlete';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'remarks',
    ];

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

    public function level()
    {
        //return $this->hasMany(Athlete::class, 'level_id', 'id');
        return $this->belongsTo(Level::class, 'level_id')->withDefault();
    }

    public function sports()
    {
        return $this->belongsToMany(Sport::class);
    }

    public function skills() {
        return $this->hasOne(Skill::class, 'athlete_id');
    }

    public function scouts()
    {
        return $this->hasMany(Scout::class, 'athlete_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'athlete_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }


}
