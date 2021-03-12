<?php

use Illuminate\Database\Seeder;
use App\User as UserEloquent;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = UserEloquent::create([
            'name' => 'Admin',
            'gender' => '1',
            'email' => 'admin@mail.com',
            'account' => 'admin',
            'password' => bcrypt('00000000'),
        ]);
        $user->job_title_id = 4;
        $user->save();

        $user = UserEloquent::create([
            'name' => '張鴻生',
            'gender' => '1',
            'email' => 'chang472199@yahoo.com.tw',
            'account' => 'bossboss',
            'password' => bcrypt('11141957'),
        ]);
        $user->job_title_id = 3;
        $user->save();

        $user = UserEloquent::create([
            'name' => '張淳喬',
            'gender' => '0',
            'email' => 'jo520520@gmail.com',
            'account' => 'jojojs',
            'password' => bcrypt('jack0619'),
        ]);
        $user->job_title_id = 3;
        $user->save();

        $user = UserEloquent::create([
            'name' => '張庭維',
            'gender' => '1',
            'email' => '967076@gmail.com',
            'account' => '967076',
            'password' => bcrypt('js460672'),
        ]);
        $user->job_title_id = 3;
        $user->save();

        $user = UserEloquent::create([
            'name' => '張竣傑',
            'gender' => '1',
            'email' => 'y23657689@gmail.com',
            'account' => '23657689',
            'password' => bcrypt('jack0619'),
        ]);
        $user->job_title_id = 3;
        $user->save();

        // $users = factory(UserEloquent::class, 8)->create();
    }
}
