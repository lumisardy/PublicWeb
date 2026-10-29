from flask import Flask, render_template, jsonify
import json
import os
import time
import urllib.request

# Ruta absoluta del directorio actual
BASE_DIR = os.path.dirname(os.path.abspath(__file__))

app = Flask(
    __name__,
    static_folder=os.path.join(BASE_DIR, "static"),
    template_folder=os.path.join(BASE_DIR, "templates")
)

# Productos de la tienda (contornobeauty.com), guardados 30 minutos para no llamar a Shopify en cada visita
TIENDA_URL = "https://contornobeauty.com"
_tienda = {"hora": 0, "productos": []}


@app.route("/")
def index():
    return render_template("webCV.html")

@app.route("/WebDAM")
def vacaciones():
    return render_template("MisVacaciones.html")

@app.route("/Formulario")
def formulario():
    return render_template("Formulario.html")



@app.route("/WebPerros")
def webperros():
    return render_template("Web_perros/index.php")

@app.route("/api/tienda")
def tienda():
    if time.time() - _tienda["hora"] > 1800:
        try:
            peticion = urllib.request.Request(TIENDA_URL + "/products.json?limit=60", headers={"User-Agent": "Portfolio Aday"})
            with urllib.request.urlopen(peticion, timeout=8) as respuesta:
                datos = json.load(respuesta)
            productos = []
            for p in datos.get("products", []):
                if not p.get("images") or not p.get("variants"):
                    continue
                variante = p["variants"][0]
                productos.append({
                    "titulo": p["title"],
                    "precio": variante.get("price"),
                    "antes": variante.get("compare_at_price"),
                    "imagen": p["images"][0]["src"].split("?")[0] + "?width=480",
                    "url": TIENDA_URL + "/products/" + p["handle"],
                })
            _tienda.update(hora=time.time(), productos=productos)
        except Exception:
            pass  # Si Shopify no responde, se sirve lo último que se tenga
    return jsonify(tienda=TIENDA_URL, total=len(_tienda["productos"]), productos=_tienda["productos"])

if __name__ == "__main__":
    port = int(os.environ.get("PORT", 8000))
    app.run(host="0.0.0.0", port=port)
