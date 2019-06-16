<?php

namespace Bond211\ABTest\Models;

use Illuminate\Database\Eloquent\Model;

class ABTest extends Model
{
    protected $fillable = [
        'name',
    ];

    public function variants()
    {
        return $this->hasMany(ABTestVariant::class)->orderBy('name');
    }

    public static function findByName(string $name)
    {
        return ABTest::query()->firstOrCreate([
            'name' => $name,
        ]);
    }

    public function getGoalsCountAttribute()
    {
        return $this->variants()->get()
            ->map(function ($el) {
                return $el->goals_count;
            })
            ->sum();
    }

    public function getVariantsCountSumAttribute()
    {
        return $this
            ->variants()->get()
            ->map(function ($el) {
                return $el->count;
            })
            ->sum();
    }
}
