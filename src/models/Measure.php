<?php

namespace DevGroup\Measure\models;

use DevGroup\Measure\converters\MeasureConverterInterface;
use DevGroup\Measure\helpers\MeasureHelper;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\i18n\Formatter;
use yiister\mappable\ActiveRecordTrait;

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
 * @property string $converter_class_name
 */
class Measure extends \yii\db\ActiveRecord
{
    use ActiveRecordTrait;

    /**
     * @var Formatter $formatterInstance the instance of custom formatter
     */
    protected $formatterInstance;

    /**
     * Validate the converter class name
     * @param string $attribute
     * @param array $params
     */
    public function validateConverterClass($attribute, $params)
    {
        $className = $this->$attribute;
        if (class_exists($className) === true) {
            if (new $className instanceof MeasureConverterInterface === false) {
                $this->addError($attribute, MeasureHelper::t('Class does not implement `DevGroup\Measure\converters\MeasureConverterInterface` interface'));
            }
        } else {
            $this->addError($attribute, MeasureHelper::t('Class not found'));
        }
    }

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
            [['converter_class_name'], 'validateConverterClass'],
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
            'converter_class_name' => MeasureHelper::t('Converter class name'),
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

    /**
     * Get a measure model by unit name.
     * @param string $unit
     * @return null|\yii\db\ActiveRecord
     */
    public static function getByUnit($unit)
    {
        return static::getByAttribute('unit', $unit);
    }

    /**
     * Get measures by type name.
     * @param string $type
     * @return array of measures in the next format `measure_id => 'Measure name'`
     */
    public static function getMeasures($type)
    {
        /** @var ActiveQuery $query */
        $query = static::find()->select(['name', 'id'])->indexBy('id');
        if (empty($type) === false) {
            $query->where(['type' => $type]);
        }
        return $query->column();
    }

    public function search($params)
    {
        $this->load($params);
        $query = static::find();
        $partialAttributes = ['name', 'unit', 'format'];
        foreach ($this->attributes as $key => $value) {
            if (in_array($key, $partialAttributes)) {
                $query->andFilterWhere(['like', $key, $value]);
            } else {
                $query->andFilterWhere([$key => $value]);
            }
        }
        return new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
    }
}
