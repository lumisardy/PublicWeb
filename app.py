from flask import Flask, render_template, jsonify, request
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


# Repositorios públicos de GitHub, guardados 30 minutos (la API sin clave solo deja 60 llamadas por hora)
GITHUB_USUARIO = "lumisardy"
_github = {"hora": 0, "repos": []}


@app.route("/")
def index():
    # Dirección pública de la web, para las etiquetas que leen LinkedIn, WhatsApp y los buscadores
    esquema = request.headers.get("X-Forwarded-Proto", request.scheme)
    return render_template("webCV.html", base=esquema + "://" + request.host)

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
            # Si Shopify no responde (o limita las peticiones), se sirve lo último que se tenga y se reintenta en 2 minutos
            _tienda["hora"] = time.time() - 1680
    return jsonify(tienda=TIENDA_URL, total=len(_tienda["productos"]), productos=_tienda["productos"])

@app.route("/api/github")
def github():
    if time.time() - _github["hora"] > 1800:
        try:
            peticion = urllib.request.Request(
                "https://api.github.com/users/" + GITHUB_USUARIO + "/repos?per_page=100&sort=pushed",
                headers={"User-Agent": "Portfolio Aday", "Accept": "application/vnd.github+json"})
            with urllib.request.urlopen(peticion, timeout=8) as respuesta:
                datos = json.load(respuesta)
            repos = [{
                "nombre": r["name"],
                "lenguaje": r.get("language"),
                "descripcion": r.get("description"),
                "actualizado": r.get("pushed_at"),
                "url": r["html_url"],
            } for r in datos if not r.get("fork") and r["name"] != GITHUB_USUARIO]
            _github.update(hora=time.time(), repos=repos)
        except Exception:
            _github["hora"] = time.time() - 1500  # Si GitHub falla, se reintenta en 5 minutos con lo último que se tenga
    return jsonify(usuario=GITHUB_USUARIO, total=len(_github["repos"]), repos=_github["repos"][:12])


if __name__ == "__main__":
    port = int(os.environ.get("PORT", 8000))
    app.run(host="0.0.0.0", port=port)
