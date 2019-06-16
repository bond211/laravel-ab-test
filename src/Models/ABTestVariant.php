<?php

namespace Bond211\ABTest\Models;

use Illuminate\Database\Eloquent\Model;

class ABTestVariant extends Model
{
    protected $fillable = [
        'name',
        'a_b_test_id',
    ];
    public $timestamps = false;

    public function test()
    {
        return $this->belongsTo(ABTest::class);
    }

    public function goals()
    {
        return $this->hasMany(ABTestGoal::class)->orderBy('name');
    }

    public function getGoalsCountAttribute()
    {
        return $this->goals()->count();
    }

    public function getGoalsCountSumAttribute()
    {
        return $this
            ->goals()->get()
            ->map(function ($el) {
                return $el->count;
            })
            ->sum();
    }
}
