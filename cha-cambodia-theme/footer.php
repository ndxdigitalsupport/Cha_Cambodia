</main>

<!-- Donate modal -->
<div class="donate-modal" id="donate-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Make a donation">
    <div class="donate-modal-backdrop" data-donate-close></div>
    <div class="donate-modal-panel donate-modal-panel--split">
      <div class="donate-modal-header">
        <div class="donate-modal-title-block">
          <div class="donate-modal-logo-box">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/logo-icon-cha.png'); ?>" alt="CHA Logo Icon">
          </div>
          <div>
            <span class="donate-modal-title" data-i18n="donate_modal_title"><?php echo esc_html(cha_get_option('donate_modal_title', 'Make a Donation')); ?></span>
            <span class="donate-modal-sub">Cambodian Haemophilia Association</span>
          </div>
        </div>
        <button class="donate-modal-close" type="button" data-donate-close aria-label="Close donation form"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
      </div>

      <div class="donate-modal-body donate-split-body">
        <!-- Left Column: Premium QR Flyer Stand -->
        <div class="donate-split-left">
          <div class="donate-qr-stand">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/aba-pay-qr.jpeg'); ?>" alt="ABA Pay KHQR Code - CHA Cambodia Donation" class="donate-split-qr-img" id="donate-qr-image">
          </div>
        </div>

        <!-- Right Column: Content & Actions -->
        <div class="donate-split-right">
          <div>
            <div class="donate-modal-badge-row">
              <span class="donate-modal-badge">
                <span class="donate-modal-badge-dot"></span>
                KHQR National Payment
              </span>
            </div>

            <h3 class="donate-modal-scan-title">Scan &amp; Support</h3>
            <p class="donate-modal-scan-desc">Scan with <strong>ABA Mobile, Bakong</strong>, or any Cambodian banking app to send your contribution.</p>
          </div>

          <!-- Account Details Box -->
          <div class="donate-modal-acct-box">
            <div class="donate-modal-acct-label">Account Name</div>
            <div class="donate-modal-acct-name">CAMBODIA HEMOPHILIA ASSOCIATION</div>

            <div class="donate-modal-acct-row">
              <div class="donate-modal-acct-num-wrap">
                <span class="donate-modal-acct-chip">ABA</span>
                <span id="donate-acct-number" class="donate-modal-acct-num">000 283 539</span>
              </div>
              <button type="button" class="donate-copy-account-btn" id="donate-copy-btn-modal" title="Copy account number">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                <span id="donate-copy-label-modal" data-i18n="donate_modal_copy_btn">Copy</span>
              </button>
            </div>
          </div>

          <!-- Actions & Trust Footer -->
          <div>
            <div class="donate-modal-actions">
              <a href="<?php echo esc_url(get_template_directory_uri() . '/aba-pay-qr.jpeg'); ?>" download="CHA-Cambodia-Donation-QR.jpeg" id="donate-download-btn" class="donate-save-qr-btn">
                <svg class="save-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                <span data-i18n="donate_save_qr_btn">Save QR Image</span>
              </a>
            </div>

            <!-- Footer Trust Note -->
            <div class="donate-modal-trust">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                <polyline points="9 12 11 14 15 10"/>
              </svg>
              <span>Instant Verification · Zero Processing Fee</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Member modal -->
  <div class="donate-modal" id="member-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Member login">
    <div class="donate-modal-backdrop" data-member-close></div>
    <div class="donate-modal-panel">
      <div class="donate-modal-header">
        <div class="donate-modal-title-block">
          <div class="donate-modal-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
          <span class="donate-modal-title" id="member-modal-title" data-i18n="member_login_title"><?php echo esc_html(cha_get_option('member_login_title', 'Member Login')); ?></span>
        </div>
        <button class="donate-modal-close" type="button" data-member-close aria-label="Close"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
      </div>
      <div class="donate-modal-body">
        <div id="member-login-panel">
          <p class="modal-subtitle" data-i18n="member_login_sub"><?php echo esc_html(cha_get_option('member_login_sub', 'Sign in to access your account, resources, and community.')); ?></p>
          <form data-mock-form novalidate>
            <div class="form-group"><label class="form-label" for="memail"><span data-i18n="form_email_label">Email</span> <span class="req">*</span></label><input class="form-input" type="email" id="memail" placeholder="Enter your email" data-i18n-placeholder="form_email_ph" required></div>
            <div class="form-group"><label class="form-label" for="mpass"><span data-i18n="form_pass_label">Password</span> <span class="req">*</span></label><div class="password-wrapper"><input class="form-input" type="password" id="mpass" placeholder="Enter your password" data-i18n-placeholder="form_pass_ph" required><button type="button" class="password-toggle" onclick="togglePass(event)" aria-label="Toggle password visibility"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-open"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-closed" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg></button></div></div>
            <div style="display:flex;justify-content:flex-end;margin-bottom:var(--s-4)"><a href="#" data-member-forgot style="font-size:0.8125rem;color:var(--c-muted)" data-i18n="member_forgot"><?php echo esc_html(cha_get_option('member_forgot', 'Forgot password?')); ?></a></div>
            <div class="modal-btn-row">
              <button type="submit" class="btn btn-primary" data-i18n="member_signin_btn"><?php echo esc_html(cha_get_option('member_signin_btn', 'Sign In')); ?></button>
            </div>
          </form>
          <p style="text-align:center;margin-top:var(--s-5);font-size:0.875rem;color:var(--c-muted)"><a href="#" data-member-register style="color:var(--c-blue);font-weight:var(--fw-semibold)" data-i18n="member_register_link"><?php echo esc_html(cha_get_option('member_register_link', 'Register')); ?></a></p>
        </div>
        <div id="member-register-panel" style="display:none">
          <p class="modal-subtitle" data-i18n="member_register_title"><?php echo esc_html(cha_get_option('member_register_title', 'Join our community of patients, families, and supporters.')); ?></p>
          <form data-mock-form novalidate>
            <div class="form-group"><label class="form-label" for="mregrole"><span data-i18n="form_i_am_a">I am a</span> <span class="req">*</span></label>
              <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s-3)">
                <label class="role-option" style="display:flex;align-items:center;gap:10px;padding:14px 16px;border:2px solid var(--c-border);border-radius:var(--r-lg);cursor:pointer;transition:all 0.2s">
                  <input type="radio" name="mregrole" value="Member" checked style="display:none">
                  <span class="role-radio" style="width:20px;height:20px;border-radius:50%;border:2px solid var(--c-border);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.2s"><span style="width:10px;height:10px;border-radius:50%;background:var(--c-blue);display:none"></span></span>
                  <span><strong style="display:block;font-size:0.875rem" data-i18n="role_member">Member</strong></span>
                </label>
                <label class="role-option" style="display:flex;align-items:center;gap:10px;padding:14px 16px;border:2px solid var(--c-border);border-radius:var(--r-lg);cursor:pointer;transition:all 0.2s">
                  <input type="radio" name="mregrole" value="Patient" style="display:none">
                  <span class="role-radio" style="width:20px;height:20px;border-radius:50%;border:2px solid var(--c-border);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.2s"><span style="width:10px;height:10px;border-radius:50%;background:var(--c-blue);display:none"></span></span>
                  <span><strong style="display:block;font-size:0.875rem" data-i18n="role_patient">Patient</strong><span style="font-size:0.75rem;color:var(--c-muted)" data-i18n="role_patient_desc">I have Haemophilia</span></span>
                </label>
              </div>
            </div>
            <div class="form-group"><label class="form-label" for="mregname"><span data-i18n="form_name_label">Full name</span> <span class="req">*</span></label><input class="form-input" type="text" id="mregname" placeholder="Enter your full name" data-i18n-placeholder="form_name_ph" required></div>
            <div class="form-group"><label class="form-label" for="mregemail"><span data-i18n="form_email_label">Email address</span> <span class="req">*</span></label><input class="form-input" type="email" id="mregemail" placeholder="Enter your email" data-i18n-placeholder="form_email_ph" required></div>
            <div class="form-group"><label class="form-label" for="mregpass"><span data-i18n="form_pass_label">Password</span> <span class="req">*</span></label><div class="password-wrapper"><input class="form-input" type="password" id="mregpass" placeholder="Create a password" data-i18n-placeholder="form_create_pass_ph" required><button type="button" class="password-toggle" onclick="togglePass(event)" aria-label="Toggle password visibility"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-open"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-closed" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg></button></div></div>
            <div class="form-group"><label class="form-label" for="mregphone"><span data-i18n="form_phone_label">Phone number</span> <span class="req req-patient" style="display:none">*</span></label><input class="form-input" type="tel" id="mregphone" placeholder="Enter your phone number" data-i18n-placeholder="form_phone_ph"></div>
            <div class="form-group"><label class="form-label" for="mregaddress"><span data-i18n="form_address_label">Address</span> <span class="req req-patient" style="display:none">*</span></label><input class="form-input" type="text" id="mregaddress" placeholder="Enter your address" data-i18n-placeholder="form_address_ph"></div>
            <div id="patient-fields" style="display:none">
              <div class="form-group"><label class="form-label" for="mregdob"><span data-i18n="dash_dob">Date of birth</span> <span class="req">*</span></label><input class="form-input" type="text" id="mregdob" placeholder="dd/mm/yyyy"></div>
              <div class="form-group"><label class="form-label" for="mregcondition"><span data-i18n="form_hemophilia_type_lbl">Hemophilia Type</span> <span class="req">*</span></label><select class="form-input" id="mregcondition"><option value="" data-i18n="form_select_type">Select type</option><option value="Hemophilia A">Hemophilia A</option><option value="Hemophilia B">Hemophilia B</option><option value="Other" data-i18n="form_opt_other">Other</option></select><input class="form-input" type="text" id="mregcondition-other" placeholder="Specify your condition" data-i18n-placeholder="form_specify_cond_ph" style="display:none;margin-top:8px"></div>
              <div class="form-group"><label class="form-label" for="mregblood"><span data-i18n="dash_blood_type">Blood type</span> <span class="req">*</span></label>
                <select class="form-input" id="mregblood"><option value="" data-i18n="form_select_blood">Select blood type</option><option>A+</option><option>A-</option><option>B+</option><option>B-</option><option>AB+</option><option>AB-</option><option>O+</option><option>O-</option></select>
              </div>
            </div>
            <div class="form-group"><label class="form-check"><input type="checkbox" id="mregconsent"><span><span data-i18n="form_terms_agree"><?php echo esc_html(cha_get_option('member_register_terms', 'I agree to the')); ?></span> <a href="<?php echo esc_url(home_url('/terms')); ?>" target="_blank" data-i18n="form_terms_link"><?php echo esc_html(cha_get_option('member_register_terms_link', 'Terms & Conditions')); ?></a>.</span></label></div>
            <div class="modal-btn-row">
              <button type="submit" class="btn btn-primary" data-i18n="member_register_btn"><?php echo esc_html(cha_get_option('member_register_btn', 'Register')); ?></button>
            </div>
          </form>
          <p style="text-align:center;margin-top:var(--s-5);font-size:0.875rem;color:var(--c-muted)"><span data-i18n="member_already_account"><?php echo esc_html(cha_get_option('member_register_login', 'Already have an account?')); ?></span> <a href="#" data-member-back-login style="color:var(--c-blue);font-weight:var(--fw-semibold)" data-i18n="member_signin_btn"><?php echo esc_html(cha_get_option('member_signin_btn', 'Sign In')); ?></a></p>
        </div>
        <div id="member-forgot-panel" style="display:none">
          <p class="modal-subtitle" data-i18n="member_forgot_sub"><?php echo esc_html(cha_get_option('member_forgot_sub', 'Enter your email and we will send you a link to reset your password.')); ?></p>
          <form data-mock-form novalidate>
            <div class="form-group"><label class="form-label" for="mforgotemail"><span data-i18n="form_email_label"><?php echo esc_html(cha_get_option('member_email_label', 'Email')); ?></span> <span class="req">*</span></label><input class="form-input" type="email" id="mforgotemail" placeholder="<?php echo esc_attr(cha_get_option('member_email_placeholder', 'Enter your email')); ?>" data-i18n-placeholder="form_email_ph" required></div>
            <div class="modal-btn-row">
              <button type="submit" class="btn btn-primary" data-i18n="member_forgot_btn"><?php echo esc_html(cha_get_option('member_forgot_btn', 'Send Reset Link')); ?></button>
            </div>
          </form>
          <p style="text-align:center;margin-top:var(--s-5);font-size:0.875rem;color:var(--c-muted)"><a href="#" data-member-back-login-forgot style="color:var(--c-blue);font-weight:var(--fw-semibold)" data-i18n="member_signin_btn"><?php echo esc_html(cha_get_option('member_signin_btn', 'Sign In')); ?></a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Dashboard modal -->
  <div class="donate-modal" id="dashboard-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Member dashboard">
    <div class="donate-modal-backdrop" data-dashboard-close></div>
    <div class="donate-modal-panel" style="max-width:560px">
      <div class="donate-modal-header">
        <div class="donate-modal-title-block">
          <div class="donate-modal-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
          <span class="donate-modal-title" id="dashboard-modal-title" data-i18n="dash_title">My Dashboard</span>
        </div>
        <button class="donate-modal-close" type="button" data-dashboard-close aria-label="Close"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
      </div>
      <div class="donate-modal-body">
        <!-- Member view (Redesigned) -->
        <div id="dash-member-view" style="display:none">
          <div class="dash-profile-header">
            <div class="dash-avatar-wrapper">
              <img id="dash-member-photo" src="" alt="Member photo" style="display:none">
              <div id="dash-member-avatar" class="dash-avatar-fallback"></div>
              <button type="button" id="dash-member-photo-delete" class="dash-avatar-delete-btn" title="Remove photo" style="display:none" aria-label="Remove photo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </button>
              <label class="dash-avatar-upload-btn" for="member-photo-input" title="Upload photo" aria-label="Upload photo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
              </label>
              <input type="file" id="member-photo-input" accept="image/*" style="display:none">
            </div>
            <h3 id="dash-member-name" class="dash-member-name"></h3>
            <div class="dash-role-badge-wrap">
              <span id="dash-member-role-badge" class="dash-role-badge">Member</span>
            </div>
          </div>
          <div class="dash-info-card" id="dash-member-info">
            <div class="dash-info-row"><span class="dash-info-label" data-i18n="dash_member_id">Member ID</span><span id="dash-member-id" class="dash-info-value dash-id-badge"></span></div>
            <div class="dash-info-row"><span class="dash-info-label" data-i18n="dash_name">Full Name</span><span id="dash-member-name-val" class="dash-info-value"></span><input type="text" id="m-edit-name" class="form-input dash-edit-input" style="display:none" placeholder="Full name" data-i18n-placeholder="dash_ph_name"></div>
            <div class="dash-info-row"><span class="dash-info-label" data-i18n="dash_email">Email</span><span id="dash-member-email" class="dash-info-value"></span><input type="email" id="m-edit-email" class="form-input dash-edit-input" style="display:none" placeholder="Email" data-i18n-placeholder="dash_ph_email"></div>
            <div class="dash-info-row"><span class="dash-info-label" data-i18n="dash_phone">Phone</span><span id="dash-member-phone" class="dash-info-value"></span><input type="tel" id="m-edit-phone" class="form-input dash-edit-input" style="display:none" placeholder="Phone" data-i18n-placeholder="dash_ph_phone"></div>
            <div class="dash-info-row"><span class="dash-info-label" data-i18n="dash_address">Address</span><span id="dash-member-address" class="dash-info-value"></span><input type="text" id="m-edit-address" class="form-input dash-edit-input" style="display:none" placeholder="Address" data-i18n-placeholder="dash_ph_address"></div>
            <div class="dash-info-row"><span class="dash-info-label" data-i18n="dash_member_since">Member since</span><span id="dash-member-since" class="dash-info-value"></span></div>
            <div style="margin-top:var(--s-4)" id="dash-member-actions">
              <button type="button" class="btn btn-outline dash-btn-edit" id="dash-member-edit-btn" style="width:100%" data-i18n="dash_edit_profile">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:6px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                <span>Edit Profile</span>
              </button>
              <div id="dash-member-save-cancel" style="display:none;grid-template-columns:1fr 1fr;gap:var(--s-3)">
                <button type="button" class="btn btn-primary" id="dash-member-save-btn" data-i18n="dash_save">Save</button>
                <button type="button" class="btn btn-outline" id="dash-member-cancel-btn" data-i18n="dash_cancel">Cancel</button>
              </div>
            </div>
          </div>
          <div style="margin-top:var(--s-5);text-align:center">
            <button type="button" class="btn btn-outline-danger dash-btn-logout" data-dashboard-logout style="width:100%" data-i18n="dash_sign_out">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:6px"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
              <span>Sign Out</span>
            </button>
          </div>
        </div>

        <!-- Patient view (Authentic Physical Card Layout with 3D Flip) -->
        <div id="dash-patient-view" style="display:none">
          <div style="text-align:center;margin-bottom:var(--s-3)">
            <h3 id="dash-patient-name" style="color:var(--c-blue);margin-bottom:2px;font-size:1.25rem;font-weight:700"></h3>
            <p style="font-size:0.8125rem;color:var(--c-muted);margin:0;letter-spacing:0.02em" data-i18n="dash_card_subtitle">Patient Identification Card</p>
          </div>

          <!-- Flip Controls -->
          <div class="dash-card-flip-bar">
            <button type="button" class="btn btn-outline id-card-flip-btn" id="dash-card-flip-btn">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="margin-right:6px"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>
              <span data-i18n="dash_flip_card">Flip Card</span>
            </button>
            <span class="id-card-side-indicator" id="dash-card-side-indicator" data-i18n="dash_side_back">Back Side</span>
          </div>

          <!-- 3D Card Scene -->
          <div class="id-card-scene">
            <div class="id-card-flipper" id="dash-id-card-flipper">
              <!-- ID Card Front -->
              <div class="id-card-front">
                <div class="id-card-front-header">
                  <div class="id-card-header-left">
                    <img src="<?php echo get_template_directory_uri(); ?>/cha-logo-left.png" alt="CHA Logo" class="id-card-header-logo">
                  </div>
                  <div class="id-card-header-right">
                    <div class="id-card-khmer-header-title" data-i18n="card_title_front">ប័ណ្ណសម្គាល់អ្នកជំងឺ</div>
                    <div class="id-card-eng-header-title" data-i18n="card_title_eng">Patient Identification Card</div>
                  </div>
                </div>

                <div class="id-card-front-inner">
                  <!-- Left Column: Photo + QR Code -->
                  <div class="id-card-left-col">
                    <div class="id-card-photo-wrap">
                      <img id="dash-patient-photo" src="" alt="Patient photo" style="display:none">
                      <div id="dash-patient-photo-placeholder" class="id-card-photo-placeholder">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="28" height="28"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span data-i18n="dash_no_photo">No Photo</span>
                      </div>
                      <button type="button" id="dash-photo-delete" class="id-card-photo-delete" title="Remove photo" style="display:none">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                      </button>
                      <label class="id-card-photo-upload" for="patient-photo-input" title="Upload Photo">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                      </label>
                      <input type="file" id="patient-photo-input" accept="image/*" style="display:none">
                    </div>

                    <div class="id-card-qr-wrap">
                      <div class="id-card-qr-box">
                        <img id="dash-patient-qr" src="" alt="QR Code">
                      </div>
                      <div class="id-card-qr-label" data-i18n="card_qr_label">Scan Us</div>
                    </div>
                  </div>

                  <!-- Right Column: Patient Details -->
                  <div class="id-card-details">
                    <div class="id-card-row">
                      <span class="id-card-label-kh" data-i18n="card_label_id">Member ID</span>
                      <span class="id-card-sep">:</span>
                      <span id="dash-patient-id" class="id-card-val-bold"></span>
                    </div>
                    <div class="id-card-row">
                      <span class="id-card-label-kh" data-i18n="card_label_name_khmer">Khmer Name</span>
                      <span class="id-card-sep">:</span>
                      <span id="dash-patient-name-khmer" class="id-card-val-bold">—</span>
                      <input type="text" id="p-edit-name-khmer" class="id-card-edit-input" style="display:none" placeholder="ឈ្មោះខ្មែរ">
                    </div>
                    <div class="id-card-row">
                      <span class="id-card-label-kh" data-i18n="card_label_name_latin">Latin Name</span>
                      <span class="id-card-sep">:</span>
                      <span id="dash-patient-name-display" class="id-card-val-bold"></span>
                      <input type="text" id="p-edit-name" class="id-card-edit-input" style="display:none" placeholder="Name">
                    </div>
                    <div class="id-card-row">
                      <span class="id-card-label-kh" data-i18n="card_label_dob">Date of Birth</span>
                      <span class="id-card-sep">:</span>
                      <span id="dash-patient-dob" class="id-card-val"></span>
                      <input type="text" id="p-edit-dob" class="id-card-edit-input" style="display:none" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="id-card-row">
                      <span class="id-card-label-kh" data-i18n="card_label_condition">Hemophilia Type</span>
                      <span class="id-card-sep">:</span>
                      <span id="dash-patient-condition" class="id-card-val"></span>
                      <select id="p-edit-condition" class="id-card-edit-input" style="display:none"><option value="">Select type</option><option value="Hemophilia A">Hemophilia A</option><option value="Hemophilia B">Hemophilia B</option><option value="Other">Other</option></select>
                    </div>
                    <div class="id-card-row">
                      <span class="id-card-label-kh" data-i18n="card_label_blood">Blood Type</span>
                      <span class="id-card-sep">:</span>
                      <span id="dash-patient-blood" class="id-card-val"></span>
                      <select id="p-edit-blood" class="id-card-edit-input" style="display:none"><option value="">Select</option><option>A+</option><option>A-</option><option>B+</option><option>B-</option><option>AB+</option><option>AB-</option><option>O+</option><option>O-</option></select>
                    </div>
                    <div class="id-card-row">
                      <span class="id-card-label-kh" data-i18n="card_label_issue_date">Issue Date</span>
                      <span class="id-card-sep">:</span>
                      <span id="dash-patient-created" class="id-card-val"></span>
                    </div>
                    <div class="id-card-row">
                      <span class="id-card-label-kh" data-i18n="card_label_address">Address</span>
                      <span class="id-card-sep">:</span>
                      <span id="dash-patient-address" class="id-card-val"></span>
                      <input type="text" id="p-edit-address" class="id-card-edit-input" style="display:none" placeholder="Address">
                    </div>
                    <div class="id-card-row">
                      <span class="id-card-label-kh" data-i18n="card_label_phone">Phone</span>
                      <span class="id-card-sep">:</span>
                      <span id="dash-patient-phone" class="id-card-val"></span>
                      <input type="tel" id="p-edit-phone" class="id-card-edit-input" style="display:none" placeholder="Phone">
                    </div>
                  </div>
                </div>

                <!-- Front Card Footer Hotlines -->
                <div class="id-card-front-footer">
                  <div class="id-card-emergency-line">
                    <span data-i18n="card_hotline_nph">National Pediatric Hospital Hotline: <strong>012 751 728</strong></span>
                    <span class="id-card-footer-space">|</span>
                    <span data-i18n="card_hotline_ahc">Angkor Hospital for Children Hotline: <strong>063 963 409</strong></span>
                  </div>
                  <div class="id-card-keep-notice" data-i18n="card_keep_notice">Please keep this member ID card in good condition.</div>
                </div>
              </div>

              <!-- ID Card Back -->
              <div class="id-card-back">
                <div class="id-card-front-header">
                  <div class="id-card-header-left">
                    <img src="<?php echo get_template_directory_uri(); ?>/cha-logo-left.png" alt="CHA Logo" class="id-card-header-logo">
                  </div>
                  <div class="id-card-header-right">
                    <div class="id-card-khmer-header-title" data-i18n="card_title_back">ប័ណ្ណសម្គាល់អ្នកជំងឺ</div>
                    <div class="id-card-eng-header-title" data-i18n="card_title_eng">Patient Identification Card</div>
                  </div>
                </div>

                <div class="id-card-back-body">
                  <div class="id-card-rules-col">
                    <div class="id-card-rules-title" data-i18n="card_rules_heading">លក្ខខណ្ឌ៖</div>
                    <ol class="id-card-rules-list">
                      <li data-i18n="card_rule_1">ប័ណ្ណសម្គាល់អ្នកជំងឺ គឺនឹងប្រើប្រាស់តែនៅក្នុងសមាគមជំងឺហេម៉ូហ្វីលាកម្ពុជា តែប៉ុណ្ណោះ។</li>
                      <li data-i18n="card_rule_2">ប័ណ្ណសម្គាល់អ្នកជំងឺ មានសុពលភាពប្រើប្រាស់ពេញមួយអាណត្តិទី៥ ឆ្នាំ២០២៦-២០៣០</li>
                      <li data-i18n="card_rule_3">អ្នកជំងឺទាំងអស់ ត្រូវបន្តសុពលភាពប័ណ្ណសម្គាល់អ្នកជំងឺថ្មី ឱ្យបានមុនថ្ងៃទី១៧ ខែឧសភា ឆ្នាំ២០៣០</li>
                    </ol>
                  </div>

                  <div class="id-card-signature-col">
                    <div class="id-card-president-label" data-i18n="card_president_label">ប្រធានសមាគម</div>
                    <div class="id-card-stamp-wrapper">
                      <svg class="id-card-seal-svg" viewBox="0 0 140 140" width="85" height="85">
                        <circle cx="70" cy="70" r="66" fill="none" stroke="#1d4ed8" stroke-width="2.5"/>
                        <circle cx="70" cy="70" r="54" fill="none" stroke="#1d4ed8" stroke-width="1.5" stroke-dasharray="3 3"/>
                        <path id="seal-path-top" d="M 20,70 A 50,50 0 0,1 120,70" fill="none"/>
                        <path id="seal-path-bottom" d="M 120,70 A 50,50 0 0,1 20,70" fill="none"/>
                        <text fill="#1d4ed8" font-size="9.5" font-weight="bold">
                          <textPath href="#seal-path-top" startOffset="50%" text-anchor="middle">ស.ហ.អ.ក</textPath>
                        </text>
                        <text fill="#1d4ed8" font-size="7.5" font-weight="bold">
                          <textPath href="#seal-path-bottom" startOffset="50%" text-anchor="middle">Cambodian Hemophilia Association</textPath>
                        </text>
                        <text x="70" y="65" fill="#1d4ed8" font-size="15" font-weight="900" text-anchor="middle" font-family="sans-serif">C.H.A</text>
                        <text x="70" y="80" fill="#dc2626" font-size="9.5" font-weight="bold" text-anchor="middle">REB</text>
                      </svg>
                      <div class="id-card-signature-img">
                        <svg viewBox="0 0 120 40" width="80" height="30" style="color:#1e3a8a">
                          <path d="M 10,25 Q 30,5 50,25 T 90,15 T 110,30" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                      </div>
                    </div>
                    <div class="id-card-signatory-name" data-i18n="card_president_name">រុន ច័ន្ទរិទ្ធី</div>
                  </div>
                </div>

                <div class="id-card-back-footer" data-i18n="card_office_address">
                  អាសយដ្ឋាន: លេខ១០០ មហាវិថីសហព័ន្ធរុស្ស៊ី រាជធានីភ្នំពេញ ទូរស័ព្ទលេខ (+៨៥៥) ៩៦ ៦៦០ ៥៣៣៤
                </div>
              </div>
            </div>
          </div>
          <div class="dash-actions" style="margin-top:var(--s-5);display:flex;flex-direction:column;align-items:center;gap:var(--s-3)">
            <div id="dash-patient-actions" style="width:100%">
              <button type="button" class="btn btn-outline" id="dash-patient-edit-btn" style="width:100%"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg><span data-i18n="dash_edit_profile">Edit Profile</span></button>
              <div id="dash-patient-save-cancel" style="display:none;width:100%;grid-template-columns:1fr 1fr;gap:var(--s-3);margin-top:var(--s-4)">
                <button type="button" class="btn btn-primary" id="dash-patient-save-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><polyline points="20 6 9 17 4 12"/></svg><span data-i18n="dash_save">Save</span></button>
                <button type="button" class="btn btn-outline" id="dash-patient-cancel-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg><span data-i18n="dash_cancel">Cancel</span></button>
              </div>
            </div>
            <div class="dash-actions-divider"></div>
            <button type="button" class="btn-text" data-dashboard-logout><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg><span data-i18n="dash_sign_out">Sign Out</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Footer transition wave -->
