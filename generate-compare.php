<?php

include 'load-data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $variable = $_POST['variable'];

    // Load the CSV data or results you want to return (example)
    $k_mean_analy = readCSV("data/k_mean_analy.csv");

    $headers = $k_mean_analy[0];  // First row contains headers
    $data = array_slice($k_mean_analy, 1);  // Remove the header row to get only data

    $variable_index = array_search($variable, $headers);
    $cluster_index = array_search('Cluster', $headers);
    $income_category_index = array_search('Income_Category', $headers);

    $variable_data = array_map('floatval', array_column($data, $variable_index));
    $cluster_data = array_column($data, $cluster_index);
    $income_category_data = array_column($data, $income_category_index);

    header('Content-Type: application/json');

    // Send JSON response
    $response = array(
        'variable_data' => $variable_data,
        'cluster_data' => $cluster_data,
        'income_category_data' => $income_category_data
    );

    echo json_encode($response);
}
?>
