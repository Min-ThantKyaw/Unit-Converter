<?php
	class Volume {
		public static $conversionRates = [
			"Cubic Meter" => 1,
			"Cubic Kilometer" => 1e9,
			"Cubic Centimeter" => 1e-6,
			"Liter" => 0.001,
			"Milliliter" => 1e-6,
			"Cubic Foot" => 0.0283168,
			"Cubic Inch" => 1.6387e-5,
			"Gallon" => 0.00378541,
		];

		public static function volumeConverter($value, $fromUnit, $toUnit) {
			if (!isset(self::$conversionRates[$fromUnit]) || !isset(self::$conversionRates[$toUnit])) {
				throw new Exception("Invalid unit for volume conversion.");
			}

			$baseValue = $value * self::$conversionRates[$fromUnit];
			return $baseValue / self::$conversionRates[$toUnit];
		}
	}