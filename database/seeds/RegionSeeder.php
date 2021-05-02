<?php

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantityRegions = 160;
        factory(Region::class, $quantityRegions)->create();
    }
}
