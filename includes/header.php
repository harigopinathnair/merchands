<?php
$base_url = (isset($is_sub_page) && $is_sub_page) ? '../' : './';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Merchands.com | Global B2B Service Aggregator'; ?></title>
    <meta name="description" content="<?php echo $page_description ?? 'Merchands.com is your global partner for integrated B2B solutions.'; ?>">
    <link rel="icon" type="image/png" href="<?php echo $base_url; ?>merchands-favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #002147;
            --navy-light: #003366;
            --gold: #B88A5E;
            --gold-light: #d4a77a;
            --white: #FFFFFF;
            --slate: #8892B0;
            --light-bg: #F8FAFC;
            --glass: rgba(255, 255, 255, 0.03);
            --transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--navy);
            color: var(--white);
            overflow-x: hidden;
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 30px;
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            transition: var(--transition);
            background: var(--white);
            border-bottom: 1px solid rgba(0, 33, 71, 0.08);
        }

        nav.scrolled {
            padding: 12px 0;
            box-shadow: 0 15px 40px rgba(0, 33, 71, 0.08);
        }

        .nav-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 48px;
            display: block;
            transition: var(--transition);
        }

        .nav-links {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-links a {
            color: var(--navy);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: var(--transition);
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gold);
            transition: var(--transition);
        }

        .nav-links a:hover {
            color: var(--gold);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 36px;
            background: var(--gold);
            color: var(--white) !important;
            text-decoration: none;
            font-weight: 700;
            border-radius: 6px;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .btn:hover {
            background: var(--gold-light);
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(184, 138, 94, 0.3);
        }

        /* Hero General */
        .hero-section {
            padding: 180px 0 120px;
            min-height: 90vh;
            display: flex;
            align-items: center;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(0, 33, 71, 0.95) 0%, rgba(0, 33, 71, 0.8) 100%);
        }

        .hero-section .container { position: relative; z-index: 2; }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 30px;
            background: linear-gradient(to right, #ffffff 30%, var(--gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Forms */
        .form-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            padding: 45px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            color: white;
            outline: none;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--gold);
            background: rgba(255,255,255,0.08);
        }

        /* Sections */
        .section-white { padding: 120px 0; background: var(--white); color: var(--navy); }
        .section-navy { padding: 120px 0; background: var(--navy); color: var(--white); }
        .section-light { padding: 120px 0; background: var(--light-bg); color: var(--navy); }

        .section-tag {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(184, 138, 94, 0.1);
            color: var(--gold);
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        @media (max-width: 992px) {
            .hero-title { font-size: 2.8rem; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>

    <nav id="navbar">
        <div class="container nav-flex">
            <a href="<?php echo $base_url; ?>" class="logo">
                <img src="<?php echo $base_url; ?>logo-merchands.png" alt="Merchands Logo">
            </a>
            <div class="nav-links">
                <?php if ($base_url == './'): ?>
                    <a href="logistics/">Logistics</a>
                    <a href="about.php">About</a>
                    <a href="#services">Services</a>
                <?php else: ?>
                    <a href="#about">About</a>
                    <a href="#services">Services</a>
                <?php endif; ?>
            </div>
            <a href="tel:919944635089" class="btn" style="padding: 10px 20px; font-size: 0.8rem;">+91 99446 35089</a>
        </div>
    </nav>
