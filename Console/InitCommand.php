<?php

namespace KSPEdu\Countries\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class InitCommand extends Command
{
	protected $signature = 'kspedu:countries {--force : Force init.}';

	protected $description = 'Init package';

	protected $localPath = 'countries' . DIRECTORY_SEPARATOR;

	protected $packageUrl = 'https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/';
	protected $files = ['countries.json', 'states.json', 'cities.json'];

	public function handle()
	{
		$this->callSilent('vendor:publish', ['--tag' => 'kspedu-countries-migrations', '--force' => true]);
		$this->callSilent('migrate');

		if ($this->downloadData()) {
			if ($this->countriesSeeder()) {
				if ($this->statesSeeder()) {
					if ($this->citySeeder()) {
						$this->info('Success!');
						return;
					}
				}
			}
		}
	}

	protected function downloadData()
	{
		foreach ($this->files as $file) {
			if (!Storage::exists($this->localPath . $file) || $this->option('force')) {
				Storage::put($this->localPath . $file, file_get_contents($this->packageUrl . $file));

				$this->info('Package initialized successfully!');
			}
		}

		return true;
	}

	protected function countriesSeeder()
	{
		foreach (json_decode(Storage::get($this->localPath . 'countries.json'), true) as $country) {

			$country = \KSPEdu\Countries\Models\Country::create([
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

			foreach ($timezones as $timezone) {
				$timezone = \KSPEdu\Countries\Models\Timezone::firstOrNew([
					'abbreviation' => $timezone['abbreviation'],
				], [
					'zone_name' => $timezone['zoneName'],
					'gmt_offset' => $timezone['gmtOffset'],
					'gmt_offset_name' => $timezone['gmtOffsetName'],
					'tz_name' => $timezone['tzName'],
				]);

				$timezone->countries()->attach($country);
			}
		}

		$this->info('Countries seeded with Timezones!');

		return true;
	}

	public function statesSeeder()
	{
		foreach (json_decode(Storage::get($this->localPath . 'states.json'), true) as $state) {
			\KSPEdu\Countries\Models\State::create([
				'name' => $state['name'],
				'country_id' => $state['country_id'],
				'state_code' => $state['state_code'],
				'latitude' => $state['latitude'],
				'longitude' => $state['longitude']
			]);
		}

		$this->info('States seeded!');

		return true;
	}

	protected function citySeeder()
	{
		foreach (json_decode(Storage::get($this->localPath . 'cities.json'), true) as $city) {
			\KSPEdu\Countries\Models\City::create([
				'name' => $city['name'],
				'state_id' => $city['state_id'],
				'latitude' => $city['latitude'],
				'longitude' => $city['longitude']
			]);
		}

		$this->info('Cities seeded!');

		return true;
	}
}
