<?php

namespace App\Models;

use Domain\Catalog\Facades\Sorter;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Pipeline\Pipeline;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use Support\Casts\PriceCast;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;

class Product extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;
//    use Searchable;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'brand_id',
        'price',
        'on_home_page',
        'sorting',
        'text'
    ];

    protected $casts = [
        'price' => PriceCast::class
    ];

//    #[SearchUsingFullText(['title', 'text'])]
//    public function toSearchableArray()
//    {
//        return [
//            'title' => $this->title,
//            'text' => $this->text
//        ];
//    }

    protected function thumbnailDir(): string
    {
        return 'products';
    }

    public function scopeFiltered(Builder $query)
    {
        return app(Pipeline::class)
            ->send($query)
            ->through(filters())
            ->thenReturn();
//        $query->when(request('filters.brands'), function (Builder $q) {
//            $q->whereIn('brand_id', request('filters.brands'));
//        })->when(request('filters.price'), function (Builder $q) {
//            $q->whereBetween('price', [
//                request('filters.price.from', 0) * 100,
//                request('filters.price.to', 100000) * 100,
//            ]);
//        });
    }

    public function scopeSorted(Builder $query)
    {
        Sorter::run($query);
    }

    public function scopeHomePage(Builder $query)
    {
        $query->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(6);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)
            ->withPivot('value');
    }

    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class);
    }
}
