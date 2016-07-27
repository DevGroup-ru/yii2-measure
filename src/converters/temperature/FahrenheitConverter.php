<?php

namespace DevGroup\Measure\converters\temperature;

use DevGroup\Measure\converters\MeasureConverterInterface;

/**
 * Class FahrenheitConverter
 * @package DevGroup\Measure\converters\temperature
 */
class FahrenheitConverter implements MeasureConverterInterface
{
    /**
     * @inheritdoc
     */
    public static function fromBase($value)
    {
        return ($value - 273.15) * 1.8 + 32;
    }

    /**
     * @inheritdoc
     */
    public static function toBase($value)
    {
        return ($value - 32) / 1.8 + 273.15;
    }
}
