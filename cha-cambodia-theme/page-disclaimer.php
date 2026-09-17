<?php
/*
Template Name: CHA Disclaimer Page
*/
get_header(); ?>

<section class="page-hero page-hero-legal" id="disclaimer"><div class="container">
  <div data-reveal>
    <span class="eyebrow">Disclaimer</span>
    <h1><?php echo esc_html(cha_get_option('legal_disclaimer_title', 'Disclaimer')); ?></h1>
    <p class="lead"><?php echo esc_html(cha_get_option('legal_disclaimer_lead', 'Please read this disclaimer carefully before using the CHA website, mobile app, or services.')); ?></p>
    <p class="text-muted" style="font-size:0.875rem"><?php echo esc_html(cha_get_option('legal_last_updated', 'Last updated: August 2026')); ?></p>
  </div>
</div></section>

<main class="content">
  <div class="container legal-body">

    <div class="legal-lang-note" data-reveal>
      <strong>English / ភាសាខ្មែរ</strong>
      <p>The English version of this disclaimer takes precedence in case of any discrepancy with the Khmer translation. ក្នុងករណីមានភាពមិនស្របគ្នារវាងអត្ថបទភាសាអង់គ្លេស និងការបកប្រែជាភាសាខ្មែរ អត្ថបទភាសាអង់គ្លេសត្រូវបានយកជាអាទិភាព។</p>
    </div>

    <!-- ================= ENGLISH ================= -->
    <section class="legal-section" data-reveal>
      <h2>1. Medical information</h2>
      <p>The health and medical information on this website and in the CHA mobile app is provided for general educational and support purposes only. It is <strong>not a substitute for professional medical advice, diagnosis, or treatment</strong>.</p>
      <p>Always seek the advice of a qualified healthcare provider with any questions you may have regarding a medical condition. Never disregard professional medical advice or delay in seeking it because of something you have read on this website or in the app.</p>
      <p>If you think you may have a medical emergency, call your doctor, go to the nearest hospital, or contact your local emergency services immediately.</p>

      <h2>2. Not medical advice</h2>
      <p>CHA does not recommend or endorse any specific tests, physicians, products, procedures, opinions, or other information that may be mentioned on this website or in the app. Reliance on any information provided by CHA, CHA employees, contractors, or visitors is solely at your own risk.</p>

      <h2>3. Emergency and health data in the app</h2>
      <p>The digital membership card and any emergency contact or health details you store in the app are provided for your convenience. While we make every effort to keep them secure and accurate, you are responsible for keeping this information up to date. In an emergency, always rely on professional medical services.</p>

      <h2>4. External links</h2>
      <p>This website may contain links to external sites for your convenience. CHA does not endorse and is not responsible for the content of any third-party websites, nor can we guarantee their accuracy. Visiting external links is at your own risk.</p>

      <h2>5. Information accuracy</h2>
      <p>While CHA strives to keep the information on this website and app accurate and up to date, we make no representations or warranties about the completeness, accuracy, reliability, or suitability of the information. CHA reserves the right to make changes at any time without notice.</p>

      <h2>6. Personal responsibility</h2>
      <p>By using this website or app, you acknowledge that any reliance on the information presented here is at your own risk. You agree to take full responsibility for any decisions or actions you take based on this content.</p>

      <h2>7. Translations</h2>
      <p>Where translations between English and Khmer are provided, every effort has been made to ensure accuracy. However, the English version takes precedence in case of any discrepancy or ambiguity.</p>

      <h2>8. Donations</h2>
      <p>All donations made through this website or app are processed by PayWay (ABA Bank), a third-party payment provider. CHA is not responsible for any issues arising from payment processing, but we will gladly assist you in resolving any donation-related concerns.</p>

      <h2>9. Limitation of liability</h2>
      <p>To the fullest extent permitted by law, CHA and its representatives are not liable for any loss or damage (including indirect, consequential, or incidental loss) arising out of or in connection with your use of this website or app.</p>

      <h2>10. Changes to this disclaimer</h2>
      <p>We may update this disclaimer from time to time. Any changes will be posted on this page with an updated revision date.</p>

      <h2>11. Contact us</h2>
      <p>If you have any questions about this disclaimer, please contact us:</p>
      <ul>
        <li>Email: <a href="mailto:<?php echo esc_attr(cha_get_option('contact_email', 'cha.rithy2016@gmail.com')); ?>"><?php echo esc_html(cha_get_option('contact_email', 'cha.rithy2016@gmail.com')); ?></a></li>
        <li>Phone: <?php echo esc_html(cha_get_option('contact_phone', '+855 12 311 033')); ?></li>
        <li>Address: <?php echo esc_html(cha_get_option('contact_address', '#100, Street Russia Blvd, Sangkat Teek Laak 1, Khan Toul Kork, Phnom Penh, Cambodia')); ?></li>
      </ul>
    </section>

    <!-- ================= KHMER ================= -->
    <section class="legal-section lang-km" data-reveal>
      <h2>ការបដិសេធ</h2>

      <h2>១. ព័ត៌មានវេជ្ជសាស្ត្រ</h2>
      <p>ព័ត៌មានសុខភាព និងវេជ្ជសាស្ត្រនៅលើគេហទំព័រ និងក្នុងកម្មវិធី CHA ត្រូវបានផ្តល់ជូនសម្រាប់គោលបំណងអប់រំ និងគាំទ្រទូទៅប៉ុណ្ណោះ។ វា <strong>មិនមែនជាការជំនួសការប្រឹក្សាយោបល់ ការធ្វើរោគវិនិច្ឆ័យ ឬការព្យាបាលពីអ្នកជំនាញវេជ្ជសាស្ត្រទេ</strong>។</p>
      <p>តែងតែស្វែងរកការណែនាំពីអ្នកផ្តល់សេវាសុខភាពដែលមានសមត្ថភាព សម្រាប់រាល់សំណួរទាក់ទងនឹងស្ថានភាពសុខភាព។ កុំព្រងើយកន្តើយនឹងការណែនាំវេជ្ជសាស្ត្រជំនាញ ឬពន្យាពេលក្នុងការស្វែងរកវា ដោយសារអ្វីដែលអ្នកបានអាននៅទីនេះ។</p>
      <p>ប្រសិនបើអ្នកគិតថាអ្នកអាចមានគ្រោះអាសន្នផ្នែកសុខភាព សូមទូរស័ព្ទទៅគ្រូពេទ្យ ទៅមន្ទីរពេទ្យដែលនៅជិតបំផុត ឬទាក់ទងសេវាសង្គ្រោះបន្ទាន់ក្នុងតំបន់របស់អ្នកភ្លាមៗ។</p>

      <h2>២. មិនមែនជាការប្រឹក្សាវេជ្ជសាស្ត្រ</h2>
      <p>CHA មិនណែនាំ ឬគាំទ្រការធ្វើតេស្ត វេជ្ជបណ្ឌិត ផលិតផល នីតិវិធី យោបល់ ឬព័ត៌មានជាក់លាក់ណាមួយដែលអាចត្រូវបានលើកឡើងនៅលើគេហទំព័រ ឬក្នុងកម្មវិធីនោះទេ។ ការពឹងផ្អែកលើព័ត៌មានណាមួយដែលផ្តល់ដោយ CHA គឺស្ថិតក្រោមហានិភ័យផ្ទាល់របស់អ្នក។</p>

      <h2>៣. ទិន្នន័យសុខភាព និងបន្ទាន់ក្នុងកម្មវិធី</h2>
      <p>កាតសមាជិកឌីជីថល និងព័ត៌មានទំនាក់ទំនងបន្ទាន់ ឬសុខភាពដែលអ្នករក្សាទុកក្នុងកម្មវិធី ត្រូវបានផ្តល់សម្រាប់ភាពងាយស្រួលរបស់អ្នក។ អ្នកមានទំនួលខុសត្រូវក្នុងការរក្សាព័ត៌មាននេះឱ្យទាន់សម័យ។ ក្នុងស្ថានភាពបន្ទាន់ សូមពឹងផ្អែកលើសេវាវេជ្ជសាស្ត្រជំនាញជានិច្ច។</p>

      <h2>៤. តំណភ្ជាប់ខាងក្រៅ</h2>
      <p>គេហទំព័រនេះអាចមានតំណភ្ជាប់ទៅកាន់គេហទំព័រខាងក្រៅសម្រាប់ភាពងាយស្រួលរបស់អ្នក។ CHA មិនគាំទ្រ និងមិនទទួលខុសត្រូវចំពោះខ្លឹមសារនៃគេហទំព័រភាគីទីបីណាមួយឡើយ។</p>

      <h2>៥. ភាពត្រឹមត្រូវនៃព័ត៌មាន</h2>
      <p>ខណៈដែល CHA ខិតខំរក្សាព័ត៌មាននៅលើគេហទំព័រ និងកម្មវិធីឱ្យត្រឹមត្រូវ និងទាន់សម័យ យើងមិនធានាអំពីភាពពេញលេញ ភាពត្រឹមត្រូវ ភាពជឿជាក់ ឬសមស្របនៃព័ត៌មាននោះទេ។</p>

      <h2>៦. ទំនួលខុសត្រូវផ្ទាល់ខ្លួន</h2>
      <p>ដោយការប្រើប្រាស់គេហទំព័រ ឬកម្មវិធីនេះ អ្នកទទួលស្គាល់ថាការពឹងផ្អែកលើព័ត៌មានគឺស្ថិតក្រោមហានិភ័យផ្ទាល់របស់អ្នក។</p>

      <h2>៧. ការបកប្រែ</h2>
      <p>ក្នុងករណីមានភាពខុសគ្នារវាងភាសាអង់គ្លេស និងខ្មែរ អត្ថបទភាសាអង់គ្លេសត្រូវបានយកជាអាទិភាព។</p>

      <h2>៨. បរិច្ចាគ</h2>
      <p>រាល់ការបរិច្ចាគតាមគេហទំព័រ ឬកម្មវិធីនេះ ត្រូវបានដំណើរការដោយ PayWay (ធនាគារ ABA) ដែលជាអ្នកផ្តល់សេវាទូទាត់ភាគីទីបី។</p>

      <h2>៩. ទាក់ទងមកយើង</h2>
      <ul>
        <li>អ៊ីមែល: <a href="mailto:<?php echo esc_attr(cha_get_option('contact_email', 'cha.rithy2016@gmail.com')); ?>"><?php echo esc_html(cha_get_option('contact_email', 'cha.rithy2016@gmail.com')); ?></a></li>
        <li>ទូរស័ព្ទ: <?php echo esc_html(cha_get_option('contact_phone', '+855 12 311 033')); ?></li>
        <li>អាសយដ្ឋាន: <?php echo esc_html(cha_get_option('contact_address', '#១០០ មហាវិថីសហព័ន្ធរុស្ស៊ី សង្កាត់ទឹកល្អក់១ ខណ្ឌទួលគោក រាជធានីភ្នំពេញ កម្ពុជា')); ?></li>
      </ul>
    </section>
  </div>
</main>

<?php get_footer(); ?>