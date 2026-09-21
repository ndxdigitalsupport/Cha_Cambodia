<?php
/*
Template Name: CHA Privacy Page
*/
get_header(); ?>

<section class="page-hero page-hero-legal" id="privacy"><div class="container">
  <div data-reveal>
    <span class="eyebrow">Privacy Policy</span>
    <h1><?php echo esc_html(cha_get_option('legal_privacy_title', 'Privacy Policy')); ?></h1>
    <p class="lead"><?php echo esc_html(cha_get_option('legal_privacy_lead', 'How the Cambodian Haemophilia Association (CHA) collects, uses, and protects your personal and health information on our website and mobile app.')); ?></p>
    <p class="text-muted" style="font-size:0.875rem"><?php echo esc_html(cha_get_option('legal_last_updated', 'Last updated: August 2026')); ?></p>
  </div>
</div></section>

<main class="content">
  <div class="container legal-body">

    <div class="legal-lang-note" data-reveal>
      <strong>English / ភាសាខ្មែរ</strong>
      <p>The English version of this policy takes precedence in case of any discrepancy with the Khmer translation. ក្នុងករណីមានភាពមិនស្របគ្នារវាងអត្ថបទភាសាអង់គ្លេស និងការបកប្រែជាភាសាខ្មែរ អត្ថបទភាសាអង់គ្លេសត្រូវបានយកជាអាទិភាព។</p>
    </div>

    <!-- ================= ENGLISH ================= -->
    <section class="legal-section lang-en" data-reveal>
      <h2>1. Who we are</h2>
      <p>The Cambodian Haemophilia Association (CHA) is a patient-led, non-profit organisation supporting people with bleeding disorders across Cambodia. Our registered office is at #100, Street Russia Blvd, Sangkat Teek Laak 1, Khan Toul Kork, Phnom Penh, Cambodia. Throughout this policy, "we", "us", and "our" refer to CHA. You can contact us at <a href="mailto:<?php echo esc_attr(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?>"><?php echo esc_html(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?></a>.</p>

      <h2>2. Information we collect</h2>
      <p>We collect only the information needed to provide our services. This may include:</p>
      <ul>
        <li><strong>Membership information</strong> — full name, email address, phone number, postal address, province, and role (patient, family member, healthcare professional, or member).</li>
        <li><strong>Health information (with consent)</strong> — date of birth, bleeding-disorder type, blood type, treatment centre, and emergency contact details that you choose to add for your membership card and emergency support.</li>
        <li><strong>Profile photo</strong> — an optional photo you upload for your member card. Photos are stored on CHA servers in a restricted folder.</li>
        <li><strong>Donation information</strong> — name and contact details you provide when donating. Payments are processed securely by PayWay (ABA Bank); CHA does not store full card numbers or CVV.</li>
        <li><strong>Technical data</strong> — basic anonymised analytics to help us improve the site and app (e.g. pages viewed, app version).</li>
        <li><strong>Communications</strong> — when you email us, use the contact form, or join our community channels.</li>
      </ul>

      <h2>3. How we use your information</h2>
      <ul>
        <li>To create and manage your membership account and digital membership card.</li>
        <li>To provide patient support, education, and community programs.</li>
        <li>To process memberships and donations.</li>
        <li>To verify your email address and reset your password when requested.</li>
        <li>To communicate with you about CHA events, news, and updates (you can opt out at any time).</li>
        <li>To improve our website, app, and services.</li>
      </ul>

      <h2>4. Legal bases for processing</h2>
      <p>We process your information where you have given consent, where processing is necessary to provide the membership service you requested, and where we have a legitimate interest in running a non-profit association (always balanced against your rights and privacy).</p>

      <h2>5. Sharing your information</h2>
      <ul>
        <li>We do <strong>not</strong> sell or rent your personal information.</li>
        <li>We may share information with treatment centres and partner organisations only with your explicit consent.</li>
        <li>We use service providers (hosting, email, payment processing) bound by confidentiality and data-protection obligations.</li>
        <li>PayWay (ABA Bank) processes donation payments on our behalf under their own privacy policy.</li>
        <li>We may disclose information to authorities where required by law.</li>
      </ul>

      <h2>6. Data security</h2>
      <p>We use industry-standard measures to protect your information:</p>
      <ul>
        <li>All connections to our site and API are encrypted (HTTPS).</li>
        <li>Account access uses secure tokens; the app never stores your password.</li>
        <li>Passwords are stored as one-way hashes and cannot be read by us.</li>
        <li>Uploaded photos are capped in size and stored in a restricted folder.</li>
      </ul>
      <p>No method of transmission or storage is 100% secure, and we cannot guarantee absolute security.</p>

      <h2>7. Retention</h2>
      <p>We keep your membership data for as long as your account is active, and afterwards only as long as required for legal, accounting, or safeguarding purposes. Donation records are retained to meet financial obligations.</p>

      <h2>8. Your rights</h2>
      <ul>
        <li><strong>Access</strong> — request a copy of the data we hold about you.</li>
        <li><strong>Correction</strong> — update your details in the app or ask us to correct them.</li>
        <li><strong>Deletion</strong> — you can permanently delete your account and data using <strong>Delete Account</strong> in the app, or by contacting us.</li>
        <li><strong>Withdraw consent</strong> — for health data and marketing communications, at any time.</li>
        <li><strong>Portability</strong> — request your data in a structured format.</li>
      </ul>
      <p>To exercise these rights, contact <a href="mailto:<?php echo esc_attr(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?>"><?php echo esc_html(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?></a>. We will respond within a reasonable time.</p>

      <h2>9. Children</h2>
      <p>Our services support people of all ages, including children. We take extra care with information about minors and require consent from a parent or legal guardian before membership is approved for a child.</p>

      <h2>10. Cookies and analytics</h2>
      <p>Our website may use essential cookies for site functionality and minimal, anonymised analytics to understand how visitors use the site. You can control cookies through your browser settings.</p>

      <h2>11. Cross-border transfers</h2>
      <p>Our hosting and service providers may store data on servers located outside Cambodia. We rely on standard contractual protections and take steps to ensure your data is protected wherever it is processed.</p>

      <h2>12. Changes to this policy</h2>
      <p>We may update this policy from time to time. Any changes will be posted on this page with an updated revision date. For material changes we may also notify registered members by email.</p>

      <h2>13. Contact us</h2>
      <p>If you have any questions about this Privacy Policy or our handling of your data, please contact us:</p>
      <ul>
        <li>Email: <a href="mailto:<?php echo esc_attr(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?>"><?php echo esc_html(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?></a></li>
        <li>Phone: <?php echo esc_html(cha_get_option('contact_phone', '+855 96 260 5335')); ?></li>
        <li>Address: <?php echo esc_html(cha_get_option('contact_address', '#100, Street Russia Blvd, Sangkat Teek Laak 1, Khan Toul Kork, Phnom Penh, Cambodia')); ?></li>
      </ul>
    </section>

    <!-- ================= KHMER ================= -->
    <section class="legal-section lang-km" data-reveal>
      <h2>គោលនយោបាយឯកជនភាព</h2>

      <h2>១. អំពីពួកយើង</h2>
      <p>សមាគមគាំទ្រជំងឺហេម៉ូហ្វីលាកម្ពុជា (CHA) គឺជាអង្គការមិនរកប្រាក់ចំណេញដឹកនាំដោយអ្នកជំងឺ ដែលគាំទ្រអ្នកមានជំងឺដំណក់ឈាមនៅទូទាំងប្រទេសកម្ពុជា។ ការិយាល័យចុះបញ្ជីរបស់យើងស្ថិតនៅ #១០០ មហាវិថីសហព័ន្ធរុស្ស៊ី សង្កាត់ទឹកល្អក់១ ខណ្ឌទួលគោក រាជធានីភ្នំពេញ កម្ពុជា។ យើងអាចទាក់ទងបានតាម <a href="mailto:<?php echo esc_attr(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?>"><?php echo esc_html(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?></a>។</p>

      <h2>២. ព័ត៌មានដែលយើងប្រមូល</h2>
      <p>យើងប្រមូលតែព័ត៌មានចាំបាច់សម្រាប់ការផ្តល់សេវា រួមមាន៖</p>
      <ul>
        <li><strong>ព័ត៌មានសមាជិកភាព</strong> — ឈ្មោះពេញ អ៊ីមែល លេខទូរស័ព្ទ អាសយដ្ឋាន ខេត្ត និងតួនាទី (អ្នកជំងឺ សមាជិកគ្រួសារ អ្នកជំនាញសុខភាព ឬអ្នកគាំទ្រ)។</li>
        <li><strong>ព័ត៌មានសុខភាព (ដោយមានការយល់ព្រម)</strong> — ថ្ងៃខែឆ្នាំកំណើត ប្រភេទជំងឺដំណក់ឈាម ប្រភេទឈាម កន្លែងព្យាបាល និងព័ត៌មានទំនាក់ទំនងបន្ទាន់ ដែលអ្នកជ្រើសរើសបន្ថែមសម្រាប់កាតសមាជិក និងការគាំទ្របន្ទាន់។</li>
        <li><strong>រូបថតប្រវត្តិរូប</strong> — រូបថតស្រេចចិត្តដែលអ្នកផ្ទុកឡើងសម្រាប់កាតសមាជិក ត្រូវបានរក្សាទុកនៅក្នុងថតដែលមានការការពារ។</li>
        <li><strong>ព័ត៌មានបរិច្ចាគ</strong> — ឈ្មោះ និងព័ត៌មានទំនាក់ទំនង នៅពេលអ្នកបរិច្ចាគ។ ការទូទាត់ត្រូវបានដំណើរការដោយសុវត្ថិភាពតាមរយៈ PayWay (ធនាគារ ABA)។ CHA មិនរក្សាទុកលេខកាត ឬ CVV ទេ។</li>
      </ul>

      <h2>៣. ការប្រើប្រាស់ព័ត៌មាន</h2>
      <ul>
        <li>បង្កើត និងគ្រប់គ្រងគណនីសមាជិក និងកាតសមាជិកឌីជីថល។</li>
        <li>ផ្តល់ការគាំទ្រ ការអប់រំ និងកម្មវិធីសហគមន៍។</li>
        <li>ដំណើរការសមាជិកភាព និងបរិច្ចាគ។</li>
        <li>ផ្ទៀងផ្ទាត់អ៊ីមែល និងកំណត់ពាក្យសម្ងាត់ឡើងវិញតាមការស្នើសុំ។</li>
        <li>ទំនាក់ទំនងអំពីព្រឹត្តិការណ៍ ព័ត៌មាន និងការអាប់ដេត (អ្នកអាចឈប់ទទួលបានគ្រប់ពេល)។</li>
      </ul>

      <h2>៤. ការចែករំលែកព័ត៌មាន</h2>
      <ul>
        <li>យើងមិនលក់ ឬជួលព័ត៌មានផ្ទាល់ខ្លួនទេ។</li>
        <li>យើងអាចចែករំលែកព័ត៌មានទៅមណ្ឌលព្យាបាល និងអង្គការដៃគូ បានតែដោយការយល់ព្រមជាក់លាក់របស់អ្នក។</li>
        <li>យើងប្រើអ្នកផ្តល់សេវា (ម៉ាស៊ីនមេ អ៊ីមែល ដំណើរការទូទាត់) ដែលត្រូវគោរពកាតព្វកិច្ចភាពជឿជាក់ និងការពារទិន្នន័យ។</li>
        <li>PayWay (ធនាគារ ABA) ដំណើរការការទូទាត់បរិច្ចាគ ដោយអនុវត្តតាមគោលនយោបាយឯកជនភាពផ្ទាល់របស់ពួកគេ។</li>
      </ul>

      <h2>៥. សន្តិសុខទិន្នន័យ</h2>
      <ul>
        <li>រាល់ការតភ្ជាប់ទៅគេហទំព័រ និង API ត្រូវបានអ៊ិនគ្រីប (HTTPS)។</li>
        <li>ការចូលប្រើគណនីប្រើសញ្ញាសម្ងាត់សុវត្ថិភាព កម្មវិធីមិនផ្ទុកពាក្យសម្ងាត់របស់អ្នកទេ។</li>
        <li>ពាក្យសម្ងាត់ត្រូវបានអ៊ិនគ្រីបជា one-way hash ហើយយើងមិនអាចអានវាបានឡើយ។</li>
      </ul>

      <h2>៦. ការរក្សាទុក</h2>
      <p>យើងរក្សាទិន្នន័យសមាជិក នៅពេលគណនីសកម្ម និងបន្ទាប់ពីនោះ បានតែតាមការចាំបាច់សម្រាប់កាតព្វកិច្ចផ្លូវច្បាប់ គណនេយ្យ ឬការការពារ។</p>

      <h2>៧. សិទ្ធិរបស់អ្នក</h2>
      <ul>
        <li><strong>ចូលប្រើ</strong> — ស្នើសុំច្បាប់ចម្លងទិន្នន័យរបស់អ្នក។</li>
        <li><strong>កែតម្រូវ</strong> — ធ្វើបច្ចុប្បន្នភាពព័ត៌មាននៅក្នុងកម្មវិធី ឬស្នើសុំកែតម្រូវ។</li>
        <li><strong>លុប</strong> — អ្នកអាចលុបគណនី និងទិន្នន័យរបស់អ្នកជាអចិន្ត្រៃយ៍ ដោយប្រើ <strong>លុបគណនី</strong> ក្នុងកម្មវិធី ឬទាក់ទងមកយើង។</li>
        <li><strong>ដកការយល់ព្រម</strong> — សម្រាប់ទិន្នន័យសុខភាព និងការផ្សាយពាណិជ្ជកម្ម គ្រប់ពេល។</li>
      </ul>

      <h2>៨. កុមារ</h2>
      <p>សេវារបស់យើងគាំទ្រមនុស្សគ្រប់វ័យ រួមទាំងកុមារ។ យើងតម្រូវឱ្យមានការយល់ព្រមពីឪពុកម្តាយ ឬអាណាព្យាបាលស្របច្បាប់ មុនពេលអនុញ្ញាតសមាជិកភាពសម្រាប់កុមារ។</p>

      <h2>៩. ទាក់ទងមកយើង</h2>
      <ul>
        <li>អ៊ីមែល: <a href="mailto:<?php echo esc_attr(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?>"><?php echo esc_html(cha_get_option('contact_email', 'choryee.hun@gmail.com')); ?></a></li>
        <li>ទូរស័ព្ទ: <?php echo esc_html(cha_get_option('contact_phone', '+855 96 260 5335')); ?></li>
        <li>អាសយដ្ឋាន: <?php echo esc_html(cha_get_option('contact_address', '#១០០ មហាវិថីសហព័ន្ធរុស្ស៊ី សង្កាត់ទឹកល្អក់១ ខណ្ឌទួលគោក រាជធានីភ្នំពេញ កម្ពុជា')); ?></li>
      </ul>
    </section>
  </div>
</main>

<?php get_footer(); ?>