import warnings
warnings.filterwarnings(action='ignore', category=FutureWarning)

import matplotlib
matplotlib.use('Agg')  # Use the 'Agg' backend to prevent GUI windows from popping up

import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
import flask
import shap
import os
from io import BytesIO
from flask import render_template, request, jsonify

shap.initjs()

# Load SHAP values and test data
shap_values = pd.read_csv("../data/shap_values2.csv").to_numpy()
x_test = pd.read_csv("../data/x_test.csv")
k_mean_analy = pd.read_csv("../data/k_mean_analy.csv")

# Initialize Flask app
app = flask.Flask(__name__, template_folder='templates', static_folder='static')

# index
@app.route('/')
def index():
    return render_template('index.php')

# login
@app.route('/login.php', methods=['GET', 'POST'])
def login():
    return render_template('login.php')

# verfication
@app.route('/verification.php', methods=['GET', 'POST'])
def verification():
    return render_template('verification.php')

# add-user
@app.route('/add_user.php', methods=['GET', 'POST'])
def add_user():
    return render_template('add_user.php')

# update-user
@app.route('/update_user.php', methods=['GET', 'POST'])
def update_user():
    return render_template('update_user.php')

# shap-plot
@app.route('/', methods=['GET', 'POST'])
def shap():
    if request.method == 'POST':
        variable = request.form['variable']
        interaction_variable = request.form['interaction_variable']

        # Generate SHAP dependence plot
        fig, ax = plt.subplots(figsize=(6, 4))
        shap.dependence_plot(variable, shap_values, x_test, interaction_index=interaction_variable, ax=ax)
        
        # Adjust layout
        fig.tight_layout()

        # Ensure static directory exists
        static_dir = app.static_folder
        if not os.path.exists(static_dir):
            os.makedirs(static_dir)
        
        # Save the SHAP plot to a static file
        shap_image_path = os.path.join(static_dir, 'shap_plot.png')
        fig.savefig(shap_image_path, bbox_inches='tight')
        plt.close(fig)

        # Prepare data for Chart.js
        variable_data = x_test[variable].tolist()
        interaction_variable_data = x_test[interaction_variable].tolist()

        # Return success response
        return jsonify({
            'shap_plot': 'static/shap_plot.png',
            'variable_data': variable_data,
            'interaction_variable_data': interaction_variable_data
        })

    return render_template('shap_plot.php')

# try
@app.route('/test', methods=['GET', 'POST'])
def test():
    if request.method == 'POST':
        variable = request.form['variable']

        # Convert DataFrame to list of dictionaries
        k_mean_analy_data = k_mean_analy[variable].tolist()
        cluster_data = k_mean_analy['Cluster'].tolist()
        income_category_data = k_mean_analy['Income_Category'].tolist()

        # Return success response
        return jsonify({
            'variable_data': k_mean_analy_data,
            'cluster_data': cluster_data,
            'income_category_data': income_category_data
        })

    return render_template('try.php')

if __name__ == '__main__':
    app.run(debug=True)
