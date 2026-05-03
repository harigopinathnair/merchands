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
                    <p style="font-size: 1.1rem; color: var(--slate); margin-bottom: 30px; max-width: 650px; line-height: 1.6;">Your gateway to reliable global freight. Connecting you with vetted partners for seamless worldwide logistics.</p>
                    
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 35px;">
                        <span style="background: rgba(255,255,255,0.05); padding: 6px 15px; border-radius: 4px; font-size: 0.8rem; color: var(--gold); border: 1px solid rgba(184, 138, 94, 0.3); font-weight: 600;">• Sea Freight</span>
                        <span style="background: rgba(255,255,255,0.05); padding: 6px 15px; border-radius: 4px; font-size: 0.8rem; color: var(--gold); border: 1px solid rgba(184, 138, 94, 0.3); font-weight: 600;">• Air Freight</span>
                        <span style="background: rgba(255,255,255,0.05); padding: 6px 15px; border-radius: 4px; font-size: 0.8rem; color: var(--gold); border: 1px solid rgba(184, 138, 94, 0.3); font-weight: 600;">• Customs Clearance</span>
                        <span style="background: rgba(255,255,255,0.05); padding: 6px 15px; border-radius: 4px; font-size: 0.8rem; color: var(--gold); border: 1px solid rgba(184, 138, 94, 0.3); font-weight: 600;">• Multimodal</span>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 45px;">
                        <div style="display: flex; align-items: center; gap: 12px; color: white; font-size: 0.9rem;">
                            <span style="color: #4BB543;">✓</span> IATA Accredited Partners
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; color: white; font-size: 0.9rem;">
                            <span style="color: #4BB543;">✓</span> Serving 185+ Countries through our Partners
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; color: white; font-size: 0.9rem;">
                            <span style="color: #4BB543;">✓</span> Licensed MTO Partners
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; color: white; font-size: 0.9rem;">
                            <span style="color: #4BB543;">✓</span> Our Partners Delivered 42,300+ Shipments
                        </div>
                    </div>

                    <div style="display: flex; gap: 20px;">
                        <a href="#services" class="btn">Our Services</a>
                        <a href="https://wa.me/919944635089" class="btn" style="background: #25D366; color: white; border: none;">Chat with an Expert</a>
                    </div>
                </div>

                <div class="form-card">
                    <h3 style="margin-bottom: 15px; color: var(--gold); font-size: 1.3rem; font-weight: 700;">Get Free Quote from Our Trusted Partners</h3>
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
                                <div class="pill" onclick="setPill(this, 'cargo')" style="padding: 10px 22px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 30px; font-size: 0.85rem; cursor: pointer; transition: var(--transition); font-weight: 600;">Cargo</div>
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
                <div style="background: white; padding: 40px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05); text-align: center;">
                    <span style="font-size: 3rem; margin-bottom: 25px; display: block;">🚢</span>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px; color: var(--navy);">Sea Freight</h3>
                    <p style="color: #666; line-height: 1.6; font-size: 0.9rem;">Global FCL & LCL services with major carriers.</p>
                </div>
                <div style="background: white; padding: 40px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05); text-align: center;">
                    <span style="font-size: 3rem; margin-bottom: 25px; display: block;">✈️</span>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px; color: var(--navy);">Air Freight</h3>
                    <p style="color: #666; line-height: 1.6; font-size: 0.9rem;">Priority and economy air shipping worldwide.</p>
                </div>
                <div style="background: white; padding: 40px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05); text-align: center;">
                    <span style="font-size: 3rem; margin-bottom: 25px; display: block;">📄</span>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px; color: var(--navy);">Customs Clearance</h3>
                    <p style="color: #666; line-height: 1.6; font-size: 0.9rem;">In-house licensed customs brokerage experts.</p>
                </div>
                <div style="background: white; padding: 40px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05); text-align: center;">
                    <span style="font-size: 3rem; margin-bottom: 25px; display: block;">🛡️</span>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px; color: var(--navy);">Special Cargo</h3>
                    <p style="color: #666; line-height: 1.6; font-size: 0.9rem;">Careful handling for fragile or hazardous goods.</p>
                </div>
                <div style="background: white; padding: 40px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05); text-align: center;">
                    <span style="font-size: 3rem; margin-bottom: 25px; display: block;">🔄</span>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px; color: var(--navy);">Multimodal</h3>
                    <p style="color: #666; line-height: 1.6; font-size: 0.9rem;">Seamless sea-air-land logistics integration.</p>
                </div>
                <div style="background: white; padding: 40px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05); text-align: center;">
                    <span style="font-size: 3rem; margin-bottom: 25px; display: block;">🏗️</span>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px; color: var(--navy);">Project Cargo</h3>
                    <p style="color: #666; line-height: 1.6; font-size: 0.9rem;">Heavy lift and oversized cargo specialized solutions.</p>
                </div>
                <div style="background: white; padding: 40px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05); text-align: center;">
                    <span style="font-size: 3rem; margin-bottom: 25px; display: block;">🏪</span>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px; color: var(--navy);">Warehousing</h3>
                    <p style="color: #666; line-height: 1.6; font-size: 0.9rem;">Secure storage and efficient last-mile delivery.</p>
                </div>
                <div style="background: white; padding: 40px; border-radius: 16px; transition: var(--transition); box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,33,71,0.05); text-align: center;">
                    <span style="font-size: 3rem; margin-bottom: 25px; display: block;">♻️</span>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px; color: var(--navy);">Reverse Logistics</h3>
                    <p style="color: #666; line-height: 1.6; font-size: 0.9rem;">Streamlined return and recycling processes.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-white">
        <div class="container">
            <div style="text-align: center; margin-bottom: 60px;">
                <span class="section-tag">Value Proposition</span>
                <h2 style="font-size: 2.8rem; color: var(--navy);">Why Partner with Merchands Logistics?</h2>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
                <div>
                    <h4 style="color: var(--gold); margin-bottom: 15px; font-size: 1.2rem; font-weight: 700;">Single-Window Solutions</h4>
                    <p style="color: #666; line-height: 1.7;">End-to-end logistics coordination from initial pick-up to final doorstep delivery, ensuring a hassle-free experience.</p>
                </div>
                <div>
                    <h4 style="color: var(--gold); margin-bottom: 15px; font-size: 1.2rem; font-weight: 700;">Direct Customs Control</h4>
                    <p style="color: #666; line-height: 1.7;">Leveraging in-house licensed brokerage partners for rapid clearance without the delays of traditional middlemen.</p>
                </div>
                <div>
                    <h4 style="color: var(--gold); margin-bottom: 15px; font-size: 1.2rem; font-weight: 700;">Strategic Global Ties</h4>
                    <p style="color: #666; line-height: 1.7;">Strong, long-standing relationships with major airlines and port authorities worldwide for priority space and competitive rates.</p>
                </div>
                <div>
                    <h4 style="color: var(--gold); margin-bottom: 15px; font-size: 1.2rem; font-weight: 700;">Ethical & Transparent</h4>
                    <p style="color: #666; line-height: 1.7;">Zero hidden costs and 100% compliance with international trade laws, ensuring your business is always protected.</p>
                </div>
                <div>
                    <h4 style="color: var(--gold); margin-bottom: 15px; font-size: 1.2rem; font-weight: 700;">Global Partner Network</h4>
                    <p style="color: #666; line-height: 1.7;">An extensive international presence with vetted partners in every major trade hub across the globe.</p>
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
