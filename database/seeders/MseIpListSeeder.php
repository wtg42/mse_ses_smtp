<?php

namespace Database\Seeders;

use App\Models\MseIpList;
use Illuminate\Database\Seeder;

class MseIpListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MseIpList::truncate();
        MseIpList::factory(10)->create();
    }
}
