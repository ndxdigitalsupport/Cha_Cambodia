"""
Khmer Generator for CHA_Cambodia_Website_Admin_Guide_KM.docx
Builds an exhaustive, highly detailed, beautifully designed operations manual in Khmer for CHA leadership.
Strictly covers website-only capabilities (no mobile app, no Telegram bots, no standalone links).
"""

import os
import sys
from docx import Document
from docx.shared import Inches, Pt, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT
from docx.oxml import parse_xml
from docx.oxml.ns import nsdecls

# Brand Colors (Hex & RGB)
COLOR_PRIMARY = "0B1D6D"     # Deep Royal Navy
COLOR_SECONDARY = "E31E24"   # Crimson Red
COLOR_PURPLE = "6A2C91"      # Royal Purple
COLOR_TEXT = "1E293B"        # Slate 800
COLOR_MUTED = "64748B"       # Slate 500
COLOR_SURFACE = "F8FAFC"     # Slate 50
COLOR_BORDER = "CBD5E1"      # Slate 300
COLOR_SUCCESS = "16A34A"     # Emerald Green
COLOR_WARNING = "D97706"     # Amber

RGB_PRIMARY = RGBColor(11, 29, 109)
RGB_SECONDARY = RGBColor(227, 30, 36)
RGB_TEXT = RGBColor(30, 41, 59)
RGB_MUTED = RGBColor(100, 116, 139)
RGB_WHITE = RGBColor(255, 255, 255)

FONT_KHMER = "Kantumruy Pro"
FONT_FALLBACK = "Khmer OS Siemreap"

def set_khmer_font(run, font_name=FONT_KHMER):
    """Assigns font for both standard Latin/ASCII and Complex Script (Khmer Unicode)."""
    run.font.name = font_name
    rPr = run._r.get_or_add_rPr()
    xml = f'<w:rFonts {nsdecls("w")} w:ascii="{font_name}" w:hAnsi="{font_name}" w:cs="{font_name}"/>'
    rPr.append(parse_xml(xml))

def set_cell_background(cell, hex_color):
    tcPr = cell._element.get_or_add_tcPr()
    shd = parse_xml(f'<w:shd {nsdecls("w")} w:fill="{hex_color}"/>')
    tcPr.append(shd)

def set_cell_margins(cell, top=120, bottom=120, left=160, right=160):
    tcPr = cell._element.get_or_add_tcPr()
    tcMar = parse_xml(f'''
        <w:tcMar {nsdecls("w")}>
            <w:top w:w="{top}" w:type="dxa"/>
            <w:bottom w:w="{bottom}" w:type="dxa"/>
            <w:left w:w="{left}" w:type="dxa"/>
            <w:right w:w="{right}" w:type="dxa"/>
        </w:tcMar>
    ''')
    tcPr.append(tcMar)

def set_cell_borders(cell, top="none", bottom="none", left="none", right="none", 
                     color="CBD5E1", size="8", left_color=None, top_color=None, bottom_color=None, right_color=None):
    tcPr = cell._element.get_or_add_tcPr()
    c_top = top_color or color
    c_bottom = bottom_color or color
    c_left = left_color or color
    c_right = right_color or color

    b_top = f'<w:top w:val="{top}" w:sz="{size}" w:space="0" w:color="{c_top}"/>' if top != "none" else '<w:top w:val="none"/>'
    b_bottom = f'<w:bottom w:val="{bottom}" w:sz="{size}" w:space="0" w:color="{c_bottom}"/>' if bottom != "none" else '<w:bottom w:val="none"/>'
    b_left = f'<w:left w:val="{left}" w:sz="{size}" w:space="0" w:color="{c_left}"/>' if left != "none" else '<w:left w:val="none"/>'
    b_right = f'<w:right w:val="{right}" w:sz="{size}" w:space="0" w:color="{c_right}"/>' if right != "none" else '<w:right w:val="none"/>'
    
    tcBorders = parse_xml(f'''
        <w:tcBorders {nsdecls("w")}>
            {b_top}
            {b_left}
            {b_bottom}
            {b_right}
        </w:tcBorders>
    ''')
    tcPr.append(tcBorders)

def create_khmer_document():
    doc = Document()
    for section in doc.sections:
        section.top_margin = Inches(0.9)
        section.bottom_margin = Inches(0.9)
        section.left_margin = Inches(0.9)
        section.right_margin = Inches(0.9)
        
        # Header
        header = section.header
        hp = header.paragraphs[0]
        hp.alignment = WD_ALIGN_PARAGRAPH.RIGHT
        hrun = hp.add_run("សមាគមគាំទ្រអ្នកជំងឺហេម៉ូហ្វីលាកម្ពុជា (CHA Cambodia)  •  chacambodia.org")
        set_khmer_font(hrun)
        hrun.font.size = Pt(8.5)
        hrun.font.color.rgb = RGB_MUTED

        # Footer
        footer = section.footer
        fp = footer.paragraphs[0]
        fp.alignment = WD_ALIGN_PARAGRAPH.RIGHT
        frun = fp.add_run("សៀវភៅណែនាំស្តីពីការគ្រប់គ្រង និងប្រតិបត្តិការគេហទំព័រ  |  ឯកសារសម្ងាត់ផ្លូវការ  |  ទំព័រ ")
        set_khmer_font(frun)
        frun.font.size = Pt(8.5)
        frun.font.color.rgb = RGB_MUTED

    return doc

def add_executive_cover_page_km(doc, title, subtitle, logo_path=None, meta_table=None):
    if logo_path and os.path.exists(logo_path):
        p_logo = doc.add_paragraph()
        p_logo.alignment = WD_ALIGN_PARAGRAPH.LEFT
        p_logo.paragraph_format.space_before = Pt(20)
        p_logo.paragraph_format.space_after = Pt(24)
        run_logo = p_logo.add_run()
        run_logo.add_picture(logo_path, width=Inches(3.2))

    # Divider bar
    p_div = doc.add_paragraph()
    p_div.paragraph_format.space_before = Pt(10)
    p_div.paragraph_format.space_after = Pt(16)
    r_div = p_div.add_run("―" * 32)
    set_khmer_font(r_div)
    r_div.font.size = Pt(14)
    r_div.font.bold = True
    r_div.font.color.rgb = RGB_SECONDARY

    # Title
    p_title = doc.add_paragraph()
    p_title.paragraph_format.space_before = Pt(0)
    p_title.paragraph_format.space_after = Pt(12)
    p_title.paragraph_format.line_spacing = 1.15
    run_title = p_title.add_run(title)
    set_khmer_font(run_title)
    run_title.font.size = Pt(24)
    run_title.font.bold = True
    run_title.font.color.rgb = RGB_PRIMARY

    # Subtitle
    p_sub = doc.add_paragraph()
    p_sub.paragraph_format.space_before = Pt(0)
    p_sub.paragraph_format.space_after = Pt(26)
    p_sub.paragraph_format.line_spacing = 1.25
    run_sub = p_sub.add_run(subtitle)
    set_khmer_font(run_sub)
    run_sub.font.size = Pt(11.5)
    run_sub.font.color.rgb = RGB_MUTED

    # Meta table
    if meta_table:
        table = doc.add_table(rows=len(meta_table), cols=2)
        table.alignment = WD_TABLE_ALIGNMENT.CENTER
        table.autofit = False
        
        for idx, (k, v) in enumerate(meta_table.items()):
            row = table.rows[idx]
            
            # Left cell
            c0 = row.cells[0]
            c0.width = Inches(2.2)
            set_cell_background(c0, "F1F5F9")
            set_cell_borders(c0, left="single", color=COLOR_PRIMARY, size="16", bottom="single")
            p0 = c0.paragraphs[0]
            p0.paragraph_format.space_before = Pt(0)
            p0.paragraph_format.space_after = Pt(0)
            r0 = p0.add_run(k)
            set_khmer_font(r0)
            r0.font.size = Pt(9.5)
            r0.font.bold = True
            r0.font.color.rgb = RGB_PRIMARY

            # Right cell
            c1 = row.cells[1]
            c1.width = Inches(4.5)
            set_cell_background(c1, "FFFFFF")
            set_cell_margins(c1, top=90, bottom=90, left=140, right=140)
            set_cell_borders(c1, bottom="single", color="E2E8F0")
            p1 = c1.paragraphs[0]
            p1.paragraph_format.space_before = Pt(0)
            p1.paragraph_format.space_after = Pt(0)
            r1 = p1.add_run(v)
            set_khmer_font(r1)
            r1.font.size = Pt(9.5)
            r1.font.color.rgb = RGB_TEXT

    doc.add_page_break()

