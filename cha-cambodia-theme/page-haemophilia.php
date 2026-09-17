<?php get_header(); ?>

    <!-- ===== ABOUT HAEMOPHILIA PAGE ===== -->
    <div class="section haem-hero-section" id="haemophilia">
      <div class="container">
        <div class="haem-hero-card" data-reveal>
          <div class="haem-hero-grid">
            <div class="haem-hero-content">
              <div class="haem-eyebrow">
                <span class="haem-eyebrow-pulse"></span>
                <span data-i18n="haem_eyebrow">Genetic Bleeding Condition</span>
              </div>
              <h1 class="haem-hero-title" data-i18n="haem_heading"><?php echo esc_html(cha_get_option('haem_intro_heading', 'What is Haemophilia?')); ?></h1>
              <p class="haem-hero-p primary" data-i18n="haem_para_1"><?php echo esc_html(cha_get_option('haem_intro_p1', "Haemophilia is a rare genetic bleeding disorder that affects a person's ability to stop bleeding. People with haemophilia can bleed longer than others after an injury or even without a known cause.")); ?></p>
              <p class="haem-hero-p secondary" data-i18n="haem_para_2"><?php echo esc_html(cha_get_option('haem_intro_p2', 'While there is no cure, modern treatments allow people with haemophilia to live full, active and healthy lives. Early diagnosis, proper treatment and ongoing support are key to preventing complications and joint damage.')); ?></p>

              <div class="haem-btn-row">
                <a class="btn btn-primary" href="<?php echo home_url('/#contact'); ?>" data-i18n="haem_contact"><?php echo esc_html(cha_get_option('haem_intro_btn', 'Contact a Specialist')); ?> <span class="arrow">→</span></a>
              </div>
            </div>

            <!-- Photorealistic 3D Coagulation Biology Showcase -->
            <div class="haem-media-col">
              <div class="haem-media-card">
                <div class="haem-media-frame">
                  <img src="<?php echo esc_url(cha_get_option('haem_hero_img', get_template_directory_uri() . '/haemophilia-clot-science.jpg')); ?>" alt="Haemophilia Blood Clotting Factor Biology" class="haem-science-img" />
                  <div class="haem-media-overlay"></div>
                  <div class="haem-floating-badge">
                    <div class="haem-badge-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/></svg>
                    </div>
                    <div class="haem-badge-text">
                      <strong data-i18n="haem_clot_title">Clotting Cascade Deficiency</strong>
                      <span data-i18n="haem_clot_desc">Factor VIII (A) & Factor IX (B) Coagulation Mesh</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section" id="types"><div class="container">
      <div class="section-heading" data-reveal><h2 data-i18n="types_heading"><?php echo esc_html(cha_get_option('haem_types_heading', 'Types of Haemophilia')); ?></h2><p data-i18n="types_sub"><?php echo esc_html(cha_get_option('haem_types_sub', 'The two main types of haemophilia — both require proper diagnosis and lifelong management.')); ?></p></div>
      <div class="grid grid-2">
        <div class="type-card" data-reveal><div class="type-card-icon"><svg class="drop" viewBox="0 0 56 64" aria-hidden="true"><path d="M28 4 C 16 24, 8 38, 8 48 C 8 58, 18 64, 28 64 C 38 64, 48 58, 48 48 C 48 38, 40 24, 28 4 Z" fill="#E31E24"/><ellipse cx="20" cy="32" rx="4" ry="7" fill="rgba(255,255,255,0.4)"/></svg></div><div class="type-card-body"><h3 data-i18n="types_a_title"><?php echo esc_html(cha_get_option('haem_type_a_title', 'Haemophilia A')); ?></h3><p data-i18n="types_a_desc"><?php echo esc_html(cha_get_option('haem_type_a_desc', 'Caused by a deficiency of factor VIII. The most common type.')); ?></p></div></div>
        <div class="type-card" data-reveal><div class="type-card-icon"><svg class="drop" viewBox="0 0 56 64" aria-hidden="true"><path d="M28 4 C 16 24, 8 38, 8 48 C 8 58, 18 64, 28 64 C 38 64, 48 58, 48 48 C 48 38, 40 24, 28 4 Z" fill="#0B1D6D"/><ellipse cx="20" cy="32" rx="4" ry="7" fill="rgba(255,255,255,0.4)"/></svg></div><div class="type-card-body"><h3 data-i18n="types_b_title"><?php echo esc_html(cha_get_option('haem_type_b_title', 'Haemophilia B')); ?></h3><p data-i18n="types_b_desc"><?php echo esc_html(cha_get_option('haem_type_b_desc', 'Caused by a deficiency of factor IX. Sometimes called Christmas disease.')); ?></p></div></div>
      </div>
    </div></div>

    <div class="section symptoms-section" id="symptoms">
      <div class="container">
        <div class="symptoms-showcase-container" data-reveal>
          <div class="symptoms-header">
            <div class="symptoms-eyebrow">
              <span class="symptoms-eyebrow-dot"></span>
              <span data-i18n="symptoms_eyebrow">Clinical Indicators</span>
            </div>
            <h2 class="symptoms-title" data-i18n="symptoms_heading"><?php echo esc_html(cha_get_option('haem_symptoms_heading', 'Common Symptoms')); ?></h2>
            <p class="symptoms-subtitle" data-i18n="symptoms_sub"><?php echo esc_html(cha_get_option('haem_symptoms_sub', 'Recognizing the signs of a bleeding disorder is the first step toward diagnosis and proper care.')); ?></p>
          </div>

          <div class="symptoms-grid-v2">
            <div class="symptom-card-v2" data-reveal>
              <div class="symptom-card-top">
                <div class="symptom-icon-box">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                </div>
                <span class="symptom-badge" data-i18n="symptom_sign_1">Sign 01</span>
              </div>
              <h3 class="symptom-label" data-i18n="symptom_bruising"><?php echo esc_html(cha_get_option('symptom_1_title', 'Easy Bruising')); ?></h3>
              <p class="symptom-hint" data-i18n="symptom_bruising_desc"><?php echo esc_html(cha_get_option('symptom_1_desc', 'Unexplained bruises from minor bumps or pressure.')); ?></p>
            </div>

            <div class="symptom-card-v2" data-reveal>
              <div class="symptom-card-top">
                <div class="symptom-icon-box">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2C8 2 6 5 6 8c0 4 6 12 6 12s6-8 6-12c0-3-2-6-6-6z"/><circle cx="12" cy="8" r="2"/></svg>
                </div>
                <span class="symptom-badge" data-i18n="symptom_sign_2">Sign 02</span>
              </div>
              <h3 class="symptom-label" data-i18n="symptom_nosebleeds"><?php echo esc_html(cha_get_option('symptom_2_title', 'Frequent Nosebleeds')); ?></h3>
              <p class="symptom-hint" data-i18n="symptom_nosebleeds_desc"><?php echo esc_html(cha_get_option('symptom_2_desc', 'Recurring nosebleeds that are hard to stop.')); ?></p>
            </div>

            <div class="symptom-card-v2" data-reveal>
              <div class="symptom-card-top">
                <div class="symptom-icon-box">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2v20M2 12h20"/><circle cx="12" cy="12" r="4"/></svg>
                </div>
                <span class="symptom-badge" data-i18n="symptom_sign_3">Sign 03</span>
              </div>
              <h3 class="symptom-label" data-i18n="symptom_gums"><?php echo esc_html(cha_get_option('symptom_3_title', 'Bleeding Gums')); ?></h3>
              <p class="symptom-hint" data-i18n="symptom_gums_desc"><?php echo esc_html(cha_get_option('symptom_3_desc', 'Gums that bleed during brushing or eating.')); ?></p>
            </div>

            <div class="symptom-card-v2" data-reveal>
              <div class="symptom-card-top">
                <div class="symptom-icon-box">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 18h8"/><path d="M3 22h18"/><path d="M14 22a7 7 0 1 0 0-14h-1"/><path d="M9 14h2"/><path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2z"/><path d="M12 6V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3"/></svg>
                </div>
                <span class="symptom-badge" data-i18n="symptom_sign_4">Sign 04</span>
              </div>
              <h3 class="symptom-label" data-i18n="symptom_joint"><?php echo esc_html(cha_get_option('symptom_4_title', 'Joint Pain or Swelling')); ?></h3>
              <p class="symptom-hint" data-i18n="symptom_joint_desc"><?php echo esc_html(cha_get_option('symptom_4_desc', 'Painful, swollen joints after minor injury or activity.')); ?></p>
            </div>

            <div class="symptom-card-v2" data-reveal>
              <div class="symptom-card-top">
                <div class="symptom-icon-box">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <span class="symptom-badge" data-i18n="symptom_sign_5">Sign 05</span>
              </div>
              <h3 class="symptom-label" data-i18n="symptom_prolonged"><?php echo esc_html(cha_get_option('symptom_5_title', 'Prolonged Bleeding')); ?></h3>
              <p class="symptom-hint" data-i18n="symptom_prolonged_desc"><?php echo esc_html(cha_get_option('symptom_5_desc', 'Bleeding that lasts longer than expected after cuts.')); ?></p>
            </div>
          </div>

          <div class="symptoms-banner-cta" data-reveal>
            <div class="symptoms-banner-content">
              <div class="symptoms-banner-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
              </div>
              <p class="symptoms-banner-text" data-i18n="symptom_cta"><?php echo esc_html(cha_get_option('symptoms_cta', 'Experiencing any of these symptoms? Early diagnosis can make a life-changing difference.')); ?></p>
            </div>
            <div class="symptoms-banner-actions">
              <a class="btn btn-primary" href="<?php echo home_url('/programs'); ?>#treatment-centres" data-i18n="symptom_find_centre"><?php echo esc_html(cha_get_option('symptoms_btn_1', 'Find a Treatment Centre')); ?> <span class="arrow">→</span></a>
              <a class="btn btn-secondary" href="<?php echo home_url('/#contact'); ?>" data-i18n="symptom_contact_specialist"><?php echo esc_html(cha_get_option('symptoms_btn_2', 'Contact a Specialist')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="section vwd-section" id="vwd">
      <div class="container">
        <div class="vwd-showcase-card" data-reveal>
          <div class="vwd-grid">
            <div class="vwd-content-col">
              <div class="vwd-eyebrow">
                <span class="vwd-eyebrow-icon">
                  <svg viewBox="0 0 16 16" fill="currentColor"><circle cx="8" cy="8" r="4"/></svg>
                </span>
                <span data-i18n="vwd_eyebrow">Most Common Bleeding Disorder</span>
              </div>
              <h2 class="vwd-title" data-i18n="vwd_heading"><?php echo esc_html(str_replace('(VWD)', '', str_replace('(vwd)', '', cha_get_option('vwd_heading', 'Von Willebrand Disease')))); ?></h2>
              <p class="vwd-lead" data-i18n="vwd_para_1"><?php echo esc_html(cha_get_option('vwd_p1', 'Von Willebrand Disease is the most common inherited bleeding disorder, affecting both males and females equally. It is caused by a deficiency or dysfunction of von Willebrand factor, a protein that helps blood clot.')); ?></p>
              <p class="vwd-desc" data-i18n="vwd_para_2"><?php echo esc_html(cha_get_option('vwd_p2', 'There are three main types of VWD — Type 1 (mild), Type 2 (moderate), and Type 3 (severe). Treatment focuses on managing bleeding episodes and may include desmopressin or factor replacement therapy.')); ?></p>

              <div class="vwd-actions">
                <a class="btn btn-secondary vwd-btn-action" href="<?php echo home_url('/programs'); ?>#treatment-centres" data-i18n="vwd_find"><?php echo esc_html(cha_get_option('vwd_btn', 'Find Treatment')); ?> <span class="arrow">→</span></a>
                <span class="vwd-action-note" data-i18n="vwd_action_note">Affects up to 1% of the world's population</span>
              </div>
            </div>

            <!-- VWD Scientific Biomedical Visual Showcase -->
            <div class="vwd-media-col">
              <div class="vwd-media-card">
                <div class="vwd-media-image-frame">
                  <img src="<?php echo esc_url(cha_get_option('vwd_img', get_template_directory_uri() . '/vwd-factor-science.jpg')); ?>" alt="Von Willebrand Factor Coagulation Science" class="vwd-science-img" />
                  <div class="vwd-media-overlay"></div>
                  <div class="vwd-floating-chip">
                    <div class="vwd-chip-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M2 12h20"/><circle cx="12" cy="12" r="4"/></svg>
                    </div>
                    <div class="vwd-chip-text">
                      <strong data-i18n="vwd_chip_title">Von Willebrand Factor (VWF)</strong>
                      <span data-i18n="vwd_chip_desc">Platelet Adhesion & Factor VIII Stabilizer</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section" id="other-bleeding"><div class="container">
      <div class="section-heading" data-reveal><h2 data-i18n="other_heading"><?php echo esc_html(cha_get_option('other_heading', 'Other Bleeding Disorders')); ?></h2></div>
      <div class="grid grid-2">
        <div class="type-card" data-reveal><div class="type-card-icon"><svg class="drop" viewBox="0 0 56 64" aria-hidden="true"><path d="M28 4 C 16 24, 8 38, 8 48 C 8 58, 18 64, 28 64 C 38 64, 48 58, 48 48 C 48 38, 40 24, 28 4 Z" fill="#6A2C91"/><ellipse cx="20" cy="32" rx="4" ry="7" fill="rgba(255,255,255,0.4)"/></svg></div><div class="type-card-body"><h3 data-i18n="other_rare_title"><?php echo esc_html(cha_get_option('other_1_title', 'Rare Factor Deficiencies')); ?></h3><p data-i18n="other_rare_desc"><?php echo esc_html(cha_get_option('other_1_desc', 'Deficiencies in factors I, II, V, VII, X, XI, XII and XIII. Each requires specific diagnosis and treatment.')); ?></p></div></div>
        <div class="type-card" data-reveal><div class="type-card-icon"><svg class="drop" viewBox="0 0 56 64" aria-hidden="true"><path d="M28 4 C 16 24, 8 38, 8 48 C 8 58, 18 64, 28 64 C 38 64, 48 58, 48 48 C 48 38, 40 24, 28 4 Z" fill="#B45309"/><ellipse cx="20" cy="32" rx="4" ry="7" fill="rgba(255,255,255,0.4)"/></svg></div><div class="type-card-body"><h3 data-i18n="other_platelet_title"><?php echo esc_html(cha_get_option('other_2_title', 'Platelet Function Disorders')); ?></h3><p data-i18n="other_platelet_desc"><?php echo esc_html(cha_get_option('other_2_desc', "Conditions where platelets don't work properly, leading to bleeding despite normal platelet counts.")); ?></p></div></div>
      </div>
      <p style="text-align:center;margin-top:var(--s-6);color:var(--c-muted)" data-i18n="other_more"><?php echo esc_html(cha_get_option('other_footer', 'For more information on any bleeding disorder, contact our team or visit a treatment centre.')); ?></p>
    </div></section>

  </main>

  <?php get_footer(); ?>
