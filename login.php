<?php 
$page_title = "Login | Merchands.com";
include 'includes/header.php'; 
?>

    <section class="hero-section" style="min-height: 80vh;">
        <div class="container">
            <div style="max-width: 500px; margin: 0 auto;">
                <div class="form-card">
                    <h3 style="margin-bottom: 15px; color: var(--gold); font-size: 1.8rem; font-weight: 700; text-align: center;">Welcome Back</h3>
                    <p style="text-align: center; color: var(--slate); margin-bottom: 35px; font-size: 0.95rem;">Log in to access your dashboard and manage inquiries.</p>
                    
                    <form id="loginForm">
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="john@company.com" required>
                        </div>
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn" style="width: 100%;">Log In &rarr;</button>
                    </form>
                    
                    <p style="text-align: center; margin-top: 25px; color: var(--slate); font-size: 0.9rem;">
                        Don't have an account? <a href="register.php" style="color: var(--gold); text-decoration: none; font-weight: 600;">Sign Up</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
