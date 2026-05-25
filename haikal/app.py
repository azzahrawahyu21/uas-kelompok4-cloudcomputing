from flask import Flask, render_template, request, send_file, jsonify
from classical import caesar, vigenere
from modern import aes, stream
import io

app = Flask(__name__)

@app.route("/", methods=["GET"])
def index():
    return render_template("index.html")

@app.route("/encrypt", methods=["GET"])
def encrypt():
    return render_template("encrypt.html")

@app.route("/process", methods=["POST"])
def process():
    text = request.form["text"]
    method = request.form["method"]
    action = request.form["action"]
    key = request.form.get("key", "")

    try:
        if method == "caesar":
            result = caesar.decrypt(text, key) if action == "decrypt" else caesar.encrypt(text, key)

        elif method == "vigenere":
            result = vigenere.decrypt(text, key) if action == "decrypt" else vigenere.encrypt(text, key)

        elif method == "stream":
            # Gunakan key atau default "ace1"
            stream_key = key if key else "ace1"
            result = stream.decrypt(text, stream_key) if action == "decrypt" else stream.encrypt(text, stream_key)

        elif method == "aes":
            if not key:
                result = "Key AES wajib diisi."
            else:
                try:
                    result = aes.decrypt(text, key) if action == "decrypt" else aes.encrypt(text, key)
                except Exception as e:
                    result = f"Error AES: {str(e)}"

        elif method == "all":
            # Enkripsi/Dekripsi bertingkat dengan 1 key
            if not key:
                result = "Key wajib diisi untuk enkripsi bertingkat."
            else:
                try:
                    if action == "encrypt":
                        # ENKRIPSI BERTINGKAT: Caesar → Vigenere → Stream → AES
                        step1 = caesar.encrypt(text, key)
                        step2 = vigenere.encrypt(step1, key)
                        step3 = stream.encrypt(step2, key)
                        step4 = aes.encrypt(step3, key)
                        
                        return jsonify({
                            "result": step4,
                            "steps": {
                                "caesar": step1,
                                "vigenere": step2,
                                "stream": step3,
                                "aes": step4
                            },
                            "message": f"Enkripsi bertingkat berhasil! Simpan key: {key}"
                        })
                    else:
                        # DEKRIPSI BERTINGKAT: AES → Stream → Vigenere → Caesar (kebalikan)
                        step1 = aes.decrypt(text, key)
                        step2 = stream.decrypt(step1, key)
                        step3 = vigenere.decrypt(step2, key)
                        result = caesar.decrypt(step3, key)
                        
                        return jsonify({
                            "result": result,
                            "message": "Dekripsi bertingkat berhasil!"
                        })
                except Exception as e:
                    result = f"Error enkripsi bertingkat: {str(e)}"

        else:
            result = "Metode tidak dikenal"

    except Exception as e:
        result = f"Terjadi error: {str(e)}"

    return jsonify({"result": result})


@app.route("/download")
def download():
    result = request.args.get("result", "")
    method = request.args.get("method", "")
    action = request.args.get("action", "")

    filename = f"{method}_{action}_result.txt"
    content = f"Hasil {action} dengan metode {method.upper()}:\n\n{result}"

    file_stream = io.BytesIO()
    file_stream.write(content.encode("utf-8"))
    file_stream.seek(0)

    return send_file(
        file_stream,
        as_attachment=True,
        download_name=filename,
        mimetype="text/plain"
    )


if __name__ == "__main__":
    app.run(debug=True, port=5001)