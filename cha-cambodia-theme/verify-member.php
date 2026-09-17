<?php
/**
 * Member / Patient Emergency Verification Page
 * Route: /verify-member?id=CHA-XXXX-XXXX
 * Loaded via template_redirect in functions.php
 */

if (!defined('ABSPATH')) {
    exit;
}

$member_id = sanitize_text_field($_GET['id'] ?? '');
$member = null;

if (!empty($member_id)) {
    $member = cha_get_member_by_id($member_id);
}

$site_name = get_bloginfo('name') ?: 'CHA Cambodia';

// Hospital hotlines
$hotline_nph = '012 751 728';
$hotline_ahc = '063 963 409';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $member ? 'Official Verification — ' . esc_html($member->name ?: $member->member_id) : 'Member Verification'; ?> — <?php echo esc_html($site_name); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&family=Poppins:wght@400;500;600;700&family=Siemreap&display=swap" rel="stylesheet">
    <style>
        :root {
            --c-blue: #0B1D6D;
            --c-blue-dark: #07134B;
            --c-red: #E31E24;
            --c-red-bg: #FEF2F2;
            --c-green: #10B981;
            --c-green-bg: #ECFDF5;
            --c-text: #1E293B;
            --c-muted: #64748B;
            --c-border: #E2E8F0;
            --c-bg: #F1F5F9;
            --font-main: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-km: 'Siemreap', 'Poppins', sans-serif;
            --font-koulen: 'Koulen', cursive;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--c-bg);
            color: var(--c-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 16px 40px;
            -webkit-font-smoothing: antialiased;
        }

        .verify-container {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
        }

        /* Top Bar */
        .verify-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 0 4px;
        }

        .verify-logo-link {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .verify-logo-link img {
            height: 46px;
            width: auto;
            object-fit: contain;
        }

        .verify-home-btn {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--c-blue);
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 9999px;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            border: 1px solid var(--c-border);
            transition: all 0.2s ease;
        }

        .verify-home-btn:hover {
            background: #F8FAFC;
            border-color: var(--c-blue);
        }

        /* Main Card */
        .verify-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px -5px rgba(11, 29, 109, 0.08), 0 4px 12px rgba(0,0,0,0.04);
            border: 1px solid rgba(226, 232, 240, 0.8);
            overflow: hidden;
            position: relative;
        }

        /* Status Banner */
        .status-banner {
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .status-banner.verified {
            background: linear-gradient(135deg, #0B1D6D 0%, #17329E 100%);
            color: #ffffff;
        }

        .status-banner.not-found {
            background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%);
            color: #ffffff;
        }

        .status-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .status-icon-wrap svg {
            width: 24px;
            height: 24px;
            stroke: #ffffff;
            stroke-width: 2.5;
            fill: none;
        }

        .status-text h1 {
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            line-height: 1.3;
        }

        .status-text p {
            font-size: 0.775rem;
            opacity: 0.9;
            margin-top: 2px;
            font-family: var(--font-km);
            line-height: 1.4;
        }

        /* Card Body */
        .card-body {
            padding: 24px;
        }

        /* Member Profile Header Row */
        .member-header-row {
            display: flex;
            align-items: center;
            gap: 18px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--c-border);
        }

        .member-avatar-wrap {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            background: #F8FAFC;
            border: 2px solid var(--c-border);
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .member-avatar-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .member-avatar-wrap svg {
            width: 36px;
            height: 36px;
            color: #94A3B8;
        }

        .member-main-info {
            flex: 1;
            min-width: 0;
        }

        .member-id-badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            background: #EFF6FF;
            color: var(--c-blue);
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 6px;
            letter-spacing: 0.05em;
            margin-bottom: 6px;
            border: 1px solid #DBEAFE;
        }

        .member-latin-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0F172A;
            line-height: 1.25;
            word-break: break-word;
        }

        .member-khmer-name {
            font-size: 1rem;
            color: var(--c-muted);
            font-family: var(--font-km);
            margin-top: 2px;
            line-height: 1.4;
        }

        /* Medical Highlight Box */
        .medical-highlights {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 20px 0;
        }

        .highlight-box {
            padding: 12px 14px;
            border-radius: 12px;
            background: #F8FAFC;
            border: 1px solid var(--c-border);
        }

        .highlight-box.primary-condition {
            background: #FFF1F2;
            border-color: #FFE4E6;
        }

        .highlight-box.blood-badge {
            background: #FEF2F2;
            border-color: #FECACA;
        }

        .highlight-label {
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--c-muted);
            margin-bottom: 4px;
            display: block;
        }

        .highlight-box.primary-condition .highlight-label {
            color: #BE123C;
        }

        .highlight-box.blood-badge .highlight-label {
            color: #B91C1C;
        }

        .highlight-value {
            font-size: 1rem;
            font-weight: 700;
            color: #0F172A;
            line-height: 1.3;
        }

        .highlight-box.primary-condition .highlight-value {
            color: #9F1239;
        }

        .highlight-box.blood-badge .highlight-value {
            color: #DC2626;
        }

        /* Detail List */
        .detail-table {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 10px;
            font-size: 0.875rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 8px 0;
            border-bottom: 1px dashed var(--c-border);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-title {
            color: var(--c-muted);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .detail-val {
            font-weight: 600;
            color: #0F172A;
            text-align: right;
            max-width: 60%;
        }

        /* Emergency Action Section */
        .emergency-section {
            margin-top: 24px;
            padding: 16px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 14px;
        }

        .emergency-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .emergency-header svg {
            width: 18px;
            height: 18px;
            color: #D97706;
            flex-shrink: 0;
        }

        .emergency-header h3 {
            font-size: 0.875rem;
            font-weight: 700;
            color: #92400E;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .emergency-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 10px;
        }

        .hotline-call-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px 8px;
            background: #ffffff;
            border: 1.5px solid #F59E0B;
            border-radius: 10px;
            text-decoration: none;
            color: #78350F;
            font-weight: 700;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .hotline-call-btn:hover {
            background: #FEF3C7;
            transform: translateY(-1px);
        }

        .hotline-call-btn span {
            font-size: 0.6875rem;
            font-weight: 500;
            color: #92400E;
            margin-top: 2px;
            font-family: var(--font-km);
        }

        /* Not Found View */
        .not-found-body {
            padding: 36px 24px;
            text-align: center;
        }

        .not-found-body p {
            color: var(--c-muted);
            font-size: 0.9375rem;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .btn-return {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--c-blue);
            color: #ffffff;
            text-decoration: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: background 0.2s ease;
        }

        .btn-return:hover {
            background: var(--c-blue-dark);
        }

        /* Footer */
        .verify-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 0.75rem;
            color: var(--c-muted);
            line-height: 1.5;
        }

        .verify-footer a {
            color: var(--c-blue);
            text-decoration: none;
            font-weight: 500;
        }

        .official-seal {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.6875rem;
            font-weight: 600;
            color: #059669;
            background: #ECFDF5;
            border: 1px solid #A7F3D0;
            padding: 4px 10px;
            border-radius: 9999px;
            margin-top: 12px;
        }
    </style>
</head>
<body>

<div class="verify-container">

    <!-- Top Navigation -->
    <div class="verify-topbar">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="verify-logo-link" title="CHA Cambodia Homepage">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/cha-logo-left.png'); ?>" alt="CHA Logo">
        </a>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="verify-home-btn">
            ← Visit Website
        </a>
    </div>

    <?php if ($member): ?>
        <!-- Valid Member Card -->
        <div class="verify-card">
            <div class="status-banner verified">
                <div class="status-icon-wrap">
                    <svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                </div>
                <div class="status-text">
                    <h1>Verified Member Record</h1>
                    <p>កំណត់ត្រាសមាជិកត្រូវបានផ្ទៀងផ្ទាត់ផ្លូវការ</p>
                </div>
            </div>

            <div class="card-body">
                <!-- Member Primary Header -->
                <div class="member-header-row">
                    <div class="member-avatar-wrap">
                        <?php if (!empty($member->photo)): ?>
                            <img src="<?php echo esc_url($member->photo); ?>" alt="<?php echo esc_attr($member->name ?: 'Member Photo'); ?>">
                        <?php else: ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <?php endif; ?>
                    </div>
                    <div class="member-main-info">
                        <span class="member-id-badge"><?php echo esc_html($member->member_id); ?></span>
                        <h2 class="member-latin-name"><?php echo esc_html($member->name ?: 'Registered Member'); ?></h2>
                        <?php if (!empty($member->name_khmer)): ?>
                            <div class="member-khmer-name"><?php echo esc_html($member->name_khmer); ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Primary Medical Highlights -->
                <div class="medical-highlights">
                    <div class="highlight-box primary-condition">
                        <span class="highlight-label">Condition / ស្ថានភាព</span>
                        <div class="highlight-value"><?php echo esc_html(!empty($member->condition) ? $member->condition : 'Hemophilia Patient'); ?></div>
                    </div>
                    <div class="highlight-box blood-badge">
                        <span class="highlight-label">Blood Type / ក្រុមឈាម</span>
                        <div class="highlight-value"><?php echo esc_html(!empty($member->blood_type) ? $member->blood_type : 'Not set'); ?></div>
                    </div>
                </div>

                <!-- Structured Detail Rows -->
                <div class="detail-table">
                    <div class="detail-row">
                        <span class="detail-title">Role / តួនាទី</span>
                        <span class="detail-val"><?php echo esc_html($member->role ?: 'Patient'); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-title">Date of Birth / ថ្ងៃខែឆ្នាំកំណើត</span>
                        <span class="detail-val"><?php echo esc_html(!empty($member->dob) ? $member->dob : '—'); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-title">Treatment Centre / មណ្ឌលព្យាបាល</span>
                        <span class="detail-val"><?php echo esc_html(!empty($member->treatment_centre) ? $member->treatment_centre : 'NPH / AHC Partner Centres'); ?></span>
                    </div>
                    <?php if (!empty($member->phone)): ?>
                    <div class="detail-row">
                        <span class="detail-title">Phone / ទូរស័ព្ទ</span>
                        <span class="detail-val"><?php echo esc_html($member->phone); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($member->address)): ?>
                    <div class="detail-row">
                        <span class="detail-title">Address / អាសយដ្ឋាន</span>
                        <span class="detail-val"><?php echo esc_html($member->address); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($member->province)): ?>
                    <div class="detail-row">
                        <span class="detail-title">Province / ខេត្ត-រាជធានី</span>
                        <span class="detail-val"><?php echo esc_html($member->province); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="detail-row">
                        <span class="detail-title">Member Status</span>
                        <span class="detail-val" style="color: #059669;">● Active</span>
                    </div>
                </div>

                <!-- Emergency Hospital Hotlines -->
                <div class="emergency-section">
                    <div class="emergency-header">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <h3>Emergency Medical Hotlines</h3>
                    </div>
                    <p style="font-size: 0.775rem; color: #78350F; line-height: 1.4;">In case of severe bleeding or emergency, contact specialized pediatric treatment centres immediately:</p>
                    <div class="emergency-buttons">
                        <a href="tel:<?php echo esc_attr(str_replace(' ', '', $hotline_nph)); ?>" class="hotline-call-btn">
                            📞 <?php echo esc_html($hotline_nph); ?>
                            <span>NPH (Phnom Penh)</span>
                        </a>
                        <a href="tel:<?php echo esc_attr(str_replace(' ', '', $hotline_ahc)); ?>" class="hotline-call-btn">
                            📞 <?php echo esc_html($hotline_ahc); ?>
                            <span>AHC (Siem Reap)</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="verify-footer">
            <div class="official-seal">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                Cryptographically Signed by Cambodian Haemophilia Association
            </div>
            <p style="margin-top: 10px;">This digital record authenticates the physical identification card issued to the member above.</p>
        </div>

    <?php else: ?>
        <!-- Invalid or Not Found Card -->
        <div class="verify-card">
            <div class="status-banner not-found">
                <div class="status-icon-wrap">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                </div>
                <div class="status-text">
                    <h1>Record Not Found</h1>
                    <p>មិនអាចស្វែងរកទិន្នន័យសមាជិកនេះបានទេ</p>
                </div>
            </div>
            <div class="not-found-body">
                <p>The Member ID <strong><?php echo esc_html($member_id ?: '(empty)'); ?></strong> was not found in the official registry. Please ensure the QR code was scanned correctly or contact CHA support.</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-return">Return to Homepage</a>
            </div>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
