<?php
if (!defined('ABSPATH')) {
    exit;
}

// Route /verify, /reset-password, and /verify-member
add_action('template_redirect', function() {
    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    if ($uri === 'verify') {
        include get_template_directory() . '/verify.php';
        exit;
    }
    if ($uri === 'reset-password') {
        include get_template_directory() . '/reset-password.php';
        exit;
    }
    if ($uri === 'verify-member') {
        include get_template_directory() . '/verify-member.php';
        exit;
    }
});

// WordPress Customizer settings
require_once get_template_directory() . '/customizer.php';

if (!function_exists('cha_get_option')) {
    function cha_get_option($field, $default = '') {
        $sentinel = '__CHA_EMPTY__';
        $value = get_theme_mod($field, $sentinel);
        if ($value === $sentinel) return $default;
        return $value;
    }
}

if (!function_exists('cha_customizer_km_data')) {
    function cha_customizer_km_data() {
        $en_fields = array(
            'hero_title_1', 'hero_title_2', 'hero_lead', 'hero_cta_support', 'hero_cta_member',
            'stat_provinces_lbl', 'stat_patients_lbl', 'stat_partners_lbl',
            'help_heading', 'help_sub',
            'help_card_1_title', 'help_card_1_desc', 'help_card_2_title', 'help_card_2_desc',
            'help_card_3_title', 'help_card_3_desc', 'help_card_4_title', 'help_card_4_desc',
            'cta_heading', 'cta_sub', 'cta_btn',
            'about_heading', 'about_lead', 'about_vision_label', 'about_vision_text',
            'about_mission_label', 'about_mission_text',
            'contact_heading', 'contact_sub', 'contact_address',
            'contact_hours_mf', 'contact_hours_sat',
            'footer_tagline', 'footer_copyright',
            /* Nav */
            'nav_home', 'nav_about', 'nav_about_who', 'nav_about_leadership', 'nav_about_src',
            'nav_about_history', 'nav_about_wfh', 'nav_about_contact',
            'nav_haemophilia', 'nav_haemophilia_about', 'nav_haemophilia_vwd', 'nav_haemophilia_other',
            'nav_programs', 'nav_csr', 'nav_csr_fundraising', 'nav_csr_donate', 'nav_csr_partners',
            'nav_news', 'nav_news_latest', 'nav_news_events', 'nav_contact',
            'nav_become_member', 'nav_donate',
            /* SRC */
            'src_heading', 'src_sub', 'src_cta_heading', 'src_cta_text', 'src_cta_btn_1', 'src_cta_btn_2',
            'src_eyebrow', 'src_stat_label_1', 'src_kicker_reach', 'src_link_1',
            'src_stat_label_2', 'src_kicker_people', 'src_link_2',
            'src_stat_label_3', 'src_kicker_region', 'src_link_3',
            'src_cta_sub',
            'src_card_1_unit', 'src_card_1_kicker', 'src_card_1_title', 'src_card_1_desc', 'src_card_1_link',
            'src_card_2_unit', 'src_card_2_kicker', 'src_card_2_title', 'src_card_2_desc', 'src_card_2_link',
            'src_card_3_unit', 'src_card_3_kicker', 'src_card_3_title', 'src_card_3_desc', 'src_card_3_link',
            /* History */
            'history_heading', 'history_intro',
            'history_1_title', 'history_1_desc', 'history_2_title', 'history_2_desc',
            'history_3_title', 'history_3_desc', 'history_4_title', 'history_4_desc',
            /* Presidents */
            'president_heading',
            'president_1_name', 'president_1_role', 'president_1_term',
            'president_2_name', 'president_2_role', 'president_2_term',
            'president_3_name', 'president_3_role', 'president_3_term',
            /* Leadership */
            'leadership_heading', 'leadership_sub', 'leadership_btn',
            'leader_1_name', 'leader_1_role', 'leader_2_name', 'leader_2_role',
            'leader_3_name', 'leader_3_role', 'leader_4_name', 'leader_4_role',
            'youth_title', 'youth_desc', 'women_title', 'women_desc',
            /* WFH/HFA */
            'wfh_heading', 'wfh_sub',
            'wfh_card_title', 'wfh_card_tag', 'wfh_card_stat_lbl', 'wfh_card_desc', 'wfh_card_link',
            'hfa_card_title', 'hfa_card_tag', 'hfa_card_stat_lbl', 'hfa_card_desc', 'hfa_card_link',
            /* Programs */
            'programs_heading', 'programs_sub', 'programs_select_lbl', 'programs_select_all',
            'programs_view_map',
            'hospital_1_name', 'hospital_1_location', 'hospital_1_tag_1', 'hospital_1_tag_2', 'hospital_1_tag_3',
            'hospital_2_name', 'hospital_2_location', 'hospital_2_tag_1', 'hospital_2_tag_2', 'hospital_2_tag_3',
            'hospital_3_name', 'hospital_3_location', 'hospital_3_tag_1', 'hospital_3_tag_2', 'hospital_3_tag_3',
            'emergency_heading', 'emergency_text',
            'csr_heading', 'csr_sub',
            'csr_1_title', 'csr_1_desc', 'csr_1_link',
            'csr_2_title', 'csr_2_desc', 'csr_2_link',
            'csr_3_title', 'csr_3_desc', 'csr_3_link',
            /* Haemophilia */
            'haem_intro_heading', 'haem_intro_p1', 'haem_intro_p2', 'haem_intro_btn',
            'haem_types_heading', 'haem_types_sub',
            'haem_type_a_title', 'haem_type_a_desc', 'haem_type_b_title', 'haem_type_b_desc',
            'haem_symptoms_heading', 'haem_symptoms_sub',
            'symptom_1_title', 'symptom_1_desc',
            'symptom_2_title', 'symptom_2_desc',
            'symptom_3_title', 'symptom_3_desc',
            'symptom_4_title', 'symptom_4_desc',
            'symptom_5_title', 'symptom_5_desc',
            'symptoms_cta', 'symptoms_btn_1', 'symptoms_btn_2',
            'vwd_heading', 'vwd_p1', 'vwd_p2', 'vwd_btn',
            'other_heading', 'other_1_title', 'other_1_desc', 'other_2_title', 'other_2_desc', 'other_footer',
            /* Footer nav */
            'footer_quick_links', 'footer_resources', 'footer_contact_heading', 'footer_social_links',
            'footer_privacy', 'footer_disclaimer', 'footer_terms',
            /* Donate modal */
            'donate_modal_title', 'donate_modal_heading', 'donate_modal_sub',
            'donate_secure_label', 'donate_safe_label', 'donate_one_time', 'donate_monthly',
            'donate_amount_1', 'donate_amount_2', 'donate_amount_3', 'donate_amount_4', 'donate_amount_other',
            'donate_placeholder', 'donate_monthly_note', 'donate_monthly_placeholder',
            'donate_payment_method', 'donate_paypal', 'donate_aba',
            'donate_btn', 'donate_btn_monthly', 'donate_footer_note',
            'donate_success_title', 'donate_success_msg',
            /* Member modal */
            'member_login_title', 'member_login_sub',
            'member_email_label', 'member_password_label', 'member_email_placeholder', 'member_password_placeholder',
            'member_forgot', 'member_forgot_sub', 'member_forgot_btn', 'member_signin_btn', 'member_register_link', 'member_register_title',
            'member_register_name_label', 'member_register_name_placeholder',
            'member_register_province', 'member_register_role',
            'member_register_role_patient', 'member_register_role_family', 'member_register_role_professional', 'member_register_role_member',
            'member_register_terms', 'member_register_terms_link', 'member_register_btn', 'member_register_login',
            'member_count', 'member_count_label',
            /* Homepage extras */
            'impact_heading', 'impact_1', 'impact_2', 'impact_3', 'impact_4',
            'membership_heading', 'membership_benefits_heading',
            'benefit_1_title', 'benefit_1_desc', 'benefit_2_title', 'benefit_2_desc',
            'benefit_3_title', 'benefit_3_desc', 'benefit_4_title', 'benefit_4_desc',
            'membership_cta_heading', 'membership_cta_text', 'membership_cta_btn', 'membership_cta_login',
            'membership_count', 'membership_count_label',
            'membership_perk_1', 'membership_perk_2', 'membership_perk_3',
            'contact_get_in_touch', 'contact_we_are_here', 'contact_office_hours',
            'contact_send_msg', 'contact_send_sub',
            'contact_form_name', 'contact_form_email', 'contact_form_subject', 'contact_form_message',
            'contact_form_name_ph', 'contact_form_email_ph', 'contact_form_subject_ph', 'contact_form_message_ph',
            'contact_form_btn', 'contact_form_success',
            /* Legal pages */
            'legal_last_updated', 'legal_privacy_title', 'legal_privacy_lead',
            'legal_disclaimer_title', 'legal_disclaimer_lead',
            'legal_terms_title', 'legal_terms_lead',
        );
        $map = array();
        foreach ($en_fields as $f) {
            $km_val = get_theme_mod($f . '_km');
            if ($km_val !== null && $km_val !== '' && $km_val !== false) {
                $map[$f] = $km_val;
            }
        }
        echo '<script>window.chaCustomizerKM = ' . wp_json_encode($map) . ';</script>';
    }
}
add_action('wp_head', 'cha_customizer_km_data');

function cha_enqueue_assets() {
    wp_enqueue_style('cha-style', get_stylesheet_uri());
    wp_enqueue_style('cha-custom-css', get_template_directory_uri() . '/style-cha.css', array(), '5.1.2');
    wp_enqueue_style('cha-google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Koulen:wght@400;700&family=Siemreap:wght@400&display=swap');
    wp_enqueue_script('cha-custom-js', get_template_directory_uri() . '/script-cha.js', array(), '1.5.1', true);
    wp_localize_script('cha-custom-js', 'chaApi', array(
        'rest_url' => rest_url('cha/v1/'),
        'nonce'    => wp_create_nonce('wp_rest'),
    ));
}
add_action('wp_enqueue_scripts', 'cha_enqueue_assets');

function cha_register_menus() {
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'cha-cambodia'),
    ));
}
add_action('init', 'cha_register_menus');

add_theme_support('post-thumbnails');

/* ===== CHA NEWS & EVENTS CUSTOM POST TYPE ===== */

function cha_register_news_cpt() {
    register_post_type('cha_news', array(
        'labels' => array(
            'name'               => 'News & Events',
            'singular_name'      => 'News Article',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Article',
            'edit_item'          => 'Edit Article',
            'all_items'          => 'All Articles',
            'view_item'          => 'View Article',
            'search_items'       => 'Search Articles',
            'not_found'          => 'No articles found',
            'not_found_in_trash' => 'No articles found in Trash',
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'news'),
        'menu_icon'    => 'dashicons-welcome-view-site',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'cha_register_news_cpt');

define('CHA_CPT_VERSION', '1.4');

function cha_flush_rewrite_on_upgrade() {
    $stored = get_option('cha_cpt_version', '0');
    if ($stored !== CHA_CPT_VERSION) {
        cha_register_news_cpt();
        cha_register_campaigns_cpt();
        flush_rewrite_rules();
        update_option('cha_cpt_version', CHA_CPT_VERSION);
    }
}
add_action('init', 'cha_flush_rewrite_on_upgrade', 99);

function cha_news_meta_boxes() {
    add_meta_box('cha_news_details', 'Article Details', 'cha_news_details_cb', 'cha_news', 'side', 'high');
}
add_action('add_meta_boxes', 'cha_news_meta_boxes');

function cha_news_details_cb($post) {
    wp_nonce_field('cha_news_details', 'cha_news_nonce');
    $date_display = get_post_meta($post->ID, '_cha_news_date', true);
    $badge = get_post_meta($post->ID, '_cha_news_badge', true);
    $title_km = get_post_meta($post->ID, '_cha_news_title_km', true);
    $excerpt_km = get_post_meta($post->ID, '_cha_news_excerpt_km', true);
    ?>
    <p><label for="cha_news_date"><strong>Display Date</strong><br><small>e.g. Apr 17, 2025</small></label>
    <input type="text" id="cha_news_date" name="cha_news_date" value="<?php echo esc_attr($date_display); ?>" style="width:100%;margin-top:4px;" placeholder="Apr 17, 2025"></p>
    <p><label for="cha_news_badge"><strong>Category Badge</strong></label>
    <select id="cha_news_badge" name="cha_news_badge" style="width:100%;margin-top:4px;">
        <option value="Event" <?php selected($badge, 'Event'); ?>>Event</option>
        <option value="Update" <?php selected($badge, 'Update'); ?>>Update</option>
        <option value="Workshop" <?php selected($badge, 'Workshop'); ?>>Workshop</option>
        <option value="Announcement" <?php selected($badge, 'Announcement'); ?>>Announcement</option>
    </select></p>
    <hr style="margin:12px 0;">
    <p><label for="cha_news_title_km"><strong>Title (Khmer)</strong><br><small>Leave blank to auto-translate</small></label>
    <input type="text" id="cha_news_title_km" name="cha_news_title_km" value="<?php echo esc_attr($title_km); ?>" style="width:100%;margin-top:4px;" placeholder="ចំណងជើងភាសាខ្មែរ"></p>
    <p><label for="cha_news_excerpt_km"><strong>Excerpt (Khmer)</strong><br><small>Leave blank to auto-translate</small></label>
    <textarea id="cha_news_excerpt_km" name="cha_news_excerpt_km" rows="3" style="width:100%;margin-top:4px;" placeholder="សេចក្តីផ្សាយភាសាខ្មែរ"><?php echo esc_textarea($excerpt_km); ?></textarea></p>
    <?php
}

function cha_save_news_details($post_id) {
    if (!isset($_POST['cha_news_nonce']) || !wp_verify_nonce($_POST['cha_news_nonce'], 'cha_news_details')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['cha_news_date'])) update_post_meta($post_id, '_cha_news_date', sanitize_text_field($_POST['cha_news_date']));
    if (isset($_POST['cha_news_badge'])) update_post_meta($post_id, '_cha_news_badge', sanitize_text_field($_POST['cha_news_badge']));
    if (isset($_POST['cha_news_title_km'])) update_post_meta($post_id, '_cha_news_title_km', sanitize_text_field($_POST['cha_news_title_km']));
    if (isset($_POST['cha_news_excerpt_km'])) update_post_meta($post_id, '_cha_news_excerpt_km', sanitize_textarea_field($_POST['cha_news_excerpt_km']));
}
add_action('save_post_cha_news', 'cha_save_news_details');

function cha_news_admin_columns($columns) {
    $new = array();
    foreach ($columns as $key => $val) {
        $new[$key] = $val;
        if ($key === 'title') {
            $new['cha_news_badge'] = 'Badge';
            $new['cha_news_date'] = 'Display Date';
        }
    }
    return $new;
}
add_filter('manage_cha_news_posts_columns', 'cha_news_admin_columns');

function cha_news_admin_column_data($column, $post_id) {
    if ($column === 'cha_news_badge') {
        $badge = get_post_meta($post_id, '_cha_news_badge', true);
        echo $badge ? esc_html($badge) : '—';
    }
    if ($column === 'cha_news_date') {
        $date = get_post_meta($post_id, '_cha_news_date', true);
        echo $date ? esc_html($date) : get_the_date('M j, Y', $post_id);
    }
}
add_action('manage_cha_news_posts_custom_column', 'cha_news_admin_column_data', 10, 2);

/* ===== CHA CAMPAIGNS CUSTOM POST TYPE ===== */

function cha_register_campaigns_cpt() {
    register_post_type('cha_campaigns', array(
        'labels' => array(
            'name'               => 'Campaigns',
            'singular_name'      => 'Campaign',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Campaign',
            'edit_item'          => 'Edit Campaign',
            'all_items'          => 'All Campaigns',
            'view_item'          => 'View Campaign',
            'search_items'       => 'Search Campaigns',
            'not_found'          => 'No campaigns found',
            'not_found_in_trash' => 'No campaigns found in Trash',
        ),
        'public'       => true,
        'show_ui'      => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'campaigns'),
        'menu_icon'    => 'dashicons-megaphone',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'cha_register_campaigns_cpt');

function cha_campaigns_meta_boxes() {
    add_meta_box('cha_campaigns_details', 'Campaign Details', 'cha_campaigns_details_cb', 'cha_campaigns', 'side', 'high');
}
add_action('add_meta_boxes', 'cha_campaigns_meta_boxes');

function cha_campaigns_details_cb($post) {
    wp_nonce_field('cha_campaigns_details', 'cha_campaigns_nonce');
    $raised = get_post_meta($post->ID, '_cha_campaign_raised', true);
    $goal = get_post_meta($post->ID, '_cha_campaign_goal', true);
    $color = get_post_meta($post->ID, '_cha_campaign_color', true);
    $icon = get_post_meta($post->ID, '_cha_campaign_icon', true);
    $title_km = get_post_meta($post->ID, '_cha_campaign_title_km', true);
    $desc_km = get_post_meta($post->ID, '_cha_campaign_desc_km', true);
    ?>
    <p><label for="cha_campaign_icon"><strong>Icon</strong></label>
    <select id="cha_campaign_icon" name="cha_campaign_icon" style="width:100%;margin-top:4px;">
        <option value="heart" <?php selected($icon, 'heart'); ?>>Heart</option>
        <option value="graduation" <?php selected($icon, 'graduation'); ?>>Graduation Cap</option>
        <option value="pulse" <?php selected($icon, 'pulse'); ?>>Pulse / Health</option>
        <option value="users" <?php selected($icon, 'users'); ?>>Users / People</option>
        <option value="star" <?php selected($icon, 'star'); ?>>Star</option>
        <option value="handshake" <?php selected($icon, 'handshake'); ?>>Handshake</option>
        <option value="globe" <?php selected($icon, 'globe'); ?>>Globe</option>
        <option value="shield" <?php selected($icon, 'shield'); ?>>Shield</option>
        <option value="lightbulb" <?php selected($icon, 'lightbulb'); ?>>Lightbulb</option>
        <option value="gift" <?php selected($icon, 'gift'); ?>>Gift</option>
    </select></p>
    <p><label for="cha_campaign_raised"><strong>Raised Amount ($)</strong></label>
    <input type="text" id="cha_campaign_raised" name="cha_campaign_raised" value="<?php echo esc_attr($raised); ?>" style="width:100%;margin-top:4px;" placeholder="4250"></p>
    <p><label for="cha_campaign_goal"><strong>Goal Amount ($)</strong></label>
    <input type="text" id="cha_campaign_goal" name="cha_campaign_goal" value="<?php echo esc_attr($goal); ?>" style="width:100%;margin-top:4px;" placeholder="15000"></p>
    <p><label for="cha_campaign_color"><strong>Theme Color</strong></label>
    <select id="cha_campaign_color" name="cha_campaign_color" style="width:100%;margin-top:4px;">
        <option value="red" <?php selected($color, 'red'); ?>>Red</option>
        <option value="blue" <?php selected($color, 'blue'); ?>>Blue</option>
        <option value="purple" <?php selected($color, 'purple'); ?>>Purple</option>
    </select></p>
    <hr style="margin:12px 0;">
    <p><label for="cha_campaign_title_km"><strong>Title (Khmer)</strong><br><small>Leave blank to auto-translate</small></label>
    <input type="text" id="cha_campaign_title_km" name="cha_campaign_title_km" value="<?php echo esc_attr($title_km); ?>" style="width:100%;margin-top:4px;" placeholder="ចំណងជើងភាសាខ្មែរ"></p>
    <p><label for="cha_campaign_desc_km"><strong>Description (Khmer)</strong><br><small>Leave blank to auto-translate</small></label>
    <textarea id="cha_campaign_desc_km" name="cha_campaign_desc_km" rows="3" style="width:100%;margin-top:4px;" placeholder="សេចក្តីផ្សាយភាសាខ្មែរ"><?php echo esc_textarea($desc_km); ?></textarea></p>
    <?php
}

function cha_save_campaigns_details($post_id) {
    if (!isset($_POST['cha_campaigns_nonce']) || !wp_verify_nonce($_POST['cha_campaigns_nonce'], 'cha_campaigns_details')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['cha_campaign_raised'])) update_post_meta($post_id, '_cha_campaign_raised', sanitize_text_field($_POST['cha_campaign_raised']));
    if (isset($_POST['cha_campaign_goal'])) update_post_meta($post_id, '_cha_campaign_goal', sanitize_text_field($_POST['cha_campaign_goal']));
    if (isset($_POST['cha_campaign_color'])) update_post_meta($post_id, '_cha_campaign_color', sanitize_text_field($_POST['cha_campaign_color']));
    if (isset($_POST['cha_campaign_icon'])) update_post_meta($post_id, '_cha_campaign_icon', sanitize_text_field($_POST['cha_campaign_icon']));
    if (isset($_POST['cha_campaign_title_km'])) update_post_meta($post_id, '_cha_campaign_title_km', sanitize_text_field($_POST['cha_campaign_title_km']));
    if (isset($_POST['cha_campaign_desc_km'])) update_post_meta($post_id, '_cha_campaign_desc_km', sanitize_textarea_field($_POST['cha_campaign_desc_km']));
}
add_action('save_post_cha_campaigns', 'cha_save_campaigns_details');

function cha_campaign_icon_svg($icon_name) {
    $icons = array(
        'heart'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>',
        'graduation' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>',
        'pulse'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>',
        'users'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'star'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
        'handshake'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 17l-2 2-4-4 4-4 2 2"/><path d="M18 7l-2-2-4 4 2 2 4-4z"/><path d="M7 17l-2 2"/><path d="M17 7l2-2"/><path d="M2 12h5"/><path d="M17 12h5"/></svg>',
        'globe'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
        'shield'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'lightbulb'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 0 1 8.91 14"/></svg>',
        'gift'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>',
    );
    return isset($icons[$icon_name]) ? $icons[$icon_name] : $icons['heart'];
}

function cha_campaigns_admin_columns($columns) {
    $new = array();
    foreach ($columns as $key => $val) {
        $new[$key] = $val;
        if ($key === 'title') {
            $new['cha_campaign_raised'] = 'Raised';
            $new['cha_campaign_goal'] = 'Goal';
            $new['cha_campaign_color'] = 'Color';
        }
    }
    return $new;
}
add_filter('manage_cha_campaigns_posts_columns', 'cha_campaigns_admin_columns');

function cha_campaigns_admin_column_data($column, $post_id) {
    if ($column === 'cha_campaign_raised') {
        $val = get_post_meta($post_id, '_cha_campaign_raised', true);
        echo $val ? '$' . esc_html(number_format((float)$val)) : '—';
    }
    if ($column === 'cha_campaign_goal') {
        $val = get_post_meta($post_id, '_cha_campaign_goal', true);
        echo $val ? '$' . esc_html(number_format((float)$val)) : '—';
    }
    if ($column === 'cha_campaign_color') {
        $val = get_post_meta($post_id, '_cha_campaign_color', true);
        echo $val ? esc_html(ucfirst($val)) : '—';
    }
}
add_action('manage_cha_campaigns_posts_custom_column', 'cha_campaigns_admin_column_data', 10, 2);

/* ===== CHA MEMBERSHIP BACKEND (Database) ===== */

function cha_get_members_table() {
    global $wpdb;
    return $wpdb->prefix . 'cha_members';
}

function cha_ensure_members_table() {
    global $wpdb;
    $table = cha_get_members_table();
    if ($wpdb->get_var("SHOW TABLES LIKE '$table'") !== $table) {
        cha_create_members_table();
    }
}

function cha_create_members_table() {
    global $wpdb;
    $table = cha_get_members_table();
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        member_id varchar(20) NOT NULL,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        password varchar(255) NOT NULL,
        province varchar(100) DEFAULT '',
        role varchar(50) DEFAULT '',
        member_since varchar(20) DEFAULT '',
        status varchar(20) DEFAULT 'active',
        registered datetime DEFAULT NULL,
        blood_type varchar(10) DEFAULT '',
        `condition` varchar(100) DEFAULT '',
        dob varchar(50) DEFAULT '',
        treatment_centre varchar(200) DEFAULT '',
        phone varchar(50) DEFAULT '',
        emergency_contact varchar(200) DEFAULT '',
        linked_patient varchar(200) DEFAULT '',
        relationship varchar(100) DEFAULT '',
        affiliation varchar(200) DEFAULT '',
        specialty varchar(200) DEFAULT '',
        license_number varchar(100) DEFAULT '',
        address varchar(300) DEFAULT '',
        verification_token varchar(64) DEFAULT NULL,
        reset_token varchar(64) DEFAULT NULL,
        reset_token_expiry datetime DEFAULT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY email (email),
        UNIQUE KEY member_id (member_id)
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

function cha_upgrade_members_table() {
    global $wpdb;
    $table = cha_get_members_table();
    if ($wpdb->get_var("SHOW TABLES LIKE '$table'") !== $table) return;
    $cols = $wpdb->get_col("SHOW COLUMNS FROM $table");
    if (!in_array('verification_token', $cols, true)) {
        $wpdb->query("ALTER TABLE $table ADD verification_token varchar(64) DEFAULT NULL");
    }
    if (!in_array('reset_token', $cols, true)) {
        $wpdb->query("ALTER TABLE $table ADD reset_token varchar(64) DEFAULT NULL");
    }
    if (!in_array('reset_token_expiry', $cols, true)) {
        $wpdb->query("ALTER TABLE $table ADD reset_token_expiry datetime DEFAULT NULL");
    }
    if (!in_array('app_token_hash', $cols, true)) {
        $wpdb->query("ALTER TABLE $table ADD app_token_hash varchar(255) DEFAULT NULL");
    }
    if (!in_array('photo', $cols, true)) {
        $wpdb->query("ALTER TABLE $table ADD photo varchar(500) DEFAULT ''");
    }
    if (!in_array('address', $cols, true)) {
        $wpdb->query("ALTER TABLE $table ADD address varchar(300) DEFAULT ''");
    }
    if (!in_array('name_khmer', $cols, true)) {
        $wpdb->query("ALTER TABLE $table ADD name_khmer varchar(200) DEFAULT ''");
    }
}

function cha_migrate_supporter_to_member() {
    if (get_option('cha_role_supporter_to_member')) return;
    global $wpdb;
    $table = cha_get_members_table();
    if ($wpdb->get_var("SHOW TABLES LIKE '$table'") !== $table) return;
    $wpdb->query("UPDATE $table SET role = 'Member' WHERE role = 'Supporter'");
    update_option('cha_role_supporter_to_member', true);
}

function cha_migrate_old_members() {
    if (get_option('cha_members_migrated')) return;
    $old = get_option('cha_members', array());
    if (empty($old)) {
        update_option('cha_members_migrated', true);
        return;
    }
    global $wpdb;
    $table = cha_get_members_table();
    foreach ($old as $m) {
        $wpdb->insert($table, array(
            'member_id'         => $m['memberId'] ?? '',
            'name'              => $m['name'] ?? '',
            'email'             => $m['email'] ?? '',
            'password'          => $m['password'] ?? '',
            'province'          => $m['province'] ?? '',
            'role'              => $m['role'] ?? '',
            'member_since'      => $m['memberSince'] ?? '',
            'status'            => $m['status'] ?? 'active',
            'registered'        => $m['registered'] ?? current_time('mysql'),
            'blood_type'        => $m['bloodType'] ?? '',
            'condition'         => $m['condition'] ?? '',
            'dob'               => $m['dob'] ?? '',
            'treatment_centre'  => $m['treatmentCentre'] ?? '',
            'phone'             => $m['phone'] ?? '',
            'emergency_contact' => $m['emergencyContact'] ?? '',
            'linked_patient'    => $m['linkedPatient'] ?? '',
            'relationship'      => $m['relationship'] ?? '',
            'affiliation'       => $m['affiliation'] ?? '',
            'specialty'         => $m['specialty'] ?? '',
            'license_number'    => $m['licenseNumber'] ?? '',
        ));
    }
    update_option('cha_members_migrated', true);
}

function cha_init_members_db() {
    cha_ensure_members_table();
    cha_upgrade_members_table();
    cha_migrate_supporter_to_member();
    cha_migrate_old_members();
}
add_action('admin_init', 'cha_init_members_db');

/* ---- Helpers ---- */

function cha_row_to_rest($row) {
    if (!$row) return null;
    return array(
        'memberId'          => $row->member_id,
        'name'              => $row->name,
        'email'             => $row->email,
        'province'          => $row->province,
        'role'              => $row->role,
        'memberSince'       => $row->member_since,
        'status'            => $row->status,
        'registered'        => $row->registered,
        'bloodType'         => $row->blood_type,
        'condition'         => $row->condition,
        'dob'               => $row->dob,
        'treatmentCentre'   => $row->treatment_centre,
        'phone'             => $row->phone,
        'emergencyContact'  => $row->emergency_contact,
        'linkedPatient'     => $row->linked_patient,
        'relationship'      => $row->relationship,
        'affiliation'       => $row->affiliation,
        'specialty'         => $row->specialty,
        'licenseNumber'     => $row->license_number,
        'photo'             => $row->photo ?? '',
        'address'           => $row->address ?? '',
        'nameKhmer'         => $row->name_khmer ?? '',
    );
}

function cha_rest_to_db($data) {
    $map = array(
        'memberId'         => 'member_id',
        'memberSince'      => 'member_since',
        'bloodType'        => 'blood_type',
        'treatmentCentre'  => 'treatment_centre',
        'emergencyContact' => 'emergency_contact',
        'linkedPatient'    => 'linked_patient',
        'licenseNumber'    => 'license_number',
        'nameKhmer'        => 'name_khmer',
    );
    $out = array();
    foreach ($data as $key => $val) {
        $col = isset($map[$key]) ? $map[$key] : $key;
        $out[$col] = $val;
    }
    return $out;
}

function cha_get_member_by_email($email) {
    global $wpdb;
    cha_ensure_members_table();
    return $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM " . cha_get_members_table() . " WHERE email = %s", $email
    ));
}

