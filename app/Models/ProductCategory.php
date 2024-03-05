<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
	protected $fillable = [
		'title',
		'slug',
		'sort',
		'visible'
	];

	protected static function boot(): void
	{
		parent::boot();
		static::creating(fn(ProductCategory $category) => $category->slug = Str::slug($category->title));
	}

	public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
	{
		return $this->belongsToMany(
			Product::class,
			'category_product',
			'category_id',
			'product_id'
		);
	}
}
