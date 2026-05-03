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
            --gold: #B88A5E;
            --white: #FFFFFF;
            --slate: #8892B0;
            --glass: rgba(0, 33, 71, 0.05);
            --glass-light: rgba(255, 255, 255, 0.05);
            --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
            transition: var(--transition);
            background: var(--white);
            border-bottom: 1px solid rgba(0, 33, 71, 0.1);
        }

        nav.scrolled {
            background: var(--white);
            backdrop-filter: blur(10px);
            padding: 10px 0;
            border-bottom: 1px solid rgba(0, 33, 71, 0.1);
            box-shadow: 0 10px 30px rgba(0, 33, 71, 0.05);
        }

        .nav-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 45px;
            display: block;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            color: var(--navy);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
        }

        .nav-links a:hover {
            color: var(--gold);
        }

        .btn {
            display: inline-block;
            padding: 15px 35px;
            background: var(--gold);
            color: var(--white);
            text-decoration: none;
            font-weight: 700;
            border-radius: 4px;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(184, 138, 94, 0.3);
        }

        /* Forms */
        .form-control {
            width: 100%;
            padding: 12px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 4px;
            color: white;
            outline: none;
            font-size: 0.9rem;
        }

        /* Section Styles */
        .section { padding: 100px 0; background: var(--white); color: var(--navy); }
        .section-dark { padding: 100px 0; background: var(--navy); color: var(--white); }
        
        @media (max-width: 992px) {
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
