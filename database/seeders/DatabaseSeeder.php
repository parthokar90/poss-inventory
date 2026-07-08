<?php

use Illuminate\Database\Seeder;

use Database\Seeders\UserSeeder; 
use Database\Seeders\MasterDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // একে একে আপনার সিডার ক্লাসগুলো এখানে কল করুন
        $this->call([
            UserSeeder::class,
            MasterDatabaseSeeder::class,
        ]);
    }
}