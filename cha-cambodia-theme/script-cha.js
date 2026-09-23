/* ============================================
   CHA Website — Interactivity
   Vanilla JS, no libraries
   ============================================ */

/* Global toast notification */
(function initChaToast() {
  var wrap = document.createElement('div');
  wrap.className = 'cha-toast-wrap';
  document.body.appendChild(wrap);
  var icons = {
    success: '<svg class="cha-toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
    error: '<svg class="cha-toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
    info: '<svg class="cha-toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>'
  };
  window.chaToast = function(msg, type, duration, linkText, linkCallback) {
    type = type || 'info';
    duration = duration || 3500;
    var t = document.createElement('div');
    t.className = 'cha-toast cha-toast-' + type;
    var html = (icons[type] || icons.info) + '<div class="cha-toast-body"><span class="cha-toast-text">' + msg + '</span>';
    if (linkText && linkCallback) {
      html += '<a href="#" class="cha-toast-link">' + linkText + '</a>';
    }
    html += '</div>';
    t.innerHTML = html;
    wrap.appendChild(t);
    if (linkText && linkCallback) {
      var linkEl = t.querySelector('.cha-toast-link');
      linkEl.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        linkCallback();
      });
    }
    setTimeout(function() { t.classList.add('show'); }, 10);
    setTimeout(function() {
      t.classList.add('hide');
      setTimeout(function() { if (t.parentNode) t.parentNode.removeChild(t); }, 400);
    }, duration);
  };
})();

/* Coming soon links — show toast instead of navigating */
document.addEventListener('click', function(e) {
  var link = e.target.closest('[data-coming-soon]');
  if (!link) return;
  e.preventDefault();
  chaToast('Coming soon! We\'re working on this feature.', 'info');
});

(function () {
  'use strict';

  // Handle custom radio buttons for donate modal payment methods
  function initDonateRadioButtons() {
    const donateModal = document.getElementById('donate-modal');
    if (!donateModal) return;

    const radioLabels = donateModal.querySelectorAll('.radio-pill');

    radioLabels.forEach((label) => {
      const radio = label.querySelector('input[type="radio"]');
      const radioIndicator = label.querySelector('span > span');

      // Initial state
      if (radio.checked) {
        label.style.borderColor = 'var(--c-red)';
        label.style.background = 'rgba(227,30,36,0.05)';
        if (radioIndicator) radioIndicator.style.display = 'flex';
      }

      label.addEventListener('click', (e) => {
        // Uncheck all others
        radioLabels.forEach((otherLabel) => {
          const otherRadio = otherLabel.querySelector('input[type="radio"]');
          const otherIndicator = otherLabel.querySelector('span > span');
          otherLabel.style.borderColor = 'var(--c-border)';
          otherLabel.style.background = 'transparent';
          if (otherIndicator) otherIndicator.style.display = 'none';
        });

        // Check this one
        radio.checked = true;
        label.style.borderColor = 'var(--c-red)';
        label.style.background = 'rgba(227,30,36,0.05)';
        if (radioIndicator) radioIndicator.style.display = 'flex';
      });
    });
  }

  // ---------- 1. Sticky header shadow on scroll ----------
  const header = document.querySelector('.site-header');
  if (header) {
    const onScroll = () => {
      if (window.scrollY > 8) header.classList.add('is-scrolled');
      else header.classList.remove('is-scrolled');
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  // ---------- 2. Mobile drawer ----------
  const toggle = document.querySelector('.nav-toggle');
  const drawer = document.querySelector('.mobile-drawer');
  const closeBtn = document.querySelector('.mobile-drawer .close');
  const backdrop = document.querySelector('.mobile-drawer .backdrop');

  function openDrawer() {
    if (!drawer) return;
    drawer.classList.add('is-open');
    document.body.style.overflow = 'hidden';
    const firstLink = drawer.querySelector('nav a');
    if (firstLink) firstLink.focus();
  }
  function closeDrawer() {
    if (!drawer) return;
    drawer.classList.remove('is-open');
    document.body.style.overflow = '';
  }

  if (toggle) toggle.addEventListener('click', openDrawer);
  if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
  if (backdrop) backdrop.addEventListener('click', closeDrawer);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && drawer && drawer.classList.contains('is-open')) {
      closeDrawer();
    }
  });

  // ---------- 3. Donation tabs (one-time / monthly) ----------
  const tabBtns = document.querySelectorAll('[data-tab-group]');
  tabBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      const target = btn.dataset.tabTarget;
      const group = btn.closest('[data-tabs]');
      const panelRoot = group || document;
      // Deactivate all buttons and panels within this tab group
      const scopeBtns = group ? group.querySelectorAll('[data-tab-group]') : document.querySelectorAll('[data-tab-group]');
      const scopePanels = group ? group.querySelectorAll('[data-tab-panel]') : document.querySelectorAll('[data-tab-panel]');
      scopeBtns.forEach((b) => b.classList.remove('is-active'));
      scopePanels.forEach((p) => p.classList.remove('is-active'));
      btn.classList.add('is-active');
      // Try to find panel within group first, then fallback to document
      let panel = group ? group.querySelector(`[data-tab-panel="${target}"]`) : null;
      if (!panel) panel = document.querySelector(`[data-tab-panel="${target}"]`);
      if (panel) panel.classList.add('is-active');
    });
  });

  // ---------- 4. News carousel ----------
  document.querySelectorAll('[data-carousel]').forEach((carousel) => {
    const track = carousel.querySelector('.carousel-track');
    const slides = carousel.querySelectorAll('.carousel-slide');
    const prev = carousel.querySelector('.carousel-prev');
    const next = carousel.querySelector('.carousel-next');
    const dotsWrap = carousel.querySelector('.carousel-dots');
    if (!track || slides.length === 0) return;

    let index = 0;
    let autoTimer;

    // Build dots
    if (dotsWrap) {
      slides.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = 'carousel-dot' + (i === 0 ? ' is-active' : '');
        dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
        dot.addEventListener('click', () => goTo(i));
        dotsWrap.appendChild(dot);
      });
    }

    function goTo(i) {
      index = (i + slides.length) % slides.length;
      track.style.transform = `translateX(-${index * 100}%)`;
      if (dotsWrap) {
        dotsWrap.querySelectorAll('.carousel-dot').forEach((d, j) =>
          d.classList.toggle('is-active', j === index)
        );
      }
    }
    function startAuto() {
      stopAuto();
      autoTimer = setInterval(() => goTo(index + 1), 6000);
    }
    function stopAuto() {
      if (autoTimer) clearInterval(autoTimer);
    }

    if (prev) prev.addEventListener('click', () => { goTo(index - 1); startAuto(); });
    if (next) next.addEventListener('click', () => { goTo(index + 1); startAuto(); });

    carousel.addEventListener('mouseenter', stopAuto);
    carousel.addEventListener('mouseleave', startAuto);
    startAuto();

    // Touch swipe
    let startX = 0;
    track.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; stopAuto(); }, { passive: true });
    track.addEventListener('touchend', (e) => {
      const dx = e.changedTouches[0].clientX - startX;
      if (Math.abs(dx) > 50) goTo(index + (dx < 0 ? 1 : -1));
      startAuto();
    });
  });

  // ---------- 5. Donation amount chip ----------
  document.querySelectorAll('[data-amount]').forEach((chip) => {
    chip.addEventListener('click', () => {
      const group = chip.closest('.amount-chips');
      if (group) group.querySelectorAll('[data-amount]').forEach((c) => c.classList.remove('is-active'));
      chip.classList.add('is-active');
      const val = chip.dataset.amount;
      const form = chip.closest('form');
      const other = form ? form.querySelector('[data-amount-other]') : null;
      if (other) {
        if (val === 'other') { other.style.display = ''; other.focus(); }
        else { other.style.display = 'none'; other.value = ''; }
      }
    });
  });

  // ---------- 6. Form mock submit ----------
  // Skip forms that have their own handler (registration, login, donate handled separately)
  document.querySelectorAll('[data-mock-form]').forEach((form) => {
    if (form.closest('#member-modal') || form.closest('#donate-modal')) return;
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      // Simple required validation
      let ok = true;
      form.querySelectorAll('[required]').forEach((field) => {
        if (!field.value || (field.type === 'checkbox' && !field.checked)) {
          ok = false;
          field.classList.add('is-invalid');
        } else {
          field.classList.remove('is-invalid');
        }
      });
      if (!ok) return;
      // Hide form, show success
      const success = form.parentElement.querySelector('[data-form-success]');
      if (success) {
        form.style.display = 'none';
        success.removeAttribute('hidden');
        success.scrollIntoView({ behavior: 'smooth', block: 'center' });
      } else {
        chaToast('Thank you! Your submission has been received.', 'success');
        form.reset();
      }
    });
  });

  // ---------- 7. Province → Map pin highlight & Card filter ----------
  const provinceSelect = document.querySelector('[data-province-select]');
  const cambodiaMap = document.querySelector('[data-cambodia-map]');
  if (provinceSelect) {
    const filterCards = () => {
      const v = (provinceSelect.value || '').toLowerCase().trim();
      if (cambodiaMap) {
        cambodiaMap.querySelectorAll('[data-province]').forEach((p) => {
          p.classList.toggle('is-highlighted', p.dataset.province === v);
        });
      }
      const cards = document.querySelectorAll('.tc-card[data-province]');
      cards.forEach((card) => {
        const cardProv = (card.dataset.province || '').toLowerCase().trim();
        if (!v || cardProv === v) {
          card.classList.remove('is-hidden');
          card.style.setProperty('display', 'grid', 'important');
        } else {
          card.classList.add('is-hidden');
          card.style.setProperty('display', 'none', 'important');
        }
      });
    };
    provinceSelect.addEventListener('change', filterCards);
    provinceSelect.addEventListener('input', filterCards);
    // Run once on load in case a province is preselected
    if (provinceSelect.value) {
      filterCards();
    }
  }

  // ---------- 8. Scroll reveal ----------
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12 }
    );
    document.querySelectorAll('[data-reveal]').forEach((el) => observer.observe(el));
  } else {
    document.querySelectorAll('[data-reveal]').forEach((el) => el.classList.add('is-visible'));
  }

  // ---------- 9. Active nav link based on scroll position (single-page) ----------
  const navLinks = document.querySelectorAll('.main-nav a, .mobile-drawer nav a');
  const sectionMap = new Map();
  navLinks.forEach((a) => {
    const href = a.getAttribute('href') || '';
    if (href.startsWith('#') && href !== '#') {
      const target = document.querySelector(href);
      if (target) sectionMap.set(href, a);
    }
  });

  if (sectionMap.size > 0 && 'IntersectionObserver' in window) {
    const setActive = (href) => {
      navLinks.forEach((a) => a.classList.remove('is-active'));
      sectionMap.forEach((link, h) => {
        if (h === href) link.classList.add('is-active');
      });
    };
    const navObserver = new IntersectionObserver(
      (entries) => {
        // Use the entry closest to the top of the viewport that is intersecting
        const visible = entries
          .filter((e) => e.isIntersecting)
          .sort((a, b) => a.boundingClientRect.top - b.boundingClientRect.top);
        if (visible.length > 0) {
          const id = '#' + visible[0].target.id;
          if (sectionMap.has(id)) setActive(id);
        }
      },
      { rootMargin: '-30% 0px -55% 0px', threshold: 0 }
    );
    sectionMap.forEach((_, href) => {
      const el = document.querySelector(href);
      if (el) navObserver.observe(el);
    });
  }

  // ---------- 10. Close mobile drawer on link click ----------
  document.querySelectorAll('.mobile-drawer nav a').forEach((a) => {
    a.addEventListener('click', () => {
      // Delay so the anchor scroll fires before we close
      setTimeout(closeDrawer, 50);
    });
  });

  // ---------- 11. Back-to-top button ----------
  const topBtn = document.querySelector('[data-back-to-top]');
  if (topBtn) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 600) topBtn.classList.add('is-visible');
      else topBtn.classList.remove('is-visible');
    }, { passive: true });
    topBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ---------- 12. Donate — static KHQR QR (no PayWay form) ----------
  function chaSubmitPaywayDonate() {
    // Disabled: website donate uses static ABA Pay / KHQR image only.
  }

  const donateForm = document.getElementById('donate-form-submit');
  if (donateForm) {
    donateForm.addEventListener('submit', (e) => {
      e.preventDefault();
    });
  }

  // ---------- 13. Nav dropdowns (desktop hover + click) ----------
  document.querySelectorAll('[data-nav-drop]').forEach((drop) => {
    const trigger = drop.querySelector('.nav-drop-trigger');
    if (!trigger) return;
    let leaveTimer;
    // Desktop hover with short delay on leave
    drop.addEventListener('mouseenter', () => {
      clearTimeout(leaveTimer);
      drop.classList.add('is-open');
    });
    drop.addEventListener('mouseleave', () => {
      leaveTimer = setTimeout(() => drop.classList.remove('is-open'), 80);
    });
    // Mobile tap toggle
    trigger.addEventListener('click', (e) => {
      e.stopPropagation();
      const wasOpen = drop.classList.contains('is-open');
      document.querySelectorAll('[data-nav-drop].is-open').forEach((d) => d.classList.remove('is-open'));
      if (!wasOpen) drop.classList.add('is-open');
    });
    // Close on Escape
    trigger.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') drop.classList.remove('is-open');
    });
  });
  // Click outside closes dropdowns
  document.addEventListener('click', () => {
    document.querySelectorAll('[data-nav-drop].is-open').forEach((d) => d.classList.remove('is-open'));
  });

  // ---------- 14. Mobile drawer sub-group toggles ----------
  document.querySelectorAll('.drawer-sub-trigger').forEach((btn) => {
    btn.addEventListener('click', () => {
      const group = btn.parentElement;
      group.classList.toggle('is-open');
      btn.setAttribute('aria-expanded', group.classList.contains('is-open'));
    });
  });

  // ---------- 15. Donate modal ----------
  const donateModal = document.getElementById('donate-modal');
  const donateTriggers = document.querySelectorAll('[data-donate-trigger]');
  const donateClosers = document.querySelectorAll('[data-donate-close]');

  const openModal = (e) => { if (e) e.preventDefault(); donateModal.classList.add('is-open'); donateModal.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden'; setTimeout(initDonateRadioButtons, 50); };
  const closeModal = () => { donateModal.classList.remove('is-open'); donateModal.setAttribute('aria-hidden', 'true'); document.body.style.overflow = ''; };

  donateTriggers.forEach((t) => t.addEventListener('click', openModal));
  donateClosers.forEach((c) => c.addEventListener('click', closeModal));
  donateModal.addEventListener('click', (e) => { if (e.target === donateModal) closeModal(); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && donateModal.classList.contains('is-open')) closeModal(); });

  // Modal donate form submit (form removed — static QR only)
  const modalForm = document.getElementById('donate-modal-form');
  if (modalForm) {
    modalForm.addEventListener('submit', (e) => {
      e.preventDefault();
    });
  }

  // Copy account number (homepage + modal QR cards)
  document.querySelectorAll('#donate-copy-btn, #donate-copy-btn-modal').forEach((copyBtn) => {
    const copyLabel = copyBtn.querySelector('[id^="donate-copy-label"]') || copyBtn;
    copyBtn.addEventListener('click', () => {
      const acctNum = '000283539';
      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(acctNum).catch(() => {});
      }
      copyBtn.classList.add('is-copied');
      copyLabel.textContent = 'Copied!';
      setTimeout(() => {
        copyBtn.classList.remove('is-copied');
        copyLabel.textContent = 'Copy';
      }, 2000);
    });
  });

  // ---------- 16. Member modal ----------
  const memberModal = document.getElementById('member-modal');
  const memberTriggers = document.querySelectorAll('[data-member-trigger]');
  const memberClosers = document.querySelectorAll('[data-member-close]');

  let closeMember = () => { memberModal.classList.remove('is-open'); memberModal.setAttribute('aria-hidden', 'true'); document.body.style.overflow = ''; };

  memberClosers.forEach((c) => c.addEventListener('click', closeMember));
  memberModal.addEventListener('click', (e) => { if (e.target === memberModal) closeMember(); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && memberModal.classList.contains('is-open')) closeMember(); });

  // Toggle between login and register panels
  const loginPanel = document.getElementById('member-login-panel');
  const registerPanel = document.getElementById('member-register-panel');
  const forgotPanel = document.getElementById('member-forgot-panel');

  const modalTitle = document.getElementById('member-modal-title');

  function setMemberModalTitle(key) {
    if (!modalTitle) return;
    modalTitle.setAttribute('data-i18n', key);
    var curLang = localStorage.getItem('cha-lang') || 'en';
    if (typeof window.chaUpdateMemberModalTitle === 'function') {
      window.chaUpdateMemberModalTitle(key);
      return;
    }
    var dict = (typeof i18n !== 'undefined' && i18n[curLang]) ? i18n[curLang] : null;
    if (dict && dict[key]) {
      modalTitle.textContent = dict[key];
    } else {
      modalTitle.textContent = key === 'member_register_modal_title' ? 'Register' : (key === 'member_forgot_title' ? 'Reset Password' : 'Member Login');
    }
  }

  // Register-specific trigger (hero button): open modal and show register panel
  const registerTriggers = document.querySelectorAll('[data-member-register-trigger]');
  registerTriggers.forEach((t) => t.addEventListener('click', (e) => {
    e.preventDefault();
    memberModal.classList.add('is-open'); memberModal.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden';
    if (loginPanel) loginPanel.style.display = 'none';
    if (registerPanel) registerPanel.style.display = 'block';
    setMemberModalTitle('member_register_modal_title');
  }));

  const registerLink = memberModal.querySelector('[data-member-register]');
  const backLoginLink = memberModal.querySelector('[data-member-back-login]');
  if (registerLink) registerLink.addEventListener('click', (e) => { e.preventDefault(); loginPanel.style.display = 'none'; registerPanel.style.display = 'block'; setMemberModalTitle('member_register_modal_title'); });
  if (backLoginLink) backLoginLink.addEventListener('click', (e) => { e.preventDefault(); registerPanel.style.display = 'none'; loginPanel.style.display = 'block'; setMemberModalTitle('member_login_title'); });

  // Forgot-password panel: open from login link, back returns to login
  const forgotLink = memberModal.querySelector('[data-member-forgot]');
  const backLoginForgotLink = memberModal.querySelector('[data-member-back-login-forgot]');
  if (forgotLink) forgotLink.addEventListener('click', (e) => { e.preventDefault(); loginPanel.style.display = 'none'; if (forgotPanel) forgotPanel.style.display = 'block'; setMemberModalTitle('member_forgot_title'); });
  if (backLoginForgotLink) backLoginForgotLink.addEventListener('click', (e) => { e.preventDefault(); if (forgotPanel) forgotPanel.style.display = 'none'; loginPanel.style.display = 'block'; setMemberModalTitle('member_login_title'); });

  // Reset to login on close
  const origCloseMember = closeMember;
  closeMember = () => { origCloseMember(); if (loginPanel) loginPanel.style.display = 'block'; if (registerPanel) registerPanel.style.display = 'none'; if (forgotPanel) forgotPanel.style.display = 'none'; setMemberModalTitle('member_login_title'); };

  // ---- Role selector: toggle patient fields ----
  const roleOptions = registerPanel.querySelectorAll('.role-option');
  const patientFields = document.getElementById('patient-fields');
  const reqPatientList = registerPanel.querySelectorAll('.req-patient');
  roleOptions.forEach(function(opt) {
    opt.addEventListener('click', function() {
      roleOptions.forEach(function(o) { o.style.borderColor = 'var(--c-border)'; o.style.background = 'transparent'; });
      opt.style.borderColor = 'var(--c-blue)';
      opt.style.background = 'rgba(11,29,109,0.04)';
      var radio = opt.querySelector('input[type="radio"]');
      if (radio) radio.checked = true;
      var isPatient = radio && radio.value === 'Patient';
      if (patientFields) patientFields.style.display = isPatient ? 'block' : 'none';
      reqPatientList.forEach(function(r) { r.style.display = isPatient ? 'inline' : 'none'; });
    });
  });
  // Init: select default role
  if (roleOptions.length > 0) { roleOptions[0].click(); }

  // ---- API auth: registration ----
  const regForm = registerPanel.querySelector('form[data-mock-form]');
  if (regForm) regForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    e.stopPropagation();
    const name = document.getElementById('mregname').value.trim();
    const email = document.getElementById('mregemail').value.trim();
    const pass = document.getElementById('mregpass').value;
    const phone = document.getElementById('mregphone').value.trim();
    const address = document.getElementById('mregaddress').value.trim();
    const consented = document.getElementById('mregconsent').checked;
    const roleRadio = registerPanel.querySelector('input[name="mregrole"]:checked');
    const role = roleRadio ? roleRadio.value : 'Member';
    if (!name || !email || !pass) { chaToast('Please fill in all required fields.', 'error'); return; }
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) { chaToast('Please enter a valid email address.', 'error'); return; }
    var emailDomain = email.split('@')[1].toLowerCase();
    var allowedDomains = ['gmail.com','yahoo.com','outlook.com','hotmail.com','live.com','icloud.com','aol.com','protonmail.com','proton.me','mail.com','com.kh'];
    if (allowedDomains.indexOf(emailDomain) === -1) { chaToast('Please use a valid email address (gmail.com, yahoo.com, outlook.com, etc.).', 'error'); return; }
    if (!consented) { chaToast('Please agree to the Terms &amp; Conditions.', 'error'); return; }
    
    if (role === 'Patient') {
      const dob = document.getElementById('mregdob').value.trim();
      var condSel = document.getElementById('mregcondition');
      var condVal = condSel.value === 'Other' ? document.getElementById('mregcondition-other').value.trim() : condSel.value;
      var bloodVal = document.getElementById('mregblood').value;
      if (!phone || !address || !dob || !condVal || !bloodVal) {
        chaToast('Patients must provide phone, address, date of birth, hemophilia type, and blood type.', 'error');
        return;
      }
    }

    const body = { name, email, password: pass, phone, address, role };
    if (role === 'Patient') {
      body.dob = document.getElementById('mregdob').value;
      var condSel = document.getElementById('mregcondition');
      body.condition = condSel.value === 'Other' ? document.getElementById('mregcondition-other').value.trim() || 'Other' : condSel.value;
      body.bloodType = document.getElementById('mregblood').value;
    }
    try {
      const res = await fetch(chaApi.rest_url + 'register', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(body),
      });
      const data = await res.json();
      if (!res.ok) { chaToast(data.message || 'Registration failed.', 'error'); return; }
      if (regForm) regForm.reset();
      closeMember();
      chaToast('Please verify your email to continue.', 'success', 12000);
    } catch (err) {
      chaToast('Network error. Please try again.', 'error');
    }
  });

  // ---- Hemophilia Type: show/hide "Other" text input ----
  function initHemophiliaOther(selectId, otherId) {
    var sel = document.getElementById(selectId);
    var other = document.getElementById(otherId);
    if (!sel || !other) return;
    sel.addEventListener('change', function() {
      other.style.display = this.value === 'Other' ? 'block' : 'none';
      if (this.value !== 'Other') other.value = '';
    });
  }