def add_heading_1(doc, text):
    p = doc.add_paragraph()
    p.paragraph_format.space_before = Pt(22)
    p.paragraph_format.space_after = Pt(6)
    p.paragraph_format.keep_with_next = True
    run = p.add_run(text)
    set_khmer_font(run)
    run.font.size = Pt(16)
    run.font.bold = True
    run.font.color.rgb = RGB_PRIMARY
    return p

def add_heading_2(doc, text):
    p = doc.add_paragraph()
    p.paragraph_format.space_before = Pt(14)
    p.paragraph_format.space_after = Pt(4)
    p.paragraph_format.keep_with_next = True
    run = p.add_run(text)
    set_khmer_font(run)
    run.font.size = Pt(12.5)
    run.font.bold = True
    run.font.color.rgb = RGB_TEXT
    return p

def add_body_p(doc, text, bold_prefix=None, bullet=False):
    p = doc.add_paragraph()
    p.paragraph_format.space_before = Pt(0)
    p.paragraph_format.space_after = Pt(5)
    p.paragraph_format.line_spacing = 1.25
    if bullet:
        p.paragraph_format.left_indent = Inches(0.25)
        r_bullet = p.add_run("•  ")
        set_khmer_font(r_bullet)
        r_bullet.font.size = Pt(10)
        r_bullet.font.bold = True
        r_bullet.font.color.rgb = RGB_SECONDARY

    if bold_prefix:
        r_pre = p.add_run(bold_prefix + " ")
        set_khmer_font(r_pre)
        r_pre.font.size = Pt(10)
        r_pre.font.bold = True
        r_pre.font.color.rgb = RGB_TEXT
    run = p.add_run(text)
    set_khmer_font(run)
    run.font.size = Pt(10)
    run.font.color.rgb = RGB_TEXT
    return p

def add_step_card(doc, step_num, title, instructions):
    table = doc.add_table(rows=1, cols=2)
    table.alignment = WD_TABLE_ALIGNMENT.CENTER
    table.autofit = False

    # Step badge cell
    c0 = table.rows[0].cells[0]
    c0.width = Inches(1.1)
    set_cell_background(c0, "0B1D6D")
    set_cell_margins(c0, top=140, bottom=140, left=100, right=100)
    p0 = c0.paragraphs[0]
    p0.alignment = WD_ALIGN_PARAGRAPH.CENTER
    p0.paragraph_format.space_before = Pt(0)
    p0.paragraph_format.space_after = Pt(0)
    r0 = p0.add_run(f"ជំហាន\nទី {step_num}")
    set_khmer_font(r0)
    r0.font.size = Pt(10.5)
    r0.font.bold = True
    r0.font.color.rgb = RGB_WHITE

    # Instruction cell
    c1 = table.rows[0].cells[1]
    c1.width = Inches(5.6)
    set_cell_background(c1, "F8FAFC")
    set_cell_margins(c1, top=120, bottom=120, left=160, right=160)
    set_cell_borders(c1, top="single", bottom="single", right="single", color="E2E8F0")

    p1 = c1.paragraphs[0]
    p1.paragraph_format.space_before = Pt(0)
    p1.paragraph_format.space_after = Pt(4)
    r_title = p1.add_run(title)
    set_khmer_font(r_title)
    r_title.font.size = Pt(10.5)
    r_title.font.bold = True
    r_title.font.color.rgb = RGB_PRIMARY

    for inst in instructions:
        p_sub = c1.add_paragraph()
        p_sub.paragraph_format.space_before = Pt(0)
        p_sub.paragraph_format.space_after = Pt(2)
        p_sub.paragraph_format.line_spacing = 1.2
        r_inst = p_sub.add_run(f"→  {inst}")
        set_khmer_font(r_inst)
        r_inst.font.size = Pt(9.5)
        r_inst.font.color.rgb = RGB_TEXT

    # Spacer
    sp = doc.add_paragraph()
    sp.paragraph_format.space_before = Pt(0)
    sp.paragraph_format.space_after = Pt(6)

def add_callout(doc, text, title=None, alert_type="note"):
    border_color = COLOR_PRIMARY
    bg_color = "F1F5F9"
    icon = "ℹ️ "
    if alert_type == "important" or alert_type == "warning":
        border_color = COLOR_SECONDARY
        bg_color = "FEF2F2"
        icon = "⚠️ "
    elif alert_type == "success":
        border_color = COLOR_SUCCESS
        bg_color = "F0FDF4"
        icon = "✅ "

    table = doc.add_table(rows=1, cols=1)
    table.alignment = WD_TABLE_ALIGNMENT.CENTER
    table.autofit = False
    
    cell = table.cell(0, 0)
    cell.width = Inches(6.7)
    set_cell_background(cell, bg_color)
    set_cell_margins(cell, top=140, bottom=140, left=180, right=180)
    set_cell_borders(cell, left="single", color=border_color, size="28",
                     top="single", bottom="single", right="single", top_color="E2E8F0",
                     bottom_color="E2E8F0", right_color="E2E8F0")

    cp = cell.paragraphs[0]
    cp.paragraph_format.space_before = Pt(0)
    cp.paragraph_format.space_after = Pt(3)
    cp.paragraph_format.line_spacing = 1.25

    if title:
        rt = cp.add_run(icon + title + "\n")
        set_khmer_font(rt)
        rt.font.size = Pt(10)
        rt.font.bold = True
        rt.font.color.rgb = RGB_PRIMARY if alert_type != "important" and alert_type != "warning" else RGB_SECONDARY

    rb = cp.add_run(text)
    set_khmer_font(rb)
    rb.font.size = Pt(9.5)
    rb.font.color.rgb = RGB_TEXT

    sp = doc.add_paragraph()
    sp.paragraph_format.space_before = Pt(0)
    sp.paragraph_format.space_after = Pt(6)

