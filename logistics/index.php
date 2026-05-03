<?php 
$is_sub_page = true;
$page_title = "Logistics Hub | Merchands.com";
$page_description = "Your trusted logistics company for global freight solutions. IATA accredited and Govt. licensed MTO.";
include '../includes/header.php'; 
?>

    <header class="hero-section" style="background-image: url('../logistics_premium_hero_1777805927376.png');">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 80px; align-items: center;">
                <div class="hero-content">
                    <span class="section-tag">Logistics Hub</span>
                    <h1 class="hero-title">Global Freight Solutions with Precision</h1>
                    <p style="font-size: 1.2rem; color: var(--slate); margin-bottom: 45px; max-width: 650px;">Connecting you with IATA accredited and Govt. licensed MTO partners. Handling critical cargo globally with precision through our vetted network.</p>
                    <div style="display: flex; gap: 20px;">
                        <a href="#services" class="btn">Our Services</a>
                        <a href="https://wa.me/919944635089" class="btn" style="background: #25D366; color: white; border: none;">WhatsApp Us</a>
                    </div>
                </div>

                <div class="form-card">
                    <h3 style="margin-bottom: 25px; color: var(--gold); font-size: 1.6rem; font-weight: 700;">Get Free Quote</h3>
                    <form id="logisticsLeadForm">
                        <input type="hidden" name="service_category" value="logistics">
                        <input type="hidden" name="shipment_type" id="shipment_type_val" value="sea">
                        
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Business Email</label>
                            <input type="email" name="email" class="form-control" placeholder="john@company.com" required>
                        </div>
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Phone / WhatsApp</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+91..." required>
                        </div>
                        <div style="margin-bottom: 25px;">
                            <label style="display: block; font-size: 0.8rem; color: var(--slate); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;">Shipment Type</label>
                            <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                                <div class="pill active" onclick="setPill(this, 'sea')" style="padding: 10px 22px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 30px; font-size: 0.85rem; cursor: pointer; transition: var(--transition); font-weight: 600;">Sea</div>
                                <div class="pill" onclick="setPill(this, 'air')" style="padding: 10px 22px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 30px; font-size: 0.85rem; cursor: pointer; transition: var(--transition); font-weight: 600;">Air</div>
                                <div class="pill" onclick="setPill(this, 'project')" style="padding: 10px 22px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 30px; font-size: 0.85rem; cursor: pointer; transition: var(--transition); font-weight: 600;">Project</div>
                                <div class="pill" onclick="setPill(this, 'customs')" style="padding: 10px 22px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 30px; font-size: 0.85rem; cursor: pointer; transition: var(--transition); font-weight: 600;">Customs</div>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="width: 100%;">Get Quote &rarr;</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <style>
        .pill.active { background: var(--gold) !important; color: var(--white) !important; border-color: var(--gold) !important; }
    </style>

    <section class="section-white" id="about">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 100px; align-items: center;">
                <div>
                    <span class="section-tag">About Logistics</span>
                    <h2 style="font-size: 3rem; color: var(--navy); margin-bottom: 30px; line-height: 1.2;">Leading the Global Logistics Revolution</h2>
                    <p style="font-size: 1.15rem; color: #444; margin-bottom: 30px; line-height: 1.8;">Merchands.com has evolved into a premier logistics hub, providing seamless end-to-end solutions for businesses worldwide.</p>
                    <p style="color: #666; margin-bottom: 40px; line-height: 1.8;">As a division of the Trisora Group, we combine deep industry expertise with cutting-edge technology to ensure your cargo moves efficiently across borders.</p>
                </div>
                <div style="background: var(--navy); padding: 60px; border-radius: 20px; color: white; box-shadow: 0 30px 60px rgba(0, 33, 71, 0.15);">
                    <h3 style="color: var(--gold); margin-bottom: 30px; font-size: 1.8rem; font-weight: 700;">Why Merchands?</h3>
                    <ul style="list-style: none;">
                        <li style="margin-bottom: 25px; display: flex; gap: 20px; font-size: 1.1rem; align-items: center;"><span style="background: var(--gold); color: white; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 0.8rem;">✓</span> IATA Accredited Partners</li>
                        <li style="margin-bottom: 25px; display: flex; gap: 20px; font-size: 1.1rem; align-items: center;"><span style="background: var(--gold); color: white; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 0.8rem;">✓</span> Licensed MTO Partners</li>
                        <li style="margin-bottom: 0; display: flex; gap: 20px; font-size: 1.1rem; align-items: center;"><span style="background: var(--gold); color: white; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 0.8rem;">✓</span> Licensed Customs Brokers</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section-light" id="services">
        <div class="container">
            <div style="text-align: center; margin-bottom: 80px;">
                <span class="section-tag">Core Services</span>
                <h2 style="font-size: 3rem;">Precision Logistics Services</h2>
            </div>
            <div class="grid-4">
                <div style="background: white; padding: 50px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05);">
                    <span style="font-size: 3.5rem; margin-bottom: 30px; display: block;">🚢</span>
                    <h3 style="font-size: 1.5rem; margin-bottom: 20px;">Sea Freight</h3>
                    <p style="color: #666; line-height: 1.7;">FCL and LCL solutions for major worldwide ports with real-time tracking.</p>
                </div>
                <div style="background: white; padding: 50px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05);">
                    <span style="font-size: 3.5rem; margin-bottom: 30px; display: block;">✈️</span>
                    <h3 style="font-size: 1.5rem; margin-bottom: 20px;">Air Freight</h3>
                    <p style="color: #666; line-height: 1.7;">Priority cargo handling for time-sensitive shipments across continents.</p>
                </div>
                <div style="background: white; padding: 50px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05);">
                    <span style="font-size: 3.5rem; margin-bottom: 30px; display: block;">🏗️</span>
                    <h3 style="font-size: 1.5rem; margin-bottom: 20px;">Project Cargo</h3>
                    <p style="color: #666; line-height: 1.7;">Specialized management for heavy lift and oversized industrial equipment.</p>
                </div>
                <div style="background: white; padding: 50px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05);">
                    <span style="font-size: 3.5rem; margin-bottom: 30px; display: block;">📄</span>
                    <h3 style="font-size: 1.5rem; margin-bottom: 20px;">Customs</h3>
                    <p style="color: #666; line-height: 1.7;">Licensed customs brokerage ensuring seamless cross-border compliance.</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        function setPill(el, val) {
            document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('shipment_type_val').value = val;
        }

        document.getElementById('logisticsLeadForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = e.target.querySelector('button');
            const originalText = btn.innerHTML;
            btn.innerHTML = 'Processing...';
            btn.disabled = true;

            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('../api/submit-lead.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (result.success) {
                    window.location.href = 'thankyou.php?ref=' + result.ref;
                } else {
                    alert('Submission failed. Please check your data.');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            } catch (err) {
                console.error(err);
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });
    </script>

<?php include '../includes/footer.php'; ?>