initHemophiliaOther('mregcondition', 'mregcondition-other');

  // Simple dd/mm/yyyy auto-format for typing
  ['mregdob', 'p-edit-dob'].forEach(function(id) {
    var el = document.getElementById(id);
    if (el) {
      el.addEventListener('input', function() {
        var v = this.value.replace(/[^\d/]/g, '');
        if (v.length === 2 || v.length === 5) v += '/';
        this.value = v.slice(0, 10);
      });
    }
  });

  // ---- API auth: login ----
  const loginForm = loginPanel.querySelector('form[data-mock-form]');
  if (loginForm) loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    e.stopPropagation();
    const email = document.getElementById('memail').value.trim();
    const pass = document.getElementById('mpass').value;
    if (!email || !pass) { chaToast('Please enter your email and password.', 'error'); return; }
    try {
      const res = await fetch(chaApi.rest_url + 'login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password: pass }),
      });
      const data = await res.json();
      if (!res.ok) {
        // Check if this is a pending/unverified account
        if (data.code === 'not_verified') {
          chaToast('Email not verified yet.', 'error', 12000, 'Resend email →', function() {
            // Resend verification email
            fetch(chaApi.rest_url + 'resend-verification', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ email: email }),
            }).then(function(r) { return r.json(); }).then(function(d) {
              chaToast(d.message || 'Verification email sent!', 'success');
            }).catch(function() {
              chaToast('Failed to send email. Please try again.', 'error');
            });
          });
          return;
        }
        chaToast(data.message || 'Invalid email or password.', 'error');
        return;
      }
      localStorage.setItem('cha_current_user', JSON.stringify(data));
      closeMember();
      updateMemberButton(data);
      chaToast('Welcome back, ' + data.name + '!', 'success');
    } catch (err) {
      chaToast('Network error. Please try again.', 'error');
    }
  });

  // ---- API auth: forgot password ----
  const forgotForm = forgotPanel ? forgotPanel.querySelector('form[data-mock-form]') : null;
  if (forgotForm) forgotForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    e.stopPropagation();
    const email = document.getElementById('mforgotemail').value.trim();
    if (!email) { chaToast('Please enter your email address.', 'error'); return; }
    try {
      const res = await fetch(chaApi.rest_url + 'forgot-password', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email }),
      });
      const data = await res.json();
      if (!res.ok) { chaToast(data.message || 'Could not send reset link.', 'error'); return; }
      if (forgotForm) forgotForm.reset();
      if (forgotPanel) forgotPanel.style.display = 'none';
      if (loginPanel) loginPanel.style.display = 'block';
      setMemberModalTitle('member_login_title');
      chaToast(data.message || 'If an account exists for that email, a reset link has been sent.', 'success', 12000);
    } catch (err) {
      chaToast('Network error. Please try again.', 'error');
    }
  });

  // ---- Dashboard modal ----
  const dashboardModal = document.getElementById('dashboard-modal');
  const dashboardClosers = document.querySelectorAll('[data-dashboard-close]');
  const dashMemberView = document.getElementById('dash-member-view');
  const dashPatientView = document.getElementById('dash-patient-view');

  function openDashboard() {
    const user = JSON.parse(localStorage.getItem('cha_current_user') || 'null');
    if (!user) return;
    dashboardModal.classList.add('is-open');
    dashboardModal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    populateDashboard(user);
    refreshDashboardProfile();
  }
  function refreshDashboardProfile() {
    const cached = JSON.parse(localStorage.getItem('cha_current_user') || 'null');
    if (!cached) return;
    fetch(chaApi.rest_url + 'member/profile?email=' + encodeURIComponent(cached.email), {
      method: 'GET',
      headers: { 'X-WP-Nonce': chaApi.nonce },
    }).then(function(res) { return res.json(); }).then(function(fresh) {
      if (!fresh || fresh.code || !fresh.memberId) return;
      localStorage.setItem('cha_current_user', JSON.stringify(fresh));
      populateDashboard(fresh);
    }).catch(function() { /* keep cached data on network error */ });
  }
  function closeDashboard() {
    dashboardModal.classList.remove('is-open');
    dashboardModal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }
  dashboardClosers.forEach(function(c) { c.addEventListener('click', closeDashboard); });
  dashboardModal.addEventListener('click', function(e) { if (e.target === dashboardModal) closeDashboard(); });
  document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && dashboardModal.classList.contains('is-open')) closeDashboard(); });

  function populateDashboard(user) {
    const isPatient = user.role === 'Patient';
    if (dashMemberView) dashMemberView.style.display = isPatient ? 'none' : 'block';
    if (dashPatientView) dashPatientView.style.display = isPatient ? 'block' : 'none';
    if (isPatient) {
      populatePatientCard(user);
    } else {
      populateMemberView(user);
    }
  }
  function populateMemberView(user) {
    var initials = (user.name || '?').split(' ').map(function(w){ return w[0]; }).join('').substring(0,2).toUpperCase();
    var avatarFallback = document.getElementById('dash-member-avatar');
    var photoImg = document.getElementById('dash-member-photo');
    var photoDel = document.getElementById('dash-member-photo-delete');

    if (avatarFallback) avatarFallback.textContent = initials;
    if (user.photo && photoImg) {
      photoImg.src = user.photo;
      photoImg.style.display = 'block';
      if (avatarFallback) avatarFallback.style.display = 'none';
      if (photoDel) photoDel.style.display = 'flex';
    } else {
      if (photoImg) { photoImg.src = ''; photoImg.style.display = 'none'; }
      if (avatarFallback) avatarFallback.style.display = 'flex';
      if (photoDel) photoDel.style.display = 'none';
    }

    document.getElementById('dash-member-name').textContent = user.name || '';
    var nameVal = document.getElementById('dash-member-name-val');
    if (nameVal) nameVal.textContent = user.name || '';
    var roleBadge = document.getElementById('dash-member-role-badge');
    if (roleBadge) roleBadge.textContent = user.role || 'Member';

    document.getElementById('dash-member-id').textContent = user.memberId || '';
    document.getElementById('dash-member-email').textContent = user.email || '';
    document.getElementById('dash-member-phone').textContent = user.phone || 'Not provided';
    document.getElementById('dash-member-address').textContent = user.address || '—';
    document.getElementById('dash-member-since').textContent = user.memberSince || '';
  }
  function formatDateDisplay(dateStr) {
    if (!dateStr) return '';
    if (/^\d{2}\/\d{2}\/\d{4}$/.test(dateStr)) return dateStr;
    var m = dateStr.match(/^(\d{4})-(\d{2})-(\d{2})$/);
    return m ? m[3] + '/' + m[2] + '/' + m[1] : dateStr;
  }

  // ── Date picker (dd/mm/yyyy) ──
  function initDatePicker(inputId, pickerId) {
    var input = document.getElementById(inputId);
    var picker = document.getElementById(pickerId);
    if (!input || !picker) return;
    var currentDate = new Date();
    var selectedDate = null;

    function parseDate(str) {
      if (!str) return null;
      var parts = str.split('/');
      if (parts.length === 3) {
        var d = parseInt(parts[0], 10), m = parseInt(parts[1], 10) - 1, y = parseInt(parts[2], 10);
        if (!isNaN(d) && !isNaN(m) && !isNaN(y)) {
          var dt = new Date(y, m, d);
          if (dt.getDate() === d && dt.getMonth() === m && dt.getFullYear() === y) return dt;
        }
      }
      return null;
    }

    function formatDate(dt) {
      if (!dt) return '';
      var d = String(dt.getDate()).padStart(2, '0');
      var m = String(dt.getMonth() + 1).padStart(2, '0');
      var y = dt.getFullYear();
      return d + '/' + m + '/' + y;
    }

    function render() {
      var year = currentDate.getFullYear();
      var month = currentDate.getMonth();
      var firstDay = new Date(year, month, 1).getDay();
      var daysInMonth = new Date(year, month + 1, 0).getDate();
      var prevMonthDays = new Date(year, month, 0).getDate();
      var today = new Date();
      today.setHours(0,0,0,0);

      var monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];

      var html = '<div class="date-picker-header"><button class="date-picker-nav" data-nav="-1">‹</button><span class="date-picker-title">' + monthNames[month] + ' ' + year + '</span><button class="date-picker-nav" data-nav="1">›</button></div>';
      html += '<div class="date-picker-grid">';
      ['Su','Mo','Tu','We','Th','Fr','Sa'].forEach(function(d){ html += '<div class="date-picker-dow">' + d + '</div>'; });

      // previous month trailing days
      for (var i = firstDay - 1; i >= 0; i--) {
        var pd = prevMonthDays - i;
        html += '<button type="button" class="date-picker-day other-month" data-date="' + (month === 0 ? year - 1 : year) + '-' + String((month === 0 ? 11 : month) + 1).padStart(2,'0') + '-' + String(pd).padStart(2,'0') + '">' + pd + '</button>';
      }
      // current month days
      for (var d = 1; d <= daysInMonth; d++) {
        var dt = new Date(year, month, d);
        var isToday = dt.getTime() === today.getTime();
        var isSelected = selectedDate && dt.getTime() === selectedDate.getTime();
        html += '<button type="button" class="date-picker-day' + (isToday ? ' today' : '') + (isSelected ? ' selected' : '') + '" data-date="' + year + '-' + String(month+1).padStart(2,'0') + '-' + String(d).padStart(2,'0') + '">' + d + '</button>';
      }
      // next month leading days
      var totalCells = firstDay + daysInMonth;
      var nextMonthCells = (7 - (totalCells % 7)) % 7;
      for (var n = 1; n <= nextMonthCells; n++) {
        html += '<button type="button" class="date-picker-day other-month" data-date="' + (month === 11 ? year + 1 : year) + '-' + String((month + 2) > 12 ? 1 : month + 2).padStart(2,'0') + '-' + String(n).padStart(2,'0') + '">' + n + '</button>';
      }
      html += '</div>';
      picker.innerHTML = html;

      // nav buttons
      picker.querySelectorAll('.date-picker-nav').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
          e.stopPropagation();
          currentDate.setMonth(currentDate.getMonth() + parseInt(btn.dataset.nav, 10));
          render();
        });
      });
      // day buttons
      picker.querySelectorAll('.date-picker-day:not(.other-month)').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
          e.stopPropagation();
          var ds = btn.dataset.date;
          selectedDate = new Date(ds + 'T00:00:00');
          input.value = formatDate(selectedDate);
          picker.classList.remove('open');
        });
      });
    }

    function open() {
      var val = parseDate(input.value);
      if (val) { currentDate = val; selectedDate = val; }
      else { currentDate = new Date(); selectedDate = null; }
      render();
      picker.classList.add('open');
    }

    function close() { picker.classList.remove('open'); }

    input.addEventListener('click', function(e) { e.stopPropagation(); open(); });
    input.addEventListener('focus', open);
    document.addEventListener('click', close);
    picker.addEventListener('click', function(e) { e.stopPropagation(); });
    input.addEventListener('blur', function() { setTimeout(close, 150); });

    // keyboard: allow typing dd/mm/yyyy
    input.addEventListener('input', function() {
      var v = input.value.replace(/[^\d/]/g, '');
      if (v.length === 2 || v.length === 5) v += '/';
      input.value = v.slice(0, 10);
    });
  }

  // init both pickers
  initDatePicker('mregdob', 'mregdob-picker');
  initDatePicker('p-edit-dob', 'p-edit-dob-picker');
  function syncDateDisplay(inputId, displayId) {
    var input = document.getElementById(inputId);
    var display = document.getElementById(displayId);
    if (!input || !display) return;
    function update() {
      display.textContent = input.value ? formatDateDisplay(input.value) : '';
    }
    input.addEventListener('change', update);
    input.addEventListener('input', update);
    update();
  }

  function populatePatientCard(user) {
    document.getElementById('dash-patient-name').textContent = user.name || '';
    document.getElementById('dash-patient-id').textContent = user.memberId || '';
    document.getElementById('dash-patient-name-display').textContent = user.name || '';
    var khmerNameEl = document.getElementById('dash-patient-name-khmer');
    if (khmerNameEl) khmerNameEl.textContent = user.nameKhmer || user.name || '—';
    document.getElementById('dash-patient-dob').textContent = formatDateDisplay(user.dob) || 'Not set';
    document.getElementById('dash-patient-condition').textContent = user.condition || 'Not set';
    document.getElementById('dash-patient-blood').textContent = user.bloodType || 'Not set';
    document.getElementById('dash-patient-phone').textContent = user.phone || 'Not provided';
    var backId = document.getElementById('dash-patient-id-back');
    if (backId) backId.textContent = user.memberId || '';
    document.getElementById('dash-patient-created').textContent = user.registered ? user.registered.slice(0, 10) : '—';
    document.getElementById('dash-patient-address').textContent = user.address || '—';
    
    // QR Code Generation — links directly to official member verification record
    var qrImg = document.getElementById('dash-patient-qr');
    if (qrImg && user.memberId) {
      var verifyUrl = window.location.origin + '/verify-member?id=' + encodeURIComponent(user.memberId);
      qrImg.src = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' + encodeURIComponent(verifyUrl);
    }
    // Photo
    var photo = document.getElementById('dash-patient-photo');
    var placeholder = document.getElementById('dash-patient-photo-placeholder');
    var delBtn = document.getElementById('dash-photo-delete');
    if (user.photo) {
      photo.src = user.photo;
      photo.style.display = 'block';
      placeholder.style.display = 'none';
      if (delBtn) delBtn.style.display = 'flex';
      photo.onload = function() { if (window._lockFlipperHeight) window._lockFlipperHeight(); };
    } else {
      photo.style.display = 'none';
      placeholder.style.display = 'flex';
      if (delBtn) delBtn.style.display = 'none';
    }
    if (window._lockFlipperHeight) setTimeout(window._lockFlipperHeight, 50);
  }

  // Photo upload (Member + Patient)
  ['patient-photo-input', 'member-photo-input'].forEach(function(inputId) {
    var photoInput = document.getElementById(inputId);
    if (!photoInput) return;
    photoInput.addEventListener('change', async function() {
      var file = this.files[0];
      if (!file) return;
      var user = JSON.parse(localStorage.getItem('cha_current_user') || 'null');
      if (!user) return;
      var formData = new FormData();
      formData.append('photo', file);
      formData.append('memberId', user.memberId);
      try {
        var res = await fetch(chaApi.rest_url + 'member/photo', {
          method: 'POST',
          headers: { 'X-WP-Nonce': chaApi.nonce },
          body: formData,
        });
        var data = await res.json();
        if (data.success && data.photoUrl) {
          user.photo = data.photoUrl;
          localStorage.setItem('cha_current_user', JSON.stringify(user));
          populateDashboard(user);
          chaToast('Photo updated!', 'success');
        } else {
          chaToast(data.message || 'Upload failed.', 'error');
        }
      } catch (err) {
        chaToast('Upload failed. Please try again.', 'error');
      }
    });
  });

  // Photo delete (Member + Patient)
  ['dash-photo-delete', 'dash-member-photo-delete'].forEach(function(btnId) {
    var deleteBtn = document.getElementById(btnId);
    if (!deleteBtn) return;
    deleteBtn.addEventListener('click', async function() {
      var user = JSON.parse(localStorage.getItem('cha_current_user') || 'null');
      if (!user) return;
      try {
        var res = await fetch(chaApi.rest_url + 'member/photo/delete', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-WP-Nonce': chaApi.nonce },
          body: 'memberId=' + encodeURIComponent(user.memberId),
        });
        var data = await res.json();
        if (data.success) {
          user.photo = '';
          localStorage.setItem('cha_current_user', JSON.stringify(user));
          populateDashboard(user);
          chaToast('Photo removed.', 'success');
        }
      } catch (err) {
        chaToast('Failed to remove photo.', 'error');
      }
    });
  });

  // Card 3D Flip Handler
  var flipBtn = document.getElementById('dash-card-flip-btn');
  var flipper = document.getElementById('dash-id-card-flipper');
  var scene = document.querySelector('.id-card-scene');
  var sideIndicator = document.getElementById('dash-card-side-indicator');
  var flipAnimating = false;
  window._lockFlipperHeight = function() {
    if (!flipper) return;
    var front = flipper.querySelector('.id-card-front');
    var back = flipper.querySelector('.id-card-back');
    if (!front || !back) return;
    var maxH = Math.max(front.scrollHeight, back.scrollHeight);
    if (maxH > 0) flipper.style.height = maxH + 'px';
  };
  if (flipBtn && flipper) {
    window._lockFlipperHeight();

    flipBtn.addEventListener('click', function() {
      if (flipAnimating) return;
      flipAnimating = true;
      var isFlipped = flipper.classList.contains('is-flipped');

      if (sideIndicator) {
        sideIndicator.textContent = isFlipped ? 'Front Side' : 'Back Side';
      }

      window._lockFlipperHeight();

      flipper.style.transition = 'transform 0.35s cubic-bezier(0.4, 0, 0.2, 1)';
      flipper.style.transform = 'rotateY(90deg)';

      setTimeout(function() {
        flipper.classList.toggle('is-flipped');
        window._lockFlipperHeight();

        flipper.style.transition = 'none';
        flipper.style.transform = 'rotateY(-90deg)';
        flipper.offsetHeight;
        flipper.style.transition = 'transform 0.35s cubic-bezier(0.4, 0, 0.2, 1)';
        flipper.style.transform = 'rotateY(0deg)';

        setTimeout(function() {
          flipper.style.transition = '';
          flipper.style.transform = '';
          window._lockFlipperHeight();
          flipAnimating = false;
        }, 350);
      }, 350);
    });
  }

  // Logout buttons in dashboard
  document.querySelectorAll('[data-dashboard-logout]').forEach(function(btn) {
    btn.addEventListener('click', function() {
      localStorage.removeItem('cha_current_user');
      closeDashboard();
      updateMemberButton(null);
      chaToast('You have been signed out.', 'info');
    });
  });

  // ---- Edit profile: Member (in-place) ----
  var memberEditBtn = document.getElementById('dash-member-edit-btn');
  var memberSaveBtn = document.getElementById('dash-member-save-btn');
  var memberCancelBtn = document.getElementById('dash-member-cancel-btn');
  var memberEditActions = document.getElementById('dash-member-save-cancel');
  var memberView = document.getElementById('dash-member-view');

  if (memberEditBtn) {
    memberEditBtn.addEventListener('click', function() {
      var user = JSON.parse(localStorage.getItem('cha_current_user') || 'null');
      if (!user) return;
      var nameEdit = document.getElementById('m-edit-name');
      if (nameEdit) nameEdit.value = user.name || '';
      document.getElementById('m-edit-email').value = user.email || '';
      document.getElementById('m-edit-phone').value = user.phone || '';
      document.getElementById('m-edit-address').value = user.address || '';
      memberView.classList.add('editing');
      memberEditBtn.style.display = 'none';
      memberEditActions.style.display = 'grid';
    });
  }
  if (memberCancelBtn) {
    memberCancelBtn.addEventListener('click', function() {
      memberView.classList.remove('editing');
      memberEditBtn.style.display = 'inline-flex';
      memberEditActions.style.display = 'none';
    });
  }
  if (memberSaveBtn) {
    memberSaveBtn.addEventListener('click', async function() {
      var user = JSON.parse(localStorage.getItem('cha_current_user') || 'null');
      if (!user) return;
      var nameEdit = document.getElementById('m-edit-name');
      var name = nameEdit ? nameEdit.value.trim() : '';
      var email = document.getElementById('m-edit-email').value.trim();
      var phone = document.getElementById('m-edit-phone').value.trim();
      var address = document.getElementById('m-edit-address').value.trim();
      var payload = { memberId: user.memberId };
      if (name && name !== user.name) payload.name = name;
      if (email && email !== user.email) payload.email = email;
      if (phone !== (user.phone || '')) payload.phone = phone;
      if (address !== (user.address || '')) payload.address = address;
      if (Object.keys(payload).length < 2) { chaToast('No changes to save.', 'info'); memberView.classList.remove('editing'); memberEditBtn.style.display = 'inline-flex'; memberEditActions.style.display = 'none'; return; }
      try {
        var res = await fetch(chaApi.rest_url + 'member/profile', {
          method: 'PUT',
          headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': chaApi.nonce },
          body: JSON.stringify(payload),
        });
        var data = await res.json();
        if (!res.ok) { chaToast(data.message || 'Failed to save.', 'error'); return; }
        localStorage.setItem('cha_current_user', JSON.stringify(data));
        populateMemberView(data);
        memberView.classList.remove('editing');
        memberEditBtn.style.display = 'inline-flex';
        memberEditActions.style.display = 'none';
        chaToast('Profile updated!', 'success');
      } catch (err) { chaToast('Network error.', 'error'); }
    });
  }

  // ---- Edit profile: Patient (in-place on ID card) ----
  var patientEditBtn = document.getElementById('dash-patient-edit-btn');
  var patientSaveBtn = document.getElementById('dash-patient-save-btn');
  var patientCancelBtn = document.getElementById('dash-patient-cancel-btn');
  var patientSaveCancel = document.getElementById('dash-patient-save-cancel');
  var patientView = document.getElementById('dash-patient-view');

  function populatePatientEditInputs(user) {
    document.getElementById('p-edit-name').value = user.name || '';
    document.getElementById('p-edit-name-khmer').value = user.nameKhmer || '';
    document.getElementById('p-edit-dob').value = user.dob || '';
    var cond = user.condition || '';
    var condSel = document.getElementById('p-edit-condition');
    if (condSel) {
      if (['Hemophilia A','Hemophilia B','Other'].indexOf(cond) >= 0) {
        condSel.value = cond;
      } else if (cond) {
        condSel.value = 'Other';
      } else {
        condSel.value = '';
      }
    }
    var bt = document.getElementById('p-edit-blood');
    if (user.bloodType) { bt.value = user.bloodType; }
    document.getElementById('p-edit-phone').value = user.phone || '';
    document.getElementById('p-edit-address').value = user.address || '';
  }

  if (patientEditBtn) {
    patientEditBtn.addEventListener('click', function() {
      var user = JSON.parse(localStorage.getItem('cha_current_user') || 'null');
      if (!user) return;
      populatePatientEditInputs(user);
      patientView.classList.add('editing');
      patientEditBtn.style.display = 'none';
      patientSaveCancel.style.display = 'grid';
    });
  }
  if (patientCancelBtn) {
    patientCancelBtn.addEventListener('click', function() {
      patientView.classList.remove('editing');
      patientEditBtn.style.display = 'inline-flex';
      patientSaveCancel.style.display = 'none';
    });
  }
  if (patientSaveBtn) {
    patientSaveBtn.addEventListener('click', async function() {
      var user = JSON.parse(localStorage.getItem('cha_current_user') || 'null');
      if (!user) return;
      var payload = { memberId: user.memberId };
      var name = document.getElementById('p-edit-name').value.trim();
      var nameKhmer = document.getElementById('p-edit-name-khmer').value.trim();
      var dob = document.getElementById('p-edit-dob').value;
      var condSel = document.getElementById('p-edit-condition');
      var condition = condSel ? condSel.value : '';
      var bloodType = document.getElementById('p-edit-blood').value;
      var phone = document.getElementById('p-edit-phone').value.trim();
      var address = document.getElementById('p-edit-address').value.trim();
      if (name && name !== user.name) payload.name = name;
      if (nameKhmer !== (user.nameKhmer || '')) payload.nameKhmer = nameKhmer;
      if (phone !== (user.phone || '')) payload.phone = phone;
      if (address !== (user.address || '')) payload.address = address;
      if (dob !== (formatDateDisplay(user.dob) || '')) payload.dob = dob;
      if (condition !== (user.condition || '')) payload.condition = condition;
      if (bloodType !== (user.bloodType || '')) payload.bloodType = bloodType;
      if (Object.keys(payload).length < 2) { chaToast('No changes to save.', 'info'); patientView.classList.remove('editing'); patientEditBtn.style.display = 'inline-flex'; patientSaveCancel.style.display = 'none'; return; }
      try {
        var res = await fetch(chaApi.rest_url + 'member/profile', {
          method: 'PUT',
          headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': chaApi.nonce },
          body: JSON.stringify(payload),
        });
        var data = await res.json();
        if (!res.ok) { chaToast(data.message || 'Failed to save.', 'error'); return; }
        localStorage.setItem('cha_current_user', JSON.stringify(data));
        populatePatientCard(data);
        patientView.classList.remove('editing');
        patientEditBtn.style.display = 'inline-flex';
        patientSaveCancel.style.display = 'none';
        chaToast('Profile updated!', 'success');
      } catch (err) { chaToast('Network error.', 'error'); }
    });
  }

  // ---- localStorage auth: check session on load ----
  function updateMemberButton(user) {
    const triggers = document.querySelectorAll('[data-member-trigger]');
    triggers.forEach(t => {
      if (user) {
        t.textContent = 'My Card';
        t.setAttribute('data-i18n', 'nav_my_card');
      } else {
        t.textContent = 'Become a Member';
        t.setAttribute('data-i18n', 'nav_become_member');
      }
    });
  }
  const currentUser = JSON.parse(localStorage.getItem('cha_current_user') || 'null');
  if (currentUser) updateMemberButton(currentUser);

  // ---- Button click: if logged in, open dashboard; else open modal ----
  memberTriggers.forEach((t) => {
    t.addEventListener('click', (e) => {
      e.preventDefault();
      const u = JSON.parse(localStorage.getItem('cha_current_user') || 'null');
      if (u) {
        openDashboard();
      } else {
        memberModal.classList.add('is-open'); memberModal.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden';
        if (loginPanel) loginPanel.style.display = 'block';
        if (registerPanel) registerPanel.style.display = 'none';
        setMemberModalTitle('member_login_title');
      }
    });
  });
})();

