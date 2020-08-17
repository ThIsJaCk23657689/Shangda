<?php

use Illuminate\Database\Seeder;
use App\Announcement as AnnouncementEloquent;

class AnnouncementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $announcement = factory(AnnouncementEloquent::class, 20)->create();
    }
}
