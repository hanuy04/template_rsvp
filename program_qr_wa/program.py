import os
import time
import json
import csv
import pandas as pd
import qrcode
import webbrowser
import pyautogui
import io
from PIL import Image
import win32clipboard

def read_guest_data(csv_file):
    """Membaca data tamu dari CSV dan mengembalikan list of dicts"""
    try:
        df = pd.read_csv(csv_file)
        required = ['Nama', 'Email', 'Telepon']
        for col in required:
            if col not in df.columns:
                raise ValueError(f"Kolom '{col}' tidak ditemukan di CSV")
        return df.to_dict('records')
    except Exception as e:
        print(f"Error membaca CSV: {e}")
        return []


def read_template_file(template_file):
    """Membaca file teks template pesan"""
    try:
        with open(template_file, 'r', encoding='utf-8') as f:
            return f.read().strip()
    except Exception:
        return "Halo {name}, ini adalah QR code undangan Anda."


def clean_phone_number(phone):
    """Format nomor untuk WhatsApp (62xxxx)"""
    if pd.isna(phone) or not phone:
        return None
    nums = ''.join(filter(str.isdigit, str(phone)))
    if nums.startswith('0'):
        nums = '62' + nums[1:]
    if not nums.startswith('62'):
        nums = '62' + nums
    return nums


def generate_qr_code(guest, output_dir="qrcodes"):
    """Generate QR code PNG dari data tamu"""
    if not os.path.exists(output_dir): os.makedirs(output_dir)
    data = {"name": guest['Nama'], "email": guest.get('Email',''), "phone": guest.get('Telepon','')}
    qr = qrcode.QRCode(error_correction=qrcode.constants.ERROR_CORRECT_L)
    qr.add_data(json.dumps(data))
    qr.make(fit=True)
    img = qr.make_image(fill_color="black", back_color="white")
    safe = ''.join(c if c.isalnum() else '_' for c in guest['Nama'])
    path = os.path.join(output_dir, f"{safe}_qrcode.png")
    img.save(path)
    return path


def copy_image_to_clipboard(image_path):
    """
    Copy image to clipboard as DIB for Windows.
    """
    image = Image.open(image_path)
    output = io.BytesIO()
    image.convert('RGB').save(output, 'BMP')
    data = output.getvalue()[14:]
    output.close()

    win32clipboard.OpenClipboard()
    win32clipboard.EmptyClipboard()
    win32clipboard.SetClipboardData(win32clipboard.CF_DIB, data)
    win32clipboard.CloseClipboard()

# ---------- WhatsApp Send via Clipboard & pyautogui ----------

def send_whatsapp_message_direct(phone_number, message, image_path=None):
    """
    Mengirim pesan teks dan gambar via WhatsApp Web tanpa Selenium.
    """
    if not phone_number:
        return False, "Nomor telepon tidak valid"

    # Buka chat dengan teks terisi
    import urllib.parse
    wa_url = f"https://web.whatsapp.com/send?phone={phone_number}&text={urllib.parse.quote(message)}"
    webbrowser.open(wa_url)
    print("Tunggu sampai WhatsApp Web terbuka dan chat ter-load...")
    time.sleep(15)

    # Kirim teks
    pyautogui.press('enter')
    time.sleep(3)

    # Jika ada image, copy ke clipboard dan paste
    if image_path:
        print("Mempaste QR code dari clipboard...")
        copy_image_to_clipboard(image_path)
        time.sleep(3)
        pyautogui.hotkey('ctrl', 'v')
        time.sleep(3)
        pyautogui.press('enter')
        time.sleep(3)

    return True, "Teks dan gambar berhasil dikirim"

# ---------- Main Program ----------

def main():
    data_dir = "data"
    template_file = "template.txt"

    if not os.path.exists(data_dir): os.makedirs(data_dir)
    csv_files = [f for f in os.listdir(data_dir) if f.endswith('.csv')]
    if not csv_files:
        print("Tidak ada file CSV di folder data/")
        return

    csv_file = os.path.join(data_dir, csv_files[0])
    guests = read_guest_data(csv_file)
    if not guests:
        return

    template = read_template_file(template_file)

    print("Silakan login ke WhatsApp Web di browser, lalu tekan Enter di sini...")
    input()

    for guest in guests:
        phone = clean_phone_number(guest['Telepon'])
        if not phone:
            print(f"Lewati {guest['Nama']}: nomor invalid")
            continue

        msg = template.replace("{name}", guest['Nama'])
        qr_path = generate_qr_code(guest)

        print(f"Mengirim ke {guest['Nama']} ({phone})...")
        success, status = send_whatsapp_message_direct(phone, msg, qr_path)
        print(status)
        time.sleep(5)

if __name__ == '__main__':
    main()
