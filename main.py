from flask import Flask, redirect, url_for, render_template, send_file

app = Flask(__name__)


@app.route("/")
def home():
    return render_template('index.html')


"""
@app.route("/comments/")
def comments():
    return render_template('Comment.html')
"""


@app.route("/downloads/")
def downloads():
    return render_template('DownloadPage.html')


@app.route("/about/")
def aout():
    return render_template('About.html')


@app.route("/numberlinedownloadpage/")
def NLD():
    return render_template('Number_LineDownload.html')

@app.route("/timelinedownloadpage/")
def TLD():
    return render_template('Time_LineDownload.html')


@app.route('/NLDownload/')
def download_NL():
    path = "uploads/Number_Line_3.0.zip"
    return send_file(path, as_attachment=True)

@app.route('/TLDownload/')
def download_TL():
    path = "uploads/Time Line 2.0.zip"
    return send_file(path, as_attachment=True)


if __name__ == "__main__":
    app.run(debug=True)
