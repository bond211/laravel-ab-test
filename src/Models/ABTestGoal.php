<?php

namespace Bond211\ABTest\Models;

use Illuminate\Database\Eloquent\Model;

class ABTestGoal extends Model
{
    protected $fillable = [
        'name',
        'a_b_test_variant_id',
    ];
    public $timestamps = false;
}
