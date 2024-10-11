<?php

include 'load-data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $variable = $_POST['variable'];

    // Find the index of the selected variable in the CSV file (assuming headers in the first row)
    $variable_index = array_search($variable, $k_mean_analy[0]);

    // Extract the data for the selected variable
    $variable_data = array_column($k_mean_analy, $variable_index);

    // Prepare additional data for response (e.g., Cluster, Income_Category)
    $cluster_data = array_column($k_mean_analy, array_search('Cluster', $k_mean_analy[0]));
    $income_category_data = array_column($k_mean_analy, array_search('Income_Category', $k_mean_analy[0]));

    // Send JSON response
    $response = array(
        'variable_data' => $variable_data,
        'cluster_data' => $cluster_data,
        'income_category_data' => $income_category_data
    );

    echo json_encode($response);
}
?>
