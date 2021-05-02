<?php

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantityDestinations = 250;
        factory(Destination::class, $quantityDestinations)->create();
    }
}
