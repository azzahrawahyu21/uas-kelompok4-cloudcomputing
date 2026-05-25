"""
Modul untuk menggabungkan semua cipher menjadi satu
Urutan enkripsi: Caesar → Vigenere → Stream → AES
Urutan dekripsi: AES → Stream → Vigenere → Caesar
"""
from classical import caesar, vigenere
from modern import aes, stream


def encrypt_combined(plaintext, keys):
    """
    Enkripsi menggunakan kombinasi semua cipher
    Urutan: Caesar → Vigenere → Stream → AES
    
    Args:
        plaintext: Teks yang akan dienkripsi
        keys: Dictionary dengan key untuk setiap cipher
            Format: {
                'caesar': 'key_caesar',
                'vigenere': 'key_vigenere',
                'stream': 'key_stream',
                'aes': 'key_aes' (bytes atau base64 string)
            }
    
    Returns:
        Ciphertext hasil kombinasi
    """
    result = plaintext
    
    # 1. Caesar Cipher
    caesar_key = keys.get('caesar', '')
    result = caesar.encrypt(result, caesar_key)
    
    # 2. Vigenere Cipher
    vigenere_key = keys.get('vigenere', '')
    result = vigenere.encrypt(result, vigenere_key)
    
    # 3. Stream Cipher
    stream_key = keys.get('stream', 'ace1')
    result = stream.encrypt(result, stream_key)
    
    # 4. AES Cipher (key wajib ada dan valid)
    aes_key = keys.get('aes', '')
    if not aes_key:
        raise ValueError("Key AES wajib diisi untuk enkripsi kombinasi.")

    result = aes.encrypt(result, aes_key)

    return result, keys


def decrypt_combined(ciphertext, keys):
    """
    Dekripsi menggunakan kombinasi semua cipher (urutan terbalik)
    Urutan: AES → Stream → Vigenere → Caesar
    
    Args:
        ciphertext: Teks yang akan didekripsi
        keys: Dictionary dengan key untuk setiap cipher
            Format: {
                'caesar': 'key_caesar',
                'vigenere': 'key_vigenere',
                'stream': 'key_stream',
                'aes': 'key_aes' (bytes atau base64 string)
            }
    
    Returns:
        Plaintext hasil dekripsi
    """
    result = ciphertext
    
    # 1. AES Cipher (dekripsi pertama)
    aes_key = keys.get('aes', '')
    if not aes_key:
        raise ValueError("Key AES diperlukan untuk dekripsi")

    try:
        result = aes.decrypt(result, aes_key)
    except Exception as e:
        raise ValueError(f"Gagal dekripsi AES: {str(e)}")
    
    # 2. Stream Cipher
    stream_key = keys.get('stream', 'ace1')
    result = stream.decrypt(result, stream_key)
    
    # 3. Vigenere Cipher
    vigenere_key = keys.get('vigenere', '')
    result = vigenere.decrypt(result, vigenere_key)
    
    # 4. Caesar Cipher
    caesar_key = keys.get('caesar', '')
    result = caesar.decrypt(result, caesar_key)
    
    return result

