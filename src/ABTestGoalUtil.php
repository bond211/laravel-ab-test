<?php

namespace Bond211\ABTest;

use Bond211\ABTest\Models\ABTestGoal;

class ABTestGoalUtil
{
    public static function getUplift(ABTestGoal $goal): float
    {
        $variants = $goal->variant->test->variants;
        $baseVariant = $variants[0];
        $baseVariantGoal = $baseVariant->goals->filter(function ($el) use ($goal) {
            return $el->name === $goal->name;
        })->first();

        if (!$baseVariantGoal) {
            return NAN;
        }

        $baseConversionRate = self::getConversionRate($baseVariantGoal);
        $conversionRate = self::getConversionRate($goal);

        return ($conversionRate - $baseConversionRate) / $baseConversionRate;
    }

    public static function getConversionRate(ABTestGoal $goal)
    {
        return $goal->count / $goal->variant->count;
    }
}
