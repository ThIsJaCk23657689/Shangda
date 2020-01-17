<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JobTitlesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SuppliperTableSeeder::class);
        $this->call(MaterialTableSeeder::class);
        $this->call(BasicMaterialTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);


    }
}
