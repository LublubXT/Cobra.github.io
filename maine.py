from flask import Flask, send_file, render_template
from werkzeug.utils import secure_filename

app = Flask(__name__)


@app.route('/')
def upload_form():
    return render_template('Test.html')


@app.route('/download',)
def download_file():
    path = "uploads/Number_Line_3.0.zip"
    return send_file(path, as_attachment=True)


@app.route('/d',)
def download():
    path = "uploads/Cobra.png"
    return send_file(path, as_attachment=True)


if __name__ == "__main__":
    app.run(debug=True)
