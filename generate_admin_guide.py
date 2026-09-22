"""
Client-Facing User Manual Generator: CHA_Cambodia_Website_Admin_Guide.docx
Written specifically for non-technical executive leadership and operations staff.
Focuses 100% on practical day-to-day tasks: logging in, publishing news, updating contacts,
managing campaigns, tracking donations, supporting members, and basic maintenance.
"""

import os
import sys

# Add docgen engine to path
sys.path.append(os.path.abspath(".agents/skills/docgen/scripts"))
import docgen_engine

def generate_client_manual():
    doc = docgen_engine.create_styled_document()

    # 1. Executive Cover Page with Official Logo
    logo_path = os.path.abspath("cha-cambodia-theme/cha-logo-left.png")
    meta_info = {
        "Organization": "Cambodian Haemophilia Association (CHA Cambodia)",
        "Document Title": "Website User & Operations Manual",
        "Document Version": "Version 1.1 — Client Operations Edition",
        "Public Website": "https://chacambodia.org",
        "Admin Portal": "https://chacambodia.org/wp-admin",
        "Publication Date": "September 2026",
        "Target Audience": "CHA Executive Leadership, Operations Staff & Content Editors",
    }
    docgen_engine.add_executive_cover_page(
        doc,
        "CHA Cambodia — Website User & Operations Manual",
        "A Practical, Step-by-Step Guide to Managing Content, Donations, Patient Memberships, and Daily Operations on chacambodia.org",
        logo_path=logo_path,
        meta_table=meta_info
    )

    # Table of Contents Overview Callout
    docgen_engine.add_callout(
        doc,
        "Welcome to your official website management guide! This manual was written specifically for the CHA Cambodia leadership and administrative team. It explains everything you need to know to run your website smoothly on a daily basis—such as posting news, updating phone numbers, checking donations, and viewing patient members—without needing any technical or coding knowledge.",
        title="WELCOME TO YOUR WEBSITE OPERATIONS MANUAL",
        alert_type="note"
    )

    # -------------------------------------------------------------
    # SECTION 1: GETTING STARTED & LOGGING IN
    # -------------------------------------------------------------
    docgen_engine.add_heading_1(doc, "1. Getting Started & Logging In")
    docgen_engine.add_body_p(doc, "All updates to your website are made through a private management screen called the WordPress Admin Dashboard. You can access it securely from any web browser on your computer or tablet.")

    docgen_engine.add_heading_2(doc, "1.1 How to Log In Step-by-Step")
    docgen_engine.add_step_card(
        doc,
        "1",
        "Go to the Admin Portal",
        [
            "Open your web browser (Chrome, Safari, Edge, or Brave).",
            "Type in this address: https://chacambodia.org/wp-admin",
            "Tip: Bookmark this page in your browser so you can find it easily."
        ]
    )
    docgen_engine.add_step_card(
        doc,
        "2",
        "Enter Your Login Credentials",
        [
            "Type your Username or Email Address into the first box.",
            "Type your Password into the second box.",
            "Check 'Remember Me' if you are using your personal office computer.",
            "Click the blue 'Log In' button to enter your dashboard."
        ]
    )

    docgen_engine.add_heading_2(doc, "1.2 What to Do If You Forget Your Password")
    docgen_engine.add_body_p(doc, "If you or a colleague ever forget your password, you can reset it yourself in 1 minute:")
    docgen_engine.add_body_p(doc, "1. On the login screen, click the link that says 'Lost your password?'.")
    docgen_engine.add_body_p(doc, "2. Type in your registered email address and click 'Get New Password'.")
    docgen_engine.add_body_p(doc, "3. Open your email inbox and click the reset link sent by the website to create a new password.")

    # -------------------------------------------------------------
    # SECTION 2: PUBLISHING NEWS & EVENT ARTICLES
    # -------------------------------------------------------------
    docgen_engine.add_heading_1(doc, "2. Publishing News, Workshops & Events")
    docgen_engine.add_body_p(doc, "The News & Events section allows you to share updates with the public, international partners, and patients. When you publish an article, it automatically appears on the homepage (the 3 latest stories) and in the full archive at chacambodia.org/news.")

    docgen_engine.add_heading_2(doc, "2.1 How to Create a New Article")
    docgen_engine.add_step_card(
        doc,
        "1",
        "Start a New Post",
        [
            "In the left-hand menu of your admin dashboard, click 'News & Events'.",
            "Click the 'Add New Post' button at the top."
        ]
    )
    docgen_engine.add_step_card(
        doc,
        "2",
        "Enter English & Khmer Information",
        [
            "Add Title: Enter the English headline at the top (e.g., 'World Haemophilia Day 2026 Awareness Workshop').",
            "Main Content: Type or paste the full story into the large text area.",
            "Khmer Translation (Optional): Under the editor, you will see boxes for Khmer Title and Khmer Summary. If you have Khmer text, paste it here so visitors reading in Khmer can see it!"
        ]
    )
    docgen_engine.add_step_card(
        doc,
        "3",
        "Add Photo & Category Badge, Then Publish",
        [
            "Featured Image: On the right sidebar, click 'Set featured image' and upload a nice photo of your event.",
            "News Category: Choose one category badge that best fits: Event, Workshop, Update, or Announcement.",
            "Publish: Click the blue 'Publish' button at the top right. Your news is now live for the public to read!"
        ]
    )

    docgen_engine.add_callout(
        doc,
        "Photo Tips for Fast Loading: For the best visual appearance on phones and computers, use horizontal (landscape) photos from your workshops or ceremonies. Try to keep images under 2 MB so the page loads instantly for visitors with slower mobile internet.",
        title="PRACTICAL PHOTO GUIDELINE",
        alert_type="tip"
    )

    # -------------------------------------------------------------
    # SECTION 3: UPDATING FUNDRAISING CAMPAIGNS
    # -------------------------------------------------------------
    docgen_engine.add_heading_1(doc, "3. Updating Fundraising Campaigns & Goals")
    docgen_engine.add_body_p(doc, "The homepage displays active fundraising initiatives (such as 'Patient Support Funding' or 'Education & Awareness') with animated progress bars showing donors how much has been raised.")

    docgen_engine.add_heading_2(doc, "3.1 How to Update Campaign Raised Amounts")
    docgen_engine.add_step_card(
        doc,
        "1",
        "Select the Campaign to Edit",
        [
            "In the left-hand menu, click 'Campaigns' -> 'All Campaigns'.",
            "Click on the title of the campaign you wish to update."
        ]
    )
    docgen_engine.add_step_card(
        doc,
        "2",
        "Adjust Target Dollar Amounts",
        [
            "Scroll down to the 'Campaign Target Details' section below the text box.",
            "Raised Amount ($): Enter the current total funds collected (for example, 5000).",
            "Goal Amount ($): Enter the overall target you want to reach (for example, 20000).",
            "Click the blue 'Update' button on the right sidebar. The website will immediately recalculate the percentage and update the progress bar!"
        ]
    )

    # -------------------------------------------------------------
    # SECTION 4: UPDATING CONTACT INFO & STATISTICS
    # -------------------------------------------------------------
    docgen_engine.add_heading_1(doc, "4. Updating Office Contacts & Statistics")
    docgen_engine.add_body_p(doc, "Whenever CHA changes office addresses, phone numbers, email contacts, or patient community statistics, you can update them in a live visual editor without touching any code.")

    docgen_engine.add_heading_2(doc, "4.1 Step-by-Step Customizer Guide")
    docgen_engine.add_step_card(
        doc,
        "1",
        "Open the Customizer",
        [
            "In the left menu, hover over 'Appearance' and click 'Customize'.",
            "In the customizer sidebar on the left, click on 'CHA Theme Options'."
        ]
    )
    docgen_engine.add_step_card(
        doc,
        "2",
        "Edit Contact Details & Save",
        [
            "Contact Phone: Type your new official phone number (e.g. +855 96 260 5335).",
            "Contact Email: Type your official office email (e.g. info@chacambodia.org).",
            "Office Address: Update your physical office location in Phnom Penh.",
            "Statistics Numbers: Update patient numbers (e.g. '500+ Patients', '25 Provinces').",
            "Save: Click the blue 'Publish' button at the top of the sidebar to make the changes live!"
        ]
    )

    # -------------------------------------------------------------
    # SECTION 5: DONATIONS, PAYWAY & EXCEL REPORTS
    # -------------------------------------------------------------
    docgen_engine.add_heading_1(doc, "5. Tracking Donations & Managing ABA PayWay")
    docgen_engine.add_body_p(doc, "Donations made through the website and mobile app are processed securely through ABA Bank's PayWay gateway (supporting KHQR scans and cards). All transactions are recorded in your private administrative ledger.")

    docgen_engine.add_heading_2(doc, "5.1 Understanding the Donations Dashboard")
    docgen_engine.add_body_p(doc, "To view your financial ledger, click on 'Donations' in your left-hand WordPress menu. You will see 4 summary cards:")
    docgen_engine.add_body_p(doc, "• Total Raised: The total amount of cleared money received in USD.", bullet=True)
    docgen_engine.add_body_p(doc, "• Completed Orders: The number of successful donations completed.", bullet=True)
    docgen_engine.add_body_p(doc, "• Pending / In-Flight: Donors who opened a payment window but have not scanned yet. (Note: Unpaid pending checkouts are automatically cleaned up after 12 hours so your ledger stays clean).", bullet=True)
    docgen_engine.add_body_p(doc, "• Total Donors: Total unique supporters.", bullet=True)
    docgen_engine.add_body_p(doc, "• Anonymous Donors: If a donor chooses not to type their name, the system safely records them as 'Anonymous Donor'.", bullet=True)

    docgen_engine.add_heading_2(doc, "5.2 Exporting Donation Reports for Accounting")
    docgen_engine.add_body_p(doc, "Whenever your finance team or executive director needs an official donation report:")
    docgen_engine.add_body_p(doc, "1. Go to the 'Donations' screen in WordPress Admin.")
    docgen_engine.add_body_p(doc, "2. Click the white 'Export CSV Ledger' button in the top banner.")
    docgen_engine.add_body_p(doc, "3. An Excel-compatible `.csv` file will download to your computer containing all receipts, donor names, emails, phones, amounts, and bank approval codes (APV).")

    docgen_engine.add_heading_2(doc, "5.3 Switching ABA PayWay to Live Real Money Mode")
    docgen_engine.add_callout(
        doc,
        "When ABA Bank approves your official merchant account and provides your Live credentials, activating live payments takes only 1 minute:\n1. In your admin menu, click 'Donations'.\n2. Click the 'PayWay Gateway Settings' button in the top banner.\n3. Enter your Live Merchant ID and Live API Key.\n4. Change the Environment dropdown from 'Sandbox' to 'Production (Live)'.\n5. Click 'Save Gateway Configuration'. Real donations will now go directly into your bank account!",
        title="HOW TO ACTIVATE LIVE ABA BANK PAYMENTS",
        alert_type="warning"
    )

    # -------------------------------------------------------------
    # SECTION 6: MANAGING PATIENT MEMBERS & SUPPORT
    # -------------------------------------------------------------
    docgen_engine.add_heading_1(doc, "6. Managing Members & Patient Support")
    docgen_engine.add_body_p(doc, "Patients and supporters can register through the website or mobile app to receive digital membership cards. You can view and manage all registered members directly from WordPress.")

    docgen_engine.add_heading_2(doc, "6.1 Viewing the Registered Member List")
    docgen_engine.add_body_p(doc, "1. In the left-hand menu, click on 'CHA Members'.")
    docgen_engine.add_body_p(doc, "2. You will see a complete roster showing each person's Name, Email, Member Role (Patient or Member), Blood Type, and Medical Diagnosis.")

    docgen_engine.add_heading_2(doc, "6.2 Helping Patients Who Have Login or Password Issues")
    docgen_engine.add_body_p(doc, "If a patient or family member contacts your office for help with their account:")
    docgen_engine.add_body_p(doc, "• If they forgot their password: Tell them to click 'Forgot Password?' on the app or website login screen. They enter their email, and the system automatically emails them a password reset link.")
    docgen_engine.add_body_p(doc, "• If they did not get the verification email: Check 'CHA Members' to verify their email address is spelled correctly. Have them check their Spam/Junk folder.")

    # -------------------------------------------------------------
    # SECTION 7: ONE GOLDEN RULE: PURGING CACHE
    # -------------------------------------------------------------
    docgen_engine.add_heading_1(doc, "7. The Golden Rule: Clearing the Website Cache")
    docgen_engine.add_callout(
        doc,
        "Why did my changes not show up immediately?\nYour website uses high-speed LiteSpeed acceleration so pages load in under 1 second. When you edit a phone number, update a campaign, or post news, you must clear the cache so the server shows the fresh version to visitors.\n\nHOW TO DO IT IN 3 SECONDS:\nLook at the very top black bar of your WordPress Admin screen. Hover over the LiteSpeed diamond icon and click 'Purge All'. That's it! Your updates will immediately appear to the public.",
        title="MANDATORY STEP AFTER MAKING ANY CHANGE",
        alert_type="warning"
    )

    # -------------------------------------------------------------
    # SECTION 8: AUTOMATIC BACKUPS & SECURITY
    # -------------------------------------------------------------
    docgen_engine.add_heading_1(doc, "8. Automatic Backups & Peace of Mind")
    docgen_engine.add_body_p(doc, "As an organization leader, you can have complete peace of mind regarding website safety and data security:")
    docgen_engine.add_body_p(doc, "• Automatic Daily Database Backups: Every donation and patient record is backed up automatically every single day to a secure Google Drive cloud account (with 5 TB storage).", bullet=True)
    docgen_engine.add_body_p(doc, "• Weekly Full Website Backups: All images, news articles, and files are backed up weekly.", bullet=True)
    docgen_engine.add_body_p(doc, "• Zero Daily Maintenance Needed: Staff do not need to run manual backups. If a server problem ever occurs, the entire website can be restored from the cloud.", bullet=True)

    # Summary Quick Cheat Sheet Table
    docgen_engine.add_heading_2(doc, "8.1 Quick Action Summary for Staff")
    cheat_headers = ["What You Want to Do", "Where to Click in Admin", "Simple Action Required"]
    cheat_rows = [
        ["Log in to Website", "chacambodia.org/wp-admin", "Enter your username and password"],
        ["Post a News Article or Workshop", "News & Events -> Add New", "Add title, story, event photo, and click Publish"],
        ["Update Campaign Money Raised", "Campaigns -> All Campaigns", "Update Raised and Goal dollar amounts, click Update"],
        ["Change Office Phone or Email", "Appearance -> Customize", "Open 'CHA Theme Options', edit info, click Publish"],
        ["Check Who Donated Money", "Donations menu", "View total raised, donor names, or click 'Export CSV'"],
        ["Switch ABA Bank to Real Money", "Donations -> PayWay Settings", "Paste Live Merchant ID & Key, change to Production"],
        ["View Registered Patient Members", "CHA Members menu", "Look up patient member IDs, blood types, and diagnoses"],
        ["Make Changes Appear Immediately", "Top bar -> LiteSpeed icon", "Click 'Purge All' after making any changes"],
    ]
    docgen_engine.add_styled_table(doc, cheat_headers, cheat_rows)

    # Save to file
    output_docx = "CHA_Cambodia_Website_Admin_Guide.docx"
    doc.save(output_docx)
    print(f"Master client manual successfully created: {output_docx}")

if __name__ == "__main__":
    generate_client_manual()