def add_styled_table(doc, headers, rows):
    table = doc.add_table(rows=len(rows) + 1, cols=len(headers))
    table.alignment = WD_TABLE_ALIGNMENT.CENTER
    table.autofit = True

    # Style Header Row
    hdr_cells = table.rows[0].cells
    for i, h_text in enumerate(headers):
        hdr_cells[i].text = ""
        p = hdr_cells[i].paragraphs[0]
        p.paragraph_format.space_before = Pt(0)
        p.paragraph_format.space_after = Pt(0)
        run = p.add_run(h_text)
        set_khmer_font(run)
        run.font.size = Pt(9.5)
        run.font.bold = True
        run.font.color.rgb = RGB_WHITE
        set_cell_background(hdr_cells[i], COLOR_PRIMARY)
        set_cell_margins(hdr_cells[i], top=100, bottom=100, left=140, right=140)
        set_cell_borders(hdr_cells[i], bottom="single", color=COLOR_SECONDARY, size="16")

    # Data Rows
    for r_idx, row_data in enumerate(rows):
        row_cells = table.rows[r_idx + 1].cells
        bg_color = COLOR_SURFACE if r_idx % 2 == 1 else "FFFFFF"
        for c_idx, val in enumerate(row_data):
            row_cells[c_idx].text = ""
            p = row_cells[c_idx].paragraphs[0]
            p.paragraph_format.space_before = Pt(0)
            p.paragraph_format.space_after = Pt(0)
            p.paragraph_format.line_spacing = 1.2
            run = p.add_run(str(val))
            set_khmer_font(run)
            run.font.size = Pt(9)
            run.font.color.rgb = RGB_TEXT
            set_cell_background(row_cells[c_idx], bg_color)
            set_cell_margins(row_cells[c_idx], top=80, bottom=80, left=140, right=140)
            set_cell_borders(row_cells[c_idx], bottom="single", color="E2E8F0")

    sp = doc.add_paragraph()
    sp.paragraph_format.space_before = Pt(0)
    sp.paragraph_format.space_after = Pt(8)


