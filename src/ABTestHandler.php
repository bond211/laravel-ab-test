<?php

namespace Bond211\ABTest;

use Bond211\ABTest\Models\ABTest;
use Bond211\ABTest\Models\ABTestGoal;
use Bond211\ABTest\Models\ABTestVariant;
use Illuminate\Support\Arr;

class ABTestHandler
{
    const SESSION_STORAGE_PREFIX = 'ab-test';

    public static function getAllTests()
    {
        return session(self::SESSION_STORAGE_PREFIX);
    }

    public static function getTestVariant(string $name)
    {
        $key = self::toSessionKeyName($name);

        return session($key, null);
    }


    private static function toSessionKeyName(string $name): string
    {
        return self::SESSION_STORAGE_PREFIX . '.' . $name;
    }

    public static function setTestVariant(string $name, string $value)
    {
        $key = self::toSessionKeyName($name);

        session([$key => $value]);
    }

    public static function clearTest(string $name)
    {
        $key = self::toSessionKeyName($name);

        session([$key => null]);
    }

    public static function increaseGoalCount(string $testName, string $goalName)
    {
        $test = ABTest::query()->where([
            'name' => $testName,
        ])->first();

        $variantName = self::getTestVariant($testName);
        $variant = ABTestVariant::query()->where([
            'a_b_test_id' => $test->id,
            'name' => $variantName,
        ])->first();

        ABTestGoal::query()->firstOrCreate([
            'name' => $goalName,
            'a_b_test_variant_id' => $variant->id,
        ])->increment('count');
    }

    /**
     * @param string $name
     * @param array $variants
     * @param $weights
     * @return string
     * @throws VariantSelectionFailedException
     */
    public static function startTest(string $name, array $variants, $weights)
    {
        $value = self::getTestVariant($name);

        if ($value != null) {
            return $value;
        }

        if (Arr::isAssoc($variants)) {
            $weights = array_values($variants);
            $variants = array_keys($variants);
        }

        $weights = self::validateOrGenerateWeights($weights, $variants);
        $weightsSum = array_sum($weights);

        try {
            $num = random_int(1, $weightsSum);
        } catch (\Exception $e) {
            throw new VariantSelectionFailedException($e->getMessage(), 0, $e);
        }

        $weightsTmpSum = 0;
        foreach ($weights as $idx => $weight) {
            $weightsTmpSum += $weight;

            if ($weightsTmpSum < $num) {
                continue;
            }

            $value = $variants[$idx];
            self::setTestVariant($name, $value);
            self::increaseVariantCount($name, $value);

            return $value;
        }

        throw new VariantSelectionFailedException();
    }

    private static function validateOrGenerateWeights($weights, $variants)
    {
        $variantsCount = count($variants);

        if ($weights !== null) {
            if (count($weights) !== $variantsCount) {
                throw new \InvalidArgumentException('Weights and variants count must match.');
            }

            return $weights;
        }

        return self::generateWeights($variantsCount);
    }

    private static function generateWeights($count)
    {
        return array_fill(0, $count, 1);
    }

    private static function increaseVariantCount(string $testName, $variantName)
    {
        $test = ABTest::query()->firstOrCreate([
            'name' => $testName,
        ]);

        ABTestVariant::query()->firstOrCreate([
            'a_b_test_id' => $test->id,
            'name' => $variantName,
        ])->increment('count');
    }
}
