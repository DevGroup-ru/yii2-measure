<?php

namespace DevGroup\Measure\helpers;

use DevGroup\Measure\models\Measure;
use Yii;
use yii\base\Exception;

class MeasureHelper
{
    /**
     * @var array of converters in the next format:
     *  [
     *      // The key is a string value from Measure->type attribute
     *      // The value is a string with full converter class name.
     *      // This class must implements the `MeasureTypeConverterInterface`
     *      'Weight' => 'DevGroup\Measure\converters\DefaultMeasureTypeConverter',
     *  ]
     */
    public static $converters = [];

    /**
     * Convert a value from one measure to another
     * @param float $value
     * @param Measure $from
     * @param Measure $to
     * @return float
     * @throws Exception
     */
    public static function convert($value, $to, $from)
    {
        if ($from instanceof Measure === false || $to instanceof Measure === false) {
            throw new Exception('`from` or `to` parameter is not a Measure');
        }
        if ($from->type !== $to->type) {
            throw new Exception('Measures have different types');
        }
        if ($from->id == $to->id) {
            return $value;
        }
        $converterClass = isset(static::$converters[$to->type]) === true
            ? static::$converters[$to->type]
            : 'DevGroup\Measure\converters\DefaultMeasureTypeConverter';
        return $converterClass::convert($value, $to, $from);
    }

    /**
     * Format a value by rule as a string
     * @param double $value
     * @param Measure $to
     * @param Measure|null $from
     * @return string
     * @throws Exception
     */
    public static function format($value, $to, $from = null)
    {
        if ($to instanceof Measure === false) {
            throw new Exception('Unknown object');
        }
        if ($from instanceof Measure) {
            $value = static::convert($value, $to, $from);
        }
        $formatter = $to->use_custom_formatter == true ? $to->formatter : \Yii::$app->formatter;
        return strtr(
            $to->format,
            [
                '#' => $formatter->asDecimal($value),
                '$' => static::t($to->unit),
            ]
        );
    }

    /**
     * Parse string by regexp or closure.
     * @param string $source
     * @param \Closure[]|string[]|\Closure|string $matchRules
     * @return false|float
     */
    public static function parseString($source, $matchRules)
    {
        foreach ((array) $matchRules as $matchRule) {
            if (is_callable($matchRule) === true) {
                return call_user_func($matchRule, $source);
            } else {
                if (preg_match($matchRule, $source, $matches) === 1) {
                    $value = $matches['integral'];
                    if (isset($matches['fractional'])) {
                        $value .= '.' . $matches['fractional'];
                    }
                    return (double) $value;
                }
            }
        }
        return false;
    }

    /**
     * Translates a message to the specified language.
     *
     * This is a shortcut method of [[\yii\i18n\I18N::translate()]].
     *
     * The translation will be conducted according to the message category and the target language will be used.
     *
     * You can add parameters to a translation message that will be substituted with the corresponding value after
     * translation. The format for this is to use curly brackets around the parameter name as you can see in the following example:
     *
     * ```php
     * $username = 'Alexander';
     * echo \Yii::t('Hello, {username}!', ['username' => $username]);
     * ```
     *
     * Further formatting of message parameters is supported using the [PHP intl extensions](http://www.php.net/manual/en/intro.intl.php)
     * message formatter. See [[\yii\i18n\I18N::translate()]] for more details.
     *
     * @param string $message the message to be translated.
     * @param array $params the parameters that will be used to replace the corresponding placeholders in the message.
     * @param string $language the language code (e.g. `en-US`, `en`). If this is null, the current
     * [[\yii\base\Application::language|application language]] will be used.
     * @return string the translated message.
     */
    public static function t($message, $params = [], $language = null)
    {
        return Yii::t('measure', $message, $params, $language);
    }
}
