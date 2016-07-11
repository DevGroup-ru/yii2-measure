<?php

namespace DevGroup\Measure\models;

use DevGroup\Measure\helpers\MeasureHelper;
use Yii;
use yii\base\InvalidConfigException;
use yii\i18n\Formatter;

/**
 * This is the model class for table "{{%measure}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $unit
 * @property double $rate
 * @property integer $use_custom_formatter
 * @property string $format
 * @property string $decimal_separator
 * @property string $thousand_separator
 * @property integer $min_fraction_digits
 * @property integer $max_fraction_digits
 */
class Measure extends \yii\db\ActiveRecord
{
    /**
     * @var Formatter $formatterInstance the instance of custom formatter
     */
    protected $formatterInstance;

    /**
     * Get list of measure types.
     * @return array of types in the next format `'TypeName' => 'Translated type name'`
     */
    public static function getTypes()
    {
        $typesList = [];
        foreach (Yii::$app->db->getTableSchema(static::tableName())->columns['type']->enumValues as $type) {
            $typesList[$type] = MeasureHelper::t($type);
        }
        return $typesList;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%devgroup_measure}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name', 'unit', 'rate'], 'required'],
            [['type'], 'in', 'range' => array_keys(static::getTypes())],
            [['rate'], 'number'],
            [['use_custom_formatter', 'min_fraction_digits', 'max_fraction_digits'], 'integer'],
            [['name', 'unit', 'format', 'decimal_separator', 'thousand_separator'], 'string', 'max' => 255],
            ['unit', 'unique', 'targetAttribute' => ['unit']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => MeasureHelper::t('ID'),
            'type' => MeasureHelper::t('Type'),
            'name' => MeasureHelper::t('Name'),
            'unit' => MeasureHelper::t('Unit'),
            'rate' => MeasureHelper::t('Rate'),
            'use_custom_formatter' => MeasureHelper::t('Use custom formatter'),
            'format' => MeasureHelper::t('Format'),
            'decimal_separator' => MeasureHelper::t('Decimal separator'),
            'thousand_separator' => MeasureHelper::t('Thousand separator'),
            'min_fraction_digits' => MeasureHelper::t('Min fraction digits'),
            'max_fraction_digits' => MeasureHelper::t('Max fraction digits'),
        ];
    }

    /**
     * Returns \yii\i18n\Formatter instance for current Currency instance
     * @return \yii\i18n\Formatter
     * @throws InvalidConfigException
     */
    public function getFormatter()
    {
        if ($this->formatterInstance === null) {
            $this->formatterInstance = Yii::createObject(
                [
                    'class' => '\yii\i18n\Formatter',
                    'decimalSeparator' => $this->decimal_separator,
                    'thousandSeparator' => $this->thousand_separator,
                    'numberFormatterOptions' => [
                        \NumberFormatter::MIN_FRACTION_DIGITS => $this->min_fraction_digits,
                        \NumberFormatter::MAX_FRACTION_DIGITS => $this->max_fraction_digits,
                    ]
                ]
            );
        }
        return $this->formatterInstance;
    }
}
