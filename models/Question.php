<?php

class Question {
    public function getQuestions() {
        $questions = [
            [
                'id' => 1,
                'text' => 'Saya lebih mudah memahami informasi dalam bentuk gambar atau diagram'
            ],
            [
                'id' => 2,
                'text' => 'Saya lebih mudah membaca buku, catatan, atau materi tertulis sebagai cara belajar utama'
            ],
            [
                'id' => 3,
                'text' => 'Saya lebih tertarik pada video dengan animasi atau ilustrasi visual'
            ],
            [
                'id' => 4,
                'text' => 'Saya memperhatikan detail seperti bentuk, warna, dan tata letak saat membaca atau melihat objek'
            ],
            [
                'id' => 5,
                'text' => 'Saya mengingat sesuatu lebih baik jika melihatnya secara visual'
            ],
            [
                'id' => 6,
                'text' => 'Saya merasa lebih semangat belajar jika catatan saya terlihat bersih, terorganisir, dan berwarna'
            ],
            [
                'id' => 7,
                'text' => 'Saya merasa terbantu dengan adanya tampilan visual saat mengikuti penjelasan'
            ],
            [
                'id' => 8,
                'text' => 'Saya menyukai tampilan presentasi yang menggunakan warna dan gambar'
            ],
            [
                'id' => 9,
                'text' => 'Saat sedang mencatat atau mendengarkan penjelasan, saya sering menggambar atau mencoret-coret sesuatu di kertas'
            ],
            [
                'id' => 10,
                'text' => 'Saya mudah memahami arah atau lokasi dengan melihat peta'
            ],
            [
                'id' => 11,
                'text' => 'Saya lebih mudah mengingat ketika mendengar penjelasan guru'
            ],
            [
                'id' => 12,
                'text' => 'Saya mudah menghafal lirik lagu hanya dengan mendengarnya'
            ],
            [
                'id' => 13,
                'text' => 'Saya senang memperhatikan seseorang yang sedang berbicara'
            ],
            [
                'id' => 14,
                'text' => 'Saya lebih mudah menghafal dengan mengucapkannya secara langsung'
            ],
            [
                'id' => 15,
                'text' => 'Saya sensitif dengan suara bising terutama saat belajar'
            ],
            [
                'id' => 16,
                'text' => 'Saya dapat lebih memahami materi ketika saya menjelaskan materi tersebut ke orang lain'
            ],
            [
                'id' => 17,
                'text' => 'Saya senang berdiskusi secara langsung'
            ],
            [
                'id' => 18,
                'text' => 'Saya lebih paham melakukan sebuah instruksi apabila saya mendengar perintahnya'
            ],
            [
                'id' => 19,
                'text' => 'Ketika menonton video, saya lebih fokus terhadap suara dan dialog'
            ],
            [
                'id' => 20,
                'text' => 'Saya suka membuat irama atau musik ketika menghafal suatu materi'
            ],
            [
                'id' => 21,
                'text' => 'Saya suka menirukan gerakan tokoh saat menonton film'
            ],
            [
                'id' => 22,
                'text' => 'Saya suka memegang benda-benda saat belajar'
            ],
            [
                'id' => 23,
                'text' => 'Saya senang melakukan bongkar pasang atau merakit sesuatu'
            ],
            [
                'id' => 24,
                'text' => 'Saya mudah merasa bosan jika duduk diam dalam waktu yang lama'
            ],
            [
                'id' => 25,
                'text' => 'Saya suka pelajaran yang melibatkan praktek atau membuat sesuatu'
            ],
            [
                'id' => 26,
                'text' => 'Saya sulit memahami pelajaran jika hanya dari buku atau penjelasan'
            ],
            [
                'id' => 27,
                'text' => 'Saya suka bergerak atau berjalan-jalan kecil saat sedang belajar'
            ],
            [
                'id' => 28,
                'text' => 'Saya cenderung menggerakkan tangan saat sedang berbicara atau menjelaskan sesuatu'
            ],
            [
                'id' => 29,
                'text' => 'Saya mudah memahami sesuatu dengan alat bantu nyata atau praktik langsung'
            ],
            [
                'id' => 30,
                'text' => 'Saya mudah terganggu dengan objek yang bergerak'
            ],
        ];
        return $questions;
    }

    public function saveUserAnswers(array $answers) {
        $_SESSION['user_answers'] = $answers;
    }
}

?>