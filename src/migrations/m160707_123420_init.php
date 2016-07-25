<?php

use DevGroup\Measure\models\Measure;
use yii\db\Migration;

class m160707_123420_init extends Migration
{
    public function up()
    {
        $tableOptions = $this->db->driverName === 'mysql'
            ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
            : null;
        $this->createTable(
            Measure::tableName(),
            [
                'id' => $this->primaryKey(),
                'type' => "ENUM('Acceleration','Angle', 'Area', 'Binary', 'Capacitance', 'Density', 'Energy', 'Force', 'Frequency', 'Illumination', 'Length', 'Lightness', 'Number', 'Power', 'Pressure', 'Speed', 'Temperature', 'Time', 'Torque', 'Volume', 'Weight') NOT NULL",
                'name' => $this->string()->notNull(),
                'unit' => $this->string()->notNull(),
                'rate' => $this->double()->notNull(),
                'format' => $this->string()->defaultValue('# $'),
                'use_custom_formatter' => $this->boolean()->notNull()->defaultValue(false),
                'decimal_separator' => $this->string()->notNull()->defaultValue('.'),
                'thousand_separator' => $this->string()->notNull()->defaultValue(' '),
                'min_fraction_digits' => $this->integer()->notNull()->defaultValue(1),
                'max_fraction_digits' => $this->integer()->notNull()->defaultValue(2),
            ],
            $tableOptions
        );
        $this->createIndex(
            'ix-measure-type',
            Measure::tableName(),
            'type'
        );
        $this->createIndex(
            'ix-measure-unit',
            Measure::tableName(),
            'unit',
            true
        );
        $this->batchInsert(
            Measure::tableName(),
            ['name', 'type', 'unit', 'rate', 'format'],
            [
                // Length
                ['Meter', 'Length', 'm', 1, '# $'],
                ['Kilometer', 'Length', 'km', 1000, '# $'],
                ['Decimeter', 'Length', 'dm', 0.1, '# $'],
                ['Centimeter', 'Length', 'cm', 0.01, '# $'],
                ['Millimeter', 'Length', 'mm', 0.001, '# $'],
                ['Mile', 'Length', 'mi', 1609.344, '# $'],
                ['Inch', 'Length', 'in', 0.0254, '# $'],
                ['Foot', 'Length', 'ft', 0.3048, '# $'],
                ['Yard', 'Length', 'yd', 0.89154, '# $'],
                // Weight
                ['Kilogram', 'Weight', 'kg', 1, '# $'],
                ['Gram', 'Weight', 'g', 0.001, '# $'],
                ['Milligram', 'Weight', 'mg', 0.000001, '# $'],
                ['Carat', 'Weight', 'ct', 0.0002, '# $'],
                ['Pound', 'Weight', 'lb', 0.45359237, '# $'],
                ['Pud', 'Weight', 'pud', 16.3, '# $'],
                ['Ton', 'Weight', 'ton', 1000, '# $'],
                ['Ounce', 'Weight', 'oz', 0.028349523, '# $'],
            ]
        );
    }

    public function down()
    {
        $this->dropTable(Measure::tableName());
    }
}
