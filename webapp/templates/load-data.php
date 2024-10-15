<?php
// load_data.php

// Function to read CSV file into an array
function readCSV($filename) {
    $data = array();
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($row = fgetcsv($handle)) !== FALSE) {
            $data[] = $row;
        }
        fclose($handle);
    }
    return $data;
}

// Load CSV data
$shap_values = readCSV("../../data/shap_values2.csv");
$x_test = readCSV("../../data/x_test.csv");
$k_mean_analy = readCSV("../../data/k_mean_analy.csv");
?>
