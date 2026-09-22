"""
Khmer Generator for CHA_Cambodia_Website_Admin_Guide_KM.docx
Written specifically for non-technical executive leadership and operations staff.
Focuses 100% on practical day-to-day tasks: logging in, publishing news, creating/updating campaigns,
editing all page texts and images via Customizer, tracking donations, managing members (including
manual password reset & 1-click instant verification), and cache maintenance.
Uses official typography (Siemreap) with explicit w:cs and w:szCs OpenXML tags
to ensure crisp, large, legible Khmer glyphs in Microsoft Word.
"""

import os
import sys
from docx import Document
from docx.shared import Inches, Pt, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT
from docx.oxml import parse_xml, OxmlElement
from docx.oxml.ns import nsdecls, qn

# Brand Colors (Hex & RGB)
COLOR_PRIMARY = "0B1D6D"     # Deep Royal Navy
COLOR_SECONDARY = "E31E24"   # Crimson Red
COLOR_PURPLE = "6A2C91"      # Royal Purple
COLOR_TEXT = "1E293B"        # Slate 800
COLOR_MUTED = "475569"       # Slate 600
COLOR_SURFACE = "F8FAFC"     # Slate 50
COLOR_BORDER = "CBD5E1"      # Slate 300
COLOR_SUCCESS = "16A34A"     # Emerald Green
COLOR_WARNING = "D97706"     # Amber

RGB_PRIMARY = RGBColor(11, 29, 109)
RGB_SECONDARY = RGBColor(227, 30, 36)
RGB_TEXT = RGBColor(30, 41, 59)
RGB_MUTED = RGBColor(71, 85, 105)
RGB_WHITE = RGBColor(255, 255, 255)

# Standard Khmer Font installed on Windows
FONT_HEADING = "Siemreap"
FONT_BODY = "Siemreap"

def apply_khmer_style(run, font_name, pt_size, is_bold=False, color_rgb=None):
    """
    Applies font name and size to both Latin (w:ascii, w:hAnsi) and Complex Script (w:cs, w:szCs).
    This ensures Microsoft Word displays Khmer characters in the exact font and enlarged size
    instead of falling back to 10pt default fonts.
    """
    run.font.name = font_name
    run.font.size = Pt(pt_size)
    run.font.bold = is_bold
    if color_rgb:
        run.font.color.rgb = color_rgb

    rPr = run._r.get_or_add_rPr()

    # Font tags
    rFonts = OxmlElement('w:rFonts')
    rFonts.set(qn('w:ascii'), font_name)
    rFonts.set(qn('w:hAnsi'), font_name)
    rFonts.set(qn('w:cs'), font_name)
    rPr.append(rFonts)

    # Size tags in half-points (e.g. 12pt = 24 half-points)
    half_pts = str(int(pt_size * 2))
    sz = OxmlElement('w:sz')
    sz.set(qn('w:val'), half_pts)
    rPr.append(sz)

    szCs = OxmlElement('w:szCs')
    szCs.set(qn('w:val'), half_pts)
    rPr.append(szCs)

    if is_bold:
        bCs = OxmlElement('w:bCs')
        rPr.append(bCs)

def set_cell_background(cell, hex_color):
    tcPr = cell._element.get_or_add_tcPr()
    shd = parse_xml(f'<w:shd {nsdecls("w")} w:fill="{hex_color}"/>')
    tcPr.append(shd)

def set_cell_margins(cell, top=140, bottom=140, left=180, right=180):
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
        apply_khmer_style(hrun, FONT_BODY, 9.5, False, RGB_MUTED)

        # Footer
        footer = section.footer
        fp = footer.paragraphs[0]
        fp.alignment = WD_ALIGN_PARAGRAPH.RIGHT
        frun = fp.add_run("សៀវភៅណែនាំស្តីពីការគ្រប់គ្រង និងប្រតិបត្តិការគេហទំព័រ  |  ឯកសារសម្ងាត់ផ្លូវការ  |  ទំព័រ ")
        apply_khmer_style(frun, FONT_BODY, 9.5, False, RGB_MUTED)

    return doc

def add_executive_cover_page_km(doc, title, subtitle, logo_path=None, meta_table=None):
    if logo_path and os.path.exists(logo_path):
        p_logo = doc.add_paragraph()
        p_logo.alignment = WD_ALIGN_PARAGRAPH.LEFT
        p_logo.paragraph_format.space_before = Pt(16)
        p_logo.paragraph_format.space_after = Pt(20)
        run_logo = p_logo.add_run()
        run_logo.add_picture(logo_path, width=Inches(3.3))

    # Divider bar
    p_div = doc.add_paragraph()
    p_div.paragraph_format.space_before = Pt(8)
    p_div.paragraph_format.space_after = Pt(16)
    r_div = p_div.add_run("―" * 32)
    apply_khmer_style(r_div, FONT_HEADING, 16, True, RGB_SECONDARY)

    # Title
    p_title = doc.add_paragraph()
    p_title.paragraph_format.space_before = Pt(0)
    p_title.paragraph_format.space_after = Pt(14)
    p_title.paragraph_format.line_spacing = 1.3
    run_title = p_title.add_run(title)
    apply_khmer_style(run_title, FONT_HEADING, 24, True, RGB_PRIMARY)

    # Subtitle
    p_sub = doc.add_paragraph()
    p_sub.paragraph_format.space_before = Pt(0)
    p_sub.paragraph_format.space_after = Pt(26)
    p_sub.paragraph_format.line_spacing = 1.4
    run_sub = p_sub.add_run(subtitle)
    apply_khmer_style(run_sub, FONT_BODY, 12.5, False, RGB_MUTED)

    # Meta table
    if meta_table:
        table = doc.add_table(rows=len(meta_table), cols=2)
        table.alignment = WD_TABLE_ALIGNMENT.CENTER
        table.autofit = False
        
        for idx, (k, v) in enumerate(meta_table.items()):
            row = table.rows[idx]
            
            # Left cell
            c0 = row.cells[0]
            c0.width = Inches(2.3)
            set_cell_background(c0, "F1F5F9")
            set_cell_margins(c0, top=100, bottom=100, left=140, right=140)
            set_cell_borders(c0, left="single", color=COLOR_PRIMARY, size="16", bottom="single")
            p0 = c0.paragraphs[0]
            p0.paragraph_format.space_before = Pt(0)
            p0.paragraph_format.space_after = Pt(0)
            r0 = p0.add_run(k)
            apply_khmer_style(r0, FONT_BODY, 11, True, RGB_PRIMARY)

            # Right cell
            c1 = row.cells[1]
            c1.width = Inches(4.4)
            set_cell_background(c1, "FFFFFF")
            set_cell_margins(c1, top=100, bottom=100, left=140, right=140)
            set_cell_borders(c1, bottom="single", color="E2E8F0")
            p1 = c1.paragraphs[0]
            p1.paragraph_format.space_before = Pt(0)
            p1.paragraph_format.space_after = Pt(0)
            r1 = p1.add_run(v)
            apply_khmer_style(r1, FONT_BODY, 11, False, RGB_TEXT)

    doc.add_page_break()

