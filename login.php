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

                    <div id="loginError" style="display:none; background:rgba(220,38,38,0.15); border:1px solid rgba(220,38,38,0.4); color:#fca5a5; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:0.9rem; text-align:center;"></div>
                    
                    <form id="loginForm">
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Username or Email</label>
                            <input type="text" id="loginUser" name="user" class="form-control" placeholder="Username or email" required>
                        </div>
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Password</label>
                            <input type="password" id="loginPassword" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <button type="submit" id="loginBtn" class="btn" style="width: 100%;">Log In &rarr;</button>
                    </form>
                    
                    <p style="text-align: center; margin-top: 25px; color: var(--slate); font-size: 0.9rem;">
                        Don't have an account? <a href="register.php" style="color: var(--gold); text-decoration: none; font-weight: 600;">Sign Up</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn      = document.getElementById('loginBtn');
            const errBox   = document.getElementById('loginError');
            const user     = document.getElementById('loginUser').value.trim();
            const password = document.getElementById('loginPassword').value;

            btn.textContent = 'Logging in…';
            btn.disabled    = true;
            errBox.style.display = 'none';

            try {
                const res  = await fetch('api/login.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ user, password })
                });
                const data = await res.json();

                if (data.success) {
                    btn.textContent = 'Redirecting…';
                    window.location.href = data.redirect || '/';
                } else {
                    errBox.textContent   = data.error || 'Login failed. Please try again.';
                    errBox.style.display = 'block';
                    btn.textContent = 'Log In →';
                    btn.disabled    = false;
                }
            } catch (err) {
                errBox.textContent   = 'Connection error. Please try again.';
                errBox.style.display = 'block';
                btn.textContent = 'Log In →';
                btn.disabled    = false;
            }
        });
    </script>

<?php include 'includes/footer.php'; ?>
