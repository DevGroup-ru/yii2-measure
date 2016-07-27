<?php

namespace DevGroup\Measure\converters;

/**
 * Interface MeasureConverterInterface
 * @package DevGroup\Measure\converters
 */
interface MeasureConverterInterface
{
    /**
     * Convert the value from current measure to base
     * @param mixed $value
     * @return mixed
     */
    public static function toBase($value);

    /**
     * Convert the value from base measure to base current
     * @param mixed $value
     * @return mixed
     */
    public static function fromBase($value);
}
