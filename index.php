<?php 
$page_title = "Merchands.com | Global B2B Service Aggregator";
$page_description = "Merchands.com is your global partner for integrated B2B solutions. From Logistics to Manufacturing and Recruitment, we power your growth.";
include 'includes/header.php'; 
?>

    <section class="hero">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-content">
                    <h1>Integrated Solutions for Worldwide Enterprise</h1>
                    <p>From global logistics and manufacturing to strategic recruitment and IT, Merchands.com is the single window for businesses growing globally.</p>
                    <div style="display: flex; gap: 20px;">
                        <a href="#services" class="btn">Explore Solutions</a>
                        <a href="logistics/" class="btn" style="background: transparent; border: 1px solid var(--gold); color: var(--gold);">Logistics Hub</a>
                    </div>
                </div>

                <div class="hero-form-card">
                    <h3 style="margin-bottom: 20px; color: var(--gold); font-size: 1.4rem;">Get Started Today</h3>
                    <form id="globalLeadForm">
                        <input type="hidden" name="service_category" id="service_category_input" value="logistics">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-size: 0.8rem; color: var(--slate);">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-size: 0.8rem; color: var(--slate);">Business Email</label>
                            <input type="email" name="email" class="form-control" placeholder="john@company.com" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-size: 0.8rem; color: var(--slate);">Primary Interest</label>
                            <select name="service_category" onchange="document.getElementById('service_category_input').value=this.value" style="width: 100%; padding: 10px; background: rgba(10, 25, 47, 1); border: 1px solid rgba(255,255,255,0.1); border-radius: 4px; color: white; outline: none;">
                                <option value="logistics">Global Logistics</option>
                                <option value="manufacturing">Manufacturing</option>
                                <option value="recruitment">Recruitment</option>
                                <option value="it">IT & Digital</option>
                                <option value="other">General Growth Enquiry</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 5px; font-size: 0.8rem; color: var(--slate);">Message</label>
                            <textarea name="message" class="form-control" style="height: 60px;"></textarea>
                        </div>
                        <button type="submit" class="btn" style="width: 100%; padding: 12px;">Submit Inquiry &rarr;</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h4>Global Reach</h4>
                    <p>Connecting your business to major worldwide trade hubs.</p>
                </div>
                <div class="stat-item">
                    <h4>Verified Partners</h4>
                    <p>Access to a vetted network of trusted service providers.</p>
                </div>
                <div class="stat-item">
                    <h4>Integrated Sourcing</h4>
                    <p>Manufacturing, Logistics, and IT under one unified window.</p>
                </div>
                <div class="stat-item">
                    <h4>Strategic Growth</h4>
                    <p>Scalable ecosystem designed for modern global expansion.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-dark" id="services">
        <div class="container">
            <div class="section-header">
                <h2>Our Global Solutions</h2>
                <p>Scaling a business requires more than just capital. It requires a network of reliable service providers working in sync.</p>
            </div>

            <div class="services-grid">
                <a href="logistics/" class="service-card">
                    <div class="service-icon">🚚</div>
                    <h3>Global Logistics</h3>
                    <p>Comprehensive sea, air, and land freight solutions. IATA & MTO certified handling for critical cargo.</p>
                    <span class="service-link">Access Logistics Portal &rarr;</span>
                </a>

                <div class="service-card">
                    <div class="service-icon">🏭</div>
                    <h3>Manufacturing</h3>
                    <p>Connecting growing brands with top-tier industrial manufacturing and supply chain management.</p>
                    <span class="service-link">View Capabilities &rarr;</span>
                </div>

                <div class="service-card">
                    <div class="service-icon">🤝</div>
                    <h3>Recruitment</h3>
                    <p>Strategic talent acquisition for worldwide operations. From C-suite to specialized technical teams.</p>
                    <span class="service-link">Find Talent &rarr;</span>
                </div>

                <div class="service-card">
                    <div class="service-icon">💻</div>
                    <h3>IT & Digital</h3>
                    <p>Digital transformation, enterprise software, and scalable infrastructure for the modern age.</p>
                    <span class="service-link">Digitalize Now &rarr;</span>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('globalLeadForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = e.target.querySelector('button');
            const originalText = btn.innerHTML;
            btn.innerHTML = 'Sending...';
            btn.disabled = true;

            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('api/submit-lead.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (result.success) {
                    window.location.href = 'logistics/thankyou.php?ref=' + result.ref;
                } else {
                    alert('Submission failed. Please check your database connection.');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            } catch (err) {
                console.error(err);
                alert('Connection error. Please check your internet or server.');
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });
    </script>

<?php include 'includes/footer.php'; ?>
