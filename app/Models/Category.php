<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{

	use NodeTrait;

	protected $table = 'categories';
	protected $fillable = [
		'title',
		'slug',
		'sort',
		'visible'
	];

	protected static function boot(): void
	{
		parent::boot();
		static::creating(fn(Category $category) => $category->slug = Str::slug($category->title));
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