def add_heading_1(doc, text):
    p = doc.add_paragraph()
    p.paragraph_format.space_before = Pt(24)
    p.paragraph_format.space_after = Pt(8)
    p.paragraph_format.line_spacing = 1.3
    p.paragraph_format.keep_with_next = True
    run = p.add_run(text)
    apply_khmer_style(run, FONT_HEADING, 17, True, RGB_PRIMARY)
    return p

def add_heading_2(doc, text):
    p = doc.add_paragraph()
    p.paragraph_format.space_before = Pt(16)
    p.paragraph_format.space_after = Pt(6)
    p.paragraph_format.line_spacing = 1.3
    p.paragraph_format.keep_with_next = True
    run = p.add_run(text)
    apply_khmer_style(run, FONT_HEADING, 14, True, RGB_TEXT)
    return p

def add_body_p(doc, text, bold_prefix=None, bullet=False):
    p = doc.add_paragraph()
    p.paragraph_format.space_before = Pt(0)
    p.paragraph_format.space_after = Pt(6)
    p.paragraph_format.line_spacing = 1.35
    if bullet:
        p.paragraph_format.left_indent = Inches(0.25)
        r_bullet = p.add_run("•  ")
        apply_khmer_style(r_bullet, FONT_BODY, 12, True, RGB_SECONDARY)

    if bold_prefix:
        r_pre = p.add_run(bold_prefix + " ")
        apply_khmer_style(r_pre, FONT_BODY, 12, True, RGB_TEXT)
    run = p.add_run(text)
    apply_khmer_style(run, FONT_BODY, 12, False, RGB_TEXT)
    return p

