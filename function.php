<?php
// var_dump($_POST);
require_once 'Length.php';
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
    } else {
        echo "Category not supported yet.";
    }
    if ($category === 'weight') {

    }
}
