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
            'name' => 'Jack',
            'gender' => '1',
            'email' => 'y23657689@gmail.com',
            'password' => bcrypt('jack0619'),
        ]);
        $user->job_title_id = 3;
        $user->save();

        $users = factory(UserEloquent::class, 9)->create();
    }
}