def add_step_card(doc, step_num, title, instructions):
    table = doc.add_table(rows=1, cols=2)
    table.alignment = WD_TABLE_ALIGNMENT.CENTER
    table.autofit = False

    # Step badge cell
    c0 = table.rows[0].cells[0]
    c0.width = Inches(1.15)
    set_cell_background(c0, "0B1D6D")
    set_cell_margins(c0, top=160, bottom=160, left=100, right=100)
    p0 = c0.paragraphs[0]
    p0.alignment = WD_ALIGN_PARAGRAPH.CENTER
    p0.paragraph_format.space_before = Pt(0)
    p0.paragraph_format.space_after = Pt(0)
    p0.paragraph_format.line_spacing = 1.2
    r0 = p0.add_run(f"ជំហាន\nទី {step_num}")
    apply_khmer_style(r0, FONT_HEADING, 12, True, RGB_WHITE)

    # Instruction cell
    c1 = table.rows[0].cells[1]
    c1.width = Inches(5.55)
    set_cell_background(c1, "F8FAFC")
    set_cell_margins(c1, top=140, bottom=140, left=160, right=160)
    set_cell_borders(c1, top="single", bottom="single", right="single", color="CBD5E1")

    p1 = c1.paragraphs[0]
    p1.paragraph_format.space_before = Pt(0)
    p1.paragraph_format.space_after = Pt(5)
    p1.paragraph_format.line_spacing = 1.3
    r_title = p1.add_run(title)
    apply_khmer_style(r_title, FONT_HEADING, 13, True, RGB_PRIMARY)

    for inst in instructions:
        p_sub = c1.add_paragraph()
        p_sub.paragraph_format.space_before = Pt(0)
        p_sub.paragraph_format.space_after = Pt(3)
        p_sub.paragraph_format.line_spacing = 1.3
        r_inst = p_sub.add_run(f"→  {inst}")
        apply_khmer_style(r_inst, FONT_BODY, 11.5, False, RGB_TEXT)

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
    set_cell_margins(cell, top=160, bottom=160, left=180, right=180)
    set_cell_borders(cell, left="single", color=border_color, size="32",
                     top="single", bottom="single", right="single", top_color="CBD5E1",
                     bottom_color="CBD5E1", right_color="CBD5E1")

    cp = cell.paragraphs[0]
    cp.paragraph_format.space_before = Pt(0)
    cp.paragraph_format.space_after = Pt(4)
    cp.paragraph_format.line_spacing = 1.35

    if title:
        rt = cp.add_run(icon + title + "\n")
        apply_khmer_style(rt, FONT_HEADING, 12.5, True, RGB_PRIMARY if alert_type != "important" and alert_type != "warning" else RGB_SECONDARY)

    rb = cp.add_run(text)
    apply_khmer_style(rb, FONT_BODY, 11.5, False, RGB_TEXT)

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
        p.paragraph_format.line_spacing = 1.25
        run = p.add_run(h_text)
        apply_khmer_style(run, FONT_HEADING, 11.5, True, RGB_WHITE)
        set_cell_background(hdr_cells[i], COLOR_PRIMARY)
        set_cell_margins(hdr_cells[i], top=120, bottom=120, left=140, right=140)
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
            p.paragraph_format.line_spacing = 1.3
            run = p.add_run(str(val))
            apply_khmer_style(run, FONT_BODY, 11, False, RGB_TEXT)
            set_cell_background(row_cells[c_idx], bg_color)
            set_cell_margins(row_cells[c_idx], top=90, bottom=90, left=140, right=140)
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
        "កំណែឯកសារ": "កំណែ ១.២ — សៀវភៅប្រតិបត្តិការពេញលេញសម្រាប់ថ្នាក់ដឹកនាំ និងបុគ្គលិក",
        "គេហទំព័រសាធារណៈ": "https://chacambodia.org",
        "ផ្ទាំងគ្រប់គ្រង (Admin)": "https://chacambodia.org/wp-admin",
        "កាលបរិច្ឆេទបោះផ្សាយ": "ខែកញ្ញា ឆ្នាំ២០២៦",
        "អ្នកប្រើប្រាស់គោលដៅ": "ថ្នាក់ដឹកនាំប្រតិបត្តិ បុគ្គលិកការិយាល័យ និងអ្នកគ្រប់គ្រងមាតិកា",
    }
    add_executive_cover_page_km(
        doc,
        "CHA Cambodia — សៀវភៅណែនាំស្តីពីការគ្រប់គ្រង និងប្រតិបត្តិការគេហទំព័រ",
        "មគ្គុទ្ទេសក៍ជាក់ស្តែង និងងាយយល់ស្តីពីការចុះផ្សាយព័ត៌មាន បង្កើតយុទ្ធនាការ កែប្រែអត្ថបទនិងរូបភាពគ្រប់ទំព័រ ការកំណត់ពាក្យសម្ងាត់អ្នកជំងឺ ការតាមដានការបរិច្ចាគ និងការថែទាំគេហទំព័រ chacambodia.org ប្រចាំថ្ងៃ",
        logo_path=logo_path,
        meta_table=meta_info
    )

    # Table of Contents Overview Callout
    add_callout(
        doc,
        "សូមស្វាគមន៍មកកាន់សៀវភៅណែនាំប្រតិបត្តិការគេហទំព័រផ្លូវការ! សៀវភៅណែនាំនេះត្រូវបានរៀបចំឡើងជាពិសេសសម្រាប់ថ្នាក់ដឹកនាំ និងបុគ្គលិកការិយាល័យនៃសមាគម CHA Cambodia។ វាពន្យល់ពីអ្វីៗគ្រប់យ៉ាងដែលលោកអ្នកត្រូវដឹងដើម្បីដំណើរការគេហទំព័រយ៉ាងរលូន—ដូចជាការចុះផ្សាយព័ត៌មាន ការបង្កើតយុទ្ធនាការរៃអង្គាសប្រាក់ថ្មី ការកែប្រែរាល់អត្ថបទនិងរូបភាពគ្រប់ទំព័រ ការកំណត់ពាក្យសម្ងាត់ថ្មីជូនអ្នកជំងឺដោយផ្ទាល់ដៃ ការផ្ទៀងផ្ទាត់គណនីតែ១ចុច ការពិនិត្យការបរិច្ចាគ និងការសម្អាត Cache—ដោយពុំចាំបាច់មានចំណេះដឹងបច្ចេកទេស ឬកូដឡើយ។",
        title="សេចក្តីស្វាគមន៍ និងការណែនាំសង្ខេប",
        alert_type="note"
    )

    # -------------------------------------------------------------
    # SECTION 1: GETTING STARTED & LOGGING IN
    # -------------------------------------------------------------
    add_heading_1(doc, "១. ការចាប់ផ្តើម និងការចូលប្រើប្រាស់ប្រព័ន្ធ (Login)")
    add_body_p(doc, "រាល់ការកែប្រែ ឬបន្ថែមព័ត៌មាននៅលើគេហទំព័រ ត្រូវធ្វើឡើងតាមរយៈផ្ទាំងគ្រប់គ្រងខាងក្នុងដែលមានសុវត្ថិភាព ហៅថា WordPress Admin Dashboard។ លោកអ្នកអាចចូលប្រើប្រាស់បានពីកម្មវិធីរុករក (Web Browser) លើកុំព្យូទ័រ ឬ Tablet របស់លោកអ្នក។")

    add_heading_2(doc, "១.១ របៀបចូលប្រើប្រាស់តាមជំហានជាក់ស្តែង")
    add_step_card(
        doc,
        "១",
        "បើកគេហទំព័រចូលគ្រប់គ្រង (Admin Portal)",
        [
            "បើកកម្មវិធីរុករកលើកុំព្យូទ័រ (Google Chrome, Apple Safari, Microsoft Edge ឬ Brave)។",
            "វាយបញ្ចូលអាសយដ្ឋាន៖ https://chacambodia.org/wp-admin",
            "ចំណាំ៖ លោកអ្នកអាច Bookmark (រក្សាទុក) ទំព័រនេះដើម្បីងាយស្រួលចុចចូលលើកក្រោយ។"
        ]
    )
    add_step_card(
        doc,
        "២",
        "បញ្ចូលឈ្មោះ និងពាក្យសម្ងាត់ផ្ទាល់ខ្លួន",
        [
            "វាយឈ្មោះគណនី (Username) ឬអ៊ីមែល ក្នុងប្រអប់ទី១។",
            "វាយពាក្យសម្ងាត់ (Password) ក្នុងប្រអប់ទី២។",
            "ចុចគ្រីសលើពាក្យ 'Remember Me' ប្រសិនបើប្រើកុំព្យូទ័រផ្ទាល់ខ្លួន។",
            "ចុចប៊ូតុងពណ៌ខៀវ 'Log In' ដើម្បីចូលទៅកាន់ផ្ទាំងគ្រប់គ្រង។"
        ]
    )

    add_heading_2(doc, "១.២ អ្វីដែលត្រូវធ្វើប្រសិនបើភ្លេចពាក្យសម្ងាត់")
    add_body_p(doc, "ប្រសិនបើលោកអ្នក ឬសហការីភ្លេចពាក្យសម្ងាត់ លោកអ្នកអាចកំណត់ពាក្យសម្ងាត់ថ្មីដោយខ្លួនឯងក្នុងរយៈពេលត្រឹមតែ ១ នាទីប៉ុណ្ណោះ៖")
    add_body_p(doc, "១. នៅលើផ្ទាំង Log In សូមចុចលើពាក្យ 'Lost your password?' (ភ្លេចពាក្យសម្ងាត់)។")
    add_body_p(doc, "២. វាយបញ្ចូលអាសយដ្ឋានអ៊ីមែលដែលបានចុះឈ្មោះ រួចចុចប៊ូតុង 'Get New Password'។")
    add_body_p(doc, "៣. ចូលទៅពិនិត្យប្រអប់សំបុត្រអ៊ីមែល (Inbox) ហើយចុចលើតំណភ្ជាប់ (Link) ដែលប្រព័ន្ធផ្ញើជូន ដើម្បីកំណត់ពាក្យសម្ងាត់ថ្មី។")

    # -------------------------------------------------------------
    # SECTION 2: PUBLISHING NEWS & EVENT ARTICLES
    # -------------------------------------------------------------
    add_heading_1(doc, "២. ការចុះផ្សាយព័ត៌មាន សិក្ខាសាលា និងព្រឹត្តិការណ៍")
    add_body_p(doc, "ផ្នែកព័ត៌មាន និងព្រឹត្តិការណ៍ (News & Events) អនុញ្ញាតឱ្យលោកអ្នកចែករំលែកសកម្មភាពថ្មីៗជូនដល់សាធារណជន ដៃគូអន្តរជាតិ និងអ្នកជំងឺ។ នៅពេលលោកអ្នកចុះផ្សាយអត្ថបទមួយ អត្ថបទនោះនឹងបង្ហាញដោយស្វ័យប្រវត្តិលើទំព័រដើម (អត្ថបទចុងក្រោយ ៣) និងក្នុងបណ្ណសារពេញលេញនៅ chacambodia.org/news។")

    add_heading_2(doc, "២.១ របៀបបង្កើតអត្ថបទព័ត៌មានថ្មី")
    add_step_card(
        doc,
        "១",
        "បង្កើតអត្ថបទថ្មី (Add New Post)",
        [
            "នៅក្នុងបញ្ជីម៉ឺនុយខាងឆ្វេងដៃនៃផ្ទាំងគ្រប់គ្រង សូមចុចលើ 'News & Events'។",
            "ចុចប៊ូតុង 'Add New Post' នៅផ្នែកខាងលើ។"
        ]
    )
    add_step_card(
        doc,
        "២",
        "បញ្ចូលចំណងជើង និងខ្លឹមសារជាភាសាអង់គ្លេស និងភាសាខ្មែរ",
        [
            "ចំណងជើងអង់គ្លេស (Add Title)៖ វាយចំណងជើងព័ត៌មាននៅប្រអប់ខាងលើបង្អស់ (ឧទាហរណ៍៖ 'World Haemophilia Day 2026 Awareness Workshop')។",
            "ខ្លឹមសារលម្អិត (Main Content)៖ វាយ ឬចម្លងអត្ថបទពិស្តារចូលទៅក្នុងប្រអប់ធំកណ្តាល។",
            "ការបកប្រែជាភាសាខ្មែរ (Khmer Translation)៖ នៅខាងក្រោមប្រអប់សរសេរ លោកអ្នកនឹងឃើញប្រអប់សម្រាប់ 'Khmer Title' (ចំណងជើងខ្មែរ) និង 'Khmer Summary' (សេចក្តីសង្ខេបខ្មែរ)។ សូមបញ្ចូលនៅត្រង់នេះ ដើម្បីឱ្យអ្នកអានជាភាសាខ្មែរអាចមើលឃើញ!"
        ]
    )
    add_step_card(
        doc,
        "៣",
        "ដាក់រូបភាពតំណាង ជ្រើសរើសប្រភេទ រួចចុចបោះផ្សាយ",
        [
            "រូបភាពតំណាង (Featured Image)៖ នៅជួរចំហៀងខាងស្តាំដៃ សូមចុច 'Set featured image' រួចបញ្ចូលរូបភាពស្អាតមួយនៃព្រឹត្តិការណ៍។",
            "កាលបរិច្ឆេទបង្ហាញ (Display Date)៖ វាយកាលបរិច្ឆេទងាយយល់ (ឧទាហរណ៍៖ 'Apr 17, 2026')។",
            "ប្រភេទព័ត៌មាន (Category Badge)៖ ជ្រើសរើសប្រភេទមួយដែលត្រូវនឹងអត្ថបទ៖ Event, Workshop, Update ឬ Announcement។",
            "បោះផ្សាយ (Publish)៖ ចុចប៊ូតុងពណ៌ខៀវ 'Publish' នៅជ្រុងខាងស្តាំខាងលើ។ អត្ថបទរបស់លោកអ្នកនឹងបង្ហាញជាសាធារណៈភ្លាមៗ!"
        ]
    )

    add_callout(
        doc,
        "គន្លឹះជ្រើសរើសរូបភាពឱ្យទំព័រដើរលឿន៖ ដើម្បីឱ្យរូបភាពបង្ហាញបានស្អាតលើទូរស័ព្ទ និងកុំព្យូទ័រ សូមប្រើរូបភាពផ្តេក (Horizontal/Landscape) នៃសិក្ខាសាលា ឬពិធីជួបជុំ។ គួរជ្រើសរើសទំហំរូបភាពក្រោម 2 MB ដើម្បីឱ្យគេហទំព័របើកបានលឿនរហ័ស សម្រាប់អ្នកប្រើប្រាស់ដែលមានអ៊ីនធឺណិតយឺត។",
        title="ការណែនាំអំពីរូបភាព",
        alert_type="tip"
    )

    # -------------------------------------------------------------
    # SECTION 3: CREATING & MANAGING FUNDRAISING CAMPAIGNS
    # -------------------------------------------------------------
    add_heading_1(doc, "៣. ការបង្កើត និងគ្រប់គ្រងយុទ្ធនាការរៃអង្គាសប្រាក់")
    add_body_p(doc, "ទំព័រដើមនៃគេហទំព័របង្ហាញនូវយុទ្ធនាការរៃអង្គាសថវិកាសំខាន់ៗ (ដូចជា 'Patient Support Funding' ឬ 'Emergency Factor Treatment') ជាមួយនឹងរបារភាគរយរំកិល (Progress Bar) បង្ហាញពីចំនួនទឹកប្រាក់ដែលទទួលបានធៀបនឹងគោលដៅ។")

    add_heading_2(doc, "៣.១ របៀបបង្កើតយុទ្ធនាការរៃអង្គាសថ្មីស្រឡាង")
    add_body_p(doc, "នៅពេលដែលសមាគម CHA ចាប់ផ្តើមយុទ្ធនាការអំពាវនាវ ឬគម្រោងមនុស្សធម៌ថ្មី លោកអ្នកអាចបង្កើតកាតយុទ្ធនាការថ្មីបានយ៉ាងងាយ៖")
    add_step_card(
        doc,
        "១",
        "ចុចបង្កើតយុទ្ធនាការថ្មី (Add New Campaign)",
        [
            "នៅម៉ឺនុយខាងឆ្វេង ដាក់ព្រួញកណ្តុរលើ 'Campaigns' រួចចុច 'Add New'។",
            "ចំណងជើងយុទ្ធនាការ (English Title)៖ ឧទាហរណ៍ 'Youth & Pediatric Care Emergency Fund'។",
            "សេចក្តីពិពណ៌នាសង្ខេប (Description)៖ ក្នុងប្រអប់អត្ថបទធំ សូមសរសេរ ២ ទៅ ៣ បន្ទាត់ បញ្ជាក់ពីគោលបំណងនៃមូលនិធិនេះ។"
        ]
    )
    add_step_card(
        doc,
        "២",
        "កំណត់ចំនួនទឹកប្រាក់ ពណ៌ និងព័ត៌មានជាភាសាខ្មែរ",
        [
            "រំកិលចុះក្រោមទៅកាន់ប្រអប់ 'Campaign Details' នៅខាងក្រោម ឬជួរខាងស្តាំ។",
            "រូបសញ្ញា (Icon)៖ ជ្រើសរើសរូបតំណាងដែលត្រូវគ្នា (Heart, Graduation Cap, Pulse/Health, Users, Shield, Gift ជាដើម)។",
            "ថវិកាទទួលបានដំបូង (Raised Amount $)៖ វាយចំនួនដុល្លារដែលប្រមូលបានដំបូង (ឧទាហរណ៍៖ 0 ឬ 1500)។",
            "គោលដៅសរុប (Goal Amount $)៖ វាយចំនួនទឹកប្រាក់គោលដៅដែលត្រូវការ (ឧទាហរណ៍៖ 10000)។",
            "ពណ៌ប្រធានបទ (Theme Color)៖ ជ្រើសរើសពណ៌ក្រហម (Red), ខៀវ (Blue) ឬស្វាយ (Purple) សម្រាប់របារភាគរយ។",
            "ចំណងជើង និងសេចក្តីផ្សាយខ្មែរ (Title & Desc Khmer)៖ បំពេញជាភាសាខ្មែរសម្រាប់អ្នកអានខ្មែរ។",
            "ចុចប៊ូតុងពណ៌ខៀវ 'Publish'។ យុទ្ធនាការថ្មីនឹងបង្ហាញលើទំព័រដើមភ្លាមៗ!"
        ]
    )

    add_heading_2(doc, "៣.២ របៀបកែប្រែចំនួនទឹកប្រាក់ក្នុងយុទ្ធនាការចាស់")
    add_step_card(
        doc,
        "១",
        "ជ្រើសរើសយុទ្ធនាការដែលត្រូវកែប្រែ",
        [
            "នៅម៉ឺនុយខាងឆ្វេងដៃ ចុចលើ 'Campaigns' -> 'All Campaigns'។",
            "ចុចលើចំណងជើងយុទ្ធនាការដែលលោកអ្នកចង់កែប្រែចំនួនទឹកប្រាក់។"
        ]
    )
    add_step_card(
        doc,
        "២",
        "កែតម្រូវចំនួនទឹកប្រាក់ដុល្លារ និងរក្សាទុក",
        [
            "រំកិលចុះក្រោមទៅកាន់ផ្នែក 'Campaign Details'។",
            "កែប្រែប្រអប់ 'Raised Amount ($)' ទៅជាចំនួនទឹកប្រាក់សរុបចុងក្រោយដែលទទួលបាន។",
            "ចុចប៊ូតុងពណ៌ខៀវ 'Update' នៅខាងស្តាំដៃ។ គេហទំព័រនឹងគណនាភាគរយ (%) ឡើងវិញ និងធ្វើចលនារបារភ្លាមៗ!"
        ]
    )

    # -------------------------------------------------------------
    # SECTION 4: EDITING ANY TEXT, PHOTO & SECTION VIA CUSTOMIZER
    # -------------------------------------------------------------
    add_heading_1(doc, "៤. ការកែប្រែរាល់អត្ថបទ រូបភាព និងផ្នែកនានាលើគេហទំព័រ (Customizer)")
    add_body_p(doc, "គេហទំព័រ CHA ទាំងមូលត្រូវបានរចនាឡើងជាមួយផ្ទាំងកែផ្ទាល់ភ្នែក (WordPress Live Customizer)។ លោកអ្នកអាចកែប្រែចំណងជើង គោលបំណងស្ថាប័ន ជីវប្រវត្តិថ្នាក់ដឹកនាំ ស្ថិតិ លេខទូរស័ព្ទ និងផ្លាស់ប្តូររូបថតគ្រប់ទំព័រទាំងអស់ ដោយពុំចាំបាច់ចេះសរសេរកូដឡើយ។")

    add_heading_2(doc, "៤.១ របៀបចូលទៅកាន់ផ្ទាំងកែផ្ទាល់ភ្នែក (Customizer)")
    add_body_p(doc, "១. នៅម៉ឺនុយខាងឆ្វេងដៃ ដាក់ព្រួញកណ្តុរលើ 'Appearance' រួចចុច 'Customize'។")
    add_body_p(doc, "២. អេក្រង់នឹងចែកជាពីរ៖ ជួរឈរបញ្ជាកែប្រែនៅខាងឆ្វេងដៃ និងផ្ទាំងបង្ហាញគេហទំព័រពិតជាក់ស្តែងនៅខាងស្តាំដៃ។")
    add_body_p(doc, "៣. នៅពេលលោកអ្នកវាយកែប្រែ ឬដូររូប ផ្ទាំងខាងស្តាំនឹងផ្លាស់ប្តូរឱ្យឃើញភ្លាម។ នៅពេលពេញចិត្ត សូមចុចប៊ូតុងពណ៌ខៀវ 'Publish' នៅខាងលើបង្អស់ដើម្បីរក្សាទុកជាផ្លូវការ។")

    add_heading_2(doc, "៤.២ បញ្ជីផ្នែក និងទំព័រដែលលោកអ្នកអាចកែប្រែបានក្នុង Customizer")
    customizer_headers = ["ឈ្មោះផ្នែកក្នុង Customizer", "អ្វីដែលលោកអ្នកអាចកែប្រែ និងផ្លាស់ប្តូររូបភាពបាន", "ភាសាដែលគាំទ្រ"]
    customizer_rows = [
        ["Homepage Content", "ចំណងជើងធំលើគេ រូបភាព Background លើទំព័រដើម ប៊ូតុងសកម្មភាព កាត 'យើងជួយដូចម្តេច' និងស្ថិតិផលប៉ះពាល់សហគមន៍។", "អង់គ្លេស និងខ្មែរ"],
        ["Contact & Footer", "លេខទូរស័ព្ទផ្លូវការ (+855...) អាសយដ្ឋានអ៊ីមែល ទីតាំងការិយាល័យភ្នំពេញ ម៉ោងធ្វើការ និងពាក្យស្លោកខាងក្រោមគេហទំព័រ។", "អង់គ្លេស និងខ្មែរ"],
        ["Navigation & Header", "រូបសញ្ញាឡូហ្គោផ្លូវការ (Header & Footer) ឈ្មោះប៊ូតុងម៉ឺនុយខាងលើ និងពាក្យលើប៊ូតុងបរិច្ចាគ។", "អង់គ្លេស និងខ្មែរ"],
        ["About Page", "ប្រវត្តិដើមនៃសមាគម CHA បេសកកម្ម ស្ថិតិអ្នកស្ម័គ្រចិត្ត ប្រវត្តិព្រឹត្តិការណ៍សំខាន់ៗតាមឆ្នាំ និងដៃគូសហការ។", "អង់គ្លេស និងខ្មែរ"],
        ["Leadership Structure", "រូបថត និងតួនាទីរបស់ប្រធានសមាគម អនុប្រធាន នាយកប្រតិបត្តិ ប្រធាននាយកដ្ឋាន និងទីប្រឹក្សាវេជ្ជសាស្ត្រ។", "អង់គ្លេស និងខ្មែរ"],
        ["Programs & Services", "ការរៀបរាប់ពីកម្មវិធីយុវជន ការចែកថ្នាំកត្តាកំណកឈាម កម្មវិធីសង្គ្រោះអ្នកជំងឺបន្ទាន់ និងកិច្ចសហការ CSR។", "អង់គ្លេស និងខ្មែរ"],
        ["Haemophilia Medical Info", "ចំណេះដឹងវេជ្ជសាស្ត្រ រោគសញ្ញាជំងឺ ការពន្យល់អំពីកត្តា Factor VIII / IX និងជំងឺ von Willebrand។", "អង់គ្លេស និងខ្មែរ"],
        ["Popups & Modals", "ការណែនាំលើផ្ទាំងបរិច្ចាគប្រាក់ លេខគណនីធនាគារ និងលក្ខខណ្ឌនៃការចុះឈ្មោះសមាជិក។", "អង់គ្លេស និងខ្មែរ"],
    ]
    add_styled_table(doc, customizer_headers, customizer_rows)

    add_step_card(
        doc,
        "១",
        "ការផ្លាស់ប្តូរលេខទូរស័ព្ទ អ៊ីមែល និងអាសយដ្ឋានការិយាល័យ",
        [
            "ក្នុង Customizer ជួរឆ្វេង ចុចលើ 'Contact & Footer' -> 'Contact Information'។",
            "លេខទូរស័ព្ទ (Phone)៖ វាយលេខទូរស័ព្ទផ្លូវការថ្មី (ឧទាហរណ៍៖ +855 96 260 5335)។",
            "អ៊ីមែល (Email)៖ វាយអាសយដ្ឋានអ៊ីមែលផ្លូវការ (ឧទាហរណ៍៖ info@chacambodia.org)។",
            "អាសយដ្ឋាន (Address)៖ វាយទីតាំងការិយាល័យនៅរាជធានីភ្នំពេញ។",
            "ម៉ោងធ្វើការ (Hours)៖ កែប្រែម៉ោងធ្វើការពីថ្ងៃចន្ទ-សុក្រ និងថ្ងៃសៅរ៍។",
            "ចុចប៊ូតុងពណ៌ខៀវ 'Publish' នៅខាងលើនៃជួរឈរខាងឆ្វេង។"
        ]
    )
    add_step_card(
        doc,
        "២",
        "ការផ្លាស់ប្តូររូបសញ្ញាឡូហ្គោ ឬរូបភាពធំលើទំព័រដើម (Hero Image)",
        [
            "ដូរឡូហ្គោគេហទំព័រ៖ ចុចលើ 'Navigation & Header' -> 'Site Logo' ចុច 'Change Image' រួចជ្រើសរើសរូបឡូហ្គោ PNG ថ្មីច្បាស់ស្អាត។",
            "ដូររូបធំលើទំព័រដើម៖ ចុចលើ 'Homepage Content' -> 'Hero Section' ចុច 'Change Image' ក្រោមពាក្យ Background Image រួចបញ្ចូលរូបថតថ្មី។",
            "ចុចប៊ូតុង 'Publish' ដើម្បីឱ្យរូបភាពថ្មីបង្ហាញជាសាធារណៈភ្លាមៗ។"
        ]
    )

    # -------------------------------------------------------------
    # SECTION 5: DONATIONS, PAYWAY & EXCEL REPORTS
    # -------------------------------------------------------------
    add_heading_1(doc, "៥. ការតាមដានការបរិច្ចាគប្រាក់ និងការគ្រប់គ្រង ABA PayWay")
    add_body_p(doc, "រាល់ការបរិច្ចាគតាមរយៈគេហទំព័រ និងកម្មវិធីទូរស័ព្ទដៃ (App) ត្រូវបានដំណើរការយ៉ាងមានសុវត្ថិភាពតាមច្រកទូទាត់ ABA Bank PayWay (គាំទ្រការស្កេន KHQR និងកាតធនាគារ)។ ប្រតិបត្តិការទាំងអស់ត្រូវបានកត់ត្រាក្នុងបញ្ជីគណនេយ្យផ្ទៃក្នុងរបស់លោកអ្នក។")

    add_heading_2(doc, "៥.១ ស្វែងយល់ពីផ្ទាំងគ្រប់គ្រងការបរិច្ចាគ (Donations Dashboard)")
    add_body_p(doc, "ដើម្បីពិនិត្យមើលបញ្ជីថវិកាបរិច្ចាគ សូមចុចលើម៉ឺនុយ 'Donations' នៅខាងឆ្វេងដៃ។ លោកអ្នកនឹងឃើញកាតសង្ខេបចំនួន ៤៖")
    add_body_p(doc, "• Total Raised (ថវិកាសរុបទទួលបាន)៖ ចំនួនទឹកប្រាក់ដុល្លារសរុបដែលបានទូទាត់ជោគជ័យចូលក្នុងគណនី។", bullet=True)
    add_body_p(doc, "• Completed Orders (ចំនួនប្រតិបត្តិការជោគជ័យ)៖ ចំនួនដងនៃការបរិច្ចាគដែលបានបញ្ចប់សព្វគ្រប់។", bullet=True)
    add_body_p(doc, "• Pending / In-Flight (កំពុងរង់ចាំ)៖ សប្បុរសជនដែលបានបើកផ្ទាំងទូទាត់ ប៉ុន្តែពុំទាន់បានស្កេន ឬបោះបង់ចោល។ (ចំណាំ៖ ប្រតិបត្តិការដែលមិនបានស្កេន នឹងត្រូវបានប្រព័ន្ធសម្អាតចោលដោយស្វ័យប្រវត្តិក្នងរយៈពេល ១២ ម៉ោង ដើម្បីកុំឱ្យស្មុគស្មាញដល់បញ្ជី)។", bullet=True)
    add_body_p(doc, "• Total Donors (ចំនួនសប្បុរសជនសរុប)៖ ចំនួនសប្បុរសជនគាំទ្រសរុប។", bullet=True)
    add_body_p(doc, "• សប្បុរសជនមិនបញ្ចេញឈ្មោះ (Anonymous)៖ ប្រសិនបើសប្បុរសជនជ្រើសរើសមិនបញ្ចេញឈ្មោះ ប្រព័ន្ធនឹងកត់ត្រាទុកដោយសុវត្ថិភាពថា 'Anonymous Donor'។", bullet=True)

    add_heading_2(doc, "៥.២ ការទាញយករបាយការណ៍បរិច្ចាគជាឯកសារ Excel (CSV Export)")
    add_body_p(doc, "នៅពេលដែលផ្នែកគណនេយ្យ ឬថ្នាក់ដឹកនាំត្រូវការរបាយការណ៍ហិរញ្ញវត្ថុផ្លូវការ៖")
    add_body_p(doc, "១. ចូលទៅកាន់ទំព័រ 'Donations' ក្នុងផ្ទាំង WordPress Admin។")
    add_body_p(doc, "២. ចុចប៊ូតុងពណ៌ស 'Export CSV Ledger' នៅលើផ្ទាំងបដាខាងលើ។")
    add_body_p(doc, "៣. ឯកសារទម្រង់ `.csv` ដែលអាចបើកជាមួយ Microsoft Excel នឹងទាញយកមកក្នុងកុំព្យូទ័រភ្លាមៗ ដែលមានកត់ត្រាកាលបរិច្ឆេទ ឈ្មោះសប្បុរសជន អ៊ីមែល លេខទូរស័ព្ទ ចំនួនទឹកប្រាក់ និងលេខកូដអនុម័តធនាគារ (APV)។")

    add_heading_2(doc, "៥.៣ របៀបប្តូរប្រព័ន្ធ ABA PayWay ទៅដំណើរការលុយពិត (Live Production)")
    add_callout(
        doc,
        "នៅពេលធនាគារ ABA អនុម័តគណនីអាជីវកម្មផ្លូវការរបស់សមាគម CHA និងផ្តល់លេខកូដ Live Merchant ID នោះការបើកដំណើរការលុយពិតត្រូវការពេលត្រឹមតែ ១ នាទីប៉ុណ្ណោះ៖\n១. ក្នុងម៉ឺនុយខាងឆ្វេង ចុចលើ 'Donations'។\n២. ចុចប៊ូតុង 'PayWay Gateway Settings' នៅលើបដាខាងលើ។\n៣. បញ្ចូលលេខ Merchant ID និង API Key ផ្លូវការរបស់ធនាគារ ABA។\n៤. ប្តូរប្រអប់ Environment ពី 'Sandbox' ទៅជា 'Production (Live)'។\n៥. ចុចប៊ូតុង 'Save Gateway Configuration'។ ពេលនេះការបរិច្ចាគប្រាក់ពិតប្រាកដនឹងរត់ត្រង់ចូលគណនីធនាគាររបស់សមាគម CHA ដោយផ្ទាល់!",
        title="របៀបបើកដំណើរការទូទាត់ប្រាក់ពិតរបស់ធនាគារ ABA",
        alert_type="warning"
    )

    # -------------------------------------------------------------
    # SECTION 6: MANAGING PATIENT MEMBERS & SUPPORT
    # -------------------------------------------------------------
    add_heading_1(doc, "៦. ការគ្រប់គ្រងបញ្ជីសមាជិកអ្នកជំងឺ និងការជួយសម្រួល")
    add_body_p(doc, "អ្នកជំងឺ និងអ្នកគាំទ្រចុះឈ្មោះតាមរយៈគេហទំព័រ ឬកម្មវិធីទូរស័ព្ទដៃ ដើម្បីទទួលបានកាតសមាជិកឌីជីថល។ ក្នុងនាមជាអ្នកគ្រប់គ្រង លោកអ្នកមានសិទ្ធិពេញលេញក្នុងការមើល បន្ថែម កែប្រែ កំណត់ពាក្យសម្ងាត់ និងផ្ទៀងផ្ទាត់សមាជិក។")

    add_heading_2(doc, "៦.១ ការពិនិត្យមើលបញ្ជីសមាជិកដែលបានចុះឈ្មោះ")
    add_body_p(doc, "១. នៅម៉ឺនុយខាងឆ្វេងដៃ ចុចលើ 'CHA Members'។")
    add_body_p(doc, "២. លោកអ្នកនឹងឃើញតារាងសមាជិកពេញលេញ ដែលបង្ហាញ រូបថត លេខកូដសម្គាល់ (ឧទាហរណ៍ CHA-2026-001) ឈ្មោះពេញ (អង់គ្លេស និងខ្មែរ) អ៊ីមែល លេខទូរស័ព្ទ ប្រភេទសមាជិក (Patient, Caregiver, Healthcare Prof., ឬ Member) និងស្ថានភាពគណនី។")
    add_body_p(doc, "៣. ការស្វែងរករហ័ស៖ វាយឈ្មោះ អ៊ីមែល ឬលេខកូដសមាជិកក្នុងប្រអប់ Search ខាងលើដើម្បីរកឃើញក្នុងរយៈពេលក្រោម ១ វិនាទី។")

    add_heading_2(doc, "៦.២ ការកែប្រែព័ត៌មាន និងការកំណត់ពាក្យសម្ងាត់ថ្មីជូនអ្នកជំងឺដោយផ្ទាល់")
    add_body_p(doc, "ប្រសិនបើមានអ្នកជំងឺទាក់ទងមកការិយាល័យសុំឱ្យជួយប្តូរពាក្យសម្ងាត់ ឬកែប្រែព័ត៌មានសុខភាព អាសយដ្ឋាន ឬលេខទូរស័ព្ទ៖")
    add_step_card(
        doc,
        "១",
        "ចូលទៅកាន់ផ្ទាំងកែប្រែសមាជិក (Edit Member)",
        [
            "ក្នុងទំព័រ 'CHA Members' ស្វែងរកឈ្មោះសមាជិកនោះ រួចចុចប៊ូតុងពណ៌ខៀវ 'Edit' នៅចុងជួរដេក។",
            "ចំណាំ៖ លោកអ្នកក៏អាចចុះឈ្មោះអ្នកជំងឺថ្មីដោយផ្ទាល់ដៃពីការិយាល័យ ដោយចុចប៊ូតុង 'Add New Member' នៅខាងលើ។"
        ]
    )
    add_step_card(
        doc,
        "២",
        "កំណត់ពាក្យសម្ងាត់ថ្មីដោយផ្ទាល់ ឬកែប្រែព័ត៌មាន",
        [
            "ការកំណត់ពាក្យសម្ងាត់ថ្មីដោយផ្ទាល់ (Direct Password Reset)៖ រកមើលប្រអប់ឈ្មោះ 'New Password'។ គ្រាន់តែវាយបញ្ចូលពាក្យសម្ងាត់បណ្តោះអាសន្នថ្មី (ឧទាហរណ៍៖ Cha2026!) រួចចុច Save Changes។ លោកអ្នកអាចផ្តល់ពាក្យសម្ងាត់នេះជូនអ្នកជំងឺដើម្បីឱ្យគាត់ Log In ភ្លាមៗ! (ទុកប្រអប់នេះទំនេរ ប្រសិនបើមិនចង់ប្តូរពាក្យសម្ងាត់)។",
            "ការជ្រើសរើសប្រភេទសមាជិក៖ ប្តូររវាង 'Patient' ឬ 'General Member'។ ការរើស 'Patient' នឹងបើកប្រអប់វេជ្ជសាស្ត្រដោយស្វ័យប្រវត្តិ។",
            "ព័ត៌មានវេជ្ជសាស្ត្រ៖ កែប្រែប្រភេទឈាម (A+, B+, O+, AB+), រោគវិនិច្ឆ័យជំងឺហូរឈាម និងថ្ងៃខែឆ្នាំកំណើត។",
            "ព័ត៌មានទំនាក់ទំនង៖ កែប្រែលេខទូរស័ព្ទ អាសយដ្ឋាន និងឈ្មោះខ្មែរ។",
            "ចុចប៊ូតុងពណ៌ខៀវ 'Save Changes' នៅខាងក្រោម។ សមាជិកអាចចូលប្រើប្រាស់គណនីបានភ្លាមៗ!"
        ]
    )

    add_heading_2(doc, "៦.៣ ការផ្ទៀងផ្ទាត់គណនីតែ ១ ចុច និងការដោះស្រាយបញ្ហា")
    add_body_p(doc, "• ការផ្ទៀងផ្ទាត់គណនីភ្លាមៗតែ ១ ចុច (1-Click Verify)៖ ប្រសិនបើអ្នកជំងឺមិនបានទទួលអ៊ីមែលបញ្ជាក់ ឬពិបាកបើកអ៊ីមែល លោកអ្នកមិនបាច់ផ្ញើអ៊ីមែលម្តងទៀតឡើយ! គ្រាន់តែរកមើលឈ្មោះរបស់គាត់ដែលមានសញ្ញាពណ៌លឿង 'Pending' ក្នុង 'CHA Members' រួចចុចប៊ូតុងពណ៌បៃតង 'Verify' នៅចុងជួរ។ គណនីរបស់គាត់នឹងក្លាយជា Active ភ្លាមៗ!", bullet=True)
    add_body_p(doc, "• អ្នកជំងឺកំណត់ពាក្យសម្ងាត់ដោយខ្លួនឯង៖ អ្នកជំងឺក៏អាចចុច 'Forgot Password?' នៅលើផ្ទាំង Log In នៃ App ឬគេហទំព័រ ដើម្បីកំណត់ពាក្យសម្ងាត់ដោយខ្លួនឯងបានគ្រប់ពេលវេលា។", bullet=True)
    add_body_p(doc, "• ការលុបគណនីស្ទួន ឬគណនីសាកល្បង៖ ចុចប៊ូតុងពណ៌ក្រហម 'Delete' នៅចុងជួរដេក រួចចុចបញ្ជាក់ការលុប។", bullet=True)
    add_body_p(doc, "• ការទាញយកបញ្ជីសមាជិកជា Excel៖ ចុចលើប៊ូតុង 'Export CSV' នៅខាងលើនៃទំព័រ CHA Members ដើម្បីទាញយកបញ្ជីឈ្មោះសមាជិកទាំងអស់ទៅរក្សាទុកក្នុង Microsoft Excel។", bullet=True)

    # -------------------------------------------------------------
    # SECTION 7: ONE GOLDEN RULE: PURGING CACHE
    # -------------------------------------------------------------
    add_heading_1(doc, "៧. វិធានមាសដ៏សំខាន់៖ ការសម្អាត Cache ដើម្បីឱ្យការកែប្រែបង្ហាញភ្លាមៗ")
    add_callout(
        doc,
        "ហេតុអ្វីបានជាខ្ញុំកែប្រែព័ត៌មានរួចហើយ តែលើគេហទំព័រមិនទាន់ឃើញផ្លាស់ប្តូរ?\nគេហទំព័ររបស់លោកអ្នកប្រើប្រាស់ប្រព័ន្ធបង្កើនល្បឿន LiteSpeed ដើម្បីឱ្យទំព័របើកបានលឿនក្នុងរយៈពេលក្រោម ១ វិនាទី។ នៅពេលលោកអ្នកកែប្រែអត្ថបទក្នុង Customizer កែប្រែយុទ្ធនាការ ឬចុះផ្សាយព័ត៌មានថ្មី លោកអ្នកត្រូវសម្អាត Cache (Purge All) ដើម្បីឱ្យម៉ាស៊ីនមេបង្ហាញទំព័រថ្មីស្រឡាងជូនអ្នកទស្សនា។\n\nរបៀបធ្វើក្នុងរយៈពេលត្រឹមតែ ៣ វិនាទី៖\nក្រឡេកមើលរបារខ្មៅខាងលើបង្អស់នៃផ្ទាំង WordPress Admin។ ដាក់ព្រួញកណ្តុរលើរូបសញ្ញាត្បូងពេជ្រ LiteSpeed រួចចុចលើពាក្យ 'Purge All'។ តែប៉ុណ្ណោះ! រាល់ការកែប្រែទាំងអស់នឹងបង្ហាញជាសាធារណៈភ្លាមៗ។",
        title="ជំហានចាំបាច់បំផុតបន្ទាប់ពីធ្វើការកែប្រែព័ត៌មានណាមួយ",
        alert_type="warning"
    )

    # -------------------------------------------------------------
    # SECTION 8: AUTOMATIC BACKUPS & SECURITY
    # -------------------------------------------------------------
    add_heading_1(doc, "៨. ប្រព័ន្ធចម្លងទុកទិន្នន័យស្វ័យប្រវត្តិ (Backups) និងសេចក្តីស្ងប់ចិត្ត")
    add_body_p(doc, "ក្នុងនាមជាថ្នាក់ដឹកនាំស្ថាប័ន លោកអ្នកអាចមានសេចក្តីស្ងប់ចិត្តពេញលេញចំពោះសុវត្ថិភាពនៃទិន្នន័យ និងគេហទំព័រទាំងមូល៖")
    add_body_p(doc, "• ការចម្លងទិន្នន័យមូលដ្ឋានប្រចាំថ្ងៃ (Daily Database Backup)៖ រាល់ទិន្នន័យសមាជិកអ្នកជំងឺ និងការបរិច្ចាគទាំងអស់ ត្រូវបានចម្លងទុកជាស្វ័យប្រវត្តរៀងរាល់ថ្ងៃ ទៅកាន់ Google Drive Cloud ដែលមានទំហំផ្ទុក 5 TB។", bullet=True)
    add_body_p(doc, "• ការចម្លងគេហទំព័រទាំងមូលប្រចាំសប្តាហ៍ (Weekly Full Backup)៖ រូបភាព អត្ថបទព័ត៌មាន និងឯកសារទាំងអស់ ត្រូវបានចម្លងទុកជាប្រចាំសប្តាហ៍។", bullet=True)
    add_body_p(doc, "• មិនត្រូវការការថែទាំប្រចាំថ្ងៃឡើយ៖ បុគ្គលិកមិនចាំបាច់ចំណាយពេលចុចចម្លងទិន្នន័យដោយដៃឡើយ។ ប្រសិនបើមានបញ្ហាបច្ចេកទេសលើម៉ាស៊ីនមេ គេហទំព័រទាំងមូលអាចត្រូវបានស្តារឡើងវិញយ៉ាងឆាប់រហ័សពី Google Drive។", bullet=True)

    # Summary Quick Cheat Sheet Table
    add_heading_2(doc, "៨.១ តារាងសង្ខេបសកម្មភាពរហ័សសម្រាប់បុគ្គលិក")
    cheat_headers = ["អ្វីដែលលោកអ្នកចង់ធ្វើ", "កន្លែងដែលត្រូវចុចក្នុង WordPress Admin", "សកម្មភាពសាមញ្ញដែលត្រូវអនុវត្ត"]
    cheat_rows = [
        ["ចូលគ្រប់គ្រងគេហទំព័រ", "chacambodia.org/wp-admin", "វាយឈ្មោះគណនី និងពាក្យសម្ងាត់"],
        ["ចុះផ្សាយព័ត៌មាន ឬសិក្ខាសាលា", "News & Events -> Add New", "ដាក់ចំណងជើង អត្ថបទ រូបភាព រួចចុច Publish"],
        ["បង្កើតយុទ្ធនាការរៃអង្គាសថ្មី", "Campaigns -> Add New", "ដាក់ចំណងជើង គោលបំណង គោលដៅ ($) រួចចុច Publish"],
        ["កែប្រែចំនួនទឹកប្រាក់យុទ្ធនាការ", "Campaigns -> All Campaigns", "កែចំនួនទឹកប្រាក់ Raised និង Goal រួចចុច Update"],
        ["កែប្រែអត្ថបទ រូបថត ឬឡូហ្គោគ្រប់ទំព័រ", "Appearance -> Customize", "បើកផ្នែកដែលត្រូវកែ (Homepage, About, Leadership) រួចចុច Publish"],
        ["ផ្លាស់ប្តូរលេខទូរស័ព្ទ ឬអ៊ីមែល", "Appearance -> Customize", "ចូល 'Contact & Footer' -> 'Contact Info' កែប្រែ រួចចុច Publish"],
        ["ពិនិត្យមើលអ្នកបរិច្ចាគថវិកា", "ម៉ឺនុយ Donations", "មើលតួលេខសរុប ឈ្មោះ ឬចុច 'Export CSV Ledger'"],
        ["ប្តូរ ABA ទៅដំណើរការលុយពិត", "Donations -> PayWay Settings", "បញ្ចូល Live Merchant ID & Key រួចប្តូរទៅ Production"],
        ["កំណត់ពាក្យសម្ងាត់ថ្មីជូនអ្នកជំងឺ", "CHA Members -> ចុច Edit", "វាយពាក្យសម្ងាត់ថ្មីក្នុងប្រអប់ 'New Password' រួចចុច Save Changes"],
        ["ផ្ទៀងផ្ទាត់គណនីអ្នកជំងឺផ្ទាល់", "ម៉ឺនុយ CHA Members", "ចុចប៊ូតុងពណ៌បៃតង 'Verify' លើជួរដេកសមាជិកនោះ"],
        ["ឱ្យការកែប្រែបង្ហាញភ្លាមៗ", "របារខ្មៅខាងលើ -> រូប LiteSpeed", "ចុចលើពាក្យ 'Purge All' បន្ទាប់ពីកែប្រែរួចរាល់"],
    ]
    add_styled_table(doc, cheat_headers, cheat_rows)

    # Save to file
    output_docx = "CHA_Cambodia_Website_Admin_Guide_KM.docx"
    doc.save(output_docx)
    print(f"Master Khmer client manual successfully created: {output_docx}")

if __name__ == "__main__":
    generate_khmer_manual()
