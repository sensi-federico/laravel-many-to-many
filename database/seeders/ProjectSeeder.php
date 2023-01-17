<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $new_project = new Project();
            $new_project->title = $faker->sentence(3);
            $new_project->slug = Str::slug($new_project->title, '-');
            $new_project->cover = 'placeholders/' . $faker->image('storage/app/public/placeholders', 600, 300, $new_project, false, false);
            $new_project->overview = $faker->text('300');
            $new_project->save();
        }
    }
}
