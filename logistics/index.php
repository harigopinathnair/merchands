<?php 
$is_sub_page = true;
$page_title = "Logistics Hub | Merchands.com";
$page_description = "Your trusted logistics company for global freight solutions. IATA accredited and Govt. licensed MTO.";
include '../includes/header.php'; 
?>

    <header class="hero" style="position: relative; min-height: 100vh; display: flex; align-items: center; background: linear-gradient(rgba(0, 33, 71, 0.9), rgba(0, 33, 71, 0.9)), url('../logistics_premium_hero_1777805927376.png'); background-size: cover; background-position: center; padding-top: 100px;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 60px; align-items: center; text-align: left;">
                <div class="hero-content">
                    <h1 style="font-size: 3.5rem; font-weight: 700; margin-bottom: 25px; background: linear-gradient(to right, #fff, var(--gold)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1.1;">Global Freight Solutions with Precision</h1>
                    <p style="font-size: 1.2rem; color: var(--slate); margin-bottom: 40px; max-width: 600px;">IATA accredited and Govt. licensed MTO partner. Handling critical cargo globally with precision and a commitment to reliability.</p>
                    <div style="display: flex; gap: 20px;">
                        <a href="#services" class="btn">Our Services</a>
                        <a href="https://wa.me/919944635089" class="btn" style="background: #25D366; color: white;">WhatsApp Us</a>
                    </div>
                </div>

                <div style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 12px; border: 1px solid rgba(184, 138, 94, 0.2); box-shadow: 0 20px 40px rgba(0,0,0,0.3);">
                    <h3 style="margin-bottom: 20px; color: var(--gold); font-size: 1.4rem;">Get Free Quote</h3>
                    <form id="logisticsLeadForm">
                        <input type="hidden" name="service_category" value="logistics">
                        <input type="hidden" name="shipment_type" id="shipment_type_val" value="sea">
                        
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-size: 0.8rem; color: var(--slate); margin-bottom: 5px;">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-size: 0.8rem; color: var(--slate); margin-bottom: 5px;">Business Email</label>
                            <input type="email" name="email" class="form-control" placeholder="john@company.com" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-size: 0.8rem; color: var(--slate); margin-bottom: 5px;">Phone / WhatsApp</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+91..." required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-size: 0.8rem; color: var(--slate); margin-bottom: 5px;">Shipment Type</label>
                            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                                <div class="pill active" onclick="setPill(this, 'sea')" style="padding: 8px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; font-size: 0.8rem; cursor: pointer;">Sea</div>
                                <div class="pill" onclick="setPill(this, 'air')" style="padding: 8px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; font-size: 0.8rem; cursor: pointer;">Air</div>
                                <div class="pill" onclick="setPill(this, 'project')" style="padding: 8px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; font-size: 0.8rem; cursor: pointer;">Project</div>
                                <div class="pill" onclick="setPill(this, 'customs')" style="padding: 8px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; font-size: 0.8rem; cursor: pointer;">Customs</div>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="width: 100%; margin-top: 10px;">Get Quote &rarr;</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <style>
        .pill.active { background: var(--gold) !important; color: var(--navy) !important; border-color: var(--gold) !important; font-weight: 600; }
    </style>

    <section class="section" id="about">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;">
                <div>
                    <h2 style="font-size: 2.5rem; color: var(--navy); margin-bottom: 25px;">Leading the Global Logistics Revolution</h2>
                    <p style="font-size: 1.1rem; color: #444; margin-bottom: 25px;">Merchands.com has evolved into a premier logistics hub, providing seamless end-to-end solutions for businesses worldwide.</p>
                    <p style="color: #666; margin-bottom: 30px;">As a division of the Trisora Group, we combine deep industry expertise with cutting-edge technology to ensure your cargo moves efficiently across borders.</p>
                </div>
                <div style="background: var(--navy); padding: 50px; border-radius: 12px; color: white;">
                    <h3 style="color: var(--gold); margin-bottom: 20px;">Why Merchands?</h3>
                    <ul style="list-style: none;">
                        <li style="margin-bottom: 15px; display: flex; gap: 15px;"><span style="color: var(--gold);">✓</span> IATA Accredited</li>
                        <li style="margin-bottom: 15px; display: flex; gap: 15px;"><span style="color: var(--gold);">✓</span> Licensed MTO Partner</li>
                        <li style="margin-bottom: 15px; display: flex; gap: 15px;"><span style="color: var(--gold);">✓</span> Licensed Customs Broker</li>
                    </ul>
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
                    alert('Submission failed. Please try again.');
                    btn.innerHTML = 'Get Quote &rarr;';
                    btn.disabled = false;
                }
            } catch (err) {
                console.error(err);
                btn.innerHTML = 'Get Quote &rarr;';
                btn.disabled = false;
            }
        });
    </script>

<?php include '../includes/footer.php'; ?>
