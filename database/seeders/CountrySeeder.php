<?php

namespace Modules\Core\database\seeders;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(json_decode(file_get_contents(__DIR__.'/../../data/countries.json'), true) as $country) {
			
			$country = \Modules\Core\Models\Country::create([
				'name' => $country['name'],
				'iso3' => $country['iso3'],
				'iso2' => $country['iso2'],
				'phone_code' => $country['phone_code'],
				'capital' => $country['capital'],
				'currency' => $country['currency'],
				'currency_symbol' => $country['currency_symbol'],
				'tld' => $country['tld'],
				'native' => $country['native'],
				'region' => $country['region'],
				'subregion' => $country['subregion'],
				'latitude' => $country['latitude'],
				'longitude' => $country['longitude'],
				'emoji' => $country['emoji'],
				'emojiU' => $country['emojiU']
			]);
			
			$timezones = $country['timezones'];
			
			foreach($timezones as $timezone) {
				$timezone = \Modules\Core\Models\Timezone::firstOrNew([
					'abbreviation' => $timezone['abbreviation'],
				],[
					'zone_name' => $timezone['zoneName'],
					'gmt_offset' => $timezone['gmtOffset'],
					'gmt_offset_name' => $timezone['gmtOffsetName'],
					'tz_name' => $timezone['tzName'],
				]);
				
				$timezone->countries()->attach($country);
			}
		}
    }
}
