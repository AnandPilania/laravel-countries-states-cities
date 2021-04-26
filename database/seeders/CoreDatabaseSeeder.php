<?php

namespace Modules\Core\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call([
			CountrySeeder::class,
			//StateSeeder::class,
			//CitySeeder::class,
		]);
    }
}
