<?php

namespace Bond211\ABTest\Facades;

use Bond211\ABTest\ABTestHandler;
use Bond211\ABTest\VariantSelectionFailedException;
use Illuminate\Support\Facades\Facade;

class ABTest extends Facade
{
    /**
     * @param string $name
     * @param array $variants
     * @param null $weights
     * @return string|null
     */
    public static function start(string $name, array $variants, $weights = null)
    {
        try {
            return ABTestHandler::startTest($name, $variants, $weights);
        } catch (VariantSelectionFailedException $e) {
            return null;
        }
    }

    public static function all()
    {
        return ABTestHandler::getAllTests();
    }

    public static function get(string $name)
    {
        return ABTestHandler::getTestVariant($name);
    }

    public static function set(string $name, string $value): void
    {
        ABTestHandler::setTestVariant($name, $value);
    }

    public static function finish(string $name): void
    {
        ABTestHandler::clearTest($name);
    }

    public static function end(string $name): void
    {
        ABTestHandler::clearTest($name);
    }

    public static function clear(string $name): void
    {
        ABTestHandler::clearTest($name);
    }

    public static function goal(string $testName, string $goalName): void
    {
        ABTestHandler::increaseGoalCount($testName, $goalName);
    }
}
