<?php

namespace Bond211\ABTest\Facades;

use Bond211\ABTest\VariantSelectionFailedException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Facade;

class ABTest extends Facade
{
    const SESSION_STORAGE_PREFIX = 'ab-test';

    public static function all()
    {
        return session(self::SESSION_STORAGE_PREFIX);
    }

    public static function get(string $name)
    {
        $key = self::toSessionKeyName($name);

        return session($key, null);
    }

    public static function set(string $name, string $value): void
    {
        $key = self::toSessionKeyName($name);

        session([$key => $value]);
    }

    public static function finish(string $name): void
    {
        $key = self::toSessionKeyName($name);

        session([$key => null]);
    }


    /**
     * @param string $name
     * @param array $variants
     * @param null $weights
     * @return string
     * @throws VariantSelectionFailedException
     */
    public static function start(string $name, array $variants, $weights = null): string
    {
        $value = self::get($name);

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
            self::set($name, $value);

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

    private static function toSessionKeyName(string $name): string
    {
        return self::SESSION_STORAGE_PREFIX . '.' . $name;
    }
}
