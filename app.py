from flask import Flask, render_template
import os

# Ruta absoluta del directorio actual
BASE_DIR = os.path.dirname(os.path.abspath(__file__))

app = Flask(
    __name__,
    static_folder=os.path.join(BASE_DIR, "static"),
    template_folder=os.path.join(BASE_DIR, "templates")
)

@app.route("/")
def index():
    return render_template("webCV.html")

@app.route("/WebDAM")
def vacaciones():
    return render_template("MisVacaciones.html")

@app.route("/Formulario")
def vacaciones():
    return render_template("Formulario.html")

if __name__ == "__main__":
    port = int(os.environ.get("PORT", 8000))
    app.run(host="0.0.0.0", port=port)


