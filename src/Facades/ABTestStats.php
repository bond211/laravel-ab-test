<?php

namespace Bond211\ABTest\Facades;

use Bond211\ABTest\Models\ABTest;

class ABTestStats
{
    public static function getAllTestsStats()
    {
        return ABTest::query()
            ->with('variants.goals')
            ->get();
    }

    public static function getTestStats(string $testName)
    {
        ABTest::findByName($testName)
            ->with('variants.goals')
            ->get();
    }
}
