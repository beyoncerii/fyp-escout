<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sports = [
            ['name' => 'Netball'],
            ['name' => 'Football'],
            ['name' => 'Basketball'],
            ['name' => 'Volleyball'],
            ['name' => 'Handball'],
            ['name' => 'Rugby'],
            ['name' => 'Frisbee'],
        ];

        Sport::insert($sports);
    }
}