def generate_khmer_manual():
    doc = create_khmer_document()

    # 1. Executive Cover Page with Official Logo
    logo_path = os.path.abspath("cha-cambodia-theme/cha-logo-left.png")
    meta_info = {
        "ស្ថាប័ន": "សមាគមគាំទ្រអ្នកជំងឺហេម៉ូហ្វីលាកម្ពុជា (CHA Cambodia)",
        "ចំណងជើងឯកសារ": "សៀវភៅណែនាំស្តីពីការគ្រប់គ្រង និងប្រតិបត្តិការគេហទំព័រ",
        "កំណែឯកសារ": "កំណែ ១.០.០ — សៀវភៅណែនាំប្រតិបត្តិការផ្លូវការ",
        "គេហទំព័រសាធារណៈ": "https://chacambodia.org",
        "ទំព័រគ្រប់គ្រង (Admin)": "https://chacambodia.org/wp-admin",
        "ប្រព័ន្ធបង្ហោះ (Hosting)": "Namecheap Stellar Business (CloudLinux + LiteSpeed + cPanel)",
        "កាលបរិច្ឆេទបោះផ្សាយ": "ខែកញ្ញា ឆ្នាំ២០២៦",
        "អ្នកមានសិទ្ធិប្រើប្រាស់": "ថ្នាក់ដឹកនាំប្រតិបត្តិ ក្រុមការងារប្រតិបត្តិការ និងអ្នកគ្រប់គ្រងមាតិកា",
    }
    add_executive_cover_page_km(
        doc,
        "CHA Cambodia — សៀវភៅណែនាំស្តីពីការគ្រប់គ្រង និងប្រតិបត្តិការគេហទំព័រ",
        "មគ្គុទ្ទេសក៍មេពេញលេញស្តីពីការចូលគ្រប់គ្រង WordPress ការចុះផ្សាយព័ត៌មាន ការគ្រប់គ្រងយុទ្ធនាការ ការកែប្រែទិន្នន័យ ការទូទាត់ប្រាក់បរិច្ចាគ និងការថែទាំប្រព័ន្ធគេហទំព័រ",
        logo_path=logo_path,
        meta_table=meta_info
    )

    # Table of Contents Overview Callout
    add_callout(
        doc,
        "ឯកសារមគ្គុទ្ទេសក៍កម្រិតខ្ពស់នេះ គឺជាប្រភពព័ត៌មានផ្លូវការតែមួយគត់ សម្រាប់ការគ្រប់គ្រង ថែទាំ និងដំណើរការគេហទំព័រ chacambodia.org។ ឯកសារនេះត្រូវបានរៀបចំឡើងយ៉ាងក្បោះក្បាយ ច្បាស់លាស់ និងងាយយល់សម្រាប់ថ្នាក់ដឹកនាំ និងបុគ្គលិកប្រតិបត្តិការ (ទោះបីជាគ្មានជំនាញសរសេរកូដក៏ដោយ)។ សូមអនុវត្តតាមកាតជំហាននីមួយៗ ដើម្បីធ្វើបច្ចុប្បន្នភាពព័ត៌មាន បោះផ្សាយព័ត៌មាន និងយុទ្ធនាការ ពិនិត្យការបរិច្ចាគ គ្រប់គ្រងសមាជិក និងការពារសុវត្ថិភាពគេហទំព័រ។",
        title="សេចក្តីសង្ខេបប្រតិបត្តិ និងវិសាលភាពនៃការគ្រប់គ្រង",
        alert_type="note"
    )

    # -------------------------------------------------------------
    # SECTION 1: SYSTEM ARCHITECTURE & BRAND SYSTEM
    # -------------------------------------------------------------
    add_heading_1(doc, "១. ទិដ្ឋភាពទូទៅ និងរចនាសម្ព័ន្ធបច្ចេកវិទ្យាគេហទំព័រ")
    add_body_p(doc, "គេហទំព័ររបស់សមាគមគាំទ្រអ្នកជំងឺហេម៉ូហ្វីលាកម្ពុជា (chacambodia.org) គឺជាច្រកទ្វារឌីជីថលដ៏ចម្បងក្នុងការតភ្ជាប់អ្នកជំងឺ ក្រុមគ្រួសារ វេជ្ជបណ្ឌិតជំនាញ សប្បុរសជន និងសហព័ន្ធអន្តរជាតិ។ ប្រព័ន្ធនេះត្រូវបានបង្កើតឡើងដោយផ្តោតលើសុវត្ថិភាពខ្ពស់ ល្បឿនផ្ទុកទំព័រលឿន ប្រព័ន្ធទូទាត់ប្រាក់បរិច្ចាគច្រើនរូបិយប័ណ្ណ និងការគាំទ្រពីរភាសា (ខ្មែរ និងអង់គ្លេស) យ៉ាងរលូន។")

    add_heading_2(doc, "១.១ សង្ខេបហេដ្ឋារចនាសម្ព័ន្ធបច្ចេកវិទ្យា")
    tech_headers = ["ស្រទាប់បច្ចេកវិទ្យា", "អ្នកផ្តល់សេវា", "ការកំណត់រចនាសម្ព័ន្ធ និងតួនាទីប្រតិបត្តិការ"]
    tech_rows = [
        ["Domain & DNS", "Namecheap DNS", "ឈ្មោះគេហទំព័រ chacambodia.org ភ្ជាប់ជាមួយ SSL (HTTPS) ដោយស្វ័យប្រវត្តិ"],
        ["ម៉ាស៊ីនបម្រើ (Hosting)", "Namecheap Stellar Business", "CloudLinux OS, ម៉ាស៊ីនបម្រើ LiteSpeed Enterprise, cPanel"],
        ["គ្រប់គ្រងមាតិកា (CMS)", "WordPress 6.x Core", "ប្រើប្រាស់ Theme ផ្ទាល់ខ្លួនកម្រិតស្ដង់ដារ៖ 'cha-cambodia-theme'"],
        ["មូលដ្ឋានទិន្នន័យ (DB)", "MySQL / MariaDB", "មូលដ្ឋានទិន្នន័យរួមតែមួយ រក្សាទុកអត្ថបទ សមាជិក និងការបរិច្ចាគ"],
        ["ច្រកទូទាត់ប្រាក់ (Payment)", "ABA PayWay (ធនាគារ ABA)", "ប្រព័ន្ធ REST API បង្កើត KHQR និង ABA Pay ភ្លាមៗក្នុងពេលជាក់ស្តែង"],
        ["ប្រព័ន្ធផ្ញើអ៊ីមែល (SMTP)", "Brevo SMTP (Port 587)", "បញ្ជូនអ៊ីមែលផ្ទៀងផ្ទាត់ និងកំណត់លេខសម្ងាត់ពី noreply@chacambodia.org"],
        ["ការចម្លងទុកបម្រុង (Backup)", "UpdraftPlus -> Google Drive", "ភ្ជាប់ទៅ Google Drive (គណនី Nexus Digital Support ទំហំ ៥ TB)"],
    ]
    add_styled_table(doc, tech_headers, tech_rows)

    add_heading_2(doc, "១.២ ស្តង់ដារពណ៌ និងអត្តសញ្ញាណម៉ាកសញ្ញា (Brand Colors)")
    add_body_p(doc, "ដើម្បីរក្សាភាពថ្លៃថ្នូរ វិជ្ជាជីវៈវេជ្ជសាស្ត្រ និងភាពកក់ក្តៅរបស់ CHA Cambodia រាល់ធាតុផ្សំទាំងអស់នៃគេហទំព័រត្រូវបានរចនាឡើងយ៉ាងម៉ត់ចត់ទៅតាមកូដពណ៌ដូចខាងក្រោម៖")
    color_headers = ["ឈ្មោះពណ៌ផ្លូវការ", "កូដពណ៌ Hex", "តម្លៃ RGB", "ការប្រើប្រាស់នៅលើគេហទំព័រ"]
    color_rows = [
        ["CHA Royal Navy", "#0B1D6D", "rgb(11, 29, 109)", "ចំណងជើងទំព័រចម្បង, របាររុករក (Nav), ប៊ូតុងសកម្មភាពចម្បង, កាតពណ៌ទឹកប៊ិច"],
        ["CHA Crimson Red", "#E31E24", "rgb(227, 30, 36)", "ប៊ូតុងទឹកប្រាក់បរិច្ចាគដែលបានជ្រើស, ស្លាកបេះដូង, សញ្ញាសម្គាល់ផ្ទាំងសកម្ម"],
        ["CHA Royal Purple", "#6A2C91", "rgb(106, 44, 145)", "ផ្នែកសហគមន៍, រង្វង់ដៃគូសហការ, ផ្ទៃខាងក្រោយជម្រាលពណ៌"],
        ["Emerald Green", "#22C55E", "rgb(34, 197, 94)", "ចំណុចភ្លើងបៃតងបញ្ជាក់ពីបេសកកម្មផ្ទាល់, សញ្ញាធីកសុវត្ថិភាព, ផ្ទាំងជោគជ័យ"],
        ["Charcoal Slate", "#1E293B", "rgb(30, 41, 59)", "អត្ថបទតួសេចក្តីទូទៅ, អក្សរក្នុងប្រអប់បំពេញទម្រង់, ស្លាកព័ត៌មាន"],
        ["Border Slate", "#CBD5E1", "rgb(203, 213, 225)", "បន្ទាត់ខណ្ឌប្រអប់, បន្ទាត់តារាង, បន្ទាត់ស៊ុមព័ទ្ធជុំវិញកាត"],
    ]
    add_styled_table(doc, color_headers, color_rows)


    # -------------------------------------------------------------
    # SECTION 2: ACCESS & USER MANAGEMENT
    # -------------------------------------------------------------
    add_heading_1(doc, "២. ការចូលប្រើប្រាស់ និងការគ្រប់គ្រងគណនីអ្នកប្រើប្រាស់")
    add_body_p(doc, "រាល់កិច្ចការគ្រប់គ្រងគេហទំព័រទាំងអស់ គឺត្រូវធ្វើឡើងតាមរយៈផ្ទាំងគ្រប់គ្រង WordPress Administration Dashboard ដែលមានសុវត្ថិភាពខ្ពស់។ សូមថែរក្សាព័ត៌មានសម្ងាត់នៃការចូលប្រើប្រាស់ឱ្យបានហ្មត់ចត់បំផុត។")

    add_heading_2(doc, "២.១ ជំហាននៃការចូលទៅកាន់ផ្ទាំងគ្រប់គ្រង WordPress")
    add_step_card(
        doc,
        "១",
        "បើកទំព័រគ្រប់គ្រង (Admin Portal)",
        [
            "បើកកម្មវិធីរុករកអ៊ីនធឺណិត (Google Chrome, Safari, Microsoft Edge ឬ Brave)។",
            "វាយបញ្ចូលអាសយដ្ឋាននៅក្នុងប្រអប់ URL៖ https://chacambodia.org/wp-admin",
            "សូមរក្សាទុកទំព័រនេះ (Bookmark) ទុកសម្រាប់ងាយស្រួលបើកប្រើប្រាស់ប្រចាំថ្ងៃ។"
        ]
    )
    add_step_card(
        doc,
        "២",
        "បំពេញឈ្មោះគណនី និងពាក្យសម្ងាត់",
        [
            "បំពេញឈ្មោះអ្នកប្រើប្រាស់ (Username) ឬ អាសយដ្ឋានអ៊ីមែល ក្នុងប្រអប់ទី១។",
            "បំពេញពាក្យសម្ងាត់សុវត្ថិភាព ក្នុងប្រអប់ទី២។",
            "ធីកលើប្រអប់ 'Remember Me' ប្រសិនបើប្រើប្រាស់កុំព្យូទ័រផ្ទាល់ខ្លួនដែលមានសុវត្ថិភាព។",
            "ចុចប៊ូតុងពណ៌ខៀវ 'Log In' ដើម្បីចូលទៅកាន់ផ្ទាំងគ្រប់គ្រង។"
        ]
    )

    add_callout(
        doc,
        "វិធីសាស្ត្រដោះស្រាយនៅពេលភ្លេចពាក្យសម្ងាត់៖ ប្រសិនបើលោកអ្នកមិនអាចចូលបានទេ សូមចុចលើពាក្យ 'Lost your password?' នៅខាងក្រោមប្រអប់បំពេញ។ បន្ទាប់មក វាយបញ្ចូលអាសយដ្ឋានអ៊ីមែលដែលបានចុះឈ្មោះ ហើយប្រព័ន្ធនឹងផ្ញើតំណភ្ជាប់សម្រាប់កំណត់ពាក្យសម្ងាត់ថ្មីទៅកាន់អ៊ីមែលរបស់អ្នកភ្លាមៗ។ ប្រសិនបើមិនឃើញក្នុងប្រអប់ Inbox ក្នុងរយៈពេល ២ នាទីទេ សូមពិនិត្យមើលក្នុងប្រអប់ Spam/Junk។",
        title="ការដោះស្រាយបញ្ហាពាក្យសម្ងាត់",
        alert_type="note"
    )

    add_heading_2(doc, "២.២ ការស្វែងយល់អំពីតួនាទី និងសិទ្ធិរបស់អ្នកគ្រប់គ្រង")
    add_body_p(doc, "WordPress ផ្តល់នូវកម្រិតសុវត្ថិភាព និងសិទ្ធិខុសៗគ្នា។ បុគ្គលិកគួរតែទទួលបានសិទ្ធិតាមការចាំបាច់នៃភារកិច្ចរបស់ខ្លួនប៉ុណ្ណោះ៖")
    role_headers = ["ឈ្មោះតួនាទី", "ស័ក្តិសមសម្រាប់", "សិទ្ធិ និងលទ្ធភាពអនុវត្តលើប្រព័ន្ធ"]
    role_rows = [
        ["Administrator (អ្នកគ្រប់គ្រងកំពូល)", "នាយកប្រតិបត្តិ, ប្រធានផ្នែក IT", "សិទ្ធិពេញលេញ៖ អាប់ដេត Theme, កំណត់ប្រព័ន្ធទូទាត់ប្រាក់, ដំឡើង Plugin, បង្កើតគណនី"],
        ["Editor (អ្នកកែសម្រួលមាតិកា)", "ប្រធានផ្នែកទំនាក់ទំនង និងព័ត៌មាន", "អាចសរសេរ បោះផ្សាយ កែសម្រួល និងលុបព័ត៌មាន ព្រឹត្តិការណ៍ យុទ្ធនាការ និងទំព័រនានា"],
        ["Author (អ្នកនិពន្ធអត្ថបទ)", "បុគ្គលិកសរសេរព័ត៌មាន", "អាចសរសេរ និងបោះផ្សាយអត្ថបទព័ត៌មានផ្ទាល់ខ្លួន និងបញ្ចូលរូបភាពកម្មវិធីផ្សេងៗ"],
        ["Subscriber / Member (សមាជិក)", "សាធារណជនទូទៅ / អ្នកជំងឺ", "សម្រាប់តែមើលព័ត៌មាន និងប្រើប្រាស់កាតសមាជិកឌីជីថលផ្ទាល់ខ្លួនប៉ុណ្ណោះ"],
    ]
    add_styled_table(doc, role_headers, role_rows)


    # -------------------------------------------------------------
    # SECTION 3: CONTENT MANAGEMENT
    # -------------------------------------------------------------
    add_heading_1(doc, "៣. ការគ្រប់គ្រងមាតិកា — របៀបកែប្រែព័ត៌មានដោយមិនចាំបាច់ចេះកូដ")
    add_body_p(doc, "គេហទំព័រត្រូវបានរៀបចំឡើងយ៉ាងពិសេស ដើម្បីឱ្យរាល់កិច្ចការទំនាក់ទំនងប្រចាំថ្ងៃ — រាប់ចាប់ពីការចុះផ្សាយសិក្ខាសាលាវេជ្ជសាស្ត្រ រហូតដល់ការផ្លាស់ប្តូរលេខទូរស័ព្ទ — អាចធ្វើឡើងបានយ៉ាងងាយស្រួលដោយមិនបាច់ប៉ះពាល់កូដសូម្បីតែមួយតួអក្សរឡើយ។")

    add_heading_2(doc, "៣.១ ការចុះផ្សាយព័ត៌មាន និងព្រឹត្តិការណ៍ ('cha_news')")
    add_body_p(doc, "ផ្នែកព័ត៌មាន និងព្រឹត្តិការណ៍អនុញ្ញាតឱ្យសមាគមចែករំលែកសកម្មភាពថ្មីៗទៅកាន់សប្បុរសជន ដៃគូអន្តរជាតិ និងអ្នកជំងឺ។ នៅលើទំព័រដើម (Homepage) នឹងបង្ហាញអត្ថបទចុងក្រោយចំនួន ៣ ដោយស្វ័យប្រវត្តិ ហើយប្រវត្តិនៃអត្ថបទចាស់ៗទាំងអស់នឹងត្រូវរក្សាទុកនៅលើទំព័រ chacambodia.org/news។")

    add_step_card(
        doc,
        "១",
        "បង្កើតអត្ថបទព័ត៌មានថ្មី",
        [
            "នៅលើរបារម៉ឺនុយខាងឆ្វេង ដាក់ Mouse លើពាក្យ 'News & Events' រួចចុចលើ 'Add New Post'។",
            "បំពេញចំណងជើងអត្ថបទឱ្យបានច្បាស់លាស់នៅខាងលើបង្អស់ (ឧទាហរណ៍៖ 'សិក្ខាសាលាលើកកម្ពស់ការយល់ដឹងអំពីជំងឺហេម៉ូហ្វីលីយ៉ាពិភពលោក ឆ្នាំ២០២៦ នៅខេត្តសៀមរាប')។"
        ]
    )
    add_step_card(
        doc,
        "២",
        "សរសេរខ្លឹមសារ និងបញ្ចូលរូបភាព",
        [
            "ចុចលើផ្ទាំងសរសេរអត្ថបទចម្បង ដើម្បីវាយបញ្ចូល ឬចម្លងខ្លឹមសារអត្ថបទរបស់អ្នកដាក់ចូល។",
            "ដើម្បីដាក់រូបភាពក្នុងអត្ថបទ សូមចុចលើសញ្ញា '+' រួចជ្រើសរើស 'Image' ហើយ Upload រូបភាពពីកុំព្យូទ័រ។",
            "រៀបចំកថាខណ្ឌឱ្យមានរបៀប ដោយប្រើចំណងជើងរង និងសញ្ញាចុច (Bullets) ដើម្បីងាយស្រួលអាន។"
        ]
    )
    add_step_card(
        doc,
        "៣",
        "កំណត់រូបភាពតំណាង (Featured Image) និងជ្រើសរើសប្រភេទស្លាក (Category)",
        [
            "នៅផ្ទាំងចំហៀងខាងស្តាំ អូសចុះក្រោមទៅរក 'Featured Image' រួចចុច 'Set featured image' (ទំហំដែលណែនាំ៖ 1200x800px)។",
            "អូសទៅរក 'News Category' ហើយធីកជ្រើសរើសស្លាកមួយក្នុងចំណោម ៤៖ Event (ព្រឹត្តិការណ៍), Workshop (សិក្ខាសាលា), Update (បច្ចុប្បន្នភាព), ឬ Announcement (សេចក្តីជូនដំណឹង)។",
            "ចុចប៊ូតុងពណ៌ខៀវ 'Publish' នៅផ្នែកខាងលើស្តាំ។ អត្ថបទនឹងបង្ហាញនៅលើទំព័រដើម និងទំព័រ /news ភ្លាមៗ!"
        ]
    )

    add_heading_2(doc, "៣.២ ការធ្វើបច្ចុប្បន្នភាពយុទ្ធនាការរៃអង្គាសថវិកា ('cha_campaigns')")
    add_body_p(doc, "នៅលើទំព័រដើមមានផ្ទាំង Current Campaigns ដែលបង្ហាញពីយុទ្ធនាការរៃអង្គាសសកម្មនានា (ដូចជា៖ ការឧបត្ថម្ភអ្នកជំងឺ, ការអប់រំ និងការយល់ដឹង, ជំនួយសង្គ្រោះបន្ទាន់)។")
    add_body_p(doc, "ដើម្បីកែប្រែចំនួនថវិកាដែលប្រមូលបាន ឬបន្ថែមយុទ្ធនាការថ្មី៖", bold_prefix="ការណែនាំលម្អិត៖")
    add_body_p(doc, "១. នៅលើម៉ឺនុយខាងឆ្វេង ចុចលើពាក្យ 'Campaigns' -> 'All Campaigns'។", bullet=True)
    add_body_p(doc, "២. ចុចលើឈ្មោះយុទ្ធនាការដែលលោកអ្នកចង់កែប្រែ (ឧទាហរណ៍៖ 'Patient Support Funding')។", bullet=True)
    add_body_p(doc, "៣. ស្វែងរកប្រអប់ 'Campaign Target Details'៖", bullet=True)
    add_body_p(doc, "   • Raised Amount ($)៖ វាយបញ្ចូលចំនួនទឹកប្រាក់ដែលទទួលបានបច្ចុប្បន្ន (ឧទាហរណ៍៖ 5000)។", bullet=True)
    add_body_p(doc, "   • Goal Amount ($)៖ វាយបញ្ចូលចំនួនទឹកប្រាក់គោលដៅសរុប (ឧទាហរណ៍៖ 20000)។", bullet=True)
    add_body_p(doc, "   • Theme Color៖ ជ្រើសរើសពណ៌សម្រាប់យុទ្ធនាការ (ក្រហម ខៀវ ឬស្វាយ)។", bullet=True)
    add_body_p(doc, "   • Card Icon៖ ជ្រើសរើសរូបតំណាង (បេះដូង មួកបរិញ្ញាបត្រ ឬរលកជីពចរ)។", bullet=True)
    add_body_p(doc, "៤. ចុចប៊ូតុង 'Update'។ របារវឌ្ឍនភាព និងភាគរយនៅលើគេហទំព័រនឹងគណនាឡើងវិញដោយស្វ័យប្រវត្តិភ្លាមៗ!", bullet=True)

    add_heading_2(doc, "៣.៣ ការកែប្រែលេខទូរស័ព្ទ អ៊ីមែល អាសយដ្ឋាន និងទិន្នន័យស្ថិតិ (Customizer)")
    add_body_p(doc, "នៅពេលសមាគមផ្លាស់ប្តូរទីតាំងការិយាល័យ លេខទូរស័ព្ទ អ៊ីមែល ឬស្ថិតិអ្នកជំងឺ លោកអ្នកអាចកែប្រែតាមរយៈផ្ទាំង Live Customizer ដោយផ្ទាល់៖")
    add_step_card(
        doc,
        "១",
        "បើកផ្ទាំង Visual Customizer",
        [
            "នៅក្នុងផ្ទាំង WordPress Admin ចូលទៅកាន់៖ Appearance -> Customize។",
            "នៅលើរបារចំហៀងខាងឆ្វេង សូមចុចលើពាក្យ 'CHA Theme Options'។"
        ]
    )
    add_step_card(
        doc,
        "២",
        "កែប្រែព័ត៌មានទំនាក់ទំនង និងតួលេខស្ថិតិ",
        [
            "Contact Phone : ផ្លាស់ប្តូរលេខទូរស័ព្ទទាក់ទងចុងក្រោយ (បច្ចុប្បន្ន៖ +855 96 260 5335)។",
            "Contact Email : ផ្លាស់ប្តូរអ៊ីមែលផ្លូវការ (បច្ចុប្បន្ន៖ choryee.hun@gmail.com)។",
            "Office Address : កែប្រែអាសយដ្ឋានការិយាល័យផ្ទាល់ (បច្ចុប្បន្ន៖ #100, មហាវិថីសហព័ន្ធរុស្ស៊ី, រាជធានីភ្នំពេញ)។",
            "Statistics Counters : កែប្រែស្ថិតិ 'រាជធានី/ខេត្ត' (25), 'អ្នកជំងឺហេម៉ូហ្វីលីយ៉ា' (500+), ឬ 'ដៃគូសហការ' (15+)។",
            "ចុចប៊ូតុងពណ៌ខៀវ 'Publish' នៅផ្នែកខាងលើនៃ Customizer ដើម្បីរក្សាទុកការកែប្រែ។"
        ]
    )

    add_heading_2(doc, "៣.៤ ការគ្រប់គ្រងទំព័រគោលការណ៍ច្បាប់កាតព្វកិច្ច")
    add_body_p(doc, "ច្រកទូទាត់ប្រាក់ពាណិជ្ជកម្ម (រួមទាំងធនាគារ ABA) តម្រូវឱ្យគេហទំព័រត្រូវតែមានទំព័រគោលការណ៍ច្បាប់ច្បាស់លាស់។ គេហទំព័រមានទំព័រគោលការណ៍ច្បាប់ផ្លូវការពីរភាសាចំនួន ៣៖")
    add_body_p(doc, "• លក្ខខណ្ឌប្រើប្រាស់ និងគោលការណ៍សងប្រាក់ក្នុងរយៈពេល ៣០ ថ្ងៃ (URL: chacambodia.org/terms)៖ ពន្យល់ពីគោលការណ៍បរិច្ចាគ ការចេញបង្កាន់ដៃទទួលប្រាក់ និងទំនាក់ទំនងសម្រាប់ការសាកសួរប្រតិបត្តិការ។", bullet=True)
    add_body_p(doc, "• គោលនយោបាយឯកជនភាព (URL: chacambodia.org/privacy)៖ លម្អិតអំពីរបៀបដែលទិន្នន័យសមាជិក និងសប្បុរសជនត្រូវបានការពារស្របតាមច្បាប់នៃព្រះរាជាណាចក្រកម្ពុជា។", bullet=True)
    add_body_p(doc, "• សេចក្តីប្រកាសមិនទទួលខុសត្រូវផ្នែកវេជ្ជសាស្ត្រ (URL: chacambodia.org/disclaimer)៖ បញ្ជាក់យ៉ាងច្បាស់ថា ព័ត៌មាននៅលើគេហទំព័រមិនអាចជំនួសការពិគ្រោះយោបល់ និងការព្យាបាលផ្ទាល់ជាមួយគ្រូពេទ្យជំនាញឡើយ។", bullet=True)


    # -------------------------------------------------------------
    # SECTION 4: ABA PAYWAY GATEWAY & DONATIONS
    # -------------------------------------------------------------
    add_heading_1(doc, "៤. ប្រព័ន្ធទូទាត់ប្រាក់បរិច្ចាគតាមរយៈ ABA PayWay")
    add_body_p(doc, "ការបរិច្ចាគគឺជាប្រភពថវិកាដ៏សំខាន់សម្រាប់ទ្រទ្រង់សកម្មភាពសង្គ្រោះជីវិតរបស់ CHA Cambodia។ គេហទំព័រត្រូវបានភ្ជាប់ដោយផ្ទាល់ទៅកាន់ប្រព័ន្ធ ABA PayWay របស់ធនាគារ ABA ដែលផ្តល់នូវការទូទាត់ប្រាក់ភ្លាមៗ និងមានសុវត្ថិភាពខ្ពស់តាមរយៈ Bakong KHQR, ABA Mobile និងកាតធនាគារអន្តរជាតិ។")

    add_heading_2(doc, "៤.១ ដំណើរការនៃការបរិច្ចាគរបស់សប្បុរសជន")
    add_body_p(doc, "១. សប្បុរសជនចូលមកកាន់ទំព័រដើម រួចមើលឃើញផ្ទាំង 'Make a Donation' ឬចុចលើប៊ូតុង 'Donate Now' ពីទំព័រណាមួយ។")
    add_body_p(doc, "២. ពួកគាត់ជ្រើសរើសចំនួនទឹកប្រាក់កំណត់ស្រាប់ ($10, $25, $50, $100) ឬចុចលើពាក្យ 'Other' ដើម្បីវាយបញ្ចូលចំនួនទឹកប្រាក់ផ្ទាល់ខ្លួន។")
    add_body_p(doc, "៣. ពួកគាត់អាចបំពេញឈ្មោះ អ៊ីមែល និងលេខទូរស័ព្ទ (ជាជម្រើស)។")
    add_body_p(doc, "៤. នៅពេលចុចលើប៊ូតុង 'Donate Now' គេហទំព័រនឹងធ្វើការបម្លែងកូដសុវត្ថិភាពដោយប្រើហត្ថលេខាឌីជីថល HMAC-SHA512 ហើយបញ្ជូនទិន្នន័យទៅកាន់ ABA PayWay។")
    add_body_p(doc, "៥. ផ្ទាំងទូទាត់ប្រាក់ផ្លូវការរបស់ ABA នឹងបង្ហាញកូដ KHQR សុវត្ថិភាពនៅលើអេក្រង់របស់សប្បុរសជន។")
    add_body_p(doc, "៦. បន្ទាប់ពីស្កេនទូទាត់ប្រាក់រួច ប្រព័ន្ធស្វ័យប្រវត្តិនឹងទទួលបានលេខកូដបញ្ជាក់ការទូទាត់ (APV) ពីធនាគារ ABA ហើយកត់ត្រាទុកក្នុងតារាងទិន្នន័យ wp_cha_donations ដោយស្វ័យប្រវត្តិ។")

    add_callout(
        doc,
        "ការពន្យល់សំខាន់ផ្នែកធនាគារ៖ ភាពខុសគ្នារវាងប្រព័ន្ធតេស្ត (SANDBOX) និងលុយពិត (LIVE PRODUCTION) — នៅក្នុងអំឡុងពេលតេស្តសាកល្បងលើប្រព័ន្ធ Sandbox ប្រសិនបើលោកអ្នកយកកម្មវិធី ABA Mobile ពិតប្រាកដ (លុយពិត) ទៅស្កេនលើកូដ QR តេស្ត នោះកម្មវិធីធនាគារនឹងបង្ហាញសារកំហុសថា៖ 'Transaction not found'។ នេះគឺជាដំណើរការត្រឹមត្រូវ និងជាស្តង់ដារបច្ចេកទេសរបស់ធនាគារទាំងអស់៖ កម្មវិធីធនាគារពិតប្រាកដដែលមានលុយពិត គឺអាចស្គាល់តែប្រតិបត្តិការ LIVE Production តែប៉ុណ្ណោះ។ ការដែលផ្ទាំង KHQR របស់ ABA បង្ហាញឡើងនៅលើអេក្រង់បានជោគជ័យ គឺបញ្ជាក់ថាប្រព័ន្ធ API, សោសម្ងាត់ (Keys) និងការតភ្ជាប់ជាមួយធនាគារដំណើរការយ៉ាងល្អឥតខ្ចោះ ១០០% ហើយ!",
        title="ការពន្យល់សំខាន់អំពីច្រកទូទាត់ធនាគារ ABA",
        alert_type="warning"
    )

    add_heading_2(doc, "៤.២ ជំហាននៃការបើកដំណើរការទទួលលុយពិត (កិច្ចការដែលថ្នាក់ដឹកនាំត្រូវអនុវត្ត)")
    add_body_p(doc, "នៅពេលធនាគារ ABA អនុម័តកិច្ចសន្យាអាជីវកម្មរបស់សមាគមរួចរាល់ និងផ្តល់ព័ត៌មានគណនី Live Production ផ្លូវការ ការបើកដំណើរការទទួលលុយពិតនៅលើគេហទំព័រចំណាយពេលត្រឹមតែ ៦០ វិនាទីប៉ុណ្ណោះ៖")
    add_step_card(
        doc,
        "១",
        "បើកទំព័រកំណត់ច្រកទូទាត់ PayWay",
        [
            "ចូលទៅកាន់ផ្ទាំង WordPress Admin៖ https://chacambodia.org/wp-admin",
            "នៅលើម៉ឺនុយខាងឆ្វេង ចូលទៅកាន់៖ Settings -> CHA PayWay។"
        ]
    )
    add_step_card(
        doc,
        "២",
        "បំពេញព័ត៌មានគណនី Live របស់ធនាគារ ABA",
        [
            "Merchant ID : ចម្លងដាក់បញ្ចូល Merchant ID ផ្លូវការដែលទទួលបានពីធនាគារ ABA។",
            "API Key (Public Key) : ចម្លងដាក់បញ្ចូល API Public Key ផ្លូវការរបស់ធនាគារ ABA។",
            "Gateway Environment : ប្តូរពីពាក្យ 'Sandbox' ទៅជា 'Live / Production'។",
            "ចុចប៊ូតុងពណ៌ខៀវ 'Save Changes'។",
            "ជម្រះ LiteSpeed Cache (Purge All) ដូចមានណែនាំក្នុងចំណុច ៦.២។ ប្រព័ន្ធទទួលប្រាក់បរិច្ចាគពិតប្រាកដនឹងដំណើរការភ្លាមៗ!"
        ]
    )


    # -------------------------------------------------------------
    # SECTION 5: MEMBER PORTAL & DIGITAL PATIENT CARDS
    # -------------------------------------------------------------
    add_heading_1(doc, "៥. ប្រព័ន្ធសមាជិកភាព និងកាតអត្តសញ្ញាណអ្នកជំងឺឌីជីថល")
    add_body_p(doc, "CHA Cambodia ផ្តល់ជូននូវប្រព័ន្ធសមាជិកភាពស្វ័យសេវា ដែលអនុញ្ញាតឱ្យអ្នកជំងឺ ក្រុមគ្រួសារ និងអ្នកគាំទ្រអាចចុះឈ្មោះ ផ្ទៀងផ្ទាត់អ៊ីមែល និងទាញយកកាតអត្តសញ្ញាណឌីជីថលផ្លូវការបានដោយខ្លួនឯង។")

    add_heading_2(doc, "៥.១ ដំណើរការចុះឈ្មោះ និងការផ្ញើអ៊ីមែលតាម Brevo SMTP")
    add_body_p(doc, "• អ្នកប្រើប្រាស់ចុះឈ្មោះដោយចុចលើប៊ូតុង 'Become a Member' ឬ 'Register' រួចបំពេញ ឈ្មោះ, អ៊ីមែល, ពាក្យសម្ងាត់ និងតួនាទី (សមាជិកទូទៅ ឬអ្នកជំងឺ)។")
    add_body_p(doc, "• ដើម្បីការពារគណនីក្លែងបន្លំ គណនីដែលទើបបង្កើតថ្មីមិនទាន់អាចប្រើប្រាស់បានភ្លាមៗទេ លុះត្រាតែអ្នកប្រើប្រាស់ចូលទៅកាន់អ៊ីមែលរបស់ខ្លួន ហើយចុចលើតំណភ្ជាប់ផ្ទៀងផ្ទាត់ (Verification link)។")
    add_body_p(doc, "• អ៊ីមែលផ្ទៀងផ្ទាត់ត្រូវបានបញ្ជូនតាមរយៈប្រព័ន្ធ Brevo SMTP (ផ្ញើចេញពី noreply@chacambodia.org) ដែលធានាថាអ៊ីមែលនឹងធ្លាក់ចូលក្នុងប្រអប់ Inbox ជានិច្ច ដោយមិនចូលក្នុង Spam ឡើយ។")

    add_heading_2(doc, "៥.២ អត្ថប្រយោជន៍ និងសមត្ថភាពនៃកាតសមាជិកឌីជីថល")
    add_body_p(doc, "នៅពេលសមាជិកដែលបានផ្ទៀងផ្ទាត់រួច ចូលប្រើប្រាស់គណនីនៅលើ chacambodia.org៖")
    add_body_p(doc, "• ពួកគាត់អាចចូលទៅកាន់ផ្ទាំងគ្រប់គ្រងផ្ទាល់ខ្លួន (Membership Dashboard)។", bullet=True)
    add_body_p(doc, "• ផ្ទាំងគ្រប់គ្រងនឹងបង្កើត កាតសមាជិកឌីជីថល (Digital Membership Card) ផ្លូវការដែលមានបង្ហាញ៖ ឈ្មោះពេញរបស់អ្នកជំងឺ, លេខសម្គាល់សមាជិក CHA ផ្ទាល់ខ្លួន, ការធ្វើរោគវិនិច្ឆ័យវេជ្ជសាស្ត្រ (ឧទាហរណ៍៖ Severe Hemophilia A, Factor VIII Deficiency), ប្រភេទឈាម និងលេខទូរស័ព្ទទាក់ទងបន្ទាន់របស់មន្ទីរពេទ្យ។", bullet=True)
    add_body_p(doc, "• សមាជិកអាចចុចលើប៊ូតុង 'Print Card' ឬរក្សាទុករូបភាពកាតក្នុងទូរស័ព្ទដៃ ដើម្បីបង្ហាញជាបន្ទាន់ជូនដល់គ្រូពេទ្យនៅពេលមានករណីសង្គ្រោះបន្ទាន់នៅតាមមន្ទីរពេទ្យនានា។", bullet=True)


    # -------------------------------------------------------------
    # SECTION 6: BACKUPS, CACHE & DISASTER RECOVERY
    # -------------------------------------------------------------
    add_heading_1(doc, "៦. ការថែទាំ ការចម្លងទិន្នន័យទុក និងការសង្គ្រោះប្រព័ន្ធ")
    add_body_p(doc, "ស្ថិរភាព សុវត្ថិភាព និងនិរន្តរភាពនៃការដំណើរការគេហទំព័រ ត្រូវបានការពារយ៉ាងរឹងមាំតាមរយៈការចម្លងទិន្នន័យទុកស្វ័យប្រវត្តិលើ Cloud, ប្រព័ន្ធបង្កើនល្បឿន LiteSpeed និងស្តង់ដារប្រតិបត្តិការដ៏តឹងរ៉ឹង។")

    add_heading_2(doc, "៦.១ ប្រព័ន្ធចម្លងទិន្នន័យទុកស្វ័យប្រវត្តិក្នង Google Drive (ដំណើរការជោគជ័យ)")
    add_callout(
        doc,
        "ស្ថានភាពនៃការចម្លងទិន្នន័យទុកបម្រុងក្រៅប្រព័ន្ធ (Offsite Cloud Backup)៖ កម្មវិធី UpdraftPlus ត្រូវបានភ្ជាប់ និងផ្ទៀងផ្ទាត់យ៉ាងពេញលេញជាមួយ Google Drive ក្រោមគណនី Nexus Digital Support (ទំហំផ្ទុក ៥ TB)៖\n• មូលដ្ឋានទិន្នន័យ (Database)៖ ដំណើរការចម្លងទុកបម្រុង ជារៀងរាល់ថ្ងៃ (Daily) ដោយរក្សាទុកឯកសារចាស់ៗរយៈពេល ១៤ ថ្ងៃ។\n• ឯកសារគេហទំព័រទាំងមូល (Core Files)៖ ដំណើរការចម្លងទុកបម្រុង ជារៀងរាល់សប្តាហ៍ (Weekly) ដោយរក្សាទុកឯកសារចាស់ៗរយៈពេល ៤ សប្តាហ៍។\nទោះបីជាមានឧបទ្ទវហេតុកើតឡើងលើម៉ាស៊ីន Server ទាំងមូលក៏ដោយ ក៏គេហទំព័រ និងទិន្នន័យសប្បុរសជនទាំងអស់អាចសង្គ្រោះមកវិញពេញលេញ ១០០% ក្នុងរយៈពេលមិនដល់ ១៥ នាទីឡើយ។",
        title="ការបញ្ជាក់ពីប្រព័ន្ធចម្លងទិន្នន័យទុកបម្រុងស្វ័យប្រវត្តិ",
        alert_type="success"
    )

    add_heading_2(doc, "៦.២ វិធានមាសដែលមិនត្រូវភ្លេច៖ ការជម្រះ LiteSpeed Cache (Purge All)")
    add_callout(
        doc,
        "វិធានកាតព្វកិច្ចសម្រាប់អ្នកគ្រប់គ្រងទាំងអស់៖ គេហទំព័រនេះប្រើប្រាស់ប្រព័ន្ធ LiteSpeed Enterprise Caching ដើម្បីឱ្យទំព័រដំណើរការលឿនបំផុតក្រោម ១ វិនាទី។ ប៉ុន្តែបញ្ហានេះមានន័យថា ទំព័រនានាត្រូវបានរក្សាទុកជាទម្រង់ Static Cache។ ដូច្នេះរាល់ពេលដែលលោកអ្នកបញ្ចូល Theme zip ថ្មី បោះផ្សាយព័ត៌មានថ្មី ឬកែប្រែលេខទូរស័ព្ទក្នុង Customizer លោកអ្នក ត្រូវតែចុចលើពាក្យ 'Purge All' នៅក្រោមរូបសញ្ញា LiteSpeed Cache លើរបារខាងលើនៃ WordPress Admin។ ប្រសិនបើមិនចុច Purge ទេ អ្នកចូលមើលគេហទំព័រនឹងនៅតែបន្តឃើញព័ត៌មានចាស់ដដែល។",
        title="វិធានកាតព្វកិច្ចសម្រាប់អ្នកគ្រប់គ្រងទាំងអស់",
        alert_type="warning"
    )

    add_heading_2(doc, "៦.៣ តារាងសង្ខេបកិច្ចការប្រតិបត្តិការរហ័ស (Administrative Quick Sheet)")
    cheat_headers = ["កិច្ចការប្រតិបត្តិការ", "ទីតាំងនៅលើ WordPress Admin", "សកម្មភាពចាំបាច់ដែលត្រូវអនុវត្ត"]
    cheat_rows = [
        ["ចូលផ្ទាំងគ្រប់គ្រង", "chacambodia.org/wp-admin", "វាយបញ្ចូល Username និង Password រួចចុច Log In"],
        ["ចុះផ្សាយព័ត៌មាន/សិក្ខាសាលា", "News & Events -> Add New Post", "ដាក់ចំណងជើង សរសេរខ្លឹមសារ ដាក់ Featured Image និងជ្រើសរើស Category"],
        ["កែប្រែថវិកាយុទ្ធនាការ", "Campaigns -> All Campaigns", "កែប្រែចំនួនទឹកប្រាក់ Raised ($) និង Goal ($) រួចចុច Update"],
        ["កែប្រែលទូរស័ព្ទ / អ៊ីមែល", "Appearance -> Customize", "ចូលទៅកាន់ 'CHA Theme Options' កែប្រែព័ត៌មាន រួចចុច Publish"],
        ["ប្តូរ ABA ទៅទទួលលុយពិត", "Settings -> CHA PayWay", "បញ្ចូល Merchant ID & Key ពិត រួចប្តូរ Mode ទៅជា Live"],
        ["ពិនិត្យបញ្ជីឈ្មោះអ្នកបរិច្ចាគ", "WordPress -> ម៉ឺនុយ Donations", "ពិនិត្យមើលឈ្មោះសប្បុរសជន ចំនួនទឹកប្រាក់ កាលបរិច្ឆេទ និងលេខកូដ APV"],
        ["ពិនិត្យបញ្ជីឈ្មោះសមាជិក", "WordPress -> ម៉ឺនុយ CHA Members", "ពិនិត្យមើលឈ្មោះអ្នកជំងឺ ប្រភេទឈាម និងស្ថានភាពជំងឺដែលបានចុះឈ្មោះ"],
        ["ជម្រះ Cache គេហទំព័រ", "របារខាងលើ -> រូបសញ្ញា LiteSpeed", "ចុចលើពាក្យ 'Purge All' ភ្លាមៗបន្ទាប់ពីរក្សាទុកការកែប្រែរួច"],
    ]
    add_styled_table(doc, cheat_headers, cheat_rows)

    output_docx = "CHA_Cambodia_Website_Admin_Guide_KM.docx"
    doc.save(output_docx)
    print(f"Master Khmer manual successfully created: {output_docx}")

if __name__ == "__main__":
    generate_khmer_manual()
