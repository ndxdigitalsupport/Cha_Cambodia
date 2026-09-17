<?php
/*
Template Name: CHA Terms Page
*/
get_header(); ?>

<section class="page-hero page-hero-legal" id="terms"><div class="container">
  <div data-reveal>
    <span class="eyebrow">Terms of Service</span>
    <h1><?php echo esc_html(cha_get_option('legal_terms_title', 'Terms of Service')); ?></h1>
    <p class="lead"><?php echo esc_html(cha_get_option('legal_terms_lead', 'The terms that govern your use of the CHA website, mobile app, and membership services.')); ?></p>
    <p class="text-muted" style="font-size:0.875rem"><?php echo esc_html(cha_get_option('legal_last_updated', 'Last updated: August 2026')); ?></p>
  </div>
</div></section>

<main class="content">
  <div class="container legal-body">

    <div class="legal-lang-note" data-reveal>
      <strong>English / ភាសាខ្មែរ</strong>
      <p>The English version of these terms takes precedence in case of any discrepancy with the Khmer translation. ក្នុងករណីមានភាពមិនស្របគ្នារវាងអត្ថបទភាសាអង់គ្លេស និងការបកប្រែជាភាសាខ្មែរ អត្ថបទភាសាអង់គ្លេសត្រូវបានយកជាអាទិភាព។</p>
    </div>

    <!-- ================= ENGLISH ================= -->
    <section class="legal-section" data-reveal>
      <h2>1. Acceptance of terms</h2>
      <p>By creating an account, downloading the CHA mobile app, using our website, or making a donation, you agree to be bound by these Terms of Service. If you do not agree, please do not use our services.</p>

      <h2>2. About the service</h2>
      <p>The Cambodian Haemophilia Association (CHA) is a patient-led, non-profit organisation. Our website and mobile app provide information, membership services, a digital membership card for registered patients, and secure online donations.</p>

      <h2>3. Account registration</h2>
      <ul>
        <li>You must provide accurate, complete, and current information when registering.</li>
        <li>You are responsible for keeping your login credentials confidential.</li>
        <li>You must be at least 18 years old, or have the consent of a parent or legal guardian if younger.</li>
        <li>CHA may require email verification before your account can be used.</li>
        <li>You must not create an account using false information or for impersonation purposes.</li>
      </ul>

      <h2>4. Membership and the digital card</h2>
      <ul>
        <li>Membership is free and open to patients, family members, healthcare professionals, and members.</li>
        <li>The digital membership card displays the information you provide (name, member ID, date of birth, bleeding-disorder type, blood type, and treatment centre for patients).</li>
        <li>You are responsible for keeping the information on your card accurate and up to date.</li>
        <li>The card is the property of CHA and may be withdrawn if it is used improperly or your membership is ended.</li>
      </ul>

      <h2>5. Donations and Refund Policy</h2>
      <ul>
        <li>Donations are voluntary and processed securely by PayWay (Advanced Bank of Asia Limited - ABA Bank).</li>
        <li>Payments are subject to the terms and privacy conditions of PayWay. All card and KHQR transactions are encrypted and processed through ABA Bank's secure hosted payment gateway.</li>
        <li><strong>Refund & Cancellation Policy:</strong> In accordance with PayWay Merchant Guidelines, if you believe a donation was processed in error or wish to cancel an unauthorized transaction, you may request a full refund within thirty (30) calendar days of the original transaction date by contacting CHA at <a href="mailto:cha.rithy2016@gmail.com">cha.rithy2016@gmail.com</a> or +855 12 311 033. Approved refunds will be reimbursed to the original payment method (Card, ABA account, or e-Wallet) through the PayWay Merchant Portal within 30 days. Refunds will not be provided in cash.</li>
        <li><strong>Customer Support Notice:</strong> Please contact CHA Cambodia directly for all questions, transaction inquiries, or refund requests related to donations made through this website or app. Do not contact ABA Bank directly for website support or donation-related inquiries.</li>
      </ul>

      <h2>6. Acceptable use</h2>
      <p>You agree not to misuse our services, including (but not limited to): attempting to access another user's account, interfering with the operation of the website or app, uploading malicious software, or using the services for unlawful purposes.</p>

      <h2>7. Health and emergency information</h2>
      <p>Information stored on your membership card is provided for support and convenience. CHA does not provide medical advice and is not responsible for how health information on your card is used. Always seek professional medical advice for medical matters (see our Disclaimer).</p>

      <h2>8. Intellectual property</h2>
      <p>All content on the website and in the app, including text, graphics, logos, and software, is owned by or licensed to CHA and protected by applicable laws. You may not reproduce or redistribute it without permission, except for your own personal, non-commercial use.</p>

      <h2>9. Termination</h2>
      <p>You may delete your account and data at any time using <strong>Delete Account</strong> in the app or by contacting us. CHA may suspend or terminate accounts that violate these terms, are used fraudulently, or that we reasonably believe are unsafe to continue.</p>

      <h2>10. Limitation of liability</h2>
      <p>To the fullest extent permitted by law, CHA and its representatives are not liable for any loss or damage arising out of or in connection with your use of our services.</p>

      <h2>11. Changes to these terms</h2>
      <p>We may update these terms from time to time. The latest version will always be listed on this page with an updated revision date. Continued use of the service after changes means you accept the updated terms.</p>

      <h2>12. Contact us</h2>
      <p>If you have any questions about these Terms of Service, please contact us:</p>
      <ul>
        <li>Email: <a href="mailto:<?php echo esc_attr(cha_get_option('contact_email', 'cha.rithy2016@gmail.com')); ?>"><?php echo esc_html(cha_get_option('contact_email', 'cha.rithy2016@gmail.com')); ?></a></li>
        <li>Phone: <?php echo esc_html(cha_get_option('contact_phone', '+855 12 311 033')); ?></li>
        <li>Address: <?php echo esc_html(cha_get_option('contact_address', '#100, Street Russia Blvd, Sangkat Teek Laak 1, Khan Toul Kork, Phnom Penh, Cambodia')); ?></li>
      </ul>
    </section>

    <!-- ================= KHMER ================= -->
    <section class="legal-section lang-km" data-reveal>
      <h2>លក្ខខណ្ឌនៃការប្រើប្រាស់</h2>

      <h2>១. ការទទួលយកលក្ខខណ្ឌ</h2>
      <p>ដោយការបង្កើតគណនី ទាញយកកម្មវិធី CHA ប្រើប្រាស់គេហទំព័រ ឬបរិច្ចាគ អ្នកយល់ព្រមគោរពតាមលក្ខខណ្ឌទាំងនេះ។ ប្រសិនបើអ្នកមិនយល់ព្រម សូមកុំប្រើប្រាស់សេវារបស់យើង។</p>

      <h2>២. អំពីសេវាកម្ម</h2>
      <p>សមាគមគាំទ្រជំងឺហេម៉ូហ្វីលាកម្ពុជា (CHA) គឺជាអង្គការមិនរកប្រាក់ចំណេញដឹកនាំដោយអ្នកជំងឺ។ គេហទំព័រ និងកម្មវិធីរបស់យើងផ្តល់ព័ត៌មាន សេវាសមាជិកភាព កាតសមាជិកឌីជីថលសម្រាប់អ្នកជំងឺដែលបានចុះឈ្មោះ និងការបរិច្ចាគតាមអ៊ីនធឺណិតប្រកបដោយសុវត្ថិភាព។</p>

      <h2>៣. ការចុះឈ្មោះគណនី</h2>
      <ul>
        <li>អ្នកត្រូវផ្តល់ព័ត៌មានត្រឹមត្រូវ ពេញលេញ និងទាន់សម័យ នៅពេលចុះឈ្មោះ។</li>
        <li>អ្នកទទួលខុសត្រូវក្នុងការរក្សាពាក្យសម្ងាត់របស់អ្នកឱ្យទុកជាសម្ងាត់។</li>
        <li>អ្នកត្រូវមានអាយុ ១៨ ឆ្នាំឡើង ឬមានការយល់ព្រមពីឪពុកម្តាយ ឬអាណាព្យាបាល ប្រសិនបើក្មេងជាង។</li>
        <li>CHA អាចតម្រូវឱ្យមានការផ្ទៀងផ្ទាត់អ៊ីមែល មុនពេលអាចប្រើប្រាស់គណនីបាន។</li>
      </ul>

      <h2>៤. សមាជិកភាព និងកាតឌីជីថល</h2>
      <ul>
        <li>សមាជិកភាពគឺមិនគិតថ្លៃ និងបើកចំហសម្រាប់អ្នកជំងឺ សមាជិកគ្រួសារ អ្នកជំនាញសុខភាព និងអ្នកគាំទ្រ។</li>
        <li>កាតសមាជិកឌីជីថលបង្ហាញព័ត៌មានដែលអ្នកផ្តល់ (ឈ្មោះ លេខសមាជិក ថ្ងៃខែឆ្នាំកំណើត ប្រភេទជំងឺដំណក់ឈាម ប្រភេទឈាម និងកន្លែងព្យាបាលសម្រាប់អ្នកជំងឺ)។</li>
        <li>អ្នកទទួលខុសត្រូវក្នុងការរក្សាព័ត៌មាននៅលើកាតរបស់អ្នកឱ្យត្រឹមត្រូវ និងទាន់សម័យ។</li>
      </ul>

      <h2>៥. ការបរិច្ចាគ និងគោលការណ៍បង្វិលសងប្រាក់</h2>
      <ul>
        <li>ការបរិច្ចាគគឺស្ម័គ្រចិត្ត និងត្រូវបានដំណើរការដោយសុវត្ថិភាពតាមរយៈ PayWay (ធនាគារ វឌ្ឍនៈ អាស៊ី ចំកាត់ - ធនាគារ ABA)។</li>
        <li>ការទូទាត់ស្ថិតនៅក្រោមលក្ខខណ្ឌសុវត្ថិភាពរបស់ PayWay។ រាល់ប្រតិបត្តិការកាត និង KHQR ត្រូវបានអ៊ិនគ្រីប និងដំណើរការតាមច្រកទូទាត់សុវត្ថិភាពរបស់ធនាគារ ABA។</li>
        <li><strong>គោលការណ៍បង្វិលសងប្រាក់ និងការលុបចោល៖</strong> អនុលោមតាមគោលការណ៍អាជីវករ PayWay ប្រសិនបើអ្នកយល់ថាមានការបរិច្ចាគដោយច្រឡំ ឬមានប្រតិបត្តិការដែលមិនមានការអនុញ្ញាត អ្នកអាចស្នើសុំការបង្វិលសងប្រាក់ពេញលេញក្នុងរយៈពេលសាមសិប (៣០) ថ្ងៃតាមប្រតិទិន គិតចាប់ពីថ្ងៃធ្វើប្រតិបត្តិការ ដោយទាក់ទងមកកាន់ CHA តាមរយៈ <a href="mailto:cha.rithy2016@gmail.com">cha.rithy2016@gmail.com</a> ឬទូរស័ព្ទ +855 12 311 033។ ការបង្វិលសងដែលបានអនុម័ត នឹងត្រូវផ្ញើត្រឡប់ទៅកាន់វិធីសាស្ត្រទូទាត់ដើមរបស់អ្នក (កាត, គណនី ABA ឬ e-Wallet) តាមរយៈ PayWay ក្នុងរយៈពេល ៣០ ថ្ងៃ។ ការបង្វិលសងជាប្រាក់សុទ្ធមិនត្រូវបានអនុញ្ញាតឡើយ។</li>
        <li><strong>សេចក្តីជូនដំណឹងអំពីការគាំទ្រអតិថិជន៖</strong> សូមទាក់ទងមកកាន់សមាគម CHA Cambodia ដោយផ្ទាល់ សម្រាប់រាល់ចម្ងល់ ការសាកសួរប្រតិបត្តិការ ឬសំណើសុំបង្វិលសងប្រាក់ទាក់ទងនឹងការបរិច្ចាគ។ សូមកុំទាក់ទងទៅកាន់ធនាគារ ABA ដោយផ្ទាល់សម្រាប់ការគាំទ្រគេហទំព័រ ឬសំណួរទាក់ទងនឹងការបរិច្ចាគឡើយ។</li>
      </ul>

      <h2>៦. ការប្រើប្រាស់ដែលអាចអនុញ្ញាត</h2>
      <p>អ្នកយល់ព្រមមិនប្រើប្រាស់សេវារបស់យើងខុស រួមទាំងការព្យាយាមចូលប្រើគណនីអ្នកដទៃ រំខានដល់ប្រតិបត្តិការគេហទំព័រ ឬកម្មវិធី ផ្ទុកកម្មវិធីព្យាបាទ ឬប្រើប្រាស់សេវាសម្រាប់គោលបំណងខុសច្បាប់។</p>

      <h2>៧. ព័ត៌មានសុខភាព និងបន្ទាន់</h2>
      <p>ព័ត៌មានដែលរក្សាទុកនៅលើកាតសមាជិករបស់អ្នក ត្រូវបានផ្តល់សម្រាប់ការគាំទ្រ និងភាពងាយស្រួល។ CHA មិនផ្តល់ការប្រឹក្សាវេជ្ជសាស្ត្រទេ។ តែងតែស្វែងរកដំបូន្មានវេជ្ជសាស្ត្រជំនាញសម្រាប់បញ្ហាសុខភាព។</p>

      <h2>៨. សិទ្ធិបញ្ញា</h2>
      <p>រាល់ខ្លឹមសារនៅលើគេហទំព័រ និងក្នុងកម្មវិធី រួមទាំងអត្ថបទ ក្រាហ្វិក និមិត្តសញ្ញា និងកម្មវិធី ជាកម្មសិទ្ធិរបស់ CHA ឬត្រូវបានផ្តល់អាជ្ញាប័ណ្ណឱ្យ CHA និងត្រូវបានការពារដោយច្បាប់អនុវត្ត។</p>

      <h2>៩. ការបញ្ចប់</h2>
      <p>អ្នកអាចលុបគណនី និងទិន្នន័យរបស់អ្នកបានគ្រប់ពេល ដោយប្រើ <strong>លុបគណនី</strong> ក្នុងកម្មវិធី ឬដោយទាក់ទងមកយើង។</p>

      <h2>១០. ទាក់ទងមកយើង</h2>
      <ul>
        <li>អ៊ីមែល: <a href="mailto:<?php echo esc_attr(cha_get_option('contact_email', 'cha.rithy2016@gmail.com')); ?>"><?php echo esc_html(cha_get_option('contact_email', 'cha.rithy2016@gmail.com')); ?></a></li>
        <li>ទូរស័ព្ទ: <?php echo esc_html(cha_get_option('contact_phone', '+855 12 311 033')); ?></li>
        <li>អាសយដ្ឋាន: <?php echo esc_html(cha_get_option('contact_address', '#១០០ មហាវិថីសហព័ន្ធរុស្ស៊ី សង្កាត់ទឹកល្អក់១ ខណ្ឌទួលគោក រាជធានីភ្នំពេញ កម្ពុជា')); ?></li>
      </ul>
    </section>
  </div>
</main>

<?php get_footer(); ?>