<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Privilege;
class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Privilege::factory()->count(3)->create();
    }
}