/* ============================================
   i18n — Bilingual EN/KM Language Toggle
   ============================================ */
(function(){
  const i18n = {
    en: {
      /* Nav */
      lang_label: "EN",
      nav_home: "Home",
      nav_about_us: "About Us",
      nav_about: "About Us",
      nav_who_is_cha: "Who is CHA?",
      nav_leadership: "Leadership structure and Groups",
      nav_src: "SRC",
      nav_history: "Our History",
      nav_wfh: "Our work with WFH and HFA",
      nav_contact_us: "Contact Us",
      nav_about_who: "Who is CHA?",
      nav_about_leadership: "Leadership structure and Groups",
      nav_about_src: "SRC",
      nav_about_history: "Our History",
      nav_about_wfh: "Our work with WFH and HFA",
      nav_about_contact: "Contact Us",
      nav_about_haemophilia: "About Haemophilia",
      nav_haemophilia: "About Haemophilia",
      nav_haemophilia_about: "About Haemophilia",
      nav_haemophilia_vwd: "About VWD",
      nav_haemophilia_other: "About other bleeding disorders",
      nav_news_latest: "Latest News",
      nav_news_events: "Upcoming Events",
      nav_about_vwd: "About VWD",
      nav_other_bleeding: "About other bleeding disorders",
      nav_treatment_centres: "Treatment Centres",
      nav_programs: "Haemophilia Treatment Centres",
      nav_csr: "CSR Program",
      nav_csr_program: "CSR Program",
      nav_csr_fundraising: "Fundraising",
      nav_csr_donate: "Online donation",
      nav_csr_partners: "Corporate Partners",
      nav_news: "News",
      nav_latest_news: "Latest News",
      nav_upcoming_events: "Upcoming Events",
      nav_contact: "Contact",
      nav_become_member: "Become a Member",
      nav_donate: "Donate",
      nav_become_member_aria: "Member login",
      nav_donate_aria: "Open donation form",
      lang_switcher_aria: "Switch language",
      /* Hero */
      hero_title_1: "Together We Care.",
      hero_title_2: "Together We Change Lives.",
      hero_lead: "Supporting and empowering people with bleeding disorders across Cambodia.",
      hero_cta_support: "Get Support",
      /* Stats */
      stat_provinces: "Provinces and Cities",
      stat_patients: "Hemophilia Patients",
      stat_partners: "Healthcare Partners",
      /* How We Help */
      help_heading: "How We Help",
      help_sub: "Four core areas where CHA makes a difference for patients and families across Cambodia.",
      help_patient_support: "Patient Support",
      help_patient_support_desc: "Emotional support, guidance and community for patients and families.",
      help_treatment: "Treatment Centres",
      help_treatment_desc: "Find haemophilia treatment centres near you and get the care you need.",
      help_become_member: "Become a Member",
      help_become_member_desc: "Join our community and access exclusive resources and programs.",
      help_donate: "Donate",
      help_donate_desc: "Your support helps us provide treatment, education and hope.",
      help_learn_more: "Learn More",
      help_join_now: "Join Now",
      help_donate_now: "Donate Now",
      chatWithUs: "Chat with us",
      /* News */
      news_heading: "Latest News & Events",
      news_sub: "Updates from our community awareness, treatment guidelines and training programs.",
      news_view_all: "View All",
      news_read_more: "Read More",
      news_archive_heading: "News & Events",
      news_archive_sub: "Stay updated with the latest from the Cambodian Haemophilia Association.",
      news_filter_all: "All",
      news_filter_event: "Event",
      news_filter_update: "Update",
      news_filter_workshop: "Workshop",
      news_filter_announcement: "Announcement",
      news_badge_event: "Event",
      news_badge_update: "Update",
      news_badge_workshop: "Workshop",
      news_badge_announcement: "Announcement",
      events_status_coming_soon: "Coming Soon",
      events_notice_title: "New Upcoming Events Coming Soon",
      events_notice_desc: "We are actively preparing our upcoming community awareness events, youth camps, and medical workshops. Stay tuned or become a member to receive official announcements directly!",
      events_notice_btn: "Get Notified",
      events_past_title: "Past Events & Highlights",
      news_no_articles: "No articles found in this category.",
      news_1_date: "Apr 17, 2025",
      news_1_badge: "Event",
      news_1_title: "World Haemophilia Day 2025 Community Awareness Event",
      news_1_desc: "Join us for our annual awareness day in Phnom Penh.",
      news_2_date: "Apr 16, 2025",
      news_2_badge: "Update",
      news_2_title: "New Treatment Guidelines Now Available in Cambodia",
      news_2_desc: "Updated clinical guidelines for haemophilia management.",
      news_3_date: "Apr 12, 2025",
      news_3_badge: "Workshop",
      news_3_title: "Training Workshop for Healthcare Professionals",
      news_3_desc: "Hands-on workshop covering diagnosis and treatment.",
      /* CTA Banner */
      cta_heading: "Help Change Lives",
      cta_sub: "Your donation helps us provide treatment, education and hope to people with bleeding disorders in Cambodia.",
      cta_donate: "Donate Now",
      /* About */
      about_divider: "About Us",
      about_hero_eyebrow: "About CHA Cambodia",
      about_badge_title: "Patient-Led NGO",
      about_badge_sub: "Est. 2011 · WFH Member",
      about_frame_tag: "Est. 2011 · Phnom Penh",
      about_heading: "Who is CHA?",
      about_lead: "The Cambodian Haemophilia Association is a patient-led organization dedicated to improving the quality of life for people living with bleeding disorders across Cambodia.",
      about_vision_label: "Our Vision",
      about_vision_text: "A Cambodia where every person with a bleeding disorder has access to diagnosis, treatment, and support.",
      about_mission_label: "Our Mission",
      about_mission_text: "To advocate for quality care, educate communities, support families, and empower caregivers.",
      /* SRC */
      src_eyebrow: "Serving Communities",
      src_heading: "SRC",
      src_sub: "CHA's commitment to community outreach, volunteer engagement, and public awareness across Cambodia.",
      src_kicker_reach: "Reach",
      src_kicker_people: "People",
      src_kicker_region: "Region",
      src_stat_1: "25",
      src_stat_label_1: "Provinces",
      src_stat_2: "80+",
      src_stat_label_2: "Volunteers",
      src_stat_3: "1",
      src_stat_label_3: "Chapter",
      src_card_1_title: "Community Outreach",
      src_card_1_desc: "Awareness campaigns, Khmer-language education, and partnerships with local health centres that reach patients where they live.",
      src_card_2_title: "Volunteer Program",
      src_card_2_desc: "Patients, families, and healthcare students who lead events, mentor newly diagnosed peers, and run community-based activities year-round.",
      src_card_3_title: "Siem Reap Chapter",
      src_card_3_desc: "Our northwest hub coordinates local outreach, patient support, and partnerships with Siem Reap Provincial Hospital.",
      src_link_1: "Learn more",
      src_link_2: "Join us",
      src_link_3: "Visit chapter",
      src_cta_heading: "Want to get involved?",
      src_cta_sub: "Join our volunteer network and make a difference in the bleeding disorders community across Cambodia.",
      src_cta_btn_1: "Get Involved",
      src_cta_btn_2: "Learn More",
      /* History */
      history_journey_eyebrow: "Our Journey · Since 2011",
      history_heading: "Our History",
      history_view_timeline: "View Full Timeline",
      history_intro: "CHA was founded in 2011 by patients and families who came together with a shared vision: to ensure no one in Cambodia faces a bleeding disorder alone. What began as a small support group has grown into a national patient-led organization.",
      history_presidents: "Past Presidents",
      history_tab_1: "Established",
      history_tab_2: "WFH Member",
      history_tab_3: "Partnerships",
      history_tab_4: "National Reach",
      history_phase_1: "Phase 01 · Genesis",
      history_era_2011: "Year 2011",
      history_h1_1: "Founded by compassionate families & pioneering patients in Phnom Penh",
      history_h1_2: "Created Cambodia's first peer-to-peer haemophilia support registry",
      history_btn_explore_2014: "Explore 2014: Global Recognition",
      history_badge_2011: "Founding Era · 2011",
      history_c1_title: "United by Hope",
      history_c1_desc: "Patient support circle during CHA's inaugural foundation meeting.",
      history_phase_2: "Phase 02 · International Alliance",
      history_era_2014: "Year 2014",
      history_h2_1: "Direct inclusion in the WFH Humanitarian Aid Program",
      history_h2_2: "International standards for diagnostic validation and safe clotting factor",
      history_btn_explore_2017: "Explore 2017: Hospital Partnerships",
      history_badge_2014: "Global Alignment · 2014",
      history_c2_title: "World Federation of Hemophilia",
      history_c2_desc: "Connecting Cambodian patients to the global community of care.",
      history_phase_3: "Phase 03 · Clinical Expansion",
      history_era_2017: "Year 2017",
      history_h3_1: "Treating hospital network established with emergency factor supplies",
      history_h3_2: "Specialized training for nurses and haematologists on bleed management",
      history_btn_explore_2023: "Explore 2023: National Reach",
      history_badge_2017: "Hospital Units · 2017",
      history_c3_title: "Clinical Capacity Building",
      history_c3_desc: "Collaborating with hospital clinical teams to expedite acute care.",
      history_phase_4: "Phase 04 · Community & Digital",
      history_era_2023: "Year 2023",
      history_h4_1: "Outreach camps covering 10+ Cambodian provinces",
      history_h4_2: "Digital member health cards for immediate emergency diagnosis identification",
      history_btn_explore_2011: "Back to 2011: Origins",
      history_badge_2023: "Nationwide · 2023",
      history_c4_title: "Nationwide Family",
      history_c4_desc: "Empowering bleeding disorder patients and families across Cambodia.",
      history_established: "CHA Established",
      history_established_desc: "CHA was established by patients and families.",
      history_wfh_member: "WFH Member",
      history_wfh_member_desc: "Became a member of the World Federation of Hemophilia.",
      history_hospital: "Hospital Partnerships",
      history_hospital_desc: "Partnered with hospitals to improve treatment access.",
      history_national: "National Reach",
      history_national_desc: "Expanded education and outreach across provinces.",
      history_president: "President",
      /* Leadership */
      lead_mandate_eyebrow: "5th Mandate (2026–2030)",
      lead_chart_motto: "Sustaining The Association For The Hemophilia Patients' Well-being",
      lead_role_founder_adv: "Founder & Advisor",
      lead_badge_founder: "Founder",
      lead_badge_cofounder: "Co-Founder",
      lead_role_med_adv: "Medical Advisor",
      lead_name_sophal: "Prof. Chean Sophâl",
      lead_desc_sophal: "Founding Patron & Clinical Advisor",
      lead_role_cofounder_adv: "Co-Founder & Advisor",
      lead_name_singheng: "Dr. Sing Heng",
      lead_desc_singheng: "Co-Founder & Medical Advisor",
      lead_role_hon_pres: "Honorary President",
      lead_name_sokpanha: "Mr. Sem Sokpanha",
      lead_desc_sokpanha: "Honorary Leadership Patron",
      lead_flow_exec: "Executive Governance",
      lead_tier_exec: "Executive Board Officers",
      lead_role_pres: "President",
      lead_name_chanthearithy: "Mr. Run C. Rithy",
      lead_mandate_pres: "5th Mandate (2026–2030)",
      lead_role_vp: "Vice President",
      lead_name_syneang: "Mr. Noeurn Syneang",
      lead_mandate_vp: "CHA Vice President",
      lead_role_treasurer: "Head of Finance",
      lead_name_somaly: "Mrs. Soung Somaly",
      lead_mandate_cfo: "Chief Financial Officer",
      lead_role_secgen: "Secretary General",
      lead_name_choryee: "Mrs. Hun Choryee",
      lead_mandate_secgen: "Secretary General",
      lead_flow_depts: "Operational Team & Department Heads",
      dept_badge_1: "CHA Supporting Group",
      dept_name_1: "Mr. Sreng Sung",
      dept_role_1: "Head of Siem Reap Supporting Group",
      dept_badge_2: "Digital",
      dept_name_2: "Mr. Oum Naro",
      dept_role_2: "Head of Digital",
      dept_badge_3: "Head of Reaction Unit",
      dept_name_3: "Mr. Kan Sokkhai",
      dept_role_3: "Head of Reaction Unit",
      dept_badge_5: "Deputy Secretary General & Head of Volunteers",
      dept_name_5: "Mr. Sath Dara",
      dept_role_5: "Deputy Secretary General & Head of Volunteers",
      dept_role_5_chart: "Deputy Secretary General & Head of Volunteers",
      hubs_eyebrow: "Grassroots & Operational Networks",
      hubs_title: "Specialized Working Groups & Regional Chapters",
      hubs_subtitle: "On-the-ground patient empowerment, youth advocacy, women’s care circles, and provincial hospital outreach across Cambodia.",
      hub_badge_youth: "Youth Advocacy",
      hub_count_7: "7 Members",
      hub_team_7: "Team (7)",
      hub_role_leader: "Group Leader",
      hub_lead_kc: "Mr. Keopich Chanda",
      hub_oversight_1: "Supervised by Mr. Run Chanthearithy & Mr. Kan Sokkhai",
      hub_badge_women: "Women & Family Care",
      hub_count_12: "12 Members",
      hub_team_12: "Team (12)",
      hub_lead_sr: "Mrs. Sum Roatha",
      hub_badge_src: "Northwest Regional Hub",
      hub_count_6: "6 Members",
      hub_team_6: "Team (6)",
      hub_name_src: "Siem Reap Chapter (SRC)",
      hub_desc_src: "Coordinating regional clinical outreach, emergency clotting factor delivery, and hospital care with Angkor Hospital for Children and local health centres.",
      hub_role_chapter_head: "Chapter Head",
      hub_lead_ss: "Mr. Sreng Sung",
      hub_oversight_src: "Clinical Advisor: Dr. Sing Heng (Medical Advisor)",
      hub_badge_volunteers: "Community Field Force",
      hub_name_volunteers: "Volunteer Network",
      hub_desc_volunteers: "Frontline volunteers mobilizing across provinces to support patient hospital transport, community roadshows, emergency donation logistics, and blood drives.",
      hub_role_network_leader: "Network Leader",
      hub_lead_sd: "Mr. Sath Dara",
      /* Working Group & Chapter Roster Drawers */
      roster_role_deputy_leader: "Deputy Leader",
      roster_role_finance: "Finance Coordinator",
      roster_role_admin: "Administration",
      roster_role_youth_vol: "Youth Volunteer",
      roster_role_member: "Member",
      roster_role_supervisor: "Supervisor",
      roster_role_reg_vol: "Regional Volunteer",
      roster_role_field_vol: "Field Volunteer",
      roster_youth_title: "Youth Group Team",
      roster_youth_subtitle: "7 active members & officers",
      roster_youth_m1_name: "Mr. Say Ouksaphea",
      roster_youth_m2_name: "Mr. Ky Eangtol",
      roster_youth_m3_name: "Mr. Srim Pengleang",
      roster_youth_m4_name: "Mr. Khan Dara",
      roster_women_title: "Women's Group Team",
      roster_women_subtitle: "12 active members & officers",
      roster_women_m1_name: "Mrs. Yim Mary",
      roster_women_m2_name: "Mrs. Him Somala",
      roster_women_m3_name: "Mrs. Srim Sreypich",
      roster_women_m4_name: "Mrs. Try Kakada",
      roster_women_m5_name: "Mrs. Phon Sokny",
      roster_women_m6_name: "Mrs. Som Phalla",
      roster_women_m7_name: "Mrs. Heng Sim",
      roster_women_m8_name: "Mrs. Touch Socheata",
      roster_women_m9_name: "Mrs. Hou Sreyny",
      roster_src_title: "Siem Reap Chapter Team",
      roster_src_subtitle: "6 active members & officers",
      roster_src_m1_name: "Mr. Run Chanthearithy",
      roster_src_m2_name: "Ms. Keo Sovandy",
      roster_src_m3_name: "Mrs. Sun Sokhorn",
      roster_src_m4_name: "Mr. Pach Panhavorinvong",
      roster_vol_title: "Volunteer Network Team",
      roster_vol_subtitle: "12 active members & volunteers",
      roster_vol_m1_name: "Ms. Chor Sonita",
      roster_vol_m2_name: "Ms. Srin Vinching",
      roster_vol_m3_name: "Ms. Oeun Sreyneath",
      roster_vol_m4_name: "Mr. Pov Lay",
      roster_vol_m5_name: "Mr. Phorn Soveat",
      roster_vol_m6_name: "Mr. Mom Bunthart",
      roster_vol_m7_name: "Mr. Yong Tetyutthuon",
      roster_vol_m8_name: "Ms. Noeurn SoVannitta",
      leadership_heading: "Leadership Team",
      leadership_sub: "Dedicated individuals leading CHA's mission across Cambodia.",
      leadership_meet: "Meet the Full Team",
      leadership_youth_title: "Youth Group",
      leadership_youth_desc: "A network of young patients and supporters driving awareness campaigns, peer mentoring, and youth-led advocacy across Cambodia.",
      leadership_women_title: "Women's Group",
      leadership_women_desc: "Empowering women affected by bleeding disorders through support circles, education on VWD and carrier issues, and community-building events.",
      /* WFH */
      wfh_alliances_eyebrow: "Global Alliances & International Twinning",
      wfh_switch_wfh: "World Federation of Hemophilia",
      wfh_switch_hfa: "Haemophilia Foundation Australia",
      wfh_hq_montreal: "Montreal, Canada · Global Federation",
      wfh_metric_membership: "Active Membership",
      wfh_metric_passthrough: "Humanitarian Pass-through",
      wfh_p1_title: "Humanitarian Aid & Factor Donations",
      wfh_p1_desc: "Securing emergency clotting factor concentrates distributed directly to treatment centers across Cambodia.",
      wfh_p2_title: "Standardized Clinical Guidelines",
      wfh_p2_desc: "Deploying WFH international diagnostic standards and comprehensive care models for Cambodian pediatric clinics.",
      wfh_p3_title: "Global Advocacy & Assembly Representation",
      wfh_p3_desc: "Representing Cambodian bleeding disorder patients at the biennial WFH World Congress.",
      wfh_official_portal: "Official Portal",
      wfh_btn_explore_hfa: "Explore HFA Australia Twinning",
      wfh_glass_title: "WFH Global Network",
      wfh_glass_subtitle: "Recognized National Member Organization",
      wfh_pill_member_since: "Official Member · Since 2014",
      wfh_hq_melbourne: "Melbourne, Australia · Twinning Alliance",
      wfh_metric_clinicians: "Clinicians Mentored",
      wfh_metric_bilateral_val: "Bilateral",
      wfh_metric_bilateral_lbl: "Active Twinning",
      wfh_hfa_p1_title: "Clinical Mentorship & Medical Fellowships",
      wfh_hfa_p1_desc: "Connecting Australian senior hematologists with Cambodian doctors and hospital staff.",
      wfh_hfa_p2_title: "Specialized Nurse & Physiotherapy Workshops",
      wfh_hfa_p2_desc: "Practical rehabilitation guidance to prevent joint immobility and muscle bleeding complications.",
      wfh_hfa_p3_title: "Youth & Family Advocacy Camps",
      wfh_hfa_p3_desc: "Empowering parents, carriers, and youth ambassadors with self-infusion and psychosocial support.",
      wfh_at_hfa: "at HFA Australia",
      wfh_btn_view_wfh: "View WFH Global Partnership",
      wfh_hfa_glass_title: "Australia Twinning Alliance",
      wfh_hfa_glass_subtitle: "Capacity Building & Clinical Mentorship",
      wfh_pill_twinning_partner: "Twinning Program Partner",
      wfh_heading: "Our Work with WFH & HFA",
      wfh_sub: "CHA proudly partners with leading global organizations to strengthen haemophilia care across Cambodia.",
      wfh_wfh_name: "World Federation of Hemophilia",
      wfh_wfh_tag: "Member Since 2014",
      wfh_wfh_stat_label: "Countries in Network",
      wfh_wfh_desc: "Global member of the WFH network. Through this partnership, CHA accesses international treatment guidelines, training programs, and humanitarian aid that directly improve patient care.",
      wfh_wfh_link: "Visit WFH",
      wfh_hfa_name: "Haemophilia Foundation Australia",
      wfh_hfa_tag: "Training Partner",
      wfh_hfa_stat_label: "Joint Programs",
      wfh_hfa_desc: "HFA partners with CHA on capacity building, clinical training, and patient advocacy. Joint programs connect Cambodian clinicians with Australian expertise.",
      wfh_hfa_link: "Learn More",
      /* Haemophilia */
      haem_eyebrow: "Genetic Bleeding Condition",
      haem_divider: "About Haemophilia",
      haem_heading: "What is Haemophilia?",
      haem_contact: "Contact a Specialist",
      haem_para_1: "Haemophilia is a rare genetic bleeding disorder that affects a person's ability to stop bleed. People with haemophilia can bleed longer than others after an injury or even without a known cause.",
      haem_para_2: "While there is no cure, modern treatments allow people with haemophilia to live full, active and healthy lives. Early diagnosis, proper treatment and ongoing support are key to preventing complications and joint damage.",
      haem_clot_title: "Clotting Cascade Deficiency",
      haem_clot_desc: "Factor VIII (A) & Factor IX (B) Coagulation Mesh",
      /* Types */
      types_heading: "Types of Haemophilia",
      types_sub: "The two main types of haemophilia — both require proper diagnosis and lifelong management.",
      types_a_title: "Haemophilia A",
      types_a_desc: "Caused by a deficiency of factor VIII. The most common type.",
      types_b_title: "Haemophilia B",
      types_b_desc: "Caused by a deficiency of factor IX. Sometimes called Christmas disease.",
      /* Symptoms */
      symptoms_eyebrow: "Clinical Indicators",
      symptoms_heading: "Common Symptoms",
      symptoms_sub: "Recognizing the signs of a bleeding disorder is the first step toward diagnosis and proper care.",
      symptom_sign_1: "Sign 01",
      symptom_sign_2: "Sign 02",
      symptom_sign_3: "Sign 03",
      symptom_sign_4: "Sign 04",
      symptom_sign_5: "Sign 05",
      symptom_bruising: "Easy Bruising",
      symptom_bruising_desc: "Unexplained bruises from minor bumps or pressure.",
      symptom_nosebleeds: "Frequent Nosebleeds",
      symptom_nosebleeds_desc: "Recurring nosebleeds that are hard to stop.",
      symptom_gums: "Bleeding Gums",
      symptom_gums_desc: "Gums that bleed during brushing or eating.",
      symptom_joint: "Joint Pain or Swelling",
      symptom_joint_desc: "Painful, swollen joints after minor injury or activity.",
      symptom_prolonged: "Prolonged Bleeding",
      symptom_prolonged_desc: "Bleeding that lasts longer than expected after cuts.",
      symptom_cta: "Experiencing any of these symptoms? Early diagnosis can make a life-changing difference.",
      symptom_find_centre: "Find a Treatment Centre",
      symptom_contact_specialist: "Contact a Specialist",
      /* VWD */
      vwd_eyebrow: "Most Common Bleeding Disorder",
      vwd_heading: "Von Willebrand Disease (VWD)",
      vwd_para_1: "Von Willebrand Disease is the most common inherited bleeding disorder, affecting both males and females equally. It is caused by a deficiency or dysfunction of von Willebrand factor (VWF), a protein that helps blood clot.",
      vwd_para_2: "There are three main types of VWD — Type 1 (mild), Type 2 (moderate), and Type 3 (severe). Each varies in how much VWF is present and how well it functions. Symptoms include easy bruising, frequent nosebleeds, heavy menstrual bleeding, and prolonged bleeding after surgery or injury.",
      vwd_find: "Find Treatment",
      vwd_action_note: "Affects up to 1% of the world's population",
      vwd_chip_title: "Von Willebrand Factor (VWF)",
      vwd_chip_desc: "Platelet Adhesion & Factor VIII Stabilizer",
      /* Other */
      other_heading: "Other Bleeding Disorders",
      other_rare_title: "Rare Factor Deficiencies",
      other_rare_desc: "Deficiencies in factors I, II, V, VII, X, XI, XII and XIII. Each requires specific diagnosis and treatment.",
      other_platelet_title: "Platelet Function Disorders",
      other_platelet_desc: "Conditions where platelets don't work properly, leading to bleeding despite normal platelet counts.",
      other_more: "For more information on any bleeding disorder, contact our team or visit a treatment centre.",
      /* Treatment */
      tc_eyebrow: "National Care Partners",
      treatment_heading: "Treatment Centres",
      treatment_sub: "Find haemophilia treatment centres across Cambodia — search by province.",
      treatment_select: "Select Province",
      tc_select_all: "All Provinces (Nationwide)",
      tc_active_badge: "2 Verified Centres Active",
      province_phnom_penh: "Phnom Penh",
      province_siem_reap: "Siem Reap",
      province_battambang: "Battambang",
      province_sihanoukville: "Sihanoukville",
      tc_nph_title: "National Pediatric Hospital (NPH) — Haemophilia Clinic",
      tc_nph_address: "100 Russian Blvd, Phnom Penh",
      tc_nph_hours: "Mon – Fri: 8:00 AM – 4:30 PM",
      tc_ahc_title: "Angkor Hospital for Children (AHC) — Haemophilia Unit",
      tc_ahc_address: "Tep Vong St, Siem Reap",
      tc_ahc_hours: "Mon – Sun: 24h Inpatient",
      tc_tag_haem_ab: "Haemophilia A & B",
      tc_tag_vwd_care: "VWD Care",
      tc_tag_consultation: "Consultation",
      tc_tag_diagnostic: "Diagnostic Lab",
      tc_tag_factor_rep: "Factor Replacement",
      tc_tag_family_counselling: "Family Counselling",
      treatment_view_map: "View on Map",
      treatment_emergency: "Emergency Support",
      treatment_emergency_desc: "If you have a bleeding emergency, contact your nearest treatment centre or call our support line.",
      /* CSR */
      csr_heading: "CSR Program",
      csr_sub: "Fundraising, donations, and corporate partnerships that power our mission.",
      csr_fundraising: "Fundraising",
      csr_fundraising_desc: "Raising funds through community drives, events, and partner campaigns that keep our programs running.",
      csr_view_campaigns: "View campaigns",
      csr_donate_online: "Online donation",
      csr_donate_online_desc: "Donate securely via KHQR (ABA Mobile & Bakong) — every contribution changes lives across Cambodia.",
      csr_donate_now: "Donate now",
      csr_partners_title: "Corporate Partners",
      csr_partners_desc: "Trusted organisations that support our mission and amplify our reach nationwide.",
      csr_become_partner: "Become a partner",
      /* Impact */
      impact_heading: "Your Impact",
      impact_eyebrow: "How Donations Help",
      impact_t1_title: "Treatment Access",
      impact_treatment: "Provide treatment access for patients",
      impact_t2_title: "Education & Care",
      impact_education: "Support education and awareness",
      impact_t3_title: "Healthcare Capacity",
      impact_healthcare: "Strengthen healthcare capacity",
      impact_t4_title: "Community & Families",
      impact_families: "Empower families and communities",
      /* Membership */
      tab_membership: "Membership",
      tab_donate: "Donate",
      membership_heading: "Membership Benefits",
      membership_cta: "Ready to join our community?",
      membership_cta_sub: "Join our community to access exclusive resources, events, and peer support across Cambodia.",
      membership_register: "Register Now",
      membership_signin: "Already a member? Sign In",
      membership_cta_title: "Become a Member",
      membership_cta_feature_1: "Exclusive resources & guides",
      membership_cta_feature_2: "Events & community meetups",
      membership_cta_feature_3: "Peer support network",
      membership_badge_count: "500+",
      membership_badge_label: "members & growing",
      membership_benefit_1_title: "Community & Support",
      membership_benefit_1_desc: "Connect with patients, families, and caregivers across Cambodia.",
      membership_benefit_2_title: "Access to Resources",
      membership_benefit_2_desc: "Exclusive guides, educational materials, and treatment information.",
      membership_benefit_3_title: "Events & Workshops",
      membership_benefit_3_desc: "Participate in hands-on workshops, community events, and online learning sessions.",
      membership_benefit_4_title: "Advocacy & Awareness",
      membership_benefit_4_desc: "Help raise awareness and advocate for better care nationwide.",
      membership_benefit_5_title: "Updates & Newsletters",
      membership_benefit_5_desc: "Stay informed with the latest news and CHA announcements.",
      /* Donate */
      donate_heading: "Make a Donation",
      donate_sub: "Your support helps us provide treatment, education, and hope to people with bleeding disorders in Cambodia.",
      donate_amount_label: "Donation Amount",
      donate_name_label: "Full name (optional)",
      donate_email_label: "Email (optional)",
      donate_phone_label: "Phone (optional)",
      donate_ph_name: "Enter your name",
      donate_ph_email: "Enter your email",
      donate_ph_phone: "Enter your phone",
      donate_secure_note: "Pay directly with ABA Mobile, Bakong, or any KHQR-supported banking app",
      donate_khqr_badge: "KHQR National Pay",
      donate_scan_title: "Scan & Support",
      donate_scan_desc: "Directly transfer your donation using ABA Mobile, Bakong, Wing, ACLEDA, Canadia, or banking apps across Cambodia.",
      donate_modal_desc: "Scan with ABA Mobile, Bakong, or any Cambodian banking app to send your contribution.",
      donate_account_name_lbl: "ACCOUNT NAME",
      donate_account_org: "Cambodia Haemophilia Association",
      donate_copy_btn: "Copy Account Number",
      donate_modal_copy_btn: "Copy",
      donate_save_qr_btn: "Save QR Image",
      donate_step1_title: "Open Banking App",
      donate_step1_desc: "ABA, Bakong, etc.",
      donate_step2_title: "Scan KHQR Code",
      donate_step2_desc: "Point camera at QR",
      donate_step3_title: "Enter Amount",
      donate_step3_desc: "Directly support patients",
      donate_trust_note: "Instant Direct Settlement · Zero Processing Fee",
      /* Contact */
      contact_divider: "Contact Us",
      contact_heading: "Contact Us",
      contact_sub: "Have questions or need support? We're here to help.",
      contact_subtitle: "We're here to help patients, families, and partners across Cambodia.",
      contact_day_monfri: "Monday – Friday",
      contact_day_sat: "Saturday",
      contact_day_sun: "Sunday",
      contact_closed: "Closed",
      contact_info: "Get In Touch",
      contact_address: "Address",
      contact_phone: "Phone",
      contact_email: "Email",
      contact_hours: "Office Hours",
      contact_message: "Send us a Message",
      contact_message_sub: "Fill out the form below and we'll get back to you.",
      contact_name: "Full Name",
      contact_email_label: "Email",
      contact_subject: "Subject",
      contact_message_label: "Message",
      contact_name_ph: "Enter your full name",
      contact_email_ph: "Enter your email",
      contact_subject_ph: "What's this about?",
      contact_message_ph: "How can we help?",
      contact_send: "Send Message",
      contact_address_val: "#Building 100, Russia Blvd (114), Phnom Penh, Cambodia, P.O Box 700",
      /* Footer */
      footer_tagline: "Supporting people with bleeding disorders across Cambodia.",
      footer_quick_links: "Quick Links",
      footer_resources: "Resources",
      footer_contact: "Contact Us",
      footer_patient_guides: "Patient Guides",
      footer_news_events: "News & Events",
      footer_donation: "Donation",
      footer_copyright: "© 2026 Cambodian Haemophilia Association. All rights reserved.",
      footer_privacy: "Privacy Policy",
      footer_disclaimer: "Disclaimer",
      footer_terms: "Terms of Service",
      footer_social: "Social Media Links",
      footer_find_us: "Find Us",
      footer_get_involved: "Get Involved",
      footer_address: "Phnom Penh, Cambodia",
      /* Campaigns */
      campaigns_active: "Active Initiatives",
      campaigns_badge: "Active Mission",
      campaigns_heading: "Current Campaigns",
      campaigns_sub: "Support our life-saving missions and emergency patient care.",
      campaigns_ongoing: "Ongoing",
      campaigns_ongoing_badge: "3 Ongoing",
      campaigns_view_all: "View All",
      campaigns_view_all_count: "View All (3)",
      campaigns_1_title: "Patient Support Fund",
      campaigns_1_desc: "Help patients access essential treatment and medication.",
      campaigns_2_title: "Education & Awareness",
      campaigns_2_desc: "Support workshops and awareness seminars across provinces.",
      campaigns_3_title: "Emergency Assistance",
      campaigns_3_desc: "Provide urgent help for patients in critical situations.",
      campaigns_raised_label: "raised",
      campaigns_goal_label: "Goal",
      campaigns_partners: "Corporate Partners",
      campaigns_partners_sub: "Global Healthcare Allies",
      campaigns_archive_heading: "Current Campaigns",
      campaigns_archive_sub: "Support our mission — every contribution changes lives across Cambodia.",
      news_archive_heading: "News & Events",
      news_archive_sub: "Stay updated with the latest from the Cambodian Haemophilia Association.",
      news_filter_all: "All",
      news_filter_event: "Event",
      news_filter_update: "Update",
      news_filter_workshop: "Workshop",
      news_filter_announcement: "Announcement",
      news_badge_event: "Event",
      news_badge_update: "Update",
      news_badge_workshop: "Workshop",
      news_badge_announcement: "Announcement",
      news_back_to_news: "Back to News",
      nav_member: "Become a Member",
      nav_my_card: "My Card",
      nav_volunteer: "Volunteer",
      nav_partner: "Partner With Us",
      nav_programs: "Programs & Care",
      /* Dashboard */
      dash_title: "My Dashboard",
      dash_member_id: "Member ID",
      dash_email: "Email",
      dash_phone: "Phone",
      dash_address: "Address",
      dash_member_since: "Member since",
      dash_edit_profile: "Edit Profile",
      dash_save: "Save",
      dash_cancel: "Cancel",
      dash_sign_out: "Sign Out",
      dash_card_subtitle: "Patient Identification Card",
      dash_no_photo: "No Photo",
      dash_name: "Name",
      dash_dob: "Date of Birth",
      dash_condition: "Condition",
      dash_blood_type: "Blood Type",
      dash_created_at: "Created At",
      dash_card_title_back: "Patient Identification Card",
      dash_rules: "Rules",
      dash_rule_1: "This card is the property of the Cambodian Haemophilia Association.",
      dash_rule_2: "Please present this card when receiving treatment services.",
      dash_rule_3: "If lost, please contact the association immediately.",
      dash_print_card: "Print Card",
      dash_ph_email: "Email",
      dash_ph_phone: "Phone",
      dash_ph_address: "Address",
      dash_ph_name: "Name",
      dash_ph_condition: "e.g. Hemophilia A",
      /* Modals & Forms */
      donate_badge: "Support CHA",
      donate_modal_title: "Make a Donation",
      donate_modal_heading: "Help Change Lives!",
      donate_modal_sub: "Your support provides treatment, education, and hope to people with bleeding disorders in Cambodia.",
      donate_acct_name: "Donation",
      donate_acct_sub: "Secure & encrypted",
      donate_acct_safe: "Safe",
      donate_other: "Other",
      donate_ph_amount: "Enter amount in USD",
      donate_secure_title: "Secure Payment",
      donate_secure_desc: "Pay directly with ABA Mobile, Bakong, or any KHQR-supported banking app.",
      donate_btn: "Donate Now",
      donate_footer_note: "Pay directly with ABA Mobile, Bakong, or any KHQR-supported banking app",
      member_login_title: "Member Login",
      member_login_sub: "Sign in to access your account, resources, and community.",
      form_email_label: "Email",
      form_email_ph: "Enter your email",
      form_pass_label: "Password",
      form_pass_ph: "Enter your password",
      form_create_pass_ph: "Create a password",
      member_forgot: "Forgot password?",
      member_signin_btn: "Sign In",
      member_register_link: "Register",
      member_register_modal_title: "Register",
      member_register_title: "Join our community of patients, families, and members.",
      form_i_am_a: "I am a",
      role_member: "Member",
      role_patient: "Patient",
      role_patient_desc: "I have Haemophilia",
      form_name_label: "Full name",
      form_name_ph: "Enter your full name",
      form_phone_label: "Phone number (optional)",
      form_phone_ph: "Enter your phone number",
      form_address_label: "Address (optional)",
      form_address_ph: "Enter your address",
      form_hemophilia_type_lbl: "Hemophilia Type",
      form_select_type: "Select type",
      form_opt_other: "Other",
      form_specify_cond_ph: "Specify your condition",
      form_select_blood: "Select blood type",
      form_terms_agree: "I agree to the",
      form_terms_link: "Terms & Conditions",
      member_register_btn: "Register",
      member_already_account: "Already have an account?",
      member_forgot_title: "Reset Password",
      member_forgot_sub: "Enter your email and we will send you a link to reset your password.",
      member_forgot_btn: "Send Reset Link",
      /* Patient Card i18n */
      card_title_front: "Patient Identification Card",
      card_title_eng: "Patient Identification Card",
      card_title_back: "Patient Identification Card",
      card_label_id: "Member ID",
      card_label_name_khmer: "Khmer Name",
      card_label_name_latin: "Latin Name",
      card_label_dob: "Date of Birth",
      card_label_condition: "Hemophilia Type",
      card_label_blood: "Blood Type",
      card_label_issue_date: "Issue Date",
      card_label_address: "Address",
      card_label_phone: "Phone",
      card_hotline_nph: "National Pediatric Hospital Hotline: 012 751 728",
      card_hotline_ahc: "Angkor Hospital for Children Hotline: 063 963 409",
      card_keep_notice: "Please keep this member ID card in good condition.",
      card_qr_label: "Scan Us",
      card_org_name_kh: "Cambodian Hemophilia Association",
      card_org_name_en: "Cambodian Hemophilia Association",
      card_rules_heading: "Conditions:",
      card_rule_1: "1. This patient ID card is for use exclusively within the Cambodian Hemophilia Association.",
      card_rule_2: "2. This card is valid throughout the 5th mandate (2026–2030).",
      card_rule_3: "3. All patients must renew their ID card before May 17, 2030.",
      card_president_label: "Association President",
      card_president_name: "Run Chanthearithy",
      card_office_address: "Address: No. 100 Russian Federation Blvd, Phnom Penh. Tel: (+855) 96 660 5334",
      dash_flip_card: "Flip Card",
      dash_side_front: "Front Side",
      dash_side_back: "Back Side",
    },
    km: {
      /* Nav */
      lang_label: "ខ្មែរ",
      nav_home: "ទំព័រដើម",
      nav_about_us: "អំពីយើង",
      nav_about: "អំពីយើង",
      nav_who_is_cha: "CHA ជាអ្វី?",
      nav_leadership: "រចនាសម្ព័ន្ធដឹកនាំ និងក្រុម",
      nav_src: "SRC",
      nav_history: "ប្រវត្តិសាស្រ្ត",
      nav_wfh: "ការងាររបស់យើងជាមួយ WFH និង HFA",
      nav_contact_us: "ទំនាក់ទំនង",
      nav_about_who: "CHA ជាអ្វី?",
      nav_about_leadership: "រចនាសម្ព័ន្ធដឹកនាំ និងក្រុម",
      nav_about_src: "SRC",
      nav_about_history: "ប្រវត្តិសាស្រ្ត",
      nav_about_wfh: "ការងាររបស់យើងជាមួយ WFH និង HFA",
      nav_about_contact: "ទំនាក់ទំនង",
      nav_about_haemophilia: "អំពីជំងឺហេម៉ូហ្វីលា",
      nav_haemophilia: "អំពីជំងឺហេម៉ូហ្វីលា",
      nav_haemophilia_about: "អំពីជំងឺហេម៉ូហ្វីលា",
      nav_haemophilia_vwd: "អំពីជំងឺ VWD",
      nav_haemophilia_other: "អំពីអាការៈហូរឈាមផ្សេងទៀត",
      nav_treatment_centres: "មជ្ឈមណ្ឌលព្យាបាលជំងឺហេម៉ូហ្វីលា",
      nav_programs: "មជ្ឈមណ្ឌលព្យាបាលជំងឺហេម៉ូហ្វីលា",
      nav_csr: "កម្មវិធី CSR",
      nav_csr_program: "កម្មវិធី CSR",
      nav_fundraising: "ប្រមូលថវិកា",
      nav_csr_fundraising: "ប្រមូលថវិកា",
      nav_online_donation: "បរិច្ចាគតាមអ៊ីនធឺណិត",
      nav_csr_donate: "បរិច្ចាគតាមអ៊ីនធឺណិត",
      nav_corporate_partners: "ដៃគូអាជីវកម្ម",
      nav_csr_partners: "ដៃគូអាជីវកម្ម",
      nav_news: "ព័ត៌មាន",
      nav_latest_news: "ព័ត៌មានថ្មីៗ",
      nav_upcoming_events: "ព្រឹត្តិការណ៍ខាងមុខ",
      nav_news_latest: "ព័ត៌មានថ្មីៗ",
      nav_news_events: "ព្រឹត្តិការណ៍ខាងមុខ",
      nav_contact: "ទំនាក់ទំនង",
      nav_become_member: "ក្លាយជាសមាជិក",
      nav_donate: "បរិច្ចាគ",
      nav_become_member_aria: "ចូលជាសមាជិក",
      nav_donate_aria: "បើកទម្រង់បរិច្ចាគ",
      lang_switcher_aria: "ប្តូរភាសា",
      /* Hero */
      hero_title_1: "យើងថែទាំគ្នា",
      hero_title_2: "យើងផ្លាស់ប្តូរជីវិត",
      hero_lead: "គាំទ្រ និងផ្តល់សមត្ថភាពដល់អ្នកមានអាការៈហូរឈាមនៅកម្ពុជា។",
      hero_cta_support: "ទទួលជំនួយ",
      /* Stats */
      stat_provinces: "ខេត្តដែលបានគ្រប់ដណ្តប់",
      stat_patients: "អ្នកជំងឺដែលបានជួយ",
      stat_partners: "ដៃគូថែទាំសុខភាព",
      /* How We Help */
      help_heading: "យើងជួយដូចម្តេច",
      help_sub: "វិស័យសំខាន់ៗចំនួនបួនដែល CHA ធ្វើឱ្យមានការផ្លាស់ប្តូរដល់អ្នកជំងឺ និងគ្រួសារនៅកម្ពុជា។",
      help_patient_support: "ជំនួយអ្នកជំងឺ",
      help_patient_support_desc: "ជំនួយផ្លូវចិត្ត ការណែនាំ និងសហគមន៍សម្រាប់អ្នកជំងឺ និងគ្រួសារ។",
      help_treatment: "មជ្ឈមណ្ឌលព្យាបាល",
      help_treatment_desc: "ស្វែងរកមជ្ឈមណ្ឌលព្យាបាលជំងឺហេម៉ូហ្វីលាជិតអ្នក និងទទួលបានការថែទាំដែលអ្នកត្រូវការ។",
      help_become_member: "ក្លាយជាសមាជិក",
      help_become_member_desc: "ចូលរួមជាមួយសហគមន៍របស់យើង និងទទួលបានធនធាន និងកម្មវិធីផ្តាច់មុខ។",
      help_donate: "បរិច្ចាគ",
      help_donate_desc: "ការគាំទ្ររបស់អ្នកជួយយើងផ្តល់ការព្យាបាល ការអប់រំ និងសង្ឃឹម។",
      help_learn_more: "ស្វែងយល់បន្ថែម",
      help_join_now: "ចូលរួមឥឡូវ",
      help_donate_now: "បរិច្ចាគឥឡូវ",
      chatWithUs: "ជជែកជាមួយយើង",
      /* News */
      news_heading: "ព័ត៌មាន និងព្រឹត្តិការណ៍ថ្មីៗ",
      news_sub: "ព័ត៌មានថ្មីៗពីសកម្មភាពសហគមន៍ គោលនាំព្យាបាល និងកម្មវិធីបណ្តុះបណ្តាល។",
      news_view_all: "មើលទាំងអស់",
      news_read_more: "អានបន្ថែម",
      news_archive_heading: "ព័ត៌មាន និងព្រឹត្តិការណ៍",
      news_archive_sub: "ទទួលបានព័ត៌មានថ្មីៗពីសមាគមជំងឺហេម៉ូហ្វីលាកម្ពុជា (CHA)។",
      news_filter_all: "ទាំងអស់",
      news_filter_event: "ព្រឹត្តិការណ៍",
      news_filter_update: "ព័ត៌មានថ្មី",
      news_filter_workshop: "សិក្ខាសាលា",
      news_filter_announcement: "សេចក្តីប្រកាស",
      news_badge_event: "ព្រឹត្តិការណ៍",
      news_badge_update: "ព័ត៌មានថ្មី",
      news_badge_workshop: "សិក្ខាសាលា",
      news_badge_announcement: "សេចក្តីប្រកាស",
      events_status_coming_soon: "នឹងមកដល់ឆាប់ៗនេះ",
      events_notice_title: "ព្រឹត្តិការណ៍ថ្មីៗនឹងមកដល់ឆាប់ៗនេះ",
      events_notice_desc: "យើងកំពុងរៀបចំកម្មវិធីយល់ដឹងសហគមន៍ កម្មវិធីយុវជន និងសិក្ខាសាលាវេជ្ជសាស្ត្រខាងមុខ។ សូមរង់ចាំតាមដាន ឬចុះឈ្មោះជាសមាជិកដើម្បីទទួលបានដំណឹងផ្លូវការមុនគេ!",
      events_notice_btn: "ទទួលបានដំណឹង",
      events_past_title: "ព្រឹត្តិការណ៍ និងសកម្មភាពកន្លងមក",
      news_no_articles: "មិនមានអត្ថបទក្នុងផ្នែកនេះនៅឡើយទេ។",
      news_1_date: "១៧ មេសា ២០២៥",
      news_1_badge: "ព្រឹត្តិការណ៍",
      news_1_title: "ព្រឹត្តិការណ៍យល់ដឹងសហគមន៍ទិវាអាការៈហូរឈាមពិភពលោក ២០២៥",
      news_1_desc: "ចូលរួមជាមួយយើងសម្រាប់ទិវាយល់ដឹងប្រចាំឆ្នាំនៅភ្នំពេញ។",
      news_2_date: "១៦ មេសា ២០២៥",
      news_2_badge: "ព័ត៌មានថ្មី",
      news_2_title: "គោលការណ៍ណែនាំការព្យាបាលថ្មីមាននៅកម្ពុជា",
      news_2_desc: "គោលការណ៍ណែនាំព្យាបាលថ្មីសម្រាប់ការគ្រប់គ្រងអាការៈហូរឈាម។",
      news_3_date: "១២ មេសា ២០២៥",
      news_3_badge: "សិក្ខាសាលា",
      news_3_title: "សិក្ខាសាលាបណ្តុះបណ្តាលសម្រាប់អ្នកជំនាញសុខាភិបាល",
      news_3_desc: "សិក្ខាសាលាអនុវត្តជាក់ស្តែងស្តីពីការធ្វើរោគវិនិច្ឆ័យ និងការព្យាបាល។",
      /* CTA Banner */
      cta_heading: "ជួយផ្លាស់ប្តូរជីវិត",
      cta_sub: "បរិច្ចាគរបស់អ្នកជួយយើងផ្តល់ការព្យាបាល ការអប់រំ និងសង្ឃឹមដល់អ្នកមានអាការៈហូរឈាមនៅកម្ពុជា។",
      cta_donate: "បរិច្ចាគឥឡូវ",
      /* About */
      about_divider: "អំពីយើង",
      about_hero_eyebrow: "អំពី CHA កម្ពុជា",
      about_badge_title: "អង្គការដឹកនាំដោយអ្នកជំងឺ",
      about_badge_sub: "បង្កើតឆ្នាំ ២០១១ · សមាជិក WFH",
      about_frame_tag: "បង្កើតឆ្នាំ ២០១១ · រាជធានីភ្នំពេញ",
      about_heading: "CHA ជាអ្វី?",
      about_lead: "សមាគមជំងឺហេម៉ូហ្វីលាកម្ពុជា (CHA) គឺជាអង្គការដឹកនាំដោយអ្នកជំងឺ ដែលឧទ្ទិសដល់ការកែលម្អគុណភាពជីវិតរបស់អ្នកដែលរស់នៅជាមួយអាការៈហូរឈាមនៅទូទាំងប្រទេសកម្ពុជា។",
      about_vision_label: "ចក្ខុវិស័យ",
      about_vision_text: "កម្ពុជាមួយដែលអ្នករាល់គ្នាដែលមានអាការៈហូរឈាមអាចទទួលបានការវិនិច្ឆ័យ ការព្យាបាល និងការគាំទ្រ។",
      about_mission_label: "បេសកកម្ម",
      about_mission_text: "ការអំពាវនាវដល់ការថែទាំដែលមានគុណភាព អប់រំសហគមន៍ គាំទ្រគ្រួសារ និងផ្តល់សមត្ថភាពដល់អ្នកថែទាំ។",
      /* SRC */
      src_eyebrow: "បម្រើសហគមន៍",
      src_heading: "SRC",
      src_sub: "ការប្តេជ្ញាចិត្តរបស់ CHA ចំពោះការងារសហគមន៍ ការចូលរួមស្ម័គ្រចិត្ត និងការយល់ដឹងសាធារណៈនៅកម្ពុជា។",
      src_kicker_reach: "ការឈានដល់",
      src_kicker_people: "មនុស្ស",
      src_kicker_region: "តំបន់",
      src_stat_1: "25",
      src_stat_label_1: "ខេត្ត",
      src_stat_2: "80+",
      src_stat_label_2: "ស្ម័គ្រចិត្ត",
      src_stat_3: "1",
      src_stat_label_3: "ជំពូក",
      src_card_1_title: "ការងារសហគមន៍",
      src_card_1_desc: "យុទ្ធនាការលើកកម្ពស់ការដឹងគុណ ការអប់រំជាភាសាខ្មែរ និងភាពជាដៃគូជាមួយមណ្ឌលសុខភាពមូលដ្ឋានដែលឈានដល់អ្នកជំងឺ។",
      src_card_2_title: "កម្មវិធីស្ម័គ្រចិត្ត",
      src_card_2_desc: "អ្នកជំងឺ គ្រួសារ និងសិស្សវិទ្យាសាស្រ្តថែទាំដែលដឹកនាំព្រឹត្តិការណ៍ ជួយដល់សហសេវិកដែលទើបរកឃើញជំងឺ និងដំណើរការសកម្មភាពសហគមន៍។",
      src_card_3_title: "ជំពូកសៀមរាប",
      src_card_3_desc: "មជ្ឈមណ្ឌលភាគខាងជើងរបស់យើងសម្របសម្រួលការងារសហគមន៍ ការគាំទ្រអ្នកជំងឺ និងភាពជាដៃគូជាមួយមន្ទីរពេទ្យបង្អែកសៀមរាប។",
      src_link_1: "ស្វែងយល់បន្ថែម",
      src_link_2: "ចូលរួម",
      src_link_3: "ទស្សនាជំពូក",
      src_cta_heading: "ចង់ចូលរួម?",
      src_cta_sub: "ចូលរួមជាមួយបណ្តាញស្ម័គ្រចិត្តរបស់យើង និងបង្កើតការផ្លាស់ប្តូរក្នុងសហគមន៍អ្នកមានអាការៈហូរឈាមនៅកម្ពុជា។",
      src_cta_btn_1: "ចូលរួម",
      src_cta_btn_2: "ស្វែងយល់បន្ថែម",
      /* History */
      history_journey_eyebrow: "ដំណើររបស់យើង · តាំងពីឆ្នាំ ២០១១",
      history_heading: "ប្រវត្តិសាស្រ្ត",
      history_view_timeline: "មើលពេលវេលាពេញ",
      history_intro: "CHA ត្រូវបានបង្កើតឡើងក្នុងឆ្នាំ ២០១១ ដោយអ្នកជំងឺ និងគ្រួសារដែលមានចក្ខុវិស័យរួមគ្នា៖ ធានាថាមិនមានអ្នកណាម្នាក់នៅកម្ពុជាជួបប្រទះអាការៈហូរឈាមម្នាក់ឯង។",
      history_presidents: "ប្រធានកាលពីអតីត",
      history_tab_1: "បង្កើតឡើង",
      history_tab_2: "សមាជិក WFH",
      history_tab_3: "ភាពជាដៃគូ",
      history_tab_4: "ទូទាំងប្រទេស",
      history_phase_1: "ដំណាក់កាលទី ០១ · ចាប់ផ្តើម",
      history_era_2011: "ឆ្នាំ ២០១១",
      history_h1_1: "បង្កើតឡើងដោយក្រុមគ្រួសារប្រកបដោយសេចក្តីមេត្តា និងអ្នកជំងឺឈានមុខនៅភ្នំពេញ",
      history_h1_2: "បានបង្កើតបញ្ជីឈ្មោះគាំទ្រអ្នកជំងឺហេម៉ូហ្វីលាដំបូងគេនៅកម្ពុជា",
      history_btn_explore_2014: "ស្វែងយល់ឆ្នាំ ២០១៤៖ ការទទួលស្គាល់ជាសកល",
      history_badge_2011: "សម័យកាលបង្កើត · ឆ្នាំ ២០១១",
      history_c1_title: "រួបរួមគ្នាដោយក្តីសង្ឃឹម",
      history_c1_desc: "រង្វង់គាំទ្រអ្នកជំងឺក្នុងអំឡុងពេលកិច្ចប្រជុំបង្កើតដំបូងរបស់ CHA។",
      history_phase_2: "ដំណាក់កាលទី ០២ · សម្ព័ន្ធភាពអន្តរជាតិ",
      history_era_2014: "ឆ្នាំ ២០១៤",
      history_h2_1: "ការដាក់បញ្ចូលដោយផ្ទាល់ទៅក្នុងកម្មវិធីជំនួយមនុស្សធម៌ WFH",
      history_h2_2: "ស្តង់ដារអន្តរជាតិសម្រាប់ការបញ្ជាក់រោគវិនិច្ឆ័យ និងកត្តាកំណកឈាមសុវត្ថិភាព",
      history_btn_explore_2017: "ស្វែងយល់ឆ្នាំ ២០១៧៖ ភាពជាដៃគូមន្ទីរពេទ្យ",
      history_badge_2014: "ការតម្រឹមជាសកល · ឆ្នាំ ២០១៤",
      history_c2_title: "សហព័ន្ធគាំទ្រជំងឺហេម៉ូហ្វីលាពិភពលោក",
      history_c2_desc: "ការតភ្ជាប់អ្នកជំងឺកម្ពុជាទៅកាន់សហគមន៍ថែទាំសកលលោក។",
      history_phase_3: "ដំណាក់កាលទី ០៣ · ការពង្រីកគ្លីនិក",
      history_era_2017: "ឆ្នាំ ២០១៧",
      history_h3_1: "បណ្តាញមន្ទីរពេទ្យព្យាបាលត្រូវបានបង្កើតឡើងជាមួយការផ្គត់ផ្គង់កត្តាសង្គ្រោះបន្ទាន់",
      history_h3_2: "ការបណ្តុះបណ្តាលឯកទេសសម្រាប់គិលានុបដ្ឋាយិកា និងគ្រូពេទ្យឯកទេសឈាមស្តីពីការគ្រប់គ្រងការហូរឈាម",
      history_btn_explore_2023: "ស្វែងយល់ឆ្នាំ ២០២៣៖ ការឈានដល់ថ្នាក់ជាតិ",
      history_badge_2017: "អង្គភាពមន្ទីរពេទ្យ · ឆ្នាំ ២០១៧",
      history_c3_title: "ការកសាងសមត្ថភាពគ្លីនិក",
      history_c3_desc: "កិច្ចសហការជាមួយក្រុមគ្លីនិកមន្ទីរពេទ្យដើម្បីពន្លឿនការថែទាំបន្ទាន់។",
      history_phase_4: "ដំណាក់កាលទី ០៤ · សហគមន៍ និងឌីជីថល",
      history_era_2023: "ឆ្នាំ ២០២៣",
      history_h4_1: "ជំរុំផ្សព្វផ្សាយគ្របដណ្តប់លើសពី ១០ ខេត្តនៅកម្ពុជា",
      history_h4_2: "ប័ណ្ណសុខភាពសមាជិកឌីជីថលសម្រាប់ការកំណត់អត្តសញ្ញាណរោគវិនិច្ឆ័យសង្គ្រោះបន្ទាន់ភ្លាមៗ",
      history_btn_explore_2011: "ត្រឡប់ទៅឆ្នាំ ២០១១៖ ប្រភពដើម",
      history_badge_2023: "ទូទាំងប្រទេស · ឆ្នាំ ២០២៣",
      history_c4_title: "គ្រួសារទូទាំងប្រទេស",
      history_c4_desc: "ពង្រឹងសមត្ថភាពអ្នកជំងឺ និងក្រុមគ្រួសារដែលមានបញ្ហាហូរឈាមទូទាំងប្រទេសកម្ពុជា។",
      history_established: "CHA បង្កើតឡើង",
      history_established_desc: "CHA ត្រូវបានបង្កើតឡើងដោយអ្នកជំងឺ និងគ្រួសារ។",
      history_wfh_member: "សមាជិក WFH",
      history_wfh_member_desc: "ក្លាយជាសមាជិកនៃសហព័ន្ធគាំទ្រជំងឺហេម៉ូហ្វីលាពិភពលោក។",
      history_hospital: "ភាពជាដៃគូជាមួយមន្ទីរពេទ្យ",
      history_hospital_desc: "ភាពជាដៃគូជាមួយមន្ទីរពេទ្យដើម្បីកែលម្អការចូលប្រើប្រាស់ការព្យាបាល។",
      history_national: "ការឈានដល់ថ្នាក់ជាតិ",
      history_national_desc: "ពង្រីកការអប់រំ និងការឈានដល់ទូទាំងខេត្ត។",
      history_president: "ប្រធាន",
      /* Leadership */
      lead_mandate_eyebrow: "អាណត្តិទី ៥ (២០២៦–២០៣០)",
      lead_chart_motto: "ទ្រទ្រង់សមាគម ដើម្បីសុខុមាលភាពអ្នកជំងឺអេម៉ូហ្វីលី",
      lead_role_founder_adv: "ស្ថាបនិក និងទីប្រឹក្សា",
      lead_badge_founder: "ស្ថាបនិក",
      lead_badge_cofounder: "សហស្ថាបនិក",
      lead_role_med_adv: "ទីប្រឹក្សាវេជ្ជសាស្ត្រ",
      lead_name_sophal: "សាស្ត្រាចារ្យ ឈាន សុផល",
      lead_desc_sophal: "ស្ថាបនិកគាំទ្រ និងទីប្រឹក្សាគ្លីនិក",
      lead_role_cofounder_adv: "សហស្ថាបនិក និងទីប្រឹក្សា",
      lead_name_singheng: "វេជ្ជបណ្ឌិត ស៊ឹង ហេង",
      lead_desc_singheng: "សហស្ថាបនិក និងទីប្រឹក្សាវេជ្ជសាស្ត្រ",
      lead_role_hon_pres: "ប្រធានកិត្តិយស",
      lead_name_sokpanha: "លោក សែម សុខបញ្ញា",
      lead_desc_sokpanha: "ឥស្សរជនដឹកនាំកិត្តិយស",
      lead_flow_exec: "អភិបាលកិច្ចប្រតិបត្តិ",
      lead_tier_exec: "មន្ត្រីក្រុមប្រឹក្សាភិបាលប្រតិបត្តិ",
      lead_role_pres: "ប្រធាន",
      lead_name_chanthearithy: "លោក រុន ស៊ី. រិទ្ធី",
      lead_mandate_pres: "អាណត្តិទី ៥ (២០២៦–២០៣០)",
      lead_role_vp: "អនុប្រធាន",
      lead_name_syneang: "លោក នឿន ស៊ីនាង",
      lead_mandate_vp: "អនុប្រធាន CHA",
      lead_role_treasurer: "ប្រធានផ្នែកហិរញ្ញវត្ថុ",
      lead_name_somaly: "លោកស្រី ស៊ូង សុម៉ាលី",
      lead_mandate_cfo: "ប្រធានផ្នែកហិរញ្ញវត្ថុ",
      lead_role_secgen: "អគ្គលេខាធិការ",
      lead_name_choryee: "លោកស្រី ហ៊ុន ចរិយា",
      lead_mandate_secgen: "អគ្គលេខាធិការ",
      lead_flow_depts: "ក្រុមការងារប្រតិបត្តិ និងប្រធាននាយកដ្ឋាន",
      dept_badge_1: "ក្រុមគាំទ្រ CHA",
      dept_name_1: "លោក ស្រេង ស៊ឹង",
      dept_role_1: "ប្រធានក្រុមគាំទ្រខេត្តសៀមរាប",
      dept_badge_2: "ឌីជីថល",
      dept_name_2: "លោក អ៊ុំ ណារ៉ូ",
      dept_role_2: "ប្រធានផ្នែកឌីជីថល",
      dept_badge_3: "ប្រធានអង្គភាពប្រតិកម្មរហ័ស",
      dept_name_3: "លោក កាន់ សុខខៃ",
      dept_role_3: "ប្រធានអង្គភាពប្រតិកម្មរហ័ស",
      dept_badge_5: "អគ្គលេខាធិការរង និងប្រធានផ្នែកស្ម័គ្រចិត្ត",
      dept_name_5: "លោក សាត ដារ៉ា",
      dept_role_5: "អគ្គលេខាធិការរង និងប្រធានផ្នែកស្ម័គ្រចិត្ត",
      dept_role_5_chart: "អគ្គលេខាធិការរង និងប្រធានផ្នែកស្ម័គ្រចិត្ត",
      hubs_eyebrow: "បណ្តាញមូលដ្ឋាន និងប្រតិបត្តិការ",
      hubs_title: "ក្រុមការងារឯកទេស និងជំពូកប្រចាំតំបន់",
      hubs_subtitle: "ការពង្រឹងសមត្ថភាពអ្នកជំងឺ ការតស៊ូមតិយុវជន រង្វង់ថែទាំស្ត្រី និងការផ្សព្វផ្សាយតាមមន្ទីរពេទ្យខេត្តទូទាំងប្រទេសកម្ពុជា។",
      hub_badge_youth: "ការតស៊ូមតិយុវជន",
      hub_count_7: "សមាជិក ៧ នាក់",
      hub_team_7: "ក្រុម (៧ នាក់)",
      hub_role_leader: "ប្រធានក្រុម",
      hub_lead_kc: "លោក កែវពេជ្រ ច័ន្ទដា",
      hub_oversight_1: "ត្រួតពិនិត្យដោយ លោក រុន ច័ន្ទធារិទ្ធិ និង លោក កាន់ សុខខៃ",
      hub_badge_women: "ការថែទាំស្ត្រី និងគ្រួសារ",
      hub_count_12: "សមាជិក ១២ នាក់",
      hub_team_12: "ក្រុម (១២ នាក់)",
      hub_lead_sr: "លោកស្រី ស៊ុំ រដ្ឋា",
      hub_badge_src: "មណ្ឌលប្រចាំតំបន់ពាយ័ព្យ",
      hub_count_6: "សមាជិក ៦ នាក់",
      hub_team_6: "ក្រុម (៦ នាក់)",
      hub_name_src: "ជំពូកខេត្តសៀមរាប (SRC)",
      hub_desc_src: "សម្របសម្រួលការងារគ្លីនិកប្រចាំតំបន់ ការផ្តល់កត្តាកំណកឈាមសង្គ្រោះបន្ទាន់ និងការថែទាំតាមមន្ទីរពេទ្យជាមួយមន្ទីរពេទ្យកុមារអង្គរ និងមណ្ឌលសុខភាពមូលដ្ឋាន។",
      hub_role_chapter_head: "ប្រធានជំពូក",
      hub_lead_ss: "លោក ស្រេង ស៊ឹង",
      hub_oversight_src: "ទីប្រឹក្សាគ្លីនិក៖ វេជ្ជបណ្ឌិត ស៊ឹង ហេង (ទីប្រឹក្សាវេជ្ជសាស្ត្រ)",
      hub_badge_volunteers: "កម្លាំងវាលសហគមន៍",
      hub_name_volunteers: "បណ្តាញអ្នកស្ម័គ្រចិត្ត",
      hub_desc_volunteers: "អ្នកស្ម័គ្រចិត្តជួរមុខចល័តតាមបណ្តាខេត្តដើម្បីគាំទ្រការដឹកជញ្ជូនអ្នកជំងឺទៅមន្ទីរពេទ្យ ការផ្សព្វផ្សាយសហគមន៍ ភស្តុភារបរិច្ចាគសង្គ្រោះបន្ទាន់ និងយុទ្ធនាការបរិច្ចាគឈាម។",
      hub_role_network_leader: "ប្រធានបណ្តាញ",
      hub_lead_sd: "លោក សាត ដារ៉ា",
      /* Working Group & Chapter Roster Drawers */
      roster_role_deputy_leader: "អនុប្រធានក្រុម",
      roster_role_finance: "អ្នកសម្របសម្រួលហិរញ្ញវត្ថុ",
      roster_role_admin: "រដ្ឋបាល",
      roster_role_youth_vol: "អ្នកស្ម័គ្រចិត្តយុវជន",
      roster_role_member: "សមាជិក",
      roster_role_supervisor: "អ្នកត្រួតពិនិត្យ",
      roster_role_reg_vol: "អ្នកស្ម័គ្រចិត្តប្រចាំតំបន់",
      roster_role_field_vol: "អ្នកស្ម័គ្រចិត្តជួរមុខ",
      roster_youth_title: "ក្រុមយុវជន",
      roster_youth_subtitle: "សមាជិក និងមន្ត្រីសកម្ម ៧ នាក់",
      roster_youth_m1_name: "លោក សាយ អុកសភា",
      roster_youth_m2_name: "លោក គី អៀងថុល",
      roster_youth_m3_name: "លោក ស្រឹម ប៉េងលាង",
      roster_youth_m4_name: "លោក ខាន់ ដារ៉ា",
      roster_women_title: "ក្រុមស្ត្រី",
      roster_women_subtitle: "សមាជិក និងមន្ត្រីសកម្ម ១២ នាក់",
      roster_women_m1_name: "លោកស្រី យឹម ម៉ារី",
      roster_women_m2_name: "លោកស្រី ហ៊ីម សុម៉ាឡា",
      roster_women_m3_name: "លោកស្រី ស្រឹម ស្រីពេជ្រ",
      roster_women_m4_name: "លោកស្រី ទ្រី កក្កដា",
      roster_women_m5_name: "លោកស្រី ផុន សុខនី",
      roster_women_m6_name: "លោកស្រី សំ ផល្លា",
      roster_women_m7_name: "លោកស្រី ហេង ស៊ីម",
      roster_women_m8_name: "លោកស្រី ទូច សុជាតា",
      roster_women_m9_name: "លោកស្រី ហ៊ូ ស្រីនី",
      roster_src_title: "ក្រុមជំពូកខេត្តសៀមរាប",
      roster_src_subtitle: "សមាជិក និងមន្ត្រីសកម្ម ៦ នាក់",
      roster_src_m1_name: "លោក រុន ច័ន្ទធារិទ្ធិ",
      roster_src_m2_name: "កញ្ញា កែវ សុវណ្ណឌី",
      roster_src_m3_name: "លោកស្រី ស៊ុន សុខន",
      roster_src_m4_name: "លោក ប៉ាច បញ្ញាវរវង្ស",
      roster_vol_title: "ក្រុមបណ្តាញអ្នកស្ម័គ្រចិត្ត",
      roster_vol_subtitle: "សមាជិក និងអ្នកស្ម័គ្រចិត្តសកម្ម ១២ នាក់",
      roster_vol_m1_name: "កញ្ញា ជ័រ សូនីតា",
      roster_vol_m2_name: "កញ្ញា ស្រ៊ិន វីនឈីង",
      roster_vol_m3_name: "កញ្ញា អឿន ស្រីនាត",
      roster_vol_m4_name: "លោក ពៅ ឡាយ",
      roster_vol_m5_name: "លោក ផន សូវៀត",
      roster_vol_m6_name: "លោក ម៉ម ប៊ុនធាត",
      roster_vol_m7_name: "លោក យ៉ង ថេតយុទ្ធថន",
      roster_vol_m8_name: "កញ្ញា នឿន សុវណ្ណនីតា",
      leadership_heading: "ក្រុមដឹកនាំ",
      leadership_sub: "អ្នកដែលឧទ្ទិសដល់បេសកកម្មរបស់ CHA នៅទូទាំងប្រទេសកម្ពុជា។",
      leadership_meet: "ជួបក្រុមពេញ",
      leadership_youth_title: "ក្រុមយុវជន",
      leadership_youth_desc: "បណ្តាញអ្នកជំងឺ និងអ្នកគាំទ្រវ័យក្មេងដែលដឹកនាំយុទ្ធនាការលើកកម្ពស់ការដឹងគុណ ការណែនាំស្មើគ្នា និងការតស៊ូមតិដែលដឹកនាំដោយយុវជននៅទូទាំងប្រទេសកម្ពុជា។",
      leadership_women_title: "ក្រុមស្ត្រី",
      leadership_women_desc: "ផ្តល់សមត្ថភាពដល់ស្ត្រីដែលរងផលប៉ះពាល់ពីអាការៈហូរឈាមតាមរយៈវង់គាំទ្រ ការអប់រំអំពីជំងឺ VWD និងបញ្ហាអ្នកផ្ទុក និងព្រឹត្តិការណ៍ស្ថាបនាសហគមន៍។",
      /* WFH */
      wfh_alliances_eyebrow: "សម្ព័ន្ធភាពសកល និងការផ្គូផ្គងអន្តរជាតិ",
      wfh_switch_wfh: "សហព័ន្ធគាំទ្រជំងឺហេម៉ូហ្វីលាពិភពលោក",
      wfh_switch_hfa: "មូលនិធិជំងឺហេម៉ូហ្វីលាអូស្ត្រាលី",
      wfh_hq_montreal: "ម៉ុងត្រេអាល់ កាណាដា · សហព័ន្ធសកល",
      wfh_metric_membership: "សមាជិកភាពសកម្ម",
      wfh_metric_passthrough: "ជំនួយមនុស្សធម៌ ១០០%",
      wfh_p1_title: "ជំនួយមនុស្សធម៌ និងការបរិច្ចាគកត្តាកំណកឈាម",
      wfh_p1_desc: "ការធានានូវកត្តាកំណកឈាមសង្គ្រោះបន្ទាន់ចែកចាយដោយផ្ទាល់ទៅកាន់មជ្ឈមណ្ឌលព្យាបាលទូទាំងប្រទេសកម្ពុជា។",
      wfh_p2_title: "គោលការណ៍ណែនាំគ្លីនិកស្តង់ដារ",
      wfh_p2_desc: "ការអនុវត្តស្តង់ដាររោគវិនិច្ឆ័យអន្តរជាតិ WFH និងគំរូថែទាំទូលំទូលាយសម្រាប់គ្លីនិកកុមារកម្ពុជា។",
      wfh_p3_title: "ការតស៊ូមតិសកល និងតំណាងមហាសន្និបាត",
      wfh_p3_desc: "តំណាងឱ្យអ្នកជំងឺដែលមានបញ្ហាហូរឈាមនៅកម្ពុជាក្នុងសមាជពិភពលោក WFH រៀងរាល់ពីរឆ្នាំម្តង។",
      wfh_official_portal: "គេហទំព័រផ្លូវការ",
      wfh_btn_explore_hfa: "ស្វែងយល់ពីសម្ព័ន្ធភាព HFA អូស្ត្រាលី",
      wfh_glass_title: "បណ្តាញសកល WFH",
      wfh_glass_subtitle: "អង្គការសមាជិកជាតិដែលត្រូវបានទទួលស្គាល់",
      wfh_pill_member_since: "សមាជិកផ្លូវការ · តាំងពីឆ្នាំ ២០១៤",
      wfh_hq_melbourne: "មែលប៊ន អូស្ត្រាលី · សម្ព័ន្ធភាពផ្គូផ្គង",
      wfh_metric_clinicians: "គ្រូពេទ្យត្រូវបានបណ្តុះបណ្តាល",
      wfh_metric_bilateral_val: "ទ្វេភាគី",
      wfh_metric_bilateral_lbl: "ការផ្គូផ្គងសកម្ម",
      wfh_hfa_p1_title: "ការណែនាំគ្លីនិក និងអាហារូបករណ៍វេជ្ជសាស្ត្រ",
      wfh_hfa_p1_desc: "ការតភ្ជាប់គ្រូពេទ្យឯកទេសឈាមជាន់ខ្ពស់អូស្ត្រាលីជាមួយវេជ្ជបណ្ឌិត និងបុគ្គលិកមន្ទីរពេទ្យកម្ពុជា។",
      wfh_hfa_p2_title: "សិក្ខាសាលាឯកទេសគិលានុបដ្ឋាយិកា និងចលនាសម្ព័ន្ធ",
      wfh_hfa_p2_desc: "ការណែនាំអំពីការស្តារនីតិសម្បទាជាក់ស្តែងដើម្បីការពារភាពគាំងសន្លាក់ និងផលវិបាកនៃការហូរឈាមសាច់ដុំ។",
      wfh_hfa_p3_title: "ជំរុំតស៊ូមតិយុវជន និងក្រុមគ្រួសារ",
      wfh_hfa_p3_desc: "ការពង្រឹងសមត្ថភាពឪពុកម្តាយ អ្នកផ្ទុក និងទូតយុវជនជាមួយនឹងការចាក់ថ្នាំដោយខ្លួនឯង និងការគាំទ្រផ្លូវចិត្ត-សង្គម។",
      wfh_at_hfa: "នៅ HFA អូស្ត្រាលី",
      wfh_btn_view_wfh: "មើលភាពជាដៃគូសកល WFH",
      wfh_hfa_glass_title: "សម្ព័ន្ធភាពផ្គូផ្គងអូស្ត្រាលី",
      wfh_hfa_glass_subtitle: "ការកសាងសមត្ថភាព និងការណែនាំគ្លីនិក",
      wfh_pill_twinning_partner: "ដៃគូកម្មវិធីផ្គូផ្គង",
      wfh_heading: "ការងាររបស់យើងជាមួយ WFH និង HFA",
      wfh_sub: "CHA សូមក្រើនរង្វង់ក្នុងការជាដៃគូជាមួយអង្គការឈានមុខគេក្នុងពិភពលោកដើម្បីពង្រឹងការថែទាំជំងឺហេម៉ូហ្វីលានៅកម្ពុជា។",
      wfh_wfh_name: "សហព័ន្ធគាំទ្រជំងឺហេម៉ូហ្វីលាពិភពលោក",
      wfh_wfh_tag: "សមាជិកចាប់តាំងពីឆ្នាំ ២០១៤",
      wfh_wfh_stat_label: "ប្រទេសក្នុងបណ្តាញ",
      wfh_wfh_desc: "សមាជិកសហគមន៍សហព័ន្ធ WFH ។ តាមរយៈភាពជាដៃគូនេះ CHA ទទួលបានគោលនាំព្យាបាលអន្តរជាតិ កម្មវិធីបណ្តុះបណ្តាល និងជំនួយមនុស្សធម៌ដែលផ្ទាល់កែលម្អការថែទាំអ្នកជំងឺ។",
      wfh_wfh_link: "ទស្សនា WFH",
      wfh_hfa_name: "មូលនិធិជំងឺហេម៉ូហ្វីលាអូស្ត្រាលី",
      wfh_hfa_tag: "ដៃគូបណ្តុះបណ្តាល",
      wfh_hfa_stat_label: "កម្មវិធីរួម",
      wfh_hfa_desc: "HFA ជាដៃគូជាមួយ CHA ក្នុងការកសាងសមត្ថភាព ការបណ្តុះបណ្តាលពេទ្យ និងការតស៊ូមតិអ្នកជំងឺ។ កម្មវិធីរួមភ្ជាប់អ្នកពេទ្យកម្ពុជាជាមួយជំនាញអូស្ត្រាលី។",
      wfh_hfa_link: "ស្វែងយល់បន្ថែម",
      /* Haemophilia */
      haem_eyebrow: "ជំងឺហូរឈាមសរីរាង្គកំណើត",
      haem_divider: "អំពីជំងឺហេម៉ូហ្វីលា",
      haem_heading: "ជំងឺហេម៉ូហ្វីលាគឺជាអ្វី?",
      haem_contact: "ទំនាក់ទំនងជំនាញ",
      haem_para_1: "ជំងឺហេម៉ូហ្វីលាគឺជាអាការៈហូរឈាមសរីរាង្គកំណើតដ៏កម្រមួយដែលប៉ះពាល់ដល់សមត្ថភាពរបស់អ្នកជំងឺក្នុងការបញ្ឈប់ការហូរឈាម។ អ្នកជំងឺហេម៉ូហ្វីលាអាចហូរឈាមយូរជាងអ្នកដទៃបន្ទាប់ពីរបួស ឬសូម្បីតែដោយគ្មានមូលហេតុដែលដឹង។",
      haem_para_2: "ទោះបីជាមិនមានវិធីព្យាបាលក៏ដោយ ក៏ការព្យាបាលទំនើបអនុញ្ញាតឱ្យអ្នកជំងឺហេម៉ូហ្វីលារស់នៅពេញលេញ សកម្ម និងមានសុខភាពល្អ។ ការវិនិច្ឆ័យដំបូង ការព្យាបាលត្រឹមត្រូវ និងការគាំទ្រជាបន្តបន្ទាប់គឺជាគន្លឹះក្នុងការការពារផលវិបាក និងការខូចខាតសន្លាក់។",
      haem_clot_title: "កង្វះដំណើរការកកឈាម",
      haem_clot_desc: "បណ្តាញកកឈាម Factor VIII (A) & Factor IX (B)",
      /* Types */
      types_heading: "ប្រភេទជំងឺហេម៉ូហ្វីលា",
      types_sub: "ប្រភេទសំខាន់ៗចំនួនពីរនៃជំងឺហេម៉ូហ្វីលា — ទាំងពីរត្រូវការការវិនិច្ឆ័យត្រឹមត្រូវ និងការគ្រប់គ្រងអាយុជីវិត។",
      types_a_title: "ហ្វូនឌីកប្រភេទ A",
      types_a_desc: "បណ្តាលមកពីការខ្វះខាត factor VIII។ ជាប្រភេទដែលឃើញញឹកញាប់បំផុត។",
      types_b_title: "ហ្វូនឌីកប្រភេទ B",
      types_b_desc: "បណ្តាលមកពីការខ្វះខាត factor IX។ ពេលខ្លះហៅថា ជំងឺ Christmas។",
      /* Symptoms */
      symptoms_eyebrow: "សូចនាករគ្លីនិក",
      symptoms_heading: "រោគសញ្ញាទូទៅ",
      symptoms_sub: "ការស្គាល់សញ្ញានៃអាការៈហូរឈាមគឺជាជំហានដំបូងឆ្ពោះទៅរកការវិនិច្ឆ័យ និងការថែទាំដែលត្រឹមត្រូវ។",
      symptom_sign_1: "សញ្ញា ០១",
      symptom_sign_2: "សញ្ញា ០២",
      symptom_sign_3: "សញ្ញា ០៣",
      symptom_sign_4: "សញ្ញា ០៤",
      symptom_sign_5: "សញ្ញា ០៥",
      symptom_bruising: "ស្នាមជាំងាយស្រួល",
      symptom_bruising_desc: "ស្នាមជាំដែលមិនពន្យល់បានពីការប៉ះទង្គិចតូច។",
      symptom_nosebleeds: "ការហូរឈាមច្រមុជច្រើន",
      symptom_nosebleeds_desc: "ការហូរឈាមច្រមុជដែលកើតឡើងជាបន្តបន្ទាប់។",
      symptom_gums: "អញ្ចាញធ្មេញហូរឈាម",
      symptom_gums_desc: "អញ្ចាញធ្មេញដែលហូរឈាមពេលដុសធ្មេញ ឬញ៉ាំអាហារ។",
      symptom_joint: "ឈឺ ឬហើមសន្លាក់",
      symptom_joint_desc: "សន្លាក់ឈឺ និងហើមបន្ទាប់ពីរបួស ឬសកម្មភាពតូច។",
      symptom_prolonged: "ហូរឈាមយូរ",
      symptom_prolonged_desc: "ការហូរឈាមដែលច្រើនជាងរំពឹងទុកបន្ទាប់ពីរបួស។",
      symptom_cta: "ជួបប្រទះរោគសញ្ញាទាំងនេះទេ? ការវិនិច្ឆ័យដំបូងអាចធ្វើឱ្យមានភាពខុសគ្នាដែលផ្លាស់ប្តូរជីវិត។",
      symptom_find_centre: "ស្វែងរកមជ្ឈមណ្ឌលព្យាបាល",
      symptom_contact_specialist: "ទំនាក់ទំនងជំនាញ",
      /* VWD */
      vwd_eyebrow: "ជំងឺហូរឈាមដែលកើតមានញឹកញាប់បំផុត",
      vwd_heading: "ជំងឺ Von Willebrand (VWD)",
      vwd_para_1: "ជំងឺ Von Willebrand គឺជាអាការៈហូរឈាមកំណើតដែលឃើញញឹកញាប់បំផុត ដែលប៉ះពាល់ដល់ប្រុស និងស្រីស្មើគ្នា។ វាបណ្តាលមកពីការខ្វះខាត ឬមុខងារមិនប្រក្រតីនៃវិទ្យុសាស្រ្ត von Willebrand (VWF) ដែលជាប្រូតេអ៊ីនដែលជួយឈាមកក។",
      vwd_para_2: "មានប្រភេទសំខាន់ៗចំនួនបួននៃជំងឺ VWD — ប្រភេទ ១ (ស្រាល) ប្រភេទ ២ (មធ្យម) និងប្រភេទ ៣ (ធ្ងន់ធ្ងរ)។ មួយនីមួយៗខុសគ្នាលើចំនួន VWF ដែលមាន និងរបៀបដែលវាដំណើរការ។ រោគសញ្ញារួមមានស្នាមជាំងាយស្រួល ការហូរឈាមច្រមុជច្រើន ការហូរឈាមអូវុលច្រើន និងការហូរឈាមយូរបន្ទាប់ពីវះកាត់ ឬរបួស។",
      vwd_find: "ស្វែងរកការព្យាបាល",
      vwd_action_note: "ប៉ះពាល់ដល់ប្រជាជនពិភពលោកប្រហែល ១%",
      vwd_chip_title: "កត្តា Von Willebrand (VWF)",
      vwd_chip_desc: "ការតោងផ្លាកែត និងលំនឹង Factor VIII",
      /* Other */
      other_heading: "អាការៈហូរឈាមផ្សេងទៀត",
      other_rare_title: "ការខ្វះខាតកត្តាដ៏កម្រ",
      other_rare_desc: "ការខ្វះខាតកត្តា I, II, V, VII, X, XI, XII និង XIII។ មួយនីមួយៗត្រូវការការវិនិច្ឆ័យ និងការព្យាបាលជាក់លាក់។",
      other_platelet_title: "ជំងឺមុខងារ platelet",
      other_platelet_desc: "ស្ថានភាពដែល platelet មិនដំណើរការត្រឹមត្រូវ ដែលនាំឱ្យហូរឈាមទោះបីជាចំនួន platelet ធម្មតា។",
      other_more: "សម្រាប់ព័ត៌មានបន្ថែមអំពីអាការៈហូរឈាមណាមួយ សូមទំនាក់ទំនងក្រុមរបស់យើង ឬទស្សនាមជ្ឈមណ្ឌលព្យាបាល។",
      /* Treatment */
      tc_eyebrow: "ដៃគូថែទាំជាតិ",
      treatment_heading: "មជ្ឈមណ្ឌលព្យាបាល",
      treatment_sub: "ស្វែងរកមជ្ឈមណ្ឌលព្យាបាលជំងឺហេម៉ូហ្វីលានៅទូទាំងប្រទេសកម្ពុជា — ស្វែងតាមខេត្ត។",
      treatment_select: "ជ្រើសរើសខេត្ត",
      tc_select_all: "គ្រប់ខេត្ត (ទូទាំងប្រទេស)",
      tc_active_badge: "មជ្ឈមណ្ឌលផ្ទៀងផ្ទាត់សកម្មចំនួន ២",
      province_phnom_penh: "រាជធានីភ្នំពេញ",
      province_siem_reap: "ខេត្តសៀមរាប",
      province_battambang: "ខេត្តបាត់ដំបង",
      province_sihanoukville: "ខេត្តព្រះសីហនុ",
      tc_nph_title: "មន្ទីរពេទ្យកុមារជាតិ (NPH) — គ្លីនិកជំងឺហេម៉ូហ្វីលា",
      tc_nph_address: "មហាវិថីសហព័ន្ធរុស្ស៊ី (១០០) រាជធានីភ្នំពេញ",
      tc_nph_hours: "ច័ន្ទ – សុក្រ៖ ៨:០០ ព្រឹក – ៤:៣០ ល្ងាច",
      tc_ahc_title: "មន្ទីរពេទ្យកុមារអង្គរ (AHC) — អង្គភាពជំងឺហេម៉ូហ្វីលា",
      tc_ahc_address: "ផ្លូវទេពវង្ស ក្រុងសៀមរាប",
      tc_ahc_hours: "ច័ន្ទ – អាទិត្យ៖ សម្រាកព្យាបាល ២៤ ម៉ោង",
      tc_tag_haem_ab: "ជំងឺហេម៉ូហ្វីលា A & B",
      tc_tag_vwd_care: "ការថែទាំ VWD",
      tc_tag_consultation: "ការពិគ្រោះយោបល់",
      tc_tag_diagnostic: "មន្ទីរពិសោធន៍វិនិច្ឆ័យ",
      tc_tag_factor_rep: "ការជំនួសកត្តាកំណកឈាម",
      tc_tag_family_counselling: "ការប្រឹក្សាគ្រួសារ",
      treatment_view_map: "មើលនៅលើផែនទី",
      treatment_emergency: "ជំនួយបន្ទាន់",
      treatment_emergency_desc: "ប្រសិនបើអ្នកមានបញ្ហាបន្ទាន់ពីការហូរឈាម សូមទំនាក់ទំនងមជ្ឈមណ្ឌលព្យាបាលជិតអ្នក ឬហៅលេខបន្ទាន់របស់យើង។",
      /* CSR */
      csr_heading: "កម្មវិធី CSR",
      csr_sub: "ការប្រមូលថវិកា ការបរិច្ចាគ និងភាពជាដៃគូអាជីវកម្មដែលជំរុញបេសកកម្មរបស់យើង។",
      csr_fundraising: "ប្រមូលថវិកា",
      csr_fundraising_desc: "ប្រមូលថវិកាតាមរយៈការប្រមូលក្នុងសហគមន៍ ព្រឹត្តិការណ៍ និងយុទ្ធនាការដៃគូដែលរក្សាកម្មវិធីរបស់យើងឱ្យដំណើរការ។",
      csr_view_campaigns: "មើលយុទ្ធនាការ",
      csr_donate_online: "បរិច្ចាគតាមអ៊ីនធឺណិត",
      csr_donate_online_desc: "បរិច្ចាគដោយសុវត្ថិភាពតាមរយៈ KHQR (ABA Mobile និង Bakong) — រាល់ការរួមចំណែកផ្លាស់ប្តូរជីវិតនៅទូទាំងប្រទេសកម្ពុជា។",
      csr_donate_now: "បរិច្ចាគឥឡូវ",
      csr_partners_title: "ដៃគូអាជីវកម្ម",
      csr_partners_desc: "អង្គការដែលគួរឱ្យទុកចិត្តដែលគាំទ្របេសកកម្មរបស់យើង និងពង្រីកការឈានដល់របស់យើងទូទាំងប្រទេស។",
      csr_become_partner: "ក្លាយជាដៃគូ",
      /* Impact */
      impact_heading: "ផលប៉ះពាល់របស់អ្នក",
      impact_eyebrow: "ការចូលរួមចំណែករបស់អ្នកជួយដល់",
      impact_t1_title: "ការទទួលបានការព្យាបាល",
      impact_treatment: "ផ្តល់ការចូលប្រើប្រាស់ការព្យាបាលដល់អ្នកជំងឺ",
      impact_t2_title: "ការអប់រំ និងការថែទាំ",
      impact_education: "គាំទ្រការអប់រំ និងការដឹងគុណ",
      impact_t3_title: "សមត្ថភាពថែទាំសុខភាព",
      impact_healthcare: "ពង្រឹងសមត្ថភាពថែទាំសុខភាព",
      impact_t4_title: "សហគមន៍ និងក្រុមគ្រួសារ",
      impact_families: "ផ្តល់សមត្ថភាពដល់គ្រួសារ និងសហគមន៍",
      /* Membership */
      tab_membership: "សមាជិកភាព",
      tab_donate: "បរិច្ចាគ",
      membership_heading: "អត្ថប្រយោជន៍សមាជិកភាព",
      membership_cta: "ត្រៀមខ្លួនចូលរួមជាមួយសហគមន៍របស់យើង?",
      membership_cta_sub: "ចូលរួមសហគមន៍របស់យើង ដើម្បីទទួលបានធនធានផ្តាច់មុខ ព្រឹត្តិការណ៍ និងការគាំទ្រពីអ្នករួមគ្នានៅទូទាំងកម្ពុជា។",
      membership_register: "ចុះឈ្មោះឥឡូវ",
      membership_signin: "ជាសមាជិករួចហើយ? ចូល",
      membership_cta_title: "ក្លាយជាសមាជិក",
      membership_cta_feature_1: "ធនធាន និងមគ្គុទេសក៍ផ្តាច់មុខ",
      membership_cta_feature_2: "ព្រឹត្តិការណ៍ និងជំនួបសហគមន៍",
      membership_cta_feature_3: "បណ្តាញគាំទ្រពីអ្នករួមគ្នា",
      membership_badge_count: "៥០០+",
      membership_badge_label: "សមាជិក និងកំពុងកើន",
      membership_benefit_1_title: "សហគមន៍ និងការគាំទ្រ",
      membership_benefit_1_desc: "ភ្ជាប់ជាមួយអ្នកជំងឺ គ្រួសារ និងអ្នកថែទាំនៅទូទាំងប្រទេសកម្ពុជា។",
      membership_benefit_2_title: "ការចូលប្រើប្រាស់ធនធាន",
      membership_benefit_2_desc: "មគ្គុទេសក៍ផ្តាច់មុខ សម្ភារៈអប់រំ និងព័ត៌មានព្យាបាល។",
      membership_benefit_3_title: "ព្រឹត្តិការណ៍ និងវិទិនាការ",
      membership_benefit_3_desc: "ចូលរួមសិក្ខាសាលាអនុវត្តជាក់ស្តែង ព្រឹត្តិការណ៍សហគមន៍ និងវគ្គសិក្សាតាមអ៊ីនធឺណិត",
      membership_benefit_4_title: "ការតស៊ូមតិ និងការដឹងគុណ",
      membership_benefit_4_desc: "ជួយលើកកម្ពស់ការដឹងគុណ និងតស៊ូមតិដើម្បីការថែទាំប្រសើរនៅទូទាំងប្រទេស។",
      membership_benefit_5_title: "ព័ត៌មាន និងnewsletter",
      membership_benefit_5_desc: "ទទួលបានព័ត៌មានថ្មីៗ និងសេចក្តីប្រកាសរបស់ CHA។",
      /* Donate */
      donate_heading: "ធ្វើការបរិច្ចាគ",
      donate_sub: "ការគាំទ្ររបស់អ្នកជួយផ្តល់ការព្យាបាល ការអប់រំ និងក្តីសង្ឃឹមដល់អ្នកមានបញ្ហាជំងឺហូរឈាមនៅកម្ពុជា។",
      donate_amount_label: "ចំនួនទឹកប្រាក់បរិច្ចាគ",
      donate_name_label: "ឈ្មោះពេញ (មិនបង្ខំ)",
      donate_email_label: "អ៊ីមែល (មិនបង្ខំ)",
      donate_phone_label: "លេខទូរស័ព្ទ (មិនបង្ខំ)",
      donate_ph_name: "បញ្ចូលឈ្មោះរបស់អ្នក",
      donate_ph_email: "បញ្ចូលអ៊ីមែលរបស់អ្នក",
      donate_ph_phone: "បញ្ចូលលេខទូរស័ព្ទរបស់អ្នក",
      donate_secure_note: "ស្កែនបង់ប្រាក់ផ្ទាល់តាម ABA Mobile, Bakong ឬកម្មវិធីធនាគារដែលគាំទ្រ KHQR",
      donate_khqr_badge: "KHQR ទូទាំងប្រទេស",
      donate_scan_title: "ស្កេន & គាំទ្រ",
      donate_scan_desc: "ផ្ទេរការបរិច្ចាគរបស់អ្នកដោយផ្ទាល់តាមរយៈ ABA Mobile, Bakong, Wing, ACLEDA, Canadia ឬកម្មវិធីធនាគារនានានៅកម្ពុជា។",
      donate_modal_desc: "ស្កេនជាមួយ ABA Mobile, Bakong ឬកម្មវិធីធនាគារនៅកម្ពុជាដើម្បីផ្ញើការចូលរួមរបស់អ្នក។",
      donate_account_name_lbl: "ឈ្មោះគណនី",
      donate_account_org: "សមាគមហេម៉ូហ្វីលាកម្ពុជា",
      donate_copy_btn: "ចម្លងលេខគណនី",
      donate_modal_copy_btn: "ចម្លង",
      donate_save_qr_btn: "រក្សាទុក QR រូបភាព",
      donate_step1_title: "បើកកម្មវិធីធនាគារ",
      donate_step1_desc: "ABA, Bakong ជាដើម",
      donate_step2_title: "ស្កេនកូដ KHQR",
      donate_step2_desc: "តម្រង់កាមេរ៉ាទៅ QR",
      donate_step3_title: "បញ្ចូលចំនួនទឹកប្រាក់",
      donate_step3_desc: "ជួយគាំទ្រអ្នកជំងឺដោយផ្ទាល់",
      donate_trust_note: "ផ្ទេរផ្ទាល់ភ្លាមៗ · គ្មានកម្រៃសេវាបន្ថែម",
      /* Contact */
      contact_divider: "ទំនាក់ទំនង",
      contact_heading: "ទំនាក់ទំនង",
      contact_sub: "មានសំណួរ ឬត្រូវការជំនួយ? យើងនៅទីនេះដើម្បីជួយ។",
      contact_subtitle: "យើងនៅទីនេះដើម្បីជួយអ្នកជំងឺ គ្រួសារ និងដៃគូនៅទូទាំងប្រទេសកម្ពុជា។",
      contact_day_monfri: "ចន្លោះថ្ងៃចន្ទ – សុក្រ",
      contact_day_sat: "សៅរ៍",
      contact_day_sun: "អាទិត្យ",
      contact_closed: "បិទ",
      contact_info: "ទាក់ទងយើង",
      contact_address: "អាសយដ្ឋាន",
      contact_phone: "ទូរស័ព្ទ",
      contact_email: "អ៊ីមែល",
      contact_hours: "ម៉ោងធ្វើការ",
      contact_message: "ផ្ញើសារដល់យើង",
      contact_message_sub: "បំពេញទម្រង់ខាងក្រោម ហើយយើងនឹងឆ្លើយតប។",
      contact_name: "ឈ្មោះពេញ",
      contact_email_label: "អ៊ីមែល",
      contact_subject: "ប្រធានបទ",
      contact_message_label: "សារ",
      contact_name_ph: "បញ្ចូលឈ្មោះពេញ",
      contact_email_ph: "បញ្ចូលអ៊ីមែល",
      contact_subject_ph: "នេះអំពីអ្វី?",
      contact_message_ph: "យើងអាចជួយដូចម្តេច?",
      contact_send: "ផ្ញើសារ",
      contact_address_val: "#អាគារ ១០០ មហាវិថីសហព័ន្ធរុស្ស៊ី (១១៤) រាជធានីភ្នំពេញ កម្ពុជា ប្រអប់សំបុត្រ ៧០០",
      /* Footer */
      footer_tagline: "គាំទ្រអ្នកមានអាការៈហូរឈាមនៅកម្ពុជា។",
      footer_quick_links: "តំណភ្ជាប់រហ័ស",
      footer_resources: "ធនធាន",
      footer_contact: "ទំនាក់ទំនង",
      footer_patient_guides: "មគ្គុទេសក៍អ្នកជំងឺ",
      footer_news_events: "ព័ត៌មាន និងព្រឹត្តិការណ៍",
      footer_donation: "បរិច្ចាគ",
      footer_copyright: "© ២០២៦ សមាគមជំងឺហេម៉ូហ្វីលាកម្ពុជា។ រក្សាសិទ្ធិគ្រប់យ៉ាង។",
      footer_privacy: "គោលនយោបាយឯកជន",
      footer_disclaimer: "ការបដិសេធ",
      footer_terms: "លក្ខខណ្ឌនៃការប្រើប្រាស់",
      footer_social: "តំណភ្ជាប់ប្រព័ន្ធផ្សព្វផ្សាយសង្គម",
      footer_find_us: "រកឃើញយើង",
      footer_get_involved: "ចូលរួម",
      footer_address: "ភ្នំពេញ កម្ពុជា",
      campaigns_active: "សកម្មភាពបច្ចុប្បន្ន",
      campaigns_badge: "បេសកកម្មសកម្ម",
      campaigns_heading: "យុទ្ធនាការបច្ចុប្បន្ន",
      campaigns_sub: "គាំទ្របេសកកម្មសង្គ្រោះជីវិត និងការថែទាំអ្នកជំងឺបន្ទាន់របស់យើង។",
      campaigns_ongoing: "កំពុងដំណើរការ",
      campaigns_ongoing_badge: "៣ កំពុងដំណើរការ",
      campaigns_view_all: "មើលទាំងអស់",
      campaigns_view_all_count: "មើលទាំងអស់ (៣)",
      campaigns_1_title: "មូលនិធិជំនួយអ្នកជំងឺ",
      campaigns_1_desc: "ជួយអ្នកជំងឺទទួលបានការព្យាបាល និងថ្នាំសំខាន់ៗ។",
      campaigns_2_title: "ការអប់រំ និងការយល់ដឹង",
      campaigns_2_desc: "គាំទ្រសិក្ខាសាលា និងសិក្ខាសាលាយល់ដឹងនៅទូទាំងខេត្ត។",
      campaigns_3_title: "ជំនួយបន្ទាន់",
      campaigns_3_desc: "ផ្តល់ជំនួយបន្ទាន់ដល់អ្នកជំងឺក្នុងស្ថានភាពធ្ងន់ធ្ងរ។",
      campaigns_raised_label: "ប្រមូលបាន",
      campaigns_goal_label: "គោលដៅ",
      campaigns_partners: "ដៃគូអាជីវកម្ម",
      campaigns_partners_sub: "ដៃគូសុខភាពសកល",
      campaigns_archive_heading: "យុទ្ធនាការបច្ចុប្បន្ន",
      campaigns_archive_sub: "គាំទ្របេសកកម្មរបស់យើង — រាល់ការចូលរួមចំណែកផ្លាស់ប្តូរជីវិតនៅទូទាំងកម្ពុជា។",
      news_archive_heading: "ព័ត៌មាន និងព្រឹត្តិការណ៍",
      news_archive_sub: "ទទួលបានព័ត៌មានថ្មីៗពីសមាគមជំងឺហូរឈាមកម្ពុជា។",
      news_filter_all: "ទាំងអស់",
      news_filter_event: "ព្រឹត្តិការណ៍",
      news_filter_update: "បច្ចុប្បន្នភាព",
      news_filter_workshop: "សិក្ខាសាលា",
      news_filter_announcement: "សេចក្តីប្រកាស",
      news_badge_event: "ព្រឹត្តិការណ៍",
      news_badge_update: "បច្ចុប្បន្នភាព",
      news_badge_workshop: "សិក្ខាសាលា",
      news_badge_announcement: "សេចក្តីប្រកាស",
      news_back_to_news: "ត្រឡប់ទៅព័ត៌មាន",
      nav_member: "ក្លាយជាសមាជិក",
      nav_my_card: "មើលកាត",
      nav_volunteer: "ស្ម័គ្រចិត្ត",
      nav_partner: "ដៃគូជាមួយយើង",
      nav_programs: "កម្មវិធី និងការថែទាំ",
      /* Dashboard */
      dash_title: "ផ្ទាំងគ្រប់គ្រងរបស់ខ្ញុំ",
      dash_member_id: "លេខសមាជិក",
      dash_email: "អ៊ីមែល",
      dash_phone: "លេខទូរស័ព្ទ",
      dash_address: "អាស័យដ្ឋាន",
      dash_member_since: "សមាជិកតាំងពី",
      dash_edit_profile: "កែសម្រួលប្រវត្តិរូប",
      dash_save: "រក្សាទុក",
      dash_cancel: "បោះបង់",
      dash_sign_out: "ចាកចេញ",
      dash_card_subtitle: "ប័ណ្ណសម្គាល់អ្នកជំងឺ",
      dash_no_photo: "គ្មានរូបថត",
      dash_name: "ឈ្មោះ",
      dash_dob: "ថ្ងៃខែឆ្នាំកំណើត",
      dash_condition: "ជម្ងឺ",
      dash_blood_type: "ប្រភេទឈាម",
      dash_created_at: "បង្កើតនៅ",
      dash_card_title_back: "ប័ណ្ណសម្គាល់អ្នកជំងឺ",
      dash_rules: "ច្បាប់",
      dash_rule_1: "ប័ណ្ណនេះជាកម្មសិទ្ធិរបស់សមាគមជំងឺហេម៉ូហ្វីលាកម្ពុជា។",
      dash_rule_2: "សូមបង្ហាញប័ណ្ណនេះពេលទទួលសេវាព្យាបាល។",
      dash_rule_3: "ប្រសិនបើបាត់ សូមទាក់ទងសមាគមជាបន្ទាន់។",
      dash_print_card: "បោះពុម្ពប័ណ្ណ",
      dash_ph_email: "អ៊ីមែល",
      dash_ph_phone: "លេខទូរស័ព្ទ",
      dash_ph_address: "អាស័យដ្ឋាន",
      dash_ph_name: "ឈ្មោះ",
      dash_ph_condition: "ឧ. ហេម៉ូហ្វីលីយ៉ា A",
      /* Modals & Forms */
      donate_badge: "គាំទ្រ CHA",
      donate_modal_title: "ធ្វើការបរិច្ចាគ",
      donate_modal_heading: "ជួយផ្លាស់ប្តូរជីវិត!",
      donate_modal_sub: "ការគាំទ្ររបស់អ្នកជួយផ្តល់ការព្យាបាល ការអប់រំ និងក្តីសង្ឃឹមដល់អ្នកមានបញ្ហាជំងឺហូរឈាមនៅកម្ពុជា។",
      donate_acct_name: "ការបរិច្ចាគ",
      donate_acct_sub: "មានសុវត្ថិភាព និងការសម្ងាត់ខ្ពស់",
      donate_acct_safe: "សុវត្ថិភាព",
      donate_other: "ផ្សេងទៀត",
      donate_ph_amount: "បញ្ចូលចំនួនទឹកប្រាក់ជាដុល្លារ (USD)",
      donate_secure_title: "ការទូទាត់ប្រកបដោយសុវត្ថិភាព",
      donate_secure_desc: "ស្កែនបង់ប្រាក់ផ្ទាល់តាម ABA Mobile, Bakong ឬកម្មវិធីធនាគារដែលគាំទ្រ KHQR។",
      donate_btn: "បរិច្ចាគឥឡូវ",
      donate_footer_note: "ស្កែនបង់ប្រាក់ផ្ទាល់តាម ABA Mobile, Bakong ឬកម្មវិធីធនាគារដែលគាំទ្រ KHQR",
      member_login_title: "ចូលប្រើប្រាស់គណនី",
      member_login_sub: "ចូលគណនីដើម្បីទទួលបានធនធាន និងការតភ្ជាប់ជាមួយសហគមន៍។",
      form_email_label: "អ៊ីមែល",
      form_email_ph: "បញ្ចូលអ៊ីមែលរបស់អ្នក",
      form_pass_label: "ពាក្យសម្ងាត់",
      form_pass_ph: "បញ្ចូលពាក្យសម្ងាត់របស់អ្នក",
      form_create_pass_ph: "បង្កើតពាក្យសម្ងាត់",
      member_forgot: "ភ្លេចពាក្យសម្ងាត់?",
      member_signin_btn: "ចូល",
      member_register_link: "ចុះឈ្មោះ",
      member_register_modal_title: "ចុះឈ្មោះសមាជិក",
      member_register_title: "ចូលរួមជាមួយសហគមន៍អ្នកជំងឺ ក្រុមគ្រួសារ និងសមាជិករបស់យើង។",
      form_i_am_a: "ខ្ញុំជា",
      role_member: "សមាជិក",
      role_patient: "អ្នកជំងឺ",
      role_patient_desc: "ខ្ញុំមានជំងឺហេម៉ូហ្វីលា",
      form_name_label: "ឈ្មោះពេញ",
      form_name_ph: "បញ្ចូលឈ្មោះពេញរបស់អ្នក",
      form_phone_label: "លេខទូរស័ព្ទ (មិនបង្ខំ)",
      form_phone_ph: "បញ្ចូលលេខទូរស័ព្ទរបស់អ្នក",
      form_address_label: "អាសយដ្ឋាន (មិនបង្ខំ)",
      form_address_ph: "បញ្ចូលអាសយដ្ឋានរបស់អ្នក",
      form_hemophilia_type_lbl: "ប្រភេទជំងឺហេម៉ូហ្វីលា",
      form_select_type: "ជ្រើសរើសប្រភេទ",
      form_opt_other: "ផ្សេងទៀត",
      form_specify_cond_ph: "បញ្ជាក់លម្អិតពីស្ថានភាពជំងឺ",
      form_select_blood: "ជ្រើសរើសប្រភេទឈាម",
      form_terms_agree: "ខ្ញុំយល់ព្រមលើ",
      form_terms_link: "លក្ខខណ្ឌនៃការប្រើប្រាស់",
      member_register_btn: "ចុះឈ្មោះឥឡូវ",
      member_already_account: "មានគណនីរួចហើយមែនទេ?",
      member_forgot_title: "កំណត់ពាក្យសម្ងាត់ឡើងវិញ",
      member_forgot_sub: "បញ្ចូលអ៊ីមែលរបស់អ្នក ហើយយើងនឹងផ្ញើតំណភ្ជាប់ដើម្បីកំណត់ពាក្យសម្ងាត់ឡើងវិញ។",
      member_forgot_btn: "ផ្ញើតំណភ្ជាប់កំណត់ពាក្យសម្ងាត់",
      /* Patient Card i18n (KM) */
      card_title_front: "ប័ណ្ណសម្គាល់អ្នកជំងឺ",
      card_title_eng: "Patient Identification Card",
      card_title_back: "ប័ណ្ណសម្គាល់អ្នកជំងឺ",
      card_label_id: "លេខប័ណ្ណ ID",
      card_label_name_khmer: "នាម និងគោត្តនាម",
      card_label_name_latin: "ឈ្មោះជាឡាតាំង",
      card_label_dob: "ថ្ងៃខែឆ្នាំកំណើត",
      card_label_condition: "ប្រភេទហេម៉ូហ្វីលីអា",
      card_label_blood: "ប្រភេទក្រុមឈាម",
      card_label_issue_date: "ធ្វើប័ណ្ណនៅថ្ងៃ",
      card_label_address: "អាសយដ្ឋាន",
      card_label_phone: "ទូរស័ព្ទ",
      card_hotline_nph: "លេខទូរស័ព្ទបន្ទាន់មន្ទីរពេទ្យកុមារជាតិ: 012 751 728",
      card_hotline_ahc: "លេខទូរស័ព្ទបន្ទាន់មន្ទីរពេទ្យកុមារអង្គរ: 063 963 409",
      card_keep_notice: "សូមរក្សាប័ណ្ណសម្គាល់សមាជិកនេះឱ្យបានល្អ",
      card_qr_label: "ស្កេនយើងខ្ញុំ",
      card_org_name_kh: "សមាគមហេម៉ូហ្វីលាកម្ពុជា",
      card_org_name_en: "Cambodian Hemophilia Association",
      card_rules_heading: "លក្ខខណ្ឌ៖",
      card_rule_1: "១. ប័ណ្ណសម្គាល់អ្នកជំងឺ គឺនឹងប្រើប្រាស់តែនៅក្នុងសមាគមជំងឺហេម៉ូហ្វីលាកម្ពុជា តែប៉ុណ្ណោះ។",
      card_rule_2: "២. ប័ណ្ណសម្គាល់អ្នកជំងឺ មានសុពលភាពប្រើប្រាស់ពេញមួយអាណត្តិទី៥ ឆ្នាំ២០២៦-២០៣០",
      card_rule_3: "៣. អ្នកជំងឺទាំងអស់ ត្រូវបន្តសុពលភាពប័ណ្ណសម្គាល់អ្នកជំងឺថ្មី ឱ្យបានមុនថ្ងៃទី១៧ ខែឧសភា ឆ្នាំ២០៣០",
      card_president_label: "ប្រធានសមាគម",
      card_president_name: "រុន ច័ន្ទរិទ្ធី",
      card_office_address: "អាសយដ្ឋាន: លេខ១០០ មហាវិថីសហព័ន្ធរុស្ស៊ី រាជធានីភ្នំពេញ ទូរស័ព្ទលេខ (+៨៥៥) ៩៦ ៦៦០ ៥៣៣៤",
      dash_flip_card: "បង្វិលប័ណ្ណ",
      dash_side_front: "ខាងមុខ",
      dash_side_back: "ខាងក្រោយ",
    }
  };

  function getDirectText(el) {
    var text = '';
    for (var i = 0; i < el.childNodes.length; i++) {
      if (el.childNodes[i].nodeType === Node.TEXT_NODE) {
        text += el.childNodes[i].textContent;
      }
    }
    return text.trim();
  }

  function applyLang(lang) {
    document.documentElement.lang = lang === 'km' ? 'km' : 'en';
    const dict = i18n[lang];
    if (!dict) return;

    /* Swap text (exclude nav-drop-trigger — handled separately to preserve SVG icons) */
    document.querySelectorAll('[data-i18n]:not(.nav-drop-trigger)').forEach(function(el) {
      var key = el.getAttribute('data-i18n');
      if (dict[key] !== undefined) {
        /* Store the original PHP-rendered text on first call */
        if (!el.hasAttribute('data-orig-text')) {
          el.setAttribute('data-orig-text', getDirectText(el));
        }
        var origText = el.getAttribute('data-orig-text');
        var hasCustom = window.chaCustomizerKM && window.chaCustomizerKM.hasOwnProperty(key);
        if (lang === 'en') {
          /* EN: always restore original PHP text */
          if (getDirectText(el) !== origText) {
            for (var i = el.childNodes.length - 1; i >= 0; i--) {
              var node = el.childNodes[i];
              if (node.nodeType === Node.TEXT_NODE) el.removeChild(node);
            }
            el.insertAdjacentText('afterbegin', origText);
          }
        } else {
          /* KM: try Customizer KM value, fall back to dict */
          var kmText = hasCustom ? window.chaCustomizerKM[key] : undefined;
          if (kmText === undefined || kmText === '' || kmText === false) kmText = dict[key];
          if (getDirectText(el) !== kmText) {
            for (var i = el.childNodes.length - 1; i >= 0; i--) {
              var node = el.childNodes[i];
              if (node.nodeType === Node.TEXT_NODE) el.removeChild(node);
            }
            el.insertAdjacentText('afterbegin', kmText);
          }
        }
      }
    });

    /* Swap placeholders */
    document.querySelectorAll('[data-i18n-placeholder]').forEach(function(el) {
      var key = el.getAttribute('data-i18n-placeholder');
      if (dict[key] !== undefined) {
        el.placeholder = dict[key];
      }
    });

    /* Swap aria-labels */
    document.querySelectorAll('[data-i18n-aria]').forEach(function(el) {
      var key = el.getAttribute('data-i18n-aria');
      if (dict[key] !== undefined) {
        el.setAttribute('aria-label', dict[key]);
      }
    });

    /* Update lang label across all switchers (desktop + mobile drawer) */
    document.querySelectorAll('.lang-label').forEach(function(lbl) {
      lbl.textContent = dict.lang_label;
    });

    /* Swap dropdown trigger text (button inner text before SVG) */
    document.querySelectorAll('.nav-drop-trigger').forEach(function(btn) {
      var key = btn.getAttribute('data-i18n');
      if (key && dict[key] !== undefined) {
        /* Store the original PHP-rendered text on first call */
        if (!btn.hasAttribute('data-orig-text')) {
          btn.setAttribute('data-orig-text', getDirectText(btn));
        }
        var origText = btn.getAttribute('data-orig-text');
        if (lang === 'en') {
          /* EN: always restore original PHP text */
          if (getDirectText(btn) !== origText) {
            for (var i = btn.childNodes.length - 1; i >= 0; i--) {
              var node = btn.childNodes[i];
              if (node.nodeType === Node.TEXT_NODE) btn.removeChild(node);
            }
            btn.insertAdjacentText('afterbegin', origText);
          }
        } else {
          /* KM: try Customizer KM value, fall back to dict */
          var hasCustom = window.chaCustomizerKM && window.chaCustomizerKM.hasOwnProperty(key);
          var kmText = hasCustom ? window.chaCustomizerKM[key] : undefined;
          if (kmText === undefined || kmText === '' || kmText === false) kmText = dict[key];
          if (getDirectText(btn) !== kmText) {
            for (var i = btn.childNodes.length - 1; i >= 0; i--) {
              var node = btn.childNodes[i];
              if (node.nodeType === Node.TEXT_NODE) btn.removeChild(node);
            }
            btn.insertAdjacentText('afterbegin', kmText);
          }
        }
      }
    });

    /* Update member modal title if present */
    updateMemberModalTitle();

    /* Auto-translate post content (news + campaign titles/descriptions) */
    autoTranslateContent(lang);
  }

  /* ---- Auto-translate: manual KM override + Google Translate fallback ---- */
  function autoTranslateContent(lang) {
    /* 1. Handle .auto-text elements (titles, descriptions on cards) */
    document.querySelectorAll('.auto-text[data-en]').forEach(function(el) {
      var enText = el.getAttribute('data-en') || '';
      var kmManual = el.getAttribute('data-km') || '';

      if (lang === 'en') {
        el.textContent = enText;
        return;
      }

      if (kmManual) {
        el.textContent = kmManual;
        return;
      }

      var cacheKey = 'auto_km_' + hashCode(enText);
      var cached = localStorage.getItem(cacheKey);
      if (cached) {
        el.textContent = cached;
        return;
      }

      el.textContent = enText;
      fetchGoogleTranslation(enText, 'en', 'km').then(function(kmText) {
        if (kmText) {
          el.textContent = kmText;
          try { localStorage.setItem(cacheKey, kmText); } catch(e) {}
        }
      });
    });

    /* 2. Handle .auto-content elements (full article body — translate text nodes) */
    document.querySelectorAll('[data-auto-content]').forEach(function(container) {
      if (lang === 'en') {
        /* Restore from backup */
        if (container.hasAttribute('data-en-backup')) {
          container.innerHTML = container.getAttribute('data-en-backup');
        }
        return;
      }

      /* Backup original HTML on first KM switch */
      if (!container.hasAttribute('data-en-backup')) {
        container.setAttribute('data-en-backup', container.innerHTML);
      }

      /* Collect all text nodes */
      var textNodes = [];
      var walker = document.createTreeWalker(container, NodeFilter.SHOW_TEXT, null, false);
      var node;
      while (node = walker.nextNode()) {
        var txt = node.textContent.trim();
        if (txt.length > 1) textNodes.push({ node: node, text: txt });
      }
      if (!textNodes.length) return;

      /* Batch translate: join with separator, translate once, split back */
      var batchKey = 'auto_km_batch_' + hashCode(textNodes.map(function(n){return n.text;}).join('|||'));
      var cachedBatch = localStorage.getItem(batchKey);
      if (cachedBatch) {
        applyBatchTranslation(textNodes, cachedBatch);
        return;
      }

      var batchText = textNodes.map(function(n){return n.text;}).join('\n===SPLIT===\n');
      fetchGoogleTranslation(batchText, 'en', 'km').then(function(kmResult) {
        if (kmResult) {
          try { localStorage.setItem(batchKey, kmResult); } catch(e) {}
          applyBatchTranslation(textNodes, kmResult);
        }
      });
    });
  }

  function applyBatchTranslation(textNodes, kmResult) {
    var parts = kmResult.split('\n===SPLIT===\n');
    for (var i = 0; i < textNodes.length && i < parts.length; i++) {
      textNodes[i].node.textContent = parts[i];
    }
  }

  function fetchGoogleTranslation(text, from, to) {
    var url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=' + from + '&tl=' + to + '&dt=t&q=' + encodeURIComponent(text);
    return fetch(url).then(function(r) { return r.json(); }).then(function(data) {
      if (data && data[0]) {
        return data[0].map(function(s) { return s[0]; }).join('');
      }
      return null;
    }).catch(function() { return null; });
  }

  function hashCode(str) {
    var hash = 0;
    for (var i = 0; i < str.length; i++) {
      var ch = str.charCodeAt(i);
      hash = ((hash << 5) - hash) + ch;
      hash |= 0;
    }
    return hash.toString(36);
  }

  function updateMemberModalTitle(explicitKey) {
    var titleEl = document.getElementById('member-modal-title');
    if (!titleEl) return;
    var key = explicitKey || titleEl.getAttribute('data-i18n') || 'member_login_title';
    titleEl.setAttribute('data-i18n', key);
    var curLang = localStorage.getItem('cha-lang') || 'en';
    var curDict = i18n[curLang] || {};
    if (curLang === 'km') {
      var hasCustom = window.chaCustomizerKM && window.chaCustomizerKM[key];
      titleEl.textContent = hasCustom || curDict[key] || (key === 'member_register_modal_title' ? 'ចុះឈ្មោះ' : (key === 'member_forgot_title' ? 'កំណត់ពាក្យសម្ងាត់ឡើងវិញ' : 'ការចូលសមាជិក'));
    } else {
      titleEl.textContent = curDict[key] || (key === 'member_register_modal_title' ? 'Register' : (key === 'member_forgot_title' ? 'Reset Password' : 'Member Login'));
    }
  }
  window.chaUpdateMemberModalTitle = updateMemberModalTitle;

  function toggleLang() {
    var current = localStorage.getItem('cha-lang') || 'en';
    var next = current === 'en' ? 'km' : 'en';
    localStorage.setItem('cha-lang', next);
    applyLang(next);
  }

  /* Init */
  var savedLang = localStorage.getItem('cha-lang') || 'en';
  applyLang(savedLang);

  /* Bind toggle buttons */
  document.querySelectorAll('[data-lang-toggle]').forEach(function(btn) {
    btn.addEventListener('click', toggleLang);
  });
})();

