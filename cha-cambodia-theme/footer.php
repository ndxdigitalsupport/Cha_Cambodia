</main>

<!-- Donate modal -->
<div class="donate-modal" id="donate-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Make a donation">
    <div class="donate-modal-backdrop" data-donate-close></div>
    <div class="donate-modal-panel">
      <div class="donate-modal-header">
        <div class="donate-modal-title-block">
          <div class="donate-modal-icon" style="background: rgba(227,30,36,0.1); color: var(--c-red);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </div>
          <span class="donate-modal-title" style="font-size: 1.0625rem; font-weight: 700; color: var(--c-blue);" data-i18n="donate_modal_title"><?php echo esc_html(cha_get_option('donate_modal_title', 'Make a Donation')); ?></span>
        </div>
        <button class="donate-modal-close" type="button" data-donate-close aria-label="Close donation form"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
      </div>
      <div class="donate-modal-body">
        <p class="modal-subtitle" data-i18n="donate_modal_sub"><?php echo esc_html(cha_get_option('donate_modal_sub', 'Your support provides treatment, education, and hope to people with bleeding disorders in Cambodia.')); ?></p>

        <form id="donate-modal-form" novalidate>
          <div class="form-group">
            <label class="form-label"><span data-i18n="donate_amount_label">Donation Amount</span> <span class="req">*</span></label>
            <div class="amount-chips" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: var(--s-3); margin-bottom: var(--s-3);">
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
            <input class="form-input" type="text" id="doname" placeholder="Enter your name" data-i18n-placeholder="donate_name_ph">
          </div>

          <div class="form-group">
            <label class="form-label" data-i18n="donate_email_label">Email (optional)</label>
            <input class="form-input" type="email" id="doemail" placeholder="Enter your email" data-i18n-placeholder="donate_email_ph">
          </div>

          <div class="form-group">
            <label class="form-label" data-i18n="donate_phone_label">Phone (optional)</label>
            <input class="form-input" type="tel" id="dophone" placeholder="Enter your phone" data-i18n-placeholder="donate_phone_ph">
          </div>

          <div class="modal-btn-row">
            <button type="submit" class="btn btn-primary" data-i18n="donate_btn"><?php echo esc_html(cha_get_option('donate_btn', 'Donate Now')); ?></button>
          </div>
        </form>

        <p class="secure-note" style="margin-top: var(--s-4); text-align: center; font-size: 0.8125rem; color: var(--c-muted); display: flex; align-items: center; justify-content: center; gap: 6px;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px; color: #22C55E;">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            <polyline points="9 12 11 14 15 10"/>
          </svg>
          <?php echo esc_html(cha_get_option('donate_footer_note', 'Secure & encrypted via PayWay (ABA Bank)')); ?>
        </p>
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
                  <input type="radio" name="mregrole" value="Supporter" checked style="display:none">
                  <span class="role-radio" style="width:20px;height:20px;border-radius:50%;border:2px solid var(--c-border);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.2s"><span style="width:10px;height:10px;border-radius:50%;background:var(--c-blue);display:none"></span></span>
                  <span><strong style="display:block;font-size:0.875rem" data-i18n="role_member">Member</strong><span style="font-size:0.75rem;color:var(--c-muted)" data-i18n="role_member_desc">Supporter / Family</span></span>
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
            <div class="form-group"><label class="form-label" for="mregphone" data-i18n="form_phone_label">Phone number (optional)</label><input class="form-input" type="tel" id="mregphone" placeholder="Enter your phone number" data-i18n-placeholder="form_phone_ph"></div>
            <div class="form-group"><label class="form-label" for="mregaddress" data-i18n="form_address_label">Address (optional)</label><input class="form-input" type="text" id="mregaddress" placeholder="Enter your address" data-i18n-placeholder="form_address_ph"></div>
