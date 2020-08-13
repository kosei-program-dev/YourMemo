<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'kosei';
        User::truncate();
        User::create(
        [
            'name' => 'kosei',
            'email' => 'kosei@kosei.com',
            'password' =>  Hash::make($password),
            'api_token' => Str::random(60),
        ]
    );
    }
}
