# INTAI

INTAI adalah alat pendeteksi penebang liar yang dirancang untuk membantu dalam memantau dan melacak aktivitas penebangan liar di daerah-daerah yang rawan. Alat ini menggunakan modul sensor suara MAX4466, ESP32, dan LoRa SX1278 sebagai komponen utamanya. Berikut adalah deskripsi tentang masing-masing komponen:

## Modul Sensor Suara MAX4466

Modul sensor MAX4466 adalah sensor suara yang dapat mendeteksi suara berfrekuensi rendah hingga sedang. Sensor ini mampu menangkap suara yang dihasilkan oleh mesin-mesin penebang atau gerakan manusia di sekitar lokasi yang dipantau.

## ESP32

ESP32 adalah sebuah mikrokontroler yang dilengkapi dengan Wi-Fi dan Bluetooth. Mikrokontroler ini digunakan sebagai pengontrol utama dari alat pendeteksi penebang liar. ESP32 digunakan untuk mengambil data dari modul sensor MAX4466 dan mengirimkannya ke gateway menggunakan modul LoRa SX1278.

## LoRa SX1278

LoRa SX1278 adalah modul transceiver radio yang menggunakan teknologi LoRa untuk mengirimkan data. LoRa memungkinkan transmisi data dalam jarak yang jauh dengan konsumsi daya yang rendah. Modul ini digunakan untuk mengirimkan data dari alat pendeteksi penebang liar ke gateway di jarak yang cukup jauh.

## Cara Kerja Alat

Alat pendeteksi penebang liar akan terus menerus mengambil data dari modul sensor MAX4466. Data ini akan diproses oleh mikrokontroler ESP32 dan kemudian dikirimkan ke gateway menggunakan modul LoRa SX1278. Gateway akan menerima data dari beberapa alat pendeteksi penebang liar yang terhubung pada jaringan LoRa dan akan mengirimkan data tersebut ke server pusat untuk dianalisis lebih lanjut.

## Keuntungan Alat

Alat pendeteksi penebang liar ini memiliki beberapa keuntungan, di antaranya:

- Dapat memantau aktivitas penebangan liar secara terus menerus di daerah-daerah yang rawan.
- Menggunakan teknologi LoRa yang memungkinkan transmisi data dalam jarak yang jauh dengan konsumsi daya yang rendah.
- Dapat dihubungkan dengan banyak alat pendeteksi penebang liar lainnya pada satu jaringan LoRa.
- Data yang dikumpulkan oleh alat dapat digunakan untuk mencegah aktivitas penebangan liar di masa depan.
