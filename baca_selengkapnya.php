<?php
include('../admin/config.php');

// Get article ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Get specific article
$query = mysqli_query($conn, "SELECT * FROM artikel WHERE id = $id");
if (!$query) {
    die("Error query artikel: " . mysqli_error($conn));
}

$artikel = mysqli_fetch_assoc($query);
if (!$artikel) {
    die("Artikel tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($artikel['judul']) ?> | Defrima Fitriyani</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #001f3f;
            --light-navy: #2c3e50;
            --gold: #d4af37;
            --white: #ffffff;
            --light-gray: #f5f5f5;
            --dark-gray: #333333;
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--white);
            color: var(--dark-gray);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4 {
            font-family: 'Playfair Display', serif;
            color: var(--navy);
            font-weight: 600;
        }
        
        a {
            text-decoration: none;
            color: var(--navy);
            transition: var(--transition);
        }
        
        a:hover {
            color: var(--gold);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header */
        header {
            background-color: rgba(0, 31, 63, 0.95);
            color: var(--white);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        header.scrolled {
            background-color: rgba(0, 31, 63, 0.98);
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
            padding: 10px 0;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            transition: var(--transition);
        }
        
        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--white);
            display: flex;
            align-items: center;
        }
        
        .logo span {
            color: var(--gold);
            margin-left: 5px;
        }
        
        .logo img {
            height: 40px;
            margin-right: 10px;
            border-radius: 50%;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 25px;
            position: relative;
        }
        
        nav ul li a {
            color: var(--white);
            font-weight: 500;
            font-size: 16px;
            padding: 5px 0;
            display: flex;
            align-items: center;
        }
        
        nav ul li a i {
            margin-right: 8px;
            font-size: 14px;
        }
        
        nav ul li a:hover {
            color: var(--gold);
        }
        
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: var(--gold);
            bottom: 0;
            left: 0;
            transition: var(--transition);
        }
        
        nav ul li a:hover::after {
            width: 100%;
        }
        
        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 24px;
            color: var(--white);
            z-index: 1001;
        }
        
        /* Main Content */
        .main-content {
            padding: 180px 0 60px;
        }
        
        .article-detail {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .article-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .article-header h1 {
            font-size: 36px;
            margin-bottom: 15px;
            line-height: 1.3;
        }
        
        .article-meta {
            color: #777;
            font-size: 16px;
            margin-bottom: 30px;
        }
        
        .article-meta i {
            margin-right: 5px;
        }
        
        .article-content {
            font-size: 18px;
            line-height: 1.8;
        }
        
        .article-content p {
            margin-bottom: 20px;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            margin-top: 40px;
            color: var(--navy);
            font-weight: 600;
            transition: var(--transition);
        }
        
        .back-link:hover {
            color: var(--gold);
        }
        
        .back-link i {
            margin-right: 8px;
        }
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--navy) 0%, var(--light-navy) 100%);
            color: var(--white);
            padding: 70px 0 30px;
            text-align: center;
            position: relative;
        }
        
        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: linear-gradient(90deg, var(--gold), rgba(212, 175, 55, 0.5));
        }
        
        .footer-content {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .footer-logo {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .footer-logo span {
            color: var(--gold);
            margin-left: 5px;
        }
        
        .footer-text {
            margin-bottom: 30px;
            line-height: 1.8;
            opacity: 0.9;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .social-links a {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            font-size: 18px;
            backdrop-filter: blur(5px);
        }
        
        .social-links a:hover {
            background: var(--gold);
            color: var(--navy);
            transform: translateY(-5px);
        }
        
        .copyright {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 30px;
        }
        
        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--gold);
            color: var(--navy);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            transform: translateY(-5px);
            background: var(--navy);
            color: var(--gold);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            
            nav ul {
                position: fixed;
                top: 0;
                left: -100%;
                width: 80%;
                height: 100vh;
                background: var(--navy);
                flex-direction: column;
                align-items: flex-start;
                padding: 100px 30px 30px;
                transition: var(--transition);
                z-index: 1000;
                box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
            }
            
            nav ul.active {
                left: 0;
            }
            
            nav ul li {
                margin: 15px 0;
            }
            
            nav ul li a {
                font-size: 18px;
                padding: 10px 0;
            }
            
            .main-content {
                padding: 150px 0 50px;
            }
            
            .article-header h1 {
                font-size: 28px;
            }
            
            .article-content {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <header id="header">
        <div class="container">
            <nav>
                <div class="logo">Defrima <span>Fitriyani</span></div>
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
                <div class="menu-toggle" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="article-detail">
                <div class="article-header">
                    <h1><?= htmlspecialchars($artikel['judul']) ?></h1>
                    <div class="article-meta">
                        <span><i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($artikel['tanggal'])) ?></span>
                    </div>
                </div>
                
                <div class="article-content">
                    <?= nl2br(htmlspecialchars($artikel['isi'])) ?>
                </div>
                
                <a href="artikel_detail.php" class="back-link"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Artikel</a>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">Defrima <span>Fitriyani</span></div>
                <p class="footer-text">Mahasiswa Teknik Informatika yang passionate tentang pengembangan web, analisis data, dan teknologi untuk solusi sosial.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fas fa-envelope"></i></a>
                </div>
                <p class="copyright">&copy; <?= date('Y') ?> Defrima Fitriyani. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <div class="back-to-top" id="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script>
        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menu-toggle');
        const navMenu = document.getElementById('nav-menu');
        
        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
        
        // Close menu when clicking a link
        const navLinks = document.querySelectorAll('#nav-menu a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
            });
        });
        
        // Add shadow to header on scroll
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            // Back to top button
            const backToTop = document.getElementById('back-to-top');
            if (window.scrollY > 300) {
                backToTop.classList.add('active');
            } else {
                backToTop.classList.remove('active');
            }
        });
        
        // Back to top functionality
        document.getElementById('back-to-top').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>