<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            $model->slug = $model->slug ??
                self::setSlug($model);
        });
    }

    public static function setSlug(Model $model): \Stringable
    {
        $slug = str($model->{self::slugFrom()})
            ->slug();

        return $slug
            ->append(self::appendSlug($model, $slug));
    }

    public static function appendSlug(Model $model, string $slug): string
    {
        $countCreatedSlugs = $model
            ->newQuery()
            ->where('slug', 'like', $slug . '%')
            ->count();

        return  $countCreatedSlugs > 0 ?
            '-' . $countCreatedSlugs + 1 :
            '';
    }

    public static function slugFrom(): string
    {
        return 'title';
    }
}
