# CHA Cambodia — Website Administrator & Operations Manual

**Organization:** Cambodian Haemophilia Association (CHA Cambodia)  
**Document Title:** Website Administrator & Operations Manual  
**Document Version:** Version 1.0.0 — Official Operations Manual  
**Public Website:** [https://chacambodia.org](https://chacambodia.org)  
**Admin Portal:** [https://chacambodia.org/wp-admin](https://chacambodia.org/wp-admin)  
**Hosting Environment:** Namecheap Stellar Business (LiteSpeed + cPanel)  
**Publication Date:** September 2026  
**Authorized Audience:** Executive Leadership, Operations Team & Content Managers  

---

> [!NOTE]
> **EXECUTIVE SUMMARY & OPERATIONAL SCOPE**  
> This master document serves as the official single source of truth for the ongoing administration and management of **chacambodia.org**. It is designed to be clear, practical, and accessible to non-technical leadership and staff. Follow the step-by-step visual cards and instructions below to maintain content, approve donations, manage member accounts, and safeguard website operations.

---

## 1. Executive Overview & Website Architecture

The Cambodian Haemophilia Association (CHA Cambodia) website (`chacambodia.org`) represents the primary digital gateway connecting patients, families, medical specialists, healthcare donors, and international partner federations. The platform is engineered to deliver high availability, rapid load times, multi-currency donation processing, and seamless bilingual support (English and Khmer).

### 1.1 Technical Infrastructure Summary

| Layer | Technology Provider | Configuration & Operational Role |
| :--- | :--- | :--- |
| **Domain & DNS** | Namecheap DNS | `chacambodia.org` with automated SSL encryption (HTTPS) |
| **Hosting Server** | Namecheap Stellar Business | CloudLinux OS, LiteSpeed Enterprise Web Server, cPanel |
| **Content Management** | WordPress 6.x Core | Custom enterprise theme: `cha-cambodia-theme` |
| **Database** | MySQL / MariaDB | Single shared database storing posts, members, and donations |
| **Payment Gateway** | ABA PayWay (ABA Bank) | REST API endpoint generating real-time KHQR & ABA Pay |
| **Transactional Email** | Brevo SMTP (Port 587) | Delivers member verification & password resets from `noreply@chacambodia.org` |
| **Offsite Cloud Backup** | UpdraftPlus → Google Drive | Connected to Google Drive (`Nexus Digital Support`, 5 TB storage) |

### 1.2 Official Color Standards & Brand Tokens

To maintain the prestigious, clinical, and compassionate identity of CHA Cambodia, all website elements adhere strictly to these defined brand colors:

| Brand Token | Hex Code | RGB Values | Website Usage & Application |
| :--- | :--- | :--- | :--- |
| **CHA Royal Navy** | `#0B1D6D` | `rgb(11, 29, 109)` | Primary page titles, navigation bar, primary CTA buttons, dark cards |
| **CHA Crimson Red** | `#E31E24` | `rgb(227, 30, 36)` | Selected donation chips, urgent heart badges, active tab markers |
| **CHA Royal Purple** | `#6A2C91` | `rgb(106, 44, 145)` | Community features, partner rings, gradient background accents |
| **Emerald Green** | `#22C55E` | `rgb(34, 197, 94)` | Live mission pulse dots, security checkmarks, successful alerts |
| **Charcoal Slate** | `#1E293B` | `rgb(30, 41, 59)` | Standard body paragraphs, form input text, card labels |
| **Border Slate** | `#CBD5E1` | `rgb(203, 213, 225)` | Input borders, table dividers, card outlines |

---

## 2. Access, Logins & User Security

All administrative operations are conducted through the secure WordPress Administration Dashboard. It is imperative that user credentials are guarded and appropriate permission roles are assigned.

### 2.1 Logging In to WordPress Step-by-Step

* **Step 1: Navigate to the Admin Portal**
  * Open your browser (Google Chrome, Safari, Microsoft Edge, or Brave).
  * In the URL address bar, enter: **`https://chacambodia.org/wp-admin`**
  * Bookmark this link for convenient daily access.
* **Step 2: Enter Credentials & Authenticate**
  * Type your registered Username or Email Address into the first box.
  * Type your secure Password into the second box.
  * Check **"Remember Me"** if using a personal, password-protected computer.
  * Click the blue **Log In** button to enter the dashboard.

> [!TIP]
> **PASSWORD TROUBLESHOOTING**  
> If you cannot log in, click **"Lost your password?"** below the login fields. Enter your registered email address, and an automated password reset link will be sent to your inbox immediately. If you do not see it within 2 minutes, check your Spam/Junk folder.

### 2.2 Understanding Administrative Roles

WordPress provides distinct security levels. Staff should only be granted the minimum permissions required for their job duties:

| Role Name | Recommended For | Permissions & Capabilities |
| :--- | :--- | :--- |
| **Administrator** | Lead Director, IT Manager | Full control: theme updates, payment credentials, plugins, user creation |
| **Editor** | Senior Communications Staff | Can publish, edit, and delete any News & Events, Campaigns, and Pages |
| **Author** | Junior Content Writers | Can write and publish their own articles and upload event photos |
| **Subscriber / Member** | General Public / Patients | Read-only access; used for member portal digital cards only |

---

## 3. Content Management — How to Change Anything Without Code

The website has been structured so that all daily communication tasks—from posting emergency medical workshop announcements to changing office phone numbers—require zero coding knowledge.

### 3.1 Publishing News & Events (`cha_news`)

The News & Events module enables staff to keep donors, international partners, and patients informed. The homepage displays the 3 latest articles, while the full archive at `chacambodia.org/news` houses the complete history.

* **Step 1: Create a New Article**
  * In the left-hand admin menu, hover over **News & Events** and click **Add New Post**.
  * Enter a clear, descriptive Title at the top (e.g. *"World Hemophilia Day 2026 Awareness Workshop in Siem Reap"*).
* **Step 2: Compose Body Content & Upload Photos**
  * Click into the main text editor to type or paste your article description.
  * To insert photos inside the article, click the `+` icon and choose **Image**, then upload from your computer.
  * Keep paragraphs structured with headings and bullet points for easy reading.
* **Step 3: Set the Featured Card Image & Category Badge**
  * In the right sidebar panel, scroll down to **Featured Image** and click **Set featured image**. *(Recommended size: 1200x800px)*.
  * Scroll to **News Category** and check one of the 4 badges: **Event**, **Workshop**, **Update**, or **Announcement**.
  * Click the blue **Publish** button at the top right. The article is instantly live on the homepage and `/news`!

### 3.2 Updating Fundraising Campaigns (`cha_campaigns`)

The homepage features a dynamic "Current Campaigns" panel showcasing active funding initiatives (e.g., *Patient Support Funding*, *Education & Awareness*, *Emergency Assistance*).

**Instructions to update raised amounts or add a new campaign:**
1. In the left admin menu, click **Campaigns** → **All Campaigns**.
2. Click on the campaign you want to edit (e.g., *Patient Support Funding*).
3. Locate the **Campaign Target Details** meta box:
   * **Raised Amount ($):** Enter current funds raised (e.g., `5000`).
   * **Goal Amount ($):** Enter the target goal (e.g., `20000`).
   * **Theme Color:** Select Red, Blue, or Purple.
   * **Card Icon:** Select Heart, Graduation Cap, or Pulse.
4. Click **Update**. The progress bar and percentages on the website recalculate automatically!

### 3.3 Modifying Organization Contacts & Statistics (Customizer)

Whenever CHA changes office locations, phone lines, email addresses, or patient statistics, you can update them in the live visual customizer:

* **Step 1: Open the Visual Customizer**
  * In WordPress Admin, go to: **Appearance** → **Customize**.
  * In the customizer sidebar, click on **CHA Theme Options**.
* **Step 2: Update Contact Info & Statistics Counters**
  * **Contact Phone:** Change to the latest phone number (currently `+855 96 260 5335`).
  * **Contact Email:** Change to the official email (currently `choryee.hun@gmail.com`).
  * **Office Address:** Update physical address (currently `#100, Street Russia Blvd, Phnom Penh`).
  * **Statistics Counters:** Update *Provinces* (`25`), *Hemophilia Patients* (`500+`), or *Partners* (`15+`).
  * Click the blue **Publish** button at the top of the customizer to save.

### 3.4 Managing Mandatory Legal Policies

Commercial payment gateways (including ABA Bank) mandate that legal terms are published and kept accurate. The site provides 3 dedicated bilingual legal pages:
* **Terms of Service & 30-Day Refund Policy (`chacambodia.org/terms`):** Explains donation policies, receipt issuance, and contact details for transaction inquiries.
* **Privacy Policy (`chacambodia.org/privacy`):** Details how member and donor data is protected under Cambodian law.
* **Medical Disclaimer (`chacambodia.org/disclaimer`):** Clarifies that website guidance does not replace licensed medical consultations.

---

## 4. Donation Processing & ABA PayWay Payment Gateway

Donations represent the financial lifeblood of CHA Cambodia. The website is connected directly to ABA Bank's official PayWay payment gateway, offering seamless, instant checkout via Bakong KHQR, ABA Mobile, and international bank cards.

### 4.1 The Donor Experience Flow
1. The donor visits the homepage and views the "Make a Donation" card, or clicks "Donate Now" from any page.
2. They choose an amount preset (`$10`, `$25`, `$50`, `$100`) or click **Other** to input a custom sum.
3. They optionally enter their Name, Email, and Phone number.
4. Upon clicking **Donate Now**, the website encrypts the request with an HMAC-SHA512 digital signature and transmits it to ABA PayWay.
5. ABA generates the official, secure KHQR payment modal on the donor's screen.
6. Once paid, ABA's webhook callback automatically registers the payment approval code (APV) in the WordPress database under `wp_cha_donations`.

> [!WARNING]
> **CRITICAL BANKING EXPLANATION: SANDBOX VS. REAL MONEY**  
> During testing in Sandbox mode, scanning the test QR code with your REAL ABA Mobile app will return an error: **"Transaction not found"**. This is standard and expected behavior across all banking gateways: real bank applications with real money will only recognize LIVE Production transactions. The successful generation of the branded KHQR modal confirms that your API credentials, keys, and endpoint handshakes are working perfectly.

### 4.2 Activating Live Production Mode (Boss Action Required)

When ABA Bank approves your merchant contract and provides your official Live Production credentials, activating live payments on the website takes only 60 seconds:

* **Step 1: Open PayWay Gateway Settings**
  * Log in to WordPress Admin: `https://chacambodia.org/wp-admin`
  * In the left-hand menu, navigate to: **Settings** → **CHA PayWay**.
* **Step 2: Enter Live Merchant Credentials**
  * **Merchant ID:** Paste your official live Merchant ID provided by ABA Bank.
  * **API Key (Public Key):** Paste your official live API Public Key.
  * **Gateway Environment:** Change the dropdown selection from **Sandbox** to **Live / Production**.
  * Click the blue **Save Changes** button.
  * **Purge LiteSpeed Cache** (see Section 6.2). Live payments with real money are now instantly active!

### 4.3 Instant Telegram Alerts for Leadership (PayWay by ABA Bot)

Leadership and accounting staff can receive real-time push alerts on their personal smartphones whenever a donation is completed:
1. Log in to the ABA PayWay Merchant Web Portal (`sandbox.payway.com.kh` or live portal).
2. Click on your Profile / Account Settings in the top-right corner.
3. Select **Telegram Notifications** or **Connect Telegram**.
4. The portal will prompt you to open the official Telegram bot: `@PayWayNotificationBot`.
5. Click **Start** in Telegram and enter the verification token shown in your portal.
6. **Result:** Every time a donor scans and pays, your phone buzzes with a receipt showing Donor Name, Amount (USD or KHR), Date/Time, and Transaction ID!

### 4.4 Generating Standalone Hosted Payment Links

In addition to the website form, staff can generate standalone payment links directly from the PayWay portal:
* Click **Payment Link** on the left menu of the PayWay portal.
* Click **Create Link**, upload the CHA logo, set title *"CHA Emergency Patient Support"*, and choose Open Amount.
* ABA will generate a link like: `link.payway.com.kh/CHACAMBODIA`.
* Copy and paste this link anywhere: Facebook posts, WhatsApp/Telegram groups, or convert it to a QR code for printed event posters!

---

## 5. Member Portal & Digital Patient Cards

CHA Cambodia provides a self-service membership system allowing patients, families, and healthcare advocates to register, verify their email, and generate a recognized digital identity card.

### 5.1 Registration & Brevo SMTP Email Flow
* Visitors register by clicking "Become a Member" or "Register" and filling in their Name, Email, Password, and Role (*Member* or *Patient*).
* To prevent fraudulent accounts, accounts remain unverified until the user clicks the verification link in their email.
* Verification emails are handled by a dedicated Brevo SMTP integration (delivering from `noreply@chacambodia.org`), ensuring reliable inbox placement with zero spam tagging.

### 5.2 Digital Membership Card Capabilities
When a verified member logs in to `chacambodia.org`:
* They can access their personalized Membership Dashboard.
* The dashboard renders a **Digital Membership Card** featuring: Full Patient Name, Unique CHA Member ID, Clinical Diagnosis (e.g. *Severe Hemophilia A, Factor VIII Deficiency*), Blood Group, and Emergency Hospital Contact numbers.
* Members can click **Print Card** or save a digital image on their smartphone for immediate presentation during medical emergencies at treatment centres.

---

## 6. Maintenance, Backups & Disaster Recovery

Website stability, security, and continuous uptime are protected by automated cloud backups, LiteSpeed acceleration, and strict deployment protocols.

### 6.1 Automated Google Drive Backups (Active & Confirmed)

> [!NOTE]
> **CLOUD BACKUP VERIFICATION**  
> **UpdraftPlus is actively authenticated and connected to Google Drive under the account "Nexus Digital Support" (5 TB storage capacity).** Database backups run **DAILY** with a 14-day rolling retention. Core website files run **WEEKLY** with a 4-week rolling retention. Even in the catastrophic event of a total server hardware failure, the entire website and donor database can be fully restored in under 15 minutes.

### 6.2 The Golden Rule: Purging LiteSpeed Cache

> [!WARNING]
> **MANDATORY RULE FOR ALL ADMINISTRATORS**  
> The website utilizes LiteSpeed Enterprise caching to load in under one second. However, this means web pages are saved in a static cache. Whenever you upload a new theme zip, publish news, or edit phone numbers in the Customizer, **you MUST click "Purge All" under the LiteSpeed Cache icon in the top WordPress admin toolbar.** Failing to purge cache will cause visitors to see old/stale content.

### 6.3 Quick-Reference Administrative Cheat Sheet

| Operational Task | WordPress Admin Location | Required Action & Summary |
| :--- | :--- | :--- |
| **Access Admin Dashboard** | `chacambodia.org/wp-admin` | Enter username and password, click Log In |
| **Publish News / Workshop** | `News & Events → Add New` | Add title, write body, upload featured image, select category |
| **Update Campaign Progress** | `Campaigns → All Campaigns` | Update Raised and Goal dollar amounts, click Update |
| **Change Phone / Email** | `Appearance → Customize` | Open **CHA Theme Options**, edit contacts, click Publish |
| **Switch ABA to Live Mode** | `Settings → CHA PayWay` | Paste Live Merchant ID & Key, change mode to Live |
| **Review Donation Log** | `WordPress → Donations menu` | Inspect donor name, amount, date, APV approval code |
| **View Member Roster** | `WordPress → CHA Members` | Inspect registered patients, blood types, conditions |
| **Clear Browser/Site Cache** | `Top Toolbar → LiteSpeed icon` | Click **Purge All** immediately after saving changes |
