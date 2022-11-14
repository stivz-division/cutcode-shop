<?php

namespace Support\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            $model->makeSlug();
//            $model->slug = $model->slug ??
//                self::setSlug($model);
        });
    }

    protected function makeSlug(): void
    {
        if (isset($this->{$this->slugColumn()})) {
            return;
        }

        $slug = $this->slugUnique(
            str($this->{$this->slugFrom()})
                ->slug()
                ->value()
        );

        $this->{$this->slugColumn()} = $slug;
    }

//    public static function setSlug(Model $model): \Stringable
//    {
//        $slug = str($model->{self::slugFrom()})
//            ->slug();
//
//        return $slug
//            ->append(self::appendSlug($model, $slug));
//    }

//    public static function appendSlug(Model $model, string $slug): string
//    {
//        $countCreatedSlugs = $model
//            ->newQuery()
//            ->where('slug', 'like', $slug . '%')
//            ->count();
//
//        return $countCreatedSlugs > 0 ?
//            '-' . $countCreatedSlugs + 1 :
//            '';
//    }

    private function slugUnique(string $slug): string
    {
        $originalSlug = $slug;
        $i = 0;

        while ($this->isSlugExists($slug)) {
            $i++;

            $slug = $originalSlug . '-' . $i;
        }

        return $slug;
    }

    private function isSlugExists(string $slug): bool
    {
        $query = $this->newQuery()
            ->where(self::slugColumn(), $slug)
            ->where($this->getKeyName(), '!=', $this->getKey())
            ->withoutGlobalScopes();

        return $query->exists();
    }

    protected function slugColumn(): string
    {
        return 'slug';
    }

    protected function slugFrom(): string
    {
        return 'title';
    }
}
