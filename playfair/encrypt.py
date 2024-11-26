# Menginisialisasi variabel a dan b untuk digunakan dalam rekursi dalam pengisian karakter lainnya
a = b = 0

 
kunci = input("Masukkan kunci: ") # Meminta input pengguna Key (untuk membuat matriks karakter 5x5) yang sisimpan di var kunci
kunci = kunci.replace(" ", "") # menghapus semua spasi
kunci = kunci.upper()  # mengubah semua karakter dalam kunci menjadi huruf kapital
teks_biasa = input("Teks biasa: ")# Meminta input pengguna Pliantext (Pesan yang akan dienkripsi)
teks_biasa = teks_biasa.replace(" ", "") # menghapus semua spasi
teks_biasa = teks_biasa.upper() # mengubah semua karakter dalam kunci menjadi huruf kapital

# Mendefinisikan function  matriks yang membuat nested list secara rekursif
def matriks(x, y, awal): #  deklarasi function dengan tiga paramete
    return [[awal for i in range(x)] for j in range(y)] # mengembalikan nilai yang menghasilkan matriks baru



kunci_ke_matriks = list() # nisialisasi list kosong yang akan digunakan untuk menyimpan karakter-karakter dari kunci.
for c in kunci: # oop for yang akan mengiterasi melalui setiap karakter dalam string kunci yang diinputkan oleh pengguna
    if c not in kunci_ke_matriks: # kondisi yang memeriksa apakah karakter c belum ada dalam list kunci_ke_matriks
        if c == 'J': # Jika karakter c sama dengan 'J', maka 'J' akan diganti dengan 'I' dan karakter 'I' akan dimasukkan ke dalam list kunci_ke_matriks
            kunci_ke_matriks.append('I')
        else: # Jika karakter c bukan 'J', maka karakter c tersebut akan dimasukkan ke dalam list kunci_ke_matriks
            kunci_ke_matriks.append(c)


for i in range(65, 91): # loop for yang mengiterasi melalui angka Unicode (nilai ASCII) dari 65 (A) hingga 90 (Z), yang sesuai dengan huruf-huruf besar dalam alfabet
    if chr(i) not in kunci_ke_matriks: #kondisi yang memeriksa apakah karakter yang sesuai dengan nilai Unicode saat ini (diubah menjadi karakter menggunakan chr(i)) belum ada dalam list kunci_ke_matriks
        if i == 73 and chr(74) not in kunci_ke_matriks: # ondisi khusus yang memeriksa apakah nilai Unicode saat ini adalah 73 (I) dan jika karakter 'J' (Unicode 74) belum ada dalam kunci_ke_matriks
            kunci_ke_matriks.append("I") # ditambahkan ke dalam list kunci_ke_matriks
            a = 1 # ariabel a akan diatur menjadi 1.
        elif a == 0 and i == 73 or i == 74: # ondisi lain yang memeriksa apakah nilai Unicode saat ini adalah 73 (I) atau 74 (J), dan jika nilai a adalah 0
            pass # kondisi ini akan dilewati 
        else: # jika karakter yang sesuai dengan nilai Unicode saat ini tidak adalah 'I' atau 'J' dan belum ada dalam kunci_ke_matriks
            kunci_ke_matriks.append(chr(i)) #  karakter tersebut akan ditambahkan ke dalam list kunci_ke_matriks

# mendefinisikan matriks sandi sebagai matriks 5x5 dengan awalan 0
matriks_sandi = matriks(5, 5, 0)
for i in range(0, 5): #  loop luar yang mengendalikan baris matrix
    for j in range(0, 5):  #  loop dalamyang mengendalikan kolom matrix
        matriks_sandi[i][j] = kunci_ke_matriks[b]  # kunci_ke_matriks digabungkan ke awal matriks sandi
        b += 1

