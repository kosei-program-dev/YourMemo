<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use App\Note;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Note::truncate();
        Note::create([
            'user_id'    => 1,
            'comment'    => 'test comment',
            'url'        => 'test url',
            'evaluation' => $faker->randomFloat(1,1,5),
        ]);
    }
}
