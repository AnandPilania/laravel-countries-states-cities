<?php

namespace KSPEdu\Countries\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'name', 'state_id', 'latitude', 'longitude'
	];
	
	public function state() {
		return $this->belongsTo(State::class);
	}
}
