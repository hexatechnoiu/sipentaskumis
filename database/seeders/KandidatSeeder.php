<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kandidat_osis =
            [
                [
                    1,
                    'Arga Agung Primana',
                    'Menjadikan OSIS Yang diminati Calon Anggota dan memiliki rasa nyaman bagi anggotanya serta
                    meningkatkan partisipasi siswa dalam kegiatan yang bermanfaat berorganisasi dalam sekolah.',
                    '
                    1. Menjalankan serta menginovasikan Program OSIS yang Sudah Dan Belum terlaksana.
                    2. Membuat Anggota OSIS memiliki Kerja sama yang baik Antar Anggota.
                    3. Mempererat rasa kekeluargaan antar mpk OSIS dan seluruh warga sekolah SMKN 2 Sumedang.
                    4. Membuat siswa SMKN 2 Sumedang lebih peduli dengan lingkungan tempat belajar.
                    ',
                    '1 osis.webp',
                    '“Tuangkan sikapmu dalam tindakan bukan tindakanmu sekedar ucapan”.',
                ],

                [
                    2,
                    'Arga samudra',
                    'Menjadikan OSIS sebagai sarana untuk meningkatkan Kreativitas dan Aspirasi siswa, meningkatkan
                    nilai santun dan mandiri serta ketekunan siswa untuk menciptakan sekolah SMKN 2 Sumedang yang lebih maju.',
                    '
                    1. Menjalankan program yang ada dengan lebih kreatif dengan inovasi yang baru.
                    2. Mendorong kesadaran para siswa terhadap lingkungan sekitar melalui kegiatan sosialisasi dan pelatihan seperti kegiatan “Peduli Lingkungan”.
                    3. Meningkatkan hubungan kerja sama antara MPK dan osis untuk mengoptimalkan program-program yang akan dilaksanakan
                    ',
                    '2 osis.webp',
                    '“Mampu menglahkan dirimu artinya dewasa, mampu mengalahkan orang lain artinya pemenang, tapi mampu memenangkan oranglain artinya pemimpin”.',
                ],
                [
                    3,
                    'Silvia Nur M. P.',
                    'Menjadikan siswa-siswi dan organisasi SMK Negeri 2 Sumedang yang bertakwa, bertanggung jawab, dan peduli terhadap lingkungan.',
                    '
                    1. Meningkatkan rasa ketaqwaan terhadap Tuhan Yang Maha Esa.
                    2. Meningkatkan rasa tanggung jawab dan peduli terhadap sesama.
                    3. Menjalin hubungan yang baik antara MPK dan OSIS agar terciptanya rasa kekeluargaan.
                    4. Melanjutkan program kerja OSIS yang sudah terlaksana dan belum terlaksana.
                    5. Meningkatkan rasa peduli terhadap lingkungan.
                    ',
                    '3 osis.webp',
                    '“Jika orang lain bisa, maka aku harus bisa”.',
                ],
            ];
        foreach ($kandidat_osis as $osis) {
            DB::table('kandidats')->insert([
                'nomor_urut' => $osis[0],
                'name' => $osis[1],
                'photo' => $osis[4],
                'org' => 'OSIS',
                'motto' => $osis[5],
                'visi' => $osis[2],
                'misi' => $osis[3],
            ]);
        }

        $kandidat_mpk =
            [
                [
                    1,
                    'Teguh Winarno',
                    'Membangun organisasi yang lebih profesional dan berahlak mulia sebagai sarana untuk menciptakan ruang akses bagi siswa berkreasi/creative.',
                    '1. Menjalin hubungan baik dengan seluruh komponen sekolah.
                    2. Menjadikan MPK role model bagi warga  sekolah.
                    3. Menciptakan ruang akses internalisasi untuk siswa-siswi SMKN 2 Sumedang.',
                    '1 mpk.webp',
                    '“Prestasi tak dapat di raih tanpa semangat”.',
                    '1. TaSa (Kotak Saran).
                    Tidak hanya di isi saran saja tapi dapat juga di isi dengan cerita-cerita anak-anak SMKN 2 Sumedang yang memang tidak dapat diungkapkan secara langsung, contohnya seperti yang terkena kasus bullying.',
                ],
                [
                    2,
                    'Firman Nashirudin',
                    'Terciptanya MPK SMKN 2 Sumedang yang berintegritas dan berbudi pekerti luhur, sehingga dapat menjadi fasilitator yang baik bagi seluruh siswa dalam menyalurkan aspirasinya.',
                    '1. Memprioritaskan keimanan dan ketaqwaan terhadap Tuhan Yang  Maha Esa yang di dasari oleh etika dan akhlak yang mulia di segala aspek.
                    2. Menjadikan organisasi sebagai ruang aspirasi sehingga dapat menjadi wadah untuk memberi kritik yang membangun.
                    3. Menciptakan organisasi yang aktif dan bersinergisitas serta mewujudkan organisasi yang bersifat transparansi dalam melaksanakan kegiatan.',
                    '2 mpk.webp',
                    '“One solidarity for the perfect one”.',
                    '1. KoAs (Kotak Aspirasi).
                    Salah satu upaya mengaktifkan kembali kotak saran yang berada di beberapa titik di sekolah kita, jika kotak saran sudah tidak bisa di fungsikan maka akan mencari alternatif lain nya seperti kardus yg dibuat menyerupai kotak surat ataupun lainnya, sistematis pemeriksaan isi dari KoAs tersebut 1 bulan sekali, tetapi jika sedang ada acara atau akan menghadapi suatu acara dan kemungkinan besar siswa siswi menyalurkan aspirasi mereka maka kotak aspirasi akan di periksa sesuai dengan situasi dan kondisi.
                    2. Bulan Bahasa.
                    Yang akan di laksanakan 1 tahun sekali pada bulan Oktober yang dimana bulan oktober bertepatan dengan bulan bahasa, dan melihat situasi sekarang yang mengunakan kurikulum merdeka maka peringatan bulan bahasa ini bisa di barengkan dengan panen karya P5, di bulan bahasa ini akan banyak perlombaan ataupun pentas seni sastra di antara nya puisi, pantun, monolog, dongeng, dan lain-lain sebagainya.',
                ],
            ];
        foreach ($kandidat_mpk as $mpk) {
            DB::table('kandidats')->insert([
                'nomor_urut' => $mpk[0],
                'name' => $mpk[1],
                'photo' => $mpk[4],
                'org' => 'MPK',
                'motto' => $mpk[5],
                'visi' => $mpk[2],
                'misi' => $mpk[3],
            ]);
        }
    }
}
