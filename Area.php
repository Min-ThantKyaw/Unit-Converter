<?php
class Area {
	public static $conversionRates = [
		"Square Meter" => 1,
		"Square Kilometer" => 1e6,
		"Square Mile" => 2.59e6,
		"Acre" => 4046.86,
		"Hectare" => 10000,
	];
	public static function areaConverter($value, $fromUnit, $toUnit) {
		if (!isset(self::$conversionRates[$fromUnit]) || !isset(self::$conversionRates[$toUnit])) {
			throw new Exception("Invalid unit for area conversion.");
		}

		$baseValue = $value * self::$conversionRates[$fromUnit];
		return $baseValue / self::$conversionRates[$toUnit];
	}

}