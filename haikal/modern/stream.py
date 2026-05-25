# modern/stream.py
# Implementasi Stream Cipher sederhana berbasis LFSR (ASCII)

def text_to_bits(text):
    """Konversi teks ke bit string"""
    return ''.join(format(ord(c), '08b') for c in text)

def bits_to_text(bits):
    """Konversi bit string ke teks ASCII"""
    chars = [bits[i:i+8] for i in range(0, len(bits), 8)]
    return ''.join(chr(int(b, 2)) for b in chars)

def lfsr_step(state, taps):
    """Lakukan satu langkah LFSR"""
    xor = 0
    for t in taps:
        xor ^= (state >> t) & 1
    new_bit = xor
    next_state = ((state << 1) | new_bit) & 0xFFFF  # 16-bit LFSR
    return next_state, new_bit

def generate_keystream(length, seed_int, taps):
    """Hasilkan keystream bit sepanjang length"""
    keystream = ''
    for _ in range(length):
        seed_int, bit = lfsr_step(seed_int, taps)
        keystream += str(bit)
    return keystream

def encrypt(plaintext, key="ace1"):
    """Enkripsi Stream Cipher berbasis LFSR"""
    seed_int = int(key.encode().hex(), 16) & 0xFFFF
    taps = [16, 14, 13, 11]

    pt_bits = text_to_bits(plaintext)
    keystream = generate_keystream(len(pt_bits), seed_int, taps)

    cipher_bits = ''.join('1' if pt_bits[i] != keystream[i] else '0' for i in range(len(pt_bits)))
    return bits_to_text(cipher_bits)

def decrypt(ciphertext, key="ace1"):
    """Dekripsi Stream Cipher (simetris)"""
    seed_int = int(key.encode().hex(), 16) & 0xFFFF
    taps = [16, 14, 13, 11]

    ct_bits = text_to_bits(ciphertext)
    keystream = generate_keystream(len(ct_bits), seed_int, taps)

    plain_bits = ''.join('1' if ct_bits[i] != keystream[i] else '0' for i in range(len(ct_bits)))
    return bits_to_text(plain_bits)