# fungsi indexlocator adalah fungsi yang mencari indeks suatu karakter tertentu
def indexlocator(x): #deklarasi fungsi indexlocator dengan satu parameter
    lst = list() #nisialisasi list kosong 
    if x == 'J': #ondisi yang memeriksa apakah karakter x adalah 'J'. Jika iya, maka kondisi ini mencoba menggantinya dengan 'I'.
        x == 'I'
    for i, j in enumerate(matriks_sandi): #  loop for luar yang akan mengiterasi melalui setiap baris j alam matriks sandi,
        for k, l in enumerate(j): # loop dalam yang akan mengiterasi melalui setiap elemen l dalam baris j matriks sandi, 
            if x == l: #kondisi yang memeriksa apakah karakter x sama dengan karakter l
                lst.append(i) #ditambahkan ke dalam list lst.
                lst.append(k)
                return lst #mengembalikan list lst


def enkripsi(teks): # deklarasi function enkripsi dg 1 parameter
    i = 0 #  Inisialisasi dengan 0.
    for s in range(0, len(teks) + 1, 2): # op yang akan mengiterasi melalui teks dengan langkah 2 karakte
        if s < len(teks) - 1: # kondisi yang memeriksa apakah s kurang dari panjang teks dikurangi 1. 
            if teks[s] == teks[s + 1]: # kondisi yang memeriksa apakah karakter pada posisi s sama dengan karakter pada posisi s + 1. 
                teks = teks[:s + 1] + 'X' + teks[s + 1:] #  Jika ada dua karakter berturut-turut yang sama, maka kode ini akan menambahkan karakter 'X' di antara mereka untuk memisahkan mereka
    if len(teks) % 2 != 0: #  kondisi yang memeriksa apakah panjang teks setelah pemrosesan sebelumnya adalah ganjil
        teks = teks[:] + 'X' # menambahkan karakter 'X' d
    print("Teks Sandi: ", end=' ') # mencetak teks awalan sebelum mencetak teks terenkripsi.
    while i < len(teks): # oop while yang akan mengiterasi melalui teks untuk mengenkripsi karakter-karakternya.
        lst = list() # inisialisasi list lst 
        lst = indexlocator(teks[i]) # menemukan indeks karakter pertama dalam pasangan yang akan dienkripsi.
        lon = list() # inisialisasi list lon
        lon = indexlocator(teks[i + 1]) # menemukan indeks karakter kedua dalam pasangan yang akan dienkripsi.
        if lst[1] == lon[1]: # ondisi yang memeriksa apakah kedua karakter dalam pasangan (lst dan lon) berada di kolom yang sama dalam matriks sandi.
            print(f"{matriks_sandi[(lst[0] + 1) % 5][lst[1]]}{matriks_sandi[(lon[0] + 1) % 5][lon[1]]}", end=' ') # Jika kondisi ini terpenuhi, maka karakter pertama akan digantikan dengan karakter di sebelah bawahnya dalam matriks sandi, dan karakter kedua akan digantikan dengan karakter di sebelah bawahnya
        elif lst[0] == lon[0]: #kondisi alternatif yang memeriksa apakah kedua karakter dalam pasangan (lst dan lon) berada dalam baris yang sama dalam matriks sandi.
            print(f"{matriks_sandi[lst[0]][(lst[1] + 1) % 5]}{matriks_sandi[lon[0]][(lon[1] + 1) % 5]}", end=' ') # arakter pertama akan digantikan dengan karakter di sebelah kanannya dalam matriks sandi, dan karakter kedua akan digantikan dengan karakter di sebelah kanannya dalam matriks sandi juga.
        else: # kondisi yang dijalankan jika kedua karakter dalam pasangan (lst dan lon) tidak berada dalam baris atau kolom yang sama dalam matriks sandi.
            print(f"{matriks_sandi[lst[0]][lon[1]]}{matriks_sandi[lon[0]][lst[1]]}", end=' ') # karakter pertama akan digantikan dengan karakter di baris yang sama dengan karakter pertama dan kolom yang sama dengan karakter kedua dalam matriks sandi, dan karakter kedua akan digantikan dengan karakter di baris yang sama dengan karakter kedua dan kolom yang sama dengan karakter pertama dalam matriks sandi.
        i += 2 # : Variabel i ditingkatkan sebesar 2

enkripsi(teks_biasa) # jalankan function enkripsi

