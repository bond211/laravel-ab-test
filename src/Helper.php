<?php

namespace Bond211\ABTest;

class Helper
{
    public static function filterVariantsWithGoals($variants)
    {
        return $variants
            ->filter(function ($el) {
                return count($el->goals);
            })
            ->values();
    }
}
