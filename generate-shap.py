import matplotlib
import shap
import matplotlib.pyplot as plt
import pandas as pd
import os

shap.initjs()

# Use 'Agg' backend to prevent figures from being displayed
matplotlib.use('Agg')

# Load SHAP values and test data
shap_values = pd.read_csv("data/shap_values2.csv").to_numpy()
x_test = pd.read_csv("data/x_test.csv")

# List of variables and interaction variables
variables = ["Log_Inc", "Highest_Certificate", "Saiz_HH", "Age", "Sex", "Strata",
             "Ethnic_Bumiputera", "Ethnic_Chinese", "Ethnic_Indian", "Ethnic_Others",
             "Region_Centre", "Region_East", "Region_Eastern Malaysia", "Region_North", "Region_South"]

# Directory to save plots
output_dir = "static/shap_plots/"
os.makedirs(output_dir, exist_ok=True)

# Generate SHAP dependence plots for all combinations
for var in variables:
    for interaction_var in variables:
        fig, ax = plt.subplots(figsize=(6, 4))
        
        if var == interaction_var:
            # If the variable and interaction variable are the same, exclude interaction_index
            shap.dependence_plot(var, shap_values, x_test, ax=ax)
            plot_filename = f"{var}.png"
        else:
            # Otherwise, include the interaction_index
            shap.dependence_plot(var, shap_values, x_test, interaction_index=interaction_var, ax=ax)
            plot_filename = f"{var}_{interaction_var}.png"
        
        fig.tight_layout()
        plot_path = os.path.join(output_dir, plot_filename)
        fig.savefig(plot_path, bbox_inches='tight')
        plt.close(fig)