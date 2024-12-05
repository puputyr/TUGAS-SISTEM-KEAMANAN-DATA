import hashlib  # SHA-256

class Block:
    # Konstruktor untuk kelas Block
    def _init_(self, data, prev_hash):
        self.data = data  # Data yang akan disimpan dalam blok
        self.prev_hash = prev_hash  # Hash dari blok sebelumnya
        self.hash = self.calc_hash()  # Menghitung hash untuk blok ini

    # Metode untuk menghitung hash menggunakan algoritma SHA-256
    def calc_hash(self):
        sha = hashlib.sha256()
        sha.update(self.data.encode('utf-8'))  # Encode (hashing) data
        return sha.hexdigest()  # Mengembalikan hasil hash sebagai string hex


class Blockchain:
    # Konstruktor untuk kelas Blockchain
    def _init_(self):
        self.chain = [self.create_genesis_block()]  # Inisialisasi blockchain dengan Genesis Block

    # Metode untuk membuat Genesis Block (blok pertama dalam blockchain)
    def create_genesis_block(self):
        return Block("Genesis Block", "0")

    # Metode untuk menambahkan blok baru ke dalam blockchain
    def add_block(self, data):
        prev_block = self.chain[-1]  # Mendapatkan blok terakhir dari blockchain
        new_block = Block(data, prev_block.hash)  # Membuat blok baru dengan data baru dan prev_hash dari blok terakhir
        self.chain.append(new_block)  # Menambahkan blok baru ke dalam blockchain


blockchain = Blockchain()  # Membuat objek blockchain

# Menambahkan beberapa blok ke dalam blockchain
blockchain.add_block("First Block")
blockchain.add_block("Second Block")
blockchain.add_block("Third Block")
blockchain.add_block("Fourth Block")
blockchain.add_block("Fifth Block")

# Menampilkan isi blockchain
print('Blockchain:')
for block in blockchain.chain:  # Iterasi untuk setiap blok dalam blockchain
    print('Data:', block.data)  # Menampilkan data dalam blok
    print('Previous Hash:', block.prev_hash)  # Menampilkan hash blok sebelumnya
    print('Hash:', block.hash)  # Menampilkan hash blok itu sendiri
    print('---')  # Menambahkan garis pemisah antar blok