/* Password visibility toggle for login modal */
function togglePass(e) {
  e = e || window.event;
  var wrapper = (e.currentTarget || e.srcElement).closest('.password-wrapper');
  var input = wrapper.querySelector('.form-input');
  if (!input) return;
  var eyeOpen = wrapper.querySelector('.eye-open');
  var eyeClosed = wrapper.querySelector('.eye-closed');
  if (input.type === 'password') {
    input.type = 'text';
    eyeOpen.style.display = 'none';
    eyeClosed.style.display = 'block';
  } else {
    input.type = 'password';
    eyeOpen.style.display = 'block';
    eyeClosed.style.display = 'none';
  }
}

/* History Milestone Showcase Tabs & Timeline (Concept A) */
(function initHistoryMilestones() {
  function setupMilestones() {
    var showcase = document.querySelector('.history-showcase');
    if (!showcase) return;

    var tabBtns = showcase.querySelectorAll('.milestone-tab-btn');
    var panels = showcase.querySelectorAll('.milestone-story-panel');
    var progressFill = document.getElementById('milestoneProgressFill');
    var jumpBtns = showcase.querySelectorAll('[data-jump-milestone]');

    if (!tabBtns.length || !panels.length) return;

    function activateIndex(index) {
      if (index < 0 || index >= tabBtns.length) return;

      // Update tabs
      tabBtns.forEach(function(btn, i) {
        var isTarget = (i === index);
        btn.classList.toggle('is-active', isTarget);
        btn.setAttribute('aria-selected', isTarget ? 'true' : 'false');
      });

      // Update panels
      panels.forEach(function(panel, i) {
        var isTarget = (i === index);
        panel.classList.toggle('is-active', isTarget);
      });

      // Update progress line fill percentage
      if (progressFill && tabBtns.length > 1) {
        var pct = (index / (tabBtns.length - 1)) * 100;
        progressFill.style.width = pct + '%';
      }
    }

    // Bind tab clicks
    tabBtns.forEach(function(btn, i) {
      btn.addEventListener('click', function() {
        activateIndex(i);
      });
    });

    // Bind jump buttons inside story panels
    jumpBtns.forEach(function(jBtn) {
      jBtn.addEventListener('click', function() {
        var targetIdx = parseInt(jBtn.getAttribute('data-jump-milestone'), 10);
        if (!isNaN(targetIdx)) {
          activateIndex(targetIdx);
          // Smooth scroll to timeline top if scrolled past
          var topOffset = showcase.getBoundingClientRect().top + window.pageYOffset - 110;
          if (window.pageYOffset > topOffset) {
            window.scrollTo({ top: topOffset, behavior: 'smooth' });
          }
        }
      });
    });

    // Initial state
    activateIndex(0);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupMilestones);
  } else {
    setupMilestones();
  }
})();

