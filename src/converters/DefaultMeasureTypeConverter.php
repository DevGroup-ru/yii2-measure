<?php

namespace DevGroup\Measure\converters;

/**
 * Class DefaultMeasureTypeConverter
 * @package DevGroup\Measure\converters
 */
class DefaultMeasureTypeConverter implements MeasureTypeConverterInterface
{
    /**
     * @inheritdoc
     */
    public static function convert($value, $to, $from)
    {
        $baseMeasureValue = empty($from->converter_class_name) === false
            ? call_user_func([$from->converter_class_name, 'toBase'], $value)
            : $value * $from->rate;
        return empty($to->converter_class_name) === false
            ? call_user_func([$to->converter_class_name, 'fromBase'], $baseMeasureValue)
            : $baseMeasureValue / $to->rate;
    }
}