function cha_get_member_by_id($member_id) {
    global $wpdb;
    cha_ensure_members_table();
    return $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM " . cha_get_members_table() . " WHERE member_id = %s", $member_id
    ));
}

function cha_get_all_members() {
    global $wpdb;
    cha_ensure_members_table();
    return $wpdb->get_results("SELECT * FROM " . cha_get_members_table() . " ORDER BY registered DESC");
}

function cha_member_count() {
    global $wpdb;
    cha_ensure_members_table();
    return (int) $wpdb->get_var("SELECT COUNT(*) FROM " . cha_get_members_table());
}

function cha_get_members_page($page = 1, $per_page = 20, $role_filter = '', $status_filter = '') {
    global $wpdb;
    cha_ensure_members_table();
    $table = cha_get_members_table();
    $where_clauses = array();
    $valid_roles = array('Patient', 'Family member / Caregiver', 'Healthcare professional', 'Member');
    if ($role_filter && in_array($role_filter, $valid_roles)) {
        $where_clauses[] = $wpdb->prepare("role = %s", $role_filter);
    }
    $valid_statuses = array('pending', 'active');
    if ($status_filter && in_array($status_filter, $valid_statuses)) {
        $where_clauses[] = $wpdb->prepare("status = %s", $status_filter);
    }
    $where = !empty($where_clauses) ? " WHERE " . implode(" AND ", $where_clauses) : "";
    $offset = max(0, ($page - 1) * $per_page);
    $total = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table" . $where);
    $rows = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table" . $where . " ORDER BY registered DESC LIMIT %d OFFSET %d",
        $per_page, $offset
    ));
    return array('rows' => $rows, 'total' => $total, 'pages' => max(1, ceil($total / $per_page)));
}

function cha_generate_member_id() {
    global $wpdb;
    $table = cha_get_members_table();
    $year = date('Y');
    for ($attempt = 0; $attempt < 5; $attempt++) {
        $count = (int) $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table WHERE member_id LIKE %s", 'CHA-' . $year . '-%'
        ));
        $mid = 'CHA-' . $year . '-' . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE member_id = %s", $mid));
        if (!$exists) return $mid;
    }
    return 'CHA-' . $year . '-' . str_pad(abs(crc32(uniqid()) % 9999 + 1), 4, '0', STR_PAD_LEFT);
}

/* ---- Rate Limiting Helper (IP-based) ---- */

function cha_get_client_ip() {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $parts = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim($parts[0]);
    }
    return sanitize_text_field($ip);
}

function cha_check_ip_rate_limit($action, $max_attempts = 20, $window_seconds = 600) {
    $ip = cha_get_client_ip();
    $transient_key = 'cha_rl_' . md5($action . '_' . $ip);
    $attempts = (int) get_transient($transient_key);

    if ($attempts >= $max_attempts) {
        return new WP_Error(
            'rate_limited',
            'Too many attempts from your IP. Please wait 10 minutes before trying again.',
            array('status' => 429)
        );
    }

    if ($attempts === 0) {
        set_transient($transient_key, 1, $window_seconds);
    } else {
        // Increment attempts count
        set_transient($transient_key, $attempts + 1, $window_seconds);
    }

    return true;
}

/* ---- REST endpoints ---- */

function cha_rest_register($request) {
    $rl = cha_check_ip_rate_limit('register', 20, 600);
    if (is_wp_error($rl)) return $rl;

    $params = $request->get_json_params();
    $email    = sanitize_email($params['email'] ?? '');
    $password = $params['password'] ?? '';
    $phone    = sanitize_text_field($params['phone'] ?? '');
    $name     = sanitize_text_field($params['name'] ?? '');
    $role     = sanitize_text_field($params['role'] ?? 'Member');
    $dob      = sanitize_text_field($params['dob'] ?? '');
    $condition = sanitize_text_field($params['condition'] ?? '');
    $blood_type = sanitize_text_field($params['bloodType'] ?? '');
    $address   = sanitize_text_field($params['address'] ?? '');

    if (empty($email) || empty($password)) {
        return new WP_Error('missing_fields', 'Email and password are required.', array('status' => 400));
    }

    if (!is_email($email)) {
        return new WP_Error('invalid_email', 'Please provide a valid email address.', array('status' => 400));
    }

    $email_domain = strtolower(substr(strrchr($email, '@'), 1));
    $allowed_domains = array('gmail.com','yahoo.com','outlook.com','hotmail.com','live.com','icloud.com','aol.com','protonmail.com','proton.me','mail.com','com.kh');
    if (!in_array($email_domain, $allowed_domains, true)) {
        return new WP_Error('invalid_email_domain', 'Please use a valid email address (gmail.com, yahoo.com, outlook.com, etc.).', array('status' => 400));
    }

    global $wpdb;
    $table = cha_get_members_table();
    cha_ensure_members_table();

    if ($wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE email = %s", $email))) {
        return new WP_Error('email_exists', 'An account with this email already exists.', array('status' => 409));
    }

    if (empty($name)) $name = explode('@', $email)[0];
    $member_id = cha_generate_member_id();
    $now = current_time('mysql');
    $token = wp_generate_password(32, false);
    $valid_roles = array('Member', 'Patient', 'Family member / Caregiver', 'Healthcare professional');
    if (!in_array($role, $valid_roles, true)) $role = 'Member';

    $insert_data = array(
        'member_id'          => $member_id,
        'name'               => $name,
        'email'              => $email,
        'password'           => wp_hash_password($password),
        'phone'              => $phone,
        'role'               => $role,
        'member_since'       => date('F Y'),
        'status'             => 'pending',
        'verification_token' => $token,
        'registered'         => $now,
        'address'            => $address,
    );
    if ($dob) $insert_data['dob'] = $dob;
    if ($condition) $insert_data['condition'] = $condition;
    if ($blood_type) $insert_data['blood_type'] = $blood_type;

    $inserted = $wpdb->insert($table, $insert_data);

    if (!$inserted) {
        return new WP_Error('insert_failed', 'Could not register. Please try again.', array('status' => 500));
    }

    cha_send_verification_email($email, $name, $token);
    cha_notify_admin_new_registration($name, $email, $phone, $member_id, $now);

    return rest_ensure_response(array(
        'success'  => true,
        'message'  => 'Registration received. Please check your email to verify your account before logging in.',
        'verified' => false,
    ));
}

function cha_rest_login($request) {
    $rl = cha_check_ip_rate_limit('login', 20, 600);
    if (is_wp_error($rl)) return $rl;

    $params = $request->get_json_params();
    $email    = sanitize_email($params['email'] ?? '');
    $password = $params['password'] ?? '';

    if (empty($email) || empty($password)) {
        return new WP_Error('missing_fields', 'Email and password are required.', array('status' => 400));
    }

    $row = cha_get_member_by_email($email);
    if ($row && wp_check_password($password, $row->password)) {
        if ($row->status === 'pending') {
            return new WP_Error('not_verified', 'Please verify your email address before logging in. Check your inbox for the verification link.', array('status' => 403));
        }
        $rest = cha_row_to_rest($row);
        $rest['token'] = cha_issue_app_token($row);
        return rest_ensure_response($rest);
    }

    return new WP_Error('invalid_credentials', 'Invalid email or password.', array('status' => 401));
}

/* ---- App auth tokens ---- */

function cha_issue_app_token($row) {
    global $wpdb;
    $table = cha_get_members_table();
    $token = bin2hex(random_bytes(32));
    $wpdb->update($table, array('app_token_hash' => wp_hash_password($token)), array('id' => $row->id));
    return $token;
}

function cha_revoke_app_token($row) {
    global $wpdb;
    $table = cha_get_members_table();
    $wpdb->update($table, array('app_token_hash' => null), array('id' => $row->id));
}

function cha_get_member_by_app_token($token) {
    if (empty($token)) return null;
    global $wpdb;
    $rows = $wpdb->get_results("SELECT * FROM " . cha_get_members_table() . " WHERE app_token_hash IS NOT NULL");
    foreach ($rows as $row) {
        if ($row->app_token_hash && wp_check_password($token, $row->app_token_hash)) {
            return $row;
        }
    }
    return null;
}

function cha_app_token_from_request($request) {
    $token = $request->get_header('X-CHA-Token');
    return $token ? cha_get_member_by_app_token($token) : null;
}

function cha_require_member_token($request) {
    $row = cha_app_token_from_request($request);
    if ($row) return true;
    $nonce = $request->get_header('X-WP-Nonce');
    if ($nonce && wp_verify_nonce($nonce, 'wp_rest')) return true;
    return new WP_Error('forbidden', 'Unauthorized. Login required.', array('status' => 401));
}

function cha_rest_logout($request) {
    $row = cha_app_token_from_request($request);
    if ($row) cha_revoke_app_token($row);
    return rest_ensure_response(array('success' => true));
}

/* ---- SMTP (Brevo) ---- */

function cha_get_smtp_settings() {
    $defaults = array(
        'host'      => 'smtp-relay.brevo.com',
        'port'      => 587,
        'username'  => get_option('admin_email'),
        'password'  => '',
        'from_email'=> get_option('admin_email'),
        'from_name' => get_bloginfo('name'),
        'enabled'   => false,
        'admin_notify_enabled' => true,
        'admin_notify_email'   => '',
    );
    $saved = get_option('cha_smtp_settings', array());
    return wp_parse_args($saved, $defaults);
}

function cha_init_smtp_settings() {
    $smtp = get_option('cha_smtp_settings', array());
    if (empty($smtp)) {
        $smtp = array(
            'host'      => 'smtp-relay.brevo.com',
            'port'      => 587,
            'username'  => '',
            'password'  => '',
            'from_name' => 'CHA Cambodia',
            'from_email'=> '',
            'enabled'   => false,
            'admin_notify_enabled' => true,
            'admin_notify_email'   => '',
        );
        update_option('cha_smtp_settings', $smtp);
    }
}
add_action('admin_init', 'cha_init_smtp_settings');

add_action('phpmailer_init', function($phpmailer) {
    $s = cha_get_smtp_settings();
    if (empty($s['password']) || !$s['enabled']) return;
    $phpmailer->isSMTP();
    $phpmailer->Host       = $s['host'];
    $phpmailer->Port       = (int) $s['port'];
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Username   = $s['username'];
    $phpmailer->Password   = $s['password'];
    $phpmailer->SMTPDebug  = 2;
    $phpmailer->Debugoutput = function($str, $level) {
        $log = "\n[" . date('Y-m-d H:i:s') . "] SMTP $level: $str";
        error_log($log, 3, WP_CONTENT_DIR . '/cha-smtp-debug.log');
    };
    if ($s['from_email']) {
        $phpmailer->setFrom($s['from_email'], $s['from_name']);
    }
});

add_action('wp_mail_failed', function($error) {
    $log = "\n[" . date('Y-m-d H:i:s') . "] MAIL FAILED: " . $error->get_error_message() . " | " . implode('; ', $error->get_error_data());
    error_log($log, 3, WP_CONTENT_DIR . '/cha-smtp-debug.log');
}, 10, 1);

