# Jawaban Tes Debugging SIMRS Mini

Nama: Akhmad Syaifudin
Tanggal: 04 November 2026

Salin blok di bawah untuk setiap bug yang Anda temukan.

## Bug 1

- Gejala: Error `Call to a member function translatedFormat() on string` (serta gagal menghitung `$pasien->umur` dan memformat tanggal lahir) saat membuka halaman Daftar Pasien (`/pasien`), Detail Pasien, atau Ubah Pasien.
- Lokasi (file:baris): `app/Models/Pasien.php:44`
- Penyebab: Nama atribut pada method `casts()` tertulis `'tgl_lahir' => 'date'`, sedangkan nama kolom di tabel `pasien` adalah `'tanggal_lahir'`, sehingga nilai `tanggal_lahir` tetap bertipe `string` dan bukan instance `Carbon`.
- Perbaikan: Mengubah key cast dari `'tgl_lahir' => 'date'` menjadi `'tanggal_lahir' => 'date'`.

## Bug 2

- Gejala: Data `alamat` pasien tidak ikut tersimpan ke database saat menambah pasien baru maupun saat memperbarui data pasien.
- Lokasi (file:baris): `app/Models/Pasien.php:30-39`
- Penyebab: Kolom `'alamat'` belum didaftarkan di dalam properti `$fillable` pada model `Pasien`.
- Perbaikan: Menambahkan `'alamat'` ke dalam array `$fillable` pada `app/Models/Pasien.php`.

## Bug 3

- Gejala: Jumlah "Pasien Perempuan" pada halaman Dashboard selalu bernilai `0`.
- Lokasi (file:baris): `app/Http/Controllers/DashboardController.php:17`
- Penyebab: Query menghitung pasien perempuan menggunakan `Pasien::where('jenis_kelamin', 'Perempuan')->count()`, padahal nilai kode jenis kelamin perempuan yang disimpan di database adalah `'P'`.
- Perbaikan: Mengubah kondisi query menjadi `Pasien::where('jenis_kelamin', 'P')->count()`.

## Bug 4

- Gejala: Daftar "Pasien Terbaru" pada halaman Dashboard menampilkan pasien berdasarkan usia paling muda, bukan pasien yang terakhir didaftarkan.
- Lokasi (file:baris): `app/Http/Controllers/DashboardController.php:20`
- Penyebab: Query menggunakan `Pasien::latest('tanggal_lahir')->take(5)->get()` yang mengurutkan data berdasarkan kolom `tanggal_lahir` terbaru.
- Perbaikan: Mengubah pengurutan menjadi `Pasien::latest('id')->take(5)->get()`.

## Bug 5

- Gejala: Masalah performa N+1 query saat menampilkan daftar pasien karena setiap baris memanggil relasi `$pasien->dokter`.
- Lokasi (file:baris): `app/Http/Controllers/PasienController.php:19`
- Penyebab: Query pada `PasienController@daftar` tidak melakukan eager loading relasi `dokter`, sehingga memicu query tambahan untuk setiap baris pasien pada tabel.
- Perbaikan: Menambahkan eager loading `->with('dokter')` pada query `Pasien::query()`.

## Bug 6

- Gejala: Pencarian data pasien (`?cari=...`) tidak menemukan kata kunci yang berada di awal atau tengah teks, serta filter pencarian hilang saat berpindah halaman paginasi.
- Lokasi (file:baris): `app/Http/Controllers/PasienController.php:23-26`
- Penyebab: Pola `LIKE` pada `whereAny` kurang karakter wildcard `%` di akhir (`"%{$kataKunci}"`) dan hasil `paginate(10)` belum memanggil `withQueryString()`.
- Perbaikan: Mengubah pola pencarian menjadi `"%{$kataKunci}%"` dan menambahkan `->withQueryString()` setelah `->paginate(10)`.

## Bug 7

- Gejala: Error `UniqueConstraintViolationException` (duplikasi `no_rm`) saat menambahkan pasien baru apabila sebelumnya pernah ada data pasien yang dihapus.
- Lokasi (file:baris): `app/Http/Controllers/PasienController.php:44-45`
- Penyebab: Nomor rekam medis baru dihitung menggunakan `Pasien::count() + 1`, sehingga ketika ada baris yang dihapus, jumlah total baris berkurang dan menghasilkan `no_rm` yang sudah digunakan oleh data pasien terakhir.
- Perbaikan: Mengambil nilai `no_rm` terbesar dari database menggunakan `Pasien::max('no_rm')` lalu menambahkan 1 pada nomor urutnya.

## Bug 8

- Gejala: Saat mengubah data pasien tanpa mengganti NIK, validasi selalu gagal dengan pesan *"NIK sudah terdaftar."*
- Lokasi (file:baris): `app/Http/Requests/PasienRequest.php:14`
- Penyebab: Aturan `Rule::unique('pasien', 'nik')->ignore($this->id)` menggunakan `$this->id` yang bernilai `null`, karena parameter route untuk update pasien bernama `{pasien}` (Route Model Binding).
- Perbaikan: Mengubah `->ignore($this->id)` menjadi `->ignore($this->route('pasien'))`.

## Bug 9

- Gejala: Menghapus data pasien tidak menghapus data dari database meskipun muncul notifikasi *"Data pasien berhasil dihapus."*
- Lokasi (file:baris): `routes/web.php:17`
- Penyebab: Route hapus pasien menggunakan parameter `/{id}` (`Route::delete('/{id}', 'hapus')`), sedangkan method `PasienController@hapus(Pasien $pasien)` mengharapkan parameter `{pasien}` untuk Route Model Binding. Akibatnya Laravel menginjeksi objek `Pasien` kosong yang belum tersimpan di database.
- Perbaikan: Mengubah definisi route menjadi `Route::delete('/{pasien}', 'hapus')->name('hapus')`.

## Bug 10

- Gejala: Error `405 Method Not Allowed` saat menyimpan perubahan pada halaman Ubah Data Dokter (`/dokter/{dokter}/ubah`).
- Lokasi (file:baris): `resources/views/dokter/form.blade.php:19-20`
- Penyebab: Form ubah dokter menggunakan `method="POST"` ke route `PUT /dokter/{dokter}` tetapi belum menyertakan directive `@method('PUT')` saat `$dokter->exists` bernilai `true`.
- Perbaikan: Menambahkan `@if ($dokter->exists) @method('PUT') @endif` di dalam form dokter.