/* Leadership Specialized Working Groups Roster Toggle */
(function initGroupRosters() {
  function setupRosters() {
    var toggleBtns = document.querySelectorAll('.btn-roster-toggle, .btn-roster-pill-toggle');
    var closeBtns = document.querySelectorAll('.btn-roster-close');

    function closeAllDrawers() {
      document.querySelectorAll('.hub-roster-content.is-open').forEach(function(content) {
        content.classList.remove('is-open');
      });
      document.querySelectorAll('.btn-roster-pill-toggle.is-open, .btn-roster-toggle.is-open').forEach(function(btn) {
        btn.classList.remove('is-open');
      });
      document.querySelectorAll('.hub-action-footer.is-roster-open').forEach(function(footer) {
        footer.classList.remove('is-roster-open');
      });
    }

    toggleBtns.forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var targetId = btn.getAttribute('data-roster-target');
        var content = document.getElementById(targetId);
        if (!content) return;

        var footer = btn.closest('.hub-action-footer');
        var isOpen = content.classList.contains('is-open');

        // Close any other open drawer first
        closeAllDrawers();

        if (!isOpen) {
          content.classList.add('is-open');
          btn.classList.add('is-open');
          if (footer) {
            // Re-trigger animation cleanly
            footer.classList.remove('is-roster-open');
            void footer.offsetWidth; // force reflow
            footer.classList.add('is-roster-open');
          }
        }
      });
    });

    closeBtns.forEach(function(cBtn) {
      cBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        closeAllDrawers();
      });
    });

    // Close on click outside
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.hub-roster-content') && !e.target.closest('.btn-roster-pill-toggle')) {
        closeAllDrawers();
      }
    });

    // Close on ESC key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeAllDrawers();
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupRosters);
  } else {
    setupRosters();
  }
})();

