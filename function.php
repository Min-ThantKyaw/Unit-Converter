<?php
// var_dump($_POST);
require_once 'Length.php';
require_once 'Temperature.php';
require_once 'Area.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value    = $_POST['base-value'];
    $fromUnit = strtolower($_POST['base-unit']);
    $toUnit   = strtolower($_POST['to-unit']);
    $category = $_POST['selected-category'];
    require_once 'Length.php';
    if ($category === 'length') {
        $converter = new Length();
        $result    = $converter->lengthConverter($value, $fromUnit, $toUnit);
        echo $result;
    } 
    }
    if ($category === 'temperature') {
        $converter = new Temperature();
        $result    = $converter->temperatureConverter($value, $fromUnit, $toUnit);
        echo $result;

    }
    if ($category === 'area') {
        $converter = new Area();
        $result = $converter->areaConverter($value, $fromUnit, $toUnit);
        echo $result;
    }

    if ($category === 'weight') {
        $converter = new Weight();
        $result = $converter->weightConverter($value, $fromUnit, $toUnit);
        echo $result;
    }

    if ($category === 'volume') {
        $converter = new Volume();
        $result = $converter->volumeConverter($value, $fromUnit, $toUnit);
        echo $result;
    }

