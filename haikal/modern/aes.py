from Crypto.Cipher import AES
from Crypto.Random import get_random_bytes
import base64

# -------------------------
# Membuat key AES dari input pendek
# -------------------------
def make_aes_key(key: str, length: int = 16):
    if not key:
        raise ValueError("Key AES harus diisi.")
    # ulangi hingga cukup panjang, lalu potong jadi length byte
    while len(key) < length:
        key += key
    return key[:length].encode()  # hasil: bytes


# -------------------------
# PKCS7 Padding
# -------------------------
def pad(data):
    pad_len = 16 - (len(data) % 16)
    return data + bytes([pad_len]) * pad_len

def unpad(data):
    pad_len = data[-1]
    if pad_len < 1 or pad_len > 16 or data[-pad_len:] != bytes([pad_len]) * pad_len:
        raise ValueError("Padding tidak valid.")
    return data[:-pad_len]


# -------------------------
# ENCRYPT
# -------------------------
def encrypt(plaintext: str, key: str):
    aes_key = make_aes_key(key, 16)

    iv = get_random_bytes(16)
    cipher = AES.new(aes_key, AES.MODE_CBC, iv)

    padded = pad(plaintext.encode())
    encrypted = cipher.encrypt(padded)

    # gabungkan IV + ciphertext, lalu base64
    return base64.b64encode(iv + encrypted).decode()


# -------------------------
# DECRYPT
# -------------------------
def decrypt(b64cipher: str, key: str):
    aes_key = make_aes_key(key, 16)

    try:
        raw = base64.b64decode(b64cipher)
    except Exception as exc:
        raise ValueError(f"Ciphertext tidak valid: {exc}")

    if len(raw) < 16:
        raise ValueError("Ciphertext terlalu pendek (IV hilang).")

    iv = raw[:16]
    ciphertext = raw[16:]

    cipher = AES.new(aes_key, AES.MODE_CBC, iv)
    decrypted = cipher.decrypt(ciphertext)

    return unpad(decrypted).decode()
