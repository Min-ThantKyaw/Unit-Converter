<?php
class Length
{
    private $baseUnits = [
        "meter"      => 1,
        "kilometer"  => 1000,
        "centimeter" => 0.01,
        "millimeter" => 0.001,
        "mile"       => 1609.34,
        "yard"       => 0.9144,
        "foot"       => 0.3048,
        "inch"       => 0.0254,
    ];
    public function lengthConverter($value, $fromUnit, $toUnit)
    {
        if (! isset($this->baseUnits[$fromUnit]) || ! isset($this->baseUnits[$toUnit])) {
            throw new Exception("Invalid unit provided");
        }
        $fromValue = $value * $this->baseUnits[$fromUnit];
        $result    = $fromValue / $this->baseUnits[$toUnit];
        return $result;
    }
}