add_action('wp_mail_succeeded', function($result) {
    $log = "\n[" . date('Y-m-d H:i:s') . "] MAIL SUCCEEDED to: " . implode(', ', $result['to']);
    error_log($log, 3, WP_CONTENT_DIR . '/cha-smtp-debug.log');
});

add_action('rest_api_init', function() {
    register_rest_route('cha/v1', '/smtp-settings', array(
        'methods'  => 'POST',
        'callback' => 'cha_save_smtp_settings',
        'permission_callback' => function() { return current_user_can('manage_options'); },
    ));
    register_rest_route('cha/v1', '/smtp-test', array(
        'methods'  => 'POST',
        'callback' => 'cha_test_smtp',
        'permission_callback' => function() { return current_user_can('manage_options'); },
    ));
});

function cha_save_smtp_settings($request) {
    $params = $request->get_json_params();
    $settings = cha_get_smtp_settings();
    if (isset($params['host']))      $settings['host']      = sanitize_text_field($params['host']);
    if (isset($params['port']))      $settings['port']      = intval($params['port']);
    if (isset($params['username']))  $settings['username']  = sanitize_text_field($params['username']);
    if (isset($params['password']))  $settings['password']  = sanitize_text_field($params['password']);
    if (isset($params['from_email'])) $settings['from_email'] = sanitize_email($params['from_email']);
    if (isset($params['from_name']))  $settings['from_name']  = sanitize_text_field($params['from_name']);
    if (isset($params['enabled']))   $settings['enabled']   = (bool) $params['enabled'];
    update_option('cha_smtp_settings', $settings);
    return rest_ensure_response(array('success' => true, 'message' => 'SMTP settings saved.'));
}

function cha_test_smtp($request) {
    $s = cha_get_smtp_settings();
    if (empty($s['password']) || !$s['enabled']) {
        return new WP_Error('smtp_not_configured', 'SMTP is not enabled or password is missing.', array('status' => 400));
    }
    $to = $request->get_json_params()['email'] ?? $s['from_email'];
    $sent = wp_mail($to, 'CHA SMTP Test', 'This is a test email from CHA Cambodia. If you received this, SMTP is working correctly.');
    if ($sent) {
        return rest_ensure_response(array('success' => true, 'message' => 'Test email sent to ' . $to));
    }
    return new WP_Error('send_failed', 'Failed to send test email. Check your SMTP settings.', array('status' => 500));
}

/* ---- PayWay (ABA) donations ---- */

function cha_get_payway_settings() {
    $defaults = array(
        'sandbox_merchant_id'  => '',
        'sandbox_api_key'      => '',
        'production_merchant_id' => '',
        'production_api_key'   => '',
        'mode'                 => 'sandbox',
        'enabled'              => false,
    );
    $saved = get_option('cha_payway_settings', array());

    // Backward compat: migrate old single merchant_id/api_key to sandbox set
    if (!empty($saved['merchant_id']) && empty($saved['sandbox_merchant_id'])) {
        $saved['sandbox_merchant_id'] = $saved['merchant_id'];
        unset($saved['merchant_id']);
    }
    if (!empty($saved['api_key']) && empty($saved['sandbox_api_key'])) {
        $saved['sandbox_api_key'] = $saved['api_key'];
        unset($saved['api_key']);
    }

    $settings = wp_parse_args($saved, $defaults);

    // Return active credentials based on mode
    $settings['merchant_id'] = $settings[$settings['mode'] . '_merchant_id'] ?? '';
    $settings['api_key']     = $settings[$settings['mode'] . '_api_key'] ?? '';

    return $settings;
}

function cha_init_payway_settings() {
    if (get_option('cha_payway_settings') === false) {
        update_option('cha_payway_settings', array(
            'sandbox_merchant_id'    => '',
            'sandbox_api_key'        => '',
            'production_merchant_id' => '',
            'production_api_key'     => '',
            'mode'                   => 'sandbox',
            'enabled'                => false,
        ));
    }
    cha_ensure_donations_table();
}
add_action('admin_init', 'cha_init_payway_settings');

function cha_get_donations_table() {
    global $wpdb;
    return $wpdb->prefix . 'cha_donations';
}

