<?php

class Temperature
{
	public function temperatureConverter($value, $fromUnit, $toUnit)
	{
		if ($fromUnit === $toUnit) {
			return $value;
		}

		// Convert from the base unit to Celsius
		switch ($fromUnit) {
			case "Celsius":
				$celsiusValue = $value;
				break;
			case "Fahrenheit":
				$celsiusValue = ($value - 32) * 5 / 9;
				break;
			case "Kelvin":
				$celsiusValue = $value - 273.15;
				break;
			default:
				throw new Exception("Invalid 'from' unit provided");
		}

		// Convert from Celsius to the target unit
		switch ($toUnit) {
			case "Celsius":
				return $celsiusValue;
			case "Fahrenheit":
				return ($celsiusValue * 9 / 5) + 32;
			case "Kelvin":
				return $celsiusValue + 273.15;
			default:
				throw new Exception("Invalid 'to' unit provided");
		}
	}
}