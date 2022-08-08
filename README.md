## Username - Password

- administrator => [
    username/email => admin@gmail.com,
    password => password
]

- Kepala Seksi Perhubungan (Kasi Perhub) => [
    username/email => perhub@gmail.com,
    password => password
]

- Kepala Seksi Keuangan (Kasi Ku) => [
    username/email => ku@gmail.com,
    password => password
]

- Kepala Seksi Jasmani (Kasi Jas) => [
    username/email => jas@gmail.com,
    password => password
]

## Database Version
- 10.5.16-MariaDB-cll-lve

## PHP Version
- 8.0.21

## Framework
- Laravel 9.x

## Panduan Menggunakan Aplikasi
1. Login Terlebih dahulu sebagai 'Administrator' atau 'Atasan'/'Kepala Seksi' dengan username dan password yang telah disediakan

2. Seluruh Kegiatan C-R-U-D hanya bisa dilakukan oleh Administrator

3. Atasan/Kepala Seksi hanya bisa melakukan penyetujuan ekspedisi kendaraan

4. Pada menu sidebar "Rangkuman Bulanan", anda dapat melihat seluruh data model grafik yang telah dibuat; antara lain banyaknya kendaraan yang diservis, penggunaan BBM, dan juga jumlah ekspedisi per-Tahun maupun per-Bulan, kemudian juga terdapat 2 tabel yang menunjukan kendaraan dan juga driver yang tersedia/tidak sedang dalam ekspedisi

5. Pada menu sidebar "Data Master", terdapat submenu sebagai berikut:
    a. List Kendaraan => Seluruh jumlah Kendaraan
    b. List Driver => Seluruh jumlah Driver
    c. Kendaraan Tersedia => Kendaraan yang statusnya tersedia/tidak sedang dalam ekspedisi ataupun servis
    d. Kendaraan Diservice => Kendaraan yang sedang dalam perawatan/servis
    e. Kendaraan Pending => kendaraan yang sedang dalam tahap pemesanan dan menunggu persetujuan penanggung jawab

6. Untuk menambahkan Kendaraan :
    1) Login Sebagai Admin
    2) Pergi ke menu Data Master > List Kendaraan > +Tambah Kendaraan > Inputkan Data pada kolom yang disediakan
    3) Tekan Submit

7. Untuk menambahkan driver :
    1) Login Sebagai Admin
    2) pergi ke Menu Data Master > List Driver > +Tambah Driver > Inputkan Data pada kolom yang disediakan
    3) Tekan Submit

8. Untuk mengirim Kendaraan ke bagian servis/perawatan :
    1) Login Sebagai Admin
    2) Pergi ke Menu List Kendaraan
    3) Pada bagian kolom Action, pilih Servis

9. Untuk mengembalikan kendaraan dari bagian servis/perawatan :
    1) Login Sebagai Admin
    2) Pergi ke Menu Kendaraan Diservice
    3) Pilih Kendaraan yang ingin dikembalikan dari bagian service
    4) tekan Selesai yang memiliki Tombol Warna Biru di bagian Row Action

10. Untuk Menghapus Kendaraan :
    1) Login Sebagai Admin
    2) Pegi ke Menu List Kendaraan
    3) Pilih Hapus pada bagian Row Action

11. Untuk merubah status Driver menjadi Cuti :
    1) Login Sebagai Admin
    2) Pergi ke Menu List Driver
    3) Tekan Cuti pada bagian Action
    4) Jika cuti Driver telah selesai, tekan kembali Selesai Cuti

12. Cara mengirim kendaraan ke Ekspedisi :
    1) Login Sebagai Admin
    2) Pergi ke menu Pesan Kendaraan
    3) tekan +Tambah Kendaraan
    4) Isikan Data pada Form yang telah disiapkan
    5) tekan submit
    6) Kendaraan akan dipindahkan ke bagian Pending, menunggu persetujuan Kepala Seksi yang telah ditunjuj/sebagai penanggung jawab ekspedisi

13. Cara Eksport File Excel Riwayat Ekspedisi :
    1) Login sebagai Siapa Saja
    2) Pergi ke Menu Riwayat Kendaraan
    3) Pada Bagian Kanan Atas terdapat tombol Hijau bertuliskan +Export, kemudian tekan

14. Cara menyetujui ekspedisi yang telah dipesan :
    1) Login sebagai Kepala Seksi/Atasan
    2) Pergi ke Menu Data Master > Kendaraan Pending
    3) Perhatikan Nama Penanggungjawab yang ada pada tabel
    4) jika namanya sama/sesuai dengan akun yang sedang login, maka dapat melakukan penyetujuan/penolakan
