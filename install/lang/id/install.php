<?php

//

/**
 * Automatically generated strings for Moodle installer
 *
 * Do not edit this file manually! It contains just a subset of strings
 * needed during the very first steps of installation. This file was
 * generated automatically by export-installer.php (which is part of AMOS
 * {@link http://docs.moodle.org/dev/Languages/AMOS}) using the
 * list of strings defined in /install/stringnames.txt.
 *
 * @package   installer
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['admindirname'] = 'Direktori admin';
$string['availablelangs'] = 'Paket bahasa yang tersedia';
$string['chooselanguagehead'] = 'Pilih bahasa';
$string['chooselanguagesub'] = 'Silakan pilih bahasa untuk instalasi. Bahasa ini juga akan digunakan sebagai bahasa default untuk situs, meskipun mungkin akan diubah kemudian.';
$string['clialreadyconfigured'] = 'Berkas konfigurasi config.php sudah ada. Silakan gunakan admin /cli/install_database.php untuk menginstal Moodle untuk situs ini.';
$string['clialreadyinstalled'] = 'File konfigurasi config.php sudah ada. Silakan gunakan admin/cli/install_database.php untuk menginstal Moodle untuk situs ini.';
$string['cliinstallheader'] = 'Program pemasangan baris perintah Moodle {$a}';
$string['databasehost'] = 'Host basis data';
$string['databasename'] = 'Nama basis data';
$string['databasetypehead'] = 'Pilih pengandar basis data';
$string['dataroot'] = 'Direktori data';
$string['datarootpermission'] = 'Izin direktori data';
$string['dbprefix'] = 'Prefiks tabel';
$string['dirroot'] = 'Direktori Moodle';
$string['environmenthead'] = 'Memeriksa sistem Anda ...';
$string['environmentsub2'] = 'Setiap rilis Moodle memiliki beberapa persyaratan versi PHP minimum dan sejumlah ekstensi PHP wajib. Pemeriksaan komponen sistem akan dilakukan sebelum pemasangan dan peningkatan versi. Silakan hubungi administrator peladen jika Anda tidak tahu cara mamasang versi baru atau mengaktifkan ekstensi PHP.';
$string['errorsinenvironment'] = 'Pemeriksaan sistem gagal!';
$string['installation'] = 'Instalasi';
$string['langdownloaderror'] = 'Sayangnya bahasa "{$a}" tidak dapat diunduh. Proses instalasi akan dilanjutkan dalam bahasa Inggris.';
$string['memorylimithelp'] = '<p> Batas memori PHP untuk server Anda saat ini diatur ke {$a}. </p> <p> Ini dapat menyebabkan Moodle memiliki masalah memori di kemudian hari, terutama jika Anda memiliki banyak modul yang diaktifkan dan/atau banyak pengguna. </p> <p> Kami menyarankan Anda mengkonfigurasi PHP dengan batas yang lebih tinggi jika memungkinkan, seperti 40M. Ada beberapa cara untuk melakukan ini yang dapat Anda coba: </p>
<ol> <li> Jika Anda bisa, kompilasi ulang PHP dengan <i> --enable-memory-limit </i>. Ini memungkinkan Moodle untuk mengatur batas memori itu sendiri. </li>
 <li> Jika Anda memiliki akses ke file php.ini, Anda dapat mengubah pengaturan <b> memory_limit </b> di sana menjadi sekitar 40M. Jika Anda tidak memiliki akses, Anda mungkin dapat meminta administrator untuk melakukan ini untuk Anda. </li>
<li> Pada beberapa server PHP, Anda dapat membuat file .htaccess di direktori Moodle yang berisi baris ini: <blockquote> <div> php_value memory_limit 40M </div> </blockquote> <p> Namun, pada beberapa server ini tidak diizinkan <b> semua </b> halaman PHP tidak berfungsi (Anda akan melihat kesalahan ketika Anda melihat halaman) sehingga Anda Anda harus menghapus file .htaccess. </p> </li> </ol>';
$string['paths'] = 'Jalur';
$string['pathserrcreatedataroot'] = 'Direktori data ({$a->dataroot}) tidak dapat dibuat  oleh installer.';
$string['pathshead'] = 'Konfirmasi jalur';
$string['pathsrodataroot'] = 'Direktori data root tidak dapat ditulisi.';
$string['pathsroparentdataroot'] = 'Direktori induk ({$a->parent}) tidak dapat ditulisi. Direktori data ({$a->dataroot}) tidak dapat dibuat oleh installer.';
$string['pathssubadmindir'] = 'Beberapa hosting menggunakan / admin sebagai URL khusus untuk Anda mengakses panel kontrol atau sesuatu. Sayangnya ini bertentangan dengan lokasi standar untuk halaman admin Moodle. Anda dapat memperbaikinya dengan mengganti nama direktori admin di instalasi Anda, dan meletakkan nama baru itu di sini. Misalnya: <em> moodleadmin </em>. Ini akan memperbaiki tautan admin di Moodle.';
$string['pathssubdataroot'] = '<p> Direktori tempat Moodle akan menyimpan semua konten file yang diunggah oleh pengguna. </p> <p> Direktori ini harus dapat dibaca dan ditulis oleh pengguna server web (biasanya \'www-data\', \'nobody\', atau \' apache \'). </p> <p> Itu tidak boleh diakses secara langsung melalui web. </p> <p> Jika direktori saat ini tidak ada, proses instalasi akan berusaha membuatnya. </p>';
$string['pathssubdirroot'] = '<p> Jalur lengkap ke direktori yang berisi kode Moodle. </p>';
$string['pathssubwwwroot'] = '<p> Alamat lengkap tempat Moodle akan diakses yaitu alamat yang akan dimasukkan pengguna ke bilah alamat peramban mereka untuk mengakses Moodle. </p> <p> Tidak mungkin mengakses Moodle menggunakan banyak alamat. Jika situs Anda dapat diakses melalui beberapa alamat, maka pilih yang termudah dan buat pengalihan permanen untuk masing-masing alamat lainnya. </p> <p> Jika situs Anda dapat diakses baik dari Internet, dan dari jaringan internal (kadang-kadang disebut Intranet), lalu gunakan alamat publik di sini. </p> <p> Jika alamat saat ini tidak benar, silakan ubah URL di bilah alamat peramban Anda dan mulai kembali instalasi. </p>';
$string['pathsunsecuredataroot'] = 'Lokasi dataroot tidak aman';
$string['pathswrongadmindir'] = 'Direktori admin tidak ada';
$string['phpextension'] = 'Ekstensi PHP {$a}';
$string['phpversion'] = 'Versi PHP';
$string['phpversionhelp'] = '<p> Moodle membutuhkan versi PHP setidaknya 5.6.5 atau 7.1 (7.0.x memiliki beberapa keterbatasan mesin). </p> <p> Anda saat ini menjalankan versi {$a}. </p> <p> Anda harus meningkatkan versi PHP atau pindah ke host dengan versi PHP yang lebih baru. </p>';
$string['welcomep10'] = '{$a->installername} ({$a->installerversion})';
$string['welcomep20'] = 'Anda melihat halaman ini karena Anda telah berhasil memasang dan meluncurkan paket <strong> {$a->packname} {$a->packversion}</strong> di komputer Anda. Selamat!';
$string['welcomep30'] = 'Rilis <strong> {$a->installername}</strong> ini mencakup aplikasi untuk menciptakan lingkungan tempat <strong> Moodle </strong> yang akan digunakan, yaitu:';
$string['welcomep40'] = 'Paket juga termasuk <strong>Moodle {$a->moodlerelease} ({$a->moodleversion})</strong>.';
$string['welcomep50'] = 'Penggunaan semua aplikasi dalam paket ini diatur oleh lisensi masing-masing. Paket <strong>{$a->installername}</strong> lengkap adalah <a href="http://www.opensource.org/docs/definition_plain.html"> sumber terbuka </a> dan didistribusikan di bawah lisensi <a href="http://www.gnu.org/copyleft/gpl.html"> GPL </a>.';
$string['welcomep60'] = 'Halaman-halaman berikut akan menuntun Anda melalui beberapa langkah yang mudah diikuti untuk mengonfigurasi dan menyiapkan <strong> Moodle </strong> di komputer Anda. Anda dapat menerima pengaturan bawaan atau, secara opsional, mengubahnya sesuai dengan kebutuhan Anda.';
$string['welcomep70'] = 'Klik tombol "Selanjutnya" di bawah untuk melanjutkan dengan penyiapan <strong> Moodle </strong>.';
$string['wwwroot'] = 'Alamat web';
