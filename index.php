<?php 
$page_title = "Merchands.com | Global B2B Service Aggregator";
$page_description = "Merchands.com is your global partner for integrated B2B solutions. From Logistics to Manufacturing and Recruitment, we power your growth.";
include 'includes/header.php'; 
?>

    <section class="hero-section" style="background-image: url('b2b_aggregator_hero_1777805289164.png');">
        <div class="container">
            <div class="hero-grid" style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 80px; align-items: center;">
                <div class="hero-content">
                    <span class="section-tag">Global B2B Aggregator</span>
                    <h1 class="hero-title">Integrated Solutions for Worldwide Enterprise</h1>
                    <p style="font-size: 1.2rem; color: var(--slate); margin-bottom: 45px; max-width: 650px;">From global logistics and manufacturing to strategic recruitment and IT, Merchands.com is the single window for businesses growing globally.</p>
                    <div style="display: flex; gap: 20px;">
                        <a href="#services" class="btn">Explore Solutions</a>
                        <a href="logistics/" class="btn" style="background: transparent; border: 1px solid var(--gold); color: var(--gold) !important;">Logistics Hub</a>
                    </div>
                </div>

                <div class="form-card">
                    <h3 style="margin-bottom: 15px; color: var(--gold); font-size: 1.3rem; font-weight: 700;">Get Free Quote from Our Trusted Partners</h3>
                    <form id="globalLeadForm">
                        <input type="hidden" name="service_category" id="service_category_input" value="logistics">
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Business Email</label>
                            <input type="email" name="email" class="form-control" placeholder="john@company.com" required>
                        </div>
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Phone / WhatsApp</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+91..." required>
                        </div>
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Primary Interest</label>
                            <select name="service_category" onchange="document.getElementById('service_category_input').value=this.value" class="form-control" style="background: var(--navy);">
                                <option value="logistics">Global Logistics</option>
                                <option value="manufacturing">Manufacturing</option>
                                <option value="recruitment">Recruitment</option>
                                <option value="it">IT & Digital</option>
                                <option value="other">General Growth Enquiry</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 25px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Message</label>
                            <textarea name="message" class="form-control" style="height: 70px;" placeholder="Tell us about your requirements..."></textarea>
                        </div>
                        <button type="submit" class="btn" style="width: 100%;">Submit Inquiry &rarr;</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section style="background: rgba(184, 138, 94, 0.03); padding: 70px 0; border-top: 1px solid rgba(184, 138, 94, 0.1); border-bottom: 1px solid rgba(184, 138, 94, 0.1);">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); text-align: center; gap: 40px;">
                <div>
                    <h4 style="font-size: 1.1rem; color: var(--gold); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1.5px;">Global Reach</h4>
                    <p style="color: var(--slate); font-size: 0.9rem;">Major Worldwide Trade Hubs</p>
                </div>
                <div>
                    <h4 style="font-size: 1.1rem; color: var(--gold); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1.5px;">Verified Partners</h4>
                    <p style="color: var(--slate); font-size: 0.9rem;">Trusted Service Network</p>
                </div>
                <div>
                    <h4 style="font-size: 1.1rem; color: var(--gold); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1.5px;">Integrated Sourcing</h4>
                    <p style="color: var(--slate); font-size: 0.9rem;">Unified Business Window</p>
                </div>
                <div>
                    <h4 style="font-size: 1.1rem; color: var(--gold); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1.5px;">Strategic Growth</h4>
                    <p style="color: var(--slate); font-size: 0.9rem;">Scalable Growth Ecosystem</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-navy" id="services">
        <div class="container">
            <div style="text-align: center; margin-bottom: 80px;">
                <span class="section-tag">Our Verticals</span>
                <h2 style="font-size: 3rem; margin-bottom: 20px;">Global Solutions for Modern Scale</h2>
                <p style="color: var(--slate); max-width: 700px; margin: 0 auto; font-size: 1.1rem;">Scaling a business requires more than just capital. It requires a network of reliable service providers working in sync.</p>
            </div>

            <div class="grid-4">
                <a href="logistics/" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.08); padding: 50px; border-radius: 16px; transition: var(--transition); text-decoration: none; color: inherit; display: block;">
                    <div style="font-size: 3rem; margin-bottom: 25px; color: var(--gold);">🚚</div>
                    <h3 style="font-size: 1.6rem; margin-bottom: 15px; color: white;">Global Logistics</h3>
                    <p style="color: var(--slate); font-size: 1rem; line-height: 1.7; margin-bottom: 25px;">Comprehensive sea, air, and land freight solutions. Handling through IATA & MTO certified partners for critical cargo.</p>
                    <span style="color: var(--gold); font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Access Portal &rarr;</span>
                </a>

                <div style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.08); padding: 50px; border-radius: 16px; transition: var(--transition);">
                    <div style="font-size: 3rem; margin-bottom: 25px; color: var(--gold);">🏭</div>
                    <h3 style="font-size: 1.6rem; margin-bottom: 15px; color: white;">Manufacturing</h3>
                    <p style="color: var(--slate); font-size: 1rem; line-height: 1.7; margin-bottom: 25px;">Connecting growing brands with top-tier industrial manufacturing and supply chain management.</p>
                    <span style="color: var(--gold); font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">View Capabilities &rarr;</span>
                </div>

                <div style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.08); padding: 50px; border-radius: 16px; transition: var(--transition);">
                    <div style="font-size: 3rem; margin-bottom: 25px; color: var(--gold);">🤝</div>
                    <h3 style="font-size: 1.6rem; margin-bottom: 15px; color: white;">Recruitment</h3>
                    <p style="color: var(--slate); font-size: 1rem; line-height: 1.7; margin-bottom: 25px;">Strategic talent acquisition for worldwide operations. From C-suite to specialized technical teams.</p>
                    <span style="color: var(--gold); font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Find Talent &rarr;</span>
                </div>

                <div style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.08); padding: 50px; border-radius: 16px; transition: var(--transition);">
                    <div style="font-size: 3rem; margin-bottom: 25px; color: var(--gold);">💻</div>
                    <h3 style="font-size: 1.6rem; margin-bottom: 15px; color: white;">IT & Digital</h3>
                    <p style="color: var(--slate); font-size: 1rem; line-height: 1.7; margin-bottom: 25px;">Digital transformation, enterprise software, and scalable infrastructure for the modern age.</p>
                    <span style="color: var(--gold); font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Digitalize Now &rarr;</span>
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
