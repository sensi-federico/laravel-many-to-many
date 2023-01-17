<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['Html', 'css', 'js', 'php', 'sql', 'laravel'];
        foreach ($technologies as $tech) {
            $new_tech = new Technology();
            $new_tech->name = $tech;
            $new_tech->save();
        }
    }
}
