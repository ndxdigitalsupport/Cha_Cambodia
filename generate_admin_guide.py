"""
Client-Facing User Manual Generator: CHA_Cambodia_Website_Admin_Guide.docx
Written specifically for non-technical executive leadership and operations staff.
Focuses 100% on practical day-to-day tasks: logging in, publishing news, updating contacts,
creating/editing campaigns, editing any page text/images in Customizer, tracking donations,
managing members (including manual password reset & 1-click verification), and basic maintenance.
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
        "Document Version": "Version 1.2 — Client Operations Edition",
        "Public Website": "https://chacambodia.org",
        "Admin Portal": "https://chacambodia.org/wp-admin",
        "Publication Date": "September 2026",
        "Target Audience": "CHA Executive Leadership, Operations Staff & Content Editors",
    }
    docgen_engine.add_executive_cover_page(
        doc,
        "CHA Cambodia — Website User & Operations Manual",
        "A Practical, Step-by-Step Guide to Managing Content, Campaigns, Donations, Patient Memberships, and Daily Operations on chacambodia.org",
        logo_path=logo_path,
        meta_table=meta_info
    )

    # Table of Contents Overview Callout
    docgen_engine.add_callout(
        doc,
        "Welcome to your official website management guide! This manual was written specifically for the CHA Cambodia leadership and administrative team. It explains everything you need to know to run your website smoothly on a daily basis—such as posting news, creating new fundraising campaigns, editing any text or photo on the website, resetting patient passwords directly, checking donations, and viewing members—without needing any technical or coding knowledge.",
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
            "Display Date: Enter a friendly date string (e.g. 'Apr 17, 2026').",
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
    # SECTION 3: CREATING & MANAGING FUNDRAISING CAMPAIGNS
    # -------------------------------------------------------------
    docgen_engine.add_heading_1(doc, "3. Creating & Managing Fundraising Campaigns")
    docgen_engine.add_body_p(doc, "The homepage displays active fundraising initiatives (such as 'Patient Support Funding' or 'Emergency Factor Treatment') with animated progress bars showing donors how much money has been raised toward the target goal.")

    docgen_engine.add_heading_2(doc, "3.1 How to Create a Brand New Campaign")
    docgen_engine.add_body_p(doc, "Whenever CHA launches a new fundraising appeal or humanitarian project, you can easily create a new campaign card:")
    docgen_engine.add_step_card(
        doc,
        "1",
        "Click Add New Campaign",
        [
            "In your left-hand menu, hover over 'Campaigns' and click 'Add New'.",
            "Enter Campaign Title (English): e.g. 'Youth & Pediatric Care Emergency Fund'.",
            "Enter Short Description: In the main text box, write a 2-3 sentence overview explaining what the fund will support."
        ]
    )
    docgen_engine.add_step_card(
        doc,
        "2",
        "Configure Target Dollar Amounts, Khmer Text & Theme Color",
        [
            "Scroll down to the 'Campaign Details' box on the right / below the editor.",
            "Campaign Icon: Select a matching symbol (Heart, Graduation Cap, Pulse/Health, Users, Shield, Gift, etc.).",
            "Raised Amount ($): Enter starting funds collected (e.g. 0 or 1500).",
            "Goal Amount ($): Enter the total dollar target needed (e.g. 10000).",
            "Theme Color: Select Red, Blue, or Purple for the card accent and progress bar.",
            "Khmer Title & Description (Optional): Fill in the Khmer title and summary for Khmer readers.",
            "Click the blue 'Publish' button. The new campaign immediately joins the active initiatives on the homepage!"
        ]
    )

    docgen_engine.add_heading_2(doc, "3.2 How to Update an Existing Campaign's Raised Amount")
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
        "Adjust Target Dollar Amounts & Save",
        [
            "Scroll to the 'Campaign Details' box.",
            "Update the 'Raised Amount ($)' with the latest total collected.",
            "Click the blue 'Update' button. The website automatically recalculates the percentage and updates the animated progress bar!"
        ]
    )

    # -------------------------------------------------------------
    # SECTION 4: EDITING ANY TEXT, PHOTO & CONTACT ON THE WEBSITE
    # -------------------------------------------------------------
    docgen_engine.add_heading_1(doc, "4. Editing Any Text, Photo & Section via Customizer")
    docgen_engine.add_body_p(doc, "The entire CHA website is built with a live visual editor called the WordPress Customizer. You can edit headlines, mission statements, team bios, statistics, office contacts, and upload new photos across all pages with zero coding knowledge.")

    docgen_engine.add_heading_2(doc, "4.1 How to Access the Live Customizer")
    docgen_engine.add_body_p(doc, "1. In your left WordPress admin menu, hover over 'Appearance' and click 'Customize'.")
    docgen_engine.add_body_p(doc, "2. The screen splits into two: a controls sidebar on the left, and a live preview of your website on the right.")
    docgen_engine.add_body_p(doc, "3. When you make changes, the preview updates immediately. Click the blue 'Publish' button at the top to save your changes to the live internet.")

    docgen_engine.add_heading_2(doc, "4.2 Overview of What You Can Edit in Each Customizer Panel")
    customizer_headers = ["Customizer Panel Name", "What You Can Edit & Upload Inside", "Languages Supported"]
    customizer_rows = [
        ["Homepage Content", "Hero headline, background banner image, action buttons, 'How We Help' cards, and community impact numbers.", "English & Khmer"],
        ["Contact & Footer", "Office phone numbers (+855...), email addresses, physical office address, opening hours, and footer mission tagline.", "English & Khmer"],
        ["Navigation & Header", "Website logo image (Header & Footer), top navigation menu button labels, and donation button text.", "English & Khmer"],
        ["About Page", "CHA background story, mission statement, volunteer statistics, historical timeline milestones, and partnership info.", "English & Khmer"],
        ["Leadership Structure", "Portraits and titles for President, Vice President, Executive Directors, Council Leaders, and Medical Advisors.", "English & Khmer"],
        ["Programs & Services", "Youth outreach descriptions, humanitarian aid factor distribution, emergency patient care programs, and CSR partners.", "English & Khmer"],
        ["Haemophilia Medical Info", "Medical educational text, bleeding disorder symptoms, Factor VIII / Factor IX explanations, and von Willebrand Disease guide.", "English & Khmer"],
        ["Popups & Modals", "Donation modal instructions, banking transfer notes, and membership registration terms copy.", "English & Khmer"],
    ]
    docgen_engine.add_styled_table(doc, customizer_headers, customizer_rows)

    docgen_engine.add_step_card(
        doc,
        "1",
        "Changing Office Contacts (Phone, Email, Address)",
        [
            "In the Customizer left menu, click 'Contact & Footer' -> 'Contact Information'.",
            "Phone: Update your official phone number (e.g. +855 96 260 5335).",
            "Email: Update your official office email (e.g. info@chacambodia.org).",
            "Address: Update your physical office address in Phnom Penh.",
            "Opening Hours: Update Monday-Friday and Saturday service hours.",
            "Click the blue 'Publish' button at the top of the sidebar."
        ]
    )
    docgen_engine.add_step_card(
        doc,
        "2",
        "Changing Site Logo or Hero Banner Image",
        [
            "To change the logo: Click 'Navigation & Header' -> 'Site Logo', click 'Change Image', and select your new high-resolution PNG logo.",
            "To change the homepage hero photo: Click 'Homepage Content' -> 'Hero Section', click 'Change Image' under Background Image, and upload a fresh photo.",
            "Click 'Publish' to make the new visual immediately live."
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
    docgen_engine.add_body_p(doc, "Patients and supporters register through the website or mobile app to receive digital membership cards. As an administrator, you have full control to view, add, edit, verify, and support members.")

    docgen_engine.add_heading_2(doc, "6.1 Viewing the Registered Member Roster")
    docgen_engine.add_body_p(doc, "1. In the left-hand menu, click on 'CHA Members'.")
    docgen_engine.add_body_p(doc, "2. You will see a complete roster showing each member's Photo, Member ID (e.g. CHA-2026-001), Full Name (English & Khmer), Email, Phone, Role Badge (Patient, Caregiver, Healthcare Prof., or Member), and Verification Status.")
    docgen_engine.add_body_p(doc, "3. Quick Search: Type any name, email, or Member ID into the search box at the top to find a member in under 1 second.")

    docgen_engine.add_heading_2(doc, "6.2 Directly Editing a Member & Setting a New Password")
    docgen_engine.add_body_p(doc, "If a patient contacts your office asking for a password reset, or needs their medical information, address, or phone number updated:")
    docgen_engine.add_step_card(
        doc,
        "1",
        "Open the Member Edit Screen",
        [
            "In 'CHA Members', locate the member and click the blue 'Edit' pill button on their row.",
            "You can also manually register a patient from your office by clicking 'Add New Member' at the top."
        ]
    )
    docgen_engine.add_step_card(
        doc,
        "2",
        "Update Details or Set a New Password Directly",
        [
            "Direct Password Reset: Find the field labeled 'New Password'. Simply type a new temporary password (e.g. Cha2026!) and click 'Save Changes'. You can then give this password directly to the patient! (Leave this box blank if you do not want to change their password).",
            "Role Selection: Switch between 'Patient' or 'General Member'. Selecting 'Patient' automatically unlocks medical fields.",
            "Medical Details: Update Blood Type (A+, B+, O+, AB+, etc.), Diagnosed Bleeding Condition, and Date of Birth.",
            "Contact Info: Update phone number, physical address, and Khmer name.",
            "Click the blue 'Save Changes' button at the bottom. The member can immediately log in with their new credentials!"
        ]
    )

    docgen_engine.add_heading_2(doc, "6.3 One-Click Member Verification & Troubleshooting")
    docgen_engine.add_body_p(doc, "• Instant 1-Click Verification: If a patient did not receive or cannot open their verification email, you do not need to resend anything! Simply find their name with the amber 'Pending' badge in 'CHA Members' and click the green 'Verify' button on their row. Their account is immediately activated.", bullet=True)
    docgen_engine.add_body_p(doc, "• Self-Service Password Reset: Patients can also reset their own password anytime by clicking 'Forgot Password?' on the app or website login screen.", bullet=True)
    docgen_engine.add_body_p(doc, "• Deleting a Member: If a test account or duplicate profile was created, click the red 'Delete' button on that row. A confirmation dialog will ask you to confirm before deleting.", bullet=True)
    docgen_engine.add_body_p(doc, "• Exporting Member Directory: Click 'Export CSV' at the top of the CHA Members screen to download the full patient registry into Microsoft Excel for offline record-keeping.", bullet=True)

    # -------------------------------------------------------------
    # SECTION 7: ONE GOLDEN RULE: PURGING CACHE
    # -------------------------------------------------------------
    docgen_engine.add_heading_1(doc, "7. The Golden Rule: Clearing the Website Cache")
    docgen_engine.add_callout(
        doc,
        "Why did my changes not show up immediately?\nYour website uses high-speed LiteSpeed acceleration so pages load in under 1 second. When you edit text in the Customizer, update a campaign, or post news, you must clear the cache so the server shows the fresh version to visitors.\n\nHOW TO DO IT IN 3 SECONDS:\nLook at the very top black bar of your WordPress Admin screen. Hover over the LiteSpeed diamond icon and click 'Purge All'. That's it! Your updates will immediately appear to the public.",
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
        ["Create a New Fundraising Campaign", "Campaigns -> Add New", "Add title, description, target goal ($), and click Publish"],
        ["Update Campaign Money Raised", "Campaigns -> All Campaigns", "Update Raised and Goal dollar amounts, click Update"],
        ["Edit Any Page Text, Photo or Logo", "Appearance -> Customize", "Open relevant panel (Homepage, About, Leadership), edit, click Publish"],
        ["Change Office Phone or Email", "Appearance -> Customize", "Open 'Contact & Footer' -> 'Contact Info', edit, click Publish"],
        ["Check Who Donated Money", "Donations menu", "View total raised, donor names, or click 'Export CSV'"],
        ["Switch ABA Bank to Real Money", "Donations -> PayWay Settings", "Paste Live Merchant ID & Key, change to Production"],
        ["Set New Password for a Patient", "CHA Members -> Edit", "Type new password into 'New Password' box and click Save"],
        ["Verify Patient Account Directly", "CHA Members menu", "Click green 'Verify' button on any pending member row"],
        ["Make Changes Appear Immediately", "Top bar -> LiteSpeed icon", "Click 'Purge All' after making any changes"],
    ]
    docgen_engine.add_styled_table(doc, cheat_headers, cheat_rows)

    # Save to file
    output_docx = "CHA_Cambodia_Website_Admin_Guide.docx"
    doc.save(output_docx)
    print(f"Master client manual successfully created: {output_docx}")

if __name__ == "__main__":
    generate_client_manual()
