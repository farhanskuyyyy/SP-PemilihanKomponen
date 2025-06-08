<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Expert - Sistem Pakar Komponen Komputer</title>
    @vite(['resources/css/landing.css', 'resources/js/landing.js'])
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#home">
                <i class="bi bi-cpu me-2"></i>PC Expert
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">How It Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#benefits">Benefits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </a>
                    <a class="btn btn-outline-light ms-2" href="{{ route('register') }}">
                        <i class="bi bi-person-plus me-1"></i>Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-background">
            <div class="container">
                <div class="row align-items-center min-vh-100">
                    <div class="col-lg-6">
                        <div class="hero-content">
                            <h1 class="hero-title">
                                Sistem Pakar Komponen Komputer
                            </h1>
                            <p class="hero-subtitle">
                                Dapatkan rekomendasi komponen PC terbaik dengan teknologi artificial intelligence.
                                Bangun PC impian Anda dengan panduan ahli yang tepat.
                            </p>
                            <div class="hero-buttons">
                                <a href="#features" class="btn btn-primary btn-lg me-3">
                                    <i class="bi bi-rocket-takeoff me-2"></i>Mulai Sekarang
                                </a>
                                <a href="#how-it-works" class="btn btn-outline-primary btn-lg">
                                    <i class="bi bi-play-circle me-2"></i>Lihat Demo
                                </a>
                            </div>
                            <div class="hero-stats mt-5">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h3 class="stat-number">1000+</h3>
                                            <p class="stat-label">Komponen</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h3 class="stat-number">500+</h3>
                                            <p class="stat-label">Pengguna</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h3 class="stat-number">98%</h3>
                                            <p class="stat-label">Akurasi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-image">
                            <div class="pc-illustration">
                                <div class="component-card floating" style="--delay: 0s;">
                                    <i class="bi bi-cpu"></i>
                                    <span>Processor</span>
                                </div>
                                <div class="component-card floating" style="--delay: 0.5s;">
                                    <i class="bi bi-memory"></i>
                                    <span>RAM</span>
                                </div>
                                <div class="component-card floating" style="--delay: 1s;">
                                    <i class="bi bi-device-hdd"></i>
                                    <span>Storage</span>
                                </div>
                                <div class="component-card floating" style="--delay: 1.5s;">
                                    <i class="bi bi-gpu-card"></i>
                                    <span>VGA</span>
                                </div>
                                <div class="component-card floating" style="--delay: 2s;">
                                    <i class="bi bi-motherboard"></i>
                                    <span>Motherboard</span>
                                </div>
                                <div class="component-card floating" style="--delay: 2.5s;">
                                    <i class="bi bi-power"></i>
                                    <span>PSU</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="section-title">Fitur Unggulan</h2>
                    <p class="section-subtitle">
                        Teknologi canggih untuk membantu Anda memilih komponen PC yang tepat
                    </p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-robot"></i>
                        </div>
                        <h4>AI-Powered Recommendations</h4>
                        <p>Sistem pakar dengan teknologi AI yang memberikan rekomendasi komponen berdasarkan kebutuhan
                            dan budget Anda.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Kompatibilitas Terjamin</h4>
                        <p>Pastikan semua komponen yang dipilih kompatibel satu sama lain untuk performa optimal.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4>Analisis Performa</h4>
                        <p>Dapatkan prediksi performa PC Anda untuk berbagai kebutuhan seperti gaming, editing, atau
                            office work.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <h4>Budget Optimizer</h4>
                        <p>Optimalisasi budget dengan rekomendasi komponen terbaik sesuai dengan anggaran yang Anda
                            miliki.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h4>Real-time Updates</h4>
                        <p>Database komponen yang selalu update dengan harga dan spesifikasi terbaru dari berbagai
                            vendor.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4>Expert Support</h4>
                        <p>Dukungan dari para ahli komputer untuk membantu Anda membuat keputusan yang tepat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="how-it-works-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="section-title">Cara Kerja Sistem</h2>
                    <p class="section-subtitle">
                        Proses sederhana untuk mendapatkan rekomendasi PC terbaik
                    </p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <h5>Input Kebutuhan</h5>
                        <p>Masukkan kebutuhan penggunaan PC Anda (gaming, office, editing, dll) dan budget yang
                            tersedia.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <h5>AI Processing</h5>
                        <p>Sistem AI menganalisis kebutuhan Anda dan mencocokkan dengan database komponen terbaru.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <h5>Rekomendasi</h5>
                        <p>Dapatkan daftar komponen yang direkomendasikan lengkap dengan spesifikasi dan harga.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <div class="step-icon">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <h5>Build PC</h5>
                        <p>Gunakan rekomendasi untuk membeli komponen dan rakit PC impian Anda dengan confidence.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="benefits-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="benefits-content">
                        <h2 class="section-title">Mengapa Memilih PC Expert?</h2>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="benefit-text">
                                <h5>Hemat Waktu & Tenaga</h5>
                                <p>Tidak perlu riset berhari-hari, dapatkan rekomendasi dalam hitungan menit.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="benefit-text">
                                <h5>Akurasi Tinggi</h5>
                                <p>Sistem yang telah teruji dengan tingkat akurasi 98% dalam memberikan rekomendasi.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="benefit-text">
                                <h5>Budget Friendly</h5>
                                <p>Optimalisasi budget untuk mendapatkan performa terbaik sesuai anggaran Anda.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="benefit-text">
                                <h5>Support 24/7</h5>
                                <p>Tim support yang siap membantu Anda kapan saja jika mengalami kesulitan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="benefits-image">
                        <div class="pc-build-visualization">
                            <div class="pc-case">
                                <div class="component-slot processor">
                                    <i class="bi bi-cpu"></i>
                                </div>
                                <div class="component-slot ram">
                                    <i class="bi bi-memory"></i>
                                </div>
                                <div class="component-slot gpu">
                                    <i class="bi bi-gpu-card"></i>
                                </div>
                                <div class="component-slot storage">
                                    <i class="bi bi-device-hdd"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Siap Membangun PC Impian Anda?</h2>
                    <p class="lead mb-4">
                        Bergabunglah dengan ribuan pengguna yang telah mempercayai PC Expert untuk membangun PC terbaik
                        mereka.
                    </p>
                    <div class="cta-buttons">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg me-3">
                            <i class="bi bi-person-plus me-2"></i>Daftar Gratis
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer-section bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-brand">
                        <h4><i class="bi bi-cpu me-2"></i>PC Expert</h4>
                        <p>Sistem pakar terpercaya untuk rekomendasi komponen komputer terbaik sesuai kebutuhan dan
                            budget Anda.</p>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h6>Produk</h6>
                    <ul class="footer-links">
                        <li><a href="#">Rekomendasi PC</a></li>
                        <li><a href="#">Analisis Kompatibilitas</a></li>
                        <li><a href="#">Budget Calculator</a></li>
                        <li><a href="#">Performance Test</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6>Dukungan</h6>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Tutorial</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact Support</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6>Perusahaan</h6>
                    <ul class="footer-links">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Tim</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6>Legal</h6>
                    <ul class="footer-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">Disclaimer</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 PC Expert. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Made with <i class="bi bi-heart-fill text-danger"></i> for PC enthusiasts</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop">
        <i class="bi bi-arrow-up"></i>
    </button>
</body>

</html>
