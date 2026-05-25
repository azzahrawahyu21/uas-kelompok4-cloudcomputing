# 🔐 Aplikasi Enkripsi & Dekripsi (Caesar, Vigenère, Stream, AES, Combined)

Aplikasi Flask untuk enkripsi/dekripsi teks dengan empat cipher dan satu mode kombinasi (semua cipher berurutan).

## ✨ Fitur
- Caesar Cipher (klasik, shift = panjang key)
- Vigenère Cipher (klasik, shift per huruf key)
- Stream Cipher sederhana berbasis LFSR (bit-level XOR)
- AES (CBC) dengan PKCS7 padding; key diulang/dipotong ke 16 byte
- Combined mode: Caesar → Vigenère → Stream → AES (dekripsi urutan terbalik)
- Form web siap pakai + endpoint API `POST /process`

## 📂 Struktur Proyek
```bash
apk-enkripsi-kriptografi/
├─ app.py                 # Flask app & routing
├─ classical/
│  ├─ caesar.py
│  └─ vigenere.py
├─ modern/
│  ├─ aes.py              # AES CBC (PyCryptodome), key 16 byte (repeat/truncate)
│  └─ stream.py           # LFSR stream cipher
├─ utils/
│  └─ combined_cipher.py  # Kombinasi semua cipher
├─ templates/index.html   # UI utama
├─ static/                # assets & css
├─ requirements.txt
└─ README.md
```

## ⚙️ Instalasi
Pastikan Python 3.8+. Lalu:
```bash
pip install -r requirements.txt
```
(`flask`, `pycryptodome`, `cryptography` tercakup.)

## ▶️ Menjalankan
```bash
python app.py
```
Buka http://127.0.0.1:5000/ di browser.

## 🔑 Aturan Key per Cipher
- Caesar: shift = panjang key (string apa saja).
- Vigenère: key alfabet (atau campuran; non-huruf tidak menggeser).
- Stream: key teks, default `ace1` (diubah ke seed LFSR 16-bit).
- AES: key teks bebas, akan diulang/dipotong menjadi 16 byte untuk AES-CBC.
- Combined: isi seluruh key (Caesar, Vigenère, Stream, AES). Urutan enkripsi: Caesar → Vigenère → Stream → AES. Dekripsi kebalikannya.

## 🌐 API Ringkas
Endpoint: `POST /process`  
Body (form-data):
- `text`: plaintext atau ciphertext
- `method`: `caesar` | `vigenere` | `stream` | `aes` | `combined`
- `action`: `encrypt` | `decrypt`
- `key`: untuk metode tunggal (kecuali combined)
- Untuk `combined`, sertakan:
  - `caesar_key`, `vigenere_key`, `stream_key`, `aes_key`

Respon: JSON `{ "result": "<hasil>" }`  
Untuk combined encrypt: juga mengembalikan `keys` dan `message`.

## 🧪 Contoh Cepat (curl)
```bash
# AES encrypt
curl -X POST http://127.0.0.1:5000/process \
  -F "text=HELLO" -F "method=aes" -F "action=encrypt" -F "key=rahasia"

# AES decrypt
curl -X POST http://127.0.0.1:5000/process \
  -F "text=<cipher_b64>" -F "method=aes" -F "action=decrypt" -F "key=rahasia"

# Combined encrypt
curl -X POST http://127.0.0.1:5000/process \
  -F "text=HELLO" -F "method=combined" -F "action=encrypt" \
  -F "caesar_key=abc" -F "vigenere_key=KEY" -F "stream_key=ace1" -F "aes_key=rahasia"
```

## 📝 Catatan
- AES memakai CBC + PKCS7 padding; ciphertext dibungkus Base64 (IV + cipher).
- Pastikan key dekripsi sama persis dengan yang dipakai saat enkripsi (terutama combined). ***