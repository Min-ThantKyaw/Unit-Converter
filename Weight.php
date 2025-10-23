<?php
	class Weight {
		private $baseUnits = [
			"gram"       => 1,
			"kilogram"   => 1000,
			"milligram"  => 0.001,
			"pound"      => 453.592,
			"ounce"      => 28.3495,
			"ton"        => 907184.74,
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