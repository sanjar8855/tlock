<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tellock - Biznesingiz va Qurilmangiz uchun Ishonchli Himoya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        a{
            text-decoration-line: none;
        }
        :root {
            --primary-color: #00d1b2;
            --background-color: #0a101f;
            --text-color: #e0e0e0;
            --card-bg-color: #1a2035;
            --heading-font-weight: 700;
            --body-font-weight: 400;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            font-weight: var(--body-font-weight);
        }
        .container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .main-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 0;
            background-color: rgba(10, 16, 31, 0.8);
            backdrop-filter: blur(10px);
            z-index: 1000;
            transition: background-color 0.3s ease;
        }
        .main-header.scrolled {
            background-color: var(--background-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-color);
            text-decoration: none;
        }
        .main-nav a {
            color: var(--text-color);
            text-decoration: none;
            margin: 0 15px;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .main-nav a:hover { color: var(--primary-color); }
        .header-buttons .btn {
            margin-left: 10px;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-secondary { background-color: transparent; border: 1px solid var(--primary-color); color: var(--primary-color); }
        .btn-secondary:hover { background-color: var(--primary-color); color: var(--background-color); }
        .btn-primary { background-color: var(--primary-color); color: var(--background-color); border: 1px solid var(--primary-color); }
        .btn-primary:hover { transform: scale(1.05); }

        /* Sections */
        .section {
            padding: 100px 0;
            text-align: center;
        }
        .section-hero {
            padding-top: 180px;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }
        .section h2 {
            font-size: 3rem;
            font-weight: var(--heading-font-weight);
            margin-bottom: 20px;
        }
        .section .lead {
            font-size: 1.3rem;
            max-width: 700px;
            margin: 0 auto 40px auto;
            color: #a0a7b9;
            line-height: 1.7;
        }
        .section-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        .feature-card {
            background-color: var(--card-bg-color);
            padding: 30px;
            border-radius: 12px;
            text-align: left;
        }
        .feature-card i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .feature-card p {
            color: #a0a7b9;
            line-height: 1.6;
        }
        .pricing-card {
            background-color: var(--card-bg-color);
            padding: 40px;
            border-radius: 12px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        .pricing-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-10px);
        }
        .pricing-card h3 { font-size: 1.2rem; text-transform: uppercase; color: #a0a7b9; }
        .pricing-card .price { font-size: 3.5rem; font-weight: 800; color: var(--primary-color); margin: 20px 0; }
        .pricing-card .price span { font-size: 1rem; color: #a0a7b9; }
        .pricing-card ul { list-style: none; margin-bottom: 30px; }
        .pricing-card ul li { padding: 10px 0; border-bottom: 1px solid #333a55; }

        /* Footer */
        .main-footer {
            padding: 40px 0;
            background-color: var(--card-bg-color);
            text-align: center;
            margin-top: 50px;
        }

        /* Mobile Menu */
        .mobile-menu-icon { display: none; }
        @media (max-width: 992px) {
            .main-nav, .header-buttons { display: none; }
            .mobile-menu-icon {
                display: block;
                color: white;
                font-size: 1.8rem;
                cursor: pointer;
            }
        }
    </style>
</head>
<body>

<header class="main-header">
    <div class="container header-content">
        <a href="#" class="logo">Tellock</a>
        <nav class="main-nav">
            <a href="#features">Imkoniyatlar</a>
            <a href="#pricing">Narxlar</a>
            <a href="#how-it-works">Qanday ishlaydi?</a>
        </nav>
        <div class="header-buttons">
            <a href="{{ route('customer.login') }}" class="btn btn-secondary">Kirish</a>
            <a href="{{ route('customer.register') }}" class="btn btn-primary">Boshlash</a>
        </div>
        <div class="mobile-menu-icon">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</header>

<main>
    <!-- Asosiy Qism -->
    <section class="section section-hero" id="home">
        <div class="container">
            <h2>Qurilmangiz Nazorat Ostida, Biznesingiz Xavfsiz</h2>
            <p class="lead">Tellock — bu muddatli toʻlovga sotilgan qurilmalarni masofadan boshqarish va shaxsiy qurilmalarni oʻgʻrilikdan himoya qilish uchun moʻljallangan yagona platforma.</p>
            <a href="{{ route('customer.register') }}" class="btn btn-primary" style="padding: 15px 40px; font-size: 1.2rem;">Bepul Ro'yxatdan O'tish</a>
            <br>
            <br>
            <br>
            <a href="{{ route('admin.login') }}" style=" margin-top: 15px; color: #a0a7b9;">Biznes uchun kirish</a>
        </div>
    </section>

    <!-- Imkoniyatlar -->
    <section class="section" id="features">
        <div class="container">
            <span class="section-icon"><i class="fas fa-shield-alt"></i></span>
            <h2>Nima uchun Tellock?</h2>
            <p class="lead">Biz nafaqat muammoni hal qilamiz, balki biznes va oddiy foydalanuvchilar uchun yangi imkoniyatlar yaratamiz.</p>
            <div class="grid-3">
                <div class="feature-card">
                    <i class="fas fa-store" style="text-align: center;display: block;"></i>
                    <h3>Biznes Uchun Himoya</h3>
                    <p>Toʻlov intizomini nazorat qiling. Toʻlovlar kechikganda qurilmani bir tugma bilan bloklang va moliyaviy yoʻqotishlarning oldini oling.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-user-shield" style="text-align: center;display: block;"></i>
                    <h3>Shaxsiy Xavfsizlik</h3>
                    <p>Telefoningiz yoʻqolsa yoki oʻgʻirlansa, shaxsiy kabinetingiz orqali uni darhol bloklang va maʼlumotlaringiz maxfiyligini saqlang.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-sync-alt" style="text-align: center;display: block;"></i>
                    <h3>Hayotiy Sikl Boshqaruvi</h3>
                    <p>Qurilma shartnomasi tugagach, u avtomatik tarzda kompaniya boshqaruvidan chiqib, toʻliq egasining shaxsiy nazoratiga oʻtadi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Qanday Ishlaydi -->
    <section class="section" id="how-it-works">
        <div class="container">
            <span class="section-icon"><i class="fas fa-cogs"></i></span>
            <h2>Atigi 3 Oddiy Qadam</h2>
            <p class="lead">Tizimdan foydalanish juda oddiy va intuitiv. Hammasi sizning qulayligingiz uchun ishlab chiqilgan.</p>
            <div class="grid-3">
                <div class="feature-card">
                    <h3>1. Ro'yxatdan o'tish</h3>
                    <p>Biznes egasi yoki oddiy foydalanuvchi sifatida tizimdan bir necha daqiqada ro'yxatdan o'ting.</p>
                </div>
                <div class="feature-card">
                    <h3>2. Qurilmani Qo'shish</h3>
                    <p>Qurilmaning IMEI raqami orqali uni tizimga qo'shing va mijozga biriktiring.</p>
                </div>
                <div class="feature-card">
                    <h3>3. Boshqarishni Boshlash</h3>
                    <p>Qurilma holatini real vaqt rejimida kuzating va kerakli vaziyatda uni masofadan boshqaring.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Narxlar -->
    <section class="section" id="pricing">
        <div class="container">
            <span class="section-icon"><i class="fas fa-hand-holding-dollar"></i></span>
            <h2>Siz Uchun Mos Tarifni Tanlang</h2>
            <p class="lead">Yashirin toʻlovlar yoʻq. Faqat sizga kerakli boʻlgan xizmatlar uchun toʻlang va istalgan paytda bekor qiling.</p>
            <div class="grid-3">

                <!-- Shaxsiy Tarif -->
                <div class="pricing-card">
                    <h3>SHAXSIY HIMOYACHI</h3>
                    <p style="color: #a0a7b9; min-height: 50px;">Telefoningizni oʻgʻrilik va yoʻqotishdan himoya qilish uchun.</p>
                    <div class="price">50,000<span>soʻm / yiliga</span></div>
                    <p style="font-size: 1rem; color: #00d1b2;">(Oyiga ~4,200 soʻmdan)</p>
                    <ul style="text-align: left; padding-left: 15px; margin-top: 30px;">
                        <li><i class="fas fa-check-circle" style="color: #00d1b2; margin-right: 10px;"></i>1 ta qurilmani himoya</li>
                        <li><i class="fas fa-check-circle" style="color: #00d1b2; margin-right: 10px;"></i>Masofadan bloklash</li>
                        <li><i class="fas fa-check-circle" style="color: #00d1b2; margin-right: 10px;"></i>24/7 texnik yordam</li>
                    </ul>
                    <a href="{{ route('customer.register') }}" class="btn btn-primary" style="margin-top: 30px;">Boshlash</a>
                </div>

                <!-- Biznes Tarif -->
                <div class="pricing-card" style="border-color: var(--primary-color); transform: scale(1.05);">
                    <span style="background: var(--primary-color); color: var(--background-color); padding: 5px 15px; border-radius: 15px; font-weight: 600; font-size: 0.8rem;">OMMABOP</span>
                    <h3>BIZNES HAMKOR</h3>
                    <p style="color: #a0a7b9; min-height: 50px;">Muddatli toʻlovga sotilgan qurilmalarni nazorat qilish uchun.</p>
                    <div class="price">5,000<span>soʻm</span></div>
                    <p style="font-size: 1rem; color: #a0a7b9;">har bir qurilmaga / oyiga</p>
                    <ul style="text-align: left; padding-left: 15px; margin-top: 30px;">
                        <li><i class="fas fa-check-circle" style="color: #00d1b2; margin-right: 10px;"></i>Cheksiz qurilmalar</li>
                        <li><i class="fas fa-check-circle" style="color: #00d1b2; margin-right: 10px;"></i>Xodimlarni boshqarish</li>
                        <li><i class="fas fa-check-circle" style="color: #00d1b2; margin-right: 10px;"></i>Toʻliq funksionallik</li>
                        <li><i class="fas fa-check-circle" style="color: #00d1b2; margin-right: 10px;"></i>Hisobotlar</li>
                    </ul>
                    <a href="{{ route('admin.login') }}" class="btn btn-primary" style="margin-top: 30px;">Bog'lanish</a>
                </div>

                <!-- Korporativ Tarif -->
                <div class="pricing-card">
                    <h3>KORPORATIV YECHIM</h3>
                    <p style="color: #a0a7b9; min-height: 50px;">Katta hajmdagi biznes va maxsus talablar uchun.</p>
                    <div class="price">Maxsus</div>
                    <p style="font-size: 1rem; color: #a0a7b9;">Sizning talabingizga ko'ra</p>
                    <ul style="text-align: left; padding-left: 15px; margin-top: 30px;">
                        <li><i class="fas fa-check-circle" style="color: #00d1b2; margin-right: 10px;"></i>Shaxsiy talablar asosida</li>
                        <li><i class="fas fa-check-circle" style="color: #00d1b2; margin-right: 10px;"></i>CRM tizimiga integratsiya</li>
                        <li><i class="fas fa-check-circle" style="color: #00d1b2; margin-right: 10px;"></i>Shaxsiy menejer biriktirish</li>
                        <li><i class="fas fa-check-circle" style="color: #00d1b2; margin-right: 10px;"></i>Eng yuqori darajadagi yordam</li>
                    </ul>
                    <a href="#" class="btn btn-primary" style="margin-top: 30px;">Murojaat qilish</a>
                </div>
            </div>
        </div>
    </section>

</main>

<footer class="main-footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} Tellock. Barcha huquqlar himoyalangan.</p>
    </div>
</footer>

<script>
    // Header fonga ega bo'lishi uchun
    const header = document.querySelector('.main-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
</script>
</body>
</html>
