<script>
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

  function onlyUnique(value, index, array) {
    return array.indexOf(value) === index;
  }


// Additional JS for managing dropdown enabling/disabling
const dropdown1 = document.getElementById('dropdownMenuButton1');
const dropdown2 = document.getElementById('dropdownMenuButton2');
const contenttitle = document.getElementById('content-title')
const dropdownMenu2 = document.querySelector('.dropdown-menu[aria-labelledby="dropdownMenuButton2"]');

$('#chart-icon').click(function() {

  console.log("chart-icon called!");

  $('#chart-container').addClass('active');
  $('#table-container').removeClass('active');
  $('#chart-icon').addClass('active-button');
  $('#table-icon').removeClass('active-button');
});

$('#table-icon').click(function() {

  console.log("table-icon called!");

  $('#table-container').addClass('active');
  $('#chart-container').removeClass('active');
  $('#table-icon').addClass('active-button');
  $('#chart-icon').removeClass('active-button');
});

$('.dropdown-item').click(function(e) {
  console.log("#variable dropdown called");
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
    console.log("#dropdown2 called");
    e.preventDefault();
    var selectedChartType = $(this).attr('data-value');
    var button = $(this).closest('.dropdown').find('.dropdown-toggle');
    button.text($(this).text()); // Update button text with selected item
    console.log("Selected chart type:", selectedChartType);
    updatePlot(selectedChartType)
});

