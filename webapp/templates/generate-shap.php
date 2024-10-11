<?php
include 'load-data.php';

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "$output\n";
}

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

    debug_to_console("type of json_data: ".$json_data);

    // Call Python script and pass the file path as an argument
    $command = "py -m generate-shap.py $temp_file";
    $out = shell_exec($command);

    debug_to_console($out);

    // Load the CSV data or results you want to return (example)
    $x_test = readCSV("../../data/x_test.csv");

    // Extract variable data from the CSV for the selected variable
    $variable_data = array_column($x_test, array_search($variable, $x_test[0]));  // Assuming first row is headers
    $interaction_variable_data = array_column($x_test, array_search($interaction_variable, $x_test[0]));

    // Return the path to the generated image and the actual data
    $response = array(
        'shap_plot' => '../static/shap_plot.png',
        'variable_data' => $variable_data,  // Now populated with actual data
        'interaction_variable_data' => $interaction_variable_data  // Now populated with actual data
    );
    
    echo json_encode($response);

    // Clean up the temporary file
    unlink($temp_file);
}
?>