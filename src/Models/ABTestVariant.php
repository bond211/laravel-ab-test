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
}
