<?php get_header(); ?>

    <!-- ===== PROGRAMS PAGE ===== -->
    <section class="section tc-directory-section" id="treatment-centres">
      <div class="container">
        <div class="section-heading text-left" data-reveal>
          <div class="tc-eyebrow">
            <span class="tc-eyebrow-dot"></span>
            <span data-i18n="tc_eyebrow">National Care Partners</span>
          </div>
          <h1 class="tc-heading" data-i18n="treatment_heading"><?php echo esc_html(cha_get_option('programs_heading', 'Treatment Centres')); ?></h1>
          <p class="tc-sub" data-i18n="treatment_sub"><?php echo esc_html(cha_get_option('programs_sub', 'Find haemophilia treatment centres across Cambodia — search by province.')); ?></p>
        </div>

        <!-- Filter Toolbar -->
        <div class="tc-toolbar" data-reveal>
          <div class="tc-toolbar-filter">
            <div class="tc-select-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <select class="tc-custom-select" id="province" data-province-select aria-label="Select Province">
              <option value="" data-i18n="tc_select_all"><?php echo esc_html(cha_get_option('programs_select_all', 'All Provinces')); ?> (Nationwide)</option>
              <option value="phnom-penh" data-i18n="province_phnom_penh">Phnom Penh</option>
              <option value="siem-reap" data-i18n="province_siem_reap">Siem Reap</option>
            </select>
          </div>
          <div class="tc-badge-counter">
            <span class="pulse-counter"></span>
            <span data-i18n="tc_active_badge">2 Verified Centres Active</span>
          </div>
        </div>

        <!-- Treatment Centres List -->
        <div class="tc-cards-list">
          <!-- Hospital 1: NPH Phnom Penh -->
          <article class="tc-card" data-province="phnom-penh" data-reveal>
            <div class="tc-img-wrap">
              <img src="<?php echo esc_url(cha_get_option('hospital_1_img', get_template_directory_uri() . '/hospital-1.jpg')); ?>" alt="National Pediatric Hospital" class="tc-img" />
              <span class="tc-province-pill" data-i18n="province_phnom_penh">Phnom Penh</span>
            </div>
            <div class="tc-content">
              <div class="tc-header-row">
                <div>
                  <h2 class="tc-title" data-i18n="tc_nph_title">National Pediatric Hospital (NPH) — Haemophilia Clinic</h2>
                  <div class="tc-meta-row">
                    <span class="tc-meta-item">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                      <span data-i18n="tc_nph_address">100 Russian Blvd, Phnom Penh</span>
                    </span>
                    <span class="tc-meta-sep">•</span>
                    <span class="tc-meta-item">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                      <span data-i18n="tc_nph_hours">Mon – Fri: 8:00 AM – 4:30 PM</span>
                    </span>
                  </div>
                </div>
              </div>

              <div class="tc-tags-row">
                <span class="tc-tag specialty" data-i18n="tc_tag_haem_ab">Haemophilia A &amp; B</span>
                <span class="tc-tag" data-i18n="tc_tag_vwd_care">VWD Care</span>
                <span class="tc-tag" data-i18n="tc_tag_consultation">Consultation</span>
                <span class="tc-tag" data-i18n="tc_tag_diagnostic">Diagnostic Lab</span>
              </div>

              <div class="tc-actions-row">
                <a class="tc-btn-map" href="https://maps.google.com/?q=National+Pediatric+Hospital+Phnom+Penh" target="_blank" rel="noopener noreferrer" data-i18n="treatment_view_map">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/><line x1="9" y1="3" x2="9" y2="18"/><line x1="15" y1="6" x2="15" y2="21"/></svg>
                  <span><?php echo esc_html(cha_get_option('programs_view_map', 'View on Map')); ?></span>
                  <span class="arrow">→</span>
                </a>
                <a class="tc-btn-call" href="tel:012751728">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                  <span>012 751 728</span>
                </a>
              </div>
            </div>
          </article>

          <!-- Hospital 2: AHC Siem Reap -->
          <article class="tc-card" data-province="siem-reap" data-reveal>
            <div class="tc-img-wrap">
              <img src="<?php echo esc_url(cha_get_option('hospital_2_img', get_template_directory_uri() . '/hospital-2.jpg')); ?>" alt="Angkor Hospital for Children" class="tc-img" />
              <span class="tc-province-pill" data-i18n="province_siem_reap">Siem Reap</span>
            </div>
            <div class="tc-content">
              <div class="tc-header-row">
                <div>
                  <h2 class="tc-title" data-i18n="tc_ahc_title">Angkor Hospital for Children (AHC) — Haemophilia Unit</h2>
                  <div class="tc-meta-row">
                    <span class="tc-meta-item">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                      <span data-i18n="tc_ahc_address">Tep Vong St, Siem Reap</span>
                    </span>
                    <span class="tc-meta-sep">•</span>
                    <span class="tc-meta-item">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                      <span data-i18n="tc_ahc_hours">Mon – Sun: 24h Inpatient</span>
                    </span>
                  </div>
                </div>
              </div>

              <div class="tc-tags-row">
                <span class="tc-tag specialty" data-i18n="tc_tag_haem_ab">Haemophilia A &amp; B</span>
                <span class="tc-tag" data-i18n="tc_tag_factor_rep">Factor Replacement</span>
                <span class="tc-tag" data-i18n="tc_tag_family_counselling">Family Counselling</span>
              </div>

              <div class="tc-actions-row">
                <a class="tc-btn-map" href="https://maps.google.com/?q=Angkor+Hospital+for+Children+Siem+Reap" target="_blank" rel="noopener noreferrer" data-i18n="treatment_view_map">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/><line x1="9" y1="3" x2="9" y2="18"/><line x1="15" y1="6" x2="15" y2="21"/></svg>
                  <span><?php echo esc_html(cha_get_option('programs_view_map', 'View on Map')); ?></span>
                  <span class="arrow">→</span>
                </a>
                <a class="tc-btn-call" href="tel:012794685">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                  <span>012 794 685</span>
                </a>
              </div>
            </div>
          </article>
        </div>

        <!-- Emergency Care Banner -->
        <div class="emergency-banner-v2" data-reveal>
          <div class="emergency-banner-left">
            <div class="emergency-pulse-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
            <div>
              <h3 class="emergency-title" data-i18n="treatment_emergency"><?php echo esc_html(cha_get_option('emergency_heading', 'Emergency Bleeding Support')); ?></h3>
              <p class="emergency-desc" data-i18n="treatment_emergency_desc"><?php echo esc_html(cha_get_option('emergency_text', 'If you or a loved one experience an acute bleed, call our direct 24/7 helpline or proceed to the nearest emergency unit immediately.')); ?></p>
            </div>
          </div>
          <a class="emergency-phone-btn" href="tel:+855962605335">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <span><?php echo esc_html(cha_get_option('emergency_phone', '(+855) 96 260 5335')); ?></span>
          </a>
        </div>
      </div>
    </section>

    <section class="section" id="csr"><div class="container">
      <div class="section-heading" data-reveal><h2 data-i18n="csr_heading"><?php echo esc_html(cha_get_option('csr_heading', 'CSR Program')); ?></h2><p data-i18n="csr_sub"><?php echo esc_html(cha_get_option('csr_sub', 'Fundraising, donations, and corporate partnerships that power our mission.')); ?></p></div>
      <div class="csr-grid">
        <div class="csr-block csr-blue" id="csr-fundraising" data-reveal>
          <div class="csr-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg></div>
          <h3 data-i18n="csr_fundraising"><?php echo esc_html(cha_get_option('csr_1_title', 'Fundraising')); ?></h3>
          <p data-i18n="csr_fundraising_desc"><?php echo esc_html(cha_get_option('csr_1_desc', 'Raising funds through community drives, events, and partner campaigns that keep our programs running.')); ?></p>
          <a class="csr-btn csr-btn-blue" href="<?php echo esc_url(get_post_type_archive_link('cha_campaigns')); ?>" data-i18n="csr_view_campaigns"><?php echo esc_html(cha_get_option('csr_1_link', 'View campaigns')); ?> <span class="arrow">→</span></a>
        </div>
        <div class="csr-block csr-red" id="csr-donate" data-reveal>
          <div class="csr-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
          <h3 data-i18n="csr_donate_online"><?php echo esc_html(cha_get_option('csr_2_title', 'Online donation')); ?></h3>
          <p data-i18n="csr_donate_online_desc"><?php echo esc_html(cha_get_option('csr_2_desc', 'Donate securely via PayWay (ABA Bank) — every contribution changes lives across Cambodia.')); ?></p>
          <a class="csr-btn csr-btn-red" href="#" data-donate-trigger data-i18n="csr_donate_now"><?php echo esc_html(cha_get_option('csr_2_link', 'Donate now')); ?> <span class="arrow">→</span></a>
        </div>
        <div class="csr-block csr-purple" id="csr-partners" data-reveal>
          <div class="csr-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></div>
          <h3 data-i18n="csr_partners_title"><?php echo esc_html(cha_get_option('csr_3_title', 'Corporate Partners')); ?></h3>
          <p data-i18n="csr_partners_desc"><?php echo esc_html(cha_get_option('csr_3_desc', 'Trusted organisations that support our mission and amplify our reach nationwide.')); ?></p>
          <a class="csr-btn csr-btn-purple" href="<?php echo home_url('/#contact'); ?>" data-i18n="csr_become_partner"><?php echo esc_html(cha_get_option('csr_3_link', 'Become a partner')); ?> <span class="arrow">→</span></a>
        </div>
      </div>
    </div></section>

  </main>

  <?php get_footer(); ?>
