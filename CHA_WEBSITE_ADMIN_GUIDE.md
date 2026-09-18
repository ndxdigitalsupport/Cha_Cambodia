# CHA Cambodia — Complete Website Administrator & Operations Guide

**Organization:** Cambodian Haemophilia Association (CHA)  
**Website:** [chacambodia.org](https://chacambodia.org/)  
**Version:** 1.0.0 (Official Operations Manual)  
**Date:** September 2026  

---

## Executive Summary & Purpose

This official operations guide provides complete, step-by-step instructions for organization leadership, staff, and administrators of **chacambodia.org**. It explains:
1. How to log in and manage user roles.
2. How to create and edit News & Events and Fundraising Campaigns.
3. How to edit organization contact information, statistics, and text without writing code.
4. How the ABA PayWay payment gateway works and how to activate Live Production mode.
5. How the Member Portal and Digital Patient Cards work.
6. How automated cloud backups work and how to maintain the site.

---

## 1. Executive Overview & Website Platform

### 1.1 Technical Stack & Infrastructure
* **Domain & CMS:** [chacambodia.org](https://chacambodia.org/) running WordPress Core with a custom, high-performance theme (`cha-cambodia-theme`).
* **Hosting:** Namecheap **Stellar Business** running cPanel, LiteSpeed Web Server, and CloudLinux.
* **Database:** Single unified MySQL database (`wp_cha_members`, `wp_cha_donations`).
* **Payments:** ABA PayWay (ABA Bank) direct integration with dynamic KHQR and ABA Pay support.
* **Email System:** Brevo SMTP (`noreply@chacambodia.org`) for zero-spam transactional emails.
* **Backups:** UpdraftPlus connected to Google Drive (`Nexus Digital Support`, 5 TB storage).

### 1.2 Official Brand Standards & Color Tokens
* **CHA Royal Navy (`#0B1D6D`):** Primary headings, navigation bar, primary action buttons, footer.
* **CHA Crimson Red (`#E31E24`):** Active tabs, selected donation chips, heart icons, urgent badges.
* **CHA Royal Purple (`#6A2C91`):** Gradients, community icons, partner logos.
* **Emerald Green (`#22C55E` / `#16A34A`):** Active mission badges, security checkmarks, live status pulse.
* **Slate Neutrals (`#1E293B` / `#64748B`):** Clean typography, body text, form field borders.

---

## 2. How to Access & Log In to WordPress

### 2.1 Login Instructions
1. Open your web browser (Chrome, Edge, Safari, or Brave).
2. Go to: **`https://chacambodia.org/wp-admin`**
3. Enter your **Username or Email Address** and **Password**.
4. Click **Log In**.

> [!TIP]
> **Password Recovery:** If you forget your password, click **"Lost your password?"** directly beneath the login fields. Enter your email, and WordPress will send you a secure password reset link.

### 2.2 Recommended User Roles
* **Administrator:** Full control over plugins, payment keys, themes, and settings (Lead Director & IT Manager).
* **Editor / Author:** Can create and edit News, Events, and Campaigns without risk of modifying payment or theme settings.

---

## 3. How to Change Anything on the Website

### 3.1 Adding & Editing News & Events (`cha_news`)
The website has a built-in News & Events system:
1. In the WordPress left sidebar, click **News & Events** → **Add New Post**.
2. Enter the **Title** of the article or event.
3. In the main editor box, write or paste your article content and photos.
4. In the right-hand sidebar:
   * Click **Set featured image** and upload your picture.
   * Under **News Category**, select the badge: **Event**, **Workshop**, **Update**, or **Announcement**.
5. Click **Publish**.

*The homepage automatically displays the latest 3 cards, and the complete archive is accessible at `chacambodia.org/news` with interactive category filtering.*

### 3.2 Editing Fundraising Campaigns (`cha_campaigns`)
To update the "Current Campaigns" section on the homepage:
1. In the left sidebar, click **Campaigns** → **All Campaigns**.
2. Click on the campaign you want to edit (e.g. *Patient Support Fund*).
3. Update the **Raised Amount** and **Goal Amount** (e.g. Raised $5,000 / Goal $20,000). The progress bar on the homepage updates automatically!
4. Choose the theme color (Red, Blue, Purple) and icon.
5. Click **Update**.

### 3.3 Editing Phone, Email, Address & Stats (WordPress Customizer)
You can change the organization's public contact information and statistics without writing any code:
1. Go to **Appearance** → **Customize**.
2. Click on **CHA Theme Options**.
3. Here you can edit:
   * **Contact Phone:** `+855 96 260 5335`
   * **Contact Email:** `choryee.hun@gmail.com`
   * **Office Address:** `#100, Street Russia Blvd, Phnom Penh, Cambodia`
   * **Statistics Counters:** Provinces: `25`, Patients: `500+`, Healthcare Partners: `15+`
   * **Hero Title & Subtitles**
4. Click **Publish** at the top. The website updates immediately!

### 3.4 Legal & Compliance Pages
The website includes 3 legal pages required by payment gateways:
* **Terms of Service & 30-Day Refund Policy:** `/terms`
* **Privacy Policy:** `/privacy`
* **Disclaimer:** `/disclaimer`  
*All three are bilingual (English + Khmer) and can be edited under **Pages** in the WordPress menu.*

---

## 4. Donation System & ABA PayWay Gateway

### 4.1 How the Website Donation Flow Works
1. A donor visits `chacambodia.org` and selects an amount (`$10`, `$25`, `$50`, `$100`, or `Other`) on the homepage card or modal.
2. They optionally enter their name and phone number.
3. They click **Donate Now**. The website talks directly to ABA PayWay's secure API.
4. ABA generates the official KHQR payment screen.
5. When the donor scans and pays, ABA notifies the website backend, and the donation is permanently saved in the WordPress database under `wp_cha_donations`.

> [!NOTE]
> **Why real banking apps cannot scan Sandbox QR:**  
> In Sandbox (testing mode), scanning the QR code with your real mobile banking app will say *"Transaction not found"*. This is 100% normal because real banking apps only scan LIVE production transactions with real money. The sandbox checkout successfully verifies that ABA accepted your Merchant ID and generated the payment screen.

### 4.2 How to Switch to Live Production Mode (Boss Action Required)
When ABA Bank issues your official Live Production credentials, activating live payments takes only 60 seconds:
1. Log in to WordPress Admin (`chacambodia.org/wp-admin`).
2. In the left menu, click **Settings** → **CHA PayWay**.
3. Update the fields:
   * **Merchant ID:** Enter your Production Merchant ID.
   * **API Key:** Enter your Production Public Key.
   * **Mode:** Change dropdown from **Sandbox** to **Live / Production**.
4. Click **Save Changes**.
5. **Purge LiteSpeed Cache.** Live donations are now active!

### 4.3 Instant Telegram Alerts (PayWay by ABA Bot)
To receive instant payment receipts on your phone:
1. Log in to your ABA PayWay Merchant Portal.
2. Go to **Profile Settings** → **Telegram Notification**.
3. Connect your Telegram account to the official `@PayWayNotificationBot`.
4. Whenever a donor completes a payment, your phone will buzz with an instant receipt containing the donor's name, amount, date, and APV approval code!

### 4.4 Standalone PayWay Payment Links
In your ABA PayWay Merchant Portal, click **Payment Link** in the left menu to generate standalone links (e.g. `link.payway.com.kh/CHA...`). These links can be posted on Facebook, Telegram, or printed as QR codes on event banners.

---

## 5. Member Portal & Patient Registration

### 5.1 Registration & Verification
* Members register on the website by providing their Name, Email, Password, and role (*Member* or *Patient*).
* Verification emails are automatically delivered via Brevo SMTP (`noreply@chacambodia.org`).
* Unverified accounts cannot log in until they click the verification link in their email.

### 5.2 Digital Membership Card
Once logged in, members can view their **Digital Membership Card** with their name, Member ID, condition (e.g., *Hemophilia A*), blood type, and emergency contacts. Members can print or save their card for medical identification at treatment centres.

### 5.3 Viewing Members in WordPress
Administrators can view all registered members under the **CHA Members** menu in WordPress Admin.

---

## 6. Maintenance, Backups & Emergency Runbook

### 6.1 Automated Backup System (Active)
* **Storage:** Google Drive (`Nexus Digital Support` account with 5 TB storage).
* **Database Backups:** Daily schedule, 14-day retention.
* **File Backups:** Weekly schedule, 4-week retention.
* Even if the server were damaged, the website and donation database can be restored within minutes.

### 6.2 The Golden Rule: Purging LiteSpeed Cache
> [!WARNING]
> Whenever you upload a new theme zip, update content, or change Customizer settings, **ALWAYS click "Purge All" under the LiteSpeed Cache icon in the top WordPress admin bar.** LiteSpeed caches pages for speed; purging ensures all visitors see updates immediately.

### 6.3 Quick Reference Cheat Sheet

| Action / Task | Where to Go | Key Instruction |
| :--- | :--- | :--- |
| **Log In to Site** | `chacambodia.org/wp-admin` | Use admin username and password |
| **Add News/Event** | `News & Events → Add New` | Add title, content, image, category badge |
| **Update Campaigns** | `Campaigns → All Campaigns` | Update raised amount, goal, and icon |
| **Change Phone/Email** | `Appearance → Customize` | Edit under CHA Theme Options |
| **Activate Live ABA** | `Settings → CHA PayWay` | Paste Live Merchant ID and Key, set to Live |
| **View Donations** | `WordPress → Donations menu` | View transaction ID, amount, APV code |
| **Clear Cache** | `Top bar → LiteSpeed icon` | Click **Purge All** |
