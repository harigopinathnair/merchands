<?php 
$page_title = "Register | Merchands.com";
include 'includes/header.php'; 
?>

    <section class="hero-section" style="min-height: 80vh;">
        <div class="container">
            <div style="max-width: 500px; margin: 0 auto;">
                <div class="form-card">
                    <h3 style="margin-bottom: 15px; color: var(--gold); font-size: 1.8rem; font-weight: 700; text-align: center;">Join Merchands</h3>
                    <p style="text-align: center; color: var(--slate); margin-bottom: 35px; font-size: 0.95rem;">Create your account to manage inquiries and connect with global partners.</p>
                    
                    <form id="registerForm">
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Full Name</label>
                            <input type="text" name="full_name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Business Email</label>
                            <input type="email" name="email" class="form-control" placeholder="john@company.com" required>
                        </div>
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+91..." required>
                        </div>
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div style="margin-bottom: 30px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Account Type</label>
                            <select name="role" class="form-control" style="background: var(--navy);">
                                <option value="customer">Business Customer</option>
                                <option value="partner">Service Partner</option>
                            </select>
                        </div>
                        <button type="submit" class="btn" style="width: 100%;">Create Account &rarr;</button>
                    </form>
                    
                    <p style="text-align: center; margin-top: 25px; color: var(--slate); font-size: 0.9rem;">
                        Already have an account? <a href="login.php" style="color: var(--gold); text-decoration: none; font-weight: 600;">Log In</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = e.target.querySelector('button');
            const originalText = btn.innerHTML;
            btn.innerHTML = 'Creating Account...';
            btn.disabled = true;

            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('api/register.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (result.success) {
                    alert('Registration successful! Please log in.');
                    window.location.href = 'login.php';
                } else {
                    alert('Registration failed: ' + result.error);
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            } catch (err) {
                console.error(err);
                alert('Connection error. Please try again.');
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });
    </script>

<?php include 'includes/footer.php'; ?>
