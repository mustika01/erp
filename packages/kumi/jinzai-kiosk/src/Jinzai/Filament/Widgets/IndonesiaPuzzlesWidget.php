<?php

namespace Kumi\Jinzai\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class IndonesiaPuzzlesWidget extends Widget
{
    public string $question;

    public string $answer;

    public int $minutes;

    protected static ?string $pollingInterval = '60s';

    protected array $puzzles = [
        'Sandal apa yang paling enak di dunia? - Sandal Terasi',
        'Kayu, kayu apa yang bisa di makan? - Kayupuk',
        'Kapankah waktu yang tepat untuk membuka pintu? - Saat pintu masih tertutup',
        'Orang apa yang berenang tapi rambutnya tak pernah basah? - Orang botak',
        'Apa bedanya sarung dan kotak? - Kalau sarung itu bisa kotak-kotak kalau kotak tidak bisa sarung-sarung',
        'Hewan apa yang paling panjang? - Ular ngantri beras',
        'Mengapa nyamuk menghisap darah? - Karena tidak punya uang untuk menghisap rokok',
        'Saya ada jeruk lima kamu minta minta satu, sisanya berapa? - Ya tetap lima soalnya kamu nggak dikasih',
        'Kenapa ayam merem kalau berkokok? - Soalnya sudah hafal lirik',
        'Kenapa anak kucing dan anak anjing suka berantem? - Namanya juga anak-anak',
        'Kopi apa yang kalau diminum bikin badan lelah? - Kopi nescapek',
        'Awan yang paling bikin senang - Awanna be with you forever',
        'Hewan apa yang siang makan nasi, malam minum susu? - Belalang, kupu-kupu',
        'Pesawat jatuh, kapal tenggelam, munculnya di mana? - Di koran',
        'Mana yang lebih berat, kapas 100 kg atau besi 100 kg? - Sama aja, sama-sama 100 kg',
        'Sayur apa yang dingin? - Kembang cold',
        'Sayur apa yang pintar nyanyi? - Kolplay',
        'Kamu tuh mirip deh sama bendera, tahu nggak kenapa? - Soalnya bayang-bayangmu selalu berkibar di hati aku',
        'Kamu tahu kenapa Menara Pisa miring? - Karena ketarik sama senyummu',
        'Setan apa yang paling romantis? - Setangkai bunga mawar kupersembahankan untukmu',
        'Mobil apa yang bikin galau? - Mobilang sayang, tapi takut ditolak',
        'Puncak gunung manakah yang tertinggi di Bumi sebelum Everest ditaklukkan? - Everest',
        'Kalau sedang sendiri, kakinya ada empat, kalau berdua, kakinya jadi ada delapan. Siapakah aku? - Kursi',
        'Daun apa yang tidak pernah gugur? - Daun telinga',
        'Kunci apa yang bisa bikin orang joget - Kunci-kunci hota hee',
        'Tahu kamu malam apa yang sangat mengerikan dan menakutkan? - Maklam-pir',
        'Tebak binatang apa yang jago renang? - Bebek. Kalau ikan bukan renang, tapi menyelam',
        'Aku dibeli untuk makanan. Tapi aku pernah dimakan. Apakah aku? - Piring',
        'Ayam apa yang bikin sebel? - Ayamnya habis, tapi nasinya masih banyak',
        'Penyanyi luar negeri yang berfungsi menghangatkan tubuh? - Cardi gan',
        'Kenapa sepion ada dua? - Kalau dua kesepion, kalau satu kesepian',
        'Makanan apa yang bikin bete? - Dikacangin',
        'Ikan, ikan apa yang suka berhenti? - Ikan pause',
        'Makanan apa yang sok tau? - Ah soto lu',
        'Makanan apa yang kelebihan berat badan? - Tahu gembrot',
        'Apa bahasa Jepangnya "Saya dicopet"? - Sakukudiraba Takurasa',
        'Ada ayam lima, di kali dua. Berapa semuanya? - 5 dong. Soalnya yang di kali 2, yang di darat 3',
        'Bila gajah jadi ayam, lalu singa jadi ayam, dan kambing jadi ayam, maka ayam jadi apa? - Ayam jadi banyak dong',
        'Dalam banyak-banyak nasi, nasi apa yang paling susah untuk ditelan? - Nasihat',
        'Selain rumah hantu, rumah apa yang penghuninya tidak betah lama-lam tinggal? - Rumah tahanan',
        'Huruf apa yang paling sering kedinginan? - Huruf "B" karena diapit oleh A dan C (AC)',
        'Hantu apa yang tidak mempunyai gigi? - Burung hantu',
        'Buah apa yang tidak boleh dijual? - Buah hati',
        'Pekerjaan apa yang bisa menyelamatkan nyawa setiap hari? - Memasak',
        'Pacar itu masa depan, mantan itu masa lalu, jomblo itu masa? - Masalah banget',
        'Salon apa yang memiliki banyak janji? - Salon suami (calon suami)',
        'Pekerjaan apakah yang tidak pernah dibayar, tapi selalu dikerjakan? - Pekerjaan Rumah (PR)',
        'Punya halaman, namun tidak punya rumah. Apakah itu? - Buku',
        'Sapi apa yang larinya kenceng dan bisa ngerem? - Sapida motor',
        'Jika gajah bisa bermain gitar maka otomatis akan kelihatan apanya? - Kelihatan bohongnya',
    ];

    protected int|string|array $columnSpan = 2;

    protected static string $view = 'jinzai::filament.widgets.indonesia-puzzles-widget';

    public function mount()
    {
        [$question, $answer] = $this->getPuzzle();

        $this->question = $question;
        $this->answer = $answer;
        $this->minutes = $this->getMinutesLabel();
    }

    public function updateMinutesLabel(): void
    {
        $this->minutes = $this->getMinutesLabel();
    }

    protected function getMinutesLabel(): int
    {
        return Carbon::now()->diffInMinutes(Carbon::now()->endOfHour());
    }

    protected function getHeading(): string
    {
        return __('jinzai::filament/widgets/indonesia-puzzles.title');
    }

    protected function getPuzzle(): array
    {
        $index = floor(Carbon::now()->timestamp / 3600) % count($this->puzzles);
        $puzzle = $this->puzzles[$index];

        return explode(' - ', $puzzle);
    }

    protected function getPollingInterval(): ?string
    {
        return static::$pollingInterval;
    }
}