function updatePlot(chartType = 'boxplot') {

  console.log("update plot charttype: ", chartType)
  var formData = new FormData($('#shap-plot-form')[0]);

  var variable_selected = [];

  formData.forEach((value, key) => {
    variable_selected.push(value);
  });

  // console.log("variable_selected: ", variable_selected);

  $.ajax({
    url: '/test',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
      // Update variable statistics
      $('#x-variable-stats').html(response.x_variable_stats);

      // console.log("data received: ", response);

      // Extract the data for the boxplot
      var variableData = response.variable_data;
      var clusterData = response.cluster_data;
      var incomeCategoryData = response.income_category_data;

      console.log("chartType:",chartType);

      renderChart(variableData, clusterData, incomeCategoryData, getSelectedCategories(), variable_selected, chartType);
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

// Function to parse RGBA components from a string
function parseRGBA(color) {
    var rgbaMatch = color.match(/\d+(\.\d+)?/g);
    if (!rgbaMatch || rgbaMatch.length < 4) {
        return [0, 0, 0, 1]; // Default to fully transparent black if parsing fails
    }
    return rgbaMatch.map(function (value) {
        return parseFloat(value);
    });
}

// Function to interpolate between two colors based on a value between 0 and 1
function interpolateColor(colorStart, colorEnd, value) {
    var start = parseRGBA(colorStart);
    var end = parseRGBA(colorEnd);

    var r = Math.round(start[0] + (end[0] - start[0]) * value);
    var g = Math.round(start[1] + (end[1] - start[1]) * value);
    var b = Math.round(start[2] + (end[2] - start[2]) * value);
    var a = start[3] + (end[3] - start[3]) * value;

    return 'rgba(' + r + ',' + g + ',' + b + ',' + a + ')';
}


function renderChart(variableData, clusterData, incomeCategoryData, selectedCategories, variable, chartType) {

    $('#chart-container2').removeClass('active');

    console.log("clusterData: ",clusterData);

    var canvas = document.getElementById('boxplotChart');
    var context = canvas.getContext('2d');

    if (canvas.chart) {
        canvas.chart.destroy();
    }

    // Prepare the data for Chart.js
    var categoryData = {
        'Clusters': {},
        'IncomeCategories': {}
    };

    // Iterate over the variable data and group by cluster and income category
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

    function getUniqueClasses(data) {
        return Array.from(new Set(data)).sort((a, b) => a - b);
    }

    if (chartType === 'boxplot') {

      chartitle = "Boxplot Chart"

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

        chartitle = "Stacked Bar Chart"

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

        // Define color ranges for each cluster and income category
        var colorRanges = {
            '0': { start: 'rgba(214, 39, 40, 0.25)', end: 'rgba(214, 39, 40, 1)' },   // Example: Red
            '1': { start: 'rgba(255, 127, 14, 0.25)', end: 'rgba(255, 127, 14, 1)' },   // Example: Orange
            '2': { start: 'rgba(22, 102, 22, 0.25)', end: 'rgba(22, 102, 22, 1)' },   // Example: Green
            '3': { start: 'rgba(51, 122, 183, 0.25)', end: 'rgba(51, 122, 183, 1)' },   // Example: Blue
            '4': { start: 'rgba(9, 0, 141, 0.25)', end: 'rgba(9, 0, 141, 1)' },   // Example: Indigo
            '5': { start: 'rgba(140, 86, 75, 0.25)', end: 'rgba(140, 86, 75, 1)' }, // Example: Brown
            '6': { start: 'rgba(210, 169, 37, 0.25)', end: 'rgba(210, 169, 37, 1)' }, // Example: Teal
            '7': { start: 'rgba(138, 0, 5, 0.25)', end: 'rgba(138, 0, 5, 1)' }  // Example: Purple
        };

        console.log("colorRanges: ", Object.keys(colorRanges).length)

        for (var classIndex = 0; classIndex < variableClasses.length; classIndex++) {
            var classData = [];
            selectedCategories.forEach(function(category) {
                if (stackedData[category]) {
                    classData.push(stackedData[category][classIndex]);
                }
            });

            console.log("classData: ",classData)

            var colorarray = []

            var colorStep = 1 / variableClasses.length;

            var value = classIndex*colorStep;
            
            for(i=0; i<Object.keys(colorRanges).length; i++){
              console.log("i*colorStep:",i*colorStep)

              var colorStart = colorRanges[i].start;
              var colorEnd = colorRanges[i].end;

              colorarray.push(interpolateColor(colorStart, colorEnd, value));
            }

            console.log("colorarray: ",colorarray)

            datasetArray.push({
                label: variableDescriptions[variable].label[classIndex],
                data: classData,
                backgroundColor: colorarray,
                borderWidth: 1
            });
        }
    } else if (chartType === 'pie') {

      chartitle = "Cluster Category Pie Chart"

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

      // Define color ranges for each cluster and income category
      var colorRangesClusters = {
          '0': { start: 'rgba(214, 39, 40, 0.5)', end: 'rgba(214, 39, 40, 1)' },   // Example: Red
          '1': { start: 'rgba(255, 127, 14, 0.5)', end: 'rgba(255, 127, 14, 1)' },   // Example: Orange
          '2': { start: 'rgba(22, 102, 22, 0.5)', end: 'rgba(22, 102, 22, 1)' },   // Example: Green
          '3': { start: 'rgba(51, 122, 183, 0.5)', end: 'rgba(51, 122, 183, 1)' },   // Example: Blue
          '4': { start: 'rgba(9, 0, 141, 0.5)', end: 'rgba(9, 0, 141, 1)' },   // Example: Indigo
      };

      var colorRangesIncomeCategories = {
          'B40': { start: 'rgba(140, 86, 75, 0.5)', end: 'rgba(140, 86, 75, 1)' }, // Example: Brown
          'M40': { start: 'rgba(210, 169, 37, 0.5)', end: 'rgba(210, 169, 37, 1)' }, // Example: Teal
          'T20': { start: 'rgba(138, 0, 5, 0.5)', end: 'rgba(138, 0, 5, 1)' }  // Example: Purple
      };

      // Prepare data for cluster pie chart
      for (var cluster in categoryData['Clusters']) {
          if (selectedCategories.includes(cluster)) {
              var data = [];
              var backgroundColors = [];
              var borderColors = [];

              // Get unique values (educational levels) for current cluster
              var values = Object.keys(categoryData['Clusters'][cluster]).sort((a, b) => a - b);

              // Calculate color step based on number of values
              var colorStep = 1 / values.length;

              // Assign colors dynamically based on educational level values
              values.forEach(function (value, index) {
                  var colorValue = colorStep * (index + 1); // Calculate color value between 0 and 1

                  var colorStart = colorRangesClusters[cluster].start;
                  var colorEnd = colorRangesClusters[cluster].end;

                  // Interpolate between start and end colors based on colorValue
                  var interpolatedColor = interpolateColor(colorStart, colorEnd, colorValue);

                  data.push(categoryData['Clusters'][cluster][value]);
                  backgroundColors.push(interpolatedColor);
                  borderColors.push('rgba(255, 255, 255, 1)'); // White border for contrast, adjust as needed
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

      // Ensure categories are in the correct order
      var sortedIncomeCategories = {};
      orderedCategories.forEach(category => {
          if (categoryData['IncomeCategories'].hasOwnProperty(category)) {
              sortedIncomeCategories[category] = categoryData['IncomeCategories'][category];
          }
      });

      console.log("sortedIncomeCategories: ",sortedIncomeCategories)
      console.log("categoryData: ",categoryData)

      // Prepare data for income category pie chart
      for (var category in sortedIncomeCategories) {
          if (selectedCategories.includes(category)) {

              var data = [];
              var backgroundColors = [];
              var borderColors = [];

              // Get unique values (educational levels) for current income category
              var values = Object.keys(categoryData['IncomeCategories'][category]).sort((a, b) => a - b);
              console.log("values: ",values)

              // Calculate color step based on number of values
              var colorStep = 1 / values.length;

              // Assign colors dynamically based on educational level values
              values.forEach(function (value, index) {
                  var colorValue = colorStep * (index + 1); // Calculate color value between 0 and 1

                  var colorStart = colorRangesIncomeCategories[category].start;
                  var colorEnd = colorRangesIncomeCategories[category].end;

                  // Interpolate between start and end colors based on colorValue
                  var interpolatedColor = interpolateColor(colorStart, colorEnd, colorValue);

                  data.push(sortedIncomeCategories[category][value]);
                  backgroundColors.push(interpolatedColor);
                  borderColors.push('rgba(255, 255, 255, 1)'); // White border for contrast, adjust as needed
              });

              console.log("datasetIncomeCategories: ", datasetIncomeCategories);

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

    console.log(selectedCategories);

    console.log("datasetArray: ", datasetArray);

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

  console.log("selectedCategories: ", selectedCategories);

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

  console.log("groupNames: ", groupNames)

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
  // Create an object to store the counts for each combination of cluster and income category
  var crossTabData = {};

  // Initialize the crossTabData object with zero counts
  var clusters = ['0', '1', '2', '3', '4'];
  var incomeCategories = ['B40', 'M40', 'T20'];
  var i=1;

  clusters.forEach(cluster => {
    crossTabData[cluster] = {};
    incomeCategories.forEach(category => {
      crossTabData[cluster][category] = 0;
    });
  });

  // Populate the crossTabData object with counts
  for (var i = 0; i < variableData.length; i++) {
    var cluster = clusterData[i];
    var incomeCategory = incomeCategoryData[i];
      crossTabData[cluster][incomeCategory]++;

      // console.log("crossTabData[cluster][incomeCategory]: ", crossTabData[cluster][incomeCategory])
  }

  // Find the tbody element where the table rows will be inserted
  var tableBody = document.getElementById('cross-tab-body');

  // Clear any existing rows
  tableBody.innerHTML = '';

  // Generate table rows based on the crossTabData object
  clusters.forEach(cluster => {
    var row = document.createElement('tr');
    var clusterCell = document.createElement('td');
    clusterCell.textContent = cluster;
    row.appendChild(clusterCell);

    incomeCategories.forEach(category => {
      var cell = document.createElement('td');
      cell.textContent = crossTabData[cluster][category];
      row.appendChild(cell);
    });

    tableBody.appendChild(row);
  });
}
// Function to update chart based on selected categories
function updateChartVisibility() {
  console.log("here!");
  var selectedCategories = getSelectedCategories();
  var formData = new FormData($('#shap-plot-form')[0]);

  $.ajax({
    url: '/test',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
      // Extract the data for the boxplot
      var variableData = response.variable_data;
      var clusterData = response.cluster_data;
      var incomeCategoryData = response.income_category_data;

      renderChart(variableData, clusterData, incomeCategoryData, selectedCategories);
    }
  });
}

// Event listener for checkbox changes
$('.category-checkbox').change(function() {
  updatePlot();
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
    console.log("selectedValue:", selectedValue);

    if (selectedValue === 'chart') {
        console.log("selected chart! here");
        dropdown2.disabled = false;
        dropdown2.classList.remove('btn-disabled');
        dropdownMenu2.classList.remove('dropdown-menu-disabled');
        $('#chart-container').addClass('active');
        $('#table-container').removeClass('active');
    } else {
        console.log("selected table! here");
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

            console.log("contenttitle:",contenttitle)

            if (value === 'chart') {
                dropdown2.disabled = false;
                dropdown2.classList.remove('btn-disabled');
                dropdownMenu2.classList.remove('dropdown-menu-disabled');
                contenttitle.innerText = 'Graphical Result'
            } else {
                dropdown2.disabled = true;
                dropdown2.classList.add('btn-disabled');
                dropdownMenu2.classList.add('dropdown-menu-disabled');
                contenttitle.innerText = 'Tabular Result'
            }
        }
    });
});


});
</script>