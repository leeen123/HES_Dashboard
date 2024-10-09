<?php
$output = shell_exec('C:/xampp/htdocs/Branch_HES_Dashboard/webapp/app.py');
echo $output;

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
  <!-- Sticky Navbar -->
<div class="blockarea navbar1" style="padding: 10px 20px;">
  <nav class="navbar navbar-expand-lg navbar-light bg-light" >
    <a class="navbar-brand" href="#">Expenditure Analysis</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex flex-row" id="navbarNav">
        <li class="nav-item">
            <a class="nav-link" href="/shap_plot.php" id="shap-link" style="margin-right: 10px;">SHAP Plot Analysis</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/try" id="compare-link">Comparing Analysis</a>
          </li>
      </ul>
    </div>
  </nav>
</div>

  <!-- Plot and Descriptive Statistics Section -->
  <div id="shap-plot-section" class="container-cus">
    <div class="row">
      <!-- The 2nd areas -->
      <div class="col-md-3 d-flex flex-column px-0">
        <div class="blockarea mt-4 mb-3">
            <h4 for="variable" id="x-variable-title" class="block-title">Log Per Capita Income</h4>
            <div id="x-variable-description" class="text-center center-content variable-description">
                <div class="iconholder">
                    <svg id="x-variable-icon" width="64" height="64" viewBox="0 0 64 64">
                        <!-- Placeholder for X-axis variable icon -->
                    </svg>
                </div>
                <p id="x-variable-text">
                    Measures the per capita income of household heads in log scale. The per capita income is calculated using OECD-equivalence scale.
                </p>
            </div>
        </div>
        <div class="blockarea mb-4">
            <h4 class="block-title">Pivot Table</h4>
            <div class="table-responsive pt-3">
                <table class="table table-striped table-tight-padding">
                    <thead>
                        <tr>
                            <th></th>
                            <th>B40</th>
                            <th>M40</th>
                            <th>T20</th>
                        </tr>
                    </thead>
                    <tbody id="cross-tab-body">
                        <!-- Table rows will be inserted here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
      <!-- Col-md-8 area -->
      <div style="flex: 0 0 75%;">
          <div class="ml-3 mt-4 mb-3 pl-3 row d-flex align-items-center justify-content-between">
            <div style="font-family: 'Poppins', sans-serif;">
              <h3 id="content-title" style="margin-bottom: 0px; font-weight: 800; color: rgb(75, 70, 70)">Graphical Result</h3>
            </div>
            <div class="row align-items-center col-auto mr-1">
              <form id="shap-plot-form">
                <div class="mr-3">
                  <select name="variable" id="variable" class="form-control btn btn-info custom-form dropdown-toggle" style="min-height: 52.6px;" required>
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
              </form>
              
              <div id="dropdown1" class="dropdown mr-3">
                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Chart <i class="fas fa-chevron-down"></i>
                </button>
                <ul id="dropdown-menu1" class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <a class="dropdown-item" href="#" data-value="chart">
                      Chart
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-value="table">
                      Table
                    </a>
                  </li>
                </ul>
              </div>
              <div id="dropdown2" class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                  
                  <svg fill="currentColor" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve">
                    <path id="box--plot_1_" d="M31,31.36H1c-0.199,0-0.36-0.161-0.36-0.36V1h0.72v29.64H31V31.36z M14,27.36H6v-0.72h3.64v-3.28H6
                       c-0.199,0-0.36-0.161-0.36-0.36V11c0-0.199,0.161-0.36,0.36-0.36h3.64V7.36H6V6.64h8v0.72h-3.64v3.28H14
                       c0.199,0,0.36,0.161,0.36,0.36v12c0,0.199-0.161,0.36-0.36,0.36h-3.64v3.279H14V27.36z M6.36,22.64h7.28v-5.28H6.36V22.64z
                        M6.36,16.64h7.28v-5.28H6.36V16.64z M28,23.36h-8v-0.72h3.64v-3.28H20c-0.199,0-0.36-0.161-0.36-0.36V7
                       c0-0.199,0.161-0.36,0.36-0.36h3.64V3.36H20V2.64h8v0.72h-3.64v3.28H28c0.199,0,0.36,0.161,0.36,0.36v12
                       c0,0.199-0.161,0.36-0.36,0.36h-3.64v3.279H28V23.36z M20.36,18.64h7.279v-5.28H20.36V18.64z M20.36,12.64h7.279V7.36H20.36V12.64z"
                    />
                    <rect id="_Transparent_Rectangle" style="fill:none;" width="32" height="32"/>
                  </svg>Boxplot Chart <i class="fas fa-chevron-down"></i>
                </button>
                <ul id="dropdown-menu2" class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <li>
                    <a class="dropdown-item" href="#" data-value="boxplot">
                      <svg fill="currentColor" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve">
                        <path id="box--plot_1_" d="M31,31.36H1c-0.199,0-0.36-0.161-0.36-0.36V1h0.72v29.64H31V31.36z M14,27.36H6v-0.72h3.64v-3.28H6
                           c-0.199,0-0.36-0.161-0.36-0.36V11c0-0.199,0.161-0.36,0.36-0.36h3.64V7.36H6V6.64h8v0.72h-3.64v3.28H14
                           c0.199,0,0.36,0.161,0.36,0.36v12c0,0.199-0.161,0.36-0.36,0.36h-3.64v3.279H14V27.36z M6.36,22.64h7.28v-5.28H6.36V22.64z
                            M6.36,16.64h7.28v-5.28H6.36V16.64z M28,23.36h-8v-0.72h3.64v-3.28H20c-0.199,0-0.36-0.161-0.36-0.36V7
                           c0-0.199,0.161-0.36,0.36-0.36h3.64V3.36H20V2.64h8v0.72h-3.64v3.28H28c0.199,0,0.36,0.161,0.36,0.36v12
                           c0,0.199-0.161,0.36-0.36,0.36h-3.64v3.279H28V23.36z M20.36,18.64h7.279v-5.28H20.36V18.64z M20.36,12.64h7.279V7.36H20.36V12.64z"
                        />
                        <rect id="_Transparent_Rectangle" style="fill:none;" width="32" height="32"/>
                      </svg>
                      Boxplot Chart
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-value="bar">
                      <svg viewBox="0 -1.5 2253 2253" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect id="stacked_bar_chart" x="1.997" y="0" width="2250" height="2250" style="fill:none;"></rect> <rect x="397.831" y="1187.5" width="312.5" height="666.667" style="fill:#303030;stroke:#202020;stroke-width:66.67px;"></rect> <rect x="397.831" y="1000" width="312.5" height="187.5" style="fill:#575757;stroke:#202020;stroke-width:66.67px;"></rect> <rect x="397.831" y="708.333" width="312.5" height="281.25" style="fill:#eee;stroke:#202020;stroke-width:66.67px;"></rect> <rect x="918.664" y="1437.5" width="312.5" height="416.667" style="fill:#303030;stroke:#202020;stroke-width:66.67px;"></rect> <rect x="1439.5" y="1229.17" width="312.5" height="625" style="fill:#303030;stroke:#202020;stroke-width:66.67px;"></rect> <rect x="918.664" y="1312.5" width="312.5" height="125" style="fill:#575757;stroke:#202020;stroke-width:66.67px;"></rect> <rect x="1439.5" y="914.583" width="312.5" height="314.583" style="fill:#575757;stroke:#202020;stroke-width:66.67px;"></rect> <rect x="918.664" y="1062.5" width="312.5" height="250" style="fill:#eee;stroke:#202020;stroke-width:66.67px;"></rect> <rect x="1439.5" y="395.833" width="312.5" height="518.75" style="fill:#eee;stroke:#202020;stroke-width:66.67px;"></rect> <g> <path d="M289.497,387.5l-100,-200l-100,200l200,-0Z" style="fill:#202020;"></path> <path d="M1864.5,1962.5l200,100l-200,100l0,-200Z" style="fill:#202020;"></path> <path d="M189.497,347.5l0,1715l1715,-0" style="fill:none;stroke:#202020;stroke-width:66.67px;"></path> </g> </g></svg>
                      Stacked Bar Chart
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-value="pie">
                      <svg viewBox="0 -1.5 2253 2253" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><rect id="donut_chart" x="1.997" y="0" width="2250" height="2250" style="fill:none;"></rect><path d="M1147.83,208.333c-517.767,0 -937.5,419.733 -937.5,937.5c-0,428.307 290.274,802.155 705.228,908.271l116.136,-454.135c-207.477,-53.058 -352.614,-239.982 -352.614,-454.136c-0,-258.883 209.866,-468.75 468.75,-468.75l-0,-468.75Z" style="fill:#4f4f4f;stroke:#202020;stroke-width:66.67px;"></path><path d="M1997.49,749.576c-153.977,-330.174 -485.321,-541.243 -849.663,-541.243l-0,468.704c182.171,0 347.843,105.535 424.832,270.622l424.831,-198.083Z" style="fill:#858585;stroke:#202020;stroke-width:66.67px;"></path><path d="M905.188,2051.39c500.124,134.008 1014.19,-162.788 1148.2,-662.913c64.353,-240.168 30.664,-496.064 -93.656,-711.393l-405.95,234.375c62.16,107.665 79.005,235.613 46.828,355.697c-67.003,250.062 -324.036,398.46 -574.099,331.456l-121.321,452.778Z" style="fill:#eee;stroke:#202020;stroke-width:66.67px;"></path></g></svg>
                      Multi Series Pie Chart
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="blockarea ml-3 mb-4" style="height: 72.5vh; display: flex; flex-direction: column;">
            <div class="px-3 d-flex justify-content-around flex-grow-1" style="overflow: hidden;">
                <div class="chart-container active" id="chart-container" style="flex: 1; min-width: 48%; height: 100%;">
                    <canvas id="boxplotChart" class="boxplot-chart-size" style="height: 100%; width: 100%;"></canvas>
                </div>
                <div class="chart-container" id="chart-container2" style="flex: 1; min-width: 48%; height: 100%;">
                    <canvas id="ic-chart" class="boxplot-chart-size" style="height: 100%; width: 100%;"></canvas>
                </div>
            </div>
            <div class="px-3 pt-2 mx-4 table-container" id="table-container" style="flex: 1; overflow-y: auto; width: 100%;">
                <table class="table table-bordered table-hover" id="dataTable" style="height: 100%; width: 100%;">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th colspan="8" class="text-center">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table data will be dynamically added here -->
                    </tbody>
                </table>
            </div>
            <div class="px-4 row mt-4" style="justify-content: center;">
                <!-- <div class="col-md-1" >
                    <h5 class="mb-0" >Options:</h5>
                </div> -->
                <div class="col-md-11 funkyradio d-flex align-items-center justify-content-center flex-wrap" id="checkboxContainer">
                    <!-- Checkboxes -->

                    <div class="form-check form-check-inline funkyradio-red" >
                        <input class="funkyradio-default category-checkbox" type="checkbox" id="checkbox1" value="0" checked>
                        <label class="" for="checkbox1">Cluster 0</label>
                    </div>
                    <div class="form-check form-check-inline funkyradio-orange">
                      <input class="funkyradio-default category-checkbox" type="checkbox" id="checkbox2" value="1" checked>
                      <label class="" for="checkbox2">Cluster 1</label>
                    </div>
                    <div class="form-check form-check-inline funkyradio-green">
                        <input class="funkyradio-default category-checkbox" type="checkbox" id="checkbox3" value="2" checked>
                        <label class="" for="checkbox3">Cluster 2</label>
                    </div>
                    <div class="form-check form-check-inline funkyradio-info">
                        <input class="funkyradio-default category-checkbox" type="checkbox" id="checkbox4" value="3" checked>
                        <label class="" for="checkbox4">Cluster 3</label>
                    </div>
                    <div class="form-check form-check-inline funkyradio-blue">
                        <input class="funkyradio-default category-checkbox" type="checkbox" id="checkbox5" value="4" checked>
                        <label class="" for="checkbox5">Cluster 4</label>
                    </div>
                    <div class="form-check form-check-inline funkyradio-primary">
                        <input class="funkyradio-default category-checkbox" type="checkbox" id="checkbox6" value="B40" checked>
                        <label class="" for="checkbox6">B40</label>
                    </div>
                    <div class="form-check form-check-inline funkyradio-warning">
                        <input class="funkyradio-default category-checkbox" type="checkbox" id="checkbox7" value="M40" checked>
                        <label class="" for="checkbox7">M40</label>
                    </div>
                    <div class="form-check form-check-inline funkyradio-danger">
                        <input class="funkyradio-default category-checkbox" type="checkbox" id="checkbox8" value="T20" checked>
                        <label class="" for="checkbox8">T20</label>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@sgratzl/chartjs-chart-boxplot"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="static/data.js"></script> 
  <script>
     $(document).ready(function() {
  function isBoxplotOnlyVariable(variable) {
    return variable === 'Log_Inc' || variable === 'Age';
  }

  function updateChartTypeAvailability() {
    const selectedVariable = $('#variable').val();
    const isRestricted = isBoxplotOnlyVariable(selectedVariable);

    if (isRestricted) {
      $('.dropdown-item[data-value="boxplot"]').removeClass('disabled custom-cursor-target');
      $('.dropdown-item[data-value="bar"]').addClass('disabled custom-cursor-target');
      $('.dropdown-item[data-value="pie"]').addClass('disabled custom-cursor-target');
    } else {
      $('.dropdown-item[data-value="boxplot"]').removeClass('disabled');
      $('.dropdown-item[data-value="bar"]').removeClass('disabled custom-cursor-target');
      $('.dropdown-item[data-value="pie"]').removeClass('disabled custom-cursor-target');
    }

    applyCustomCursor();
  }

  function applyCustomCursor() {
    $('.custom-cursor-target').hover(
      function() {
        $(this).addClass('custom-cursor');
      },
      function() {
        $(this).removeClass('custom-cursor');
      }
    );
  }

  // Initial setup
  updateChartTypeAvailability();
  applyCustomCursor();

  // Update chart types and cursor on variable change
  $('#variable').change(function() {
    updateChartTypeAvailability();
    updatePlot();
  });

  // Function to update plot
  function updatePlot(chartType = 'boxplot') {
    const formData = new FormData($('#shap-plot-form')[0]);
    const selectedVariable = formData.get('variable');

    // Check if chart type is restricted
    if (isBoxplotOnlyVariable(selectedVariable)) {
      chartType = 'boxplot';
    }

    $.ajax({
      url: '/try',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        // Update variable statistics
        $('#x-variable-stats').html(response.x_variable_stats);

        // Extract and render data
        const variableData = response.variable_data;
        const clusterData = response.cluster_data;
        const incomeCategoryData = response.income_category_data;

        renderChart(variableData, clusterData, incomeCategoryData, getSelectedCategories(), selectedVariable, chartType);
        renderTable(variableData, clusterData, incomeCategoryData);
        renderCrossTab(variableData, clusterData, incomeCategoryData);
      }
    });
  }

  function getSelectedCategories() {
    var selectedCategories = [];
    // Collect selected categories from checkboxes
    $('.category-checkbox').each(function() {
      if ($(this).is(':checked')) {
        selectedCategories.push($(this).val());
      }
    });
    return selectedCategories;
  }

  // Additional JS for managing dropdown enabling/disabling
  const dropdown1 = document.getElementById('dropdownMenuButton1');
  const dropdown2 = document.getElementById('dropdownMenuButton2');
  const contenttitle = document.getElementById('content-title');
  const dropdownMenu2 = document.querySelector('.dropdown-menu[aria-labelledby="dropdownMenuButton2"]');

  $('.dropdown-item').click(function(e) {
    e.preventDefault();
    var selectedOption = $(this).attr('data-value');
    if (selectedOption === 'box-plot') {
      $('#chart-container').addClass('active');
      $('#table-container').removeClass('active');
    } else if (selectedOption === 'table') {
      $('#table-container').addClass('active');
      $('#chart-container').removeClass('active');
    }
    updatePlot();
  });

  // Event listener for dropdown2 to capture the selected chart type
  $('#dropdown2 .dropdown-item').click(function(e) {
    e.preventDefault();
    var selectedChartType = $(this).attr('data-value');
    var button = $(this).closest('.dropdown').find('.dropdown-toggle');
    button.text($(this).text()); // Update button text with selected item
    updatePlot(selectedChartType);
  });

  function updateVariableDescriptions() {
    var xVariable = $('#variable').val();

    if (xVariable !== '') {
      $('#x-variable-description').removeClass('d-none');
      $('#x-variable-title').text(variableDescriptions[xVariable].title);
      $('#x-variable-text').text(variableDescriptions[xVariable].description);
      $('#x-variable-icon').html(variableDescriptions[xVariable].icon);
    } else {
      $('#x-variable-description').addClass('d-none');
    }
  }

  updateVariableDescriptions();
  $('#variable').change(updateVariableDescriptions);
  $('#shap-plot-form').change(function() {
    updatePlot();
  });

  updatePlot();

  document.getElementById('dropdown-menu1').addEventListener('click', function(e) {
    const selectedValue = e.target.getAttribute('data-value');

    if (selectedValue === 'chart') {
      dropdown2.disabled = false;
      dropdown2.classList.remove('btn-disabled');
      dropdownMenu2.classList.remove('dropdown-menu-disabled');
      $('#chart-container').addClass('active');
      $('#table-container').removeClass('active');
    } else {
      dropdown2.disabled = true;
      dropdown2.classList.add('btn-disabled');
      dropdownMenu2.classList.add('dropdown-menu-disabled');
    }
  });

  document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function(e) {
      const value = e.target.getAttribute('data-value');
      const button = e.target.closest('.dropdown').querySelector('.dropdown-toggle');
      button.innerHTML = e.target.innerHTML;

      if (button.id === 'dropdownMenuButton1') {
        if (value === 'chart') {
          dropdown2.disabled = false;
          dropdown2.classList.remove('btn-disabled');
          dropdownMenu2.classList.remove('dropdown-menu-disabled');
          contenttitle.innerText = 'Graphical Result';
        } else {
          dropdown2.disabled = true;
          dropdown2.classList.add('btn-disabled');
          dropdownMenu2.classList.add('dropdown-menu-disabled');
          contenttitle.innerText = 'Tabular Result';
        }
      }
    });
  });

  function renderChart(variableData, clusterData, incomeCategoryData, selectedCategories, variable, chartType) {
    $('#chart-container2').removeClass('active');

    var canvas = document.getElementById('boxplotChart');
    var context = canvas.getContext('2d');

    if (canvas.chart) {
      canvas.chart.destroy();
    }

    var categoryData = {
      'Clusters': {},
      'IncomeCategories': {}
    };

    for (var i = 0; i < variableData.length; i++) {
      var cluster = clusterData[i];
      var incomeCategory = incomeCategoryData[i];
      var value = variableData[i];

      if (!categoryData['Clusters'][cluster]) {
        categoryData['Clusters'][cluster] = [];
      }
      if (!categoryData['IncomeCategories'][incomeCategory]) {
        categoryData['IncomeCategories'][incomeCategory] = [];
      }

      categoryData['Clusters'][cluster].push(value);
      categoryData['IncomeCategories'][incomeCategory].push(value);
    }

    var labels = [];
    var datasetArray = [];
    var orderedCategories = ['0', '1', '2', '3', '4', 'B40', 'M40', 'T20'];
    var colors = {
      '0': {border: '#d62728', fill: 'rgba(214, 39, 40, 0.2)'},
      '1': {border: '#ff7f0e', fill: 'rgba(255, 127, 14, 0.2)'},
      '2': {border: '#166616', fill: 'rgba(22, 102, 22, 0.2)'},
      '3': {border: '#337ab7', fill: 'rgba(51, 122, 183, 0.2)'},
      '4': {border: '#09008d', fill: 'rgba(9, 0, 141, 0.2)'},
      'B40': {border: '#8c564b', fill: 'rgba(140, 86, 75, 0.2)'},
      'M40': {border: '#d2a925', fill: 'rgba(210, 169, 37, 0.2)'},
      'T20': {border: '#8a0005', fill: 'rgba(138, 0, 5, 0.2)'}
    };

    if (chartType === 'boxplot') {
      chartitle = "Boxplot Chart";

      for (var i = 0; i < orderedCategories.length; i++) {
        var category = orderedCategories[i];
        if (categoryData['Clusters'].hasOwnProperty(category) && selectedCategories.includes(category)) {
          datasetArray.push(categoryData['Clusters'][category]);
          labels.push(category);
        }
        if (categoryData['IncomeCategories'].hasOwnProperty(category) && selectedCategories.includes(category)) {
          datasetArray.push(categoryData['IncomeCategories'][category]);
          labels.push(category);
        }
      }

      datasetArray = [{
        label: '',
        backgroundColor: labels.map(label => colors[label].fill),
        borderColor: labels.map(label => colors[label].border),
        borderWidth: 1,
        outlierColor: '#999999',
        padding: 10,
        itemRadius: 0,
        data: datasetArray
      }];
    } else if (chartType === 'bar') {
      chartitle = "Stacked Bar Chart";

      var stackedData = {};
      var classCounts = {};
      var variableClasses = getUniqueClasses(variableData);

      for (var i = 0; i < orderedCategories.length; i++) {
        var category = orderedCategories[i];
        if ((categoryData['Clusters'].hasOwnProperty(category) && selectedCategories.includes(category)) || 
            (categoryData['IncomeCategories'].hasOwnProperty(category) && selectedCategories.includes(category))) {

          if (!stackedData[category]) stackedData[category] = [];
          if (!classCounts[category]) classCounts[category] = {};

          var dataArray = categoryData['Clusters'][category] || categoryData['IncomeCategories'][category];

          variableClasses.forEach(function(cls) {
            classCounts[category][cls] = 0;
          });

          dataArray.forEach(function(value) {
            classCounts[category][value]++;
          });

          var classDataArray = [];
          variableClasses.forEach(function(cls) {
            classDataArray.push(classCounts[category][cls]);
          });

          stackedData[category] = classDataArray;

          labels.push(category);
        }
      }

      var barColors = [
        'rgba(214, 39, 40, 0.2)',
        'rgba(255, 127, 14, 0.2)',
        'rgba(22, 102, 22, 0.2)',
        'rgba(51, 122, 183, 0.2)',
        'rgba(9, 0, 141, 0.2)',
        'rgba(140, 86, 75, 0.2)',
        'rgba(210, 169, 37, 0.2)',
        'rgba(138, 0, 5, 0.2)'
      ];

      for (var classIndex = 0; classIndex < variableClasses.length; classIndex++) {
        var classData = [];
        selectedCategories.forEach(function(category) {
          if (stackedData[category]) {
            classData.push(stackedData[category][classIndex]);
          }
        });

        datasetArray.push({
          label: variableDescriptions[variable].label[classIndex],
          data: classData,
          backgroundColor: barColors[classIndex],
          borderWidth: 1
        });
      }
    } else if (chartType === 'pie') {
      chartitle = "Cluster Category Pie Chart";

      $('#chart-container2').addClass('active');

      var iccanvas = document.getElementById('ic-chart');
      var iccontext = iccanvas.getContext('2d');

      if (iccanvas.chart) {
        iccanvas.chart.destroy();
      }

      var categoryData = {
        'Clusters': {},
        'IncomeCategories': {}
      };

      for (var i = 0; i < variableData.length; i++) {
        var cluster = clusterData[i];
        var incomeCategory = incomeCategoryData[i];
        var value = variableData[i];

        if (!categoryData['Clusters'][cluster]) {
          categoryData['Clusters'][cluster] = {};
        }
        if (!categoryData['IncomeCategories'][incomeCategory]) {
          categoryData['IncomeCategories'][incomeCategory] = {};
        }

        if (!categoryData['Clusters'][cluster][value]) {
          categoryData['Clusters'][cluster][value] = 0;
        }
        if (!categoryData['IncomeCategories'][incomeCategory][value]) {
          categoryData['IncomeCategories'][incomeCategory][value] = 0;
        }

        categoryData['Clusters'][cluster][value]++;
        categoryData['IncomeCategories'][incomeCategory][value]++;
      }

      var datasetArray = [];
      var datasetIncomeCategories = [];

      for (var cluster in categoryData['Clusters']) {
        if (selectedCategories.includes(cluster)) {
          var data = [];
          var backgroundColors = [];
          var borderColors = [];

          var values = Object.keys(categoryData['Clusters'][cluster]).sort((a, b) => a - b);

          var colorStep = 1 / values.length;

          values.forEach(function (value, index) {
            var colorValue = colorStep * (index + 1);

            var colorStart = colorRangesClusters[cluster].start;
            var colorEnd = colorRangesClusters[cluster].end;

            var interpolatedColor = interpolateColor(colorStart, colorEnd, colorValue);

            data.push(categoryData['Clusters'][cluster][value]);
            backgroundColors.push(interpolatedColor);
            borderColors.push('rgba(255, 255, 255, 1)');
          });

          datasetArray.push({
            data: data,
            backgroundColor: backgroundColors,
            borderColor: borderColors,
            borderWidth: 1,
            label: 'Cluster ' + cluster
          });
        }
      }

      var sortedIncomeCategories = {};
      orderedCategories.forEach(category => {
        if (categoryData['IncomeCategories'].hasOwnProperty(category)) {
          sortedIncomeCategories[category] = categoryData['IncomeCategories'][category];
        }
      });

      for (var category in sortedIncomeCategories) {
        if (selectedCategories.includes(category)) {

          var data = [];
          var backgroundColors = [];
          var borderColors = [];

          var values = Object.keys(categoryData['IncomeCategories'][category]).sort((a, b) => a - b);

          var colorStep = 1 / values.length;

          values.forEach(function (value, index) {
            var colorValue = colorStep * (index + 1);

            var colorStart = colorRangesIncomeCategories[category].start;
            var colorEnd = colorRangesIncomeCategories[category].end;

            var interpolatedColor = interpolateColor(colorStart, colorEnd, colorValue);

            data.push(sortedIncomeCategories[category][value]);
            backgroundColors.push(interpolatedColor);
            borderColors.push('rgba(255, 255, 255, 1)');
          });

          datasetIncomeCategories.push({
            data: data,
            backgroundColor: backgroundColors,
            borderColor: borderColors,
            borderWidth: 1,
          });
        }
      }

      iccanvas.chart = new Chart(iccontext, {
        type: 'pie',
        data: {
          labels: variableDescriptions[variable].label,
          datasets: datasetIncomeCategories
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: true,
              position: 'top'
            },
            title: {
              display: true,
              text: 'Income Category Pie Chart'
            }
          }
        }
      });
    }

    for (let i = 0; i < selectedCategories.length; i++) {
      if (['0', '1', '2', '3', '4'].includes(selectedCategories[i])) {
        selectedCategories[i] = 'Cluster ' + selectedCategories[i];
      }
    }

    canvas.chart = new Chart(context, {
      type: chartType,
      data: {
        labels: (chartType === 'pie') ? variableDescriptions[variable].label : selectedCategories,
        datasets: datasetArray
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: (chartType !== 'boxplot'),
            position: 'top'
          },
          title: {
            display: true,
            text: chartitle
          }
        },
        scales: {
          x: {
            display: (chartType !== 'pie'),
            stacked: (chartType === 'bar')
          },
          y: {
            display: (chartType !== 'pie'),
            stacked: (chartType === 'bar'),
            beginAtZero: false,
          }
        }
      }
    });
  }

  function calculateMean(values) {
    const sum = values.reduce((acc, val) => acc + val, 0);
    return (sum / values.length).toFixed(4);
  }

  function calculateMedian(values) {
    values.sort((a, b) => a - b);
    const half = Math.floor(values.length / 2);

    if (values.length % 2)
      return values[half].toFixed(4);

    return ((values[half - 1] + values[half]) / 2.0).toFixed(4);
  }

  function calculateMin(values) {
    return Math.min(...values).toFixed(4);
  }

  function calculateMax(values) {
    return Math.max(...values).toFixed(4);
  }

  function calculateQuartiles(values) {
    values.sort((a, b) => a - b);
    const q1 = (values[Math.floor((values.length / 4))]).toFixed(4);
    const q3 = (values[Math.ceil((values.length * (3 / 4))) - 1]).toFixed(4);
    return { q1, q3 };
  }

  function renderTable(variableData, clusterData, incomeCategoryData) {
    var selectedCategories = getSelectedCategories();

    const groups = {
      'Clusters': {},
      'IncomeCategories': {}
    };

    for (let i = 0; i < variableData.length; i++) {
      const cluster = clusterData[i];
      const incomeCategory = incomeCategoryData[i];
      const value = variableData[i];

      if (!groups['Clusters'][cluster]) {
        groups['Clusters'][cluster] = [];
      }
      if (!groups['IncomeCategories'][incomeCategory]) {
        groups['IncomeCategories'][incomeCategory] = [];
      }

      groups['Clusters'][cluster].push(value);
      groups['IncomeCategories'][incomeCategory].push(value);
    }

    const metrics = ['Mean', 'Median', 'Min', 'Q1', 'Q3', 'Max'];
    const groupNames = getSelectedCategories();
    const tableData = {};

    groupNames.forEach(group => {
      const values = groups['Clusters'][group] || groups['IncomeCategories'][group];
      const quartiles = calculateQuartiles(values);

      tableData[group] = {
        Mean: calculateMean(values),
        Median: calculateMedian(values),
        Min: calculateMin(values),
        Q1: quartiles.q1,
        Q3: quartiles.q3,
        Max: calculateMax(values)
      };
    });

    let tableBody = '<tr><th>Metric</th>';
    groupNames.forEach(group => {
      tableBody += `<th>${group}</th>`;
    });
    tableBody += '</tr>';

    metrics.forEach(metric => {
      tableBody += `<tr><td>${metric}</td>`;
      groupNames.forEach(group => {
        tableBody += `<td>${tableData[group][metric]}</td>`;
      });
      tableBody += '</tr>';
    });

    $('#dataTable tbody').html(tableBody);
  }

  function renderCrossTab(variableData, clusterData, incomeCategoryData) {
    var crossTabData = {};

    var clusters = ['0', '1', '2', '3', '4'];
    var incomeCategories = ['B40', 'M40', 'T20'];

    clusters.forEach(cluster => {
      crossTabData[cluster] = {};
      incomeCategories.forEach(category => {
        crossTabData[cluster][category] = 0;
      });
    });

    for (var i = 0; i < variableData.length; i++) {
      var cluster = clusterData[i];
      var incomeCategory = incomeCategoryData[i];
      crossTabData[cluster][incomeCategory]++;
    }

    var tableBody = document.getElementById('cross-tab-body');
    tableBody.innerHTML = '';

    clusters.forEach(cluster => {
      var row = document.createElement('tr');
      var clusterCell = document.createElement('td');
      clusterCell.textContent = `Cluster ${cluster}`;
      row.appendChild(clusterCell);

      incomeCategories.forEach(category => {
        var cell = document.createElement('td');
        cell.textContent = crossTabData[cluster][category];
        row.appendChild(cell);
      });

      tableBody.appendChild(row);
    });
  }

  $('.category-checkbox').change(function() {
    updatePlot();
  });

  function updateChartVisibility() {
    var selectedCategories = getSelectedCategories();
    var formData = new FormData($('#shap-plot-form')[0]);

    $.ajax({
      url: '/try',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        var variableData = response.variable_data;
        var clusterData = response.cluster_data;
        var incomeCategoryData = response.income_category_data;

        renderChart(variableData, clusterData, incomeCategoryData, selectedCategories);
      }
    });
  }

  function interpolateColor(colorStart, colorEnd, value) {
    var start = parseRGBA(colorStart);
    var end = parseRGBA(colorEnd);

    var r = Math.round(start[0] + (end[0] - start[0]) * value);
    var g = Math.round(start[1] + (end[1] - start[1]) * value);
    var b = Math.round(start[2] + (end[2] - start[2]) * value);
    var a = start[3] + (end[3] - start[3]) * value;

    return 'rgba(' + r + ',' + g + ',' + b + ',' + a + ')';
  }

  function parseRGBA(color) {
    var rgbaMatch = color.match(/\d+(\.\d+)?/g);
    if (!rgbaMatch || rgbaMatch.length < 4) {
      return [0, 0, 0, 1];
    }
    return rgbaMatch.map(function (value) {
      return parseFloat(value);
    });
  }

  function getUniqueClasses(data) {
    return Array.from(new Set(data)).sort((a, b) => a - b);
  }

  updateVariableDescriptions();
  $('#variable').change(updateVariableDescriptions);
  $('#shap-plot-form').change(function() {
    updatePlot();
  });
  updatePlot();
});
  </script>
    
</body>
</html>
