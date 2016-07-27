<?php

namespace DevGroup\Measure\converters;

interface MeasureTypeConverterInterface
{
    /**
     * Convert the value from one measure to another
     * @param mixed $value
     * @param \DevGroup\Measure\models\Measure $from
     * @param \DevGroup\Measure\models\Measure $to
     * @return mixed
     */
    public static function convert($value, $to, $from);
}
