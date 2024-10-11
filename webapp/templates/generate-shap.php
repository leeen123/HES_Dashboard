<?php
include 'load-data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $variable = $_POST['variable'];
    $interaction_variable = $_POST['interaction_variable'];

    $data = array(
        "variable" => $variable,
        "interaction_variable" => $interaction_variable
    );

    // Create a JSON object with variable names
    $json_data = json_encode($data);

    // Write JSON data to a temporary file
    $temp_file = tempnam(sys_get_temp_dir(), 'shap_data_');
    file_put_contents($temp_file, $json_data);

    // Call Python script and pass the file path as an argument
    $command = "py -m generate-shap.py $temp_file";
    $out = shell_exec($command);

    // Load the CSV data or results you want to return (example)
    $x_test = readCSV("../../data/x_test.csv");

    // Assuming $x_test is a multi-dimensional array where the first row contains headers
    $headers = $x_test[0];  // Extract the headers
    $data = array_slice($x_test, 1);  // Exclude the first row (headers)

    // Find the index of the selected variable in the headers
    $variable_index = array_search($variable, $headers);
    $interaction_variable_index = array_search($interaction_variable, $headers);

    // Extract the data for the selected variable and convert to float to avoid string conversion in JSON
    $variable_data = array_map('floatval', array_column($data, $variable_index));
    $interaction_variable_data = array_map('floatval', array_column($data, $interaction_variable_index));
    
    header('Content-Type: application/json');

    // Prepare and send JSON response
    $response = array(
        'shap_plot' => '../static/shap_plot.png',
        'variable_data' => $variable_data,
        'interaction_variable_data' => $interaction_variable_data
    );
    
    echo json_encode($response);

    // Clean up the temporary file
    unlink($temp_file);
}
?>