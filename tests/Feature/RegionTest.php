<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Region;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_region_can_be_stored()
    {
        $this->withoutExceptionHandling();
        $regionName = 'Region name';

        $this->post('regions', [
            'name' => $regionName
        ]);

        $this->assertCount(1, Region::all());
        $region = Region::first();

        $this->assertEquals($region->name, $regionName);
    }
    
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
