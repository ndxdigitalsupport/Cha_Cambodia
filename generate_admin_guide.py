"""
Script to generate CHA_Cambodia_Website_Admin_Guide.docx using the docgen engine.
"""

import os
import sys

# Add docgen engine to path
sys.path.append(os.path.abspath(".agents/skills/docgen/scripts"))
import docgen_engine

def build_guide():
    doc = docgen_engine.create_styled_document()

    # Title Banner
    meta = {
        "Organization": "Cambodian Haemophilia Association",
        "Document": "Website Administrator & Operations Manual",
        "Version": "1.0.0 (Live)",
        "Date": "September 2026",
    }
    docgen_engine.add_header_banner(
        doc,
        "CHA Cambodia — Website Operations & Admin Guide",
        "The Complete Master Guide to Logging In, Updating Content, Managing Donations, and Site Operations",
        meta
    )

    # Executive Overview Callout
    docgen_engine.add_callout(
        doc,
        "This official guide provides complete, step-by-step instructions for organization leadership, staff, and administrators of chacambodia.org. It covers how to log in, create news and campaign updates, edit contact information and site text without touching code, manage ABA PayWay donation gateways, and maintain backup systems.",
        title="EXECUTIVE SUMMARY & PURPOSE",
        alert_type="note"
    )

    # Part 1: Architecture & Platform Overview
    docgen_engine.add_heading_1(doc, "1. Executive Overview & Website Platform")
    docgen_engine.add_body_p(doc, "The Cambodian Haemophilia Association (CHA) public website (chacambodia.org) serves as the primary digital hub for patient care, donor fundraising, awareness, and community education across Cambodia.")
    
    docgen_engine.add_heading_2(doc, "1.1 Technical Stack & Hosting Infrastructure")
    tech_headers = ["Component", "Technology / Provider", "Details & Role"]
    tech_rows = [
        ["Hosting", "Namecheap Stellar Business", "cPanel, LiteSpeed Web Server, CloudLinux environment"],
        ["CMS & Backend", "WordPress Core + Custom Theme", "Custom-coded theme: 'cha-cambodia-theme'"],
        ["Database", "MySQL / MariaDB", "Single unified database (wp_cha_members, wp_cha_donations)"],
        ["Payment Gateway", "ABA PayWay (ABA Bank)", "Direct REST API with dynamic KHQR & ABA Pay"],
        ["Email Delivery", "Brevo SMTP (noreply@chacambodia.org)", "Transactional emails, verification, password resets"],
        ["Automated Backups", "UpdraftPlus -> Google Drive", "Connected to Google Drive (Nexus Digital Support)"],
    ]
    docgen_engine.add_styled_table(doc, tech_headers, tech_rows)

    docgen_engine.add_heading_2(doc, "1.2 Official Brand Standards & Colors")
    docgen_engine.add_body_p(doc, "All pages, buttons, and badges follow official CHA brand identity:")
    color_headers = ["Color Name", "Hex Code", "Usage in Website"]
    color_rows = [
        ["CHA Royal Navy", "#0B1D6D", "Primary headings, navigation bar, main CTA buttons, dark cards"],
        ["CHA Crimson Red", "#E31E24", "Active tabs, donation amount selected states, urgent badges, heart icons"],
        ["CHA Royal Purple", "#6A2C91", "Gradient accents, community icons, partner badges"],
        ["Emerald Green", "#22C55E / #16A34A", "Active mission badges, security checkmarks, live status dots"],
        ["Slate Neutral", "#1E293B / #64748B", "Body typography, subtitles, input borders, neutral cards"],
    ]
    docgen_engine.add_styled_table(doc, color_headers, color_rows)


    # Part 2: WordPress Login & Access
    docgen_engine.add_heading_1(doc, "2. How to Access & Log In to WordPress")
    docgen_engine.add_body_p(doc, "Managing content on the website is done through the secure WordPress Administrator Dashboard.")

    docgen_engine.add_heading_2(doc, "2.1 Login URL and Steps")
    docgen_engine.add_body_p(doc, "1. Open your web browser (Chrome, Edge, Safari, or Brave).")
    docgen_engine.add_body_p(doc, "2. Go to: https://chacambodia.org/wp-admin")
    docgen_engine.add_body_p(doc, "3. Enter your Username or Email Address and Password.")
    docgen_engine.add_body_p(doc, "4. Click 'Log In'. You will be taken directly to the main WordPress dashboard.")

    docgen_engine.add_callout(
        doc,
        "If you ever forget your password, click the 'Lost your password?' link directly beneath the login form on chacambodia.org/wp-admin. Enter your registered email address, and WordPress will send you a secure password reset link.",
        title="PASSWORD RECOVERY TIP",
        alert_type="note"
    )

    docgen_engine.add_heading_2(doc, "2.2 Recommended User Roles")
    docgen_engine.add_body_p(doc, "• Administrator: Full access to all settings, themes, payment keys, and plugins (for lead directors & technical managers).")
    docgen_engine.add_body_p(doc, "• Editor / Author: Can write, edit, and publish News, Events, and Campaigns without risk of breaking site settings or payment configurations.")


    # Part 3: Content Management
    docgen_engine.add_heading_1(doc, "3. How to Change Anything on the Website")
    docgen_engine.add_body_p(doc, "The entire website is built to be manageable without writing code. Here are the three main areas to update:")

    docgen_engine.add_heading_2(doc, "3.1 Adding & Editing News & Events ('cha_news')")
    docgen_engine.add_body_p(doc, "The website has a dedicated News & Events system. To create a new article:")
    docgen_engine.add_body_p(doc, "1. In the left sidebar of WordPress Admin, click 'News & Events' -> 'Add New Post'.", bold_prefix="Step 1:")
    docgen_engine.add_body_p(doc, "2. Enter the Title of the event or article.", bold_prefix="Step 2:")
    docgen_engine.add_body_p(doc, "3. In the main editor area, type or paste the article content and descriptions.", bold_prefix="Step 3:")
    docgen_engine.add_body_p(doc, "4. In the right sidebar panel, set the Featured Image (this is the picture that appears on the card).", bold_prefix="Step 4:")
    docgen_engine.add_body_p(doc, "5. Under 'News Category', choose the badge type: Event, Workshop, Update, or Announcement.", bold_prefix="Step 5:")
    docgen_engine.add_body_p(doc, "6. Click 'Publish' at the top right.", bold_prefix="Step 6:")
    docgen_engine.add_body_p(doc, "The homepage automatically displays the 3 newest articles, and the complete archive is available at chacambodia.org/news with category filtering pills.")

    docgen_engine.add_heading_2(doc, "3.2 Editing Fundraising Campaigns ('cha_campaigns')")
    docgen_engine.add_body_p(doc, "The homepage has a 'Current Campaigns' section showing active missions (e.g. Patient Support Fund, Education & Awareness):")
    docgen_engine.add_body_p(doc, "1. In the WordPress sidebar, click 'Campaigns' -> 'All Campaigns'.")
    docgen_engine.add_body_p(doc, "2. Click on the campaign you wish to edit.")
    docgen_engine.add_body_p(doc, "3. Update the Raised Amount and Goal Amount (e.g. Raised $5,000 / Goal $20,000). The progress bar on the homepage updates automatically!")
    docgen_engine.add_body_p(doc, "4. Choose the Theme Color (Red, Blue, Purple) and Icon (Heart, Graduation, Pulse).")
    docgen_engine.add_body_p(doc, "5. Click 'Update'.")

    docgen_engine.add_heading_2(doc, "3.3 Editing Phone, Email, Address & Stats (WordPress Customizer)")
    docgen_engine.add_body_p(doc, "You can edit organization contact details, banner titles, and statistics counters without touching any code:")
    docgen_engine.add_body_p(doc, "1. In WordPress Admin, go to Appearance -> Customize.")
    docgen_engine.add_body_p(doc, "2. Click on 'CHA Theme Options'.")
    docgen_engine.add_body_p(doc, "3. Here you can edit:")
    docgen_engine.add_body_p(doc, "   • Contact Phone (+855 96 260 5335)")
    docgen_engine.add_body_p(doc, "   • Contact Email (choryee.hun@gmail.com)")
    docgen_engine.add_body_p(doc, "   • Office Address (#100, Street Russia Blvd, Phnom Penh)")
    docgen_engine.add_body_p(doc, "   • Statistics Counters (25 Provinces, 500+ Patients, 15+ Healthcare Partners)")
    docgen_engine.add_body_p(doc, "   • Hero Title & Subtitles")
    docgen_engine.add_body_p(doc, "4. Click 'Publish' at the top of the Customizer. The website updates instantly.")

    docgen_engine.add_heading_2(doc, "3.4 Legal & Compliance Pages")
    docgen_engine.add_body_p(doc, "Under 'Pages' in WordPress Admin, you will find:")
    docgen_engine.add_body_p(doc, "• Terms of Service & 30-Day Refund Policy (URL: /terms)")
    docgen_engine.add_body_p(doc, "• Privacy Policy (URL: /privacy)")
    docgen_engine.add_body_p(doc, "• Disclaimer (URL: /disclaimer)")
    docgen_engine.add_body_p(doc, "These pages are fully translated in English & Khmer and comply with bank merchant regulations.")


    # Part 4: Donation System & ABA PayWay
    docgen_engine.add_heading_1(doc, "4. Donation System & ABA PayWay Gateway")
    docgen_engine.add_body_p(doc, "The website features an integrated ABA PayWay checkout that lets donors pay directly via KHQR, ABA Mobile, or credit cards.")

    docgen_engine.add_heading_2(doc, "4.1 How the Donation Checkout Works")
    docgen_engine.add_body_p(doc, "1. A donor visits chacambodia.org and selects an amount ($10, $25, $50, $100, or Other) on the homepage card or modal.")
    docgen_engine.add_body_p(doc, "2. They optionally enter their name and phone number.")
    docgen_engine.add_body_p(doc, "3. They click 'Donate Now'. The website talks directly to ABA PayWay's secure API.")
    docgen_engine.add_body_p(doc, "4. ABA generates the official KHQR payment code on screen.")
    docgen_engine.add_body_p(doc, "5. When the donor scans and pays, ABA notifies the website backend, and the donation is permanently saved in the WordPress database under wp_cha_donations.")

    docgen_engine.add_callout(
        doc,
        "In Sandbox (testing mode), scanning the QR code with your REAL mobile banking app will say 'Transaction not found'. This is 100% normal because the real bank app only scans LIVE production transactions with real money. The sandbox checkout successfully verifies that ABA accepted your Merchant ID and generated the payment screen.",
        title="WHY REAL APP CANNOT SCAN SANDBOX QR",
        alert_type="warning"
    )

    docgen_engine.add_heading_2(doc, "4.2 How to Switch to Live Production Mode (Boss Action Required)")
    docgen_engine.add_body_p(doc, "When ABA Bank issues your official Live Production credentials, activating live payments takes only 60 seconds:")
    docgen_engine.add_body_p(doc, "1. Log in to WordPress Admin (chacambodia.org/wp-admin).", bold_prefix="Step 1:")
    docgen_engine.add_body_p(doc, "2. In the left menu, click Settings -> CHA PayWay.", bold_prefix="Step 2:")
    docgen_engine.add_body_p(doc, "3. Update the fields with your production values:", bold_prefix="Step 3:")
    docgen_engine.add_body_p(doc, "   • Merchant ID: Enter your Production Merchant ID")
    docgen_engine.add_body_p(doc, "   • API Key: Enter your Production Public Key")
    docgen_engine.add_body_p(doc, "   • Mode: Change dropdown from 'Sandbox' to 'Live / Production'")
    docgen_engine.add_body_p(doc, "4. Click 'Save Changes'.", bold_prefix="Step 4:")
    docgen_engine.add_body_p(doc, "5. Purge LiteSpeed Cache. Live donations are now active!", bold_prefix="Step 5:")

    docgen_engine.add_heading_2(doc, "4.3 Instant Telegram Alerts (PayWay by ABA Bot)")
    docgen_engine.add_body_p(doc, "You can have transaction receipts sent directly to staff Telegram accounts the second a donation is made:")
    docgen_engine.add_body_p(doc, "1. Log in to your ABA PayWay Merchant Portal.")
    docgen_engine.add_body_p(doc, "2. Go to Profile Settings -> Telegram Notification.")
    docgen_engine.add_body_p(doc, "3. Connect to the official 'PayWay by ABA' Telegram bot.")
    docgen_engine.add_body_p(doc, "4. Your phone will now receive instant push receipts with the donor's name, amount, date, and APV approval code.")

    docgen_engine.add_heading_2(doc, "4.4 Standalone PayWay Payment Links")
    docgen_engine.add_body_p(doc, "In the PayWay portal, click the 'Payment Link' menu to create standalone donation links (e.g. link.payway.com.kh/CHA...). These can be posted on Facebook, Telegram channels, or printed on event flyers.")


    # Part 5: Member System & Verification
    docgen_heading5 = docgen_engine.add_heading_1(doc, "5. Member Portal & Patient Registration")
    docgen_engine.add_body_p(doc, "CHA Cambodia provides a self-service member registration system for patients, families, and healthcare advocates.")

    docgen_engine.add_heading_2(doc, "5.1 Registration & Email Verification")
    docgen_engine.add_body_p(doc, "• Members register on the website by providing Name, Email, Password, and role (Member or Patient).")
    docgen_engine.add_body_p(doc, "• Automated verification emails are delivered via Brevo SMTP (noreply@chacambodia.org) with zero spam triggers.")
    docgen_engine.add_body_p(doc, "• Unverified accounts cannot log in until they click the verification link sent to their inbox.")

    docgen_engine.add_heading_2(doc, "5.2 Digital Membership Card")
    docgen_engine.add_body_p(doc, "Once logged in, members can access their dashboard on chacambodia.org:")
    docgen_engine.add_body_p(doc, "• Displays a digital membership card with patient name, member ID, condition (e.g. Hemophilia A), blood type, and emergency contacts.")
    docgen_engine.add_body_p(doc, "• Members can print or save their card for medical identification when visiting hospitals.")

    docgen_engine.add_heading_2(doc, "5.3 Viewing Members in WordPress Admin")
    docgen_engine.add_body_p(doc, "Administrators can view all registered members under the 'CHA Members' menu in WordPress Admin to verify patient details and track community growth.")


    # Part 6: Maintenance, Backups & Emergency Runbook
    docgen_engine.add_heading_1(doc, "6. Maintenance, Backups & Emergency Runbook")
    docgen_engine.add_body_p(doc, "To guarantee 100% uptime and zero data loss, the website is protected by automated cloud backups and version control.")

    docgen_engine.add_heading_2(doc, "6.1 Automated Backup System (Active)")
    docgen_engine.add_callout(
        doc,
        "Backups are automatically saved offsite to Google Drive (Nexus Digital Support account with 5 TB storage). Database backups run DAILY with 14-day retention. File backups run WEEKLY with 4-week retention. Even if the hosting server were damaged, the entire site can be restored in minutes.",
        title="AUTOMATED BACKUP CONFIRMATION",
        alert_type="success"
    )

    docgen_engine.add_heading_2(doc, "6.2 The Golden Rule: Purging LiteSpeed Cache")
    docgen_engine.add_callout(
        doc,
        "Whenever a theme update is uploaded, a page is edited, or Customizer settings are changed, ALWAYS click 'Purge All' under the LiteSpeed Cache icon in the top WordPress admin bar. LiteSpeed caches static pages for speed; purging ensures visitors see updates immediately.",
        title="MANDATORY RULE AFTER ANY UPDATE",
        alert_type="warning"
    )

    docgen_engine.add_heading_2(doc, "6.3 Quick Reference Summary")
    summary_headers = ["Action / Task", "Where to Go", "Key Instruction"]
    summary_rows = [
        ["Log in to Website", "chacambodia.org/wp-admin", "Use admin username and password"],
        ["Add News or Event", "News & Events -> Add New", "Add title, content, image, category badge"],
        ["Update Campaigns", "Campaigns -> All Campaigns", "Update raised amount, goal, and icon"],
        ["Change Phone/Email", "Appearance -> Customize", "Edit under CHA Theme Options"],
        ["Activate Live ABA", "Settings -> CHA PayWay", "Paste Live Merchant ID and Key, set to Live"],
        ["View Donations", "WordPress -> Donations menu", "View transaction ID, amount, APV code"],
        ["Clear Cache", "Top bar -> LiteSpeed icon", "Click 'Purge All'"],
    ]
    docgen_engine.add_styled_table(doc, summary_headers, summary_rows)

    # Save document
    output_filename = "CHA_Cambodia_Website_Admin_Guide.docx"
    doc.save(output_filename)
    print(f"Successfully generated: {output_filename}")

if __name__ == "__main__":
    build_guide()
