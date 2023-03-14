<?php

namespace CountryStateCity\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

	protected $fillable = [
		'name', 'iso3', 'iso2', 'phone_code', 'capital',
		'currency', 'currency_symbol', 'tld', 'native',
		'region', 'subregion', 'latitude', 'longitude',
		'emoji', 'emojiU'
	];

	protected $casts = [];

	public function states() {
		return $this->hasMany(State::class);
	}

	public function timezones() {
		return $this->belongsToMany(Timezone::class, 'country_timezones');
	}
}
