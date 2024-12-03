@extends('auth.component.app')

@section('content')
    <div class="body-wrapper">
        <div class="container mt-5 pt-5">
            <h1 class="text-center mb-4">FAQ - Program Magang</h1>

            <div class="accordion" id="faqAccordion">

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Apa itu program magang?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Program magang adalah kesempatan bagi mahasiswa atau siswa untuk bekerja di perusahaan atau
                            organisasi guna memperoleh pengalaman praktis di bidang yang relevan dengan studi mereka.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Siapa yang dapat mengikuti program magang?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Program magang terbuka untuk mahasiswa atau siswa yang sedang menempuh pendidikan dan ingin
                            memperoleh pengalaman kerja langsung di industri atau bidang yang mereka minati.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Apa saja jenis magang yang tersedia?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Terdapat beberapa jenis magang, di antaranya: Magang Umum, PKL (Praktik Kerja Lapangan), dan
                            Prakerin (Praktek Kerja Industri).
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Bagaimana cara mendaftar untuk program magang?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Untuk mendaftar, kamu perlu mengunjungi situs kami, memilih program magang yang sesuai dengan
                            minat dan keahlian, dan mengisi formulir pendaftaran secara online.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Apakah ada sertifikat setelah magang selesai?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Ya, setelah menyelesaikan program magang, peserta akan mendapatkan sertifikat yang menyatakan
                            bahwa mereka telah mengikuti dan menyelesaikan program magang sesuai dengan ketentuan yang
                            berlaku.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
