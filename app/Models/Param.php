<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Param extends Model
{
	protected $fillable = [
		'sitename',
		'phone',
		'email',
		'telegram',
		'locate'
	];
}
