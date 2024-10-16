<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Redirect to login page if the user is not authenticated
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household Expenditure Power Analysis</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href="../static/style.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
</head>
<body>
  <div class="blockarea navbar1" style="padding: 10px 20px;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/">Expenditure Analysis</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex flex-row" id="navbarNav">
          <li class="nav-item">
            <a class="nav-link active" href="/shap" id="shap-link" style="margin-right: 10px;">SHAP Plot Analysis</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/compare" id="compare-link">Comparing Analysis</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <div id="shap-plot-section" class="container-cus">
    <div class="row">
      <div class="col-md-3 blockarea my-4">
        <form id="shap-plot-form">
          <div>
            <div>
              <label for="variable" class="justify-content-start">Select Variable for X axis</label>
              <select name="variable" id="variable" class="form-control" required>
                <option value="Log_Inc">Log Per Capita Income</option>
                <option value="Highest_Certificate">Educational Level</option>
                <option value="Saiz_HH">Household Size</option>
                <option value="Age">Age</option>
                <option value="Sex">Sex</option>
                <option value="Strata">Strata</option>
                <option value="Ethnic_Bumiputera">Ethnic-Bumiputera</option>
                <option value="Ethnic_Chinese">Ethnic-Chinese</option>
                <option value="Ethnic_Indian">Ethnic-Indian</option>
                <option value="Ethnic_Others">Ethnic-Others</option>
                <option value="Region_Centre">Region-Centre</option>
                <option value="Region_East">Region-East</option>
                <option value="Region_Eastern Malaysia">Region-Eastern Malaysia</option>
                <option value="Region_North">Region-North</option>
                <option value="Region_South">Region-South</option>
              </select>
            </div>
            <div id="x-variable-description" class="col-12 text-center center-content variable-description">
              <div class="iconholder">
                <svg id="x-variable-icon" width="64" height="64" viewBox="0 0 64 64">
                  <!-- Placeholder for X-axis variable icon -->
                </svg>
              </div>
              <p id="x-variable-text" class="mt-2">Description of X-axis variable.</p>
            </div>
          </div>
          <div>
            <div class="mt-2">
              <label for="interaction-variable" class="justify-content-start">Select Interaction Variable</label>
              <select name="interaction_variable" id="interaction-variable" class="form-control" required>
                <option value="Log_Inc">Log Per Capita Income</option>
                <option value="Highest_Certificate">Educational Level</option>
                <option value="Saiz_HH">Household Size</option>
                <option value="Age">Age</option>
                <option value="Sex">Sex</option>
                <option value="Strata">Strata</option>
                <option value="Ethnic_Bumiputera">Ethnic-Bumiputera</option>
                <option value="Ethnic_Chinese">Ethnic-Chinese</option>
                <option value="Ethnic_Indian">Ethnic-Indian</option>
                <option value="Ethnic_Others">Ethnic-Others</option>
                <option value="Region_Centre">Region-Centre</option>
                <option value="Region_East">Region-East</option>
                <option value="Region_Eastern Malaysia">Region-Eastern Malaysia</option>
                <option value="Region_North">Region-North</option>
                <option value="Region_South">Region-South</option>
              </select>
            </div>
            <!-- Interaction Variable -->
            <div id="interaction-variable-description" class="col-12 text-center center-content variable-description">
              <div class="iconholder">
                <svg id="interaction-variable-icon" width="64" height="64" viewBox="0 0 64 64">
                  <!-- Placeholder for Interaction variable icon -->
                </svg>
              </div>
              <p id="interaction-variable-text" class="mt-2">Description of Interaction variable.</p>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-9 pr-0 my-4">
        <div class="d-flex flex-wrap">
          <div class="col-12 col-md-6 blockarea d-flex flex-column" style="height: auto;">
            <h5 class="block-title">SHAP Dependence Plot</h5>
            <div class="d-flex justify-content-start align-items-start flex-grow-1" style="width: 100%;">
              <img id="shap-plot" src="../static/shap_plot.png" alt="SHAP Dependence Plot" class="img-fluid" style="max-width: 100%; height: auto; flex-grow: 1;">
            </div>
          </div>

          <!-- padding 0 for mobile layout -->
          <div class="col-12 col-md-6 mt-3 mt-md-0" style="flex: 0 0 50%">
            <div class="blockarea p-1 cardfont">
              <div>
                <div class="card-body d-flex flex-row">
                  <span class="col-2 icon me-3 text-white mr-3">
                    <svg height="54px" width="54px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                      <style type="text/css">
                        .st0 { fill: #509863; }
                      </style>
                      <g>
                        <path class="st0" d="M346.483,226.653c-58.176-75.765-90.498-181.813-90.498-181.813s-32.318,106.048-90.505,181.813c0,0,26.66,16.09,41.21,7.569c0,0-14.55,65.341-79.995,151.514c58.176,18.923,101.81-12.328,101.81-12.328v93.75h21.025h12.916h21.021v-93.75c0,0,43.642,31.25,101.817,12.328c-65.457-86.174-79.995-151.514-79.995-151.514C319.826,242.743,346.483,226.653,346.483,226.653z"/>
                        <path class="st0" d="M160.886,307.087c-19.185-35.761-24.363-59.015-24.363-59.015c8.768,5.141,23.33-1.454,29.058-4.376c1.522-0.84,2.417-1.379,2.417-1.379c-5.313-6.985-10.353-14.276-15.186-21.718c-34.855-54.482-53.972-117.26-53.972-117.26s-24.711,81.041-69.23,138.977c0,0,20.361,12.283,31.542,5.756c0,0-11.181,49.956-61.151,115.88c44.451,14.426,77.788-9.443,77.788-9.443v71.674h42.034v-71.674c0,0,3.035,2.151,8.415,4.759C141.633,340.391,152.332,322.817,160.886,307.087z"/>
                        <path class="st0" d="M450.849,248.071c11.121,6.527,31.474-5.756,31.474-5.756c-44.454-57.936-69.155-138.977-69.155-138.977s-19.125,62.778-54.05,117.26c-4.766,7.441-9.803,14.733-15.123,21.718c0,0,0.906,0.54,2.428,1.379c5.725,2.922,20.29,9.517,29.058,4.376c0,0-5.178,23.328-24.442,59.09c8.566,15.655,19.331,33.303,32.723,52.106c5.381-2.608,8.423-4.759,8.423-4.759v71.674h41.967v-71.674c0,0,33.394,23.869,77.848,9.443C461.97,298.027,450.849,248.071,450.849,248.071z"/>
                      </g>
                    </svg>
                  </span>
                  <div class="col-10 flex-grow-1">
                    <h6 class="card-title mb-0">Model</h6>
                    <h4 class="card-text" style="font-weight: 600 !important;">Random Forest</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-3 blockarea p-1 cardfont">
              <div>
                <div class="card-body d-flex flex-row">
                  <span class="col-2 icon me-3 text-white mr-3">
                    <svg width="54px" height="54px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M8.6231 5.93966C7.75276 6.37483 7.5 6.83725 7.5 7.125C7.5 7.41275 7.75276 7.87517 8.6231 8.31034C9.44857 8.72307 10.6414 9 12 9C13.3586 9 14.5514 8.72307 15.3769 8.31034C16.2472 7.87517 16.5 7.41275 16.5 7.125C16.5 6.83725 16.2472 6.37483 15.3769 5.93966C14.5514 5.52693 13.3586 5.25 12 5.25C10.6414 5.25 9.44857 5.52693 8.6231 5.93966ZM16.5 9.39844C16.3535 9.4904 16.2018 9.57494 16.0477 9.65198C14.9731 10.1893 13.5409 10.5 12 10.5C10.4591 10.5 9.02693 10.1893 7.95228 9.65198C7.79821 9.57494 7.64654 9.4904 7.5 9.39844V10.375C7.5 10.7155 7.77767 11.2057 8.63569 11.6552C9.45819 12.086 10.6464 12.375 12 12.375C13.3536 12.375 14.5418 12.086 15.3643 11.6552C16.2223 11.2057 16.5 10.7155 16.5 10.375V9.39844ZM18 7.125V10.375C18 10.417 17.9989 10.4587 17.9966 10.5H18V13.375C18 13.417 17.9989 13.4587 17.9966 13.5H18V16.375C18 17.5532 17.1024 18.4381 16.0603 18.9839C14.9827 19.5484 13.5459 19.875 12 19.875C10.4541 19.875 9.01731 19.5484 7.93968 18.9839C6.89758 18.4381 6 17.5532 6 16.375V13.5H6.00339C6.00114 13.4587 6 13.417 6 13.375V10.5H6.00339C6.00114 10.4587 6 10.417 6 10.375V7.125C6 5.96301 6.92249 5.11292 7.95228 4.59802C9.02693 4.0607 10.4591 3.75 12 3.75C13.5409 3.75 14.9731 4.0607 16.0477 4.59802C17.0775 5.11292 18 5.96301 18 7.125ZM7.5 15.7267V16.375C7.5 16.7155 7.77767 17.2057 8.63569 17.6552C9.45819 18.086 10.6464 18.375 12 18.375C13.3536 18.375 14.5418 18.086 15.3643 17.6552C16.2223 17.2057 16.5 16.7155 16.5 16.375V15.7267C16.358 15.8194 16.2106 15.9052 16.0603 15.9839C14.9827 16.5484 13.5459 16.875 12 16.875C10.4541 16.875 9.01731 16.5484 7.93968 15.9839C7.78936 15.9052 7.64205 15.8194 7.5 15.7267ZM16.0603 12.9839C16.2106 12.9052 16.358 12.8194 16.5 12.7267V13.375C16.5 13.7155 16.2223 14.2057 15.3643 14.6552C14.5418 15.086 13.3536 15.375 12 15.375C10.6464 15.375 9.45819 15.086 8.63569 14.6552C7.77767 14.2057 7.5 13.7155 7.5 13.375V12.7267C7.64205 12.8194 7.78936 12.9052 7.93968 12.9839C9.01731 13.5484 10.4541 13.875 12 13.875C13.5459 13.875 14.9827 13.5484 16.0603 12.9839Z" fill="#fcc203"/>
                    </svg>
                  </span>
                  <div class="col-10 flex-grow-1">
                    <h6 class="card-title mb-0">Dataset Overview</h6>
                    <h4 class="card-text" style="font-weight: 600 !important;">Total Samples: 14525</h4>
                  </div>
                </div>
                <div class="col-12 px-4 pb-2">
                  <div class="progress mb-4" style="height: 10px;">
                    <div class="progress-bar" role="progressbar" style="width: 80%;background-color: #cca218;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar" role="progressbar" style="width: 20%; background-color: #fcc203;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <hr style="border: 1px solid #f1f1f1;">
                  <div class="d-flex justify-content-between pt-3">
                    <div class="">
                      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <circle cx="12" cy="12" r="8" fill="#cca218"></circle>
                        </g>
                      </svg>
                      <span class="training-text mr-2">Training Samples</span>
                    </div>
                    <span class="value-text">11620</span>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="">
                      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <circle cx="12" cy="12" r="8" fill="#fcc203"></circle>
                        </g>
                      </svg>
                      <span class="training-text mr-2">Testing Samples</span>
                    </div>
                    <span class="value-text">2905</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex">
          <div class="col-12 col-md-6 blockarea mt-3" style="height: 280px;">
            <h5 id="x-variable-title" class="block-title">title</h5>
            <div class="row px-4 pb-3 pt-2" style="height: 100%; width: auto;">
              <canvas class="col-12" id="variable-histogram"></canvas>
            </div>
          </div>
          <div class="col-12 col-md-6 blockarea ml-3 mt-3" style="height: 280px ">
            <h5 id="interaction-variable-title" class="block-title">title</h5>
            <div class="row px-4 pb-3 pt-2" style="height: 100%; width: auto;">
              <canvas class="col-12" id="interaction-variable-histogram"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../static/data.js"></script>
  <script>
    var canvas;
    var context;

    $(document).ready(function() {
      // Navigation handling
      $('#shap-link').click(function(e) {
        e.preventDefault();
        window.location.href = '/';
      });

      $('#compare-link').click(function(e) {
        e.preventDefault();
        window.location.href = '/test';
      });

      function updateCanvasSize() {
        // Adjust canvas size for mobile
        if ($(window).width() <= 768) {
          $('.canvas').each(function() {
            $(this).css('height', '200px'); // Set height to 200px for mobile
          });
        } else {
          $('.canvas').each(function() {
            $(this).css('height', 'auto'); // Set height to auto for desktop
          });
        }
      }

      // Call the function on page load and window resize
      updateCanvasSize();
      $(window).resize(updateCanvasSize);

      function onlyUnique(value, index, array) {
        return array.indexOf(value) === index;
      }
          
      function updatePlot() {
        var formData = new FormData($('#shap-plot-form')[0]);

        var variable_selected = []

        formData.forEach((value, key) => {
          variable_selected.push(value);
        });

        console.log("variable_selected: ", variable_selected)

        $.ajax({
          url: 'generate-shap.php',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            $('#shap-plot').attr('src', '../static/shap_plot.png?' + new Date().getTime());

            console.log("response received: ", response);
    
            // Render variable histogram
            renderChart('variable-histogram', response.variable_data, 'Variable Histogram', variable_selected[0]);
            
            // Render interaction variable histogram
            renderChart('interaction-variable-histogram', response.interaction_variable_data, 'Interaction Variable Histogram', variable_selected[1]);
            
            // Update variable statistics
            $('#x-variable-stats').html(response.x_variable_stats);
            $('#interaction-variable-stats').html(response.interaction_variable_stats);
          }
        });
      }

      function normalizeData(data) {
        const mean = data.reduce((sum, value) => sum + value, 0) / data.length;
        const stdDev = Math.sqrt(data.reduce((sum, value) => sum + Math.pow(value - mean, 2), 0) / data.length);
        return data.map(value => (value - mean) / stdDev);
      }

      function binData(data, binSize) {
        const bins = {};
        data.forEach(point => {
          const bin = Math.floor(point / binSize) * binSize;
          bins[bin] = (bins[bin] || 0) + 1;
        });

        const sortedBins = Object.keys(bins).sort((a, b) => a - b).map(key => ({
          bin: parseFloat(key),
          count: bins[key]
        }));

        return sortedBins;
      }

      function aggregateData(data) {
        const counts = {};
        data.forEach(item => {
          counts[item] = (counts[item] || 0) + 1;
        });
        return counts;
      }

      function renderChart(canvasId, data, label, variable) {
        piedata = data;

        var legend = (data.filter(onlyUnique)).sort();

        canvas = document.getElementById(canvasId);
        context = canvas.getContext('2d');

        console.log("canvas: ", canvas)

        if (canvas.chart) {
          console.log("here")
          canvas.chart.destroy();
        }

        if (chartType[variable] === 'bar') {
          legend = [];

          data = normalizeData(data);

          console.log("normalizedData received: ", data.sort())

          const minValue = Math.min(...data);
          const maxValue = Math.max(...data);

          console.log("min ", minValue)
          console.log("max ", maxValue)

          range = 20;
          // Calculate the width of each bin
          const binWidth = (maxValue - minValue) / range;

          const binnedData = binData(data, binWidth);

          console.log("binWidth :", binWidth)

          console.log("data :", data)

          // Step 4: Prepare Data for Chart.js
          const chartData = {
            labels: binnedData.map(d => d.bin),
            datasets: [{
              label: 'Normalized Distribution',
              data: binnedData.map(d => d.count),
              backgroundColor: 'rgba(3, 136, 252)',
              borderWidth: 1
            }]
          };

          // Step 5: Configure Chart.js
          const config = {
            type: 'bar',
            data: chartData,
            options: {
              responsive: true,
              maintainAspectRatio: false, // This allows the chart to adjust to the container's aspect ratio
              scales: {
                x: {
                  type: 'linear',
                  position: 'bottom',
                  title: {
                    display: true,
                    text: 'Value'
                  }
                },
                y: {
                  title: {
                    display: true,
                    text: 'Frequency'
                  }
                }
              },
              plugins: {
                legend: {
                  display: true,
                  position: 'top',
                },
                tooltip: {
                  enabled: true,
                }
              }
            }
          };
          canvas.chart = new Chart(context, config);
        } else {
          const aggregatedData = aggregateData(data);
          const labels = Object.keys(aggregatedData);
          const chartData = Object.values(aggregatedData);

          console.log("second data: ", aggregatedData)

          canvas.chart = new Chart(context, {
            type: 'doughnut',
            data: {
              labels: variableDescriptions[variable].label,
              datasets: [{
                label: 'Interaction',
                data: chartData,
                backgroundColor: ['rgba(255, 0, 0, 0.6)', 'rgba(3, 136, 252,0.6)', 'rgba(0, 255, 0, 0.6)', 'rgba(150, 255, 0, 0.6)', 'rgba(255, 255, 0, 0.6)', 'rgba(255, 154, 0, 0.6)'], // Adjust colors as needed
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false, // This allows the chart to adjust to the container's aspect ratio
              plugins: {
                legend: {
                  display: true,
                  position: 'right',
                },
                tooltip: {
                  enabled: true,
                }
              }
            }
          });

        }
      }

      function updateVariableDescriptions() {
        var xVariable = $('#variable').val();
        var interactionVariable = $('#interaction-variable').val();

        if (xVariable !== '') {
          $('#x-variable-description').removeClass('d-none');
          $('#x-variable-title').text(variableDescriptions[xVariable].title);
          $('#x-variable-text').text(variableDescriptions[xVariable].description);
          $('#x-variable-icon').html(variableDescriptions[xVariable].icon);
        } else {
          $('#x-variable-description').addClass('d-none');
        }

        if (interactionVariable !== '') {
          $('#interaction-variable-description').removeClass('d-none');
          $('#interaction-variable-title').text(variableDescriptions[interactionVariable].title);
          $('#interaction-variable-text').text(variableDescriptions[interactionVariable].description);
          $('#interaction-variable-icon').html(variableDescriptions[interactionVariable].icon);
        } else {
          $('#interaction-variable-description').addClass('d-none');
        }
      }

      updateVariableDescriptions();
      $('#variable, #interaction-variable').change(updateVariableDescriptions);
      $('variable-histogram').change(updatePlot);
      $('#interaction-variable-histogram').change(updatePlot);
      $('#shap-plot-form').change(updatePlot);

      updatePlot();
    });
  </script>
  <style>
    /* Mobile-specific styling */
    @media (max-width: 768px) {
      .container-cus {
        flex-direction: column; /* Flex direction as column for stacking */
      }

      #shap-plot-section .col-md-3 {
        order: -1; /* Form section at the top */
        width: 100%;
        margin-bottom: 20px;
      }

      #shap-plot-section .col-md-9 {
        width: 100%;
        order: 1; /* Image section below the form */
      }

      .d-flex {
        flex-direction: column; /* Stack elements vertically */
      }

      .col-6, .col-12 {
        width: 100% !important; /* Full width for each element */
        margin-left: 0 !important;
        margin-bottom: 20px; /* Space between items */
      }

      .blockarea {
        margin-bottom: 20px; /* Space between stacked items */
        padding: 20px;
      }

      .chart-container {
        height: 300px; /* Fixed height for better visibility */
      }

      canvas {
        width: 100% !important; /* Ensure canvas fills width */
        height: 200px !important; /* Set fixed height on mobile */
      }

      .ml-3 {
        margin-left: 0 !important;
        margin-top: 20px; /* Space between stacked elements */
      }
    }

    .sample-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}

.value-text {
  margin-left: auto; /* Ensures the number aligns to the right */
}

.training-text {
  white-space: nowrap; /* Prevents text wrapping */
}

svg {
  min-width: 16px;
  min-height: 16px;
}


  </style>
  
</body>
</html>