/* WFH & HFA Flagship Partner Switcher */
(function initWfhPartnerSwitcher() {
  function setupWfhSwitcher() {
    var switchBtns = document.querySelectorAll('.partner-switch-btn');
    var panels = document.querySelectorAll('.wfh-showcase-panel');
    var triggerButtons = document.querySelectorAll('[data-partner-switch]');

    if (!switchBtns.length || !panels.length) return;

    function activatePartner(targetId) {
      // Update switch tabs
      switchBtns.forEach(function(btn) {
        var isTarget = (btn.getAttribute('data-partner-target') === targetId);
        btn.classList.toggle('is-active', isTarget);
        btn.setAttribute('aria-selected', isTarget ? 'true' : 'false');
      });

      // Update panels
      panels.forEach(function(panel) {
        var isTarget = (panel.id === targetId);
        panel.classList.toggle('is-active', isTarget);
      });
    }

    switchBtns.forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        var targetId = btn.getAttribute('data-partner-target');
        if (targetId) activatePartner(targetId);
      });
    });

    // Handle secondary switch buttons inside panels
    triggerButtons.forEach(function(tBtn) {
      tBtn.addEventListener('click', function(e) {
        e.preventDefault();
        var targetId = tBtn.getAttribute('data-partner-switch');
        if (targetId) {
          activatePartner(targetId);
          var showcase = document.getElementById('about-wfh');
          if (showcase) {
            var topOffset = showcase.getBoundingClientRect().top + window.pageYOffset - 90;
            if (window.pageYOffset > topOffset) {
              window.scrollTo({ top: topOffset, behavior: 'smooth' });
            }
          }
        }
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupWfhSwitcher);
  } else {
    setupWfhSwitcher();
  }
})();

