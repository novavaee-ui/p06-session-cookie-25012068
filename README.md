# Praktikum Pemrograman Web I - Pertemuan 6

## Identitas

Nama: NUr Fadilah

NIM: 25012068

Kelas: M31
## Judul

Session, Cookie, Flash Message, dan Keranjang Sederhana

## Deskripsi

Aplikasi keranjang belanja sederhana menggunakan PHP tanpa database.

Aplikasi menggunakan Session untuk menyimpan data keranjang,
Flash Message untuk memberikan informasi setelah proses,
dan Cookie untuk menyimpan preferensi tema.

## Fitur

- Menampilkan daftar produk
- Menambahkan produk ke keranjang
- Menghitung jumlah produk
- Menghitung subtotal
- Menghitung total belanja
- Menghapus produk
- Mengosongkan keranjang
- Flash message
- Tema light dan dark
- Validasi input
- GitHub dengan minimal 10 commit

## Struktur Folder

```text
pertemuan-06/
│
├── index.php
├── cart.php
├── actions.php
├── bootstrap.php
├── functions.php
├── README.md
├── .gitignore
│
├── data/
│   └── products.php
│
└── components/
    ├── header.php
    └── footer.php