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
        // $this->call(UsersTableSeeder::class);
        factory(App\user::class,20)->create();
        factory(App\Model\LP::class,5)->create();
        factory(App\Car::class,10)->create();
        factory(App\Log::class,10)->create();
    }
}
