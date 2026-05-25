import re

def validate_key(key):
    if not re.fullmatch(r"[a-z0-9]+", key): 
        raise ValueError("Key hanya boleh berisi huruf kecil (a-z) dan angka (0-9).") 

def encrypt(text, key):
    validate_key(key) 
    shift = len(key) 
    result = "" 
    for char in text: 
        if char.isalpha(): 
            base = 'A' if char.isupper() else 'a' 
            result += chr((ord(char) - ord(base) + shift) % 26 + ord(base))
        else:
            result += char 
    return result

def decrypt(text, key):
    validate_key(key)
    shift = len(key)
    result = ""
    for char in text:
        if char.isalpha():
            base = 'A' if char.isupper() else 'a'
            result += chr((ord(char) - ord(base) - shift) % 26 + ord(base))  
        else:
            result += char
    return result