/* Homepage Stat Counter Animation (0 -> Target) */
(function initStatCounterAnimation() {
  function startCounters() {
    var statElements = document.querySelectorAll('[data-counter-target]');
    if (!statElements.length) return;

    var animated = false;

    function runCountUp() {
      statElements.forEach(function(el) {
        var target = parseInt(el.getAttribute('data-counter-target'), 10);
        var suffix = el.getAttribute('data-counter-suffix') || '';
        if (isNaN(target)) return;

        var start = 0;
        var duration = 1800; // 1.8 seconds
        var startTime = null;

        // Custom easing function: easeOutQuart
        function easeOutQuart(x) {
          return 1 - Math.pow(1 - x, 4);
        }

        function step(timestamp) {
          if (!startTime) startTime = timestamp;
          var progress = Math.min((timestamp - startTime) / duration, 1);
          var easedProgress = easeOutQuart(progress);
          var current = Math.floor(easedProgress * target);

          el.textContent = current + suffix;

          if (progress < 1) {
            window.requestAnimationFrame(step);
          } else {
            el.textContent = target + suffix;
          }
        }

        window.requestAnimationFrame(step);
      });
    }

    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function(entries, obs) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting && !animated) {
            animated = true;
            runCountUp();
            obs.disconnect();
          }
        });
      }, { threshold: 0.3 });

      var triggerTarget = document.querySelector('.stat-strip') || statElements[0];
      if (triggerTarget) {
        observer.observe(triggerTarget);
      }
    } else {
      runCountUp();
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', startCounters);
  } else {
    startCounters();
  }
})();