function cha_create_donations_table() {
    global $wpdb;
    $table = cha_get_donations_table();
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        tran_id varchar(40) NOT NULL,
        member_id varchar(20) DEFAULT '',
        name varchar(120) DEFAULT '',
        email varchar(100) DEFAULT '',
        phone varchar(50) DEFAULT '',
        amount decimal(12,2) NOT NULL DEFAULT 0,
        currency varchar(10) DEFAULT 'USD',
        method varchar(30) DEFAULT '',
        status varchar(20) DEFAULT 'pending',
        apv varchar(20) DEFAULT '',
        return_params varchar(500) DEFAULT '',
        created_at datetime DEFAULT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY tran_id (tran_id)
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

function cha_ensure_donations_table() {
    global $wpdb;
    $table = cha_get_donations_table();
    if ($wpdb->get_var("SHOW TABLES LIKE '$table'") !== $table) {
        cha_create_donations_table();
    }
}

function cha_payway_base_url($mode) {
    return $mode === 'production'
        ? 'https://checkout.payway.com.kh'
        : 'https://checkout-sandbox.payway.com.kh';
}

function cha_payway_hash($data, $key) {
    return base64_encode(hash_hmac('sha512', $data, $key, true));
}

function cha_rest_payway_purchase($request) {
    $s = cha_get_payway_settings();
    if (empty($s['merchant_id']) || empty($s['api_key'])) {
        return new WP_Error('payway_not_configured', 'PayWay is not configured yet.', array('status' => 400));
    }

    $params = $request->get_json_params();
    $amount = floatval($params['amount'] ?? 0);
    if ($amount <= 0) {
        return new WP_Error('invalid_amount', 'A valid donation amount is required.', array('status' => 400));
    }
    $currency = strtoupper(sanitize_text_field($params['currency'] ?? 'USD'));
    if (!in_array($currency, array('USD', 'KHR'), true)) $currency = 'USD';

    global $wpdb;
    cha_ensure_donations_table();
    $table = cha_get_donations_table();

    $firstname = sanitize_text_field($params['firstname'] ?? '');
    $lastname  = sanitize_text_field($params['lastname'] ?? '');
    $email     = sanitize_email($params['email'] ?? '');
    $phone     = sanitize_text_field($params['phone'] ?? '');
    if (!$firstname) $firstname = $email ? explode('@', $email)[0] : 'Friend';

    do {
        $tran_id = 'CHA-' . date('ym') . '-' . str_pad((string) mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE tran_id = %s", $tran_id));
    } while ($exists);

    $req_time = gmdate('YmdHis');
    $return_url = base64_encode(rest_url('cha/v1/payway/callback'));
    $continue_success_url = home_url('/donation-thank-you?tran_id=' . rawurlencode($tran_id));
    $cancel_url = home_url('/donation-cancelled');
    $items = base64_encode(wp_json_encode(array(array('name' => 'Donation to CHA Cambodia', 'quantity' => 1, 'price' => $amount))));
    $return_params = wp_json_encode(array('tran_id' => $tran_id));

    $fields = array(
        'req_time'             => $req_time,
        'merchant_id'          => $s['merchant_id'],
        'tran_id'              => $tran_id,
        'amount'               => $currency === 'KHR' ? number_format($amount, 0, '.', '') : number_format($amount, 2, '.', ''),
        'items'                => $items,
        'shipping'             => '0',
        'firstname'            => $firstname,
        'lastname'             => $lastname,
        'email'                => $email,
        'phone'                => $phone,
        'type'                 => 'purchase',
        'payment_option'       => 'abapay_khqr',
        'return_url'           => $return_url,
        'cancel_url'           => $cancel_url,
        'continue_success_url' => $continue_success_url,
        'return_deeplink'      => '',
        'currency'             => $currency,
        'custom_fields'        => '',
        'return_params'        => $return_params,
        'payout'               => '',
        'lifetime'             => 43200,
        'additional_params'    => '',
        'google_pay_token'     => '',
        'skip_success_page'    => '1',
        'view_type'            => 'hosted_view',
        'payment_gate'         => 0,
    );

    $order = array(
        'req_time', 'merchant_id', 'tran_id', 'amount', 'items', 'shipping', 'firstname', 'lastname', 'email', 'phone',
        'type', 'payment_option', 'return_url', 'cancel_url', 'continue_success_url', 'return_deeplink', 'currency',
        'custom_fields', 'return_params', 'payout', 'lifetime', 'additional_params', 'google_pay_token', 'skip_success_page',
    );
    $b4hash = '';
    foreach ($order as $k) $b4hash .= (string) ($fields[$k] ?? '');
    $fields['hash'] = cha_payway_hash($b4hash, $s['api_key']);

    $post_fields = array('hash' => $fields['hash']);
    foreach ($order as $k) {
        if ($fields[$k] !== '') $post_fields[$k] = $fields[$k];
    }
    if (!empty($fields['view_type'])) $post_fields['view_type'] = $fields['view_type'];
    if (isset($fields['payment_gate'])) $post_fields['payment_gate'] = $fields['payment_gate'];

    $wpdb->insert($table, array(
        'tran_id'       => $tran_id,
        'member_id'     => '',
        'name'          => trim($firstname . ' ' . $lastname),
        'email'         => $email,
        'phone'         => $phone,
        'amount'        => $amount,
        'currency'      => $currency,
        'status'        => 'pending',
        'return_params' => $return_params,
        'created_at'    => current_time('mysql'),
    ));

    return rest_ensure_response(array(
        'success'      => true,
        'tran_id'      => $tran_id,
        'checkout_url' => cha_payway_base_url($s['mode']) . '/api/payment-gateway/v1/payments/purchase',
        'fields'       => $post_fields,
    ));
}

function cha_rest_payway_callback($request) {
    $s = cha_get_payway_settings();
    $body = $request->get_body();
    $data = json_decode($body, true);
    if (!is_array($data)) {
        return rest_ensure_response(array('success' => false));
    }

    $received = $request->get_header('x-payway-hmac-sha512');
    if ($received && !empty($s['api_key'])) {
        ksort($data);
        $b4hash = '';
        foreach ($data as $value) {
            if (is_array($value)) $value = wp_json_encode($value);
            $b4hash .= (string) $value;
        }
        $signature = cha_payway_hash($b4hash, $s['api_key']);
        if (!hash_equals($signature, $received)) {
            return new WP_Error('bad_signature', 'Invalid signature.', array('status' => 401));
        }
    }

    $tran_id = sanitize_text_field($data['tran_id'] ?? '');
    $apv     = sanitize_text_field($data['apv'] ?? '');
    $status  = sanitize_text_field($data['status'] ?? '');
    $return_params = isset($data['return_params']) ? sanitize_text_field($data['return_params']) : '';

    if ($tran_id) {
        global $wpdb;
        $table = cha_get_donations_table();
        $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE tran_id = %s", $tran_id));
        if ($row) {
            $new_status = $status === '0' ? 'completed' : 'failed';
            $wpdb->update($table, array(
                'status'        => $new_status,
                'apv'           => $apv,
                'return_params' => $return_params,
            ), array('id' => $row->id));
        }
    }
    return rest_ensure_response(array('success' => true));
}

function cha_payway_check_transaction($tran_id) {
    $s = cha_get_payway_settings();
    if (empty($s['merchant_id']) || empty($s['api_key'])) return null;
    $req_time = gmdate('YmdHis');
    $b4hash = $req_time . $s['merchant_id'] . $tran_id;
    $hash = cha_payway_hash($b4hash, $s['api_key']);

    $resp = wp_remote_post(cha_payway_base_url($s['mode']) . '/api/payment-gateway/v1/payments/check-transaction-2', array(
        'headers' => array('Content-Type' => 'application/json'),
        'body'    => wp_json_encode(array(
            'req_time'    => $req_time,
            'merchant_id' => $s['merchant_id'],
            'tran_id'     => $tran_id,
            'hash'        => $hash,
        )),
        'timeout' => 15,
    ));
    if (is_wp_error($resp)) return null;
    $data = json_decode(wp_remote_retrieve_body($resp), true);
    return is_array($data) ? $data : null;
}

function cha_rest_payway_check($request) {
    $params = $request->get_json_params();
    $tran_id = sanitize_text_field($params['tran_id'] ?? '');
    if (!$tran_id) {
        return new WP_Error('missing_tran_id', 'Transaction ID is required.', array('status' => 400));
    }
    $data = cha_payway_check_transaction($tran_id);
    if ($data === null) {
        return new WP_Error('check_failed', 'Could not reach PayWay. Please try again.', array('status' => 502));
    }
    if (isset($data['data']['payment_status_code'])) {
        global $wpdb;
        $table = cha_get_donations_table();
        $code = (int) $data['data']['payment_status_code'];
        $map = array(0 => 'completed', 2 => 'pending', 3 => 'failed', 4 => 'refunded', 7 => 'cancelled');
        $new_status = isset($map[$code]) ? $map[$code] : 'pending';
        $wpdb->update($table, array(
            'status' => $new_status,
            'apv'    => sanitize_text_field($data['data']['apv'] ?? ''),
        ), array('tran_id' => $tran_id));
        $data['local_status'] = $new_status;
    }
    return rest_ensure_response($data);
}

function cha_rest_payway_get_settings() {
    return rest_ensure_response(cha_get_payway_settings());
}

function cha_rest_payway_save_settings($request) {
    $params = $request->get_json_params();
    $s = cha_get_payway_settings();
    if (isset($params['merchant_id'])) $s['merchant_id'] = sanitize_text_field($params['merchant_id']);
    if (isset($params['api_key']))     $s['api_key']     = sanitize_text_field($params['api_key']);
    if (isset($params['mode']) && in_array($params['mode'], array('sandbox', 'production'), true)) $s['mode'] = $params['mode'];
    if (isset($params['enabled']))     $s['enabled']     = (bool) $params['enabled'];
    update_option('cha_payway_settings', $s);
    return rest_ensure_response(array('success' => true, 'message' => 'PayWay settings saved.'));
}

function cha_rest_payway_test_hash($request) {
    $s = cha_get_payway_settings();
    if (empty($s['api_key'])) {
        return new WP_Error('not_configured', 'No API key saved yet.', array('status' => 400));
    }
    return rest_ensure_response(array(
        'success'     => true,
        'sample_hash' => cha_payway_hash('test', $s['api_key']),
    ));
}

add_action('template_redirect', function() {
    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    if ($uri === 'donation-thank-you' || $uri === 'donation-cancelled') {
        cha_render_donation_result($uri);
        exit;
    }
});

function cha_render_donation_result($slug) {
    $is_success = $slug === 'donation-thank-you';
    $tran_id = sanitize_text_field($_GET['tran_id'] ?? '');
    $status = '';
    $amount = '';

    if ($tran_id) {
        global $wpdb;
        cha_ensure_donations_table();
        $table = cha_get_donations_table();
        $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE tran_id = %s", $tran_id));
        if ($row) {
            if ($row->status === 'pending') {
                $check = cha_payway_check_transaction($tran_id);
                if ($check && isset($check['data']['payment_status_code']) && (int) $check['data']['payment_status_code'] === 0) {
                    $wpdb->update($table, array('status' => 'completed'), array('id' => $row->id));
                    $row->status = 'completed';
                }
            }
            $status = $row->status;
            $amount = $row->amount;
        }
    }

    $confirmed = $is_success && $status === 'completed';
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $confirmed ? 'Thank You — CHA Cambodia' : 'Donation — CHA Cambodia'; ?></title>
        <style>
            body { margin:0; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif; background:#F4F6FB; display:flex; align-items:center; justify-content:center; min-height:100vh; padding:24px; box-sizing:border-box; }
            .card { background:#fff; border-radius:20px; padding:48px 40px; max-width:440px; width:100%; text-align:center; box-shadow:0 20px 60px rgba(11,29,109,0.12); }
            .icon { width:76px; height:76px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 22px; }
            .icon svg { width:38px; height:38px; }
            .ok { background:#ECFDF5; color:#16A34A; }
            .warn { background:#FEF3C7; color:#D97706; }
            h1 { font-size:1.5rem; font-weight:800; color:#0B1D6D; margin:0 0 8px; }
            p { font-size:0.9375rem; color:#6B7280; line-height:1.6; margin:0 0 22px; }
            .tran { background:#F4F6FB; border-radius:12px; padding:14px 18px; font-size:0.8125rem; color:#374151; margin-bottom:24px; }
            .tran strong { color:#0B1D6D; }
            a.btn { display:inline-block; background:#0B1D6D; color:#fff; text-decoration:none; font-weight:700; font-size:0.9375rem; padding:14px 32px; border-radius:12px; }
        </style>
    </head>
    <body>
        <div class="card">
            <div class="icon <?php echo $confirmed ? 'ok' : 'warn'; ?>">
                <?php if ($confirmed): ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                <?php else: ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <?php endif; ?>
            </div>
            <h1><?php echo $confirmed ? 'Thank You for Your Gift!' : 'Donation Not Completed'; ?></h1>
            <p><?php echo $confirmed
                ? 'Your generous support helps Cambodian Haemophilia Association provide treatment, education and hope. A confirmation email may follow.'
                : 'Your donation was not completed. No payment was taken. You can try again any time.'; ?></p>
            <?php if ($confirmed && $amount): ?>
                <div class="tran">Amount: <strong>$<?php echo esc_html(number_format((float) $amount, 2)); ?></strong> &middot; Receipt: <strong><?php echo esc_html($tran_id); ?></strong></div>
            <?php elseif ($tran_id): ?>
                <div class="tran">Reference: <strong><?php echo esc_html($tran_id); ?></strong></div>
            <?php endif; ?>
            <a class="btn" href="<?php echo esc_url(home_url('/')); ?>">Back to Home</a>
        </div>
    </body>
    </html>
    <?php
}

/* ---- Email verification ---- */

function cha_verification_url($token) {
    return home_url('/verify?token=' . rawurlencode($token));
}

function cha_send_verification_email($email, $name, $token) {
    $name  = $name ?: 'Member';
    $link  = cha_verification_url($token);
    $site  = get_bloginfo('name') ?: 'CHA Cambodia';
    $smtp  = cha_get_smtp_settings();
    $from  = apply_filters('cha_verification_from_email', $smtp['from_email'] ?: 'noreply@chacambodia.org');
    $from_name = apply_filters('cha_verification_from_name', $smtp['from_name'] ?: $site);

    $subject = 'Verify your ' . $site . ' account';
    $message = "Hi $name,\n\n"
             . "Thanks for registering with $site.\n\n"
             . "Please confirm your email address by clicking the link below:\n\n"
             . $link . "\n\n"
             . "If you did not create this account, you can safely ignore this email.\n\n"
             . "Regards,\n$site Team";

    $headers = array('Content-Type: text/plain; charset=UTF-8');
    if ($from && $from_name) {
        $headers[] = 'From: ' . $from_name . ' <' . $from . '>';
    }

    wp_mail($email, $subject, $message, $headers);
}

function cha_notify_admin_new_registration($name, $email, $phone, $member_id, $registered) {
    $smtp = cha_get_smtp_settings();
    if (empty($smtp['admin_notify_enabled'])) return;

    $to = !empty($smtp['admin_notify_email']) ? $smtp['admin_notify_email'] : get_option('admin_email');
    $site = get_bloginfo('name') ?: 'CHA Cambodia';
    $admin_url = admin_url('admin.php?page=cha-members');

    $subject = 'New Member Registration — ' . $site;
    $message = "A new member has registered on the $site website.\n\n"
             . "  Name:           $name\n"
             . "  Email:          $email\n"
             . "  Phone:          $phone\n"
             . "  Member ID:      $member_id\n"
             . "  Registered:     $registered\n\n"
             . "  View all members: $admin_url\n\n"
             . "This is an automated notification.";

    $headers = array('Content-Type: text/plain; charset=UTF-8');
    $from = $smtp['from_email'] ?: get_option('admin_email');
    $from_name = $smtp['from_name'] ?: $site;
    $headers[] = 'From: ' . $from_name . ' <' . $from . '>';

    wp_mail($to, $subject, $message, $headers);
}

function cha_rest_verify($request) {
    $token = sanitize_text_field($request->get_param('token') ?? '');
    if (empty($token)) {
        return rest_ensure_response(array('success' => false, 'message' => 'Missing verification token.'));
    }
    global $wpdb;
    $table = cha_get_members_table();
    $row = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table WHERE verification_token = %s", $token
    ));
    if (!$row) {
        return rest_ensure_response(array('success' => false, 'message' => 'Invalid or expired verification link.'));
    }
    $wpdb->update($table, array('status' => 'active', 'verification_token' => null), array('id' => $row->id));
    return rest_ensure_response(array(
        'success' => true,
        'message' => 'Your email has been verified. You can now log in.',
    ));
}

function cha_rest_resend_verification($request) {
    $rl = cha_check_ip_rate_limit('resend_verification', 20, 600);
    if (is_wp_error($rl)) return $rl;

    $params = $request->get_json_params();
    $email  = sanitize_email($params['email'] ?? '');
    if (empty($email)) {
        return new WP_Error('missing_email', 'Email is required.', array('status' => 400));
    }
    global $wpdb;
    $table = cha_get_members_table();
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE email = %s", $email));
    if (!$row) {
        return new WP_Error('not_found', 'No account found with this email.', array('status' => 404));
    }
    if ($row->status === 'active') {
        return rest_ensure_response(array('success' => true, 'message' => 'Your account is already verified. You can log in.'));
    }
    $token = wp_generate_password(32, false);
    $wpdb->update($table, array('verification_token' => $token), array('id' => $row->id));
    cha_send_verification_email($row->email, $row->name, $token);
    return rest_ensure_response(array('success' => true, 'message' => 'Verification email sent. Please check your inbox.'));
}

function cha_rest_get_members($request) {
    if (!current_user_can('manage_options')) {
        return new WP_Error('forbidden', 'Unauthorized.', array('status' => 403));
    }
    $rows = cha_get_all_members();
    $out = array();
    foreach ($rows as $row) {
        $out[] = cha_row_to_rest($row);
    }
    return rest_ensure_response($out);
}

function cha_reset_password_url($token) {
    return home_url('/reset-password?token=' . rawurlencode($token));
}

function cha_send_reset_email($email, $name, $token) {
    $name  = $name ?: 'Member';
    $link  = cha_reset_password_url($token);
    $site  = get_bloginfo('name') ?: 'CHA Cambodia';
    $smtp  = cha_get_smtp_settings();
    $from  = apply_filters('cha_reset_from_email', $smtp['from_email'] ?: 'noreply@chacambodia.org');
    $from_name = apply_filters('cha_reset_from_name', $smtp['from_name'] ?: $site);

    $subject = 'Reset your ' . $site . ' password';
    $message = "Hi $name,\n\n"
             . "We received a request to reset the password for your $site account.\n\n"
             . "Click the link below to choose a new password (valid for 1 hour):\n\n"
             . $link . "\n\n"
             . "If you did not request this, you can safely ignore this email — your password will not be changed.\n\n"
             . "Regards,\n$site Team";

    $headers = array('Content-Type: text/plain; charset=UTF-8');
    if ($from && $from_name) {
        $headers[] = 'From: ' . $from_name . ' <' . $from . '>';
    }

    wp_mail($email, $subject, $message, $headers);
}

function cha_rest_forgot_password($request) {
    $rl = cha_check_ip_rate_limit('forgot_password', 20, 600);
    if (is_wp_error($rl)) return $rl;

    $params = $request->get_json_params();
    $email  = sanitize_email($params['email'] ?? '');
    if (empty($email) || !is_email($email)) {
        return rest_ensure_response(array(
            'success' => true,
            'message' => 'If an account exists for that email, a reset link has been sent.',
        ));
    }

    global $wpdb;
    $table = cha_get_members_table();
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE email = %s", $email));
    if (!$row) {
        return rest_ensure_response(array(
            'success' => true,
            'message' => 'If an account exists for that email, a reset link has been sent.',
        ));
    }

    // Rate limit: refuse if a reset token was issued within the last 10 minutes
    $now_ts = current_time('timestamp');
    $recently = $wpdb->get_var($wpdb->prepare(
        "SELECT reset_token_expiry FROM $table WHERE email = %s AND reset_token IS NOT NULL AND reset_token_expiry IS NOT NULL",
        $email
    ));
    if ($recently) {
        $issued_ts = strtotime($recently) - HOUR_IN_SECONDS;
        if ($issued_ts > $now_ts - 10 * MINUTE_IN_SECONDS) {
            return new WP_Error('rate_limited', 'A reset link was recently sent. Please check your inbox or try again in a few minutes.', array('status' => 429));
        }
    }

    $token = wp_generate_password(32, false);
    $expiry = date('Y-m-d H:i:s', current_time('timestamp') + HOUR_IN_SECONDS);
    $wpdb->update($table, array(
        'reset_token'        => $token,
        'reset_token_expiry' => $expiry,
    ), array('id' => $row->id));

    cha_send_reset_email($row->email, $row->name, $token);

    return rest_ensure_response(array(
        'success' => true,
        'message' => 'If an account exists for that email, a reset link has been sent.',
    ));
}

function cha_rest_reset_password_with_token($request) {
    $params = $request->get_json_params();
    $token  = sanitize_text_field($params['token'] ?? '');
    $new_password = $params['new_password'] ?? '';
    if (empty($token)) {
        return new WP_Error('missing_token', 'Reset token is required.', array('status' => 400));
    }
    if (strlen($new_password) < 6) {
        return new WP_Error('weak_password', 'New password must be at least 6 characters.', array('status' => 400));
    }

    global $wpdb;
    $table = cha_get_members_table();
    $row = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table WHERE reset_token = %s AND reset_token_expiry > %s",
        $token,
        date('Y-m-d H:i:s', current_time('timestamp'))
    ));
    if (!$row) {
        return new WP_Error('invalid_token', 'This reset link is invalid or has expired. Please request a new one.', array('status' => 400));
    }

    $wpdb->update($table, array(
        'password'           => wp_hash_password($new_password),
        'reset_token'        => null,
        'reset_token_expiry' => null,
        'status'             => 'active',
    ), array('id' => $row->id));

    return rest_ensure_response(array(
        'success' => true,
        'message' => 'Your password has been reset. You can now log in with your new password.',
    ));
}

function cha_rest_update_member($request) {
    if (!current_user_can('manage_options')) {
        return new WP_Error('forbidden', 'Unauthorized.', array('status' => 403));
    }
    $id = $request->get_param('id');
    $params = $request->get_json_params();
    global $wpdb;
    $table = cha_get_members_table();

    $data = array();
    if (isset($params['name']))     $data['name']     = sanitize_text_field($params['name']);
    if (isset($params['email']))    $data['email']    = sanitize_email($params['email']);
    if (isset($params['province'])) $data['province'] = sanitize_text_field($params['province']);
    if (isset($params['role']))     $data['role']     = sanitize_text_field($params['role']);
    if (isset($params['status']))   $data['status']   = sanitize_text_field($params['status']);
    if (isset($params['address']))  $data['address']  = sanitize_text_field($params['address']);

    if (empty($data)) return new WP_Error('no_data', 'No fields to update.', array('status' => 400));

    $updated = $wpdb->update($table, $data, array('member_id' => $id));
    if ($updated === false) return new WP_Error('not_found', 'Member not found.', array('status' => 404));

    $row = cha_get_member_by_id($id);
    return rest_ensure_response(cha_row_to_rest($row));
}

function cha_rest_reset_password($request) {
    if (!current_user_can('manage_options')) {
        return new WP_Error('forbidden', 'Unauthorized.', array('status' => 403));
    }
    $id = $request->get_param('id');
    $params = $request->get_json_params();
    $new_pass = $params['new_password'] ?? '';
    if (empty($new_pass)) {
        return new WP_Error('missing_password', 'New password is required.', array('status' => 400));
    }
    global $wpdb;
    $table = cha_get_members_table();
    $updated = $wpdb->update($table, array('password' => wp_hash_password($new_pass)), array('member_id' => $id));
    if (!$updated) return new WP_Error('not_found', 'Member not found.', array('status' => 404));
    return rest_ensure_response(array('success' => true, 'message' => 'Password updated.'));
}

function cha_rest_change_password($request) {
    $row = cha_app_token_from_request($request);
    if (!$row) {
        return new WP_Error('forbidden', 'Unauthorized. Login required.', array('status' => 401));
    }
    $params = $request->get_json_params();
    $current = $params['current_password'] ?? '';
    $new_pass = $params['new_password'] ?? '';
    if (empty($current) || empty($new_pass)) {
        return new WP_Error('missing_fields', 'Current password and new password are required.', array('status' => 400));
    }
    if (!wp_check_password($current, $row->password)) {
        return new WP_Error('invalid_password', 'Current password is incorrect.', array('status' => 400));
    }
    if (strlen($new_pass) < 6) {
        return new WP_Error('weak_password', 'New password must be at least 6 characters.', array('status' => 400));
    }
    global $wpdb;
    $table = cha_get_members_table();
    $wpdb->update($table, array('password' => wp_hash_password($new_pass)), array('member_id' => $row->member_id));
    return rest_ensure_response(array('success' => true, 'message' => 'Password updated.'));
}

function cha_rest_get_profile($request) {
    $token_member = cha_app_token_from_request($request);
    if ($token_member) {
        return rest_ensure_response(cha_row_to_rest($token_member));
    }
    $email = sanitize_email($request->get_param('email') ?: $request->get_json_params()['email'] ?? '');
    if (empty($email)) return new WP_Error('missing_email', 'Email is required.', array('status' => 400));
    $row = cha_get_member_by_email($email);
    if (!$row) return new WP_Error('not_found', 'Member not found.', array('status' => 404));
    return rest_ensure_response(cha_row_to_rest($row));
}

function cha_rest_update_profile($request) {
    $params = $request->get_json_params();
    $token_member = cha_app_token_from_request($request);
    $member_id = $token_member ? $token_member->member_id : sanitize_text_field($params['memberId'] ?? '');
    if (empty($member_id)) return new WP_Error('missing_member_id', 'Member ID is required.', array('status' => 400));

    $allowed = array('bloodType','condition','dob','treatmentCentre','emergencyContact','linkedPatient','relationship','affiliation','specialty','licenseNumber','province','phone','name','email','address','nameKhmer');
    $data = array();
    foreach ($allowed as $field) {
        if (isset($params[$field])) $data[$field] = sanitize_text_field($params[$field]);
    }
    if (empty($data)) return new WP_Error('no_data', 'No fields to update.', array('status' => 400));

    global $wpdb;
    $table = cha_get_members_table();
    $db_data = cha_rest_to_db($data);
    $updated = $wpdb->update($table, $db_data, array('member_id' => $member_id));

    if ($updated === false) return new WP_Error('not_found', 'Member not found.', array('status' => 404));
    $row = cha_get_member_by_id($member_id);
    return rest_ensure_response(cha_row_to_rest($row));
}

function cha_rest_upload_photo($request) {
    $token_member = cha_app_token_from_request($request);
    $member_id = $token_member ? $token_member->member_id : sanitize_text_field($_POST['memberId'] ?? $request->get_param('memberId') ?? '');
    if (empty($member_id)) {
        return new WP_Error('missing_member_id', 'Member ID is required.', array('status' => 400));
    }
    if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        return new WP_Error('upload_failed', 'No file uploaded or upload error.', array('status' => 400));
    }
    $file = $_FILES['photo'];
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');
    if (!in_array($file['type'], $allowed_types, true)) {
        return new WP_Error('invalid_type', 'Only JPG, PNG, GIF, and WebP files are allowed.', array('status' => 400));
    }
    if ($file['size'] > 5 * 1024 * 1024) {
        return new WP_Error('too_large', 'File size must be under 5MB.', array('status' => 400));
    }
    $upload_dir = wp_upload_dir();
    $cha_dir = $upload_dir['basedir'] . '/cha-photos';
    if (!file_exists($cha_dir)) wp_mkdir_p($cha_dir);

    global $wpdb;
    $table = cha_get_members_table();
    $old = $wpdb->get_row($wpdb->prepare("SELECT photo FROM $table WHERE member_id = %s", $member_id));
    if ($old && !empty($old->photo)) {
        $old_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $old->photo);
        if ($old_path && file_exists($old_path)) @unlink($old_path);
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $filename = $member_id . '-' . time() . '-' . wp_rand(1000, 9999) . '.' . $ext;
    $filepath = $cha_dir . '/' . $filename;
    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        return new WP_Error('save_failed', 'Could not save uploaded file.', array('status' => 500));
    }
    $photo_url = $upload_dir['baseurl'] . '/cha-photos/' . $filename;
    $wpdb->update($table, array('photo' => $photo_url), array('member_id' => $member_id));
    return rest_ensure_response(array('success' => true, 'photoUrl' => $photo_url));
}

function cha_rest_delete_photo($request) {
    $token_member = cha_app_token_from_request($request);
    $member_id = $token_member ? $token_member->member_id : sanitize_text_field($request->get_param('memberId') ?? '');
    if (empty($member_id)) {
        return new WP_Error('missing_member_id', 'Member ID is required.', array('status' => 400));
    }
    global $wpdb;
    $table = cha_get_members_table();
    $row = $wpdb->get_row($wpdb->prepare("SELECT photo FROM $table WHERE member_id = %s", $member_id));
    if ($row && !empty($row->photo)) {
        $upload_dir = wp_upload_dir();
        $file_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $row->photo);
        if (file_exists($file_path)) @unlink($file_path);
    }
    $wpdb->update($table, array('photo' => ''), array('member_id' => $member_id));
    return rest_ensure_response(array('success' => true));
}

function cha_rest_delete_account($request) {
    $row = cha_app_token_from_request($request);
    if (!$row) {
        return new WP_Error('forbidden', 'Unauthorized. Login required.', array('status' => 401));
    }
    global $wpdb;
    $table = cha_get_members_table();

    if (!empty($row->photo)) {
        $upload_dir = wp_upload_dir();
        $file_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $row->photo);
        if (file_exists($file_path)) @unlink($file_path);
    }

    $deleted = $wpdb->delete($table, array('member_id' => $row->member_id));
    if ($deleted === false) {
        return new WP_Error('delete_failed', 'Could not delete account. Please try again.', array('status' => 500));
    }
    return rest_ensure_response(array('success' => true, 'message' => 'Account deleted.'));
}

function cha_register_rest_routes() {
    register_rest_route('cha/v1', '/register', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_register',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('cha/v1', '/login', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_login',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('cha/v1', '/members', array(
        'methods'  => 'GET',
        'callback' => 'cha_rest_get_members',
        'permission_callback' => function() { return current_user_can('manage_options'); },
    ));
    register_rest_route('cha/v1', '/members/(?P<id>[\w\-]+)', array(
        'methods'  => 'PUT',
        'callback' => 'cha_rest_update_member',
        'permission_callback' => function() { return current_user_can('manage_options'); },
    ));
    register_rest_route('cha/v1', '/members/(?P<id>[\w\-]+)/reset-password', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_reset_password',
        'permission_callback' => function() { return current_user_can('manage_options'); },
    ));
    register_rest_route('cha/v1', '/member/profile', array(
        'methods'  => 'GET',
        'callback' => 'cha_rest_get_profile',
        'permission_callback' => 'cha_require_member_token',
    ));
    register_rest_route('cha/v1', '/member/profile', array(
        'methods'  => 'PUT',
        'callback' => 'cha_rest_update_profile',
        'permission_callback' => 'cha_require_member_token',
    ));
    register_rest_route('cha/v1', '/member/photo', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_upload_photo',
        'permission_callback' => 'cha_require_member_token',
    ));
    register_rest_route('cha/v1', '/member/photo/delete', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_delete_photo',
        'permission_callback' => 'cha_require_member_token',
    ));
    register_rest_route('cha/v1', '/member/change-password', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_change_password',
        'permission_callback' => 'cha_require_member_token',
    ));
    register_rest_route('cha/v1', '/member/logout', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_logout',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('cha/v1', '/member/delete', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_delete_account',
        'permission_callback' => 'cha_require_member_token',
    ));
    register_rest_route('cha/v1', '/verify', array(
        'methods'  => 'GET',
        'callback' => 'cha_rest_verify',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('cha/v1', '/resend-verification', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_resend_verification',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('cha/v1', '/forgot-password', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_forgot_password',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('cha/v1', '/reset-password', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_reset_password_with_token',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('cha/v1', '/payway/settings', array(
        'methods'  => 'GET',
        'callback' => 'cha_rest_payway_get_settings',
        'permission_callback' => function() { return current_user_can('manage_options'); },
    ));
    register_rest_route('cha/v1', '/payway/settings', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_payway_save_settings',
        'permission_callback' => function() { return current_user_can('manage_options'); },
    ));
    register_rest_route('cha/v1', '/payway/test-hash', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_payway_test_hash',
        'permission_callback' => function() { return current_user_can('manage_options'); },
    ));
    register_rest_route('cha/v1', '/payway/purchase', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_payway_purchase',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('cha/v1', '/payway/callback', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_payway_callback',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('cha/v1', '/payway/check', array(
        'methods'  => 'POST',
        'callback' => 'cha_rest_payway_check',
        'permission_callback' => '__return_true',
    ));
}
add_action('rest_api_init', 'cha_register_rest_routes');

function cha_bypass_rest_cookie_check($result) {
    if (!empty($result)) return $result;
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if (strpos($uri, '/cha/v1/') !== false) return true;
    return $result;
}
add_filter('rest_authentication_errors', 'cha_bypass_rest_cookie_check', 101);

/* ---- Admin page ---- */

function cha_add_admin_menu() {
    add_menu_page(
        'CHA Members',
        'CHA Members',
        'manage_options',
        'cha-members',
        'cha_render_admin_page',
        'dashicons-groups',
        26
    );
    add_menu_page(
        'Donations',
        'Donations',
        'manage_options',
        'cha-donations',
        'cha_render_donations_page',
        'dashicons-heart',
        27
    );
}
add_action('admin_menu', 'cha_add_admin_menu');

add_action('wp_ajax_cha_view_smtp_log', function() {
    if (!current_user_can('manage_options')) wp_die('Unauthorized');
    $log_file = WP_CONTENT_DIR . '/cha-smtp-debug.log';
    echo '<!DOCTYPE html><html><head><title>SMTP Debug Log</title><style>body{font-family:monospace;font-size:12px;background:#1a1a2e;color:#e0e0e0;padding:20px;white-space:pre-wrap;word-break:break-all;}</style></head><body>';
    if (file_exists($log_file)) {
        $content = file_get_contents($log_file);
        echo esc_html($content ?: '(empty log)');
    } else {
        echo '(no log file yet - send a test email first)';
    }
    echo '</body></html>';
    wp_die();
});

