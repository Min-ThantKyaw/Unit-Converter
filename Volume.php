<?php
	class Volume {
		public static $conversionRates = [
			"Liter" => 1,
			"Milliliter" => 0.001,
			"Cubic Meter" => 1000,
			"Cubic Centimeter" => 0.001,
			"Gallon" => 3.78541,
			"Quart" => 0.946353,
			"Pint" => 0.473176,
			"Cup" => 0.236588,
			"Fluid Ounce" => 0.0295735,
		];

		public static function volumeConverter($value, $fromUnit, $toUnit) {
			if (!isset(self::$conversionRates[$fromUnit]) || !isset(self::$conversionRates[$toUnit])) {
				throw new Exception("Invalid unit for volume conversion.");
			}

			$baseValue = $value * self::$conversionRates[$fromUnit];
			return $baseValue / self::$conversionRates[$toUnit];
		}
	}