<div class="footer-wave">
  <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0,0 L0,60 Q120,80 360,60 Q600,40 720,50 Q960,70 1200,50 Q1320,40 1440,50 L1440,0 Z" fill="#ffffff"/>
  </svg>
</div>

<!-- Footer -->
<footer class="site-footer"><div class="container">
    <div class="footer-grid">
        <div class="footer-col footer-col-brand">
            <a href="<?php echo home_url(); ?>" class="footer-brand">
                <img src="<?php echo esc_url(cha_get_option('site_logo', get_template_directory_uri() . '/cha-logo-left.png')); ?>" alt="Cambodian Haemophilia Association" style="height:52px;width:auto;max-width:200px;object-fit:contain">
            </a>
            <p class="footer-tagline" data-i18n="footer_tagline"><?php echo esc_html(cha_get_option('footer_tagline', 'Supporting people living with bleeding disorders across Cambodia.')); ?></p>
            <div class="footer-socials">
                <a href="https://www.facebook.com/hemophiliacambodian" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg></a>
                <a href="https://www.youtube.com/@cambodiahemophiliaassociation" target="_blank" rel="noopener" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
                <a href="https://t.me/Chacambodia_bot" target="_blank" rel="noopener" aria-label="Telegram"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71l-4.16-3.07-2.01 1.93c-.23.23-.42.42-.84.42z"/></svg></a>
            </div>
        </div>
        <div class="footer-col">
            <h4 data-i18n="footer_quick_links">Quick Links</h4>
            <ul><li><a href="<?php echo home_url(); ?>" data-i18n="nav_home">Home</a></li><li><a href="<?php echo home_url('/about'); ?>" data-i18n="nav_about">About Us</a></li><li><a href="<?php echo home_url('/haemophilia'); ?>" data-i18n="nav_haemophilia">About Haemophilia</a></li><li><a href="<?php echo home_url('/#contact'); ?>" data-i18n="nav_contact">Contact Us</a></li></ul>
        </div>
        <div class="footer-col">
            <h4 data-i18n="footer_resources">Resources</h4>
            <ul><li><a href="<?php echo home_url('/programs'); ?>#treatment-centres" data-i18n="nav_treatment_centres">Treatment Centres</a></li><li><a href="<?php echo esc_url(get_post_type_archive_link('cha_news')); ?>" data-i18n="footer_news_events">News &amp; Events</a></li><li><a href="#" data-donate-trigger data-i18n="nav_donate">Donation</a></li></ul>
        </div>
        <div class="footer-col">
            <h4 data-i18n="footer_contact">Contact Us</h4>
            <div class="footer-contact">
                <div class="item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span data-i18n="contact_address_val"><?php echo esc_html(cha_get_option('contact_address', '#100, Street Russia Blvd, Sangkat Teek Laak 1, Khan Toul Kork, Phnom Penh, Cambodia')); ?></span>
                </div>
                <div class="item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <a href="tel:<?php echo esc_attr(cha_get_option('contact_phone_digits', '+855962605335')); ?>"><?php echo esc_html(cha_get_option('contact_phone', '+855 96 260 5335')); ?></a>
                </div>
                <div class="item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <a href="mailto:<?php echo esc_attr(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?>"><?php echo esc_html(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <span data-i18n="footer_copyright">© <?php echo date('Y'); ?> <?php echo esc_html(cha_get_option('footer_copyright', 'Cambodian Haemophilia Association. All rights reserved.')); ?></span>
        <div class="footer-bottom-links">
            <a href="<?php echo esc_url(home_url('/privacy')); ?>" data-i18n="footer_privacy"><?php echo esc_html(cha_get_option('footer_privacy', 'Privacy Policy')); ?></a>
            <a href="<?php echo esc_url(home_url('/disclaimer')); ?>" data-i18n="footer_disclaimer"><?php echo esc_html(cha_get_option('footer_disclaimer', 'Disclaimer')); ?></a>
            <a href="<?php echo esc_url(home_url('/terms')); ?>" data-i18n="footer_terms"><?php echo esc_html(cha_get_option('footer_terms', 'Terms of Service')); ?></a>
            <a href="#" data-donate-trigger data-i18n="nav_donate">Donation</a>
            <a href="<?php echo home_url('/#contact'); ?>" data-i18n="footer_contact"><?php echo esc_html(cha_get_option('footer_contact_heading', 'Contact Us')); ?></a>
        </div>
    </div>
</div></footer>

<?php wp_footer(); ?>
  <!-- Flatpickr (Airbnb theme) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    function initFlatpickr() {
      if (typeof flatpickr === 'undefined') return;
      document.querySelectorAll('#mregdob, #p-edit-dob').forEach(function(el) {
        if (!el._flatpickr) {
          flatpickr(el, {
            dateFormat: 'd/m/Y',
            allowInput: true,
            clickOpens: true,
            locale: { firstDayOfWeek: 1 }
          });
        }
      });
    }
    document.addEventListener('DOMContentLoaded', initFlatpickr);
    // Re-init when modals open (MutationObserver catches dynamic content)
    var observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(m) {
        if (m.addedNodes.length) initFlatpickr();
      });
    });
    observer.observe(document.body, { childList: true, subtree: true });
  </script>

  <!-- Telegram Chat Button -->
  <a href="https://t.me/Chacambodia_bot" target="_blank" rel="noopener noreferrer" class="cha-telegram-btn" aria-label="Chat on Telegram">
    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.479.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
    <span class="cha-telegram-tooltip" data-i18n="chatWithUs">Chat with us</span>
  </a>
</body>
</html>
