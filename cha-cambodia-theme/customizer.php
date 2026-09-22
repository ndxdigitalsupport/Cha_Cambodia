<?php
if (!defined('ABSPATH')) exit;

function cha_customize_register($wp_customize) {

    /* ============================================================
       PANEL: Homepage Content
       ============================================================ */
    $wp_customize->add_panel('cha_homepage', array(
        'title'    => 'Homepage Content',
        'priority' => 30,
    ));

    /* ---- Section: Hero ---- */
    $wp_customize->add_section('cha_hero', array(
        'title' => 'Hero Section',
        'panel' => 'cha_homepage',
    ));

    $wp_customize->add_setting('hero_image', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array('label' => 'Background Image', 'section' => 'cha_hero')));

    $wp_customize->add_setting('hero_title_1', array('default' => 'Together We Care.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_title_1', array('label' => 'Title Line 1 (EN)', 'section' => 'cha_hero', 'type' => 'text'));

    $wp_customize->add_setting('hero_title_1_km', array('default' => 'យើងថែទាំគ្នា', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_title_1_km', array('label' => 'Title Line 1 (KM)', 'section' => 'cha_hero', 'type' => 'text'));

    $wp_customize->add_setting('hero_title_2', array('default' => 'Together We Change Lives.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_title_2', array('label' => 'Title Line 2 (EN)', 'section' => 'cha_hero', 'type' => 'text'));

    $wp_customize->add_setting('hero_title_2_km', array('default' => 'យើងផ្លាស់ប្តូរជីវិត', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_title_2_km', array('label' => 'Title Line 2 (KM)', 'section' => 'cha_hero', 'type' => 'text'));

    $wp_customize->add_setting('hero_lead', array('default' => 'Supporting and empowering people with bleeding disorders across Cambodia.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_lead', array('label' => 'Subtitle (EN)', 'section' => 'cha_hero', 'type' => 'textarea'));

    $wp_customize->add_setting('hero_lead_km', array('default' => 'គាំទ្រ និងផ្តល់សមត្ថភាពដល់អ្នកមានអាការៈហូរឈាមនៅកម្ពុជា។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_lead_km', array('label' => 'Subtitle (KM)', 'section' => 'cha_hero', 'type' => 'textarea'));

    $wp_customize->add_setting('hero_cta_support', array('default' => 'Get Support', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_cta_support', array('label' => 'Primary Button Text (EN)', 'section' => 'cha_hero', 'type' => 'text'));

    $wp_customize->add_setting('hero_cta_support_km', array('default' => 'ទទួលជំនួយ', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_cta_support_km', array('label' => 'Primary Button Text (KM)', 'section' => 'cha_hero', 'type' => 'text'));

    $wp_customize->add_setting('hero_cta_member', array('default' => 'Become a Member', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_cta_member', array('label' => 'Secondary Button Text (EN)', 'section' => 'cha_hero', 'type' => 'text'));

    $wp_customize->add_setting('hero_cta_member_km', array('default' => 'ក្លាយជាសមាជិក', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_cta_member_km', array('label' => 'Secondary Button Text (KM)', 'section' => 'cha_hero', 'type' => 'text'));

    /* ---- Section: Statistics ---- */
    $wp_customize->add_section('cha_stats', array(
        'title' => 'Statistics',
        'panel' => 'cha_homepage',
    ));

    $wp_customize->add_setting('stat_provinces_val', array('default' => '25', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('stat_provinces_val', array('label' => 'Provinces Value', 'section' => 'cha_stats', 'type' => 'text'));

    $wp_customize->add_setting('stat_provinces_lbl', array('default' => 'Provinces and Cities', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('stat_provinces_lbl', array('label' => 'Provinces Label (EN)', 'section' => 'cha_stats', 'type' => 'text'));

    $wp_customize->add_setting('stat_provinces_lbl_km', array('default' => 'ខេត្តដែលបានគ្រប់ដណ្តប់', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('stat_provinces_lbl_km', array('label' => 'Provinces Label (KM)', 'section' => 'cha_stats', 'type' => 'text'));

    $wp_customize->add_setting('stat_patients_val', array('default' => '500+', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('stat_patients_val', array('label' => 'Patients Value', 'section' => 'cha_stats', 'type' => 'text'));

    $wp_customize->add_setting('stat_patients_lbl', array('default' => 'Hemophilia Patients', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('stat_patients_lbl', array('label' => 'Patients Label (EN)', 'section' => 'cha_stats', 'type' => 'text'));

    $wp_customize->add_setting('stat_patients_lbl_km', array('default' => 'អ្នកជំងឺដែលបានជួយ', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('stat_patients_lbl_km', array('label' => 'Patients Label (KM)', 'section' => 'cha_stats', 'type' => 'text'));

    $wp_customize->add_setting('stat_partners_val', array('default' => '15+', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('stat_partners_val', array('label' => 'Partners Value', 'section' => 'cha_stats', 'type' => 'text'));

    $wp_customize->add_setting('stat_partners_lbl', array('default' => 'Healthcare Partners', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('stat_partners_lbl', array('label' => 'Partners Label (EN)', 'section' => 'cha_stats', 'type' => 'text'));

    $wp_customize->add_setting('stat_partners_lbl_km', array('default' => 'ដៃគូថែទាំសុខភាព', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('stat_partners_lbl_km', array('label' => 'Partners Label (KM)', 'section' => 'cha_stats', 'type' => 'text'));

    /* ---- Section: How We Help ---- */
    $wp_customize->add_section('cha_help', array(
        'title' => 'How We Help',
        'panel' => 'cha_homepage',
    ));

    $wp_customize->add_setting('help_heading', array('default' => 'How We Help', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('help_heading', array('label' => 'Section Heading (EN)', 'section' => 'cha_help', 'type' => 'text'));

    $wp_customize->add_setting('help_heading_km', array('default' => 'យើងជួយដូចម្តេច', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('help_heading_km', array('label' => 'Section Heading (KM)', 'section' => 'cha_help', 'type' => 'text'));

    $wp_customize->add_setting('help_sub', array('default' => 'Four core areas where CHA makes a difference for patients and families across Cambodia.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('help_sub', array('label' => 'Section Subheading (EN)', 'section' => 'cha_help', 'type' => 'textarea'));

    $wp_customize->add_setting('help_sub_km', array('default' => 'វិស័យសំខាន់ៗចំនួនបួនដែល CHA ធ្វើឱ្យមានការផ្លាស់ប្តូរដល់អ្នកជំងឺ និងគ្រួសារនៅកម្ពុជា។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('help_sub_km', array('label' => 'Section Subheading (KM)', 'section' => 'cha_help', 'type' => 'textarea'));

    foreach (array(
        array(1, 'Patient Support', 'ជំនួយអ្នកជំងឺ', 'Emotional support, guidance and community for patients and families.', 'ជំនួយផ្លូវចិត្ត ការណែនាំ និងសហគមន៍សម្រាប់អ្នកជំងឺ និងគ្រួសារ។'),
        array(2, 'Treatment Centres', 'មជ្ឈមណ្ឌលព្យាបាល', 'Find haemophilia treatment centres near you and get the care you need.', 'ស្វែងរកមជ្ឈមណ្ឌលព្យាបាលជំងឺហេម៉ូហ្វីលាជិតអ្នក និងទទួលបានការថែទាំដែលអ្នកត្រូវការ។'),
        array(3, 'Become a Member', 'ក្លាយជាសមាជិក', 'Join our community and access exclusive resources and programs.', 'ចូលរួមជាមួយសហគមន៍របស់យើង និងទទួលបានធនធាន និងកម្មវិធីផ្តាច់មុខ។'),
        array(4, 'Donate', 'បរិច្ចាគ', 'Your support helps us provide treatment, education and hope.', 'ការគាំទ្ររបស់អ្នកជួយយើងផ្តល់ការព្យាបាល ការអប់រំ និងសង្ឃឹម។'),
    ) as $c) {
        $i = $c[0];
        $wp_customize->add_setting("help_card_{$i}_title", array('default' => $c[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("help_card_{$i}_title", array('label' => "Card {$i} Title (EN)", 'section' => 'cha_help', 'type' => 'text'));
        $wp_customize->add_setting("help_card_{$i}_title_km", array('default' => $c[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("help_card_{$i}_title_km", array('label' => "Card {$i} Title (KM)", 'section' => 'cha_help', 'type' => 'text'));
        $wp_customize->add_setting("help_card_{$i}_desc", array('default' => $c[3], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("help_card_{$i}_desc", array('label' => "Card {$i} Description (EN)", 'section' => 'cha_help', 'type' => 'textarea'));
        $wp_customize->add_setting("help_card_{$i}_desc_km", array('default' => $c[4], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("help_card_{$i}_desc_km", array('label' => "Card {$i} Description (KM)", 'section' => 'cha_help', 'type' => 'textarea'));
    }

    /* ---- Section: CTA Banner ---- */
    $wp_customize->add_section('cha_cta', array(
        'title' => 'CTA Banner',
        'panel' => 'cha_homepage',
    ));

    $wp_customize->add_setting('cta_heading', array('default' => 'Help Change Lives', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('cta_heading', array('label' => 'Heading (EN)', 'section' => 'cha_cta', 'type' => 'text'));

    $wp_customize->add_setting('cta_heading_km', array('default' => 'ជួយផ្លាស់ប្តូរជីវិត', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('cta_heading_km', array('label' => 'Heading (KM)', 'section' => 'cha_cta', 'type' => 'text'));

    $wp_customize->add_setting('cta_sub', array('default' => 'Your donation helps us provide treatment, education and hope to people with bleeding disorders in Cambodia.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('cta_sub', array('label' => 'Subheading (EN)', 'section' => 'cha_cta', 'type' => 'textarea'));

    $wp_customize->add_setting('cta_sub_km', array('default' => 'បរិច្ចាគរបស់អ្នកជួយយើងផ្តល់ការព្យាបាល ការអប់រំ និងសង្ឃឹមដល់អ្នកមានអាការៈហូរឈាមនៅកម្ពុជា។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('cta_sub_km', array('label' => 'Subheading (KM)', 'section' => 'cha_cta', 'type' => 'textarea'));

    $wp_customize->add_setting('cta_btn', array('default' => 'Donate Now', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('cta_btn', array('label' => 'Button Text (EN)', 'section' => 'cha_cta', 'type' => 'text'));

    $wp_customize->add_setting('cta_btn_km', array('default' => 'បរិច្ចាគឥឡូវ', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('cta_btn_km', array('label' => 'Button Text (KM)', 'section' => 'cha_cta', 'type' => 'text'));

    /* ---- Section: About (Home) ---- */
    $wp_customize->add_section('cha_about_home', array(
        'title' => 'About Section',
        'panel' => 'cha_homepage',
    ));

    $wp_customize->add_setting('about_heading', array('default' => 'Who is CHA?', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_heading', array('label' => 'Heading (EN)', 'section' => 'cha_about_home', 'type' => 'text'));

    $wp_customize->add_setting('about_heading_km', array('default' => 'CHA ជាអ្វី?', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_heading_km', array('label' => 'Heading (KM)', 'section' => 'cha_about_home', 'type' => 'text'));

    $wp_customize->add_setting('about_lead', array('default' => 'The Cambodian Haemophilia Association is a patient-led organization dedicated to improving the quality of life for people living with bleeding disorders across Cambodia.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_lead', array('label' => 'Subheading (EN)', 'section' => 'cha_about_home', 'type' => 'textarea'));

    $wp_customize->add_setting('about_lead_km', array('default' => 'សមាគមជំងឺហេម៉ូហ្វីលាកម្ពុជា (CHA) គឺជាអង្គការដឹកនាំដោយអ្នកជំងឺ ដែលឧទ្ទិសដល់ការកែលម្អគុណភាពជីវិតរបស់អ្នកដែលរស់នៅជាមួយអាការៈហូរឈាមនៅទូទាំងប្រទេសកម្ពុជា។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_lead_km', array('label' => 'Subheading (KM)', 'section' => 'cha_about_home', 'type' => 'textarea'));

    $wp_customize->add_setting('about_vision_label', array('default' => 'Our Vision', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_vision_label', array('label' => 'Vision Label (EN)', 'section' => 'cha_about_home', 'type' => 'text'));

    $wp_customize->add_setting('about_vision_label_km', array('default' => 'ចក្ខុវិស័យ', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_vision_label_km', array('label' => 'Vision Label (KM)', 'section' => 'cha_about_home', 'type' => 'text'));

    $wp_customize->add_setting('about_vision_text', array('default' => 'A Cambodia where every person with a bleeding disorder has access to diagnosis, treatment, and support.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_vision_text', array('label' => 'Vision Text (EN)', 'section' => 'cha_about_home', 'type' => 'textarea'));

    $wp_customize->add_setting('about_vision_text_km', array('default' => 'កម្ពុជាមួយដែលអ្នករាល់គ្នាដែលមានអាការៈហូរឈាមអាចទទួលបានការវិនិច្ឆ័យ ការព្យាបាល និងការគាំទ្រ។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_vision_text_km', array('label' => 'Vision Text (KM)', 'section' => 'cha_about_home', 'type' => 'textarea'));

    $wp_customize->add_setting('about_mission_label', array('default' => 'Our Mission', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_mission_label', array('label' => 'Mission Label (EN)', 'section' => 'cha_about_home', 'type' => 'text'));

    $wp_customize->add_setting('about_mission_label_km', array('default' => 'បេសកកម្ម', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_mission_label_km', array('label' => 'Mission Label (KM)', 'section' => 'cha_about_home', 'type' => 'text'));

    $wp_customize->add_setting('about_mission_text', array('default' => 'To advocate for quality care, educate communities, support families, and empower caregivers.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_mission_text', array('label' => 'Mission Text (EN)', 'section' => 'cha_about_home', 'type' => 'textarea'));

    $wp_customize->add_setting('about_mission_text_km', array('default' => 'ការអំពាវនាវដល់ការថែទាំដែលមានគុណភាព អប់រំសហគមន៍ គាំទ្រគ្រួសារ និងផ្តល់សមត្ថភាពដល់អ្នកថែទាំ។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('about_mission_text_km', array('label' => 'Mission Text (KM)', 'section' => 'cha_about_home', 'type' => 'textarea'));

    $wp_customize->add_setting('about_team_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_team_img', array('label' => 'Team Image', 'section' => 'cha_about_home')));

    /* ============================================================
       PANEL: Contact & Footer
       ============================================================ */
    $wp_customize->add_panel('cha_contact_footer', array(
        'title'    => 'Contact & Footer',
        'priority' => 31,
    ));

    /* ---- Section: Contact Info ---- */
    $wp_customize->add_section('cha_contact', array(
        'title' => 'Contact Information',
        'panel' => 'cha_contact_footer',
    ));

    $wp_customize->add_setting('contact_heading', array('default' => 'Contact Us', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_heading', array('label' => 'Section Heading (EN)', 'section' => 'cha_contact', 'type' => 'text'));

    $wp_customize->add_setting('contact_heading_km', array('default' => 'ទំនាក់ទំនង', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_heading_km', array('label' => 'Section Heading (KM)', 'section' => 'cha_contact', 'type' => 'text'));

    $wp_customize->add_setting('contact_sub', array('default' => "Have a question or want to get involved? We'd love to hear from you.", 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_sub', array('label' => 'Section Subheading (EN)', 'section' => 'cha_contact', 'type' => 'textarea'));

    $wp_customize->add_setting('contact_sub_km', array('default' => 'មានសំណួរឬចង់ចូលរួម? យើងរីករាយស្តាប់ពីអ្នក។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_sub_km', array('label' => 'Section Subheading (KM)', 'section' => 'cha_contact', 'type' => 'textarea'));

    $wp_customize->add_setting('contact_address', array('default' => '#100, Street Russia Blvd, Sangkat Teek Laak 1, Khan Toul Kork, Phnom Penh, Cambodia', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_address', array('label' => 'Address (EN)', 'section' => 'cha_contact', 'type' => 'textarea'));

    $wp_customize->add_setting('contact_address_km', array('default' => '#១០០ មហាវិថីសហព័ន្ធរុស្ស៊ី សង្កាត់ទឹកល្អក់១ ខណ្ឌទួលគោក រាជធានីភ្នំពេញ កម្ពុជា', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_address_km', array('label' => 'Address (KM)', 'section' => 'cha_contact', 'type' => 'textarea'));

    $wp_customize->add_setting('contact_phone', array('default' => '+855 96 260 5335', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_phone', array('label' => 'Phone (display)', 'section' => 'cha_contact', 'type' => 'text'));

    $wp_customize->add_setting('contact_phone_digits', array('default' => '+855962605335', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_phone_digits', array('label' => 'Phone (digits for tel link)', 'section' => 'cha_contact', 'type' => 'text'));

    $wp_customize->add_setting('contact_email', array('default' => 'choryee.hun@gmail.com', 'sanitize_callback' => 'sanitize_email'));
    $wp_customize->add_control('contact_email', array('label' => 'Email', 'section' => 'cha_contact', 'type' => 'email'));

    $wp_customize->add_setting('contact_hours_mf', array('default' => '8:00 — 17:00', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_hours_mf', array('label' => 'Mon–Fri Hours (EN)', 'section' => 'cha_contact', 'type' => 'text'));

    $wp_customize->add_setting('contact_hours_mf_km', array('default' => 'ម៉ោង ៨:០០ ដល់ ១៧:០០', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_hours_mf_km', array('label' => 'Mon–Fri Hours (KM)', 'section' => 'cha_contact', 'type' => 'text'));

    $wp_customize->add_setting('contact_hours_sat', array('default' => '9:00 — 13:00', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_hours_sat', array('label' => 'Saturday Hours (EN)', 'section' => 'cha_contact', 'type' => 'text'));

    $wp_customize->add_setting('contact_hours_sat_km', array('default' => 'ម៉ោង ៩:០០ ដល់ ១៣:០០', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_hours_sat_km', array('label' => 'Saturday Hours (KM)', 'section' => 'cha_contact', 'type' => 'text'));

    /* ---- Section: Footer ---- */
    $wp_customize->add_section('cha_footer', array(
        'title' => 'Footer',
        'panel' => 'cha_contact_footer',
    ));

    $wp_customize->add_setting('footer_tagline', array('default' => 'Supporting people living with bleeding disorders across Cambodia.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('footer_tagline', array('label' => 'Tagline (EN)', 'section' => 'cha_footer', 'type' => 'textarea'));

    $wp_customize->add_setting('footer_tagline_km', array('default' => 'គាំទ្រអ្នកមានអាការៈហូរឈាមនៅកម្ពុជា។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('footer_tagline_km', array('label' => 'Tagline (KM)', 'section' => 'cha_footer', 'type' => 'textarea'));

    $wp_customize->add_setting('footer_copyright', array('default' => 'Cambodian Haemophilia Association. All rights reserved.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('footer_copyright', array('label' => 'Copyright Text (EN)', 'section' => 'cha_footer', 'type' => 'text'));

    $wp_customize->add_setting('footer_copyright_km', array('default' => 'សមាគមជំងឺហេម៉ូហ្វីលាកម្ពុជា។ រក្សាសិទ្ធិគ្រប់យ៉ាង។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('footer_copyright_km', array('label' => 'Copyright Text (KM)', 'section' => 'cha_footer', 'type' => 'text'));

    /* ============================================================
       PANEL: Navigation & Header
       ============================================================ */
    $wp_customize->add_panel('cha_nav', array(
        'title'    => 'Navigation & Header',
        'priority' => 32,
    ));

    $wp_customize->add_section('cha_logo', array(
        'title' => 'Site Logo',
        'panel' => 'cha_nav',
    ));
    $wp_customize->add_setting('site_logo', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_logo', array('label' => 'Site Logo (Header + Footer)', 'section' => 'cha_logo')));

    $wp_customize->add_section('cha_nav_labels', array(
        'title' => 'Menu Labels',
        'panel' => 'cha_nav',
    ));

    $nav_labels = array(
        array('nav_home', 'Home', 'ទំព័រដើម'),
        array('nav_about', 'About Us', 'អំពីយើង'),
        array('nav_about_who', 'Who is CHA?', 'CHA ជាអ្វី?'),
        array('nav_about_leadership', 'Leadership Structure and Groups', 'រចនាសម្ព័ន្ធដឹកនាំ និងក្រុម'),
        array('nav_about_src', 'SRC', 'SRC'),
        array('nav_about_history', 'Our History', 'ប្រវត្តិសាស្ត្រ'),
        array('nav_about_wfh', 'Our Work with WFH and HFA', 'ការងាររបស់យើងជាមួយ WFH និង HFA'),
        array('nav_about_contact', 'Contact Us', 'ទំនាក់ទំនង'),
        array('nav_haemophilia', 'About Haemophilia', 'អំពីជំងឺហេម៉ូហ្វីលា'),
        array('nav_haemophilia_about', 'About Haemophilia', 'អំពីជំងឺហេម៉ូហ្វីលា'),
        array('nav_haemophilia_vwd', 'About VWD', 'អំពី VWD'),
        array('nav_haemophilia_other', 'About Other Bleeding Disorders', 'អំពីជំងឺហូរឈាមផ្សេងៗ'),
        array('nav_programs', 'Treatment Centres', 'មជ្ឈមណ្ឌលព្យាបាល'),
        array('nav_csr', 'CSR Program', 'កម្មវិធី CSR'),
        array('nav_csr_fundraising', 'Fundraising', 'ប្រមូលថវិកា'),
        array('nav_csr_donate', 'Online Donation', 'បរិច្ចាគតាមអនឡាញ'),
        array('nav_csr_partners', 'Corporate Partners', 'ដៃគូធុរកិច្ច'),
        array('nav_news', 'News', 'ព័ត៌មាន'),
        array('nav_news_latest', 'Latest News', 'ព័ត៌មានថ្មីៗ'),
        array('nav_news_events', 'Upcoming Events', 'ព្រឹត្តិការណ៍នាពេលខាងមុខ'),
        array('nav_contact', 'Contact', 'ទំនាក់ទំនង'),
        array('nav_become_member', 'Become a Member', 'ក្លាយជាសមាជិក'),
        array('nav_donate', 'Donate', 'បរិច្ចាគ'),
    );
    foreach ($nav_labels as $n) {
        $wp_customize->add_setting($n[0], array('default' => $n[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($n[0], array('label' => $n[1] . ' (EN)', 'section' => 'cha_nav_labels', 'type' => 'text'));
        $wp_customize->add_setting($n[0] . '_km', array('default' => $n[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($n[0] . '_km', array('label' => $n[1] . ' (KM)', 'section' => 'cha_nav_labels', 'type' => 'text'));
    }

    /* ============================================================
       PANEL: About Page
       ============================================================ */
    $wp_customize->add_panel('cha_about_page', array(
        'title'    => 'About Page',
        'priority' => 33,
    ));

    /* ---- Section: SRC ---- */
    $wp_customize->add_section('cha_src', array(
        'title' => 'SRC Section',
        'panel' => 'cha_about_page',
    ));

    $src_labels = array(
        array('src_heading', 'SRC', 'SRC'),
        array('src_sub', "CHA's commitment to community outreach, volunteer engagement, and public awareness across Cambodia.", "ការប្តេជ្ញារបស់ CHA ដល់ការឈានដល់សហគមន៍ ការចូលរួមស្ម័គ្រចិត្ត និងភាពដឹងជាសាធារណៈនៅទូទាំងកម្ពុជា។"),
        array('src_cta_heading', 'Want to get involved?', 'ចង់ចូលរួម?'),
        array('src_cta_text', 'Join our volunteer network and make a difference in the bleeding disorders community across Cambodia.', 'ចូលរួមជាមួយបណ្តាញស្ម័គ្រចិត្តរបស់យើង និងបង្កើតការផ្លាស់ប្តូរនៅក្នុងសហគមន៍ជំងឺហូរឈាមនៅទូទាំងកម្ពុជា។'),
        array('src_cta_btn_1', 'Get Involved', 'ចូលរួម'),
        array('src_cta_btn_2', 'Learn More', 'ស្វែងយល់បន្ថែម'),
    );
    foreach ($src_labels as $s) {
        $wp_customize->add_setting($s[0], array('default' => $s[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($s[0], array('label' => $s[1] . ' (EN)', 'section' => 'cha_src', 'type' => in_array($s[0], array('src_sub','src_cta_text')) ? 'textarea' : 'text'));
        $wp_customize->add_setting($s[0] . '_km', array('default' => $s[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($s[0] . '_km', array('label' => $s[1] . ' (KM)', 'section' => 'cha_src', 'type' => in_array($s[0], array('src_sub','src_cta_text')) ? 'textarea' : 'text'));
    }

    $src_cards = array(
        array('25', 'Provinces and Cities', 'ខេត្ត', 'Reach', 'ការឈានដល់', 'Community Outreach', 'ការឈានដល់សហគមន៍', 'Awareness campaigns, Khmer-language education, and partnerships with local health centres that reach patients where they live.', 'យុទ្ធនាការផ្សព្វផ្សាយ ការអប់រំជាភាសាខ្មែរ និងភាពជាដៃគូជាមួយមណ្ឌលសុខភាពក្នុងមូលដ្ឋានដែលឈានដល់អ្នកជំងឺនៅកន្លែងដែលពួកគេរស់នៅ។', 'Learn more', 'ស្វែងយល់បន្ថែម'),
        array('80+', 'Volunteers', 'អ្នកស្ម័គ្រចិត្ត', 'People', 'មនុស្ស', 'Volunteer Program', 'កម្មវិធីស្ម័គ្រចិត្ត', 'Patients, families, and healthcare students who lead events, mentor newly diagnosed peers, and run community-based activities year-round.', 'អ្នកជំងឺ ក្រុមគ្រួសារ និងនិស្សិតថែទាំសុខភាពដែលដឹកនាំព្រឹត្តិការណ៍ ណែនាំមិត្តភក្តិដែលទើបនឹងធ្វើរោគវិនិច្ឆ័យ និងដំណើរការសកម្មភាពសហគមន៍ពេញមួយឆ្នាំ។', 'Join us', 'ចូលរួមជាមួយយើង'),
        array('1', 'Chapter', 'សាខា', 'Region', 'តំបន់', 'Siem Reap Chapter', 'សាខាសៀមរាប', 'Our northwest hub coordinates local outreach, patient support, and partnerships with Siem Reap Provincial Hospital.', 'មជ្ឈមណ្ឌលភាគពាយ័ព្យរបស់យើងសម្របសម្រួលការឈានដល់មូលដ្ឋាន ការគាំទ្រអ្នកជំងឺ និងភាពជាដៃគូជាមួយមន្ទីរពេទ្យខេត្តសៀមរាប។', 'Visit chapter', 'ទស្សនាសាខា'),
    );

    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("src_card_{$i}_val", array('default' => $src_cards[$i-1][0], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("src_card_{$i}_val", array('label' => "Card {$i} Value", 'section' => 'cha_src', 'type' => 'text'));
        $wp_customize->add_setting("src_card_{$i}_unit", array('default' => $src_cards[$i-1][1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("src_card_{$i}_unit", array('label' => "Card {$i} Unit (EN)", 'section' => 'cha_src', 'type' => 'text'));
        $wp_customize->add_setting("src_card_{$i}_unit_km", array('default' => $src_cards[$i-1][2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("src_card_{$i}_unit_km", array('label' => "Card {$i} Unit (KM)", 'section' => 'cha_src', 'type' => 'text'));
        $wp_customize->add_setting("src_card_{$i}_kicker", array('default' => $src_cards[$i-1][3], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("src_card_{$i}_kicker", array('label' => "Card {$i} Kicker (EN)", 'section' => 'cha_src', 'type' => 'text'));
        $wp_customize->add_setting("src_card_{$i}_kicker_km", array('default' => $src_cards[$i-1][4], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("src_card_{$i}_kicker_km", array('label' => "Card {$i} Kicker (KM)", 'section' => 'cha_src', 'type' => 'text'));
        $wp_customize->add_setting("src_card_{$i}_title", array('default' => $src_cards[$i-1][5], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("src_card_{$i}_title", array('label' => "Card {$i} Title (EN)", 'section' => 'cha_src', 'type' => 'text'));
        $wp_customize->add_setting("src_card_{$i}_title_km", array('default' => $src_cards[$i-1][6], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("src_card_{$i}_title_km", array('label' => "Card {$i} Title (KM)", 'section' => 'cha_src', 'type' => 'text'));
        $wp_customize->add_setting("src_card_{$i}_desc", array('default' => $src_cards[$i-1][7], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("src_card_{$i}_desc", array('label' => "Card {$i} Description (EN)", 'section' => 'cha_src', 'type' => 'textarea'));
        $wp_customize->add_setting("src_card_{$i}_desc_km", array('default' => $src_cards[$i-1][8], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("src_card_{$i}_desc_km", array('label' => "Card {$i} Description (KM)", 'section' => 'cha_src', 'type' => 'textarea'));
        $wp_customize->add_setting("src_card_{$i}_link", array('default' => $src_cards[$i-1][9], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("src_card_{$i}_link", array('label' => "Card {$i} Link Text (EN)", 'section' => 'cha_src', 'type' => 'text'));
        $wp_customize->add_setting("src_card_{$i}_link_km", array('default' => $src_cards[$i-1][10], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("src_card_{$i}_link_km", array('label' => "Card {$i} Link Text (KM)", 'section' => 'cha_src', 'type' => 'text'));
    }

    $src_extras = array(
        array('src_eyebrow', 'Serving Communities', 'សេវាសហគមន៍'),
        array('src_stat_label_1', 'Provinces and Cities', 'ខេត្ត'),
        array('src_kicker_reach', 'Reach', 'ការឈានដល់'),
        array('src_link_1', 'Learn more', 'ស្វែងយល់បន្ថែម'),
        array('src_stat_label_2', 'Volunteers', 'អ្នកស្ម័គ្រចិត្ត'),
        array('src_kicker_people', 'People', 'មនុស្ស'),
        array('src_link_2', 'Join us', 'ចូលរួមជាមួយយើង'),
        array('src_stat_label_3', 'Chapter', 'សាខា'),
        array('src_kicker_region', 'Region', 'តំបន់'),
        array('src_link_3', 'Visit chapter', 'ទស្សនាសាខា'),
        array('src_cta_sub', 'Join our volunteer network and make a difference in the bleeding disorders community across Cambodia.', 'ចូលរួមជាមួយបណ្តាញស្ម័គ្រចិត្តរបស់យើង និងបង្កើតការផ្លាស់ប្តូរនៅក្នុងសហគមន៍ជំងឺហូរឈាមនៅទូទាំងកម្ពុជា។'),
    );
    foreach ($src_extras as $e) {
        $wp_customize->add_setting($e[0], array('default' => $e[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($e[0], array('label' => $e[1] . ' (EN)', 'section' => 'cha_src', 'type' => $e[0] === 'src_cta_sub' ? 'textarea' : 'text'));
        $wp_customize->add_setting($e[0] . '_km', array('default' => $e[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($e[0] . '_km', array('label' => $e[1] . ' (KM)', 'section' => 'cha_src', 'type' => $e[0] === 'src_cta_sub' ? 'textarea' : 'text'));
    }

    /* ---- Section: History ---- */
    $wp_customize->add_section('cha_history_page', array(
        'title' => 'History Section',
        'panel' => 'cha_about_page',
    ));

    $wp_customize->add_setting('history_heading', array('default' => 'Our History', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('history_heading', array('label' => 'Heading (EN)', 'section' => 'cha_history_page', 'type' => 'text'));
    $wp_customize->add_setting('history_heading_km', array('default' => 'ប្រវត្តិសាស្ត្រ', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('history_heading_km', array('label' => 'Heading (KM)', 'section' => 'cha_history_page', 'type' => 'text'));

    $wp_customize->add_setting('history_intro', array('default' => 'CHA was founded in 2011 by patients and families who came together with a shared vision: to ensure no one in Cambodia faces a bleeding disorder alone. What began as a small support group has grown into a national patient-led organization.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('history_intro', array('label' => 'Intro Paragraph (EN)', 'section' => 'cha_history_page', 'type' => 'textarea'));
    $wp_customize->add_setting('history_intro_km', array('default' => 'CHA ត្រូវបានបង្កើតនៅឆ្នាំ ២០១១ ដោយអ្នកជំងឺ និងក្រុមគ្រួសារដែលបានរួមគ្នាជាមួយនឹងចក្ខុវិស័យរួម៖ ដើម្បីធានាថាគ្មាននរណាម្នាក់នៅកម្ពុជាប្រឈមមុខនឹងជំងឺហូរឈាមតែម្នាក់ឯងឡើយ។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('history_intro_km', array('label' => 'Intro Paragraph (KM)', 'section' => 'cha_history_page', 'type' => 'textarea'));

    $history_items = array(
        array('2011', 'CHA Established', 'CHA បានបង្កើត', 'CHA was established by patients and families.', 'CHA ត្រូវបានបង្កើតឡើងដោយអ្នកជំងឺ និងក្រុមគ្រួសារ។'),
        array('2014', 'WFH Member', 'សមាជិក WFH', 'Became a member of the World Federation of Hemophilia.', 'បានក្លាយជាសមាជិកនៃសហព័ន្ធហេម៉ូហ្វីលាពិភពលោក។'),
        array('2017', 'Hospital Partnerships', 'ភាពជាដៃគូមន្ទីរពេទ្យ', 'Partnered with hospitals to improve treatment access.', 'បានសហការជាមួយមន្ទីរពេទ្យដើម្បីកែលម្អការចូលប្រើប្រាស់ការព្យាបាល។'),
        array('2023', 'National Reach', 'ការឈានដល់ជាតិ', 'Expanded education and outreach across provinces.', 'បានពង្រីកការអប់រំ និងការឈានដល់ទូទាំងខេត្ត។'),
    );
    for ($i = 1; $i <= 4; $i++) {
        $h = $history_items[$i-1];
        $wp_customize->add_setting("history_{$i}_year", array('default' => $h[0], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("history_{$i}_year", array('label' => "Entry {$i} Year", 'section' => 'cha_history_page', 'type' => 'text'));
        $wp_customize->add_setting("history_{$i}_title", array('default' => $h[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("history_{$i}_title", array('label' => "Entry {$i} Title (EN)", 'section' => 'cha_history_page', 'type' => 'text'));
        $wp_customize->add_setting("history_{$i}_title_km", array('default' => $h[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("history_{$i}_title_km", array('label' => "Entry {$i} Title (KM)", 'section' => 'cha_history_page', 'type' => 'text'));
        $wp_customize->add_setting("history_{$i}_desc", array('default' => $h[3], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("history_{$i}_desc", array('label' => "Entry {$i} Description (EN)", 'section' => 'cha_history_page', 'type' => 'textarea'));
        $wp_customize->add_setting("history_{$i}_desc_km", array('default' => $h[4], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("history_{$i}_desc_km", array('label' => "Entry {$i} Description (KM)", 'section' => 'cha_history_page', 'type' => 'textarea'));
    }

    /* ---- Section: Leadership ---- */
    $wp_customize->add_section('cha_leadership', array(
        'title' => 'Leadership Team',
        'panel' => 'cha_about_page',
    ));

    $leaders = array(
        array('Mr. Run Chanthearithy', 'លោក រុន ច័ន្ទរិទ្ធី', 'President', 'ប្រធាន'),
        array('Mr. Noeurn Syneang', 'លោក នឿន ស៊ីនាង', 'Vice President', 'អនុប្រធាន'),
        array('Mrs. Soung Somaly', 'លោកស្រី ស៊ូង សោម៉ាលី', 'Head of Finance', 'ប្រធានផ្នែកហិរញ្ញវត្ថុ'),
        array('Mrs. Hun Choryee', 'លោកស្រី ហ៊ុន ជោរយី', 'Secretary General', 'អគ្គលេខាធិការ'),
    );
    $wp_customize->add_setting('leadership_heading', array('default' => 'Leadership Team', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('leadership_heading', array('label' => 'Heading (EN)', 'section' => 'cha_leadership', 'type' => 'text'));
    $wp_customize->add_setting('leadership_heading_km', array('default' => 'ក្រុមដឹកនាំ', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('leadership_heading_km', array('label' => 'Heading (KM)', 'section' => 'cha_leadership', 'type' => 'text'));
    $wp_customize->add_setting('leadership_sub', array('default' => "Dedicated individuals leading CHA's mission across Cambodia.", 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('leadership_sub', array('label' => 'Subtitle (EN)', 'section' => 'cha_leadership', 'type' => 'textarea'));
    $wp_customize->add_setting('leadership_sub_km', array('default' => 'បុគ្គលដែលឧទ្ទិសដល់បេសកកម្មរបស់ CHA នៅទូទាំងកម្ពុជា។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('leadership_sub_km', array('label' => 'Subtitle (KM)', 'section' => 'cha_leadership', 'type' => 'textarea'));
    $wp_customize->add_setting('leadership_btn', array('default' => 'Meet the Full Team', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('leadership_btn', array('label' => 'Button (EN)', 'section' => 'cha_leadership', 'type' => 'text'));
    $wp_customize->add_setting('leadership_btn_km', array('default' => 'ជួបក្រុមពេញ', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('leadership_btn_km', array('label' => 'Button (KM)', 'section' => 'cha_leadership', 'type' => 'text'));
    $wp_customize->add_setting('youth_title', array('default' => 'Youth Group', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('youth_title', array('label' => 'Youth Title (EN)', 'section' => 'cha_leadership', 'type' => 'text'));
    $wp_customize->add_setting('youth_title_km', array('default' => 'ក្រុមយុវជន', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('youth_title_km', array('label' => 'Youth Title (KM)', 'section' => 'cha_leadership', 'type' => 'text'));
    $wp_customize->add_setting('youth_desc', array('default' => 'A network of young patients and members driving awareness campaigns, peer mentoring, and youth-led advocacy across Cambodia.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('youth_desc', array('label' => 'Youth Description (EN)', 'section' => 'cha_leadership', 'type' => 'textarea'));
    $wp_customize->add_setting('youth_desc_km', array('default' => 'បណ្តាញអ្នកជំងឺវ័យក្មេង និងអ្នកគាំទ្រដែលដឹកនាំយុទ្ធនាការភាពដឹង ការណែនាំមិត្តភក្តិ និងការអំពាវនាវដឹកនាំដោយយុវជននៅទូទាំងកម្ពុជា។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('youth_desc_km', array('label' => 'Youth Description (KM)', 'section' => 'cha_leadership', 'type' => 'textarea'));
    $wp_customize->add_setting('women_title', array('default' => "Women's Group", 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('women_title', array('label' => "Women's Title (EN)", 'section' => 'cha_leadership', 'type' => 'text'));
    $wp_customize->add_setting('women_title_km', array('default' => 'ក្រុមស្ត្រី', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('women_title_km', array('label' => "Women's Title (KM)", 'section' => 'cha_leadership', 'type' => 'text'));
    $wp_customize->add_setting('women_desc', array('default' => "Empowering women affected by bleeding disorders through support circles, education on VWD and carrier issues, and community-building events.", 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('women_desc', array('label' => "Women's Description (EN)", 'section' => 'cha_leadership', 'type' => 'textarea'));
    $wp_customize->add_setting('women_desc_km', array('default' => 'ផ្តល់សមត្ថភាពដល់ស្ត្រីដែលរងផលប៉ះពាល់ដោយជំងឺហូរឈាមតាមរយៈរង្វង់គាំទ្រ ការអប់រំអំពី VWD និងបញ្ហាអ្នកផ្ទុក និងព្រឹត្តិការណ៍កសាងសហគមន៍។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('women_desc_km', array('label' => "Women's Description (KM)", 'section' => 'cha_leadership', 'type' => 'textarea'));
    for ($i = 1; $i <= 4; $i++) {
        $l = $leaders[$i-1];
        $wp_customize->add_setting("leader_{$i}_name", array('default' => $l[0], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("leader_{$i}_name", array('label' => "Leader {$i} Name (EN)", 'section' => 'cha_leadership', 'type' => 'text'));
        $wp_customize->add_setting("leader_{$i}_name_km", array('default' => $l[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("leader_{$i}_name_km", array('label' => "Leader {$i} Name (KM)", 'section' => 'cha_leadership', 'type' => 'text'));
        $wp_customize->add_setting("leader_{$i}_role", array('default' => $l[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("leader_{$i}_role", array('label' => "Leader {$i} Role (EN)", 'section' => 'cha_leadership', 'type' => 'text'));
        $wp_customize->add_setting("leader_{$i}_role_km", array('default' => $l[3], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("leader_{$i}_role_km", array('label' => "Leader {$i} Role (KM)", 'section' => 'cha_leadership', 'type' => 'text'));
    }

    /* ---- Leadership & Council Photos ---- */
    $theme_uri = get_template_directory_uri();
    $wp_customize->add_setting('leader_advisor_1_img', array('default' => $theme_uri . '/leader-advisor-1.png', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leader_advisor_1_img', array('label' => 'Advisor 1 Photo (Founder)', 'section' => 'cha_leadership')));
    $wp_customize->add_setting('leader_advisor_2_img', array('default' => $theme_uri . '/leader-advisor-2.png', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leader_advisor_2_img', array('label' => 'Advisor 2 Photo (Co-Founder)', 'section' => 'cha_leadership')));
    $wp_customize->add_setting('leader_advisor_3_img', array('default' => $theme_uri . '/leader-advisor-3.png', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leader_advisor_3_img', array('label' => 'Advisor 3 Photo (Honorary President)', 'section' => 'cha_leadership')));
    $leader_photos = array('leader-1.png', 'leader-2.png', 'leader-3.png', 'leader-4.png');
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("leader_{$i}_img", array('default' => $theme_uri . '/' . $leader_photos[$i-1], 'sanitize_callback' => 'esc_url_raw'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "leader_{$i}_img", array('label' => "Leader {$i} Photo", 'section' => 'cha_leadership')));
    }
    $dept_names = array('CHA Supporting Group', 'Head of Digital', 'Head of Reaction Unit', 'Deputy Secretary General');
    $dept_photos = array('dept-1.png', 'dept-2.png', 'dept-3.png', 'dept-5.png');
    $dept_keys = array(1, 2, 3, 5);
    for ($i = 0; $i < 4; $i++) {
        $wp_customize->add_setting("council_dept_{$dept_keys[$i]}_img", array('default' => $theme_uri . '/' . $dept_photos[$i], 'sanitize_callback' => 'esc_url_raw'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "council_dept_{$dept_keys[$i]}_img", array('label' => "Dept {$dept_keys[$i]} Photo ({$dept_names[$i]})", 'section' => 'cha_leadership')));
    }

    /* ---- Hub & Group Banners ---- */
    $wp_customize->add_setting('hub_youth_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hub_youth_img', array('label' => 'Youth Group Banner', 'section' => 'cha_leadership')));
    $wp_customize->add_setting('hub_women_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hub_women_img', array('label' => "Women's Group Banner", 'section' => 'cha_leadership')));
    $wp_customize->add_setting('hub_src_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hub_src_img', array('label' => 'SRC Hub Banner', 'section' => 'cha_leadership')));
    $wp_customize->add_setting('hub_volunteer_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hub_volunteer_img', array('label' => 'Volunteer Network Banner', 'section' => 'cha_leadership')));

    /* ---- Section: WFH & HFA ---- */
    $wp_customize->add_section('cha_wfh_hfa', array(
        'title' => 'WFH & HFA',
        'panel' => 'cha_about_page',
    ));

    $wp_customize->add_setting('wfh_heading', array('default' => 'Our Work with WFH & HFA', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('wfh_heading', array('label' => 'Section Heading (EN)', 'section' => 'cha_wfh_hfa', 'type' => 'text'));
    $wp_customize->add_setting('wfh_heading_km', array('default' => 'ការងាររបស់យើងជាមួយ WFH និង HFA', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('wfh_heading_km', array('label' => 'Section Heading (KM)', 'section' => 'cha_wfh_hfa', 'type' => 'text'));
    $wp_customize->add_setting('wfh_sub', array('default' => 'CHA proudly partners with leading global organizations to strengthen haemophilia care across Cambodia.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('wfh_sub', array('label' => 'Section Subtitle (EN)', 'section' => 'cha_wfh_hfa', 'type' => 'textarea'));
    $wp_customize->add_setting('wfh_sub_km', array('default' => 'CHA សហការដោយមោទនភាពជាមួយអង្គការសកលលោកឈានមុខគេដើម្បីពង្រឹងការថែទាំជំងឺហេម៉ូហ្វីលានៅទូទាំងកម្ពុជា។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('wfh_sub_km', array('label' => 'Section Subtitle (KM)', 'section' => 'cha_wfh_hfa', 'type' => 'textarea'));

    $wfh_parts = array(
        array('wfh_card', 'World Federation of Hemophilia', 'សហព័ន្ធហេម៉ូហ្វីលាពិភពលោក', 'Member Since 2014', 'សមាជិកតាំងពី ២០១៤', '140+', 'ជាង ១៤០', 'Countries in Network', 'ប្រទេសក្នុងបណ្តាញ', 'Global member of the WFH network. Through this partnership, CHA accesses international treatment guidelines, training programs, and humanitarian aid that directly improve patient care.', 'សមាជិកសកលនៃបណ្តាញ WFH។ តាមរយៈភាពជាដៃគូនេះ CHA ទទួលបានគោលនាំព្យាបាលអន្តរជាតិ កម្មវិធីបណ្តុះបណ្តាល និងជំនួយមនុស្សធម៌ដែលធ្វើអោយប្រសើរឡើងដោយផ្ទាល់នូវការថែទាំអ្នកជំងឺ។', 'Visit WFH', 'ទស្សនា WFH'),
        array('hfa_card', 'Haemophilia Foundation Australia', 'មូលនិធិហេម៉ូហ្វីលាអូស្ត្រាលី', 'Training Partner', 'ដៃគូបណ្តុះបណ្តាល', '15+', 'ជាង ១៥', 'Joint Programs', 'កម្មវិធីរួម', 'HFA partners with CHA on capacity building, clinical training, and patient advocacy. Joint programs connect Cambodian clinicians with Australian expertise.', 'HFA សហការជាមួយ CHA លើការកសាងសមត្ថភាព ការបណ្តុះបណ្តាលព្យាបាល និងការអំពាវនាវអ្នកជំងឺ។ កម្មវិធីរួមភ្ជាប់គ្រូពេទ្យកម្ពុជាជាមួយអ្នកជំនាញអូស្ត្រាលី។', 'Learn More', 'ស្វែងយល់បន្ថែម'),
    );
    for ($i = 1; $i <= 2; $i++) {
        $w = $wfh_parts[$i-1];
        $pref = $w[0];
        $wp_customize->add_setting("{$pref}_title", array('default' => $w[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_title", array('label' => "{$w[1]} Title (EN)", 'section' => 'cha_wfh_hfa', 'type' => 'text'));
        $wp_customize->add_setting("{$pref}_title_km", array('default' => $w[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_title_km", array('label' => "{$w[1]} Title (KM)", 'section' => 'cha_wfh_hfa', 'type' => 'text'));
        $wp_customize->add_setting("{$pref}_tag", array('default' => $w[3], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_tag", array('label' => "{$w[1]} Tag (EN)", 'section' => 'cha_wfh_hfa', 'type' => 'text'));
        $wp_customize->add_setting("{$pref}_tag_km", array('default' => $w[4], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_tag_km", array('label' => "{$w[1]} Tag (KM)", 'section' => 'cha_wfh_hfa', 'type' => 'text'));
        $wp_customize->add_setting("{$pref}_stat_val", array('default' => $w[5], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_stat_val", array('label' => "{$w[1]} Stat Value", 'section' => 'cha_wfh_hfa', 'type' => 'text'));
        $wp_customize->add_setting("{$pref}_stat_lbl", array('default' => $w[7], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_stat_lbl", array('label' => "{$w[1]} Stat Label (EN)", 'section' => 'cha_wfh_hfa', 'type' => 'text'));
        $wp_customize->add_setting("{$pref}_stat_lbl_km", array('default' => $w[8], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_stat_lbl_km", array('label' => "{$w[1]} Stat Label (KM)", 'section' => 'cha_wfh_hfa', 'type' => 'text'));
        $wp_customize->add_setting("{$pref}_desc", array('default' => $w[9], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_desc", array('label' => "{$w[1]} Description (EN)", 'section' => 'cha_wfh_hfa', 'type' => 'textarea'));
        $wp_customize->add_setting("{$pref}_desc_km", array('default' => $w[10], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_desc_km", array('label' => "{$w[1]} Description (KM)", 'section' => 'cha_wfh_hfa', 'type' => 'textarea'));
        $wp_customize->add_setting("{$pref}_link", array('default' => $w[11], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_link", array('label' => "{$w[1]} Link Text (EN)", 'section' => 'cha_wfh_hfa', 'type' => 'text'));
        $wp_customize->add_setting("{$pref}_link_km", array('default' => $w[12], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_link_km", array('label' => "{$w[1]} Link Text (KM)", 'section' => 'cha_wfh_hfa', 'type' => 'text'));
    }
    $wp_customize->add_setting('wfh_media_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wfh_media_img', array('label' => 'WFH Media Image', 'section' => 'cha_wfh_hfa')));
    $wp_customize->add_setting('hfa_media_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hfa_media_img', array('label' => 'HFA Media Image', 'section' => 'cha_wfh_hfa')));

    /* ---- History Images ---- */
    $wp_customize->add_setting('history_2011_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'history_2011_img', array('label' => 'History 2011 Image', 'section' => 'cha_history_page')));
    $wp_customize->add_setting('history_2014_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'history_2014_img', array('label' => 'History 2014 Image', 'section' => 'cha_history_page')));
    $wp_customize->add_setting('history_2017_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'history_2017_img', array('label' => 'History 2017 Image', 'section' => 'cha_history_page')));
    $wp_customize->add_setting('history_2023_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'history_2023_img', array('label' => 'History 2023 Image', 'section' => 'cha_history_page')));

    /* ---- SRC Card Background Images ---- */
    $src_card_names = array('Community Outreach', 'Volunteer Program', 'Siem Reap Chapter');
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("src_card_{$i}_img", array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "src_card_{$i}_img", array('label' => "Card {$i} Background ({$src_card_names[$i-1]})", 'section' => 'cha_src')));
    }

    /* ---- Group Member Photos ---- */
    $wp_customize->add_section('cha_hub_members', array(
        'title' => 'Group Member Photos',
        'panel' => 'cha_about_page',
    ));

    $hub_members = array(
        'youth_leader' => 'Youth Group Leader',
        'youth_m1'     => 'Youth — Say Ouksaphea',
        'youth_m2'     => 'Youth — Ky Eangtol',
        'youth_m3'     => 'Youth — Srim Pengleang',
        'youth_m4'     => 'Youth — Khan Dara',
        'women_leader' => "Women's Group Leader",
        'women_m1'     => "Women — Yim Mary",
        'women_m2'     => "Women — Him Somala",
        'women_m3'     => "Women — Srim Sreypich",
        'women_m4'     => "Women — Try Kakada",
        'women_m5'     => "Women — Phon Sokny",
        'women_m6'     => "Women — Som Phalla",
        'women_m7'     => "Women — Heng Sim",
        'women_m8'     => "Women — Touch Socheata",
        'women_m9'     => "Women — Hou Sreyny",
        'src_leader'   => 'SRC Chapter Head',
        'src_m1'       => 'SRC — Run Chanthearithy',
        'src_m2'       => 'SRC — Keo Sovandy',
        'src_m3'       => 'SRC — Sun Sokhorn',
        'src_m4'       => 'SRC — Pach Panhavorinvong',
        'vol_leader'   => 'Volunteer Network Leader',
        'vol_m1'       => 'Volunteer — Chor Sonita',
        'vol_m2'       => 'Volunteer — Srin Vinching',
        'vol_m3'       => 'Volunteer — Oeun Sreyneath',
        'vol_m4'       => 'Volunteer — Pov Lay',
        'vol_m5'       => 'Volunteer — Phorn Soveat',
        'vol_m6'       => 'Volunteer — Mom Bunthart',
        'vol_m7'       => 'Volunteer — Yong Tetyutthuon',
        'vol_m8'       => 'Volunteer — Noeurn SoVannitta',
    );
    foreach ($hub_members as $key => $label) {
        $wp_customize->add_setting("hub_{$key}_img", array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "hub_{$key}_img", array('label' => "$label Photo", 'section' => 'cha_hub_members')));
    }

    /* ============================================================
       PANEL: Programs Page
       ============================================================ */
    $wp_customize->add_panel('cha_programs_page', array(
        'title'    => 'Programs Page',
        'priority' => 34,
    ));

    $wp_customize->add_section('cha_programs_main', array(
        'title' => 'Programs — Main',
        'panel' => 'cha_programs_page',
    ));

    $wp_customize->add_setting('programs_heading', array('default' => 'Treatment Centres', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('programs_heading', array('label' => 'Page Heading (EN)', 'section' => 'cha_programs_main', 'type' => 'text'));
    $wp_customize->add_setting('programs_heading_km', array('default' => 'មជ្ឈមណ្ឌលព្យាបាល', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('programs_heading_km', array('label' => 'Page Heading (KM)', 'section' => 'cha_programs_main', 'type' => 'text'));
    $wp_customize->add_setting('programs_sub', array('default' => 'Find haemophilia treatment centres across Cambodia — search by province.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('programs_sub', array('label' => 'Page Subtitle (EN)', 'section' => 'cha_programs_main', 'type' => 'textarea'));
    $wp_customize->add_setting('programs_sub_km', array('default' => 'ស្វែងរកមជ្ឈមណ្ឌលព្យាបាលជំងឺហេម៉ូហ្វីលានៅទូទាំងកម្ពុជា — ស្វែងរកតាមខេត្ត។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('programs_sub_km', array('label' => 'Page Subtitle (KM)', 'section' => 'cha_programs_main', 'type' => 'textarea'));
    $wp_customize->add_setting('programs_select_lbl', array('default' => 'Select Province', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('programs_select_lbl', array('label' => 'Dropdown Label (EN)', 'section' => 'cha_programs_main', 'type' => 'text'));
    $wp_customize->add_setting('programs_select_lbl_km', array('default' => 'ជ្រើសរើសខេត្ត', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('programs_select_lbl_km', array('label' => 'Dropdown Label (KM)', 'section' => 'cha_programs_main', 'type' => 'text'));
    $wp_customize->add_setting('programs_select_all', array('default' => 'All Provinces', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('programs_select_all', array('label' => 'All Provinces Option (EN)', 'section' => 'cha_programs_main', 'type' => 'text'));
    $wp_customize->add_setting('programs_select_all_km', array('default' => 'ខេត្តទាំងអស់', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('programs_select_all_km', array('label' => 'All Provinces Option (KM)', 'section' => 'cha_programs_main', 'type' => 'text'));
    $wp_customize->add_setting('programs_view_map', array('default' => 'View on Map', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('programs_view_map', array('label' => 'View on Map (EN)', 'section' => 'cha_programs_main', 'type' => 'text'));
    $wp_customize->add_setting('programs_view_map_km', array('default' => 'មើលនៅលើផែនទី', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('programs_view_map_km', array('label' => 'View on Map (KM)', 'section' => 'cha_programs_main', 'type' => 'text'));

    $hospitals = array(
        array('National Pediatric Hospital (NPH) — Haemophilia Clinic', 'មន្ទីរពេទ្យគន្ធបុប្ផា/កុមារជាតិ — គ្លីនិកហេម៉ូហ្វីលា', 'Phnom Penh', 'ភ្នំពេញ', '012 751 728', 'Haemophilia A & B', 'ហេម៉ូហ្វីលា A & B', 'VWD', 'Consultation', 'ការពិគ្រោះយោបល់', 'Laboratory', 'មន្ទីរពិសោធន៍'),
        array('Angkor Hospital for Children (AHC) — Haemophilia Unit', 'មន្ទីរពេទ្យកុមារអង្គរ — អង្គភាពហេម៉ូហ្វីលា', 'Siem Reap', 'សៀមរាប', '012 794 685', 'Haemophilia A & B', 'ហេម៉ូហ្វីលា A & B', 'Factor Replacement', 'ការជំនួសកត្តា', 'Counselling', 'ការណែនាំ'),
        array('Siem Reap Provincial Hospital', 'មន្ទីរពេទ្យខេត្តសៀមរាប', 'Siem Reap', 'សៀមរាប', '063 765 376', 'Haemophilia A & B', 'ហេម៉ូហ្វីលា A & B', 'Consultation', 'ការពិគ្រោះយោបល់', 'Emergency Care', 'ការថែទាំបន្ទាន់'),
    );
    for ($i = 1; $i <= 3; $i++) {
        $h = $hospitals[$i-1];
        $wp_customize->add_setting("hospital_{$i}_name", array('default' => $h[0], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("hospital_{$i}_name", array('label' => "Hospital {$i} Name (EN)", 'section' => 'cha_programs_main', 'type' => 'text'));
        $wp_customize->add_setting("hospital_{$i}_name_km", array('default' => $h[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("hospital_{$i}_name_km", array('label' => "Hospital {$i} Name (KM)", 'section' => 'cha_programs_main', 'type' => 'text'));
        $wp_customize->add_setting("hospital_{$i}_location", array('default' => $h[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("hospital_{$i}_location", array('label' => "Hospital {$i} Location (EN)", 'section' => 'cha_programs_main', 'type' => 'text'));
        $wp_customize->add_setting("hospital_{$i}_location_km", array('default' => $h[3], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("hospital_{$i}_location_km", array('label' => "Hospital {$i} Location (KM)", 'section' => 'cha_programs_main', 'type' => 'text'));
        $wp_customize->add_setting("hospital_{$i}_phone", array('default' => $h[4], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("hospital_{$i}_phone", array('label' => "Hospital {$i} Phone", 'section' => 'cha_programs_main', 'type' => 'text'));
        $wp_customize->add_setting("hospital_{$i}_tag_1", array('default' => $h[5], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("hospital_{$i}_tag_1", array('label' => "Hospital {$i} Tag 1 (EN)", 'section' => 'cha_programs_main', 'type' => 'text'));
        $wp_customize->add_setting("hospital_{$i}_tag_1_km", array('default' => $h[6], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("hospital_{$i}_tag_1_km", array('label' => "Hospital {$i} Tag 1 (KM)", 'section' => 'cha_programs_main', 'type' => 'text'));
        $wp_customize->add_setting("hospital_{$i}_tag_2", array('default' => $h[7], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("hospital_{$i}_tag_2", array('label' => "Hospital {$i} Tag 2 (EN)", 'section' => 'cha_programs_main', 'type' => 'text'));
        $wp_customize->add_setting("hospital_{$i}_tag_2_km", array('default' => $h[8], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("hospital_{$i}_tag_2_km", array('label' => "Hospital {$i} Tag 2 (KM)", 'section' => 'cha_programs_main', 'type' => 'text'));
        $wp_customize->add_setting("hospital_{$i}_tag_3", array('default' => $h[9], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("hospital_{$i}_tag_3", array('label' => "Hospital {$i} Tag 3 (EN)", 'section' => 'cha_programs_main', 'type' => 'text'));
        $wp_customize->add_setting("hospital_{$i}_tag_3_km", array('default' => $h[10], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("hospital_{$i}_tag_3_km", array('label' => "Hospital {$i} Tag 3 (KM)", 'section' => 'cha_programs_main', 'type' => 'text'));
    }
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("hospital_{$i}_img", array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "hospital_{$i}_img", array('label' => "Hospital {$i} Photo", 'section' => 'cha_programs_main')));
    }

    /* ---- Section: Emergency ---- */
    $wp_customize->add_section('cha_emergency', array(
        'title' => 'Emergency Banner',
        'panel' => 'cha_programs_page',
    ));

    $wp_customize->add_setting('emergency_heading', array('default' => 'Emergency Support', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('emergency_heading', array('label' => 'Heading (EN)', 'section' => 'cha_emergency', 'type' => 'text'));
    $wp_customize->add_setting('emergency_heading_km', array('default' => 'ជំនួយបន្ទាន់', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('emergency_heading_km', array('label' => 'Heading (KM)', 'section' => 'cha_emergency', 'type' => 'text'));
    $wp_customize->add_setting('emergency_text', array('default' => 'If you have a bleeding emergency, contact your nearest treatment centre or call our support line.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('emergency_text', array('label' => 'Text (EN)', 'section' => 'cha_emergency', 'type' => 'textarea'));
    $wp_customize->add_setting('emergency_text_km', array('default' => 'ប្រសិនបើអ្នកមានអាសន្នហូរឈាម សូមទាក់ទងមជ្ឈមណ្ឌលព្យាបាលដែលនៅជិតបំផុត ឬហៅទូរស័ព្ទមកកាន់ខ្សែទូរស័ព្ទជំនួយរបស់យើង។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('emergency_text_km', array('label' => 'Text (KM)', 'section' => 'cha_emergency', 'type' => 'textarea'));
    $wp_customize->add_setting('emergency_phone', array('default' => '(+855) 96 260 5335', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('emergency_phone', array('label' => 'Phone Number', 'section' => 'cha_emergency', 'type' => 'text'));

    /* ---- Section: CSR ---- */
    $wp_customize->add_section('cha_csr', array(
        'title' => 'CSR Section',
        'panel' => 'cha_programs_page',
    ));

    $csr_items = array(
        array('Fundraising', 'ប្រមូលថវិកា', 'Raising funds through community drives, events, and partner campaigns that keep our programs running.', 'ប្រមូលថវិកាតាមរយៈកម្មវិធីសហគមន៍ ព្រឹត្តិការណ៍ និងយុទ្ធនាការដៃគូដែលរក្សាកម្មវិធីរបស់យើងដំណើរការ។', 'View campaigns', 'មើលយុទ្ធនាការ'),
        array('Online Donation', 'បរិច្ចាគតាមអនឡាញ', 'Donate securely via PayWay (ABA Bank) — every contribution changes lives across Cambodia.', 'បរិច្ចាគដោយសុវត្ថិភាពតាម PayWay (ធនាគារ ABA) — រាល់ការរួមចំណែកផ្លាស់ប្តូរជីវិតនៅទូទាំងកម្ពុជា។', 'Donate now', 'បរិច្ចាគឥឡូវ'),
        array('Corporate Partners', 'ដៃគូធុរកិច្ច', 'Trusted organisations that support our mission and amplify our reach nationwide.', 'អង្គការដែលគួរឱ្យទុកចិត្តដែលគាំទ្របេសកកម្មរបស់យើង និងពង្រីកការឈានដល់របស់យើងទូទាំងប្រទេស។', 'Become a partner', 'ក្លាយជាដៃគូ'),
    );
    $wp_customize->add_setting('csr_heading', array('default' => 'CSR Program', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('csr_heading', array('label' => 'Section Heading (EN)', 'section' => 'cha_csr', 'type' => 'text'));
    $wp_customize->add_setting('csr_heading_km', array('default' => 'កម្មវិធី CSR', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('csr_heading_km', array('label' => 'Section Heading (KM)', 'section' => 'cha_csr', 'type' => 'text'));
    $wp_customize->add_setting('csr_sub', array('default' => 'Fundraising, donations, and corporate partnerships that power our mission.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('csr_sub', array('label' => 'Section Subtitle (EN)', 'section' => 'cha_csr', 'type' => 'textarea'));
    $wp_customize->add_setting('csr_sub_km', array('default' => 'ការប្រមូលថវិកា បរិច្ចាគ និងភាពជាដៃគូធុរកិច្ចដែលជំរុញបេសកកម្មរបស់យើង។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('csr_sub_km', array('label' => 'Section Subtitle (KM)', 'section' => 'cha_csr', 'type' => 'textarea'));
    for ($i = 1; $i <= 3; $i++) {
        $c = $csr_items[$i-1];
        $wp_customize->add_setting("csr_{$i}_title", array('default' => $c[0], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("csr_{$i}_title", array('label' => "CSR {$i} Title (EN)", 'section' => 'cha_csr', 'type' => 'text'));
        $wp_customize->add_setting("csr_{$i}_title_km", array('default' => $c[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("csr_{$i}_title_km", array('label' => "CSR {$i} Title (KM)", 'section' => 'cha_csr', 'type' => 'text'));
        $wp_customize->add_setting("csr_{$i}_desc", array('default' => $c[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("csr_{$i}_desc", array('label' => "CSR {$i} Description (EN)", 'section' => 'cha_csr', 'type' => 'textarea'));
        $wp_customize->add_setting("csr_{$i}_desc_km", array('default' => $c[3], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("csr_{$i}_desc_km", array('label' => "CSR {$i} Description (KM)", 'section' => 'cha_csr', 'type' => 'textarea'));
        $wp_customize->add_setting("csr_{$i}_link", array('default' => $c[4], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("csr_{$i}_link", array('label' => "CSR {$i} Link Text (EN)", 'section' => 'cha_csr', 'type' => 'text'));
        $wp_customize->add_setting("csr_{$i}_link_km", array('default' => $c[5], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("csr_{$i}_link_km", array('label' => "CSR {$i} Link Text (KM)", 'section' => 'cha_csr', 'type' => 'text'));
    }

    /* ============================================================
       PANEL: Haemophilia Page
       ============================================================ */
    $wp_customize->add_panel('cha_haemophilia_page', array(
        'title'    => 'Haemophilia Page',
        'priority' => 35,
    ));

    $wp_customize->add_section('cha_haem_intro', array(
        'title' => 'What is Haemophilia',
        'panel' => 'cha_haemophilia_page',
    ));

    $haem_intro = array(
        array('haem_intro_heading', 'What is Haemophilia?', 'អ្វីទៅជាជំងឺហេម៉ូហ្វីលា?'),
        array('haem_intro_p1', 'Haemophilia is a rare genetic bleeding disorder that affects a person\'s ability to stop bleeding. People with haemophilia can bleed longer than others after an injury or even without a known cause.', 'ជំងឺហេម៉ូហ្វីលា គឺជាជំងឺហូរឈាមតំណពូរដ៏កម្រ ដែលប៉ះពាល់ដល់សមត្ថភាពរបស់មនុស្សក្នុងការបញ្ឈប់ការហូរឈាម។ អ្នកដែលមានជំងឺហេម៉ូហ្វីលាអាចហូរឈាមយូរជាងអ្នកដទៃបន្ទាប់ពីរបួស ឬសូម្បីតែដោយគ្មានមូលហេតុដែលគេស្គាល់។'),
        array('haem_intro_p2', 'While there is no cure, modern treatments allow people with haemophilia to live full, active and healthy lives. Early diagnosis, proper treatment and ongoing support are key to preventing complications and joint damage.', 'ទោះបីជាមិនទាន់មានឱសថព្យាបាលក៏ដោយ ការព្យាបាលបែបទំនើបអនុញ្ញាតឱ្យអ្នកជំងឺហេម៉ូហ្វីលារស់នៅប្រកបដោយពេញលេញ សកម្ម និងមានសុខភាពល្អ។'),
        array('haem_intro_btn', 'Contact a Specialist', 'ទំនាក់ទំនងអ្នកឯកទេស'),
    );
    foreach ($haem_intro as $h) {
        $wp_customize->add_setting($h[0], array('default' => $h[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($h[0], array('label' => $h[1] . ' (EN)', 'section' => 'cha_haem_intro', 'type' => in_array($h[0], array('haem_intro_p1','haem_intro_p2')) ? 'textarea' : 'text'));
        $wp_customize->add_setting($h[0] . '_km', array('default' => $h[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($h[0] . '_km', array('label' => $h[1] . ' (KM)', 'section' => 'cha_haem_intro', 'type' => in_array($h[0], array('haem_intro_p1','haem_intro_p2')) ? 'textarea' : 'text'));
    }
    $wp_customize->add_setting('haem_hero_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'haem_hero_img', array('label' => 'Haemophilia Hero Image', 'section' => 'cha_haem_intro')));

    /* ---- Section: Types ---- */
    $wp_customize->add_section('cha_haem_types', array(
        'title' => 'Types of Haemophilia',
        'panel' => 'cha_haemophilia_page',
    ));

    $haem_types = array(
        array('haem_types_heading', 'Types of Haemophilia', 'ប្រភេទនៃជំងឺហេម៉ូហ្វីលា'),
        array('haem_types_sub', 'The two main types of haemophilia — both require proper diagnosis and lifelong management.', 'ប្រភេទសំខាន់ទាំងពីរនៃជំងឺហេម៉ូហ្វីលា — ទាំងពីរតម្រូវឱ្យមានការវិនិច្ឆ័យត្រឹមត្រូវ និងការគ្រប់គ្រងពេញមួយជីវិត។'),
    );
    foreach ($haem_types as $h) {
        $wp_customize->add_setting($h[0], array('default' => $h[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($h[0], array('label' => $h[1] . ' (EN)', 'section' => 'cha_haem_types', 'type' => in_array($h[0], array('haem_types_sub')) ? 'textarea' : 'text'));
        $wp_customize->add_setting($h[0] . '_km', array('default' => $h[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($h[0] . '_km', array('label' => $h[1] . ' (KM)', 'section' => 'cha_haem_types', 'type' => in_array($h[0], array('haem_types_sub')) ? 'textarea' : 'text'));
    }

    $type_cards = array(
        array('haem_type_a', 'Haemophilia A', 'ហេម៉ូហ្វីលា A', 'Caused by a deficiency of factor VIII. The most common type.', 'បណ្តាលមកពីការខ្វះកត្តា VIII។ ជាប្រភេទទូទៅបំផុត។'),
        array('haem_type_b', 'Haemophilia B', 'ហេម៉ូហ្វីលា B', 'Caused by a deficiency of factor IX. Sometimes called Christmas disease.', 'បណ្តាលមកពីការខ្វះកត្តា IX។ ជួនកាលគេហៅថាជំងឺបុណ្យណូអែល។'),
    );
    foreach ($type_cards as $t) {
        $pref = $t[0];
        $wp_customize->add_setting("{$pref}_title", array('default' => $t[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_title", array('label' => "{$t[1]} Title (EN)", 'section' => 'cha_haem_types', 'type' => 'text'));
        $wp_customize->add_setting("{$pref}_title_km", array('default' => $t[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_title_km", array('label' => "{$t[1]} Title (KM)", 'section' => 'cha_haem_types', 'type' => 'text'));
        $wp_customize->add_setting("{$pref}_desc", array('default' => $t[3], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_desc", array('label' => "{$t[1]} Description (EN)", 'section' => 'cha_haem_types', 'type' => 'textarea'));
        $wp_customize->add_setting("{$pref}_desc_km", array('default' => $t[4], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("{$pref}_desc_km", array('label' => "{$t[1]} Description (KM)", 'section' => 'cha_haem_types', 'type' => 'textarea'));
    }

    /* ---- Section: Symptoms ---- */
    $wp_customize->add_section('cha_haem_symptoms', array(
        'title' => 'Symptoms',
        'panel' => 'cha_haemophilia_page',
    ));

    $symptom_data = array(
        array('Easy Bruising', 'ស្នាមជាំ', 'Unexplained bruises from minor bumps or pressure.', 'ស្នាមជាំដែលមិនអាចពន្យល់បានពីការប៉ះទង្គិចតិចតួច ឬសម្ពាធ។'),
        array('Frequent Nosebleeds', 'ឈាមច្រមុះញឹកញាប់', 'Recurring nosebleeds that are hard to stop.', 'ឈាមច្រមុះញឹកញាប់ដែលពិបាកបញ្ឈប់។'),
        array('Bleeding Gums', 'អញ្ចាញធ្មេញហូរឈាម', 'Gums that bleed during brushing or eating.', 'អញ្ចាញធ្មេញដែលហូរឈាមពេលដុសធ្មេញ ឬញ៉ាំ។'),
        array('Joint Pain or Swelling', 'ឈឺ ឬហើមសន្លាក់', 'Painful, swollen joints after minor injury or activity.', 'សន្លាក់ឈឺ និងហើមបន្ទាប់ពីរបួសតិចតួច ឬសកម្មភាព។'),
        array('Prolonged Bleeding', 'ការហូរឈាមយូរ', 'Bleeding that lasts longer than expected after cuts.', 'ការហូរឈាមដែលមានរយៈពេលយូរជាងការរំពឹងទុកបន្ទាប់ពីកាត់។'),
    );
    $wp_customize->add_setting('haem_symptoms_heading', array('default' => 'Common Symptoms', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('haem_symptoms_heading', array('label' => 'Heading (EN)', 'section' => 'cha_haem_symptoms', 'type' => 'text'));
    $wp_customize->add_setting('haem_symptoms_heading_km', array('default' => 'រោគសញ្ញាទូទៅ', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('haem_symptoms_heading_km', array('label' => 'Heading (KM)', 'section' => 'cha_haem_symptoms', 'type' => 'text'));
    $wp_customize->add_setting('haem_symptoms_sub', array('default' => 'Recognizing the signs of a bleeding disorder is the first step toward diagnosis and proper care.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('haem_symptoms_sub', array('label' => 'Subtitle (EN)', 'section' => 'cha_haem_symptoms', 'type' => 'textarea'));
    $wp_customize->add_setting('haem_symptoms_sub_km', array('default' => 'ការស្គាល់សញ្ញានៃជំងឺហូរឈាមគឺជាជំហានដំបូងឆ្ពោះទៅរកការវិនិច្ឆ័យ និងការថែទាំត្រឹមត្រូវ។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('haem_symptoms_sub_km', array('label' => 'Subtitle (KM)', 'section' => 'cha_haem_symptoms', 'type' => 'textarea'));
    for ($i = 1; $i <= 5; $i++) {
        $s = $symptom_data[$i-1];
        $wp_customize->add_setting("symptom_{$i}_title", array('default' => $s[0], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("symptom_{$i}_title", array('label' => "Symptom {$i} Title (EN)", 'section' => 'cha_haem_symptoms', 'type' => 'text'));
        $wp_customize->add_setting("symptom_{$i}_title_km", array('default' => $s[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("symptom_{$i}_title_km", array('label' => "Symptom {$i} Title (KM)", 'section' => 'cha_haem_symptoms', 'type' => 'text'));
        $wp_customize->add_setting("symptom_{$i}_desc", array('default' => $s[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("symptom_{$i}_desc", array('label' => "Symptom {$i} Description (EN)", 'section' => 'cha_haem_symptoms', 'type' => 'textarea'));
        $wp_customize->add_setting("symptom_{$i}_desc_km", array('default' => $s[3], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("symptom_{$i}_desc_km", array('label' => "Symptom {$i} Description (KM)", 'section' => 'cha_haem_symptoms', 'type' => 'textarea'));
    }
    $wp_customize->add_setting('symptoms_cta', array('default' => 'Experiencing any of these symptoms? Early diagnosis can make a life-changing difference.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('symptoms_cta', array('label' => 'CTA Text (EN)', 'section' => 'cha_haem_symptoms', 'type' => 'textarea'));
    $wp_customize->add_setting('symptoms_cta_km', array('default' => 'មានរោគសញ្ញាទាំងនេះ? ការវិនិច្ឆ័យដំបូងអាចធ្វើឱ្យមានភាពខុសគ្នាដែលផ្លាស់ប្តូរជីវិត។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('symptoms_cta_km', array('label' => 'CTA Text (KM)', 'section' => 'cha_haem_symptoms', 'type' => 'textarea'));
    $wp_customize->add_setting('symptoms_btn_1', array('default' => 'Find a Treatment Centre', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('symptoms_btn_1', array('label' => 'Button 1 (EN)', 'section' => 'cha_haem_symptoms', 'type' => 'text'));
    $wp_customize->add_setting('symptoms_btn_1_km', array('default' => 'ស្វែងរកមជ្ឈមណ្ឌលព្យាបាល', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('symptoms_btn_1_km', array('label' => 'Button 1 (KM)', 'section' => 'cha_haem_symptoms', 'type' => 'text'));
    $wp_customize->add_setting('symptoms_btn_2', array('default' => 'Contact a Specialist', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('symptoms_btn_2', array('label' => 'Button 2 (EN)', 'section' => 'cha_haem_symptoms', 'type' => 'text'));
    $wp_customize->add_setting('symptoms_btn_2_km', array('default' => 'ទំនាក់ទំនងអ្នកឯកទេស', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('symptoms_btn_2_km', array('label' => 'Button 2 (KM)', 'section' => 'cha_haem_symptoms', 'type' => 'text'));

    /* ---- Section: VWD ---- */
    $wp_customize->add_section('cha_haem_vwd', array(
        'title' => 'VWD Section',
        'panel' => 'cha_haemophilia_page',
    ));

    $wp_customize->add_setting('vwd_heading', array('default' => 'Von Willebrand Disease (VWD)', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('vwd_heading', array('label' => 'Heading (EN)', 'section' => 'cha_haem_vwd', 'type' => 'text'));
    $wp_customize->add_setting('vwd_heading_km', array('default' => 'ជំងឺ Von Willebrand (VWD)', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('vwd_heading_km', array('label' => 'Heading (KM)', 'section' => 'cha_haem_vwd', 'type' => 'text'));
    $wp_customize->add_setting('vwd_p1', array('default' => 'Von Willebrand Disease is the most common inherited bleeding disorder, affecting both males and females equally. It is caused by a deficiency or dysfunction of von Willebrand factor, a protein that helps blood clot.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('vwd_p1', array('label' => 'Paragraph 1 (EN)', 'section' => 'cha_haem_vwd', 'type' => 'textarea'));
    $wp_customize->add_setting('vwd_p1_km', array('default' => 'ជំងឺ Von Willebrand គឺជាជំងឺហូរឈាមតំណពូរទូទៅបំផុត ដែលប៉ះពាល់ទាំងបុរសនិងស្ត្រីស្មើគ្នា។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('vwd_p1_km', array('label' => 'Paragraph 1 (KM)', 'section' => 'cha_haem_vwd', 'type' => 'textarea'));
    $wp_customize->add_setting('vwd_p2', array('default' => 'There are three main types of VWD — Type 1 (mild), Type 2 (moderate), and Type 3 (severe). Treatment focuses on managing bleeding episodes and may include desmopressin or factor replacement therapy.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('vwd_p2', array('label' => 'Paragraph 2 (EN)', 'section' => 'cha_haem_vwd', 'type' => 'textarea'));
    $wp_customize->add_setting('vwd_p2_km', array('default' => 'មានប្រភេទសំខាន់ៗបីនៃ VWD — ប្រភេទទី ១ (ស្រាល) ប្រភេទទី ២ (មធ្យម) និងប្រភេទទី ៣ (ធ្ងន់ធ្ងរ)។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('vwd_p2_km', array('label' => 'Paragraph 2 (KM)', 'section' => 'cha_haem_vwd', 'type' => 'textarea'));
    $wp_customize->add_setting('vwd_btn', array('default' => 'Find Treatment', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('vwd_btn', array('label' => 'Button (EN)', 'section' => 'cha_haem_vwd', 'type' => 'text'));
    $wp_customize->add_setting('vwd_btn_km', array('default' => 'ស្វែងរកការព្យាបាល', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('vwd_btn_km', array('label' => 'Button (KM)', 'section' => 'cha_haem_vwd', 'type' => 'text'));
    $wp_customize->add_setting('vwd_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'vwd_img', array('label' => 'VWD Science Image', 'section' => 'cha_haem_vwd')));

    /* ---- Section: Other Disorders ---- */
    $wp_customize->add_section('cha_haem_other', array(
        'title' => 'Other Bleeding Disorders',
        'panel' => 'cha_haemophilia_page',
    ));

    $wp_customize->add_setting('other_heading', array('default' => 'Other Bleeding Disorders', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('other_heading', array('label' => 'Heading (EN)', 'section' => 'cha_haem_other', 'type' => 'text'));
    $wp_customize->add_setting('other_heading_km', array('default' => 'ជំងឺហូរឈាមផ្សេងៗ', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('other_heading_km', array('label' => 'Heading (KM)', 'section' => 'cha_haem_other', 'type' => 'text'));
    $other_disorders = array(
        array('Rare Factor Deficiencies', 'ការខ្វះកត្តាកម្រ', 'Deficiencies in factors I, II, V, VII, X, XI, XII and XIII. Each requires specific diagnosis and treatment.', 'ការខ្វះកត្តា I, II, V, VII, X, XI, XII និង XIII។ នីមួយៗតម្រូវឱ្យមានការវិនិច្ឆ័យ និងការព្យាបាលជាក់លាក់។'),
        array('Platelet Function Disorders', 'ការរំខានមុខងារប្លាកែត', 'Conditions where platelets don\'t work properly, leading to bleeding despite normal platelet counts.', 'ស្ថានភាពដែលប្លាកែតមិនដំណើរការត្រឹមត្រូវ នាំឱ្យហូរឈាមទោះបីមានចំនួនប្លាកែតធម្មតាក៏ដោយ។'),
    );
    for ($i = 1; $i <= 2; $i++) {
        $o = $other_disorders[$i-1];
        $wp_customize->add_setting("other_{$i}_title", array('default' => $o[0], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("other_{$i}_title", array('label' => "Disorder {$i} Title (EN)", 'section' => 'cha_haem_other', 'type' => 'text'));
        $wp_customize->add_setting("other_{$i}_title_km", array('default' => $o[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("other_{$i}_title_km", array('label' => "Disorder {$i} Title (KM)", 'section' => 'cha_haem_other', 'type' => 'text'));
        $wp_customize->add_setting("other_{$i}_desc", array('default' => $o[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("other_{$i}_desc", array('label' => "Disorder {$i} Description (EN)", 'section' => 'cha_haem_other', 'type' => 'textarea'));
        $wp_customize->add_setting("other_{$i}_desc_km", array('default' => $o[3], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("other_{$i}_desc_km", array('label' => "Disorder {$i} Description (KM)", 'section' => 'cha_haem_other', 'type' => 'textarea'));
    }
    $wp_customize->add_setting('other_footer', array('default' => 'For more information on any bleeding disorder, contact our team or visit a treatment centre.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('other_footer', array('label' => 'Footer Text (EN)', 'section' => 'cha_haem_other', 'type' => 'textarea'));
    $wp_customize->add_setting('other_footer_km', array('default' => 'សម្រាប់ព័ត៌មានបន្ថែមអំពីជំងឺហូរឈាមណាមួយ សូមទាក់ទងក្រុមរបស់យើង ឬទៅមជ្ឈមណ្ឌលព្យាបាល។', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('other_footer_km', array('label' => 'Footer Text (KM)', 'section' => 'cha_haem_other', 'type' => 'textarea'));

    /* ============================================================
       PANEL: Footer & Modals
       ============================================================ */
    $wp_customize->add_panel('cha_footer_modals', array(
        'title'    => 'Footer & Modals',
        'priority' => 36,
    ));

    $wp_customize->add_section('cha_footer_nav', array(
        'title' => 'Footer Navigation',
        'panel' => 'cha_footer_modals',
    ));

    $footer_navs = array(
        array('footer_quick_links', 'Quick Links', 'តំណរហ័ស'),
        array('footer_resources', 'Resources', 'ធនធាន'),
        array('footer_contact_heading', 'Contact Us', 'ទំនាក់ទំនង'),
        array('footer_social_links', 'Social Media Links', 'តំណបណ្តាញសង្គម'),
        array('footer_privacy', 'Privacy Policy', 'គោលនយោបាយឯកជនភាព'),
        array('footer_disclaimer', 'Disclaimer', 'ការបដិសេធ'),
        array('footer_terms', 'Terms of Service', 'លក្ខខណ្ឌនៃការប្រើប្រាស់'),
    );
    foreach ($footer_navs as $f) {
        $wp_customize->add_setting($f[0], array('default' => $f[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($f[0], array('label' => $f[1] . ' (EN)', 'section' => 'cha_footer_nav', 'type' => 'text'));
        $wp_customize->add_setting($f[0] . '_km', array('default' => $f[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($f[0] . '_km', array('label' => $f[1] . ' (KM)', 'section' => 'cha_footer_nav', 'type' => 'text'));
    }

    /* ---- Section: Legal Pages ---- */
    $wp_customize->add_section('cha_legal_pages', array(
        'title' => 'Legal Pages',
        'panel' => 'cha_footer_modals',
    ));

    $legal_texts = array(
        array('legal_last_updated', 'Last updated line', 'កាលបរិច្ឆេទអាប់ដេត'),
        array('legal_privacy_title', 'Privacy title', 'ចំណងជើងគោលនយោបាយឯកជនភាព'),
        array('legal_privacy_lead', 'Privacy intro', 'ការពិពណ៌នាគោលនយោបាយឯកជនភាព'),
        array('legal_disclaimer_title', 'Disclaimer title', 'ចំណងជើងការបដិសេធ'),
        array('legal_disclaimer_lead', 'Disclaimer intro', 'ការពិពណ៌នាការបដិសេធ'),
        array('legal_terms_title', 'Terms title', 'ចំណងជើងលក្ខខណ្ឌ'),
        array('legal_terms_lead', 'Terms intro', 'ការពិពណ៌នាលក្ខខណ្ឌ'),
    );
    foreach ($legal_texts as $l) {
        $wp_customize->add_setting($l[0], array('default' => $l[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($l[0], array('label' => $l[1] . ' (EN)', 'section' => 'cha_legal_pages', 'type' => 'text'));
        $wp_customize->add_setting($l[0] . '_km', array('default' => $l[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($l[0] . '_km', array('label' => $l[1] . ' (KM)', 'section' => 'cha_legal_pages', 'type' => 'text'));
    }

    /* ---- Section: Donate Modal ---- */
    $wp_customize->add_section('cha_donate_modal', array(
        'title' => 'Donate Modal',
        'panel' => 'cha_footer_modals',
    ));

    $donate_texts = array(
        array('donate_modal_title', 'Make a Donation', 'ធ្វើការបរិច្ចាគ'),
        array('donate_modal_heading', 'Help Change Lives!', 'ជួយផ្លាស់ប្តូរជីវិត!'),
        array('donate_modal_sub', 'Your support provides treatment, education, and hope to people with bleeding disorders in Cambodia.', 'ការគាំទ្ររបស់អ្នកផ្តល់ការព្យាបាល ការអប់រំ និងសង្ឃឹមដល់អ្នកមានជំងឺហូរឈាមនៅកម្ពុជា។'),
        array('donate_secure_label', 'Secure & encrypted', 'សុវត្ថិភាព និងអ៊ិនគ្រីប'),
        array('donate_safe_label', 'Safe', 'មានសុវត្ថិភាព'),
        array('donate_one_time', 'One-time', 'មួយដង'),
        array('donate_monthly', 'Monthly', 'ប្រចាំខែ'),
        array('donate_amount_1', '$10', '$10'),
        array('donate_amount_2', '$25', '$25'),
        array('donate_amount_3', '$50', '$50'),
        array('donate_amount_4', '$100', '$100'),
        array('donate_amount_other', 'Other', 'ផ្សេងទៀត'),
        array('donate_placeholder', 'Enter amount in USD', 'បញ្ចូលចំនួនជាដុល្លារ'),
        array('donate_monthly_note', 'Monthly gifts provide steady support for long-term care.', 'ការបរិច្ចាគប្រចាំខែផ្តល់ការគាំទ្រដែលមានស្ថេរភាពសម្រាប់ការថែទាំរយៈពេលវែង។'),
        array('donate_monthly_placeholder', 'Enter monthly amount', 'បញ្ចូលចំនួនប្រចាំខែ'),
        array('donate_payment_method', 'Payment Method', 'វិធីសាស្ត្របង់ប្រាក់'),
        array('donate_paypal', 'PayPal', 'PayPal'),
        array('donate_aba', 'ABA', 'ABA'),
        array('donate_btn', 'Donate Now', 'បរិច្ចាគឥឡូវ'),
        array('donate_btn_monthly', 'Donate Monthly', 'បរិច្ចាគប្រចាំខែ'),
        array('donate_footer_note', 'Pay directly with ABA Mobile, Bakong, or any KHQR-supported banking app', 'ស្កែនបង់ប្រាក់ផ្ទាល់តាម ABA Mobile, Bakong ឬកម្មវិធីធនាគារដែលគាំទ្រ KHQR'),
        array('donate_success_title', 'Thank You!', 'សូមអរគុណ!'),
        array('donate_success_msg', 'Your generous donation will help change lives across Cambodia.', 'ការបរិច្ចាគដ៏សប្បុរសរបស់អ្នកនឹងជួយផ្លាស់ប្តូរជីវិតនៅទូទាំងកម្ពុជា។'),
    );
    foreach ($donate_texts as $d) {
        $wp_customize->add_setting($d[0], array('default' => $d[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($d[0], array('label' => $d[1] . ' (EN)', 'section' => 'cha_donate_modal', 'type' => in_array($d[0], array('donate_modal_sub','donate_monthly_note','donate_footer_note','donate_success_msg')) ? 'textarea' : 'text'));
        $wp_customize->add_setting($d[0] . '_km', array('default' => $d[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($d[0] . '_km', array('label' => $d[1] . ' (KM)', 'section' => 'cha_donate_modal', 'type' => in_array($d[0], array('donate_modal_sub','donate_monthly_note','donate_footer_note','donate_success_msg')) ? 'textarea' : 'text'));
    }

    /* ---- Section: Member Modal ---- */
    $wp_customize->add_section('cha_member_modal', array(
        'title' => 'Member Modal',
        'panel' => 'cha_footer_modals',
    ));

    $member_texts = array(
        array('member_login_title', 'Member Login', 'ការចូលសមាជិក'),
        array('member_login_sub', 'Sign in to access your account, resources, and community.', 'ចូលដើម្បីចូលប្រើគណនី ធនធាន និងសហគមន៍របស់អ្នក។'),
        array('member_email_label', 'Email', 'អ៊ីមែល'),
        array('member_password_label', 'Password', 'ពាក្យសម្ងាត់'),
        array('member_email_placeholder', 'Enter your email', 'បញ្ចូលអ៊ីមែលរបស់អ្នក'),
        array('member_password_placeholder', 'Enter your password', 'បញ្ចូលពាក្យសម្ងាត់'),
        array('member_forgot', 'Forgot password?', 'ភ្លេចពាក្យសម្ងាត់?'),
        array('member_forgot_sub', 'Enter your email and we will send you a link to reset your password.', 'បញ្ចូលអ៊ីមែល ហើយយើងនឹងផ្ញើតំណភ្ជាប់សម្រាប់កំណត់ពាក្យសម្ងាត់ឡើងវិញ។'),
        array('member_forgot_btn', 'Send Reset Link', 'ផ្ញើតំណកំណត់ឡើងវិញ'),
        array('member_signin_btn', 'Sign In', 'ចូល'),
        array('member_register_link', 'Register', 'ចុះឈ្មោះ'),
        array('member_register_title', 'Join our community of patients, families, and members.', 'ចូលរួមសហគមន៍អ្នកជំងឺ គ្រួសារ និងសមាជិករបស់យើង។'),
        array('member_register_name_label', 'Full Name', 'ឈ្មោះពេញ'),
        array('member_register_name_placeholder', 'Enter your full name', 'បញ្ចូលឈ្មោះពេញរបស់អ្នក'),
        array('member_register_province', 'Province', 'ខេត្ត'),
        array('member_register_role', 'I am a', 'ខ្ញុំជា'),
        array('member_register_role_patient', 'Patient', 'អ្នកជំងឺ'),
        array('member_register_role_family', 'Family Member / Caregiver', 'សមាជិកគ្រួសារ / អ្នកថែទាំ'),
        array('member_register_role_professional', 'Healthcare Professional', 'អ្នកជំនាញសុខភាព'),
        array('member_register_role_member', 'Member', 'សមាជិក'),
        array('member_register_terms', 'I agree to the', 'ខ្ញុំយល់ព្រមនឹង'),
        array('member_register_terms_link', 'Terms & Conditions', 'លក្ខខណ្ឌ'),
        array('member_register_btn', 'Register', 'ចុះឈ្មោះ'),
        array('member_register_login', 'Already have an account?', 'មានគណនីរួចហើយ?'),
        array('member_count', '500+', '៥០០+'),
        array('member_count_label', 'Members & Growing', 'សមាជិក និងកំពុងកើនឡើង'),
    );
    foreach ($member_texts as $m) {
        $wp_customize->add_setting($m[0], array('default' => $m[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($m[0], array('label' => $m[1] . ' (EN)', 'section' => 'cha_member_modal', 'type' => in_array($m[0], array('member_login_sub','member_register_title','member_forgot_sub')) ? 'textarea' : 'text'));
        $wp_customize->add_setting($m[0] . '_km', array('default' => $m[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($m[0] . '_km', array('label' => $m[1] . ' (KM)', 'section' => 'cha_member_modal', 'type' => in_array($m[0], array('member_login_sub','member_register_title','member_forgot_sub')) ? 'textarea' : 'text'));
    }

    /* ============================================================
       PANEL: Homepage Extras
       ============================================================ */
    $wp_customize->add_panel('cha_homepage_extras', array(
        'title'    => 'Homepage Extras',
        'priority' => 37,
    ));

    /* ---- Section: Impact ---- */
    $wp_customize->add_section('cha_impact', array(
        'title' => 'Impact Section',
        'panel' => 'cha_homepage_extras',
    ));

    $impact_items = array(
        array('Provide treatment access for patients', 'ផ្តល់ការចូលប្រើប្រាស់ការព្យាបាលដល់អ្នកជំងឺ'),
        array('Support education and awareness', 'គាំទ្រការអប់រំ និងការយល់ដឹង'),
        array('Strengthen healthcare capacity', 'ពង្រឹងសមត្ថភាពសុខភាព'),
        array('Empower families and communities', 'ផ្តល់សមត្ថភាពដល់គ្រួសារ និងសហគមន៍'),
    );
    $wp_customize->add_setting('impact_heading', array('default' => 'Your Impact', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('impact_heading', array('label' => 'Heading (EN)', 'section' => 'cha_impact', 'type' => 'text'));
    $wp_customize->add_setting('impact_heading_km', array('default' => 'ផលប៉ះពាល់របស់អ្នក', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('impact_heading_km', array('label' => 'Heading (KM)', 'section' => 'cha_impact', 'type' => 'text'));
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("impact_{$i}", array('default' => $impact_items[$i-1][0], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("impact_{$i}", array('label' => "Item {$i} (EN)", 'section' => 'cha_impact', 'type' => 'text'));
        $wp_customize->add_setting("impact_{$i}_km", array('default' => $impact_items[$i-1][1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("impact_{$i}_km", array('label' => "Item {$i} (KM)", 'section' => 'cha_impact', 'type' => 'text'));
    }

    /* ---- Section: Membership ---- */
    $wp_customize->add_section('cha_membership_section', array(
        'title' => 'Membership Section',
        'panel' => 'cha_homepage_extras',
    ));

    $membership_fields = array(
        array('membership_heading', 'Membership', 'សមាជិកភាព'),
        array('membership_benefits_heading', 'Membership Benefits', 'អត្ថប្រយោជន៍សមាជិកភាព'),
        array('membership_cta_heading', 'Become a Member', 'ក្លាយជាសមាជិក'),
        array('membership_cta_text', 'Join our community to access exclusive resources, events, and peer support across Cambodia.', 'ចូលរួមសហគមន៍របស់យើងដើម្បីចូលប្រើធនធានផ្តាច់មុខ ព្រឹត្តិការណ៍ និងការគាំទ្រមិត្តភក្តិនៅទូទាំងកម្ពុជា។'),
        array('membership_cta_btn', 'Register Now', 'ចុះឈ្មោះឥឡូវ'),
        array('membership_cta_login', 'Already a member? Sign In', 'ជាសមាជិករួចហើយ? ចូល'),
        array('membership_count', '500+', '៥០០+'),
        array('membership_count_label', 'Members & Growing', 'សមាជិក និងកំពុងកើនឡើង'),
    );
    foreach ($membership_fields as $m) {
        $wp_customize->add_setting($m[0], array('default' => $m[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($m[0], array('label' => $m[1] . ' (EN)', 'section' => 'cha_membership_section', 'type' => in_array($m[0], array('membership_cta_text')) ? 'textarea' : 'text'));
        $wp_customize->add_setting($m[0] . '_km', array('default' => $m[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($m[0] . '_km', array('label' => $m[1] . ' (KM)', 'section' => 'cha_membership_section', 'type' => in_array($m[0], array('membership_cta_text')) ? 'textarea' : 'text'));
    }

    $benefits = array(
        array('Community & Support', 'សហគមន៍ និងការគាំទ្រ', 'Connect with patients, families, and caregivers across Cambodia.', 'ភ្ជាប់ជាមួយអ្នកជំងឺ គ្រួសារ និងអ្នកថែទាំនៅទូទាំងកម្ពុជា។'),
        array('Access to Resources', 'ការចូលប្រើធនធាន', 'Exclusive guides, educational materials, and treatment information.', 'មគ្គុទ្ទេសក៍ផ្តាច់មុខ សម្ភារៈអប់រំ និងព័ត៌មានព្យាបាល។'),
        array('Events & Workshops', 'ព្រឹត្តិការណ៍ និងសិក្ខាសាលា', 'Participate in hands-on workshops, community events, and online learning sessions.', 'ចូលរួមសិក្ខាសាលាអនុវត្តជាក់ស្តែង ព្រឹត្តិការណ៍សហគមន៍ និងវគ្គសិក្សាតាមអនឡាញ។'),
        array('Advocacy & Awareness', 'ការតស៊ូមតិ និងការយល់ដឹង', 'Help raise awareness and advocate for better care nationwide.', 'ជួយលើកកម្ពស់ការយល់ដឹង និងតស៊ូមតិសម្រាប់ការថែទាំល្អប្រសើរទូទាំងប្រទេស។'),
        array('Updates & Newsletters', 'ព័ត៌មាន និងព្រឹត្តិបត្រ', 'Stay informed with the latest news and CHA announcements.', 'ទទួលបានព័ត៌មានថ្មីៗ និងសេចក្តីប្រកាសរបស់ CHA។'),
    );
    for ($i = 1; $i <= 5; $i++) {
        $b = $benefits[$i-1];
        $wp_customize->add_setting("benefit_{$i}_title", array('default' => $b[0], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("benefit_{$i}_title", array('label' => "Benefit {$i} Title (EN)", 'section' => 'cha_membership_section', 'type' => 'text'));
        $wp_customize->add_setting("benefit_{$i}_title_km", array('default' => $b[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("benefit_{$i}_title_km", array('label' => "Benefit {$i} Title (KM)", 'section' => 'cha_membership_section', 'type' => 'text'));
        $wp_customize->add_setting("benefit_{$i}_desc", array('default' => $b[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("benefit_{$i}_desc", array('label' => "Benefit {$i} Description (EN)", 'section' => 'cha_membership_section', 'type' => 'textarea'));
        $wp_customize->add_setting("benefit_{$i}_desc_km", array('default' => $b[3], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("benefit_{$i}_desc_km", array('label' => "Benefit {$i} Description (KM)", 'section' => 'cha_membership_section', 'type' => 'textarea'));
    }
    $perks = array(
        array('Exclusive resources & guides', 'ធនធាន និងមគ្គុទ្ទេសក៍ផ្តាច់មុខ'),
        array('Events & community meetups', 'ព្រឹត្តិការណ៍ និងការជួបជុំសហគមន៍'),
        array('Peer support network', 'បណ្តាញគាំទ្រមិត្តភក្តិ'),
    );
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("membership_perk_{$i}", array('default' => $perks[$i-1][0], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("membership_perk_{$i}", array('label' => "Perk {$i} (EN)", 'section' => 'cha_membership_section', 'type' => 'text'));
        $wp_customize->add_setting("membership_perk_{$i}_km", array('default' => $perks[$i-1][1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("membership_perk_{$i}_km", array('label' => "Perk {$i} (KM)", 'section' => 'cha_membership_section', 'type' => 'text'));
    }
    $wp_customize->add_setting('membership_cta_img', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'membership_cta_img', array('label' => 'Membership CTA Image', 'section' => 'cha_membership_section')));

    /* ---- Section: Contact Sub-sections ---- */
    $wp_customize->add_section('cha_contact_sub', array(
        'title' => 'Contact Sub-sections',
        'panel' => 'cha_homepage_extras',
    ));

    $contact_extra = array(
        array('contact_get_in_touch', 'Get In Touch', 'ទំនាក់ទំនង'),
        array('contact_we_are_here', "We're here to help patients, families, and partners across Cambodia.", 'យើងនៅទីនេះដើម្បីជួយអ្នកជំងឺ គ្រួសារ និងដៃគូនៅទូទាំងកម្ពុជា។'),
        array('contact_office_hours', 'Office Hours', 'ម៉ោងធ្វើការ'),
        array('contact_send_msg', 'Send us a Message', 'ផ្ញើសារមកយើង'),
        array('contact_send_sub', 'Fill out the form and our team will respond within 1-2 working days.', 'បំពេញទម្រង់បែបបទ ហើយក្រុមរបស់យើងនឹងឆ្លើយតបក្នុងរយៈពេល ១-២ ថ្ងៃធ្វើការ។'),
        array('contact_form_name', 'Full Name', 'ឈ្មោះពេញ'),
        array('contact_form_email', 'Email', 'អ៊ីមែល'),
        array('contact_form_subject', 'Subject', 'ប្រធានបទ'),
        array('contact_form_message', 'Message', 'សារ'),
        array('contact_form_name_ph', 'Enter your full name', 'បញ្ចូលឈ្មោះពេញរបស់អ្នក'),
        array('contact_form_email_ph', 'Enter your email', 'បញ្ចូលអ៊ីមែលរបស់អ្នក'),
        array('contact_form_subject_ph', "What's this about?", 'នេះនិយាយអំពីអ្វី?'),
        array('contact_form_message_ph', 'How can we help?', 'តើយើងអាចជួយអ្នកដូចម្តេច?'),
        array('contact_form_btn', 'Send Message', 'ផ្ញើសារ'),
        array('contact_form_success', 'Message Sent! Thank you for reaching out. We\'ll respond within 1-2 working days.', 'សារត្រូវបានផ្ញើ! សូមអរគុណចំពោះការទាក់ទង។ យើងនឹងឆ្លើយតបក្នុងរយៈពេល ១-២ ថ្ងៃធ្វើការ។'),
    );
    foreach ($contact_extra as $c) {
        $wp_customize->add_setting($c[0], array('default' => $c[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($c[0], array('label' => $c[1] . ' (EN)', 'section' => 'cha_contact_sub', 'type' => in_array($c[0], array('contact_we_are_here','contact_send_sub','contact_form_success')) ? 'textarea' : 'text'));
        $wp_customize->add_setting($c[0] . '_km', array('default' => $c[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($c[0] . '_km', array('label' => $c[1] . ' (KM)', 'section' => 'cha_contact_sub', 'type' => in_array($c[0], array('contact_we_are_here','contact_send_sub','contact_form_success')) ? 'textarea' : 'text'));
    }
}
add_action('customize_register', 'cha_customize_register');