function cha_render_admin_page() {
    global $wpdb;
    // Handle SMTP settings save
    if (isset($_POST['cha_update_smtp']) && current_user_can('manage_options')) {
        if (!isset($_POST['cha_smtp_nonce']) || !wp_verify_nonce($_POST['cha_smtp_nonce'], 'cha_save_smtp')) {
            wp_die('Security check failed.');
        }
        update_option('cha_smtp_settings', array(
            'host'                 => sanitize_text_field($_POST['smtp_host'] ?? ''),
            'port'                 => intval($_POST['smtp_port'] ?? 587),
            'username'             => sanitize_text_field($_POST['smtp_user'] ?? ''),
            'password'             => sanitize_text_field($_POST['smtp_pass'] ?? ''),
            'from_email'           => sanitize_email($_POST['smtp_from'] ?? ''),
            'from_name'            => sanitize_text_field($_POST['smtp_from_name'] ?? ''),
            'enabled'              => isset($_POST['smtp_enabled']),
            'admin_notify_enabled' => isset($_POST['admin_notify_enabled']),
            'admin_notify_email'   => sanitize_text_field($_POST['admin_notify_email'] ?? ''),
        ));
        echo '<div class="cha-notice cha-notice-success"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> SMTP configuration saved successfully.</div>';
    }

    // Handle update form submission
    if (isset($_POST['cha_update_member']) && current_user_can('manage_options')) {
        if (!isset($_POST['cha_edit_nonce']) || !wp_verify_nonce($_POST['cha_edit_nonce'], 'cha_edit_member')) {
            wp_die('Security check failed.');
        }
        $edit_email = sanitize_email($_POST['email'] ?? '');
        if (!is_email($edit_email)) {
            echo '<div class="cha-notice cha-notice-error"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg> Please enter a valid email address.</div>';
        } else {
        $update_id = sanitize_text_field($_POST['member_id']);
        $data = array(
            'name'              => sanitize_text_field($_POST['name']),
            'name_khmer'        => sanitize_text_field($_POST['name_khmer'] ?? ''),
            'email'             => $edit_email,
            'province'          => sanitize_text_field($_POST['province']),
            'role'              => sanitize_text_field($_POST['role']),
            'blood_type'        => sanitize_text_field($_POST['bloodType'] ?? ''),
            'condition'         => sanitize_text_field($_POST['condition'] ?? ''),
            'dob'               => sanitize_text_field($_POST['dob'] ?? ''),
            'treatment_centre'  => sanitize_text_field($_POST['treatmentCentre'] ?? ''),
            'phone'             => sanitize_text_field($_POST['phone'] ?? ''),
            'emergency_contact' => sanitize_text_field($_POST['emergencyContact'] ?? ''),
            'linked_patient'    => sanitize_text_field($_POST['linkedPatient'] ?? ''),
            'relationship'      => sanitize_text_field($_POST['relationship'] ?? ''),
            'affiliation'       => sanitize_text_field($_POST['affiliation'] ?? ''),
            'specialty'         => sanitize_text_field($_POST['specialty'] ?? ''),
            'license_number'    => sanitize_text_field($_POST['license_number'] ?? ''),
            'address'           => sanitize_text_field($_POST['address'] ?? ''),
        );
        $new_pass = trim($_POST['new_password']);
        if (!empty($new_pass)) {
            $data['password'] = wp_hash_password($new_pass);
        }
        $updated = $wpdb->update($table, $data, array('member_id' => $update_id));
        if ($updated !== false) {
            echo '<div class="cha-notice cha-notice-success"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Member updated successfully.</div>';
        } else {
            echo '<div class="cha-notice cha-notice-error"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg> Update failed. Please try again.</div>';
        }
        }
    }

    // Handle delete
    if (isset($_GET['delete']) && current_user_can('manage_options')) {
        if (!isset($_GET['cha_delete_nonce']) || !wp_verify_nonce($_GET['cha_delete_nonce'], 'cha_delete_member')) {
            wp_die('Security check failed.');
        }
        $delete_id = sanitize_text_field($_GET['delete']);
        $wpdb->delete($table, array('member_id' => $delete_id));
        echo '<div class="cha-notice cha-notice-success"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Member deleted successfully.</div>';
    }

    // Handle verify
    if (isset($_GET['verify']) && current_user_can('manage_options')) {
        if (!isset($_GET['cha_verify_nonce']) || !wp_verify_nonce($_GET['cha_verify_nonce'], 'cha_verify_member')) {
            wp_die('Security check failed.');
        }
        $verify_id = sanitize_text_field($_GET['verify']);
        $wpdb->update($table, array('status' => 'active', 'verification_token' => null), array('member_id' => $verify_id));
        echo '<div class="cha-notice cha-notice-success"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Member verified successfully.</div>';
    }

    // Handle add member submission
    if (isset($_POST['cha_add_member']) && current_user_can('manage_options')) {
        if (!isset($_POST['cha_edit_nonce']) || !wp_verify_nonce($_POST['cha_edit_nonce'], 'cha_edit_member')) {
            wp_die('Security check failed.');
        }
        $add_name     = sanitize_text_field($_POST['name'] ?? '');
        $add_name_khmer = sanitize_text_field($_POST['name_khmer'] ?? '');
        $add_email    = sanitize_email($_POST['email'] ?? '');
        $add_province = sanitize_text_field($_POST['province'] ?? '');
        $add_role     = sanitize_text_field($_POST['role'] ?? '');
        $add_phone    = sanitize_text_field($_POST['phone'] ?? '');
        $add_pass     = trim($_POST['new_password'] ?? '');
        if (empty($add_name) || empty($add_email)) {
            echo '<div class="cha-notice cha-notice-error"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg> Name and email are required.</div>';
        } elseif (!is_email($add_email)) {
            echo '<div class="cha-notice cha-notice-error"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg> Please enter a valid email address.</div>';
        } elseif ($wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE email = %s", $add_email))) {
            echo '<div class="cha-notice cha-notice-error"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg> A member with this email already exists.</div>';
        } else {
            $valid_roles = array('Patient', 'Family member / Caregiver', 'Healthcare professional', 'Member');
            if (!in_array($add_role, $valid_roles)) $add_role = 'Member';
            $add_id = cha_generate_member_id();
            $add_data = array(
                'member_id'    => $add_id,
                'name'         => $add_name,
                'name_khmer'   => $add_name_khmer,
                'email'        => $add_email,
                'password'     => empty($add_pass) ? wp_hash_password(wp_generate_password()) : wp_hash_password($add_pass),
                'province'     => $add_province,
                'role'         => $add_role,
                'phone'        => $add_phone,
                'member_since' => date('F Y'),
                'status'       => 'active',
                'registered'   => current_time('mysql'),
                'address'      => sanitize_text_field($_POST['address'] ?? ''),
                'dob'          => sanitize_text_field($_POST['dob'] ?? ''),
                'condition'    => sanitize_text_field($_POST['condition'] ?? ''),
                'blood_type'   => sanitize_text_field($_POST['bloodType'] ?? ''),
            );
            $added = $wpdb->insert($table, $add_data);
            if ($added) {
                wp_redirect(admin_url('admin.php?page=cha-members&edit=' . $add_id . '&added=1'));
                exit;
            } else {
                echo '<div class="cha-notice cha-notice-error"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg> Could not create member. Please try again.</div>';
            }
        }
    }

    $active_filter = isset($_GET['role_filter']) ? sanitize_text_field($_GET['role_filter']) : '';
    $active_status = isset($_GET['status_filter']) ? sanitize_text_field($_GET['status_filter']) : '';
    $current_page = isset($_GET['paged']) ? max(1, (int) $_GET['paged']) : 1;
    $per_page = 20;
    $paged_data = cha_get_members_page($current_page, $per_page, $active_filter, $active_status);
    $rows = $paged_data['rows'];
    $total_members = $paged_data['total'];
    $total_pages = $paged_data['pages'];
    $count = cha_member_count();

    // Handle edit mode
    $edit_id = isset($_GET['edit']) ? sanitize_text_field($_GET['edit']) : '';
    $editing = false;
    $edit_row = null;
    if ($edit_id) {
        $edit_row = cha_get_member_by_id($edit_id);
        $editing = !empty($edit_row);
    }

    $edit_member = $edit_row ? cha_row_to_rest($edit_row) : null;

    /* Count by role (global, not per-page) */
    $all_members_for_counts = cha_get_all_members();
    $role_counts = array('Patient' => 0, 'Family member / Caregiver' => 0, 'Healthcare professional' => 0, 'Member' => 0);
    foreach ($all_members_for_counts as $r) {
        $rl = $r->role ?: 'Member';
        if (isset($role_counts[$rl])) $role_counts[$rl]++;
    }
    $display_count = $total_members;

    /* Handle add=1 mode */
    $adding = isset($_GET['add']) && $_GET['add'] === '1';

    /* Add form POST-back values (preserved on validation error) */
    $add_form_name     = isset($_POST['cha_add_member']) ? sanitize_text_field($_POST['name'] ?? '') : '';
    $add_form_email    = isset($_POST['cha_add_member']) ? sanitize_email($_POST['email'] ?? '') : '';
    $add_form_province = isset($_POST['cha_add_member']) ? sanitize_text_field($_POST['province'] ?? '') : '';
    $add_form_role     = isset($_POST['cha_add_member']) ? sanitize_text_field($_POST['role'] ?? '') : '';
    $add_form_phone    = isset($_POST['cha_add_member']) ? sanitize_text_field($_POST['phone'] ?? '') : '';
    $add_form_address  = isset($_POST['cha_add_member']) ? sanitize_text_field($_POST['address'] ?? '') : '';

    /* Handle added=1 success notice */
    if (isset($_GET['added']) && $_GET['added'] === '1') {
        echo '<div class="cha-notice cha-notice-success"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Member created successfully.</div>';
    }
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;500;600;700&family=Siemreap&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
    :root { --cha-blue: #0B1D6D; --cha-red: #E31E24; --cha-purple: #6A2C91; --cha-teal: #0D9488; --cha-amber: #92400E; --cha-green: #166534; --cha-border: #E5E8EE; --cha-bg: #F4F6FB; --cha-text: #1A1A1A; --cha-muted: #6B7280; --font-km: 'Kantumruy Pro', 'Siemreap', 'Khmer OS', 'Hanuman', sans-serif; }
    .wrap.cha-page { max-width:1400px; font-family:'Poppins', -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif; display:block !important; width:100% !important; margin:1.5em 20px 20px !important; background:none !important; padding:0 !important; border:none !important; box-shadow:none !important; }
    #wpfooter { display: none !important; }
    .cha-header { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px; margin-bottom:24px; padding:20px 24px; background:linear-gradient(135deg,#0B1D6D 0%,#1a2e7a 100%); border-radius:16px; box-shadow:0 4px 20px rgba(11,29,109,0.15); }
    .cha-header-brand { display:flex; align-items:center; gap:16px; }
    .cha-header-icon { width:44px; height:44px; border-radius:12px; background:rgba(255,255,255,0.12); display:flex; align-items:center; justify-content:center; color:#fff; backdrop-filter:blur(4px); flex-shrink:0; }
    .cha-header-icon svg { width:22px; height:22px; }
    .cha-header-title { font-size:1.375rem; font-weight:800; color:#fff; margin:0; line-height:1.2; letter-spacing:-0.01em; }
    .cha-header-sub { font-size:0.8125rem; color:rgba(255,255,255,0.6); margin:2px 0 0; }
    .cha-header-actions { display:flex; align-items:center; gap:8px; }
    .cha-btn { display:inline-flex; align-items:center; gap:7px; padding:9px 20px; border-radius:10px; font-size:0.8125rem; font-weight:600; text-decoration:none; transition:all .15s ease; cursor:pointer; border:none; }
    .cha-btn-export { background:rgba(255,255,255,0.12); color:#fff; backdrop-filter:blur(4px); border:1px solid rgba(255,255,255,0.1); }
    .cha-btn-export:hover { background:rgba(255,255,255,0.2); color:#fff; }

    /* Role Tabs */
    .cha-tabs { display:flex; gap:4px; background:#F3F4F6; border-radius:12px; padding:4px; margin-bottom:20px; flex-wrap:wrap; }
    .cha-tab { padding:8px 18px; border-radius:9px; font-size:0.8125rem; font-weight:600; text-decoration:none; color:var(--cha-muted); transition:all .15s ease; display:flex; align-items:center; gap:6px; white-space:nowrap; }
    .cha-tab:hover { color:var(--cha-text); background:rgba(255,255,255,0.5); }
    .cha-tab.cha-active { background:#fff; color:var(--cha-blue); box-shadow:0 1px 4px rgba(0,0,0,0.06); }
    .cha-tab .cha-tab-count { font-size:0.75rem; background:rgba(0,0,0,0.06); padding:0 8px; border-radius:999px; font-weight:700; }
    .cha-tab.cha-active .cha-tab-count { background:rgba(11,29,109,0.08); }
    .cha-tab[data-role="Patient"].cha-active { color:var(--cha-blue); }
    .cha-tab[data-role="Family member / Caregiver"].cha-active { color:var(--cha-teal); }
    .cha-tab[data-role="Healthcare professional"].cha-active { color:var(--cha-purple); }
    .cha-tab[data-role="Member"].cha-active { color:var(--cha-amber); }

    /* Role Badges */
    .cha-badge { display:inline-flex; align-items:center; gap:5px; padding:3px 10px; border-radius:999px; font-size:0.75rem; font-weight:700; letter-spacing:0.02em; white-space:nowrap; }
    .cha-badge::before { content:''; width:6px; height:6px; border-radius:50%; flex-shrink:0; }
    .cha-badge-patient { background:#EFF6FF; color:var(--cha-blue); } .cha-badge-patient::before { background:var(--cha-blue); }
    .cha-badge-caregiver { background:#CCFBF1; color:#0F766E; } .cha-badge-caregiver::before { background:var(--cha-teal); }
    .cha-badge-professional { background:#F3E8FF; color:var(--cha-purple); } .cha-badge-professional::before { background:var(--cha-purple); }
    .cha-badge-member { background:#FEF3C7; color:var(--cha-amber); } .cha-badge-member::before { background:var(--cha-amber); }

    /* Table */
    .cha-table-wrap { background:#fff; border:1px solid var(--cha-border); border-radius:16px; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.02); }
    .cha-table { width:100%; border-collapse:collapse; font-size:0.8125rem; }
    .cha-table th { text-align:left; padding:12px 14px; font-size:0.6875rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; color:var(--cha-muted); background:#FAFBFC; border-bottom:1px solid var(--cha-border); white-space:nowrap; }
    .cha-table td { padding:12px 14px; border-bottom:1px solid #F3F4F6; vertical-align:middle; }
    .cha-table tr:last-child td { border-bottom:none; }
    .cha-table tr:hover td { background:#FAFBFF; }
    .cha-table .cha-id { font-weight:700; color:var(--cha-blue); font-size:0.8125rem; }
    .cha-table .cha-name { font-weight:600; color:var(--cha-text); }
    .cha-table .cha-email { color:var(--cha-muted); font-size:0.75rem; }
    .cha-table .cha-registered { font-size:0.75rem; color:var(--cha-muted); white-space:nowrap; }
    .cha-table .cha-actions { white-space:nowrap; }
    .cha-table .cha-actions .button { margin-right:4px; font-size:0.75rem; min-height:28px; line-height:26px; }
    .cha-photo-thumb { width:44px; height:56px; object-fit:cover; border-radius:6px; border:1px solid var(--cha-border); background:#F3F4F6; display:inline-flex; align-items:center; justify-content:center; color:#9CA3AF; }
    .cha-photo-empty { color:#C3C9D4; }
    .cha-empty { text-align:center; padding:80px 20px; color:var(--cha-muted); }
    .cha-empty-icon { width:56px; height:56px; border-radius:16px; background:#F3F4F6; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; color:#9CA3AF; }
    .cha-empty-icon svg { width:28px; height:28px; }
    .cha-empty p { font-size:0.9375rem; margin:0; }
    .cha-empty .cha-empty-sub { font-size:0.8125rem; color:var(--cha-muted); margin-top:4px; }

    /* Edit Form Card */
    .cha-edit-wrap { max-width:820px; margin:0 auto; }
    .cha-edit-card { background:#fff; border:1px solid #E2E8F0; border-radius:20px; padding:36px 40px; box-shadow:0 10px 25px -5px rgba(0,0,0,0.04), 0 8px 10px -6px rgba(0,0,0,0.02); }
    @media (max-width:768px) { .cha-edit-card { padding:24px 20px; } }
    .cha-edit-header { display:flex; align-items:center; gap:16px; margin-bottom:28px; padding-bottom:20px; border-bottom:1px solid #F1F5F9; }
    .cha-edit-avatar { width:64px; height:76px; object-fit:cover; border-radius:12px; border:2px solid #E2E8F0; box-shadow:0 4px 6px -1px rgba(0,0,0,0.05); }
    .cha-edit-avatar-placeholder { width:64px; height:76px; border-radius:12px; display:inline-flex; align-items:center; justify-content:center; color:#94A3B8; font-size:1.25rem; font-weight:700; background:#F8FAFC; border:2px dashed #CBD5E1; }
    .cha-edit-title-block h2 { font-size:1.375rem; font-weight:700; color:var(--cha-blue); margin:0 0 6px; letter-spacing:-0.01em; display:flex; align-items:center; gap:10px; }
    .cha-edit-sub { font-size:0.875rem; color:var(--cha-muted); margin:0; display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
    .cha-id-tag { background:#EFF6FF; color:var(--cha-blue); padding:3px 10px; border-radius:6px; font-weight:700; font-size:0.8125rem; font-family:monospace; }
    
    .cha-section-box { background:#FAFCFF; border:1px solid #E2E8F0; border-radius:14px; padding:20px 24px; margin-bottom:24px; }
    .cha-section-box-header { display:flex; align-items:center; gap:8px; margin-bottom:18px; }
    .cha-section-box-icon { width:26px; height:26px; border-radius:8px; background:rgba(11,29,109,0.08); color:var(--cha-blue); display:flex; align-items:center; justify-content:center; }
    .cha-section-box-title { font-size:0.875rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; color:var(--cha-blue); margin:0; }
    
    .cha-role-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:10px; }
    @media (max-width:540px) { .cha-role-grid { grid-template-columns:1fr; } }
    .cha-role-card { display:flex; align-items:flex-start; gap:14px; padding:16px 18px; border:2px solid #E2E8F0; border-radius:12px; cursor:pointer; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); background:#fff; position:relative; }
    .cha-role-card:hover { border-color:#CBD5E1; transform:translateY(-1px); box-shadow:0 4px 12px rgba(0,0,0,0.03); }
    .cha-role-card.is-selected { border-color:var(--cha-blue); background:#F8FAFF; box-shadow:0 4px 14px rgba(11,29,109,0.08); }
    .cha-role-radio-custom { width:20px; height:20px; border-radius:50%; border:2px solid #CBD5E1; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:2px; transition:all 0.2s ease; }
    .cha-role-card.is-selected .cha-role-radio-custom { border-color:var(--cha-blue); }
    .cha-role-radio-dot { width:10px; height:10px; border-radius:50%; background:var(--cha-blue); display:none; transition:all 0.2s ease; }
    .cha-role-card.is-selected .cha-role-radio-dot { display:block; }
    .cha-role-card-text strong { display:block; font-size:0.9375rem; color:#1E293B; margin-bottom:2px; }
    .cha-role-card-text span { font-size:0.8125rem; color:#64748B; line-height:1.4; }

    .cha-edit-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:18px 20px; }
    @media (max-width:640px) { .cha-edit-grid-2 { grid-template-columns:1fr; } }
    .cha-field-full { grid-column:1/-1; }
    
    .cha-edit-field { display:flex; flex-direction:column; gap:6px; }
    .cha-edit-field label { font-size:0.8125rem; font-weight:600; color:#334155; display:flex; align-items:center; justify-content:space-between; }
    .cha-edit-field .field-hint { font-size:0.75rem; font-weight:400; color:#94A3B8; }
    .cha-edit-field input, .cha-edit-field select { width:100%; height:44px; padding:0 14px; border:1.5px solid #CBD5E1; border-radius:10px; font-size:0.875rem; color:#1E293B; background:#fff; transition:all 0.15s ease; box-sizing:border-box; line-height:42px; }
    .cha-edit-field select { -webkit-appearance:none; -moz-appearance:none; appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748B' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 14px center; background-size:16px 16px; padding-right:38px; cursor:pointer; }
    .cha-edit-field input:focus, .cha-edit-field select:focus { border-color:var(--cha-blue); outline:none; box-shadow:0 0 0 4px rgba(11,29,109,0.08); background:#fff; }
    .cha-edit-field input::placeholder { color:#94A3B8; }
    
    /* Khmer typography */
    .km-text, .km-label, .km-input, [data-km] { font-family:var(--font-km) !important; }
    .km-label { font-size:0.875rem !important; letter-spacing:0.01em; }
    .km-input { font-size:0.9375rem !important; }
    .cha-table .cha-name-km { font-family:var(--font-km); font-size:0.8125rem; color:#64748B; margin-top:2px; }
    
    .cha-edit-actions { display:flex; align-items:center; justify-content:space-between; gap:16px; margin-top:32px; padding-top:24px; border-top:1px solid #F1F5F9; }
    .cha-btn-save-main { display:inline-flex; align-items:center; gap:8px; padding:12px 28px; border-radius:10px; font-size:0.875rem; font-weight:700; color:#fff !important; background:linear-gradient(135deg,#0B1D6D 0%,#183494 100%) !important; border:none !important; cursor:pointer; transition:all 0.2s ease; box-shadow:0 4px 14px rgba(11,29,109,0.25); text-decoration:none; }
    .cha-btn-save-main:hover { transform:translateY(-1px); box-shadow:0 6px 18px rgba(11,29,109,0.35); filter:brightness(1.05); }
    .cha-btn-back-clean { display:inline-flex; align-items:center; gap:8px; padding:11px 20px; border-radius:10px; font-size:0.875rem; font-weight:600; color:#475569; background:#F8FAFC; border:1.5px solid #E2E8F0; text-decoration:none; transition:all 0.15s ease; }
    .cha-btn-back-clean:hover { background:#F1F5F9; color:#0F172A; border-color:#CBD5E1; }
    .cha-role-tag { display:inline-flex; align-items:center; gap:6px; padding:4px 14px; border-radius:999px; font-size:0.8125rem; font-weight:600; }

    /* Modal */
    .cha-modal-overlay { display:none; position:fixed; inset:0; z-index:100000; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px); align-items:center; justify-content:center; opacity:0; transition:opacity .25s ease; }
    .cha-modal-overlay.cha-modal-open { display:flex; opacity:1; }
    .cha-modal { background:#fff; border-radius:16px; padding:32px; max-width:400px; width:90%; box-shadow:0 20px 60px rgba(0,0,0,0.25); transform:translateY(20px) scale(0.95); transition:transform .25s cubic-bezier(0.16,1,0.3,1); text-align:center; }
    .cha-modal-icon { width:56px; height:56px; border-radius:50%; background:#FEF2F2; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; }
    .cha-modal-icon svg { width:28px; height:28px; color:#DC2626; }
    .cha-modal h3 { font-size:1.125rem; font-weight:700; color:#1A1A1A; margin:0 0 8px; }
    .cha-modal p { font-size:0.875rem; color:#6B7280; margin:0 0 24px; line-height:1.5; }
    .cha-modal-actions { display:flex; gap:10px; justify-content:center; }
    .cha-modal-btn { padding:10px 24px; border-radius:10px; font-size:0.875rem; font-weight:600; cursor:pointer; transition:all .15s ease; border:none; }
    .cha-modal-cancel { background:#F3F4F6; color:#374151; border:1px solid var(--cha-border); }
    .cha-modal-cancel:hover { background:#E5E7EB; }
    .cha-modal-confirm { background:#DC2626; color:#fff; }
    .cha-modal-confirm:hover { background:#B91C1C; box-shadow:0 4px 12px rgba(220,38,38,0.3); }

    /* Notifications */
    .cha-notice { display:flex; align-items:center; gap:10px; padding:14px 18px; border-radius:12px; font-size:0.875rem; font-weight:600; margin-bottom:20px; box-shadow:0 2px 8px rgba(0,0,0,0.04); }
    .cha-notice-success { background:#ECFDF5; color:#166534; border:1px solid #BBF7D0; }
    .cha-notice-error { background:#FEF2F2; color:#991B1B; border:1px solid #FECACA; }
    .cha-notice svg { flex-shrink:0; }

    /* SMTP Settings Modern Styles */
    .cha-smtp-card { background:#fff; border:1px solid #E2E8F0; border-radius:20px; padding:32px 36px; box-shadow:0 10px 25px -5px rgba(0,0,0,0.04), 0 8px 10px -6px rgba(0,0,0,0.02); }
    @media (max-width:768px) { .cha-smtp-card { padding:24px 20px; } }
    .cha-smtp-hero { display:flex; align-items:flex-start; justify-content:space-between; gap:16px; margin-bottom:24px; padding-bottom:20px; border-bottom:1px solid #F1F5F9; flex-wrap:wrap; }
    .cha-smtp-hero-left { display:flex; align-items:center; gap:14px; }
    .cha-smtp-brand-icon { width:48px; height:48px; border-radius:14px; background:linear-gradient(135deg, #0B1D6D 0%, #1e3a8a 100%); display:flex; align-items:center; justify-content:center; color:#fff; box-shadow:0 4px 12px rgba(11,29,109,0.2); flex-shrink:0; }
    .cha-smtp-brand-icon svg { width:24px; height:24px; }
    .cha-smtp-hero-title { font-size:1.375rem; font-weight:800; color:var(--cha-blue); margin:0 0 4px; letter-spacing:-0.01em; display:flex; align-items:center; gap:10px; }
    .cha-smtp-hero-sub { font-size:0.8125rem; color:#64748B; margin:0; }
    .cha-smtp-status-badge { display:inline-flex; align-items:center; gap:6px; padding:4px 12px; border-radius:999px; font-size:0.75rem; font-weight:700; }
    .cha-smtp-status-badge.is-active { background:#ECFDF5; color:#15803D; border:1px solid #BBF7D0; }
    .cha-smtp-status-badge.is-inactive { background:#F3F4F6; color:#6B7280; border:1px solid #E5E7EB; }
    .cha-smtp-status-badge::before { content:''; width:7px; height:7px; border-radius:50%; }
    .cha-smtp-status-badge.is-active::before { background:#16A34A; box-shadow:0 0 0 3px rgba(22,163,74,0.2); }
    .cha-smtp-status-badge.is-inactive::before { background:#9CA3AF; }

    .cha-smtp-group { background:#F8FAFC; border:1px solid #E2E8F0; border-radius:14px; padding:20px 22px; margin-bottom:18px; transition:border-color 0.2s ease; }
    .cha-smtp-group:hover { border-color:#CBD5E1; }
    .cha-smtp-group-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid #EDF2F7; }
    .cha-smtp-group-title { display:flex; align-items:center; gap:8px; font-size:0.8125rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; color:var(--cha-blue); margin:0; }
    .cha-smtp-group-icon { width:24px; height:24px; border-radius:6px; background:rgba(11,29,109,0.08); color:var(--cha-blue); display:flex; align-items:center; justify-content:center; }
    .cha-smtp-group-icon svg { width:13px; height:13px; }

    .cha-smtp-toggle { display:inline-flex; align-items:center; gap:10px; cursor:pointer; user-select:none; }
    .cha-smtp-toggle-track { display:inline-block; width:42px; height:24px; border-radius:24px; background:#CBD5E1; position:relative; transition:background 0.2s cubic-bezier(0.16,1,0.3,1); flex-shrink:0; }
    .cha-smtp-toggle-track::after { content:""; position:absolute; top:3px; left:3px; width:18px; height:18px; border-radius:50%; background:#fff; transition:transform 0.2s cubic-bezier(0.16,1,0.3,1); box-shadow:0 2px 4px rgba(0,0,0,0.15); }
    .cha-smtp-toggle input[type="checkbox"] { display:none !important; }
    .cha-smtp-toggle input[type="checkbox"]:checked + .cha-smtp-toggle-track { background:#166534; }
    .cha-smtp-toggle input[type="checkbox"]:checked + .cha-smtp-toggle-track::after { transform:translateX(18px); }
    .cha-smtp-toggle-text { font-size:0.8125rem; font-weight:600; color:#334155; }

    .cha-smtp-footer { display:flex; align-items:center; justify-content:space-between; padding-top:20px; border-top:1px solid #F1F5F9; margin-top:24px; flex-wrap:wrap; gap:12px; }
    .cha-smtp-log-btn { display:inline-flex; align-items:center; gap:6px; background:#F1F5F9; color:#475569; border:1px solid #E2E8F0; border-radius:9px; padding:9px 14px; font-size:0.8125rem; font-weight:600; cursor:pointer; transition:all 0.15s ease; text-decoration:none; }
    .cha-smtp-log-btn:hover { background:#E2E8F0; color:#0F172A; }
    .cha-smtp-save-btn { display:inline-flex; align-items:center; gap:8px; padding:11px 26px; border-radius:10px; font-size:0.875rem; font-weight:700; color:#fff !important; background:linear-gradient(135deg,#166534 0%,#15803D 100%) !important; border:none !important; cursor:pointer; transition:all 0.2s ease; box-shadow:0 4px 12px rgba(22,101,52,0.25); text-decoration:none; }
    .cha-smtp-save-btn:hover { transform:translateY(-1px); box-shadow:0 6px 16px rgba(22,101,52,0.35); filter:brightness(1.05); }

    /* Action buttons as pills */
    .cha-action-btn { display:inline-flex; align-items:center; gap:5px; padding:4px 12px; border-radius:999px; font-size:0.75rem; font-weight:700; text-decoration:none; transition:all .15s ease; border:none; cursor:pointer; }
    .cha-action-btn::before { content:''; width:5px; height:5px; border-radius:50%; flex-shrink:0; }
    .cha-action-edit { background:#EFF6FF; color:var(--cha-blue); }
    .cha-action-edit:hover { background:#DBEAFE; color:#0a1a5e; }
    .cha-action-edit::before { background:var(--cha-blue); }
    .cha-action-delete { background:#FEF2F2; color:#DC2626; }
    .cha-action-delete:hover { background:#FEE2E2; color:#B91C1C; }
    .cha-action-delete::before { background:#DC2626; }

    /* Save button gradient */
    .cha-btn-save { background:linear-gradient(135deg,#0B1D6D 0%,#1a2e7a 100%) !important; border-color:var(--cha-blue) !important; }
    .cha-btn-save:hover { box-shadow:0 4px 12px rgba(11,29,109,0.25) !important; }

    /* Back link */
    .cha-back-link { display:inline-flex; align-items:center; gap:6px; padding:9px 18px; border-radius:10px; font-size:0.8125rem; font-weight:600; color:var(--cha-blue); text-decoration:none; transition:all .15s ease; border:1.5px solid transparent; }
    .cha-back-link:hover { background:#EFF6FF; border-color:var(--cha-blue); }

    /* Override WordPress .wrap padding */
    .wrap.cha-page { margin:0; padding:20px; }

    /* Search */
    .cha-search { position:relative; margin-bottom:16px; }
    .cha-search-icon { position:absolute; left:14px; top:50%; transform:translateY(-50%); width:16px; height:16px; color:var(--cha-muted); pointer-events:none; }
    .cha-search input { width:100%; max-width:360px; padding:10px 14px 10px 40px; border:1.5px solid var(--cha-border); border-radius:10px; font-size:0.8125rem; background:#fff; transition:border-color 0.15s ease; }
    .cha-search input:focus { border-color:var(--cha-blue); outline:none; box-shadow:0 0 0 3px rgba(11,29,109,0.08); }
    .cha-search input::placeholder { color:var(--cha-muted); }

    /* Pagination */
    .cha-pagination { display:flex; align-items:center; gap:6px; flex-wrap:wrap; margin-top:16px; }
    .cha-page { display:inline-flex; align-items:center; justify-content:center; min-width:34px; height:34px; padding:0 10px; font-size:0.8125rem; font-weight:600; border-radius:8px; text-decoration:none; color:var(--cha-text); background:#fff; border:1.5px solid var(--cha-border); transition:all 0.15s ease; }
    .cha-page:hover { border-color:var(--cha-blue); color:var(--cha-blue); }
    .cha-page-current { background:var(--cha-blue); border-color:var(--cha-blue); color:#fff; }
    .cha-page-total { margin-left:auto; font-size:0.75rem; color:var(--cha-muted); }
    </style>

    <div class="cha-modal-overlay" id="cha-modal-overlay">
      <div class="cha-modal">
        <div class="cha-modal-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <h3 id="cha-modal-title">Are you sure?</h3>
        <p id="cha-modal-message">This action cannot be undone.</p>
        <div class="cha-modal-actions">
          <button class="cha-modal-btn cha-modal-cancel" id="cha-modal-cancel">Cancel</button>
          <button class="cha-modal-btn cha-modal-confirm" id="cha-modal-confirm">Delete</button>
        </div>
      </div>
    </div>
    <script>
    (function(){
      var overlay = document.getElementById('cha-modal-overlay');
      var titleEl = document.getElementById('cha-modal-title');
      var msgEl = document.getElementById('cha-modal-message');
      var confirmBtn = document.getElementById('cha-modal-confirm');
      var cancelBtn = document.getElementById('cha-modal-cancel');
      var callback = null;
      confirmBtn.addEventListener('click', function(){ overlay.classList.remove('cha-modal-open'); if(callback) callback(); });
      cancelBtn.addEventListener('click', function(){ overlay.classList.remove('cha-modal-open'); callback = null; });
      overlay.addEventListener('click', function(e){ if(e.target === overlay){ overlay.classList.remove('cha-modal-open'); callback = null; } });
      window.chaConfirm = function(title, message, confirmText, cb){
        titleEl.textContent = title || 'Are you sure?';
        msgEl.textContent = message || 'This action cannot be undone.';
        confirmBtn.textContent = confirmText || 'Delete';
        callback = cb;
        overlay.classList.add('cha-modal-open');
      };
    })();
    </script>

    <div class="wrap cha-page">
        <div class="cha-header">
            <div class="cha-header-brand">
                <div class="cha-header-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </div>
                <div>
                    <h1 class="cha-header-title">CHA Members</h1>
                    <p class="cha-header-sub"><?php echo $count; ?> registered &bull; Cambodian Haemophilia Association</p>
                </div>
            </div>
            <div class="cha-header-actions">
                <a href="<?php echo admin_url('admin.php?page=cha-members&smtp=1'); ?>" class="cha-btn" style="background:rgba(255,255,255,0.1);color:#fff;font-size:0.75rem;padding:7px 12px;white-space:nowrap;display:inline-flex;align-items:center;gap:5px;border:1px solid rgba(255,255,255,0.15);" title="SMTP Settings">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    SMTP
                </a>
                <a href="<?php echo admin_url('admin.php?page=cha-members&add=1'); ?>" class="cha-btn" style="background:#166534;color:#fff;border:1px solid rgba(255,255,255,0.1);">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Add New Member
                </a>
                <a href="<?php echo admin_url('admin.php?page=cha-members&cha_export_csv=1'); ?>" class="cha-btn cha-btn-export">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Export CSV
                </a>
            </div>
        </div>

        <?php if (isset($_GET['smtp'])): ?>
            <?php $smtp = cha_get_smtp_settings(); ?>
            <div class="cha-edit-wrap" style="max-width:740px;">
                <div class="cha-smtp-card">
                    <div class="cha-smtp-hero">
                        <div class="cha-smtp-hero-left">
                            <div class="cha-smtp-brand-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <div>
                                <h2 class="cha-smtp-hero-title">
                                    SMTP Email Settings
                                    <span style="font-size:0.75rem;font-weight:700;padding:2px 8px;border-radius:6px;background:#EFF6FF;color:var(--cha-blue);letter-spacing:0.02em;">Brevo Relay</span>
                                </h2>
                                <p class="cha-smtp-hero-sub">Manage transactional email delivery for member verification and admin alerts.</p>
                            </div>
                        </div>
                        <div>
                            <span class="cha-smtp-status-badge <?php echo !empty($smtp['enabled']) ? 'is-active' : 'is-inactive'; ?>">
                                <?php echo !empty($smtp['enabled']) ? 'SMTP Active' : 'SMTP Disabled'; ?>
                            </span>
                        </div>
                    </div>

                    <form method="post" action="admin.php?page=cha-members&smtp=1">
                        <?php wp_nonce_field('cha_save_smtp', 'cha_smtp_nonce'); ?>

                        <!-- Section 1: Server Connection -->
                        <div class="cha-smtp-group">
                            <div class="cha-smtp-group-header">
                                <h3 class="cha-smtp-group-title">
                                    <span class="cha-smtp-group-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"/><rect x="2" y="14" width="20" height="8" rx="2" ry="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg>
                                    </span>
                                    Server Connection
                                </h3>
                                <label class="cha-smtp-toggle">
                                    <input type="checkbox" name="smtp_enabled" value="1" <?php checked($smtp['enabled']); ?>>
                                    <span class="cha-smtp-toggle-track"></span>
                                    <span class="cha-smtp-toggle-text">Enable Outgoing SMTP</span>
                                </label>
                            </div>
                            <div class="cha-edit-grid-2">
                                <div class="cha-edit-field">
                                    <label>SMTP Host <span class="field-hint">e.g. smtp-relay.brevo.com</span></label>
                                    <input type="text" name="smtp_host" value="<?php echo esc_attr($smtp['host']); ?>" placeholder="smtp-relay.brevo.com" required>
                                </div>
                                <div class="cha-edit-field">
                                    <label>Port <span class="field-hint">TLS: 587 or 465</span></label>
                                    <input type="number" name="smtp_port" value="<?php echo esc_attr($smtp['port']); ?>" placeholder="587" required>
                                </div>
                                <div class="cha-edit-field">
                                    <label>SMTP Username / Login</label>
                                    <input type="text" name="smtp_user" value="<?php echo esc_attr($smtp['username']); ?>" placeholder="Brevo login or SMTP user" required>
                                </div>
                                <div class="cha-edit-field">
                                    <label>Password / Master API Key</label>
                                    <div style="position:relative;">
                                        <input type="password" name="smtp_pass" id="smtp_pass" value="<?php echo esc_attr($smtp['password']); ?>" style="padding-right:40px;" placeholder="Brevo SMTP key">
                                        <button type="button" onclick="var p=document.getElementById('smtp_pass');p.type=p.type==='password'?'text':'password';this.innerHTML=p.type==='password'?'<svg width=16 height=16 viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'#64748b\' stroke-width=2 stroke-linecap=round stroke-linejoin=round><path d=\'M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\'/><circle cx=\'12\' cy=\'12\' r=\'3\'/></svg>':'<svg width=16 height=16 viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'#64748b\' stroke-width=2 stroke-linecap=round stroke-linejoin=round><path d=\'M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24\'/><line x1=\'1\' y1=\'1\' x2=\'23\' y2=\'23\'/></svg>';this.blur();" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:4px;display:flex;align-items:center;color:#64748B;" title="Toggle visibility">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Sender Identity -->
                        <div class="cha-smtp-group">
                            <div class="cha-smtp-group-header">
                                <h3 class="cha-smtp-group-title">
                                    <span class="cha-smtp-group-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    </span>
                                    Sender Identity
                                </h3>
                            </div>
                            <div class="cha-edit-grid-2">
                                <div class="cha-edit-field">
                                    <label>From Email Address <span class="field-hint">Authorized Brevo sender</span></label>
                                    <input type="email" name="smtp_from" value="<?php echo esc_attr($smtp['from_email']); ?>" placeholder="noreply@chacambodia.org" required>
                                </div>
                                <div class="cha-edit-field">
                                    <label>From Name <span class="field-hint">Displayed in inbox</span></label>
                                    <input type="text" name="smtp_from_name" value="<?php echo esc_attr($smtp['from_name']); ?>" placeholder="CHA Cambodia" required>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Admin Notifications -->
                        <div class="cha-smtp-group">
                            <div class="cha-smtp-group-header">
                                <h3 class="cha-smtp-group-title">
                                    <span class="cha-smtp-group-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                                    </span>
                                    Admin Notifications
                                </h3>
                                <label class="cha-smtp-toggle">
                                    <input type="checkbox" name="admin_notify_enabled" value="1" <?php checked($smtp['admin_notify_enabled']); ?>>
                                    <span class="cha-smtp-toggle-track"></span>
                                    <span class="cha-smtp-toggle-text">Notify Admin on Registration</span>
                                </label>
                            </div>
                            <div class="cha-edit-field">
                                <label>Recipient Email Address <span class="field-hint">Leave blank to use WordPress default admin email</span></label>
                                <input type="email" name="admin_notify_email" value="<?php echo esc_attr($smtp['admin_notify_email']); ?>" placeholder="<?php echo esc_attr(get_option('admin_email')); ?>">
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="cha-smtp-footer">
                            <button type="button" id="cha-view-log-btn" class="cha-smtp-log-btn">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                View SMTP Debug Log
                            </button>
                            <div style="display:flex;align-items:center;gap:12px;">
                                <a href="<?php echo admin_url('admin.php?page=cha-members'); ?>" class="cha-btn-back-clean">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                                    Back to Members
                                </a>
                                <button type="submit" name="cha_update_smtp" class="cha-smtp-save-btn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                    Save Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <script>
            document.getElementById('cha-view-log-btn').addEventListener('click', function() {
                window.open('<?php echo admin_url('admin-ajax.php?action=cha_view_smtp_log'); ?>', '_blank', 'width=700,height=500');
            });
            </script>
        <?php endif; ?>

        <?php if ($editing && $edit_member): ?>
            <div class="cha-edit-wrap">
                <div class="cha-edit-card">
                    <div class="cha-edit-header">
                        <?php if (!empty($edit_member['photo'])): ?>
                            <img src="<?php echo esc_url($edit_member['photo']); ?>" alt="<?php echo esc_attr($edit_member['name'] ?? 'Member'); ?>" class="cha-edit-avatar">
                        <?php else: ?>
                            <div class="cha-edit-avatar-placeholder">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                        <?php endif; ?>
                        <div class="cha-edit-title-block">
                            <h2>Edit Member &middot; <?php echo esc_html($edit_member['name']); ?></h2>
                            <p class="cha-edit-sub">
                                <span>ID: <strong class="cha-id-tag"><?php echo esc_html($edit_member['memberId'] ?? '—'); ?></strong></span>
                                <span>&bull;</span>
                                <span>Joined <?php echo esc_html($edit_member['memberSince'] ?? '—'); ?></span>
                                <?php if (($edit_member['status'] ?? '') === 'active'): ?>
                                    <span style="background:#ECFDF5;color:#166534;font-size:0.75rem;padding:2px 8px;border-radius:999px;font-weight:700;">Active</span>
                                <?php else: ?>
                                    <span style="background:#FFFBEB;color:#B45309;font-size:0.75rem;padding:2px 8px;border-radius:999px;font-weight:700;">Pending</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <form method="post" action="admin.php?page=cha-members">
                        <?php wp_nonce_field('cha_edit_member', 'cha_edit_nonce'); ?>
                        <input type="hidden" name="member_id" value="<?php echo esc_attr($edit_member['memberId']); ?>">

                        <?php
                        $current_role = $edit_member['role'] ?? 'Member';
                        $is_patient = ($current_role === 'Patient');
                        ?>

                        <!-- Role Section -->
                        <div class="cha-section-box">
                            <div class="cha-section-box-header">
                                <div class="cha-section-box-icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                </div>
                                <h3 class="cha-section-box-title">Membership Category</h3>
                            </div>
                            <div class="cha-role-grid">
                                <label class="cha-role-card <?php echo !$is_patient ? 'is-selected' : ''; ?>" data-role-card="Member">
                                    <input type="radio" name="role" value="Member" <?php echo !$is_patient ? 'checked' : ''; ?> style="display:none">
                                    <div class="cha-role-radio-custom">
                                        <div class="cha-role-radio-dot"></div>
                                    </div>
                                    <div class="cha-role-card-text">
                                        <strong>General Member</strong>
                                        <span>Supporter, family member, or community advocate</span>
                                    </div>
                                </label>
                                <label class="cha-role-card <?php echo $is_patient ? 'is-selected' : ''; ?>" data-role-card="Patient">
                                    <input type="radio" name="role" value="Patient" <?php echo $is_patient ? 'checked' : ''; ?> style="display:none">
                                    <div class="cha-role-radio-custom">
                                        <div class="cha-role-radio-dot"></div>
                                    </div>
                                    <div class="cha-role-card-text">
                                        <strong>Patient</strong>
                                        <span>Diagnosed with haemophilia or bleeding disorder</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- General Information Section -->
                        <div class="cha-section-box">
                            <div class="cha-section-box-header">
                                <div class="cha-section-box-icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </div>
                                <h3 class="cha-section-box-title">General Information</h3>
                            </div>
                            <div class="cha-edit-grid-2">
                                <div class="cha-edit-field">
                                    <label for="name">Full Name (English) <span style="color:#DC2626">*</span></label>
                                    <input type="text" id="name" name="name" value="<?php echo esc_attr($edit_member['name'] ?? ''); ?>" placeholder="e.g. John Doe" required>
                                </div>
                                <div class="cha-edit-field">
                                    <label for="name_khmer" class="km-label">ឈ្មោះខ្មែរ (Khmer Name)</label>
                                    <input type="text" id="name_khmer" name="name_khmer" class="km-input" value="<?php echo esc_attr($edit_member['nameKhmer'] ?? ''); ?>" placeholder="ឧ. ចន ដូ">
                                </div>
                                <div class="cha-edit-field">
                                    <label for="email">Email Address <span style="color:#DC2626">*</span></label>
                                    <input type="email" id="email" name="email" value="<?php echo esc_attr($edit_member['email'] ?? ''); ?>" placeholder="name@example.com" required>
                                </div>
                                <div class="cha-edit-field">
                                    <label for="phone">Phone Number <span class="field-hint">Numbers only</span></label>
                                    <input type="tel" id="phone" name="phone" value="<?php echo esc_attr($edit_member['phone'] ?? ''); ?>" placeholder="012345678" pattern="[0-9+ -]{7,20}" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9+]/g, '');">
                                </div>
                                <div class="cha-edit-field cha-field-full">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" value="<?php echo esc_attr($edit_member['address'] ?? ''); ?>" placeholder="House #, Street, Sangkat, Khan, Province">
                                </div>
                                <div class="cha-edit-field cha-field-full">
                                    <label for="new_password">New Password <span class="field-hint">Leave blank to keep existing password</span></label>
                                    <input type="password" id="new_password" name="new_password" placeholder="Enter new password (optional)">
                                </div>
                            </div>
                        </div>

                        <!-- Patient Details (Conditional) -->
                        <div id="admin-patient-fields" class="cha-section-box" style="display:<?php echo $is_patient ? 'block' : 'none' ?>;">
                            <div class="cha-section-box-header">
                                <div class="cha-section-box-icon" style="background:rgba(227,30,36,0.1);color:var(--cha-red);">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                                </div>
                                <h3 class="cha-section-box-title" style="color:var(--cha-red);">Medical &amp; Patient Details</h3>
                            </div>
                            <div class="cha-edit-grid-2">
                                <div class="cha-edit-field">
                                    <label for="dob">Date of Birth</label>
                                    <input type="text" id="dob" name="dob" value="<?php echo esc_attr($edit_member['dob'] ?? ''); ?>" placeholder="DD/MM/YYYY">
                                </div>
                                <div class="cha-edit-field">
                                    <label for="bloodType">Blood Type</label>
                                    <select id="bloodType" name="bloodType">
                                        <option value="">Select blood type</option>
                                        <?php foreach (array('A+','A-','B+','B-','AB+','AB-','O+','O-') as $bt): ?>
                                            <option value="<?php echo $bt; ?>" <?php echo ($edit_member['bloodType'] ?? '') === $bt ? 'selected' : ''; ?>><?php echo $bt; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="cha-edit-field cha-field-full">
                                    <label for="condition">Diagnosed Bleeding Condition</label>
                                    <input type="text" id="condition" name="condition" value="<?php echo esc_attr($edit_member['condition'] ?? ''); ?>" placeholder="e.g. Severe Hemophilia A, Factor IX Deficiency">
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="cha-edit-actions">
                            <a href="admin.php?page=cha-members" class="cha-btn-back-clean">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                                Back to Member List
                            </a>
                            <button type="submit" name="cha_update_member" class="cha-btn-save-main">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                Save Changes
                            </button>
                        </div>
                    </form>

                    <script>
                    (function() {
                        var patientFields = document.getElementById('admin-patient-fields');
                        var cards = document.querySelectorAll('.cha-role-card');
                        cards.forEach(function(card) {
                            card.addEventListener('click', function() {
                                cards.forEach(function(c) { c.classList.remove('is-selected'); });
                                card.classList.add('is-selected');
                                var radio = card.querySelector('input[type="radio"]');
                                if (radio) {
                                    radio.checked = true;
                                    var isPatient = (radio.value === 'Patient');
                                    if (patientFields) patientFields.style.display = isPatient ? 'block' : 'none';
                                }
                            });
                        });
                    })();
                    </script>
                </div>
            </div>
        <?php elseif ($adding): ?>
            <div class="cha-edit-wrap">
                <div class="cha-edit-card">
                    <div class="cha-edit-header">
                        <div class="cha-edit-avatar-placeholder" style="background:#EFF6FF;border-color:#BFDBFE;color:var(--cha-blue);">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </div>
                        <div class="cha-edit-title-block">
                            <h2>Add New Member</h2>
                            <p class="cha-edit-sub">Enter member profile details and assign their membership tier.</p>
                        </div>
                    </div>

                    <form method="post" action="admin.php?page=cha-members&add=1">
                        <?php wp_nonce_field('cha_edit_member', 'cha_edit_nonce'); ?>

                        <!-- Role Section -->
                        <div class="cha-section-box">
                            <div class="cha-section-box-header">
                                <div class="cha-section-box-icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                </div>
                                <h3 class="cha-section-box-title">Membership Category</h3>
                            </div>
                            <div class="cha-role-grid">
                                <label class="cha-role-card is-selected" data-role-card="Member">
                                    <input type="radio" name="role" value="Member" checked style="display:none">
                                    <div class="cha-role-radio-custom">
                                        <div class="cha-role-radio-dot"></div>
                                    </div>
                                    <div class="cha-role-card-text">
                                        <strong>General Member</strong>
                                        <span>Supporter, family member, or community advocate</span>
                                    </div>
                                </label>
                                <label class="cha-role-card" data-role-card="Patient">
                                    <input type="radio" name="role" value="Patient" style="display:none">
                                    <div class="cha-role-radio-custom">
                                        <div class="cha-role-radio-dot"></div>
                                    </div>
                                    <div class="cha-role-card-text">
                                        <strong>Patient</strong>
                                        <span>Diagnosed with haemophilia or bleeding disorder</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- General Information Section -->
                        <div class="cha-section-box">
                            <div class="cha-section-box-header">
                                <div class="cha-section-box-icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </div>
                                <h3 class="cha-section-box-title">General Information</h3>
                            </div>
                            <div class="cha-edit-grid-2">
                                <div class="cha-edit-field">
                                    <label for="add-name">Full Name (English) <span style="color:#DC2626">*</span></label>
                                    <input type="text" id="add-name" name="name" value="<?php echo esc_attr($add_form_name ?? ''); ?>" placeholder="e.g. John Doe" required>
                                </div>
                                <div class="cha-edit-field">
                                    <label for="add-name_khmer" class="km-label">ឈ្មោះខ្មែរ (Khmer Name)</label>
                                    <input type="text" id="add-name_khmer" name="name_khmer" class="km-input" placeholder="ឧ. ចន ដូ">
                                </div>
                                <div class="cha-edit-field">
                                    <label for="add-email">Email Address <span style="color:#DC2626">*</span></label>
                                    <input type="email" id="add-email" name="email" value="<?php echo esc_attr($add_form_email ?? ''); ?>" placeholder="name@example.com" required>
                                </div>
                                <div class="cha-edit-field">
                                    <label for="add-phone">Phone Number <span class="field-hint">Numbers only</span></label>
                                    <input type="tel" id="add-phone" name="phone" value="<?php echo esc_attr($add_form_phone ?? ''); ?>" placeholder="012345678" pattern="[0-9+ -]{7,20}" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9+]/g, '');">
                                </div>
                                <div class="cha-edit-field cha-field-full">
                                    <label for="add-address">Address</label>
                                    <input type="text" id="add-address" name="address" value="<?php echo esc_attr($add_form_address ?? ''); ?>" placeholder="House #, Street, Sangkat, Khan, Province">
                                </div>
                                <div class="cha-edit-field cha-field-full">
                                    <label for="add-password">Password <span class="field-hint">Leave blank to auto-generate a secure password</span></label>
                                    <input type="password" id="add-password" name="new_password" placeholder="Create password (optional)">
                                </div>
                            </div>
                        </div>

                        <!-- Patient Details (Conditional) -->
                        <div id="admin-add-patient-fields" class="cha-section-box" style="display:none;">
                            <div class="cha-section-box-header">
                                <div class="cha-section-box-icon" style="background:rgba(227,30,36,0.1);color:var(--cha-red);">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                                </div>
                                <h3 class="cha-section-box-title" style="color:var(--cha-red);">Medical &amp; Patient Details</h3>
                            </div>
                            <div class="cha-edit-grid-2">
                                <div class="cha-edit-field">
                                    <label for="add-dob">Date of Birth</label>
                                    <input type="text" id="add-dob" name="dob" placeholder="DD/MM/YYYY">
                                </div>
                                <div class="cha-edit-field">
                                    <label for="add-bloodType">Blood Type</label>
                                    <select id="add-bloodType" name="bloodType">
                                        <option value="">Select blood type</option>
                                        <?php foreach (array('A+','A-','B+','B-','AB+','AB-','O+','O-') as $bt): ?>
                                            <option value="<?php echo $bt; ?>"><?php echo $bt; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="cha-edit-field cha-field-full">
                                    <label for="add-condition">Diagnosed Bleeding Condition</label>
                                    <input type="text" id="add-condition" name="condition" placeholder="e.g. Severe Hemophilia A, Factor IX Deficiency">
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="cha-edit-actions">
                            <a href="admin.php?page=cha-members" class="cha-btn-back-clean">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                                Back to Member List
                            </a>
                            <button type="submit" name="cha_add_member" class="cha-btn-save-main">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                Create Member
                            </button>
                        </div>
                    </form>

                    <script>
                    (function() {
                        var patientFields = document.getElementById('admin-add-patient-fields');
                        var cards = document.querySelectorAll('.cha-role-card');
                        cards.forEach(function(card) {
                            card.addEventListener('click', function() {
                                cards.forEach(function(c) { c.classList.remove('is-selected'); });
                                card.classList.add('is-selected');
                                var radio = card.querySelector('input[type="radio"]');
                                if (radio) {
                                    radio.checked = true;
                                    var isPatient = (radio.value === 'Patient');
                                    if (patientFields) patientFields.style.display = isPatient ? 'block' : 'none';
                                }
                            });
                        });
                    })();
                    </script>
                </div>
            </div>
        <?php else: ?>
            <div class="cha-tabs">
                <a href="<?php echo admin_url('admin.php?page=cha-members'); ?>" class="cha-tab <?php echo ($active_filter === '' && $active_status === '') ? 'cha-active' : ''; ?>">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    All Members <span class="cha-tab-count"><?php echo $count; ?></span>
                </a>
                <?php
                $pending_count = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE status = 'pending'");
                if ($pending_count > 0): ?>
                    <a href="<?php echo admin_url('admin.php?page=cha-members&status_filter=pending'); ?>" class="cha-tab <?php echo $active_status === 'pending' ? 'cha-active' : ''; ?>" style="<?php echo $active_status === 'pending' ? 'background:#FFFBEB;color:#B45309;border:1px solid #FCD34D;' : ''; ?>" title="Show only unverified members">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="<?php echo $active_status === 'pending' ? 'stroke:#D97706;' : ''; ?>"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Pending Verification <span class="cha-tab-count" style="background:#F59E0B;color:#fff;font-weight:700;"><?php echo $pending_count; ?></span>
                    </a>
                <?php endif; ?>
            </div>

            <div style="margin-bottom:16px;">
                <div class="cha-search" style="margin-bottom:0;">
                    <svg class="cha-search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" id="cha-search-input" placeholder="Search by name, email, or ID..." oninput="chaFilterMembers(this.value)">
                </div>
            </div>
            <script>
            function chaFilterMembers(val) {
                var q = val.toLowerCase();
                var rows = document.querySelectorAll('.cha-table tbody tr');
                for (var i = 0; i < rows.length; i++) {
                    rows[i].style.display = rows[i].textContent.toLowerCase().indexOf(q) > -1 ? '' : 'none';
                }
            }
            </script>
            <?php if ($display_count === 0): ?>
                <div class="cha-table-wrap">
                    <div class="cha-empty">
                        <div class="cha-empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
                        <p><?php echo $active_status === 'pending' ? 'No pending unverified members found' : 'No members in this category yet'; ?></p>
                        <p class="cha-empty-sub"><?php echo $active_status === 'pending' ? 'All members are currently verified.' : 'Members will appear here once they register.'; ?></p>
                        <?php if ($active_status || $active_filter): ?>
                            <p style="margin-top:12px;"><a href="<?php echo admin_url('admin.php?page=cha-members'); ?>" class="cha-btn" style="background:var(--cha-blue);color:#fff;font-size:0.75rem;padding:6px 14px;">View All Members</a></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="cha-table-wrap">
                    <table class="cha-table">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Member</th>
                                <th>Contact</th>
                                <th>Role</th>
                                <th>Registered</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rows as $row): $rm = cha_row_to_rest($row); $rl = $rm['role'] ?? ''; ?>
                            <tr>
                                <td>
                                    <?php if (!empty($rm['photo'])): ?>
                                        <img class="cha-photo-thumb" src="<?php echo esc_url($rm['photo']); ?>" alt="<?php echo esc_attr($rm['name'] ?? 'Member'); ?>" loading="lazy">
                                    <?php else: ?>
                                        <span class="cha-photo-thumb cha-photo-empty" title="No photo"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="cha-id"><?php echo esc_html($rm['memberId'] ?? '—'); ?></div>
                                    <div class="cha-name">
                                        <?php if (($rm['status'] ?? '') === 'active'): ?>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px;"><polyline points="20 6 9 17 4 12"/></svg>
                                        <?php else: ?>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        <?php endif; ?>
                                        <?php echo esc_html($rm['name'] ?? '—'); ?>
                                    </div>
                                    <?php if (!empty($rm['nameKhmer'])): ?>
                                        <div class="cha-name-km"><?php echo esc_html($rm['nameKhmer']); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="cha-email"><?php echo esc_html($rm['email'] ?? '—'); ?></div>
                                    <div style="font-size:0.75rem;color:var(--cha-muted);"><?php echo esc_html($rm['phone'] ?? ''); ?></div>
                                </td>
                                <td>
                                    <?php
                                    $badge_class = 'cha-badge-patient';
                                    $badge_text  = 'Member';
                                    if ($rl === 'Patient') { $badge_class = 'cha-badge-patient'; $badge_text = 'Patient'; }
                                    elseif ($rl === 'Family member / Caregiver') { $badge_class = 'cha-badge-caregiver'; $badge_text = 'Caregiver'; }
                                    elseif ($rl === 'Healthcare professional') { $badge_class = 'cha-badge-professional'; $badge_text = 'Healthcare Prof.'; }
                                    elseif ($rl === 'Member') { $badge_class = 'cha-badge-member'; $badge_text = 'Member'; }
                                    ?>
                                    <span class="cha-badge <?php echo esc_attr($badge_class); ?>"><?php echo esc_html($badge_text); ?></span>
                                </td>
                                <td><span class="cha-registered"><?php echo esc_html($rm['registered'] ?? '—'); ?></span></td>
                                <td class="cha-actions">
                                    <a href="admin.php?page=cha-members&edit=<?php echo esc_attr($rm['memberId'] ?? ''); ?>" class="cha-action-btn cha-action-edit">Edit</a>
                                    <?php if (($rm['status'] ?? '') === 'pending'): ?>
                                        <a href="admin.php?page=cha-members&verify=<?php echo esc_attr($rm['memberId'] ?? ''); ?>&cha_verify_nonce=<?php echo wp_create_nonce('cha_verify_member'); ?>" class="cha-action-btn" style="background:#16a34a;color:#fff;border-color:#16a34a;">Verify</a>
                                    <?php endif; ?>
                                    <a href="admin.php?page=cha-members&delete=<?php echo esc_attr($rm['memberId'] ?? ''); ?>&cha_delete_nonce=<?php echo wp_create_nonce('cha_delete_member'); ?>" class="cha-action-btn cha-action-delete" onclick="event.preventDefault();var t=this;chaConfirm('Delete Member','Are you sure you want to delete <?php echo esc_js($rm['name'] ?? 'this member'); ?>? This cannot be undone.','Delete',function(){window.location.href=t.href;});">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($total_pages > 1): ?>
                <div class="cha-pagination">
                    <?php
                    $page_url = admin_url('admin.php?page=cha-members') . ($active_filter ? '&role_filter=' . urlencode($active_filter) : '') . ($active_status ? '&status_filter=' . urlencode($active_status) : '');
                    for ($i = 1; $i <= $total_pages; $i++):
                        if ($i === $current_page):
                            echo '<span class="cha-page cha-page-current">' . $i . '</span>';
                        else:
                            echo '<a href="' . esc_url($page_url . '&paged=' . $i) . '" class="cha-page">' . $i . '</a>';
                        endif;
                    endfor;
                    ?>
                    <span class="cha-page-total"><?php echo $total_members; ?> members</span>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <?php
}

function cha_render_donations_page() {
    // Handle PayWay settings save
    if (isset($_POST['cha_update_payway']) && current_user_can('manage_options')) {
        if (!isset($_POST['cha_payway_nonce']) || !wp_verify_nonce($_POST['cha_payway_nonce'], 'cha_save_payway')) {
            wp_die('Security check failed.');
        }
        update_option('cha_payway_settings', array(
            'sandbox_merchant_id'    => sanitize_text_field($_POST['payway_sandbox_merchant_id'] ?? ''),
            'sandbox_api_key'        => sanitize_text_field($_POST['payway_sandbox_api_key'] ?? ''),
            'production_merchant_id' => sanitize_text_field($_POST['payway_production_merchant_id'] ?? ''),
            'production_api_key'     => sanitize_text_field($_POST['payway_production_api_key'] ?? ''),
            'mode'                   => ($_POST['payway_mode'] ?? 'sandbox') === 'production' ? 'production' : 'sandbox',
            'enabled'                => isset($_POST['payway_enabled']),
        ));
        echo '<div class="updated"><p>PayWay settings saved.</p></div>';
    }

    // Handle CSV export
    if (isset($_GET['cha_don_export_csv']) && current_user_can('manage_options')) {
        global $wpdb;
        cha_ensure_donations_table();
        $don_table = cha_get_donations_table();
        $rows_d = $wpdb->get_results("SELECT * FROM $don_table ORDER BY created_at DESC");
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=cha-donations-' . date('Y-m-d') . '.csv');
        $out = fopen('php://output', 'w');
        fputcsv($out, array('Receipt', 'Donor', 'Email', 'Phone', 'Amount', 'Currency', 'Status', 'APV', 'Date'));
        foreach ($rows_d as $d) {
            fputcsv($out, array($d->tran_id, $d->name, $d->email, $d->phone, $d->amount, $d->currency, $d->status, $d->apv, $d->created_at));
        }
        fclose($out);
        exit;
    }

    global $wpdb;
    cha_ensure_donations_table();
    $don_table = cha_get_donations_table();

    // Auto-delete pending donations older than 12 hours
    $wpdb->query("DELETE FROM $don_table WHERE status = 'pending' AND created_at < DATE_SUB(NOW(), INTERVAL 12 HOUR)");

    // Migrate old-format receipt IDs (CHA260910...) to short format (CHA-2609-XXXX)
    $old_ids = $wpdb->get_col("SELECT tran_id FROM $don_table WHERE tran_id REGEXP '^CHA[0-9]{14,}'");
    if (!empty($old_ids)) {
        foreach ($old_ids as $old_id) {
            $parts = array();
            if (preg_match('/^CHA(\d{2})(\d{2})\d{10}(\d{4})$/', $old_id, $parts)) {
                $new_id = 'CHA-' . $parts[1] . $parts[2] . '-' . $parts[3];
                $wpdb->query($wpdb->prepare("UPDATE $don_table SET tran_id = %s WHERE tran_id = %s", $new_id, $old_id));
            }
        }
    }

    $per_page = 10;
    $current_page = max(1, intval($_GET['don_page'] ?? 1));
    $total_rows = $wpdb->get_var("SELECT COUNT(*) FROM $don_table");
    $total_pages = max(1, ceil($total_rows / $per_page));
    if ($current_page > $total_pages) $current_page = $total_pages;
    $offset = ($current_page - 1) * $per_page;
    $don_rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $don_table ORDER BY created_at DESC LIMIT %d OFFSET %d", $per_page, $offset));
    $totals = $wpdb->get_row("SELECT COUNT(*) AS total, COALESCE(SUM(CASE WHEN status='completed' THEN amount END),0) AS completed_sum, SUM(CASE WHEN status='completed' THEN 1 ELSE 0 END) AS completed_count, SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) AS pending_count FROM $don_table");
    $payway = cha_get_payway_settings();
    ?>
    <style>
        .cha-don-header{background:linear-gradient(135deg,#0B1D6D 0%,#1a3a8a 50%,#6A2C91 100%);border-radius:12px;padding:28px 32px;color:#fff;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;}
        .cha-don-header h1{font-size:1.5rem;font-weight:700;margin:0;display:flex;align-items:center;gap:10px;}
        .cha-don-header p{font-size:0.8125rem;margin:4px 0 0;opacity:0.8;}
        .cha-don-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;}
        .cha-don-stat{background:#fff;border:1px solid #e5e7eb;border-radius:10px;padding:18px 20px;display:flex;align-items:center;gap:14px;transition:box-shadow .15s;}
        .cha-don-stat:hover{box-shadow:0 2px 8px rgba(0,0,0,0.06);}
        .cha-don-stat-icon{width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .cha-don-stat-value{font-size:1.4rem;font-weight:700;line-height:1.2;}
        .cha-don-stat-label{font-size:0.75rem;color:#6b7280;margin-top:2px;}
        .cha-don-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:24px;margin-bottom:24px;box-shadow:0 1px 3px rgba(0,0,0,0.04);}
        .cha-don-card h2{font-size:1rem;font-weight:700;margin:0 0 16px;display:flex;align-items:center;gap:8px;}
        .cha-don-toggle{display:flex;align-items:center;gap:10px;padding:14px 16px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;cursor:pointer;user-select:none;margin-bottom:16px;}
        .cha-don-toggle:hover{background:#f1f5f9;}
        .cha-don-toggle svg{transition:transform .2s;flex-shrink:0;}
        .cha-don-toggle-label{font-weight:600;font-size:0.875rem;}
        .cha-don-toggle-desc{font-size:0.75rem;color:#6b7280;margin-top:2px;}
        .cha-don-settings{display:none;max-height:0;overflow:hidden;transition:max-height .3s ease,opacity .2s ease;opacity:0;}
        .cha-don-settings.open{display:block;max-height:600px;opacity:1;}
        .cha-don-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
        .cha-don-field label{display:block;font-size:0.75rem;font-weight:600;color:#374151;margin-bottom:4px;}
        .cha-don-field input,.cha-don-field select{width:100%;box-sizing:border-box;}
        .cha-don-table{width:100%;border-collapse:separate;border-spacing:0;}
        .cha-don-table th{text-align:left;font-size:0.6875rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#6b7280;padding:10px 14px;border-bottom:2px solid #e5e7eb;background:#f9fafb;}
        .cha-don-table td{padding:12px 14px;border-bottom:1px solid #f3f4f6;font-size:0.8125rem;vertical-align:middle;}
        .cha-don-table tr:hover td{background:#f9fafb;}
        .cha-don-badge{display:inline-block;padding:3px 10px;border-radius:12px;font-size:0.6875rem;font-weight:600;}
        .cha-don-empty{text-align:center;padding:48px 20px;color:#9CA3AF;}
        .cha-don-pagination{display:flex;align-items:center;justify-content:center;gap:6px;margin-top:20px;}
        .cha-don-pagination a,.cha-don-pagination span{padding:6px 12px;border-radius:6px;font-size:0.8125rem;text-decoration:none;border:1px solid #e5e7eb;color:#374151;background:#fff;transition:all .15s;}
        .cha-don-pagination a:hover{background:#f3f4f6;}
        .cha-don-pagination .current{background:#0B1D6D;color:#fff;border-color:#0B1D6D;}
        @media(max-width:900px){.cha-don-stats{grid-template-columns:1fr 1fr;}.cha-don-grid{grid-template-columns:1fr;}}
        @media(max-width:600px){.cha-don-stats{grid-template-columns:1fr;}.cha-don-header{flex-direction:column;align-items:flex-start;}}
    </style>

    <div style="max-width:1100px;margin:20px auto;">
        <!-- Header -->
        <div class="cha-don-header">
            <div>
                <h1 style="color:#fff;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    Donations
                </h1>
                <p>Track donations and manage PayWay payment gateway</p>
            </div>
            <div style="display:flex;gap:10px;align-items:center;">
                <button type="button" id="cha-pw-toggle-btn" onclick="document.getElementById('cha-pw-settings').classList.toggle('open');" style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.2);border-radius:8px;font-size:0.8125rem;font-weight:600;cursor:pointer;white-space:nowrap;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                    PayWay Settings
                </button>
                <a href="admin.php?page=cha-donations&cha_don_export_csv=1" style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.2);border-radius:8px;font-size:0.8125rem;font-weight:600;text-decoration:none;white-space:nowrap;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Export CSV
                </a>
            </div>
        </div>

        <!-- PayWay Settings (slides down from header) -->
        <div class="cha-don-settings" id="cha-pw-settings" style="margin-bottom:24px;">
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                    <h2 style="font-size:1rem;font-weight:700;margin:0;display:flex;align-items:center;gap:8px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0B1D6D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                        PayWay Gateway (ABA) &mdash; <?php echo $payway['enabled'] ? '<span style="color:#166534;">Enabled</span>' : '<span style="color:#dc2626;">Disabled</span>'; ?>
                    </h2>
                    <button type="button" onclick="document.getElementById('cha-pw-settings').classList.remove('open');" style="background:none;border:none;cursor:pointer;padding:4px;display:flex;align-items:center;color:#9CA3AF;" title="Close">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
                <form method="post" action="admin.php?page=cha-donations">
                    <?php wp_nonce_field('cha_save_payway', 'cha_payway_nonce'); ?>
                    <div style="margin-bottom:16px;">
                        <label style="display:block;font-size:0.75rem;font-weight:600;color:#374151;margin-bottom:6px;">Mode</label>
                        <select name="payway_mode" style="width:280px;" onchange="document.getElementById('pw-sandbox-fields').style.display=this.value==='sandbox'?'block':'none';document.getElementById('pw-production-fields').style.display=this.value==='production'?'block':'none';">
                            <option value="sandbox" <?php selected($payway['mode'], 'sandbox'); ?>>Sandbox (testing)</option>
                            <option value="production" <?php selected($payway['mode'], 'production'); ?>>Production (live)</option>
                        </select>
                    </div>

                    <div id="pw-sandbox-fields" style="display:<?php echo $payway['mode'] === 'sandbox' ? 'block' : 'none'; ?>;">
                        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:16px;margin-bottom:12px;">
                            <div style="font-weight:600;font-size:0.8125rem;color:#166534;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#166534" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                Sandbox Credentials
                            </div>
                            <div class="cha-don-grid">
                                <div class="cha-don-field">
                                    <label>Merchant ID</label>
                                    <input type="text" name="payway_sandbox_merchant_id" value="<?php echo esc_attr($payway['sandbox_merchant_id']); ?>" placeholder="e.g. ec476057">
                                </div>
                                <div class="cha-don-field">
                                    <label>API Key</label>
                                    <div style="position:relative;">
                                        <input type="password" name="payway_sandbox_api_key" id="pw_sb_key" value="<?php echo esc_attr($payway['sandbox_api_key']); ?>" style="padding-right:36px;">
                                        <button type="button" onclick="var p=document.getElementById('pw_sb_key');p.type=p.type==='password'?'text':'password';this.blur();" style="position:absolute;right:8px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:4px;display:flex;align-items:center;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="pw-production-fields" style="display:<?php echo $payway['mode'] === 'production' ? 'block' : 'none'; ?>;">
                        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:16px;margin-bottom:12px;">
                            <div style="font-weight:600;font-size:0.8125rem;color:#991b1b;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#991b1b" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                Production Credentials
                            </div>
                            <div class="cha-don-grid">
                                <div class="cha-don-field">
                                    <label>Merchant ID</label>
                                    <input type="text" name="payway_production_merchant_id" value="<?php echo esc_attr($payway['production_merchant_id']); ?>" placeholder="Enter production merchant ID">
                                </div>
                                <div class="cha-don-field">
                                    <label>API Key</label>
                                    <div style="position:relative;">
                                        <input type="password" name="payway_production_api_key" id="pw_prod_key" value="<?php echo esc_attr($payway['production_api_key']); ?>" style="padding-right:36px;">
                                        <button type="button" onclick="var p=document.getElementById('pw_prod_key');p.type=p.type==='password'?'text':'password';this.blur();" style="position:absolute;right:8px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:4px;display:flex;align-items:center;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:16px;padding-top:16px;border-top:1px solid #f3f4f6;">
                        <div style="display:flex;align-items:center;gap:16px;">
                            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:0.8125rem;font-weight:500;">
                                <input type="checkbox" name="payway_enabled" value="1" <?php checked($payway['enabled']); ?>>
                                Enable donations
                            </label>
                            <button type="button" id="cha-test-hash-btn" style="background:none;border:none;color:#6b7280;font-size:0.8125rem;font-weight:600;cursor:pointer;padding:0;display:inline-flex;align-items:center;gap:4px;">
                                Test API Key
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </button>
                        </div>
                        <button type="submit" name="cha_update_payway" class="button button-primary" style="background:#166534;border-color:#166534;border-radius:6px;">Save Settings</button>
                    </div>
                </form>
                <script>
                (function(){
                    var btn = document.getElementById('cha-test-hash-btn');
                    if (!btn) return;
                    var restUrl = <?php echo wp_json_encode(rest_url('cha/v1/')); ?>;
                    var nonce = <?php echo wp_json_encode(wp_create_nonce('wp_rest')); ?>;
                    btn.addEventListener('click', function(){
                        var mode = document.querySelector('select[name="payway_mode"]').value;
                        var keyId = mode === 'sandbox' ? 'pw_sb_key' : 'pw_prod_key';
                        var key = document.getElementById(keyId);
                        if (!key || !key.value) { alert('Enter an API key first.'); return; }
                        btn.disabled = true;
                        var orig = btn.innerHTML;
                        btn.innerHTML = 'Testing...';
                        fetch(restUrl + 'payway/test-hash', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': nonce },
                            body: JSON.stringify({})
                        }).then(function(r){ return r.json().then(function(d){ return { ok: r.ok, d: d }; }); })
                          .then(function(res){
                              if (res.ok && res.d.success) {
                                  alert('API key works. Sample hash: ' + res.d.sample_hash.slice(0, 24) + '...');
                              } else {
                                  alert((res.d && res.d.message) || 'Test failed. Check the API key.');
                              }
                          }).catch(function(){ alert('Network error. Please try again.'); })
                          .finally(function(){ btn.disabled = false; btn.innerHTML = orig; });
                    });
                })();
                </script>
            </div>
        </div>

        <!-- Stats -->
        <div class="cha-don-stats">
            <div class="cha-don-stat">
                <div class="cha-don-stat-icon" style="background:#ECFDF5;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#166534" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div>
                    <div class="cha-don-stat-value" style="color:#166534;">$<?php echo esc_html(number_format((float) $totals->completed_sum, 0)); ?></div>
                    <div class="cha-don-stat-label">Total Raised</div>
                </div>
            </div>
            <div class="cha-don-stat">
                <div class="cha-don-stat-icon" style="background:#EFF6FF;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div>
                    <div class="cha-don-stat-value" style="color:#1d4ed8;"><?php echo (int) $totals->completed_count; ?></div>
                    <div class="cha-don-stat-label">Completed</div>
                </div>
            </div>
            <div class="cha-don-stat">
                <div class="cha-don-stat-icon" style="background:#FEF3C7;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#92400E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <div class="cha-don-stat-value" style="color:#92400E;"><?php echo (int) $totals->pending_count; ?></div>
                    <div class="cha-don-stat-label">Pending</div>
                </div>
            </div>
            <div class="cha-don-stat">
                <div class="cha-don-stat-icon" style="background:#F3E8FF;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6A2C91" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                </div>
                <div>
                    <div class="cha-don-stat-value" style="color:#6A2C91;"><?php echo (int) $totals->total; ?></div>
                    <div class="cha-don-stat-label">Total Donors</div>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="cha-don-card">
            <h2>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0B1D6D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                Transaction History
            </h2>
            <?php if (empty($don_rows)): ?>
                <div class="cha-don-empty">
                    <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px;display:block;color:#D1D5DB;"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    <p style="font-weight:600;font-size:1rem;margin:0;">No donations yet</p>
                    <p style="font-size:0.8125rem;margin:6px 0 0;">Donations will appear here once donors complete a PayWay checkout.</p>
                </div>
            <?php else: ?>
                <div style="overflow-x:auto;">
                    <table class="cha-don-table">
                        <thead>
                            <tr>
                                <th>Receipt</th>
                                <th>Donor</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>APV</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($don_rows as $d): ?>
                            <tr>
                                <td><code style="font-size:0.75rem;background:#f1f5f9;padding:3px 8px;border-radius:4px;font-family:monospace;"><?php echo esc_html($d->tran_id); ?></code></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#0B1D6D,#6A2C91);color:#fff;display:flex;align-items:center;justify-content:center;font-size:0.6875rem;font-weight:700;flex-shrink:0;"><?php echo esc_html(mb_strtoupper(mb_substr($d->name ?: '?', 0, 1))); ?></div>
                                        <div>
                                            <div style="font-weight:600;"><?php echo esc_html($d->name ?: '—'); ?></div>
                                            <div style="font-size:0.75rem;color:#6b7280;"><?php echo esc_html($d->email ?: ''); ?></div>
                                            <?php if (!empty($d->phone)): ?>
                                                <div style="font-size:0.75rem;color:#9CA3AF;"><?php echo esc_html($d->phone); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight:700;color:#166534;">$<?php echo esc_html(number_format((float) $d->amount, 2)); ?></div>
                                    <div style="font-size:0.6875rem;color:#9CA3AF;"><?php echo esc_html($d->currency); ?></div>
                                </td>
                                <td>
                                    <?php
                                    $st = $d->status;
                                    $bg = $st === 'completed' ? '#ECFDF5' : ($st === 'pending' ? '#FEF3C7' : '#FEF2F2');
                                    $fg = $st === 'completed' ? '#166534' : ($st === 'pending' ? '#92400E' : '#991B1B');
                                    $dot = $st === 'completed' ? '#166534' : ($st === 'pending' ? '#D97706' : '#DC2626');
                                    ?>
                                    <span class="cha-don-badge" style="background:<?php echo $bg; ?>;color:<?php echo $fg; ?>;"><span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:<?php echo $dot; ?>;margin-right:5px;"></span><?php echo esc_html(ucfirst($st)); ?></span>
                                </td>
                                <td style="color:#6b7280;font-family:monospace;font-size:0.75rem;"><?php echo esc_html($d->apv ?: '—'); ?></td>
                                <td style="color:#6b7280;"><?php echo esc_html($d->created_at ?: '—'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($total_pages > 1): ?>
                <div class="cha-don-pagination">
                    <?php if ($current_page > 1): ?>
                        <a href="admin.php?page=cha-donations&don_page=<?php echo $current_page - 1; ?>">&larr; Prev</a>
                    <?php endif; ?>
                    <?php
                    $start_page = max(1, $current_page - 2);
                    $end_page = min($total_pages, $current_page + 2);
                    if ($start_page > 1): ?>
                        <a href="admin.php?page=cha-donations&don_page=1">1</a>
                        <?php if ($start_page > 2): ?><span style="color:#9CA3AF;padding:0 4px;">&hellip;</span><?php endif; ?>
                    <?php endif; ?>
                    <?php for ($p = $start_page; $p <= $end_page; $p++): ?>
                        <a href="admin.php?page=cha-donations&don_page=<?php echo $p; ?>" class="<?php echo $p === $current_page ? 'current' : ''; ?>"><?php echo $p; ?></a>
                    <?php endfor; ?>
                    <?php if ($end_page < $total_pages): ?>
                        <?php if ($end_page < $total_pages - 1): ?><span style="color:#9CA3AF;padding:0 4px;">&hellip;</span><?php endif; ?>
                        <a href="admin.php?page=cha-donations&don_page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a>
                    <?php endif; ?>
                    <?php if ($current_page < $total_pages): ?>
                        <a href="admin.php?page=cha-donations&don_page=<?php echo $current_page + 1; ?>">Next &rarr;</a>
                    <?php endif; ?>
                </div>
                <p style="text-align:center;font-size:0.75rem;color:#9CA3AF;margin-top:8px;">Page <?php echo $current_page; ?> of <?php echo $total_pages; ?> (<?php echo $total_rows; ?> total)</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

function cha_export_csv() {
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
    }
    $rows = cha_get_all_members();
    if (empty($rows)) {
        wp_die('No members to export.');
    }
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=cha-members-' . date('Y-m-d') . '.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Member ID', 'Name', 'Email', 'Phone', 'Registered', 'Status', 'Role', 'Photo URL'));
    foreach ($rows as $row) {
        $rm = cha_row_to_rest($row);
        fputcsv($output, array($rm['memberId'] ?? '', $rm['name'] ?? '', $rm['email'] ?? '', $rm['phone'] ?? '', $rm['registered'] ?? '', $rm['status'] ?? '', $rm['role'] ?? '', $rm['photo'] ?? ''));
    }
    fclose($output);
    exit;
}

function cha_handle_export() {
    if (isset($_GET['cha_export_csv']) && current_user_can('manage_options')) {
        cha_export_csv();
    }
}
add_action('admin_init', 'cha_handle_export');

