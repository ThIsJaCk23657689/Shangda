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
            'name' => 'Jack',
            'gender' => '1',
            'email' => 'y23657689@gmail.com',
            'account' => '23657689',
            'password' => bcrypt('jack0619'),
        ]);
        $user->job_title_id = 4;
        $user->save();

        $user = UserEloquent::create([
            'name' => 'Jamie',
            'gender' => '1',
            'email' => 'jamie870116@gmail.com',
            'account' => 'jamie870116',
            'password' => bcrypt('jj12345678'),
        ]);
        $user->job_title_id = 4;
        $user->save();

        $users = factory(UserEloquent::class, 8)->create();
    }
}
