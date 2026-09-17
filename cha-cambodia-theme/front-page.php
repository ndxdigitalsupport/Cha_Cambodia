<?php get_header(); ?>


    <!-- ===== HOME ===== -->
    <section class="hero" id="home">
      <div class="hero-art-stage">
        <div class="hero-ambient-glow" aria-hidden="true"></div>
        <img class="hero-bg hero-ambient-float" src="<?php echo esc_url(cha_get_option('hero_image', get_template_directory_uri() . '/Heroo.png')); ?>" alt="">
      </div>
      <div class="hero-overlay"></div>
      <div class="container hero-content">
        <div class="hero-stagger-box">
          <h1 class="hero-title-stagger">
            <span class="hero-anim-item hero-anim-1"><span class="accent-blue" data-i18n="hero_title_1"><?php echo esc_html(cha_get_option('hero_title_1', 'Together We Care.')); ?></span></span><br>
            <span class="hero-anim-item hero-anim-2"><span class="accent-red" data-i18n="hero_title_2"><?php echo esc_html(cha_get_option('hero_title_2', 'Together We Change Lives.')); ?></span></span>
          </h1>
          <p class="lead hero-anim-item hero-anim-3" data-i18n="hero_lead"><?php echo esc_html(cha_get_option('hero_lead', 'Supporting and empowering people with bleeding disorders across Cambodia.')); ?></p>
          <div class="cta-row hero-anim-item hero-anim-4">
            <a class="btn btn-hero-primary btn-lg" href="<?php echo home_url('/haemophilia'); ?>" data-i18n="hero_cta_support"><?php echo esc_html(cha_get_option('hero_cta_support', 'Get Support')); ?> <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
            <a class="btn btn-hero-member btn-lg" href="#" data-member-register-trigger data-i18n="nav_become_member"><?php echo esc_html(cha_get_option('hero_cta_member', 'Become a Member')); ?></a>
          </div>
        </div>
      </div>
      <svg class="hero-wave" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#EAF0FB"/>
      </svg>
    </section>

    <!-- Stat strip (white card overlaid on hero) -->
    <section class="container" style="position:relative;margin-top:-80px;z-index:5;padding-bottom:0"><div class="stat-strip stat-strip-light stat-strip-animated" data-reveal><div class="container">
      <div class="stat stat-hover-lift"><div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div><div class="stat-text"><span class="value" data-counter-target="25"><?php echo esc_html(cha_get_option('stat_provinces_val', '25')); ?></span><span class="label" data-i18n="stat_provinces"><?php echo esc_html(cha_get_option('stat_provinces_lbl', 'Provinces and Cities')); ?></span></div></div>
      <div class="stat stat-hover-lift"><div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div><div class="stat-text"><span class="value" data-counter-target="500" data-counter-suffix="+"><?php echo esc_html(cha_get_option('stat_patients_val', '500+')); ?></span><span class="label" data-i18n="stat_patients"><?php echo esc_html(cha_get_option('stat_patients_lbl', 'Hemophilia Patients')); ?></span></div></div>
      <div class="stat stat-hover-lift"><div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></div><div class="stat-text"><span class="value" data-counter-target="15" data-counter-suffix="+"><?php echo esc_html(cha_get_option('stat_partners_val', '15+')); ?></span><span class="label" data-i18n="stat_partners"><?php echo esc_html(cha_get_option('stat_partners_lbl', 'Healthcare Partners')); ?></span></div></div>
    </div></div></section>

    <!-- How We Help -->
    <section class="section section-blue-soft" id="help"><div class="container">
      <div class="section-heading" data-reveal><h2 data-i18n="help_heading"><?php echo esc_html(cha_get_option('help_heading', 'How We Help')); ?></h2><p data-i18n="help_sub"><?php echo esc_html(cha_get_option('help_sub', 'Four core areas where CHA makes a difference for patients and families across Cambodia.')); ?></p></div>
      <div class="grid grid-4 grid-stagger-cards">
        <div class="help-card card-stagger-1" data-reveal><div class="icon icon-blue"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div><h3 data-i18n="help_patient_support"><?php echo esc_html(cha_get_option('help_card_1_title', 'Patient Support')); ?></h3><p data-i18n="help_patient_support_desc"><?php echo esc_html(cha_get_option('help_card_1_desc', 'Emotional support, guidance and community for patients and families.')); ?></p><a class="card-link" href="<?php echo home_url('/about'); ?>" data-i18n="help_learn_more">Learn More <span class="arrow">→</span></a></div>
        <div class="help-card card-stagger-2" data-reveal><div class="icon icon-red"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div><h3 data-i18n="help_treatment"><?php echo esc_html(cha_get_option('help_card_2_title', 'Treatment Centres')); ?></h3><p data-i18n="help_treatment_desc"><?php echo esc_html(cha_get_option('help_card_2_desc', 'Find haemophilia treatment centres near you and get the care you need.')); ?></p><a class="card-link" href="<?php echo home_url('/programs'); ?>" data-i18n="help_learn_more">Learn More <span class="arrow">→</span></a></div>
        <div class="help-card card-stagger-3" data-reveal><div class="icon icon-purple"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg></div><h3 data-i18n="help_become_member"><?php echo esc_html(cha_get_option('help_card_3_title', 'Become a Member')); ?></h3><p data-i18n="help_become_member_desc"><?php echo esc_html(cha_get_option('help_card_3_desc', 'Join our community and access exclusive resources and programs.')); ?></p><a class="card-link" href="#membership" data-i18n="help_join_now">Join Now <span class="arrow">→</span></a></div>
        <div class="help-card card-stagger-4" data-reveal><div class="icon icon-green"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></div><h3 data-i18n="help_donate"><?php echo esc_html(cha_get_option('help_card_4_title', 'Donate')); ?></h3><p data-i18n="help_donate_desc"><?php echo esc_html(cha_get_option('help_card_4_desc', 'Your support helps us provide treatment, education and hope.')); ?></p><a class="card-link" href="#" data-donate-trigger data-i18n="help_donate_now">Donate Now <span class="arrow">→</span></a></div>
      </div>
    </div></section>

    <!-- News section -->
    <section class="section section-soft" id="news-events"><div class="container">
      <div class="section-heading flex-between" data-reveal>
        <div>
          <h2 data-i18n="news_heading"><?php esc_html_e('Latest News & Events', 'cha-cambodia'); ?></h2>
          <p data-i18n="news_sub"><?php esc_html_e('Updates from our community awareness, treatment guidelines and training programs.', 'cha-cambodia'); ?></p>
        </div>
        <a class="btn btn-outline btn-sm" href="<?php echo esc_url(get_post_type_archive_link('cha_news')); ?>" data-i18n="news_view_all"><?php esc_html_e('View All', 'cha-cambodia'); ?> <span class="arrow">&rarr;</span></a>
      </div>
      <div class="grid grid-3">
        <?php
        $news_query = new WP_Query(array(
            'post_type'      => 'cha_news',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ));
        if ($news_query->have_posts()) :
            while ($news_query->have_posts()) : $news_query->the_post();
                $date_display = get_post_meta(get_the_ID(), '_cha_news_date', true);
                $badge = get_post_meta(get_the_ID(), '_cha_news_badge', true);
                if (!$date_display) $date_display = get_the_date('M j, Y');
                if (!$badge) $badge = 'Event';
                $badge_class = 'badge-' . strtolower($badge);
                ?>
                <article class="card news-card" data-reveal>
                  <div class="card-img">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('medium_large'); ?>
                    <?php else : ?>
                      <img src="<?php echo esc_url(get_template_directory_uri() . '/news-event-1.jpg'); ?>" alt="">
                    <?php endif; ?>
                    <div class="card-date">
                      <span><?php echo esc_html($date_display); ?></span>
                      <span class="badge <?php echo esc_attr($badge_class); ?> auto-text" data-en="<?php echo esc_attr($badge); ?>" data-km="" data-i18n="news_badge_<?php echo esc_attr(strtolower($badge)); ?>"><?php echo esc_html($badge); ?></span>
                    </div>
                  </div>
                  <div class="card-body">
                    <?php
                    $news_title = get_the_title();
                    $news_km_title = get_post_meta(get_the_ID(), '_cha_news_title_km', true);
                    $news_excerpt = get_the_excerpt();
                    if (strlen($news_excerpt) > 120) $news_excerpt = wp_trim_words($news_excerpt, 18, '...');
                    $news_km_excerpt = get_post_meta(get_the_ID(), '_cha_news_excerpt_km', true);
                    ?>
                    <h3 class="card-title auto-text" data-en="<?php echo esc_attr($news_title); ?>" data-km="<?php echo esc_attr($news_km_title); ?>"><?php the_title(); ?></h3>
                    <p class="card-text auto-text" data-en="<?php echo esc_attr($news_excerpt); ?>" data-km="<?php echo esc_attr($news_km_excerpt); ?>"><?php echo esc_html($news_excerpt); ?></p>
                    <a class="card-link" href="<?php the_permalink(); ?>" data-i18n="news_read_more"><?php esc_html_e('Read More', 'cha-cambodia'); ?> <span class="arrow">&rarr;</span></a>
                  </div>
                </article>
            <?php endwhile;
            wp_reset_postdata();
        else :
            for ($i = 0; $i < 3; $i++) :
                $fallback_titles = array('World Haemophilia Day 2025 Community Awareness Event', 'New Treatment Guidelines Now Available in Cambodia', 'Training Workshop for Healthcare Professionals');
                $fallback_descs = array('Join us for our annual awareness day in Phnom Penh.', 'Updated clinical guidelines for haemophilia management.', 'Hands-on workshop covering diagnosis and treatment.');
                $fallback_dates = array('Apr 17, 2025', 'Apr 16, 2025', 'Apr 12, 2025');
                $fallback_badges = array('Event', 'Update', 'Workshop');
                $fallback_imgs = array('news-event-1.jpg', 'news-update-1.jpg', 'doctor training.png');
                ?>
                <article class="card news-card" data-reveal>
                  <div class="card-img">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/' . $fallback_imgs[$i]); ?>" alt="">
                    <div class="card-date">
                      <span><?php echo esc_html($fallback_dates[$i]); ?></span>
                      <span class="badge badge-<?php echo esc_attr(strtolower($fallback_badges[$i])); ?>"><?php echo esc_html($fallback_badges[$i]); ?></span>
                    </div>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title auto-text" data-en="<?php echo esc_attr($fallback_titles[$i]); ?>" data-km=""><?php echo esc_html($fallback_titles[$i]); ?></h3>
                    <p class="card-text auto-text" data-en="<?php echo esc_attr($fallback_descs[$i]); ?>" data-km=""><?php echo esc_html($fallback_descs[$i]); ?></p>
                    <a class="card-link" href="<?php echo esc_url(get_post_type_archive_link('cha_news')); ?>" data-i18n="news_read_more"><?php esc_html_e('Read More', 'cha-cambodia'); ?> <span class="arrow">&rarr;</span></a>
                  </div>
                </article>
            <?php endfor;
        endif;
        ?>
      </div>
    </div></section>

    <!-- Red CTA banner (full width, separate section) -->
    <section class="section"><div class="container"><div class="cta-banner" data-reveal>
      <div class="cta-banner-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
      </div>
      <div class="cta-banner-text">
        <h2 data-i18n="cta_heading"><?php echo esc_html(cha_get_option('cta_heading', 'Help Change Lives')); ?></h2>
        <p data-i18n="cta_sub"><?php echo esc_html(cha_get_option('cta_sub', 'Your donation helps us provide treatment, education and hope to people with bleeding disorders in Cambodia.')); ?></p>
      </div>
      <a class="btn btn-light btn-lg" href="#" data-donate-trigger data-i18n="cta_donate"><?php echo esc_html(cha_get_option('cta_btn', 'Donate Now')); ?> <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div></div></section>

    <!-- ===== ABOUT US (condensed) ===== -->
    <section class="page-hero" id="about"><div class="container">
      <div data-reveal>
        <h1 data-i18n="about_heading"><?php echo esc_html(cha_get_option('about_heading', 'Who is CHA?')); ?></h1>
        <p class="lead" data-i18n="about_lead"><?php echo esc_html(cha_get_option('about_lead', 'The Cambodian Haemophilia Association is a patient-led organization dedicated to improving the quality of life for people living with bleeding disorders across Cambodia.')); ?></p>
        <div class="vm-cards">
          <div class="vm-card vm-card-vision" data-reveal>
            <div class="vm-glow-orb glow-blue"></div>
            <div class="vm-body">
              <span class="vm-label" data-i18n="about_vision_label"><?php echo esc_html(cha_get_option('about_vision_label', 'Our Vision')); ?></span>
              <p data-i18n="about_vision_text"><?php echo esc_html(cha_get_option('about_vision_text', 'A Cambodia where every person with a bleeding disorder has access to diagnosis, treatment, and support.')); ?></p>
            </div>
          </div>
          <div class="vm-card vm-card-mission" data-reveal>
            <div class="vm-glow-orb glow-red"></div>
            <div class="vm-body">
              <span class="vm-label" data-i18n="about_mission_label"><?php echo esc_html(cha_get_option('about_mission_label', 'Our Mission')); ?></span>
              <p data-i18n="about_mission_text"><?php echo esc_html(cha_get_option('about_mission_text', 'To advocate for quality care, educate communities, support families, and empower caregivers.')); ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="page-hero-art" data-reveal>
        <div class="page-art-frame">
          <div class="page-art">
            <img src="<?php echo esc_url(cha_get_option('about_team_img', get_template_directory_uri() . '/about-team.jpg')); ?>" alt="CHA leadership and team">
            <div class="page-art-badge">
              <div class="page-art-badge-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              </div>
              <div>
                <div class="badge-title" data-i18n="about_badge_title">Patient-Led NGO</div>
                <div class="badge-sub" data-i18n="about_badge_sub">Est. 2011 · WFH Member</div>
              </div>
            </div>
          </div>
          <div class="frame-tag frame-tag-top">
            <span class="pulse-dot"></span>
            <span data-i18n="about_frame_tag">Est. 2011 · Phnom Penh</span>
          </div>
        </div>
      </div>
    </div></section>

    <!-- ===== YOUR IMPACT ===== -->
    <div class="section"><div class="container">
      <div class="section-heading" data-reveal><h2 data-i18n="impact_heading"><?php echo esc_html(cha_get_option('impact_heading', 'Your Impact')); ?></h2></div>
      <div class="impact-grid">
        <div class="impact-card" data-reveal><div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div><p data-i18n="impact_treatment"><?php echo esc_html(cha_get_option('impact_1', 'Provide treatment access for patients')); ?></p></div>
        <div class="impact-card" data-reveal><div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg></div><p data-i18n="impact_education"><?php echo esc_html(cha_get_option('impact_2', 'Support education and awareness')); ?></p></div>
        <div class="impact-card" data-reveal><div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></div><p data-i18n="impact_healthcare"><?php echo esc_html(cha_get_option('impact_3', 'Strengthen healthcare capacity')); ?></p></div>
        <div class="impact-card" data-reveal><div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div><p data-i18n="impact_families"><?php echo esc_html(cha_get_option('impact_4', 'Empower families and communities')); ?></p></div>
      </div>
    </div></div>

    <!-- ===== MEMBERSHIP & DONATE ===== -->
    <div class="section section-soft" id="membership"><div class="container" data-tabs>
      <div class="tabs-nav csr-tabs" style="margin-bottom:var(--s-8)">
        <button class="tab-btn" type="button" data-tab-group data-tab-target="csr-member">Membership</button>
        <button class="tab-btn is-active" type="button" data-tab-group data-tab-target="csr-donate">Donate</button>
      </div>
      <div class="tab-panel" data-tab-panel="csr-member" style="padding-top:0">
        <div class="section-heading" data-reveal><h2 data-i18n="membership_heading"><?php echo esc_html(cha_get_option('membership_benefits_heading', 'Membership Benefits')); ?></h2></div>
        <div class="membership-benefits">
          <!-- Card 1: Community & Support -->
          <div class="membership-benefit-card" data-reveal>
            <div class="membership-benefit-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
              <h3 data-i18n="membership_benefit_1_title"><?php echo esc_html(cha_get_option('benefit_1_title', 'Community & Support')); ?></h3>
              <p data-i18n="membership_benefit_1_desc"><?php echo esc_html(cha_get_option('benefit_1_desc', 'Connect with patients, families, and caregivers across Cambodia.')); ?></p>
            </div>
          </div>

          <!-- Card 2: Access to Resources -->
          <div class="membership-benefit-card" data-reveal>
            <div class="membership-benefit-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
            </div>
            <div>
              <h3 data-i18n="membership_benefit_2_title"><?php echo esc_html(cha_get_option('benefit_2_title', 'Access to Resources')); ?></h3>
              <p data-i18n="membership_benefit_2_desc"><?php echo esc_html(cha_get_option('benefit_2_desc', 'Exclusive guides, educational materials, and treatment information.')); ?></p>
            </div>
          </div>

          <!-- Card 3: Events & Workshops -->
          <div class="membership-benefit-card" data-reveal>
            <div class="membership-benefit-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div>
              <h3 data-i18n="membership_benefit_3_title"><?php echo esc_html(cha_get_option('benefit_3_title', 'Events & Workshops')); ?></h3>
              <p data-i18n="membership_benefit_3_desc"><?php echo esc_html(cha_get_option('benefit_3_desc', 'Participate in hands-on workshops, community events, and online learning sessions.')); ?></p>
            </div>
          </div>

          <!-- Card 4: Advocacy & Awareness -->
          <div class="membership-benefit-card" data-reveal>
            <div class="membership-benefit-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 11l18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
            </div>
            <div>
              <h3 data-i18n="membership_benefit_4_title"><?php echo esc_html(cha_get_option('benefit_4_title', 'Advocacy & Awareness')); ?></h3>
              <p data-i18n="membership_benefit_4_desc"><?php echo esc_html(cha_get_option('benefit_4_desc', 'Help raise awareness and advocate for better care nationwide.')); ?></p>
            </div>
          </div>
        </div>
        <div class="membership-cta" data-reveal>
          <div class="membership-cta-content">
            <h2 data-i18n="membership_cta_title"><?php echo esc_html(cha_get_option('membership_cta_heading', 'Become a Member')); ?></h2>
            <p class="lead" data-i18n="membership_cta_sub"><?php echo esc_html(cha_get_option('membership_cta_text', 'Join our community to access exclusive resources, events, and peer support across Cambodia.')); ?></p>
            <div class="membership-features">
              <div class="feature" data-i18n="membership_cta_feature_1"><span class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span> <?php echo esc_html(cha_get_option('membership_perk_1', 'Exclusive resources & guides')); ?></div>
              <div class="feature" data-i18n="membership_cta_feature_2"><span class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span> <?php echo esc_html(cha_get_option('membership_perk_2', 'Events & community meetups')); ?></div>
              <div class="feature" data-i18n="membership_cta_feature_3"><span class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span> <?php echo esc_html(cha_get_option('membership_perk_3', 'Peer support network')); ?></div>
            </div>
            <div class="membership-cta-btns">
              <a class="btn-primary" href="javascript:void(0)" data-member-register-trigger data-i18n="membership_register"><?php echo esc_html(cha_get_option('membership_cta_btn', 'Register Now')); ?> <span class="arrow">→</span></a>
              <div class="membership-cta-links">
                <a href="javascript:void(0)" data-member-trigger data-i18n="membership_signin"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg> <?php echo esc_html(cha_get_option('membership_cta_login', 'Already a member? Sign In')); ?></a>
              </div>
            </div>
          </div>
          <div class="membership-cta-img">
            <img src="<?php echo esc_url(cha_get_option('membership_cta_img', get_template_directory_uri() . '/family.jpg')); ?>" alt="CHA community — families and members">
            <div class="membership-cta-badge"><strong data-i18n="membership_badge_count"><?php echo esc_html(cha_get_option('membership_count', '500+')); ?></strong><span data-i18n="membership_badge_label"><?php echo esc_html(cha_get_option('membership_count_label', 'members & growing')); ?></span></div>
          </div>
        </div>
      </div>
      <div class="tab-panel is-active" data-tab-panel="csr-donate" style="padding-top:0">
      <div class="donation-wrap">
      <div class="donation-form donate-showcase-card" data-reveal>
        <div style="text-align:center;margin-bottom:var(--s-5)">
          <div style="width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,#E31E24,#0B1D6D);display:inline-flex;align-items:center;justify-content:center;margin-bottom:12px">
            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:22px;height:22px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
          </div>
          <h3 data-i18n="donate_heading" style="font-size:1.35rem;font-weight:800;color:var(--c-blue);margin:0 0 6px">Make a Donation</h3>
          <p class="text-muted" style="font-size:0.875rem;max-width:380px;margin:0 auto">Your support helps us provide treatment, education, and hope to people with bleeding disorders in Cambodia.</p>
        </div>

        <form id="donate-form-submit" novalidate>
          <div class="form-group">
            <label class="form-label"><span data-i18n="donate_amount_label">Donation Amount</span> <span class="req">*</span></label>
            <div class="amount-chips" style="display:grid;grid-template-columns:repeat(5,1fr);gap:var(--s-3);margin-bottom:var(--s-3)">
              <button type="button" class="amount-chip is-active" data-amount="10">$10</button>
              <button type="button" class="amount-chip" data-amount="25">$25</button>
              <button type="button" class="amount-chip" data-amount="50">$50</button>
              <button type="button" class="amount-chip" data-amount="100">$100</button>
              <button type="button" class="amount-chip" data-amount="other" data-i18n="donate_other">Other</button>
            </div>
            <input class="form-input" type="number" placeholder="Enter amount in USD" data-amount-other min="1" style="display:none">
          </div>
          <div class="form-group">
            <label class="form-label" data-i18n="donate_name_label">Full name (optional)</label>
            <input class="form-input" type="text" id="doname-home" placeholder="Enter your name">
          </div>
          <div class="form-group">
            <label class="form-label" data-i18n="donate_email_label">Email (optional)</label>
            <input class="form-input" type="email" id="doemail-home" placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label class="form-label" data-i18n="donate_phone_label">Phone (optional)</label>
            <input class="form-input" type="tel" id="dophone-home" placeholder="Enter your phone">
          </div>
          <div class="modal-btn-row">
            <button type="submit" class="btn btn-primary btn-block" data-i18n="donate_btn"><?php echo esc_html(cha_get_option('donate_btn', 'Donate Now')); ?></button>
          </div>
        </form>
        <p class="secure-note" style="margin-top:var(--s-4);text-align:center;font-size:0.8125rem;color:var(--c-muted);display:flex;align-items:center;justify-content:center;gap:6px">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px;color:#22C55E"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
          Secure &amp; encrypted via PayWay (ABA Bank)
        </p>
        <div class="form-success" data-form-success hidden><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><h3>Thank You!</h3><p>Your generous donation will help change lives across Cambodia.</p></div>
      </div>
      <div class="campaigns-list campaigns-panel-v2" data-reveal>
        <div class="campaigns-header-row">
          <div class="campaigns-title-col">
            <h3 class="campaigns-main-title" data-i18n="campaigns_heading"><?php esc_html_e('Current Campaigns', 'cha-cambodia'); ?></h3>
            <p class="campaigns-main-sub" data-i18n="campaigns_sub"><?php esc_html_e('Support our life-saving missions and emergency patient care.', 'cha-cambodia'); ?></p>
          </div>
          <?php
          $camp_count_q = new WP_Query(array('post_type' => 'cha_campaigns', 'posts_per_page' => 10, 'post_status' => 'publish'));
          $camp_count = $camp_count_q->found_posts;
          wp_reset_postdata();
          ?>
          <div class="campaigns-actions-col">
            <span class="campaigns-count-badge"><?php echo esc_html($camp_count); ?> <span data-i18n="campaigns_ongoing">Ongoing</span></span>
            <?php if ($camp_count > 0) : ?>
              <a href="<?php echo esc_url(get_post_type_archive_link('cha_campaigns')); ?>" class="campaigns-view-all-link" data-i18n="campaigns_view_all">View All &rarr;</a>
            <?php endif; ?>
          </div>
        </div>

        <div class="campaigns-cards-stack">
          <?php
          $campaigns_query = new WP_Query(array(
              'post_type'      => 'cha_campaigns',
              'posts_per_page' => 3,
              'post_status'    => 'publish',
              'orderby'        => 'menu_order',
              'order'          => 'ASC',
          ));
          if ($campaigns_query->have_posts()) :
              while ($campaigns_query->have_posts()) : $campaigns_query->the_post();
                  $raised = (float) get_post_meta(get_the_ID(), '_cha_campaign_raised', true);
                  $goal = (float) get_post_meta(get_the_ID(), '_cha_campaign_goal', true);
                  $color = get_post_meta(get_the_ID(), '_cha_campaign_color', true);
                  $icon_name = get_post_meta(get_the_ID(), '_cha_campaign_icon', true);
                  if (!$color) $color = 'red';
                  if (!$icon_name) $icon_name = 'heart';
                  $pct = $goal > 0 ? min(100, round(($raised / $goal) * 100)) : 0;
                  $icon = cha_campaign_icon_svg($icon_name);
                  ?>
                  <article class="campaign-card-v2 campaign-theme-<?php echo esc_attr($color); ?>">
                    <div class="campaign-card-top">
                      <div class="campaign-icon-wrap"><?php echo $icon; ?></div>
                      <div class="campaign-card-info">
                        <?php
                        $camp_title = get_the_title();
                        $camp_km_title = get_post_meta(get_the_ID(), '_cha_campaign_title_km', true);
                        $camp_excerpt = get_the_excerpt();
                        if (strlen($camp_excerpt) > 100) $camp_excerpt = wp_trim_words($camp_excerpt, 15, '...');
                        $camp_km_desc = get_post_meta(get_the_ID(), '_cha_campaign_desc_km', true);
                        ?>
                        <div class="campaign-title-row">
                          <h4 class="campaign-title auto-text" data-en="<?php echo esc_attr($camp_title); ?>" data-km="<?php echo esc_attr($camp_km_title); ?>"><?php the_title(); ?></h4>
                          <span class="campaign-pct-pill"><?php echo esc_html($pct); ?>%</span>
                        </div>
                        <p class="campaign-desc auto-text" data-en="<?php echo esc_attr($camp_excerpt); ?>" data-km="<?php echo esc_attr($camp_km_desc); ?>"><?php echo esc_html($camp_excerpt); ?></p>
                      </div>
                    </div>
                    <div class="campaign-progress-track">
                      <div class="campaign-progress-fill fill-<?php echo esc_attr($color); ?>" style="width: <?php echo esc_attr($pct); ?>%"></div>
                    </div>
                    <div class="campaign-meta-row">
                      <span class="campaign-meta-raised" data-i18n="campaigns_raised_label">
                        Raised: <strong>$<?php echo esc_html(number_format($raised)); ?></strong>
                      </span>
                      <span class="campaign-meta-goal" data-i18n="campaigns_goal_label">
                        Goal: <span>$<?php echo esc_html(number_format($goal)); ?></span>
                      </span>
                    </div>
                  </article>
                  <?php
                  endwhile;
              wp_reset_postdata();
          else :
              $fallback = array(
                  array('Patient Support Fund', 'Help patients access essential treatment and medication.', 4250, 15000, 'red', 'heart', 'campaigns_1_title', 'campaigns_1_desc'),
                  array('Education & Awareness', 'Support workshops and awareness seminars across provinces.', 2180, 8500, 'blue', 'graduation', 'campaigns_2_title', 'campaigns_2_desc'),
                  array('Emergency Assistance', 'Provide urgent help for patients in critical situations.', 1500, 5000, 'purple', 'pulse', 'campaigns_3_title', 'campaigns_3_desc'),
              );
              foreach ($fallback as $fi => $fb) :
                  $pct = $fb[3] > 0 ? round(($fb[2] / $fb[3]) * 100) : 0;
                  ?>
                  <article class="campaign-card-v2 campaign-theme-<?php echo esc_attr($fb[4]); ?>">
                    <div class="campaign-card-top">
                      <div class="campaign-icon-wrap"><?php echo cha_campaign_icon_svg($fb[5]); ?></div>
                      <div class="campaign-card-info">
                        <div class="campaign-title-row">
                          <h4 class="campaign-title auto-text" data-en="<?php echo esc_attr($fb[0]); ?>" data-km="" data-i18n="<?php echo esc_attr($fb[6]); ?>"><?php echo esc_html($fb[0]); ?></h4>
                          <span class="campaign-pct-pill"><?php echo esc_html($pct); ?>%</span>
                        </div>
                        <p class="campaign-desc auto-text" data-en="<?php echo esc_attr($fb[1]); ?>" data-km="" data-i18n="<?php echo esc_attr($fb[7]); ?>"><?php echo esc_html($fb[1]); ?></p>
                      </div>
                    </div>
                    <div class="campaign-progress-track">
                      <div class="campaign-progress-fill fill-<?php echo esc_attr($fb[4]); ?>" style="width: <?php echo esc_attr($pct); ?>%"></div>
                    </div>
                    <div class="campaign-meta-row">
                      <span class="campaign-meta-raised" data-i18n="campaigns_raised_label">Raised: <strong>$<?php echo esc_html(number_format($fb[2])); ?></strong></span>
                      <span class="campaign-meta-goal" data-i18n="campaigns_goal_label">Goal: <span>$<?php echo esc_html(number_format($fb[3])); ?></span></span>
                    </div>
                  </article>
              <?php endforeach;
          endif;
          ?>
        </div>

        <!-- Corporate Partners Card -->
        <div class="corporate-partners-box">
          <div class="partners-box-header">
            <span class="partners-box-title" data-i18n="campaigns_partners"><?php echo esc_html(cha_get_option('campaigns_corporate_heading', 'Corporate Partners')); ?></span>
            <span class="partners-box-sub" data-i18n="campaigns_partners_sub">Global Healthcare Allies</span>
          </div>
          <div class="partners-logos-row">
            <div class="partner-logo-card" title="World Federation of Hemophilia">
              <div class="partner-icon-ring partner-icon-blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
              </div>
              <span class="partner-logo-text">WFH</span>
            </div>
            <div class="partner-logo-card" title="International Federation of Arms for Hemophilia">
              <div class="partner-icon-ring partner-icon-purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              </div>
              <span class="partner-logo-text">IFAH</span>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div></div>

    <!-- ===== CONTACT ===== -->
    <div class="section-divider"><div class="divider-inner" data-i18n="contact_divider">Contact Us</div></div>
    <section class="section" id="contact"><div class="container">
      <div class="section-heading" data-reveal>
        <h2 data-i18n="contact_heading"><?php echo esc_html(cha_get_option('contact_heading', 'Contact Us')); ?></h2>
        <p data-i18n="contact_sub"><?php echo esc_html(cha_get_option('contact_sub', 'Have a question or want to get involved? We\'d love to hear from you.')); ?></p>
      </div><div class="contact-grid">
      <div class="contact-info" data-reveal>
        <h3 data-i18n="contact_info"><?php echo esc_html(cha_get_option('contact_get_in_touch', 'Get In Touch')); ?></h3>
        <p class="subtitle" data-i18n="contact_subtitle"><?php echo esc_html(cha_get_option('contact_we_are_here', "We're here to help patients, families, and partners across Cambodia.")); ?></p>
        <div class="items">
          <div class="item">
            <div class="icon-wrap"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
            <div><span class="label" data-i18n="contact_address">Address</span><span class="value"><?php echo nl2br(esc_html(cha_get_option('contact_address', '#100, Street Russia Blvd, Sangkat Teek Laak 1, Khan Toul Kork, Phnom Penh, Cambodia'))); ?></span></div>
          </div>
          <div class="item">
            <div class="icon-wrap"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
            <div><span class="label" data-i18n="contact_phone">Phone</span><a class="value" href="tel:<?php echo esc_attr(cha_get_option('contact_phone_digits', '+85512311033')); ?>"><?php echo esc_html(cha_get_option('contact_phone', '+855 12 311 033')); ?></a></div>
          </div>
          <div class="item">
            <div class="icon-wrap"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
            <div><span class="label" data-i18n="contact_email">Email</span><a class="value" href="mailto:<?php echo esc_attr(cha_get_option('contact_email', 'cha.rithy2016@gmail.com')); ?>"><?php echo esc_html(cha_get_option('contact_email', 'cha.rithy2016@gmail.com')); ?></a></div>
          </div>
        </div>
        <div class="hours">
          <div class="hours-title"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> <span data-i18n="contact_hours"><?php echo esc_html(cha_get_option('contact_office_hours', 'Office Hours')); ?></span></div>
          <div class="hours-row"><span class="day">Monday – Friday</span><span class="time"><?php echo esc_html(cha_get_option('contact_hours_mf', '8:00 — 17:00')); ?></span></div>
          <div class="hours-row"><span class="day">Saturday</span><span class="time"><?php echo esc_html(cha_get_option('contact_hours_sat', '9:00 — 13:00')); ?></span></div>
          <div class="hours-row"><span class="day">Sunday</span><span class="time">Closed</span></div>
        </div>
        <div class="socials" aria-label="Social media">
          <a href="https://www.facebook.com/hemophiliacambodian" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg></a>
          <a href="https://www.youtube.com/@cambodiahemophiliaassociation" target="_blank" rel="noopener" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
          <a href="mailto:cha.rithy2016@gmail.com" aria-label="Email"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></a>
          <a href="https://t.me/Chacambodia_bot" target="_blank" rel="noopener" aria-label="Telegram"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71l-4.16-3.07-2.01 1.93c-.23.23-.42.42-.84.42z"/></svg></a>
        </div>
      </div>
      <div class="contact-form" data-reveal>
        <h3 data-i18n="contact_message"><?php echo esc_html(cha_get_option('contact_send_msg', 'Send us a Message')); ?></h3>
        <p class="subtitle" data-i18n="contact_message_sub"><?php echo esc_html(cha_get_option('contact_send_sub', 'Fill out the form and our team will respond within 1-2 working days.')); ?></p>
        <form data-mock-form novalidate>
          <div class="form-row"><div class="form-group"><label class="form-label" for="cname" data-i18n="contact_name"><?php echo esc_html(cha_get_option('contact_form_name', 'Full Name')); ?> <span class="req">*</span></label><input class="form-input" type="text" id="cname" placeholder="<?php echo esc_attr(cha_get_option('contact_form_name_ph', 'Enter your full name')); ?>" required></div><div class="form-group"><label class="form-label" for="cemail" data-i18n="contact_email_label"><?php echo esc_html(cha_get_option('contact_form_email', 'Email')); ?> <span class="req">*</span></label><input class="form-input" type="email" id="cemail" placeholder="<?php echo esc_attr(cha_get_option('contact_form_email_ph', 'Enter your email')); ?>" required></div></div>
          <div class="form-group"><label class="form-label" for="csubject" data-i18n="contact_subject"><?php echo esc_html(cha_get_option('contact_form_subject', 'Subject')); ?> <span class="req">*</span></label><input class="form-input" type="text" id="csubject" placeholder="<?php echo esc_attr(cha_get_option('contact_form_subject_ph', "What's this about?")); ?>" required></div>
          <div class="form-group"><label class="form-label" for="cmessage" data-i18n="contact_message_label"><?php echo esc_html(cha_get_option('contact_form_message', 'Message')); ?> <span class="req">*</span></label><textarea class="form-textarea" id="cmessage" placeholder="<?php echo esc_attr(cha_get_option('contact_form_message_ph', 'How can we help?')); ?>" required></textarea></div>
          <button type="submit" class="btn btn-primary btn-lg" data-i18n="contact_send"><?php echo esc_html(cha_get_option('contact_form_btn', 'Send Message')); ?> <span class="arrow">→</span></button>
        </form>
        <div class="form-success" data-form-success hidden><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><h3><?php echo esc_html(cha_get_option('contact_form_success', 'Message Sent! Thank you for reaching out. We\'ll respond within 1-2 working days.')); ?></h3></div>
      </div>
    </div></div></section>

  </main>

  <?php get_footer(); ?>
