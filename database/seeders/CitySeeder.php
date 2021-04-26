<?php

namespace Modules\Core\database\seeders;

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(json_decode(file_get_contents(__DIR__.'/../../data/cities.json'), true) as $city) {
			\Modules\Core\Models\City::create([
				'name' => $city['name'],
				'state_id' => $city['state_id'],
				'latitude' => $city['latitude'],
				'longitude' => $city['longitude']
			]);
		}
    }
}
