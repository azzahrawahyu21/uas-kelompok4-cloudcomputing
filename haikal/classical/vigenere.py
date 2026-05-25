def encrypt(text, key):
    """
    Enkripsi Vigenère yang mendukung:
    - Huruf besar & kecil (A-Z, a-z)
    - Angka (0-9)
    - Key HANYA huruf kecil dan angka (a-z, 0-9)
    """
    if not key:
        return text
    
    # Validasi: key harus huruf kecil atau angka (a-z, 0-9)
    if not all(c.islower() or c.isdigit() for c in key):
        raise ValueError("Key hanya boleh berupa huruf kecil (a-z) dan angka (0-9)!")
    
    result = ""
    key = key.lower()  # menandakan key dalam huruf kecil
    key_index = 0  # index untuk key
    
    for char in text:  # perulangan setiap karakter dalam teks
        if char.isalpha():  # cek apakah karakter adalah alfabet
            base = 'A' if char.isupper() else 'a'  # tentukan basis ASCII
            key_char = key[key_index % len(key)]
            
            # Hitung pergeseran berdasarkan key (huruf atau angka)
            if key_char.isalpha():
                shift = ord(key_char) - ord('a')
            else:  # key_char adalah digit
                shift = int(key_char)
            
            result += chr((ord(char) - ord(base) + shift) % 26 + ord(base))  # enkripsi karakter dan tambahkan ke hasil
            key_index += 1  # Geser ke huruf kunci berikutnya hanya ketika char alfabet
            
        elif char.isdigit():  # Angka 0-9
            key_char = key[key_index % len(key)]
            
            # Hitung shift dari key (huruf atau angka)
            if key_char.isalpha():
                shift = ord(key_char) - ord('a')
            else:  # key_char adalah digit
                shift = int(key_char)
            
            result += str((int(char) + shift) % 10)
            key_index += 1
        else:
            result += char  # tambahkan karakter non-alfabet tanpa perubahan
    
    return result  # kembalikan hasil enkripsi


def decrypt(text, key):
    """
    Dekripsi Vigenère yang mendukung:
    - Huruf besar & kecil (A-Z, a-z)
    - Angka (0-9)
    - Key HANYA huruf kecil dan angka (a-z, 0-9)
    """
    if not key:
        return text
    
    # Validasi: key harus huruf kecil atau angka (a-z, 0-9)
    if not all(c.islower() or c.isdigit() for c in key):
        raise ValueError("Key hanya boleh berupa huruf kecil (a-z) dan angka (0-9)!")
    
    result = ""
    key = key.lower()
    key_index = 0  # index untuk key
    
    for char in text:
        if char.isalpha():
            base = 'A' if char.isupper() else 'a'
            key_char = key[key_index % len(key)]
            
            # Hitung pergeseran berdasarkan key (huruf atau angka)
            if key_char.isalpha():
                shift = ord(key_char) - ord('a')
            else:  # key_char adalah digit
                shift = int(key_char)
            
            result += chr((ord(char) - ord(base) - shift) % 26 + ord(base))
            key_index += 1  # hanya maju ketika char alfabet
            
        elif char.isdigit():  # Angka 0-9
            key_char = key[key_index % len(key)]
            
            # Hitung shift dari key (huruf atau angka)
            if key_char.isalpha():
                shift = ord(key_char) - ord('a')
            else:  # key_char adalah digit
                shift = int(key_char)
            
            result += str((int(char) - shift) % 10)
            key_index += 1
        else:
            result += char
    
    return result