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

        // $users = factory(UserEloquent::class, 8)->create();
    }
}
