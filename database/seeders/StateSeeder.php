<?php

namespace Modules\Core\database\seeders;

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(json_decode(file_get_contents(__DIR__.'/../../data/states.json'), true) as $state) {
			\Modules\Core\Models\State::create([
				'name' => $state['name'],
				'country_id' => $state['country_id'],
				'state_code' => $state['state_code'],
				'latitude' => $state['latitude'],
				'longitude' => $state['longitude']
			]);
		}
    }
}
