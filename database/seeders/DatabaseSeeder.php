<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Provider;
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
         Provider::create(['name' => 'nike']);
         User::create(['name' => 'john doe', 'email' => 'john@localhost.com', 'password' => '124578']);
         Admin::create(['name' => 'admin admin', 'email' => 'admin@localhost.com', 'password' => 'admin']);
    }
}
