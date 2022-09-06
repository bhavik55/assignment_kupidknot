<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PersonalDetail;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        $user1 = new User();
        $user1->name = 'admin';
        $user1->email =  'admin@gmail.com';
        $user1->password = bcrypt('123456');
        $user1->role = 'admin';
        $user1->save();

        $ran = array('male', 'female');
        $faker = Faker::create();
        for( $i=0; $i<50; $i++ ) {
            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->password = bcrypt('secret');
            $user->role = 'user';
            $user->email_verified_at = now();
            $user->google_id = '';
            $user->save();

            $pd = new PersonalDetail();
            $pd->userid = $user->id;
            $pd->gender = $ran[array_rand($ran, 1)];
            $pd->income = '100000';
            $pd->save();
        }
    }
}
