<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vendor extends Model
{
	protected $fillable = [
		'title',
		'slug',
		'visible',
		'in_main'
	];

	protected static function boot(): void
	{
		parent::boot();
		static::creating(fn(Vendor $vendor) => $vendor->slug = Str::slug($vendor->title));
	}

	public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(Product::class, 'vendor_id');
	}


}
