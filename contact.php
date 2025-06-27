<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inisialisasi variabel form
$name = $email = $subject = $message = '';
$error = '';
$success = '';

// Proses form jika ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    
    // Validasi
    if (empty($name) || empty($email) || empty($message)) {
        $error = "Harap isi semua field yang wajib diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } else {
        $success = "Pesan Anda telah terkirim! Terima kasih telah menghubungi saya.";
        // Reset nilai form setelah berhasil dikirim
        $name = $email = $subject = $message = '';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kontak | Defrima Fitriyani</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #001f3f;
            --secondary: #d4af37;
            --accent: #ff6b6b;
            --white: #ffffff;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #e9ecef;
            --dark-blue: #000d1a;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.7;
            padding-top: 80px;
        }
        
        /* Header & Navigation */
        header {
            background-color: var(--primary);
            color: var(--white);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--white);
            text-decoration: none;
        }
        
        .logo span {
            color: var(--secondary);
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 30px;
            position: relative;
        }
        
        nav ul li a {
            color: var(--white);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s;
            padding: 5px 0;
        }
        
        nav ul li a:hover {
            color: var(--secondary);
        }
        
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: var(--secondary);
            bottom: 0;
            left: 0;
            transition: width 0.3s;
        }
        
        nav ul li a:hover::after {
            width: 100%;
        }
        
        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: var(--primary);
            text-align: center;
            margin-bottom: 60px;
            position: relative;
            font-weight: 600;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary), var(--accent));
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        
        /* Grid Kontak */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            margin-bottom: 80px;
        }
        
        /* Card Kontak */
        .contact-card {
            background: var(--white);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            border-left: 5px solid var(--secondary);
        }
        
        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }
        
        .contact-card h3 {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            margin-bottom: 30px;
            font-size: 1.8rem;
            position: relative;
            padding-bottom: 15px;
        }
        
        .contact-card h3::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background: var(--secondary);
            bottom: 0;
            left: 0;
        }
        
        /* Item Kontak */
        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            transition: all 0.3s;
        }
        
        .contact-item:hover {
            transform: translateX(10px);
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: var(--white);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 20px;
            transition: all 0.4s;
        }
        
        .contact-item:hover .contact-icon {
            background: var(--accent);
            transform: rotate(10deg) scale(1.1);
        }
        
        .contact-text h4 {
            font-size: 1.2rem;
            color: var(--primary);
            margin-bottom: 8px;
            font-weight: 600;
        }
        
        .contact-text a, .contact-text p {
            color: var(--dark);
            transition: color 0.3s;
            text-decoration: none;
        }
        
        .contact-text a:hover {
            color: var(--accent);
            text-decoration: underline;
        }
        
        /* Formulir */
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: var(--primary);
            font-size: 1.1rem;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--gray);
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
            font-size: 1rem;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--secondary);
            outline: none;
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.2);
        }
        
        .form-group textarea {
            min-height: 180px;
            resize: vertical;
        }
        
        .btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(0, 31, 63, 0.2);
        }
        
        .btn:hover {
            background: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
        }
        
        /* Notifikasi */
        .alert {
            padding: 18px 20px;
            margin-bottom: 30px;
            border-radius: 8px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 1.05rem;
        }
        
        .alert i {
            font-size: 1.5rem;
        }
        
        .alert-success {
            background: #e8f8ef;
            color: #0a5c36;
            border-left: 5px solid #0a5c36;
        }
        
        .alert-error {
            background: #ffebee;
            color: #c62828;
            border-left: 5px solid #c62828;
        }
        
        /* Layanan */
        .services {
            background: var(--white);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 60px;
            border-left: 5px solid var(--accent);
        }
        
        .services h3 {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            margin-bottom: 30px;
            font-size: 2rem;
            position: relative;
            padding-bottom: 15px;
        }
        
        .services h3::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 4px;
            background: var(--accent);
            bottom: 0;
            left: 0;
        }
        
        .service-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .service-card {
            background: var(--light);
            padding: 25px;
            border-radius: 12px;
            transition: all 0.3s;
            border-top: 3px solid var(--secondary);
            display: flex;
            flex-direction: column;
        }
        
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .service-icon {
            width: 60px;
            height: 60px;
            background: var(--primary);
            color: var(--white);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 24px;
            transition: all 0.3s;
        }
        
        .service-card:hover .service-icon {
            background: var(--accent);
            transform: rotate(15deg);
        }
        
        .service-card h4 {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .service-card p {
            color: var(--dark);
            margin-bottom: 15px;
            flex-grow: 1;
        }
        
        .service-price {
            font-weight: 700;
            color: var(--accent);
            font-size: 1.2rem;
            margin-top: auto;
        }
        
        /* Animasi */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .floating {
            animation: float 4s ease-in-out infinite;
        }
        
        /* Footer */
        footer {
            background: var(--primary);
            color: var(--white);
            padding: 50px 0 20px;
            text-align: center;
        }
        
        .footer-content {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .footer-logo {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            text-decoration: none;
            color: var(--white);
            display: inline-block;
        }
        
        .footer-logo span {
            color: var(--secondary);
        }
        
        .footer-text {
            margin-bottom: 30px;
            line-height: 1.8;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            background: var(--white);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .social-links a:hover {
            background: var(--secondary);
            color: var(--white);
            transform: translateY(-5px);
        }
        
        .copyright {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }
        
        /* Menu Mobile */
        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 24px;
            color: var(--white);
        }
        
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            
            nav ul {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background: var(--primary);
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                padding-top: 30px;
                transition: left 0.3s ease;
                z-index: 999;
            }
            
            nav ul.active {
                left: 0;
            }
            
            nav ul li {
                margin: 15px 0;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
            
            .contact-card, .services {
                padding: 30px;
            }
            
            .service-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="logo">Defrima <span>Fitriyani</span></a>
            <div class="menu-toggle" id="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
           <ul id="nav-menu">
                <li><a href="index.php#home">Home</a></li>
                <li><a href="index.php#skills">Skills</a></li>
                <li><a href="index.php#projects">Projects</a></li>
                <li><a href="index.php#education">Education</a></li>
                <li><a href="index.php#experience">Experience</a></li>
                <li><a href="index.php#organization">Organization</a></li>
                <li><a href="artikel_detail.php">Artikel</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1 class="section-title">Hubungi Saya</h1>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?= $error ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= $success ?>
            </div>
        <?php endif; ?>
        
        <div class="contact-grid">
            <div class="contact-card floating">
                <h3>Informasi Kontak</h3>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-text">
                        <h4>Email</h4>
                        <a href="mailto:22001020040@student.umrah.ac.id">22001020040@student.umrah.ac.id</a>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-text">
                        <h4>Telepon/WhatsApp</h4>
                        <a href="https://wa.me/6283198247871">0831-9824-7871</a>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="contact-text">
                        <h4>Instagram</h4>
                        <a href="https://instagram.com/defrimafitriyani" target="_blank">@defrimafitriyani</a>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </div>
                    <div class="contact-text">
                        <h4>LinkedIn</h4>
                        <a href="https://linkedin.com/in/defrima-fitriyani" target="_blank">Defrima Fitriyani</a>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fab fa-github"></i>
                    </div>
                    <div class="contact-text">
                        <h4>GitHub</h4>
                        <a href="https://github.com/defrimafitriyani" target="_blank">defrimafitriyani</a>
                    </div>
                </div>
            </div>
            
            <div class="contact-card">
                <h3>Kirim Pesan</h3>
                <form action="contact.php" method="POST" id="contactForm">
                    <div class="form-group">
                        <label for="name">Nama Lengkap *</label>
                        <input type="text" id="name" name="name" required value="<?= htmlspecialchars($name) ?>" placeholder="Masukkan nama lengkap Anda">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required value="<?= htmlspecialchars($email) ?>" placeholder="Masukkan alamat email Anda">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subjek</label>
                        <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($subject) ?>" placeholder="Subjek pesan Anda">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Pesan *</label>
                        <textarea id="message" name="message" required placeholder="Tulis pesan Anda disini..."><?= htmlspecialchars($message) ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
        
        <div class="services">
            <h3>Layanan Profesional</h3>
            <div class="service-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h4>Web Development</h4>
                    <p>Pembuatan website custom (hingga 5 halaman) dengan desain responsif dan modern.</p>
                    <div class="service-price">Rp 1.5JT - 3JT</div>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h4>Analisis Data</h4>
                    <p>Pengolahan dan visualisasi data (hingga 10.000 baris) dengan insight yang bermanfaat.</p>
                    <div class="service-price">Rp 1JT - 2.5JT</div>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h4>Desain UI/UX</h4>
                    <p>Desain antarmuka aplikasi/website (5-10 layar) yang user-friendly dan estetik.</p>
                    <div class="service-price">Rp 800RB - 2JT</div>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-microphone"></i>
                    </div>
                    <h4>Host Acara</h4>
                    <p>MC untuk acara formal/semi-formal (maksimal 4 jam) dengan penampilan profesional.</p>
                    <div class="service-price">Rp 100RB - 500RB</div>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4>Pengembangan Aplikasi Mobile</h4>
                    <p>Pembuatan aplikasi mobile sederhana untuk platform Android dan iOS.</p>
                    <div class="service-price">Rp 2.5JT - 5JT</div>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4>Konsultasi Teknologi</h4>
                    <p>Sesi konsultasi 1-on-1 untuk solusi teknologi dan digital transformasi bisnis.</p>
                    <div class="service-price">Rp 300RB/jam</div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <a href="index.php" class="footer-logo">Defrima <span>Fitriyani</span></a>
            <p class="footer-text">Mahasiswa Teknik Informatika yang passionate tentang pengembangan web, analisis data, dan teknologi untuk solusi sosial.</p>
            <div class="social-links">
                <a href="https://instagram.com/defrimafitriyani" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://linkedin.com/in/defrima-fitriyani" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://github.com/defrimafitriyani" target="_blank"><i class="fab fa-github"></i></a>
                <a href="https://wa.me/6283198247871" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="mailto:22001020040@student.umrah.ac.id"><i class="fas fa-envelope"></i></a>
            </div>
            <p class="copyright">&copy; <?= date('Y') ?> Defrima Fitriyani. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Toggle menu mobile
        document.getElementById('mobile-menu').addEventListener('click', function() {
            document.getElementById('nav-menu').classList.toggle('active');
        });
        
        // Tutup menu saat item diklik (untuk mobile)
        const navItems = document.querySelectorAll('#nav-menu li a');
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                document.getElementById('nav-menu').classList.remove('active');
            });
        });

        // Reset form setelah pengiriman berhasil
        <?php if (!empty($success)): ?>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('contactForm').reset();
            });
        <?php endif; ?>
    </script>
</body>
</html>