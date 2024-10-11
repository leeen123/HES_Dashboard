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

# verification
@app.route('/verification.php', methods=['GET', 'POST'])
def verification():
    return render_template('verification.php')

# verification_login
@app.route('/verification_login.php', methods=['GET', 'POST'])
def verification_login():
    return render_template('verification_login.php')

# verify_login
@app.route('/verify_login.php', methods=['GET', 'POST'])
def verify_login():
    return render_template('verify_login.php')

# add_user
@app.route('/add_user.php', methods=['GET', 'POST'])
def add_user():
    return render_template('add_user.php')

# update_user
@app.route('/update_user.php', methods=['GET', 'POST'])
def update_user():
    return render_template('update_user.php')

# shap-plot
@app.route('/shap_plot.html', methods=['GET', 'POST'])
def shap_plot():
    if request.method == 'POST':
        variable = request.form.get('variable')
        interaction_variable = request.form.get('interaction_variable')

        if not variable or not interaction_variable:
            return jsonify({'error': 'Please select both variable and interaction variable'}), 400

        try:
            # Load SHAP values and test data
            shap_values_path = os.path.join(os.getcwd(), "data/shap_values2.csv")
            x_test_path = os.path.join(os.getcwd(), "data/x_test.csv")
            
            if not os.path.exists(shap_values_path) or not os.path.exists(x_test_path):
                return jsonify({'error': 'CSV files not found'}), 404

            shap_values = pd.read_csv(shap_values_path).to_numpy()
            x_test = pd.read_csv(x_test_path)

            if variable not in x_test.columns or interaction_variable not in x_test.columns:
                return jsonify({'error': 'Invalid variables'}), 400

            # Generate SHAP dependence plot
            fig, ax = plt.subplots(figsize=(6, 4))
            shap.dependence_plot(variable, shap_values, x_test, interaction_index=interaction_variable, ax=ax)
            
            # Adjust layout and save plot
            fig.tight_layout()

            static_dir = app.static_folder
            if not os.path.exists(static_dir):
                os.makedirs(static_dir)
            
            shap_image_path = os.path.join(static_dir, 'shap_plot.png')
            fig.savefig(shap_image_path, bbox_inches='tight')
            plt.close(fig)

            variable_data = x_test[variable].tolist()
            interaction_variable_data = x_test[interaction_variable].tolist()

            return jsonify({
                'shap_plot': 'static/shap_plot.png',
                'variable_data': variable_data,
                'interaction_variable_data': interaction_variable_data
            })

        except Exception as e:
            return jsonify({'error': str(e)}), 500

    return render_template('shap_plot.html')


# try
@app.route('/test', methods=['GET', 'POST'])
def test():
    if request.method == 'POST':
        variable = request.form.get('variable')

        if not variable:
            return jsonify({'error': 'Variable is required'}), 400

        try:
            k_mean_analy_path = os.path.join(os.getcwd(), "data/k_mean_analy.csv")
            
            if not os.path.exists(k_mean_analy_path):
                return jsonify({'error': 'CSV file not found'}), 404

            k_mean_analy = pd.read_csv(k_mean_analy_path)

            if variable not in k_mean_analy.columns:
                return jsonify({'error': 'Invalid variable'}), 400

            k_mean_analy_data = k_mean_analy[variable].tolist()
            cluster_data = k_mean_analy['Cluster'].tolist()
            income_category_data = k_mean_analy['Income_Category'].tolist()

            return jsonify({
                'variable_data': k_mean_analy_data,
                'cluster_data': cluster_data,
                'income_category_data': income_category_data
            })

        except Exception as e:
            return jsonify({'error': str(e)}), 500

    return render_template('try.php')


if __name__ == '__main__':
    app.run(debug=True)