<div id="patient-fields" style="display:none">
  <div class="form-group"><label class="form-label" for="mregdob" data-i18n="dash_dob">Date of birth</label><input class="form-input" type="text" id="mregdob" placeholder="dd/mm/yyyy"></div>
              <div class="form-group"><label class="form-label" for="mregcondition" data-i18n="form_hemophilia_type_lbl">Hemophilia Type</label><select class="form-input" id="mregcondition"><option value="" data-i18n="form_select_type">Select type</option><option value="Hemophilia A">Hemophilia A</option><option value="Hemophilia B">Hemophilia B</option><option value="Other" data-i18n="form_opt_other">Other</option></select><input class="form-input" type="text" id="mregcondition-other" placeholder="Specify your condition" data-i18n-placeholder="form_specify_cond_ph" style="display:none;margin-top:8px"></div>
              <div class="form-group"><label class="form-label" for="mregblood" data-i18n="dash_blood_type">Blood type</label>
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
        <!-- Member view (simple) -->
        <div id="dash-member-view" style="display:none">
          <div style="text-align:center;margin-bottom:var(--s-6)">
            <div id="dash-member-avatar" style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--c-blue) 0%,var(--c-red) 100%);display:flex;align-items:center;justify-content:center;margin:0 auto var(--s-3);color:#fff;font-size:2rem;font-weight:700"></div>
            <h3 id="dash-member-name" style="color:var(--c-blue);margin-bottom:4px"></h3>
            <p id="dash-member-role" style="font-size:0.8125rem;color:var(--c-muted);margin:0"></p>
          </div>
          <div style="background:var(--c-gray-100);border-radius:var(--r-lg);padding:var(--s-5)" id="dash-member-info">
            <div class="dash-info-row"><span class="dash-info-label" data-i18n="dash_member_id">Member ID</span><span id="dash-member-id" class="dash-info-value"></span></div>
            <div class="dash-info-row"><span class="dash-info-label" data-i18n="dash_email">Email</span><span id="dash-member-email" class="dash-info-value"></span><input type="email" id="m-edit-email" class="form-input dash-edit-input" style="display:none" placeholder="Email" data-i18n-placeholder="dash_ph_email"></div>
            <div class="dash-info-row"><span class="dash-info-label" data-i18n="dash_phone">Phone</span><span id="dash-member-phone" class="dash-info-value"></span><input type="tel" id="m-edit-phone" class="form-input dash-edit-input" style="display:none" placeholder="Phone" data-i18n-placeholder="dash_ph_phone"></div>
            <div class="dash-info-row"><span class="dash-info-label" data-i18n="dash_address">Address</span><span id="dash-member-address" class="dash-info-value"></span><input type="text" id="m-edit-address" class="form-input dash-edit-input" style="display:none" placeholder="Address" data-i18n-placeholder="dash_ph_address"></div>
            <div class="dash-info-row"><span class="dash-info-label" data-i18n="dash_member_since">Member since</span><span id="dash-member-since" class="dash-info-value"></span></div>
            <div style="margin-top:var(--s-4)" id="dash-member-actions">
              <button type="button" class="btn btn-outline" id="dash-member-edit-btn" style="width:100%" data-i18n="dash_edit_profile">Edit Profile</button>
              <div id="dash-member-save-cancel" style="display:none;grid-template-columns:1fr 1fr;gap:var(--s-3)">
                <button type="button" class="btn btn-primary" id="dash-member-save-btn" data-i18n="dash_save">Save</button>
                <button type="button" class="btn btn-outline" id="dash-member-cancel-btn" data-i18n="dash_cancel">Cancel</button>
              </div>
            </div>
          </div>
          <div style="margin-top:var(--s-5);text-align:center">
            <button type="button" class="btn btn-primary" data-dashboard-logout style="width:100%" data-i18n="dash_sign_out">Sign Out</button>
          </div>
        </div>
        <!-- Patient view (ID card) -->
        <div id="dash-patient-view" style="display:none">
          <div style="text-align:center;margin-bottom:var(--s-4)">
            <h3 id="dash-patient-name" style="color:var(--c-blue);margin-bottom:4px;font-size:1.25rem"></h3>
            <p style="font-size:0.8125rem;color:var(--c-muted);margin:0;letter-spacing:0.02em" data-i18n="dash_card_subtitle">Patient Identification Card</p>
          </div>
          <!-- ID Card Front -->
          <div class="id-card-front">
            <div class="id-card-front-inner">
              <div class="id-card-photo-wrap">
                <img id="dash-patient-photo" src="" alt="Patient photo" style="display:none">
                <div id="dash-patient-photo-placeholder" style="width:100%;height:100%;background:var(--c-gray-200);display:flex;align-items:center;justify-content:center;color:var(--c-muted);font-size:0.75rem" data-i18n="dash_no_photo">No Photo</div>
                <button type="button" id="dash-photo-delete" class="id-card-photo-delete" title="Remove photo" style="display:none">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
                <label class="id-card-photo-upload" for="patient-photo-input">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </label>
                <input type="file" id="patient-photo-input" accept="image/*" style="display:none">
              </div>
              <div class="id-card-details">
                <div class="id-card-row"><span class="id-card-label" data-i18n="dash_member_id">Member ID</span><span class="id-card-dots"></span><span id="dash-patient-id" class="id-card-value"></span></div>
                <div class="id-card-row"><span class="id-card-label" data-i18n="dash_name">Name</span><span class="id-card-dots"></span><span id="dash-patient-name-display" class="id-card-value"></span><input type="text" id="p-edit-name" class="id-card-edit-input" style="display:none" placeholder="Name" data-i18n-placeholder="dash_ph_name"></div>
                <div class="id-card-row"><span class="id-card-label" data-i18n="dash_dob">Date of Birth</span><span class="id-card-dots"></span><span id="dash-patient-dob" class="id-card-value"></span><input type="text" id="p-edit-dob" class="id-card-edit-input" style="display:none" placeholder="dd/mm/yyyy"></div>
                <div class="id-card-row"><span class="id-card-label" data-i18n="dash_condition">Condition</span><span class="id-card-dots"></span><span id="dash-patient-condition" class="id-card-value"></span><select id="p-edit-condition" class="id-card-edit-input" style="display:none"><option value="">Select type</option><option value="Hemophilia A">Hemophilia A</option><option value="Hemophilia B">Hemophilia B</option><option value="Other">Other</option></select><input type="text" id="p-edit-condition-other" class="id-card-edit-input" placeholder="Specify your condition" style="display:none"></div>
                <div class="id-card-row"><span class="id-card-label" data-i18n="dash_blood_type">Blood Type</span><span class="id-card-dots"></span><span id="dash-patient-blood" class="id-card-value"></span><select id="p-edit-blood" class="id-card-edit-input" style="display:none"><option value="">Select</option><option>A+</option><option>A-</option><option>B+</option><option>B-</option><option>AB+</option><option>AB-</option><option>O+</option><option>O-</option></select></div>
                <div class="id-card-row"><span class="id-card-label" data-i18n="dash_phone">Phone</span><span class="id-card-dots"></span><span id="dash-patient-phone" class="id-card-value"></span><input type="tel" id="p-edit-phone" class="id-card-edit-input" style="display:none" placeholder="Phone" data-i18n-placeholder="dash_ph_phone"></div>
                <div class="id-card-row"><span class="id-card-label" data-i18n="dash_created_at">Created At</span><span class="id-card-dots"></span><span id="dash-patient-created" class="id-card-value"></span></div>
                <div class="id-card-row"><span class="id-card-label" data-i18n="dash_address">Address</span><span class="id-card-dots"></span><span id="dash-patient-address" class="id-card-value"></span><input type="text" id="p-edit-address" class="id-card-edit-input" style="display:none" placeholder="Address" data-i18n-placeholder="dash_ph_address"></div>
              </div>
            </div>
          </div>
          <!-- ID Card Back -->
          <div class="id-card-back" style="margin-top:var(--s-4)">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--s-4)">
              <img src="<?php echo get_template_directory_uri(); ?>/cha-logo-left.png" alt="CHA" style="height:36px">
              <div style="font-size:0.75rem;font-weight:700;color:var(--c-red);margin-right:8px" data-i18n="dash_card_title_back">Patient Identification Card</div>
            </div>
            <div style="font-size:0.6875rem;line-height:1.6;color:var(--c-gray-600)">
              <p style="margin:0 0 6px;font-weight:700;color:var(--c-blue)" data-i18n="dash_rules">Rules</p>
              <ol style="margin:0;padding-left:16px">
                <li data-i18n="dash_rule_1">This card is the property of the Cambodian Haemophilia Association.</li>
                <li data-i18n="dash_rule_2">Please present this card when receiving treatment services.</li>
                <li data-i18n="dash_rule_3">If lost, please contact the association immediately.</li>
              </ol>
            </div>
            <div style="display:flex;justify-content:flex-end;align-items:flex-end;margin-top:var(--s-5)">
              <div style="font-size:0.625rem;color:var(--c-muted);text-align:right">
                <div style="font-weight:700;color:var(--c-blue)" data-i18n="dash_member_id">Member ID</div>
                <div id="dash-patient-id-back"></div>
              </div>
            </div>
          </div>
          <div class="dash-actions" style="margin-top:var(--s-5);display:flex;flex-direction:column;align-items:center;gap:var(--s-3)">
            <button type="button" class="btn btn-primary" id="dash-print-card" style="width:100%"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/></svg><span data-i18n="dash_print_card">Print Card</span></button>
            <div id="dash-patient-actions" style="width:100%">
              <button type="button" class="btn btn-outline" id="dash-patient-edit-btn" style="width:100%"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg><span data-i18n="dash_edit_profile">Edit Profile</span></button>
              <div id="dash-patient-save-cancel" style="display:none;width:100%;grid-template-columns:1fr 1fr;gap:var(--s-3)">
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
                <img src="<?php echo get_template_directory_uri(); ?>/cha-logo-left.png" alt="Cambodian Haemophilia Association" style="height:52px;width:auto;max-width:200px;object-fit:contain">
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
                    <span data-i18n="contact_address_val"><?php echo esc_html(cha_get_option('contact_address', '#Building 100, Russia Blvd (114), Phnom Penh, Cambodia, P.O Box 700')); ?></span>
                </div>
                <div class="item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <a href="tel:<?php echo esc_attr(cha_get_option('contact_phone_digits', '+855962605335')); ?>"><?php echo esc_html(cha_get_option('contact_phone', '(+855) 96 260 5335')); ?></a>
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

  <!-- Botpress Chat Widget -->
  <script src="https://cdn.botpress.cloud/webchat/v5.0/inject.js"></script>
  <script src="https://files.bpcontent.cloud/2026/07/21/02/20260721025253-A1YF239M.js" defer></script>
</body>
</html>
