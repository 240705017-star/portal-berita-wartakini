<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name'  => 'Redaksi WartaKini',
            'email' => 'praktikan@example.com',
        ]);

        $articles = [
            [
                'title' => 'Ekspansi Kawasan Bisnis Terpadu Dorong Pertumbuhan Ekonomi Perkotaan di Akhir Tahun',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1000&q=80',
                'body'  => "Pembangunan kawasan pusat bisnis terpadu di sejumlah kota besar menunjukkan tren akselerasi positif menjelang penutupan tahun ini. Tingkat okupansi perkantoran modern tercatat meningkat seiring kembalinya aktivitas korporasi dan ekspansi perusahaan sektor jasa.\n\nPengamat ekonomi menilai integrasi antara area perkantoran, transportasi publik, dan ruang terbuka hijau menjadi faktor utama yang menarik minat investor domestik maupun mancanegara.\n\nPemerintah daerah juga terus menyederhanakan perizinan digital guna memastikan iklim investasi tetap kompetitif serta membuka lapangan kerja baru bagi masyarakat perkotaan.",
            ],
            [
                'title' => 'Industri Semikonduktor dan Kecerdasan Buatan Jadi Fokus Utama Transformasi Digital Nasional',
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1000&q=80',
                'body'  => "Kebutuhan perangkat keras berbasis kecerdasan buatan (AI) dan komputasi awan mendorong percepatan pengembangan ekosistem teknologi di dalam negeri. Sejumlah pusat riset dan perguruan tinggi mulai memperluas kolaborasi dengan industri manufaktur elektronik.\n\nLangkah ini difokuskan pada penguatan rantai pasok komponen digital serta peningkatan kompetensi talenta muda di bidang rekayasa perangkat keras dan sistem tertanam.\n\nDengan dukungan infrastruktur pusat data yang kian merata, adopsi teknologi pintar diproyeksikan mampu meningkatkan efisiensi sektor industri hingga 30 persen dalam lima tahun mendatang.",
            ],
            [
                'title' => 'Transformasi Media Cetak ke Jurnalisme Digital Meningkatkan Minat Baca Generasi Muda',
                'image' => 'https://images.unsplash.com/photo-1495020689067-958852a7765e?auto=format&fit=crop&w=1000&q=80',
                'body'  => "Perubahan pola konsumsi informasi masyarakat mendorong berbagai perusahaan media untuk berinovasi dalam menyajikan berita yang cepat, akurat, dan mudah diakses lintas perangkat.\n\nFormat liputan mendalam yang dipadukan dengan visualisasi data interaktif terbukti mampu menarik perhatian pembaca muda yang sebelumnya cenderung menghindari berita panjang.\n\nMeski format penyajian terus berkembang, standar verifikasi fakta dan kode etik jurnalistik tetap menjadi fondasi utama untuk menjaga kepercayaan publik di tengah derasnya arus informasi media sosial.",
            ],
            [
                'title' => 'Stabilitas Nilai Tukar dan Penguatan Sektor Riil Jaga Daya Beli Masyarakat',
                'image' => 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=1000&q=80',
                'body'  => "Kebijakan moneter yang terukur serta terjaganya pasokan bahan pokok di pasar domestik berhasil mempertahankan stabilitas inflasi sepanjang kuartal berjalan.\n\nPelaku usaha mikro, kecil, dan menengah (UMKM) turut merasakan dampak positif dari kemudahan akses pembiayaan digital yang mempercepat perputaran modal usaha di tingkat daerah.\n\nBank sentral bersama otoritas fiskal berkomitmen terus menjaga sinergi kebijakan agar momentum pertumbuhan ekonomi nasional tetap tangguh menghadapi dinamika pasar global.",
            ],
            [
                'title' => 'Ruang Redaksi Modern Mulai Terapkan Analisis Data untuk Pemetaan Isu Publik',
                'image' => 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?auto=format&fit=crop&w=1000&q=80',
                'body'  => "Pemanfaatan perangkat analitik data kini menjadi bagian tak terpisahkan dari proses kerja jurnalistik modern. Melalui pemetaan tren pencarian dan kebutuhan pembaca, tim redaksi dapat menyusun liputan yang lebih relevan dengan persoalan sehari-hari masyarakat.\n\nTeknologi ini juga membantu jurnalis mengolah dokumen publik berskala besar secara lebih cepat sebelum dilakukan wawancara lapangan dan konfirmasi narasumber.\n\nPara pemimpin redaksi menekankan bahwa teknologi berperan sebagai alat bantu riset, sementara kedalaman analisis dan empati tetap bertumpu pada kepekaan jurnalis di lapangan.",
            ],
            [
                'title' => 'Ekosistem Literasi dan Surat Kabar Kampus Kembali Hidup lewat Kolaborasi Komunitas',
                'image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1000&q=80',
                'body'  => "Berbagai komunitas literasi dan pers mahasiswa di sejumlah kota kembali menghidupkan tradisi penerbitan buletin serta portal berita independen sebagai ruang diskusi publik yang sehat.\n\nKegiatan pelatihan penulisan feature, fotografi jurnalistik, hingga manajemen redaksi rutin digelar untuk membekali penulis muda dengan keterampilan komunikasi yang bertanggung jawab.\n\nInisiatif ini diharapkan mampu melahirkan generasi jurnalis dan penulis muda yang kritis, objektif, serta peka terhadap isu-isu sosial di lingkungan sekitarnya.",
            ],
        ];

        foreach ($articles as $index => $item) {
            Article::create([
                'user_id'    => $user->id,
                'title'      => $item['title'],
                'slug'       => Str::slug($item['title']) . '-' . Str::lower(Str::random(5)),
                'body'       => $item['body'],
                'image'      => $item['image'],
                'created_at' => now()->subHours(($index + 1) * 3),
                'updated_at' => now()->subHours(($index + 1) * 3),
            ]);
        }
    }
}