<?php
$base_url = (isset($is_sub_page) && $is_sub_page) ? '../' : './';
?>
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <img src="<?php echo $base_url; ?>Footer-logo.png" alt="Merchands Logo" style="height: 50px; margin-bottom: 25px;">
                    <p style="color: rgba(255,255,255,0.4); line-height: 1.8;">Your global business growth engine. Providing integrated solutions for the modern enterprise.</p>
                </div>
                <div class="footer-col">
                    <h5>Verticals</h5>
                    <ul>
                        <li><a href="<?php echo $base_url; ?>logistics/">Logistics Hub</a></li>
                        <li><a href="<?php echo $base_url; ?>#services">Manufacturing</a></li>
                        <li><a href="<?php echo $base_url; ?>#services">Recruitment</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h5>Company</h5>
                    <ul>
                        <li><a href="<?php echo $base_url; ?>about.php">About Us</a></li>
                        <li><a href="<?php echo $base_url; ?>#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="<?php echo $base_url; ?>privacy.php">Privacy Policy</a></li>
                        <li><a href="<?php echo $base_url; ?>terms.php">Terms of Use</a></li>
                        <li><a href="<?php echo $base_url; ?>disclaimer.php">Disclaimer</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h5>Contact</h5>
                    <ul>
                        <li><a href="mailto:support@merchands.com">support@merchands.com</a></li>
                        <li><a href="tel:919944635089">+91 99446 35089</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                &copy; 2026 Merchands.com &middot; A Global Business Aggregator &middot; All Rights Reserved.
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) nav.classList.add('scrolled');
            else nav.classList.remove('scrolled');
        });
    </script>
</body>
</html>
