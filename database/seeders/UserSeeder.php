<?php

namespace Database\Seeders;

use App\Models\Guarantor;
use App\Models\User;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Profile::factory()->count(10)->create();
    }
}
