<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['name' => 'District'],
            ['name' => 'State'],
            ['name' => 'National'],
            ['name' => 'International'],
            ['name' => 'Amateur'],
            ['name' => 'Professional'],
        ];

        Level::insert($levels);
    }
}
