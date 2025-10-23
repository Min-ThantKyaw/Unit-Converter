<?php
	class Weight {
		private $baseUnits = [
			"kilogram"   => 1,
			"gram"       => 0.001,
			"milligram"  => 0.000001,
			"pound"      => 0.453592,
			"ounce"      => 0.0283495,
		];

		public function weightConverter($value, $fromUnit, $toUnit) {
			if (!isset($this->baseUnits[$fromUnit]) || !isset($this->baseUnits[$toUnit])) {
				throw new Exception("Invalid unit provided");
			}

			$fromValue = $value * $this->baseUnits[$fromUnit];
			$result    = $fromValue / $this->baseUnits[$toUnit];
			return $result;
		}
	}