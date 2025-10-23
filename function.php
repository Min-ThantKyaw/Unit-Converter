<?php
header('Content-Type: text/plain; charset=utf-8');

// Include all converter classes
require_once 'Length.php';
require_once 'Temperature.php';
require_once 'Area.php';
require_once 'Weight.php';
require_once 'Volume.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input
    if (!isset($_POST['base-value']) || !isset($_POST['base-unit']) || !isset($_POST['to-unit']) || !isset($_POST['selected-category'])) {
        http_response_code(400);
        echo 'Invalid request - missing required fields';
        exit;
    }

    $value = (float) $_POST['base-value'];
    $fromUnit = $_POST['base-unit'];
    $toUnit = $_POST['to-unit'];
    $category = $_POST['selected-category'];

    // Validate value
    if (!is_numeric($value)) {
        http_response_code(400);
        echo 'Invalid value - must be numeric';
        exit;
    }

    try {
        $result = null;

        if ($category === 'length') {
            $converter = new Length();
            $result = $converter->lengthConverter($value, strtolower($fromUnit), strtolower($toUnit));
        } elseif ($category === 'temperature') {
            $converter = new Temperature();
            $result = $converter->temperatureConverter($value, $fromUnit, $toUnit);
        } elseif ($category === 'area') {
            $result = Area::areaConverter($value, $fromUnit, $toUnit);
        } elseif ($category === 'weight') {
            $converter = new Weight();
            $result = $converter->weightConverter($value, strtolower($fromUnit), strtolower($toUnit));
        } elseif ($category === 'volume') {
            $result = Volume::volumeConverter($value, $fromUnit, $toUnit);
        } else {
            http_response_code(422);
            echo 'Unsupported category';
            exit;
        }

        if ($result === null) {
            http_response_code(422);
            echo 'Conversion failed';
            exit;
        }

        // Format result to reasonable precision
        echo number_format($result, 6, '.', '');
        
    } catch (Exception $e) {
        http_response_code(500);
        echo 'Conversion error: ' . $e->getMessage();
    }
} else {
    http_response_code(405);
    echo 'Method not allowed';
}