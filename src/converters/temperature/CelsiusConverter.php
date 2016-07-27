<?php

namespace DevGroup\Measure\converters\temperature;

use DevGroup\Measure\converters\MeasureConverterInterface;

/**
 * Class CelsiusConverter
 * @package DevGroup\Measure\converters\temperature
 */
class CelsiusConverter implements MeasureConverterInterface
{
    /**
     * @inheritdoc
     */
    public static function fromBase($value)
    {
        return $value - 273.15;
    }

    /**
     * @inheritdoc
     */
    public static function toBase($value)
    {
        return $value + 273.15;
    }
}
