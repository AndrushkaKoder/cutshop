<?php

namespace App\Models;

use App\Models\File\FileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
	use FileTrait;

	protected $fillable = [
		'title',
		'text',
		'slug',
		'sort',
		'visible',
		'vendor_id',
		'description',
		'text',
		'price',
		'in_main'
	];

	protected static function boot(): void
	{
		parent::boot();
		static::creating(fn(Product $product) => $product->slug = Str::slug($product->title));
	}

	public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
	{
		return $this->belongsToMany(
			ProductCategory::class,
			'category_product',
			'product_id',
			'category_id'
		);
	}

	public function vendor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Vendor::class, 'vendor_id');
	}

}
