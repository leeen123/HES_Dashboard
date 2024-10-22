<?php
include 'load-data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $variable = $_POST['variable'];
    $interaction_variable = $_POST['interaction_variable'];

    // Generate the filename for the pre-generated SHAP plot
    if ($variable == $interaction_variable){
        $plot_filename = "{$variable}.png";
    }else{
        $plot_filename = "{$variable}_{$interaction_variable}.png";
    }
    $plot_path = "static/shap_plots/" . $plot_filename;

    // Load the CSV data or results you want to return (example)
    $x_test = readCSV("data/x_test.csv");

    // Assuming $x_test is a multi-dimensional array where the first row contains headers
    $headers = $x_test[0];  // Extract the headers
    $data = array_slice($x_test, 1);  // Exclude the first row (headers)

    // Find the index of the selected variable in the headers
    $variable_index = array_search($variable, $headers);
    $interaction_variable_index = array_search($interaction_variable, $headers);

    // Extract the data for the selected variable and interaction variable
    $variable_data = array_map('floatval', array_column($data, $variable_index));
    $interaction_variable_data = array_map('floatval', array_column($data, $interaction_variable_index));
    
    header('Content-Type: application/json');

    // Prepare and send JSON response
    $response = array(
        'shap_plot' => $plot_path,  // Pre-generated plot
        'variable_data' => $variable_data,
        'interaction_variable_data' => $interaction_variable_data
    );
    
    echo json_encode($response);
}
?>
