CREATE TABLE IF NOT EXISTS `devgroup_measure` (
  `id` int(11) NOT NULL,
  `type` enum('Acceleration','Angle','Area','Binary','Capacitance','Density','Energy','Force','Frequency','Illumination','Length','Lightness','Number','Power','Pressure','Speed','Temperature','Time','Torque','Volume','Weight') NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `rate` double NOT NULL,
  `format` varchar(255) DEFAULT '# $',
  `use_custom_formatter` tinyint(1) NOT NULL DEFAULT '0',
  `decimal_separator` varchar(255) NOT NULL DEFAULT '.',
  `thousand_separator` varchar(255) NOT NULL DEFAULT ' ',
  `min_fraction_digits` int(11) NOT NULL DEFAULT '1',
  `max_fraction_digits` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
INSERT INTO `devgroup_measure` (`id`, `type`, `name`, `unit`, `rate`, `format`, `use_custom_formatter`, `decimal_separator`, `thousand_separator`, `min_fraction_digits`, `max_fraction_digits`) VALUES
(1, 'Length', 'Meter', 'm', 1, '# $', 0, '.', ' ', 1, 2),
(2, 'Length', 'Kilometer', 'km', 1000, '# $', 0, '.', ' ', 1, 2),
(3, 'Length', 'Decimeter', 'dm', 0.1, '# $', 0, '.', ' ', 1, 2),
(4, 'Length', 'Centimeter', 'cm', 0.01, '# $', 0, '.', ' ', 1, 2),
(5, 'Length', 'Millimeter', 'mm', 0.001, '# $', 0, '.', ' ', 1, 2),
(6, 'Length', 'Mile', 'mi', 1609.344, '# $', 0, '.', ' ', 1, 2),
(7, 'Length', 'Inch', 'in', 0.0254, '# $', 0, '.', ' ', 1, 2),
(8, 'Length', 'Foot', 'ft', 0.3048, '# $', 0, '.', ' ', 1, 2),
(9, 'Length', 'Yard', 'yd', 0.89154, '# $', 0, '.', ' ', 1, 2),
(10, 'Weight', 'Kilogram', 'kg', 1, '# $', 0, '.', ' ', 1, 2),
(11, 'Weight', 'Gram', 'g', 0.001, '# $', 0, '.', ' ', 1, 2),
(12, 'Weight', 'Milligram', 'mg', 0.000001, '# $', 0, '.', ' ', 1, 2),
(13, 'Weight', 'Carat', 'ct', 0.0002, '# $', 0, '.', ' ', 1, 2),
(14, 'Weight', 'Pound', 'lb', 0.45359237, '# $', 0, '.', ' ', 1, 2),
(15, 'Weight', 'Pud', 'pud', 16.3, '# $', 0, '.', ' ', 1, 2),
(16, 'Weight', 'Ton', 'ton', 1000, '# $', 0, '.', ' ', 1, 2),
(17, 'Weight', 'Ounce', 'oz', 0.028349523, '# $', 0, '.', ' ', 1, 2);
ALTER TABLE `devgroup_measure`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `devgroup_measure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
