<?php get_header(); ?>

    <!-- ===== ABOUT US PAGE ===== -->
    <section class="page-hero" id="about"><div class="container">
      <div data-reveal>
        <span class="hero-eyebrow"><span class="eyebrow-dot"></span> <span data-i18n="about_hero_eyebrow">About CHA Cambodia</span></span>
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
            <img src="<?php echo esc_url(cha_get_option('about_team_img', get_template_directory_uri() . '/who-is-cha.png')); ?>" alt="CHA leadership and team">
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

    <section class="section section-soft src-section" id="about-src"><div class="container">
      <div class="src-header">
        <div>
          <span class="src-eyebrow"><span class="heart" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></span><span data-i18n="src_eyebrow"><?php echo esc_html(cha_get_option('src_eyebrow', 'Serving Communities')); ?></span></span>
          <h2 class="src-title" data-i18n="src_heading"><?php echo esc_html(cha_get_option('src_heading', 'SRC')); ?></h2>
          <p class="src-sub" data-i18n="src_sub"><?php echo esc_html(cha_get_option('src_sub', "CHA's commitment to community outreach, volunteer engagement, and public awareness across Cambodia.")); ?></p>
        </div>
        <div class="src-header-art" aria-hidden="true">
          <div class="src-art-circle">
            <div class="src-art-glow"></div>
            <div class="src-ambient-ring"></div>
            <div class="src-ambient-ring ring-2"></div>
            <div class="big-drop">
            <svg viewBox="0 0 160 190" xmlns="http://www.w3.org/2000/svg" style="overflow: visible;">
              <defs>
                <linearGradient id="srcDropGrad" x1="0.1" y1="0" x2="0.9" y2="1">
                  <stop offset="0%" stop-color="#FF333A"/>
                  <stop offset="35%" stop-color="#E31E24"/>
                  <stop offset="70%" stop-color="#991B6B"/>
                  <stop offset="100%" stop-color="#5B1E82"/>
                </linearGradient>
                <linearGradient id="srcSheenGrad" x1="0" y1="0" x2="0.8" y2="1">
                  <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.65"/>
                  <stop offset="30%" stop-color="#FFFFFF" stop-opacity="0.25"/>
                  <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                </linearGradient>
                <radialGradient id="srcBottomGaze" cx="50%" cy="85%" r="45%">
                  <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.22"/>
                  <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                </radialGradient>
                <filter id="srcDropShadow" x="-50%" y="-40%" width="200%" height="200%">
                  <feDropShadow dx="0" dy="16" stdDeviation="20" flood-color="#5B1E82" flood-opacity="0.38"/>
                </filter>
              </defs>
              
              <!-- Main 3D liquid drop body -->
              <path class="drop-shape" d="M80 8 C 48 54, 26 88, 26 118 C 26 152, 50 178, 80 178 C 110 178, 134 152, 134 118 C 134 88, 112 54, 80 8 Z" fill="url(#srcDropGrad)" filter="url(#srcDropShadow)"/>
              
              <!-- Bottom liquid glow reflection for 3D fullness -->
              <path d="M80 8 C 48 54, 26 88, 26 118 C 26 152, 50 178, 80 178 C 110 178, 134 152, 134 118 C 134 88, 112 54, 80 8 Z" fill="url(#srcBottomGaze)"/>
              
              <!-- Primary glass sheen along upper-left curve -->
              <path d="M78 20 C 54 60, 38 88, 38 114 C 38 126, 42 136, 48 144 C 42 134, 40 122, 42 110 C 44 88, 58 60, 78 20 Z" fill="url(#srcSheenGrad)"/>
              
              <!-- Secondary mini light highlight bead -->
              <ellipse cx="66" cy="46" rx="4" ry="7" transform="rotate(-24 66 46)" fill="#FFFFFF" opacity="0.55"/>
              
              <!-- Inner beating heart -->
              <g class="drop-heart-beating" transform="translate(80 118)">
                <path d="M0 24 C -22 10, -22 -6, -11 -14 C -4 -19, 0 -10, 0 -6 C 0 -10, 4 -19, 11 -14 C 22 -6, 22 10, 0 24 Z" stroke="#FFFFFF" stroke-width="2.6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
              </g>
            </svg>
          </div>
          </div>
        </div>
      </div>
      <div class="grid grid-3">
        <article class="src-card src-card-v2 red-top" data-reveal>
          <?php $src_bg1 = cha_get_option('src_card_1_img', ''); ?>
          <div class="src-bg" aria-hidden="true"<?php if ($src_bg1): ?> style="background-image:url('<?php echo esc_url($src_bg1); ?>')"<?php endif; ?>></div>
          <div class="src-photo-art">
            <div class="src-photo-icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l18-8v18l-18-8z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
            </div>
            <div class="src-photo-stat">
              <span class="src-photo-stat-num">25</span>
              <span class="src-photo-stat-lbl" data-i18n="src_stat_label_1"><?php echo esc_html(cha_get_option('src_stat_label_1', 'Provinces')); ?></span>
            </div>
          </div>
          <div class="src-stamp" aria-hidden="true"></div>
          <div class="src-body">
            <span class="src-kicker" data-i18n="src_kicker_reach"><?php echo esc_html(cha_get_option('src_kicker_reach', 'Reach')); ?></span>
            <h3 data-i18n="src_card_1_title"><?php echo esc_html(cha_get_option('src_card_1_title', 'Community Outreach')); ?></h3>
            <p data-i18n="src_card_1_desc"><?php echo esc_html(cha_get_option('src_card_1_desc', 'Awareness campaigns, Khmer-language education, and partnerships with local health centres that reach patients where they live.')); ?></p>
            <div class="src-foot">
              <a class="src-link" href="<?php echo home_url('/#contact'); ?>" data-i18n="src_link_1"><?php echo esc_html(cha_get_option('src_link_1', 'Learn more')); ?> <span class="arrow">→</span></a>
            </div>
          </div>
        </article>
        <article class="src-card src-card-v2 blue-top" data-reveal>
          <?php $src_bg2 = cha_get_option('src_card_2_img', ''); ?>
          <div class="src-bg" aria-hidden="true"<?php if ($src_bg2): ?> style="background-image:url('<?php echo esc_url($src_bg2); ?>')"<?php endif; ?>></div>
          <div class="src-photo-art">
            <div class="src-photo-icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="src-photo-stat">
              <span class="src-photo-stat-num">80+</span>
              <span class="src-photo-stat-lbl" data-i18n="src_stat_label_2"><?php echo esc_html(cha_get_option('src_stat_label_2', 'Volunteers')); ?></span>
            </div>
          </div>
          <div class="src-stamp" aria-hidden="true"></div>
          <div class="src-body">
            <span class="src-kicker" data-i18n="src_kicker_people"><?php echo esc_html(cha_get_option('src_kicker_people', 'People')); ?></span>
            <h3 data-i18n="src_card_2_title"><?php echo esc_html(cha_get_option('src_card_2_title', 'Volunteer Program')); ?></h3>
            <p data-i18n="src_card_2_desc"><?php echo esc_html(cha_get_option('src_card_2_desc', 'Patients, families, and healthcare students who lead events, mentor newly diagnosed peers, and run community-based activities year-round.')); ?></p>
            <div class="src-foot">
              <a class="src-link" href="<?php echo home_url('/#contact'); ?>" data-i18n="src_link_2"><?php echo esc_html(cha_get_option('src_link_2', 'Join us')); ?> <span class="arrow">→</span></a>
            </div>
          </div>
        </article>
        <article class="src-card src-card-v2 purple-top" data-reveal>
          <?php $src_bg3 = cha_get_option('src_card_3_img', ''); ?>
          <div class="src-bg" aria-hidden="true"<?php if ($src_bg3): ?> style="background-image:url('<?php echo esc_url($src_bg3); ?>')"<?php endif; ?>></div>
          <div class="src-photo-art">
            <div class="src-photo-icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div class="src-photo-stat">
              <span class="src-photo-stat-num">1</span>
              <span class="src-photo-stat-lbl" data-i18n="src_stat_label_3"><?php echo esc_html(cha_get_option('src_stat_label_3', 'Chapter')); ?></span>
            </div>
          </div>
          <div class="src-stamp" aria-hidden="true"></div>
          <div class="src-body">
            <span class="src-kicker" data-i18n="src_kicker_region"><?php echo esc_html(cha_get_option('src_kicker_region', 'Region')); ?></span>
            <h3 data-i18n="src_card_3_title"><?php echo esc_html(cha_get_option('src_card_3_title', 'Siem Reap Chapter')); ?></h3>
            <p data-i18n="src_card_3_desc"><?php echo esc_html(cha_get_option('src_card_3_desc', 'Our northwest hub coordinates local outreach, patient support, and partnerships with Siem Reap Provincial Hospital.')); ?></p>
            <div class="src-foot">
              <a class="src-link" href="<?php echo home_url('/#contact'); ?>" data-i18n="src_link_3"><?php echo esc_html(cha_get_option('src_link_3', 'Visit chapter')); ?> <span class="arrow">→</span></a>
            </div>
          </div>
        </article>
      </div>
      <div class="src-cta" data-reveal>
        <div class="src-cta-icon" aria-hidden="true">
          <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
          </svg>
        </div>
        <div class="src-cta-text">
          <h3 data-i18n="src_cta_heading"><?php echo esc_html(cha_get_option('src_cta_heading', 'Want to get involved?')); ?></h3>
          <p data-i18n="src_cta_sub"><?php echo esc_html(cha_get_option('src_cta_sub', 'Join our volunteer network and make a difference in the bleeding disorders community across Cambodia.')); ?></p>
        </div>
        <div class="src-cta-actions">
          <a class="btn btn-light" href="<?php echo home_url('/#contact'); ?>" data-i18n="src_cta_btn_1"><?php echo esc_html(cha_get_option('src_cta_btn_1', 'Get Involved')); ?> <span class="arrow">→</span></a>
          <a class="btn btn-ghost" href="<?php echo home_url('/haemophilia'); ?>" data-i18n="src_cta_btn_2"><?php echo esc_html(cha_get_option('src_cta_btn_2', 'Learn More')); ?> <span class="arrow">→</span></a>
        </div>
      </div>
    </div></section>

    <section class="section history-section" id="about-history">
      <div class="history-bg-glow" aria-hidden="true"></div>
      <div class="container">
        <div class="history-header" data-reveal>
          <span class="history-eyebrow">
            <span class="eyebrow-dot"></span>
            <span data-i18n="history_journey_eyebrow">Our Journey · Since 2011</span>
          </span>
          <h2 class="history-main-title" data-i18n="history_heading"><?php echo esc_html(cha_get_option('history_heading', 'Our History')); ?></h2>
          <p class="history-lead" data-i18n="history_intro"><?php echo esc_html(cha_get_option('history_intro', 'CHA was founded in 2011 by patients and families who came together with a shared vision: to ensure no one in Cambodia faces a bleeding disorder alone. What began as a small support group has grown into a national patient-led organization.')); ?></p>
        </div>

        <!-- Concept A: Interactive Milestone Slider & Story Showcase -->
        <div class="history-showcase" data-reveal>
          <!-- Milestone Navigation Timeline Bar -->
          <div class="milestone-nav-wrapper">
            <div class="milestone-progress-line" aria-hidden="true">
              <div class="milestone-progress-fill" id="milestoneProgressFill"></div>
            </div>
            <div class="milestone-tabs-list" role="tablist" aria-label="CHA History Milestones">
              <button class="milestone-tab-btn is-active" type="button" role="tab" aria-selected="true" aria-controls="era-2011" id="tab-2011" data-milestone="0">
                <span class="tab-dot"><span class="dot-inner"></span></span>
                <span class="tab-year">2011</span>
                <span class="tab-label" data-i18n="history_tab_1">Established</span>
              </button>

              <button class="milestone-tab-btn" type="button" role="tab" aria-selected="false" aria-controls="era-2014" id="tab-2014" data-milestone="1">
                <span class="tab-dot"><span class="dot-inner"></span></span>
                <span class="tab-year">2014</span>
                <span class="tab-label" data-i18n="history_tab_2">WFH Member</span>
              </button>

              <button class="milestone-tab-btn" type="button" role="tab" aria-selected="false" aria-controls="era-2017" id="tab-2017" data-milestone="2">
                <span class="tab-dot"><span class="dot-inner"></span></span>
                <span class="tab-year">2017</span>
                <span class="tab-label" data-i18n="history_tab_3">Partnerships</span>
              </button>

              <button class="milestone-tab-btn" type="button" role="tab" aria-selected="false" aria-controls="era-2023" id="tab-2023" data-milestone="3">
                <span class="tab-dot"><span class="dot-inner"></span></span>
                <span class="tab-year">2023</span>
                <span class="tab-label" data-i18n="history_tab_4">National Reach</span>
              </button>
            </div>
          </div>

          <!-- Showcase Panels -->
          <div class="milestone-panels-wrap">
            <!-- 2011 Panel -->
            <article class="milestone-story-panel is-active theme-red" id="era-2011" role="tabpanel" aria-labelledby="tab-2011">
              <div class="story-watermark" aria-hidden="true">2011</div>
              <div class="story-content-col">
                <div class="story-meta">
                  <span class="story-phase-pill" data-i18n="history_phase_1">Phase 01 · Genesis</span>
                  <span class="story-era-pill" data-i18n="history_era_2011">Year 2011</span>
                </div>
                <h3 class="story-title" data-i18n="history_established"><?php echo esc_html(cha_get_option('history_1_title', 'CHA Established')); ?></h3>
                <p class="story-desc" data-i18n="history_established_desc">
                  <?php echo esc_html(cha_get_option('history_1_desc', 'CHA was established by patients and families who came together with a shared dream: ensuring that individuals suffering from bleeding disorders across Cambodia receive recognition, emotional solidarity, and life-saving care.')); ?>
                </p>
                <div class="story-highlights">
                  <div class="story-highlight-item">
                    <span class="highlight-check">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span data-i18n="history_h1_1">Founded by compassionate families & pioneering patients in Phnom Penh</span>
                  </div>
                  <div class="story-highlight-item">
                    <span class="highlight-check">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span data-i18n="history_h1_2">Created Cambodia's first peer-to-peer haemophilia support registry</span>
                  </div>
                </div>
                <div class="story-footer-nav">
                  <button type="button" class="btn-next-milestone" data-jump-milestone="1">
                    <span data-i18n="history_btn_explore_2014">Explore 2014: Global Recognition</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                  </button>
                </div>
              </div>
              <div class="story-media-col">
                <div class="story-visual-frame">
                  <div class="frame-glass-badge">
                    <span class="badge-dot"></span>
                    <span data-i18n="history_badge_2011">Founding Era · 2011</span>
                  </div>
                   <img src="<?php echo esc_url(cha_get_option('history_2011_img', get_template_directory_uri() . '/history-2011.jpg')); ?>" alt="CHA Founding Families" loading="lazy">
                  <div class="frame-caption">
                    <p class="caption-title" data-i18n="history_c1_title">United by Hope</p>
                    <p class="caption-text" data-i18n="history_c1_desc">Patient support circle during CHA's inaugural foundation meeting.</p>
                  </div>
                </div>
              </div>
            </article>

            <!-- 2014 Panel -->
            <article class="milestone-story-panel theme-blue" id="era-2014" role="tabpanel" aria-labelledby="tab-2014">
              <div class="story-watermark" aria-hidden="true">2014</div>
              <div class="story-content-col">
                <div class="story-meta">
                  <span class="story-phase-pill" data-i18n="history_phase_2">Phase 02 · International Alliance</span>
                  <span class="story-era-pill" data-i18n="history_era_2014">Year 2014</span>
                </div>
                <h3 class="story-title" data-i18n="history_wfh_member"><?php echo esc_html(cha_get_option('history_2_title', 'WFH Global Membership')); ?></h3>
                <p class="story-desc" data-i18n="history_wfh_member_desc">
                  <?php echo esc_html(cha_get_option('history_2_desc', 'CHA officially became an accredited national member organization of the World Federation of Hemophilia (WFH). This milestone opened Cambodia to global humanitarian factor donation programs and clinical training fellowships.')); ?>
                </p>
                <div class="story-highlights">
                  <div class="story-highlight-item">
                    <span class="highlight-check">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span data-i18n="history_h2_1">Direct inclusion in the WFH Humanitarian Aid Program</span>
                  </div>
                  <div class="story-highlight-item">
                    <span class="highlight-check">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span data-i18n="history_h2_2">International standards for diagnostic validation and safe clotting factor</span>
                  </div>
                </div>
                <div class="story-footer-nav">
                  <button type="button" class="btn-next-milestone" data-jump-milestone="2">
                    <span data-i18n="history_btn_explore_2017">Explore 2017: Hospital Partnerships</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                  </button>
                </div>
              </div>
              <div class="story-media-col">
                <div class="story-visual-frame">
                  <div class="frame-glass-badge">
                    <span class="badge-dot"></span>
                    <span data-i18n="history_badge_2014">Global Alignment · 2014</span>
                  </div>
                   <img src="<?php echo esc_url(cha_get_option('history_2014_img', get_template_directory_uri() . '/history-2014.jpg')); ?>" alt="WFH Partnership" loading="lazy">
                  <div class="frame-caption">
                    <p class="caption-title" data-i18n="history_c2_title">World Federation of Hemophilia</p>
                    <p class="caption-text" data-i18n="history_c2_desc">Connecting Cambodian patients to the global community of care.</p>
                  </div>
                </div>
              </div>
            </article>

            <!-- 2017 Panel -->
            <article class="milestone-story-panel theme-purple" id="era-2017" role="tabpanel" aria-labelledby="tab-2017">
              <div class="story-watermark" aria-hidden="true">2017</div>
              <div class="story-content-col">
                <div class="story-meta">
                  <span class="story-phase-pill" data-i18n="history_phase_3">Phase 03 · Clinical Expansion</span>
                  <span class="story-era-pill" data-i18n="history_era_2017">Year 2017</span>
                </div>
                <h3 class="story-title" data-i18n="history_hospital"><?php echo esc_html(cha_get_option('history_3_title', 'Hospital Partnerships')); ?></h3>
                <p class="story-desc" data-i18n="history_hospital_desc">
                  <?php echo esc_html(cha_get_option('history_3_desc', 'Partnered directly with major public and pediatric hospitals across Phnom Penh and Siem Reap to establish dedicated haemophilia treatment units and physician training workshops.')); ?>
                </p>
                <div class="story-highlights">
                  <div class="story-highlight-item">
                    <span class="highlight-check">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span data-i18n="history_h3_1">Treating hospital network established with emergency factor supplies</span>
                  </div>
                  <div class="story-highlight-item">
                    <span class="highlight-check">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span data-i18n="history_h3_2">Specialized training for nurses and haematologists on bleed management</span>
                  </div>
                </div>
                <div class="story-footer-nav">
                  <button type="button" class="btn-next-milestone" data-jump-milestone="3">
                    <span data-i18n="history_btn_explore_2023">Explore 2023: National Reach</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                  </button>
                </div>
              </div>
              <div class="story-media-col">
                <div class="story-visual-frame">
                  <div class="frame-glass-badge">
                    <span class="badge-dot"></span>
                    <span data-i18n="history_badge_2017">Hospital Units · 2017</span>
                  </div>
                   <img src="<?php echo esc_url(cha_get_option('history_2017_img', get_template_directory_uri() . '/history-2017.jpg')); ?>" alt="Clinical Doctor Training" loading="lazy">
                  <div class="frame-caption">
                    <p class="caption-title" data-i18n="history_c3_title">Clinical Capacity Building</p>
                    <p class="caption-text" data-i18n="history_c3_desc">Collaborating with hospital clinical teams to expedite acute care.</p>
                  </div>
                </div>
              </div>
            </article>

            <!-- 2023 Panel -->
            <article class="milestone-story-panel theme-gold" id="era-2023" role="tabpanel" aria-labelledby="tab-2023">
              <div class="story-watermark" aria-hidden="true">2023</div>
              <div class="story-content-col">
                <div class="story-meta">
                  <span class="story-phase-pill" data-i18n="history_phase_4">Phase 04 · Community & Digital</span>
                  <span class="story-era-pill" data-i18n="history_era_2023">Year 2023</span>
                </div>
                <h3 class="story-title" data-i18n="history_national"><?php echo esc_html(cha_get_option('history_4_title', 'National Reach & Digital Care')); ?></h3>
                <p class="story-desc" data-i18n="history_national_desc">
                  <?php echo esc_html(cha_get_option('history_4_desc', 'Expanded education, provincial mobile clinics, and patient identification into rural provinces. Launched modern digital membership and emergency assistance systems to serve patients everywhere.')); ?>
                </p>
                <div class="story-highlights">
                  <div class="story-highlight-item">
                    <span class="highlight-check">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span data-i18n="history_h4_1">Outreach camps covering 10+ Cambodian provinces</span>
                  </div>
                  <div class="story-highlight-item">
                    <span class="highlight-check">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span data-i18n="history_h4_2">Digital member health cards for immediate emergency diagnosis identification</span>
                  </div>
                </div>
                <div class="story-footer-nav">
                  <button type="button" class="btn-next-milestone" data-jump-milestone="0">
                    <span data-i18n="history_btn_explore_2011">Back to 2011: Origins</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
                  </button>
                </div>
              </div>
              <div class="story-media-col">
                <div class="story-visual-frame">
                  <div class="frame-glass-badge">
                    <span class="badge-dot"></span>
                    <span data-i18n="history_badge_2023">Nationwide · 2023</span>
                  </div>
                   <img src="<?php echo esc_url(cha_get_option('history_2023_img', get_template_directory_uri() . '/history-2023.jpg')); ?>" alt="CHA Nationwide Community" loading="lazy">
                  <div class="frame-caption">
                    <p class="caption-title" data-i18n="history_c4_title">Nationwide Family</p>
                    <p class="caption-text" data-i18n="history_c4_desc">Empowering bleeding disorder patients and families across Cambodia.</p>
                  </div>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-soft" id="about-leadership">
      <div class="container">
        <!-- Section Header -->
        <div class="leadership-section-header" data-reveal>
          <div class="leadership-header-text">
            <span class="leadership-eyebrow">
              <span class="eyebrow-dot"></span>
              <span data-i18n="lead_mandate_eyebrow">5th Mandate (2026–2030)</span>
            </span>
            <h2 class="leadership-main-title" data-i18n="leadership_heading"><?php echo esc_html(cha_get_option('leadership_heading', 'Leadership Council')); ?></h2>
            <p class="leadership-lead" data-i18n="leadership_sub"><?php echo esc_html(cha_get_option('leadership_sub', "Dedicated leaders, advisors, and working groups guiding CHA's national mission across Cambodia.")); ?></p>
          </div>
        </div>

        <!-- 5th Mandate Governance Directory & Hierarchy -->
        <div class="mandate-directory-wrapper" id="mandate-pillars" data-reveal>

          <!-- 5th Mandate 3-Tier Leadership Directory -->
          <div class="org-tree-flow">

            <!-- TIER 1: Founders & Medical Advisory Board (3 Cards) -->
            <div class="org-tier-box" data-reveal>
              <div class="org-tier-header">
                <span class="org-tier-label">
                  <span class="tier-icon-svg">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/><path d="M8 15v1a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6v-4"/><circle cx="20" cy="10" r="2"/></svg>
                  </span>
                  <span data-i18n="lead_tier_advisors"><?php echo esc_html(cha_get_option('tier_advisors_title', 'Founders & Medical Advisory Board')); ?></span>
                </span>
              </div>
              <div class="leadership-grid leadership-grid-3">
                <!-- 1. Prof. Chean Sophâl -->
                <div class="leader-card card-advisor" data-reveal>
                  <div class="leader-photo">
                    <img src="<?php echo esc_url(cha_get_option('leader_advisor_1_img', get_template_directory_uri() . '/leader-advisor-1.png')); ?>" alt="Prof. Chean Sophâl" loading="lazy">
                  </div>
                  <div class="leader-info">
                    <span class="role-pill pill-blue" data-i18n="lead_role_advisor">Medical Advisor</span>
                    <h3 class="leader-name" data-i18n="lead_name_sophal">Prof. Chean Sophâl</h3>
                  </div>
                </div>

                <!-- 2. Dr. Sing Heng -->
                <div class="leader-card card-advisor" data-reveal>
                  <div class="leader-photo">
                    <img src="<?php echo esc_url(cha_get_option('leader_advisor_2_img', get_template_directory_uri() . '/leader-advisor-2.png')); ?>" alt="Dr. Sing Heng" loading="lazy">
                  </div>
                  <div class="leader-info">
                    <span class="role-pill pill-blue" data-i18n="lead_role_advisor">Medical Advisor</span>
                    <h3 class="leader-name" data-i18n="lead_name_singheng">Dr. Sing Heng</h3>
                  </div>
                </div>

                <!-- 3. Sem Sokpanha -->
                <div class="leader-card card-advisor" data-reveal>
                  <div class="leader-photo">
                    <img src="<?php echo esc_url(cha_get_option('leader_advisor_3_img', get_template_directory_uri() . '/leader-advisor-3.png')); ?>" alt="Sem Sokpanha" loading="lazy">
                  </div>
                  <div class="leader-info">
                    <span class="role-pill pill-blue" data-i18n="lead_role_hon_pres">Honorary President</span>
                    <h3 class="leader-name" data-i18n="lead_name_sokpanha">Sem Sokpanha</h3>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tier Transition Badge: Executive Governance -->
            <div class="org-motto-banner" data-reveal>
              <div class="org-motto-pill">
                <span data-i18n="lead_flow_exec">Executive Governance</span>
              </div>
            </div>

            <!-- TIER 2: Executive Board Officers (4 Cards) -->
            <div class="org-tier-box" data-reveal>
              <div class="org-tier-header">
                <span class="org-tier-label">
                  <span class="tier-icon-svg">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                  </span>
                  <span data-i18n="lead_tier_exec"><?php echo esc_html(cha_get_option('tier_exec_title', 'Executive Board Officers')); ?></span>
                </span>
              </div>
              <div class="leadership-grid">
                <!-- 1. Run C. Rithy -->
                <div class="leader-card card-president" data-reveal>
                  <div class="leader-photo">
                    <img src="<?php echo esc_url(cha_get_option('leader_1_img', get_template_directory_uri() . '/leader-1.png')); ?>" alt="Run C. Rithy" loading="lazy">
                  </div>
                  <div class="leader-info">
                    <span class="role-pill pill-red" data-i18n="lead_role_pres"><?php echo esc_html(cha_get_option('leader_1_role', 'President')); ?></span>
                    <h3 class="leader-name" data-i18n="lead_name_chanthearithy"><?php echo esc_html(cha_get_option('leader_1_name', 'Run C. Rithy')); ?></h3>
                  </div>
                </div>

                <!-- 2. Noeurn Syneang -->
                <div class="leader-card card-vp" data-reveal>
                  <div class="leader-photo">
                    <img src="<?php echo esc_url(cha_get_option('leader_2_img', get_template_directory_uri() . '/leader-2.png')); ?>" alt="Noeurn Syneang" loading="lazy">
                  </div>
                  <div class="leader-info">
                    <span class="role-pill pill-blue" data-i18n="lead_role_vp"><?php echo esc_html(cha_get_option('leader_2_role', 'Vice President')); ?></span>
                    <h3 class="leader-name" data-i18n="lead_name_syneang"><?php echo esc_html(cha_get_option('leader_2_name', 'Noeurn Syneang')); ?></h3>
                  </div>
                </div>

                <!-- 3. Soung Somaly -->
                <div class="leader-card card-treasurer" data-reveal>
                  <div class="leader-photo">
                    <img src="<?php echo esc_url(cha_get_option('leader_3_img', get_template_directory_uri() . '/leader-3.png')); ?>" alt="Soung Somaly" loading="lazy">
                  </div>
                  <div class="leader-info">
                    <span class="role-pill pill-purple" data-i18n="lead_role_treasurer"><?php echo esc_html(cha_get_option('leader_3_role', 'Head of Finance')); ?></span>
                    <h3 class="leader-name" data-i18n="lead_name_somaly"><?php echo esc_html(cha_get_option('leader_3_name', 'Soung Somaly')); ?></h3>
                  </div>
                </div>

                <!-- 4. Hun Choryee -->
                <div class="leader-card card-secgen" data-reveal>
                  <div class="leader-photo">
                    <img src="<?php echo esc_url(cha_get_option('leader_4_img', get_template_directory_uri() . '/leader-4.png')); ?>" alt="Hun Choryee" loading="lazy">
                  </div>
                  <div class="leader-info">
                    <span class="role-pill pill-gold" data-i18n="lead_role_secgen"><?php echo esc_html(cha_get_option('leader_4_role', 'Secretary General')); ?></span>
                    <h3 class="leader-name" data-i18n="lead_name_choryee"><?php echo esc_html(cha_get_option('leader_4_name', 'Hun Choryee')); ?></h3>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tier Transition Badge: Department Directors & Regional Leads -->
            <div class="org-motto-banner" data-reveal>
              <div class="org-motto-pill">
                <span data-i18n="lead_flow_depts">Department Directors &amp; Regional Leads</span>
              </div>
            </div>

            <!-- TIER 3: Department Directors & Regional Leads (4 Cards) -->
            <div class="org-tier-box" data-reveal>
              <div class="leadership-grid">
                <!-- 1. Sreng Sung -->
                <div class="leader-card" data-reveal>
                  <div class="leader-photo">
                    <img src="<?php echo esc_url(cha_get_option('council_dept_1_img', get_template_directory_uri() . '/dept-1.png')); ?>" alt="Sreng Sung" loading="lazy">
                  </div>
                  <div class="leader-info">
                    <span class="role-pill pill-blue" data-i18n="dept_badge_1">CHA Supporting Group</span>
                    <h3 class="leader-name" data-i18n="dept_name_1">Sreng Sung</h3>
                  </div>
                </div>

                <!-- 2. Oum Naro -->
                <div class="leader-card" data-reveal>
                  <div class="leader-photo">
                    <img src="<?php echo esc_url(cha_get_option('council_dept_2_img', get_template_directory_uri() . '/dept-2.png')); ?>" alt="Oum Naro" loading="lazy">
                  </div>
                  <div class="leader-info">
                    <span class="role-pill pill-blue" data-i18n="dept_badge_2">Head of Digital</span>
                    <h3 class="leader-name" data-i18n="dept_name_2">Oum Naro</h3>
                  </div>
                </div>

                <!-- 3. Kan Sokkhai -->
                <div class="leader-card" data-reveal>
                  <div class="leader-photo">
                    <img src="<?php echo esc_url(cha_get_option('council_dept_3_img', get_template_directory_uri() . '/dept-3.png')); ?>" alt="Kan Sokkhai" loading="lazy">
                  </div>
                  <div class="leader-info">
                    <span class="role-pill pill-blue" data-i18n="dept_badge_3">Head of Reaction Unit</span>
                    <h3 class="leader-name" data-i18n="dept_name_3">Kan Sokkhai</h3>
                  </div>
                </div>

                <!-- 4. Sath Dara -->
                <div class="leader-card" data-reveal>
                  <div class="leader-photo">
                    <img src="<?php echo esc_url(cha_get_option('council_dept_5_img', get_template_directory_uri() . '/dept-5.png')); ?>" alt="Sath Dara" loading="lazy">
                  </div>
                  <div class="leader-info">
                    <span class="role-pill pill-blue" data-i18n="dept_badge_5">Deputy Secretary General &amp; Head of Volunteers</span>
                    <h3 class="leader-name" data-i18n="dept_name_5">Sath Dara</h3>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- TIER 3: Specialized Working Groups & Chapter Hubs (4 Groups) -->
        <div class="community-hubs-wrapper" data-reveal>
          <div class="hubs-heading-wrap">
            <span class="leadership-eyebrow">
              <span class="eyebrow-dot"></span>
              <span data-i18n="hubs_eyebrow">Grassroots &amp; Operational Networks</span>
            </span>
            <h3 class="hubs-title" data-i18n="hubs_title">Specialized Working Groups &amp; Regional Chapters</h3>
            <p class="hubs-subtitle" data-i18n="hubs_subtitle">On-the-ground patient empowerment, youth advocacy, women’s care circles, and provincial hospital outreach across Cambodia.</p>
          </div>

          <div class="hubs-action-grid">
            <!-- Hub 1: Youth Group -->
            <article class="hub-action-card" data-reveal>
              <div class="hub-banner-media">
                <img src="<?php echo esc_url(cha_get_option('hub_youth_img', get_template_directory_uri() . '/news-youth.jpg')); ?>" alt="CHA Youth Group" class="hub-banner-img" loading="lazy" />
                <div class="hub-banner-overlay"></div>
                <div class="hub-banner-badge badge-blue">
                  <span class="hub-badge-pill" data-i18n="hub_badge_youth">Youth Advocacy</span>
                  <span class="hub-roster-count" data-i18n="hub_count_7">7 Members</span>
                </div>
              </div>
              <div class="hub-body-content">
                <h4 class="hub-name" data-i18n="leadership_youth_title"><?php echo esc_html(cha_get_option('youth_title', 'Youth Group')); ?></h4>
                <p class="hub-mission-desc" data-i18n="leadership_youth_desc"><?php echo esc_html(cha_get_option('youth_desc', 'A vibrant network of young patients and advocates leading awareness campaigns, peer-to-peer mentoring, and youth workshops across Cambodia.')); ?></p>
                
                <div class="hub-profile-lead">
                  <?php $y_leader = cha_get_option('hub_youth_leader_img', ''); ?>
                  <?php if ($y_leader): ?>
                    <img src="<?php echo esc_url($y_leader); ?>" alt="Mr. Keopich Chanda" class="hub-lead-avatar" />
                  <?php else: ?>
                    <div class="hub-lead-avatar">KC</div>
                  <?php endif; ?>
                  <div class="hub-lead-info">
                    <span class="hub-lead-role" data-i18n="hub_role_leader">Group Leader</span>
                    <strong class="hub-lead-name" data-i18n="hub_lead_kc">Mr. Keopich Chanda</strong>
                    <span class="hub-lead-oversight" data-i18n="hub_oversight_1">Supervised by Mr. Run Chanthearithy &amp; Mr. Kan Sokkhai</span>
                  </div>
                </div>

                <div class="hub-action-footer">
                  <div class="hub-roster-bar">
                    <div class="hub-avatar-stack">
                      <?php foreach (array('youth_m1'=>'SO|Say Ouksaphea','youth_m2'=>'KE|Ky Eangtol','youth_m3'=>'SP|Srim Pengleang','youth_m4'=>'KD|Khan Dara') as $key=>$info): ?>
                        <?php $parts=explode('|',$info); $img=cha_get_option("hub_{$key}_img",''); ?>
                        <?php if ($img): ?>
                          <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($parts[1]); ?>" class="hub-stack-avatar" />
                        <?php else: ?>
                          <span class="hub-stack-avatar" data-tooltip="<?php echo esc_attr($parts[1]); ?>"><?php echo $parts[0]; ?></span>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn-roster-pill-toggle" data-roster-target="roster-youth">
                      <span data-i18n="hub_team_7">Team (7)</span>
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                  </div>
                  <div class="hub-roster-content" id="roster-youth">
                    <div class="roster-drawer-header">
                      <div class="roster-header-info">
                        <strong data-i18n="roster_youth_title">Youth Group Team</strong>
                        <span data-i18n="roster_youth_subtitle">7 active members &amp; officers</span>
                      </div>
                      <button type="button" class="btn-roster-close" aria-label="Close roster">&times;</button>
                    </div>
                    <div class="roster-members-list">
                      <?php
                      $youth_roster = array(
                        array('youth_m1','SO','Mr. Say Ouksaphea','Deputy Leader'),
                        array('youth_m2','KE','Mr. Ky Eangtol','Finance Coordinator'),
                        array('youth_m3','SP','Mr. Srim Pengleang','Administration'),
                        array('youth_m4','KD','Mr. Khan Dara','Youth Volunteer'),
                      );
                      foreach ($youth_roster as $m): ?>
                        <?php $img=cha_get_option("hub_{$m[0]}_img",''); ?>
                        <div class="roster-member-item">
                          <?php if ($img): ?>
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($m[2]); ?>" class="roster-item-avatar" />
                          <?php else: ?>
                            <span class="roster-item-avatar"><?php echo $m[1]; ?></span>
                          <?php endif; ?>
                          <div class="roster-item-details">
                            <strong class="roster-item-name" data-i18n="roster_youth_m<?php echo $m[1]==='SO'?'1':($m[1]==='KE'?'2':($m[1]==='SP'?'3':'4')); ?>_name"><?php echo $m[2]; ?></strong>
                            <span class="roster-item-role" data-i18n="roster_role_<?php echo $m[1]==='SO'?'deputy_leader':($m[1]==='KE'?'finance':($m[1]==='SP'?'admin':'youth_vol')); ?>"><?php echo $m[3]; ?></span>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>
            </article>

            <!-- Hub 2: Women's Group -->
            <article class="hub-action-card" data-reveal>
              <div class="hub-banner-media">
                <img src="<?php echo esc_url(cha_get_option('hub_women_img', get_template_directory_uri() . '/news-workshop-1.jpg')); ?>" alt="CHA Women's Group" class="hub-banner-img" loading="lazy" />
                <div class="hub-banner-overlay"></div>
                <div class="hub-banner-badge badge-purple">
                  <span class="hub-badge-pill" data-i18n="hub_badge_women">Women &amp; Family Care</span>
                  <span class="hub-roster-count" data-i18n="hub_count_12">12 Members</span>
                </div>
              </div>
              <div class="hub-body-content">
                <h4 class="hub-name" data-i18n="leadership_women_title"><?php echo esc_html(cha_get_option('women_title', "Women's Group")); ?></h4>
                <p class="hub-mission-desc" data-i18n="leadership_women_desc"><?php echo esc_html(cha_get_option('women_desc', "Dedicated support circles and medical education for mothers, female bleeders, and carriers navigating von Willebrand disease and haemophilia.")); ?></p>
                
                <div class="hub-profile-lead">
                  <?php $w_leader = cha_get_option('hub_women_leader_img', ''); ?>
                  <?php if ($w_leader): ?>
                    <img src="<?php echo esc_url($w_leader); ?>" alt="Mrs. Sum Roatha" class="hub-lead-avatar purple-avatar" />
                  <?php else: ?>
                    <div class="hub-lead-avatar purple-avatar">SR</div>
                  <?php endif; ?>
                  <div class="hub-lead-info">
                    <span class="hub-lead-role" data-i18n="hub_role_leader">Group Leader</span>
                    <strong class="hub-lead-name" data-i18n="hub_lead_sr">Mrs. Sum Roatha</strong>
                    <span class="hub-lead-oversight" data-i18n="hub_oversight_1">Supervised by Mr. Run Chanthearithy &amp; Mr. Kan Sokkhai</span>
                  </div>
                </div>

                <div class="hub-action-footer">
                  <div class="hub-roster-bar">
                    <div class="hub-avatar-stack">
                      <?php foreach (array('women_m1'=>'YM|Yim Mary','women_m2'=>'HS|Him Somala','women_m3'=>'SS|Srim Sreypich') as $key=>$info): ?>
                        <?php $parts=explode('|',$info); $img=cha_get_option("hub_{$key}_img",''); ?>
                        <?php if ($img): ?>
                          <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($parts[1]); ?>" class="hub-stack-avatar purple-avatar" />
                        <?php else: ?>
                          <span class="hub-stack-avatar purple-avatar" data-tooltip="<?php echo esc_attr($parts[1]); ?>"><?php echo $parts[0]; ?></span>
                        <?php endif; ?>
                      <?php endforeach; ?>
                      <span class="hub-stack-avatar purple-avatar" data-tooltip="+8 more members">+8</span>
                    </div>
                    <button type="button" class="btn-roster-pill-toggle" data-roster-target="roster-women">
                      <span data-i18n="hub_team_12">Team (12)</span>
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                  </div>
                  <div class="hub-roster-content" id="roster-women">
                    <div class="roster-drawer-header">
                      <div class="roster-header-info">
                        <strong data-i18n="roster_women_title">Women's Group Team</strong>
                        <span data-i18n="roster_women_subtitle">12 active members &amp; officers</span>
                      </div>
                      <button type="button" class="btn-roster-close" aria-label="Close roster">&times;</button>
                    </div>
                    <div class="roster-members-list">
                      <?php
                      $women_roster = array(
                        array('women_m1','YM','Mrs. Yim Mary','Deputy Leader'),
                        array('women_m2','HS','Mrs. Him Somala','Finance Coordinator'),
                        array('women_m3','SS','Mrs. Srim Sreypich','Administration'),
                        array('women_m4','TK','Mrs. Try Kakada','Member'),
                        array('women_m5','PS','Mrs. Phon Sokny','Member'),
                        array('women_m6','SP','Mrs. Som Phalla','Member'),
                        array('women_m7','HS','Mrs. Heng Sim','Member'),
                        array('women_m8','TS','Mrs. Touch Socheata','Member'),
                        array('women_m9','HS','Mrs. Hou Sreyny','Member'),
                      );
                      foreach ($women_roster as $m): ?>
                        <?php $img=cha_get_option("hub_{$m[0]}_img",''); ?>
                        <div class="roster-member-item">
                          <?php if ($img): ?>
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($m[2]); ?>" class="roster-item-avatar purple-avatar" />
                          <?php else: ?>
                            <span class="roster-item-avatar purple-avatar"><?php echo $m[1]; ?></span>
                          <?php endif; ?>
                          <div class="roster-item-details">
                            <strong class="roster-item-name"><?php echo $m[2]; ?></strong>
                            <span class="roster-item-role"><?php echo $m[3]; ?></span>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>
            </article>

            <!-- Hub 3: Siem Reap Chapter (SRC) -->
            <article class="hub-action-card" data-reveal>
              <div class="hub-banner-media">
                <img src="<?php echo esc_url(cha_get_option('hub_src_img', get_template_directory_uri() . '/siem-reap-hospital.jpg')); ?>" alt="CHA Siem Reap Chapter" class="hub-banner-img" loading="lazy" />
                <div class="hub-banner-overlay"></div>
                <div class="hub-banner-badge badge-teal">
                  <span class="hub-badge-pill" data-i18n="hub_badge_src">Northwest Regional Hub</span>
                  <span class="hub-roster-count" data-i18n="hub_count_6">6 Members</span>
                </div>
              </div>
              <div class="hub-body-content">
                <h4 class="hub-name" data-i18n="hub_name_src">Siem Reap Chapter (SRC)</h4>
                <p class="hub-mission-desc" data-i18n="hub_desc_src">Coordinating regional clinical outreach, emergency clotting factor delivery, and hospital care with Angkor Hospital for Children and local health centres.</p>
                
                <div class="hub-profile-lead">
                  <?php $src_leader = cha_get_option('hub_src_leader_img', ''); ?>
                  <?php if ($src_leader): ?>
                    <img src="<?php echo esc_url($src_leader); ?>" alt="Mr. Sreng Sung" class="hub-lead-avatar teal-avatar" />
                  <?php else: ?>
                    <div class="hub-lead-avatar teal-avatar">SS</div>
                  <?php endif; ?>
                  <div class="hub-lead-info">
                    <span class="hub-lead-role" data-i18n="hub_role_chapter_head">Chapter Head</span>
                    <strong class="hub-lead-name" data-i18n="hub_lead_ss">Mr. Sreng Sung</strong>
                    <span class="hub-lead-oversight" data-i18n="hub_oversight_src">Clinical Advisor: Dr. Sing Heng (Medical Advisor)</span>
                  </div>
                </div>

                <div class="hub-action-footer">
                  <div class="hub-roster-bar">
                    <div class="hub-avatar-stack">
                      <?php foreach (array('src_m1'=>'RC|Run Chanthearithy','src_m2'=>'KS|Keo Sovandy','src_m3'=>'SS|Sun Sokhorn','src_m4'=>'PP|Pach Panhavorinvong') as $key=>$info): ?>
                        <?php $parts=explode('|',$info); $img=cha_get_option("hub_{$key}_img",''); ?>
                        <?php if ($img): ?>
                          <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($parts[1]); ?>" class="hub-stack-avatar teal-avatar" />
                        <?php else: ?>
                          <span class="hub-stack-avatar teal-avatar" data-tooltip="<?php echo esc_attr($parts[1]); ?>"><?php echo $parts[0]; ?></span>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn-roster-pill-toggle" data-roster-target="roster-src">
                      <span data-i18n="hub_team_6">Team (6)</span>
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                  </div>
                  <div class="hub-roster-content" id="roster-src">
                    <div class="roster-drawer-header">
                      <div class="roster-header-info">
                        <strong data-i18n="roster_src_title">Siem Reap Chapter Team</strong>
                        <span data-i18n="roster_src_subtitle">6 active members &amp; officers</span>
                      </div>
                      <button type="button" class="btn-roster-close" aria-label="Close roster">&times;</button>
                    </div>
                    <div class="roster-members-list">
                      <?php
                      $src_roster = array(
                        array('src_m1','RC','Mr. Run Chanthearithy','Supervisor'),
                        array('src_m2','KS','Ms. Keo Sovandy','Finance Coordinator'),
                        array('src_m3','SS','Mrs. Sun Sokhorn','Administration'),
                        array('src_m4','PP','Mr. Pach Panhavorinvong','Regional Volunteer'),
                      );
                      foreach ($src_roster as $m): ?>
                        <?php $img=cha_get_option("hub_{$m[0]}_img",''); ?>
                        <div class="roster-member-item">
                          <?php if ($img): ?>
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($m[2]); ?>" class="roster-item-avatar teal-avatar" />
                          <?php else: ?>
                            <span class="roster-item-avatar teal-avatar"><?php echo $m[1]; ?></span>
                          <?php endif; ?>
                          <div class="roster-item-details">
                            <strong class="roster-item-name"><?php echo $m[2]; ?></strong>
                            <span class="roster-item-role"><?php echo $m[3]; ?></span>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>
            </article>

            <!-- Hub 4: Volunteer Group -->
            <article class="hub-action-card" data-reveal>
              <div class="hub-banner-media">
                <img src="<?php echo esc_url(cha_get_option('hub_volunteer_img', get_template_directory_uri() . '/family.jpg')); ?>" alt="CHA Volunteer Network" class="hub-banner-img" loading="lazy" />
                <div class="hub-banner-overlay"></div>
                <div class="hub-banner-badge badge-red">
                  <span class="hub-badge-pill" data-i18n="hub_badge_volunteers">Community Field Force</span>
                  <span class="hub-roster-count" data-i18n="hub_count_12">12 Members</span>
                </div>
              </div>
              <div class="hub-body-content">
                <h4 class="hub-name" data-i18n="hub_name_volunteers">Volunteer Network</h4>
                <p class="hub-mission-desc" data-i18n="hub_desc_volunteers">Frontline volunteers mobilizing across provinces to support patient hospital transport, community roadshows, emergency donation logistics, and blood drives.</p>
                
                <div class="hub-profile-lead">
                  <?php $v_leader = cha_get_option('hub_vol_leader_img', ''); ?>
                  <?php if ($v_leader): ?>
                    <img src="<?php echo esc_url($v_leader); ?>" alt="Mr. Sath Dara" class="hub-lead-avatar red-avatar" />
                  <?php else: ?>
                    <div class="hub-lead-avatar red-avatar">SD</div>
                  <?php endif; ?>
                  <div class="hub-lead-info">
                    <span class="hub-lead-role" data-i18n="hub_role_network_leader">Network Leader</span>
                    <strong class="hub-lead-name" data-i18n="hub_lead_sd">Mr. Sath Dara</strong>
                    <span class="hub-lead-oversight" data-i18n="hub_oversight_1">Supervised by Mr. Run Chanthearithy &amp; Mr. Kan Sokkhai</span>
                  </div>
                </div>

                <div class="hub-action-footer">
                  <div class="hub-roster-bar">
                    <div class="hub-avatar-stack">
                      <?php foreach (array('vol_m1'=>'CS|Chor Sonita','vol_m2'=>'SV|Srin Vinching','vol_m3'=>'OS|Oeun Sreyneath') as $key=>$info): ?>
                        <?php $parts=explode('|',$info); $img=cha_get_option("hub_{$key}_img",''); ?>
                        <?php if ($img): ?>
                          <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($parts[1]); ?>" class="hub-stack-avatar red-avatar" />
                        <?php else: ?>
                          <span class="hub-stack-avatar red-avatar" data-tooltip="<?php echo esc_attr($parts[1]); ?>"><?php echo $parts[0]; ?></span>
                        <?php endif; ?>
                      <?php endforeach; ?>
                      <span class="hub-stack-avatar red-avatar" data-tooltip="+8 frontline volunteers">+8</span>
                    </div>
                    <button type="button" class="btn-roster-pill-toggle" data-roster-target="roster-volunteer">
                      <span data-i18n="hub_team_12">Team (12)</span>
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                  </div>
                  <div class="hub-roster-content" id="roster-volunteer">
                    <div class="roster-drawer-header">
                      <div class="roster-header-info">
                        <strong data-i18n="roster_vol_title">Volunteer Network Team</strong>
                        <span data-i18n="roster_vol_subtitle">12 active members &amp; volunteers</span>
                      </div>
                      <button type="button" class="btn-roster-close" aria-label="Close roster">&times;</button>
                    </div>
                    <div class="roster-members-list">
                      <?php
                      $vol_roster = array(
                        array('vol_m1','CS','Ms. Chor Sonita','Deputy Leader'),
                        array('vol_m2','SV','Ms. Srin Vinching','Finance Coordinator'),
                        array('vol_m3','OS','Ms. Oeun Sreyneath','Administration'),
                        array('vol_m4','PL','Mr. Pov Lay','Field Volunteer'),
                        array('vol_m5','PS','Mr. Phorn Soveat','Field Volunteer'),
                        array('vol_m6','MB','Mr. Mom Bunthart','Field Volunteer'),
                        array('vol_m7','YT','Mr. Yong Tetyutthuon','Field Volunteer'),
                        array('vol_m8','NV','Ms. Noeurn SoVannitta','Field Volunteer'),
                      );
                      foreach ($vol_roster as $m): ?>
                        <?php $img=cha_get_option("hub_{$m[0]}_img",''); ?>
                        <div class="roster-member-item">
                          <?php if ($img): ?>
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($m[2]); ?>" class="roster-item-avatar red-avatar" />
                          <?php else: ?>
                            <span class="roster-item-avatar red-avatar"><?php echo $m[1]; ?></span>
                          <?php endif; ?>
                          <div class="roster-item-details">
                            <strong class="roster-item-name"><?php echo $m[2]; ?></strong>
                            <span class="roster-item-role"><?php echo $m[3]; ?></span>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    <section class="section wfh-flagship-section" id="about-wfh">
      <div class="wfh-ambient-sphere wfh-sphere-1" aria-hidden="true"></div>
      <div class="wfh-ambient-sphere wfh-sphere-2" aria-hidden="true"></div>
      
      <div class="container">
        <!-- Section Header: Centered & Balanced -->
        <div class="wfh-flagship-header" data-reveal>
          <div class="wfh-header-main">
            <span class="leadership-eyebrow">
              <span class="eyebrow-dot"></span>
              <span data-i18n="wfh_alliances_eyebrow">Global Alliances &amp; International Twinning</span>
            </span>
            <h2 class="wfh-title-hero" data-i18n="wfh_heading"><?php echo esc_html(cha_get_option('wfh_heading', 'Our Work with WFH & HFA')); ?></h2>
            <p class="wfh-desc-hero" data-i18n="wfh_sub"><?php echo esc_html(cha_get_option('wfh_sub', 'CHA proudly partners with leading global organizations to strengthen haemophilia care across Cambodia.')); ?></p>
          </div>

          <!-- Interactive Partner Selector Switch -->
          <div class="wfh-partner-switch" role="tablist" aria-label="International Partners">
            <button type="button" class="partner-switch-btn is-active" role="tab" aria-selected="true" aria-controls="partner-wfh" id="tab-wfh" data-partner-target="partner-wfh">
              <span class="switch-flag">🌐</span>
              <span class="switch-name" data-i18n="wfh_switch_wfh">World Federation of Hemophilia</span>
            </button>
            <button type="button" class="partner-switch-btn" role="tab" aria-selected="false" aria-controls="partner-hfa" id="tab-hfa" data-partner-target="partner-hfa">
              <span class="switch-flag">🇦🇺</span>
              <span class="switch-name" data-i18n="wfh_switch_hfa">Haemophilia Foundation Australia</span>
            </button>
          </div>
        </div>

        <!-- Flagship Showcase Panels -->
        <div class="wfh-flagship-panels" data-reveal>
          
          <!-- PANEL 1: World Federation of Hemophilia -->
          <article class="wfh-showcase-panel is-active theme-wfh" id="partner-wfh" role="tabpanel" aria-labelledby="tab-wfh">
            <div class="wfh-panel-watermark" aria-hidden="true">WFH</div>
            
            <div class="wfh-panel-content">
              <div class="wfh-panel-eyebrow">
                <span class="panel-tier-pill" data-i18n="wfh_wfh_tag"><?php echo esc_html(cha_get_option('wfh_card_tag', 'Member Since 2014')); ?></span>
                <span class="panel-hq-info">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                  <span data-i18n="wfh_hq_montreal">Montreal, Canada · Global Federation</span>
                </span>
              </div>

              <h3 class="wfh-panel-title" data-i18n="wfh_wfh_name"><?php echo esc_html(cha_get_option('wfh_card_title', 'World Federation of Hemophilia')); ?></h3>
              
              <p class="wfh-panel-summary" data-i18n="wfh_wfh_desc">
                <?php echo esc_html(cha_get_option('wfh_card_desc', 'Global member of the WFH network. Through this partnership, CHA accesses international treatment guidelines, training programs, and humanitarian aid that directly improve patient care.')); ?>
              </p>

              <!-- Impact Metric Counters -->
              <div class="wfh-metric-row">
                <div class="wfh-metric-box">
                  <span class="wfh-metric-val">140+</span>
                  <span class="wfh-metric-lbl" data-i18n="wfh_wfh_stat_label"><?php echo esc_html(cha_get_option('wfh_card_stat_lbl', 'Countries in Network')); ?></span>
                </div>
                <div class="wfh-metric-box">
                  <span class="wfh-metric-val">10+ Yrs</span>
                  <span class="wfh-metric-lbl" data-i18n="wfh_metric_membership">Active Membership</span>
                </div>
                <div class="wfh-metric-box">
                  <span class="wfh-metric-val">100%</span>
                  <span class="wfh-metric-lbl" data-i18n="wfh_metric_passthrough">Humanitarian Pass-through</span>
                </div>
              </div>

              <!-- Strategic Pillar Checklist -->
              <div class="wfh-deliverables-list">
                <div class="wfh-deliverable-item">
                  <span class="deliverable-check">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                  </span>
                  <div class="deliverable-text-wrap">
                    <strong class="deliverable-title" data-i18n="wfh_p1_title">Humanitarian Aid &amp; Factor Donations</strong>
                    <p class="deliverable-desc" data-i18n="wfh_p1_desc">Securing emergency clotting factor concentrates distributed directly to treatment centers across Cambodia.</p>
                  </div>
                </div>

                <div class="wfh-deliverable-item">
                  <span class="deliverable-check">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                  </span>
                  <div class="deliverable-text-wrap">
                    <strong class="deliverable-title" data-i18n="wfh_p2_title">Standardized Clinical Guidelines</strong>
                    <p class="deliverable-desc" data-i18n="wfh_p2_desc">Deploying WFH international diagnostic standards and comprehensive care models for Cambodian pediatric clinics.</p>
                  </div>
                </div>

                <div class="wfh-deliverable-item">
                  <span class="deliverable-check">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                  </span>
                  <div class="deliverable-text-wrap">
                    <strong class="deliverable-title" data-i18n="wfh_p3_title">Global Advocacy &amp; Assembly Representation</strong>
                    <p class="deliverable-desc" data-i18n="wfh_p3_desc">Representing Cambodian bleeding disorder patients at the biennial WFH World Congress.</p>
                  </div>
                </div>
              </div>

              <!-- Action Bar -->
              <div class="wfh-panel-actions">
                <a class="btn-flagship-primary" href="https://wfh.org" target="_blank" rel="noopener noreferrer">
                  <span><span data-i18n="wfh_wfh_link"><?php echo esc_html(cha_get_option('wfh_card_link', 'Visit WFH')); ?></span> <span data-i18n="wfh_official_portal">Official Portal</span></span>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </a>
                <button type="button" class="btn-flagship-secondary" data-partner-switch="partner-hfa">
                  <span data-i18n="wfh_btn_explore_hfa">Explore HFA Australia Twinning</span>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
              </div>
            </div>

            <!-- Media Column -->
            <div class="wfh-panel-media">
              <div class="wfh-media-frame">
                <img src="<?php echo esc_url(cha_get_option('wfh_media_img', get_template_directory_uri() . '/partner-wfh-congress.jpg')); ?>" alt="World Federation of Hemophilia Congress" class="wfh-media-img" loading="lazy" />
                <div class="wfh-media-glass-card">
                  <div class="glass-crest-box">
                    <svg viewBox="0 0 48 48" fill="none" aria-hidden="true">
                      <circle cx="24" cy="24" r="22" stroke="currentColor" stroke-width="2" stroke-opacity="0.3"/>
                      <circle cx="24" cy="24" r="10" stroke="currentColor" stroke-width="2"/>
                      <ellipse cx="24" cy="24" rx="7" ry="18" stroke="currentColor" stroke-width="1.8"/>
                      <line x1="6" y1="24" x2="42" y2="24" stroke="currentColor" stroke-width="1.8"/>
                    </svg>
                  </div>
                  <div>
                    <strong class="glass-title" data-i18n="wfh_glass_title">WFH Global Network</strong>
                    <span class="glass-subtitle" data-i18n="wfh_glass_subtitle">Recognized National Member Organization</span>
                  </div>
                </div>
                <div class="wfh-floating-pill pill-top">
                  <span class="pulse-dot"></span>
                  <span data-i18n="wfh_pill_member_since">Official Member · Since 2014</span>
                </div>
              </div>
            </div>
          </article>

          <!-- PANEL 2: Haemophilia Foundation Australia -->
          <article class="wfh-showcase-panel theme-hfa" id="partner-hfa" role="tabpanel" aria-labelledby="tab-hfa">
            <div class="wfh-panel-watermark" aria-hidden="true">HFA</div>
            
            <div class="wfh-panel-content">
              <div class="wfh-panel-eyebrow">
                <span class="panel-tier-pill pill-purple" data-i18n="wfh_hfa_tag"><?php echo esc_html(cha_get_option('hfa_card_tag', 'Training Partner')); ?></span>
                <span class="panel-hq-info">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                  <span data-i18n="wfh_hq_melbourne">Melbourne, Australia · Twinning Alliance</span>
                </span>
              </div>

              <h3 class="wfh-panel-title" data-i18n="wfh_hfa_name"><?php echo esc_html(cha_get_option('hfa_card_title', 'Haemophilia Foundation Australia')); ?></h3>
              
              <p class="wfh-panel-summary" data-i18n="wfh_hfa_desc">
                <?php echo esc_html(cha_get_option('hfa_card_desc', 'HFA partners with CHA on capacity building, clinical training, and patient advocacy. Joint programs connect Cambodian clinicians with Australian expertise.')); ?>
              </p>

              <!-- Impact Metric Counters -->
              <div class="wfh-metric-row">
                <div class="wfh-metric-box">
                  <span class="wfh-metric-val val-purple">15+</span>
                  <span class="wfh-metric-lbl" data-i18n="wfh_hfa_stat_label"><?php echo esc_html(cha_get_option('hfa_card_stat_lbl', 'Joint Programs')); ?></span>
                </div>
                <div class="wfh-metric-box">
                  <span class="wfh-metric-val val-purple">120+</span>
                  <span class="wfh-metric-lbl" data-i18n="wfh_metric_clinicians">Clinicians Mentored</span>
                </div>
                <div class="wfh-metric-box">
                  <span class="wfh-metric-val val-purple" data-i18n="wfh_metric_bilateral_val">Bilateral</span>
                  <span class="wfh-metric-lbl" data-i18n="wfh_metric_bilateral_lbl">Active Twinning</span>
                </div>
              </div>

              <!-- Strategic Pillar Checklist -->
              <div class="wfh-deliverables-list">
                <div class="wfh-deliverable-item">
                  <span class="deliverable-check check-purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                  </span>
                  <div class="deliverable-text-wrap">
                    <strong class="deliverable-title" data-i18n="wfh_hfa_p1_title">Clinical Mentorship &amp; Medical Fellowships</strong>
                    <p class="deliverable-desc" data-i18n="wfh_hfa_p1_desc">Connecting Australian senior hematologists with Cambodian doctors and hospital staff.</p>
                  </div>
                </div>

                <div class="wfh-deliverable-item">
                  <span class="deliverable-check check-purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                  </span>
                  <div class="deliverable-text-wrap">
                    <strong class="deliverable-title" data-i18n="wfh_hfa_p2_title">Specialized Nurse &amp; Physiotherapy Workshops</strong>
                    <p class="deliverable-desc" data-i18n="wfh_hfa_p2_desc">Practical rehabilitation guidance to prevent joint immobility and muscle bleeding complications.</p>
                  </div>
                </div>

                <div class="wfh-deliverable-item">
                  <span class="deliverable-check check-purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                  </span>
                  <div class="deliverable-text-wrap">
                    <strong class="deliverable-title" data-i18n="wfh_hfa_p3_title">Youth &amp; Family Advocacy Camps</strong>
                    <p class="deliverable-desc" data-i18n="wfh_hfa_p3_desc">Empowering parents, carriers, and youth ambassadors with self-infusion and psychosocial support.</p>
                  </div>
                </div>
              </div>

              <!-- Action Bar -->
              <div class="wfh-panel-actions">
                <a class="btn-flagship-primary btn-purple" href="https://www.haemophilia.org.au" target="_blank" rel="noopener noreferrer">
                  <span><span data-i18n="wfh_hfa_link"><?php echo esc_html(cha_get_option('hfa_card_link', 'Learn More')); ?></span> <span data-i18n="wfh_at_hfa">at HFA Australia</span></span>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </a>
                <button type="button" class="btn-flagship-secondary" data-partner-switch="partner-wfh">
                  <span data-i18n="wfh_btn_view_wfh">View WFH Global Partnership</span>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
              </div>
            </div>

            <!-- Media Column -->
            <div class="wfh-panel-media">
              <div class="wfh-media-frame">
                <img src="<?php echo esc_url(cha_get_option('hfa_media_img', get_template_directory_uri() . '/partner-hfa-training.jpg')); ?>" alt="HFA Clinical Training and Mentorship in Cambodia" class="wfh-media-img" loading="lazy" />
                <div class="wfh-media-glass-card">
                  <div class="glass-crest-box crest-purple">
                    <svg viewBox="0 0 48 48" fill="none" aria-hidden="true">
                      <circle cx="24" cy="24" r="22" stroke="currentColor" stroke-width="2" stroke-opacity="0.3"/>
                      <path d="M24 10c-5.5 0-10 4.2-10 9.8 0 7.8 10 18.2 10 18.2s10-10.4 10-18.2c0-5.6-4.5-9.8-10-9.8z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                      <circle cx="24" cy="20" r="3.5" fill="currentColor"/>
                    </svg>
                  </div>
                  <div>
                    <strong class="glass-title" data-i18n="wfh_hfa_glass_title">Australia Twinning Alliance</strong>
                    <span class="glass-subtitle" data-i18n="wfh_hfa_glass_subtitle">Capacity Building &amp; Clinical Mentorship</span>
                  </div>
                </div>
                <div class="wfh-floating-pill pill-top pill-purple">
                  <span class="pulse-dot"></span>
                  <span data-i18n="wfh_pill_twinning_partner">Twinning Program Partner</span>
                </div>
              </div>
            </div>
          </article>

        </div>
      </div>
    </section>

  </main>

  <?php get_footer(); ?>
