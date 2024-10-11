import matplotlib
import sys
import json
import shap
import matplotlib.pyplot as plt
import pandas as pd

shap.initjs()

# Get the path to the JSON file from PHP
json_file_path = sys.argv[1]

# Read the JSON data from the file
with open(json_file_path, 'r') as file:
    data = json.load(file)

# Write the raw JSON data to the validation file for debugging
with open('validation_output.txt', 'w') as f:
    f.write(f"Data from JSON file: {data}\n")

# Extract the variables from the data
variable = data["variable"]
interaction_variable = data["interaction_variable"]

# Write the variables to the validation file for further debugging
with open('validation_output.txt', 'a') as f:
    f.write(f"Decoded variable: {variable}\n")
    f.write(f"Decoded interaction_variable: {interaction_variable}\n")

# Use 'Agg' backend to prevent figures from being displayed
matplotlib.use('Agg')

# Load SHAP values and test data
shap_values = pd.read_csv("../../data/shap_values2.csv").to_numpy()
x_test = pd.read_csv("../../data/x_test.csv")

# Generate SHAP dependence plot
fig, ax = plt.subplots(figsize=(6, 4))
shap.dependence_plot(variable, shap_values, x_test, interaction_index=interaction_variable, ax=ax)

# Adjust layout
fig.tight_layout()

# Save the SHAP plot to a static file
shap_image_path = "../static/shap_plot.png"
fig.savefig(shap_image_path, bbox_inches='tight')
plt.close(fig)
