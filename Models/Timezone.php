<?php

namespace CountryStateCity\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    use HasFactory;

	protected $fillable = [
		'zone_name', 'gmt_offset', 'gmt_offset_name', 'abbreviation', 'tz_name'
	];

	protected $casts = [
		'gmt_offset' => 'integer'
	];

	public function countries() {
		return $this->belongsToMany(Country::class, 'country_timezones');
	}
}
