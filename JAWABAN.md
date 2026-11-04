# Jawaban Tes Debugging SIMRS Mini

Nama:
Tanggal:

Salin blok di bawah untuk setiap bug yang Anda temukan.

## Bug 1

- Gejala: kolom nama secara default akan berisi gender (male / female)
- Lokasi (file:baris): database/factories/PasienFactory.php line 21
- Penyebab: name($jenisKelamin === 'L' ? 'male' : 'female' 
- Perbaikan:
