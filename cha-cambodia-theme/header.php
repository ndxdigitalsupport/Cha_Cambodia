<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Koulen:wght@400;700&family=Siemreap:wght@400&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- HEADER -->
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="<?php echo home_url(); ?>"><img class="brand-logo" src="<?php echo get_template_directory_uri(); ?>/cha-logo-left.png" alt="Cambodian Haemophilia Association"></a>
        <nav class="main-nav" aria-label="Primary">
            <a href="<?php echo home_url(); ?>" data-i18n="nav_home"><?php echo esc_html(cha_get_option('nav_home', 'Home')); ?></a>
            <div class="nav-drop" data-nav-drop>
                <button class="nav-drop-trigger" type="button" aria-expanded="false" aria-haspopup="true" data-i18n="nav_about"><?php echo esc_html(cha_get_option('nav_about', 'About Us')); ?><svg width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                <div class="nav-drop-panel">
                    <a href="<?php echo home_url('/about'); ?>" data-i18n="nav_about_who"><?php echo esc_html(cha_get_option('nav_about_who', 'Who is CHA?')); ?></a>
                    <a href="<?php echo home_url('/about'); ?>#about-leadership" data-i18n="nav_about_leadership"><?php echo esc_html(cha_get_option('nav_about_leadership', 'Leadership structure and Groups')); ?></a>
                    <a href="<?php echo home_url('/about'); ?>#about-src" data-i18n="nav_about_src"><?php echo esc_html(cha_get_option('nav_about_src', 'SRC')); ?></a>
                    <a href="<?php echo home_url('/about'); ?>#about-history" data-i18n="nav_about_history"><?php echo esc_html(cha_get_option('nav_about_history', 'Our History')); ?></a>
                    <a href="<?php echo home_url('/about'); ?>#about-wfh" data-i18n="nav_about_wfh"><?php echo esc_html(cha_get_option('nav_about_wfh', 'Our work with WFH and HFA')); ?></a>
                    <a href="<?php echo home_url(); ?>#contact" data-i18n="nav_about_contact"><?php echo esc_html(cha_get_option('nav_about_contact', 'Contact Us')); ?></a>
                </div>
            </div>
            <div class="nav-drop" data-nav-drop>
                <button class="nav-drop-trigger" type="button" aria-expanded="false" aria-haspopup="true" data-i18n="nav_haemophilia"><?php echo esc_html(cha_get_option('nav_haemophilia', 'About Haemophilia')); ?><svg width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                <div class="nav-drop-panel">
                    <a href="<?php echo home_url('/haemophilia'); ?>" data-i18n="nav_haemophilia_about"><?php echo esc_html(cha_get_option('nav_haemophilia_about', 'About Haemophilia')); ?></a>
                    <a href="<?php echo home_url('/haemophilia'); ?>#vwd" data-i18n="nav_haemophilia_vwd"><?php echo esc_html(cha_get_option('nav_haemophilia_vwd', 'About VWD')); ?></a>
                    <a href="<?php echo home_url('/haemophilia'); ?>#other-bleeding" data-i18n="nav_haemophilia_other"><?php echo esc_html(cha_get_option('nav_haemophilia_other', 'About other bleeding disorders')); ?></a>
                    <span class="nav-drop-divider"></span>
                    <a href="<?php echo home_url('/programs'); ?>#treatment-centres" data-i18n="nav_programs"><?php echo esc_html(cha_get_option('nav_programs', 'Haemophilia Treatment Centres')); ?></a>
                    <a href="<?php echo home_url('/programs'); ?>#csr" class="nav-drop-parent" data-i18n="nav_csr"><?php echo esc_html(cha_get_option('nav_csr', 'CSR Program')); ?></a>
                    <a href="<?php echo home_url('/programs'); ?>#csr" class="nav-drop-sub" data-i18n="nav_csr_fundraising"><?php echo esc_html(cha_get_option('nav_csr_fundraising', 'Fundraising')); ?></a>
                    <a href="<?php echo home_url('/programs'); ?>#csr" class="nav-drop-sub" data-i18n="nav_csr_donate"><?php echo esc_html(cha_get_option('nav_csr_donate', 'Online donation')); ?></a>
                    <a href="<?php echo home_url('/programs'); ?>#csr" class="nav-drop-sub" data-i18n="nav_csr_partners"><?php echo esc_html(cha_get_option('nav_csr_partners', 'Corporate Partners')); ?></a>
                </div>
            </div>
            <div class="nav-drop" data-nav-drop>
                <button class="nav-drop-trigger" type="button" aria-expanded="false" aria-haspopup="true" data-i18n="nav_news"><?php echo esc_html(cha_get_option('nav_news', 'News')); ?><svg width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                <div class="nav-drop-panel">
                    <a href="<?php echo esc_url(get_post_type_archive_link('cha_news')); ?>" data-i18n="nav_news_latest"><?php echo esc_html(cha_get_option('nav_news_latest', 'Latest News')); ?></a>
                    <a href="<?php echo esc_url(add_query_arg('cat', 'event', get_post_type_archive_link('cha_news'))); ?>" data-i18n="nav_news_events"><?php echo esc_html(cha_get_option('nav_news_events', 'Upcoming Events')); ?></a>
                </div>
            </div>
            <a href="<?php echo home_url(); ?>#contact" data-i18n="nav_contact"><?php echo esc_html(cha_get_option('nav_contact', 'Contact')); ?></a>
        </nav>
        <div class="header-actions">
            <button class="lang-switcher" type="button" aria-label="Switch language" data-lang-toggle>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                <span class="lang-label">EN</span>
            </button>
            <a class="btn btn-member btn-sm" href="#" data-member-trigger data-i18n="nav_become_member"><?php echo esc_html(cha_get_option('nav_become_member', 'Become a Member')); ?></a>
            <a class="btn btn-donate" href="#" data-donate-trigger data-i18n="nav_donate"><?php echo esc_html(cha_get_option('nav_donate', 'Donate')); ?></a>
            <button class="nav-toggle" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-drawer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
        </div>
    </div>
</header>

<!-- MOBILE DRAWER -->
<div class="mobile-drawer" id="mobile-drawer" aria-hidden="true">
    <div class="backdrop"></div>
    <div class="panel" role="dialog" aria-modal="true" aria-label="Site menu">
        <div class="panel-head">
            <a class="brand" href="<?php echo home_url(); ?>"><img class="brand-logo" src="<?php echo get_template_directory_uri(); ?>/cha-logo-left.png" alt="Cambodian Haemophilia Association"></a>
            <button class="close" type="button" aria-label="Close menu"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <nav aria-label="Mobile primary">
            <a href="<?php echo home_url(); ?>" data-i18n="nav_home"><?php echo esc_html(cha_get_option('nav_home', 'Home')); ?></a>
            <div class="drawer-group">
                <button class="drawer-sub-trigger" type="button" aria-expanded="false" data-i18n="nav_about"><?php echo esc_html(cha_get_option('nav_about', 'About Us')); ?><svg width="12" height="7" viewBox="0 0 12 7" fill="none" aria-hidden="true"><path d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                <div class="drawer-sub-items">
                    <a href="<?php echo home_url('/about'); ?>" data-i18n="nav_about_who"><?php echo esc_html(cha_get_option('nav_about_who', 'Who is CHA?')); ?></a>
                    <a href="<?php echo home_url('/about'); ?>#about-leadership" data-i18n="nav_about_leadership"><?php echo esc_html(cha_get_option('nav_about_leadership', 'Leadership structure and Groups')); ?></a>
                    <a href="<?php echo home_url('/about'); ?>#about-src" data-i18n="nav_about_src"><?php echo esc_html(cha_get_option('nav_about_src', 'SRC')); ?></a>
                    <a href="<?php echo home_url('/about'); ?>#about-history" data-i18n="nav_about_history"><?php echo esc_html(cha_get_option('nav_about_history', 'Our History')); ?></a>
                    <a href="<?php echo home_url('/about'); ?>#about-wfh" data-i18n="nav_about_wfh"><?php echo esc_html(cha_get_option('nav_about_wfh', 'Our work with WFH and HFA')); ?></a>
                    <a href="<?php echo home_url(); ?>#contact" data-i18n="nav_about_contact"><?php echo esc_html(cha_get_option('nav_about_contact', 'Contact Us')); ?></a>
                </div>
            </div>
            <div class="drawer-group">
                <button class="drawer-sub-trigger" type="button" aria-expanded="false" data-i18n="nav_haemophilia"><?php echo esc_html(cha_get_option('nav_haemophilia', 'About Haemophilia')); ?><svg width="12" height="7" viewBox="0 0 12 7" fill="none" aria-hidden="true"><path d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                <div class="drawer-sub-items">
                    <a href="<?php echo home_url('/haemophilia'); ?>" data-i18n="nav_haemophilia_about"><?php echo esc_html(cha_get_option('nav_haemophilia_about', 'About Haemophilia')); ?></a>
                    <a href="<?php echo home_url('/haemophilia'); ?>#vwd" data-i18n="nav_haemophilia_vwd"><?php echo esc_html(cha_get_option('nav_haemophilia_vwd', 'About VWD')); ?></a>
                    <a href="<?php echo home_url('/haemophilia'); ?>#other-bleeding" data-i18n="nav_haemophilia_other"><?php echo esc_html(cha_get_option('nav_haemophilia_other', 'About other bleeding disorders')); ?></a>
                    <span class="drawer-sub-divider"></span>
                    <a href="<?php echo home_url('/programs'); ?>#treatment-centres" class="drawer-sub-parent" data-i18n="nav_programs"><?php echo esc_html(cha_get_option('nav_programs', 'Haemophilia Treatment Centres')); ?></a>
                    <a href="<?php echo home_url('/programs'); ?>#csr" class="drawer-sub-parent" data-i18n="nav_csr"><?php echo esc_html(cha_get_option('nav_csr', 'CSR Program')); ?></a>
                    <a href="<?php echo home_url('/programs'); ?>#csr" class="drawer-sub-sub" data-i18n="nav_csr_fundraising"><?php echo esc_html(cha_get_option('nav_csr_fundraising', 'Fundraising')); ?></a>
                    <a href="<?php echo home_url('/programs'); ?>#csr" class="drawer-sub-sub" data-i18n="nav_csr_donate"><?php echo esc_html(cha_get_option('nav_csr_donate', 'Online donation')); ?></a>
                    <a href="<?php echo home_url('/programs'); ?>#csr" class="drawer-sub-sub" data-i18n="nav_csr_partners"><?php echo esc_html(cha_get_option('nav_csr_partners', 'Corporate Partners')); ?></a>
                </div>
            </div>
            <div class="drawer-group">
                <button class="drawer-sub-trigger" type="button" aria-expanded="false" data-i18n="nav_news"><?php echo esc_html(cha_get_option('nav_news', 'News')); ?><svg width="12" height="7" viewBox="0 0 12 7" fill="none" aria-hidden="true"><path d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                <div class="drawer-sub-items">
                    <a href="<?php echo esc_url(get_post_type_archive_link('cha_news')); ?>" data-i18n="nav_news_latest"><?php echo esc_html(cha_get_option('nav_news_latest', 'Latest News')); ?></a>
                    <a href="<?php echo esc_url(add_query_arg('cat', 'event', get_post_type_archive_link('cha_news'))); ?>" data-i18n="nav_news_events"><?php echo esc_html(cha_get_option('nav_news_events', 'Upcoming Events')); ?></a>
                </div>
            </div>
            <a href="<?php echo home_url(); ?>#contact" data-i18n="nav_contact"><?php echo esc_html(cha_get_option('nav_contact', 'Contact')); ?></a>
        </nav>
        <div class="panel-actions">
            <button class="lang-switcher" type="button" aria-label="Switch language" data-lang-toggle style="margin-bottom:var(--s-3);width:100%;justify-content:center">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                <span class="lang-label">EN</span>
            </button>
            <a class="btn btn-member btn-block" href="#" data-member-trigger data-i18n="nav_become_member"><?php echo esc_html(cha_get_option('nav_become_member', 'Become a Member')); ?></a>
            <a class="btn btn-donate btn-block" href="#" data-donate-trigger data-i18n="nav_donate"><?php echo esc_html(cha_get_option('nav_donate', 'Donate')); ?></a>
        </div>
    </div>
</div>

<main id="main">