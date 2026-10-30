#!/usr/bin/env python3
"""
Process Kaibon folder: compress semua foto ke WebP, rename sesuai slug produk,
simpan ke public/storage/services/kaibon/
"""

import os, shutil
from pathlib import Path
from PIL import Image

BASE  = Path(__file__).parent
SRC   = BASE / "Kaibon"
OUT   = BASE / "public" / "storage" / "services" / "kaibon"
OUT.mkdir(parents=True, exist_ok=True)

QUALITY = 82
MAX_W   = 1400

def compress(src_path: Path, dest_path: Path):
    with Image.open(src_path) as img:
        img = img.convert("RGB")
        if img.width > MAX_W:
            ratio = MAX_W / img.width
            img = img.resize((MAX_W, int(img.height * ratio)), Image.LANCZOS)
        img.save(dest_path, "WEBP", quality=QUALITY, method=6)
    orig_kb = src_path.stat().st_size // 1024
    new_kb  = dest_path.stat().st_size // 1024
    print(f"  OK {dest_path.name}  ({orig_kb}KB -> {new_kb}KB)")

# ─── Pemetaan foto ke slug produk ─────────────────────────────────────────────
# Format: 'slug-produk' : ['file asli 1', 'file asli 2', ...]
# Foto pertama = gambar utama (cover), sisanya = gallery

MAPPING = {

    # 1. Mangkok Mini Twotone Kaibon (bowl kecil V-shape biru muda)
    "mangkok-mini-twotone-kaibon": [
        "Mangkok Keramik V Twotone.jpg",
        "Mangkok Jago Twotone.jpg",
        "Mangkok Keramik Musli Twotone.jpg",
        "Mangkok Keramik Ramen Twotone.jpg",
    ],

    # 2. Mangkok Twotone Cafe Kaibon (bowl besar aneka warna - ramen/cafe)
    "mangkok-twotone-cafe-kaibon": [
        "DSC06225.JPG",
        "DSC06226.JPG",
        "DSC06227.JPG",
        "DSC06228.JPG",
        "DSC06230.JPG",
        "DSC06231.JPG",
        "DSC06232.JPG",
        "DSC06233.JPG",
        "DSC06234.JPG",
        "DSC06235.JPG",
    ],

    # 3. Mangkok Rice Bowl Lis Hitam Kaibon (putih lis hitam tipis modern)
    "mangkok-rice-bowl-lis-hitam-kaibon": [
        "DSC03253.JPG",
        "DSC03254.JPG",
        "DSC03259.JPG",
    ],

    # 4. Mangkok Kecil Twotone Pastel Kaibon (mini bowl pastel di atas meja kayu)
    "mangkok-kecil-twotone-pastel-kaibon": [
        "DSC06236.JPG",
        "DSC06237.JPG",
        "DSC06238.JPG",
        "DSC06240.JPG",
        "DSC06241.JPG",
        "DSC06242.JPG",
        "DSC06243.JPG",
    ],

    # 5. Piring Makan Twotone Kaibon (piring 8 inch aneka warna twotone)
    "piring-makan-twotone-kaibon": [
        "Piring Keramik Makan 8 inch Twotone.jpg",
        "Piring Keramik Makan 8 inch Twotone(1).jpg",
    ],

    # 6. Mug Standard Putih Kaibon (mug polos putih bersih)
    "mug-standard-putih-kaibon": [
        "Mug Standard 11 Oz Putih.jpg",
        "Mug Standard 11OZ Twotone.jpg",
    ],

    # 7. Mug Twotone Slim Kaibon (mug slim twotone hijau/coklat/biru - di meja kayu)
    "mug-twotone-slim-kaibon": [
        "DSC06356.JPG",
        "DSC06357.JPG",
        "DSC06358.JPG",
        "DSC06360.JPG",
        "DSC06361.JPG",
        "DSC06362.JPG",
        "DSC06363.JPG",
        "DSC06364.JPG",
        "DSC06365.JPG",
        "DSC06382.JPG",
        "DSC06383.JPG",
        "DSC06384.JPG",
    ],

    # 8. Mug Twotone Standard Kaibon (mug biru twotone - di koran)
    "mug-twotone-standard-kaibon": [
        "IMG_9661.JPG (1).jpeg",
        "IMG_9661.JPG.jpeg",
        "IMG_9662.JPG.jpeg",
        "IMG_9665.JPG (1).jpeg",
        "IMG_9665.JPG.jpeg",
        "IMG_9669.JPG.jpeg",
        "IMG_9670.JPG.jpeg",
        "IMG_9672.JPG (1).jpeg",
        "IMG_9672.JPG.jpeg",
        "IMG_9674.JPG (1).jpeg",
        "IMG_9674.JPG.jpeg",
    ],

    # 9. Coffee Set Twotone Kaibon (teko + cangkir + lepek pastel twotone)
    "coffee-set-twotone-kaibon": [
        "Coffee Set Twotone.jpg",
        "PCG-00018.jpg",
        "DSC09024.JPG",
        "DSC09024 2.JPG",
        "DSC09024 4.JPG",
        "DSC09024 5.JPG",
    ],

    # 10. Tea Set Motif Bunga Kaibon (cangkir + lepek motif bunga hijau klasik)
    "tea-set-motif-bunga-kaibon": [
        "DSC09780.JPG",
        "DSC09781.JPG",
        "DSC09782.JPG",
        "DSC09787.JPG",
        "DSC09788.JPG",
        "DSC09789.JPG",
        "DSC09790.JPG",
        "DSC09729.JPG",
        "DSC09739.JPG",
        "DSC09747.JPG",
        "DSC09758.JPG",
        "DSC09759.JPG",
    ],

    # 11. Piring Motif Batik Kaibon (motif biru arabesque/batik - lepek kecil)
    "piring-motif-batik-kaibon": [
        "IMG_9582.JPG.jpeg",
        "IMG_9588.JPG.jpeg",
        "IMG_9589.JPG.jpeg",
        "IMG_9594.JPG.jpeg",
        "WhatsApp Image 2026-07-02 at 11.21.20.jpeg",
        "WhatsApp Image 2026-07-02 at 11.21.20 (1).jpeg",
        "WhatsApp Image 2026-07-02 at 11.21.20 (2).jpeg",
        "WhatsApp Image 2026-07-02 at 11.21.20 (3).jpeg",
        "WhatsApp Image 2026-07-02 at 11.21.20 (4).jpeg",
    ],

    # 12. Parcel Mangkok Kaibon (parcel hadiah mangkok twotone dalam keranjang)
    "parcel-mangkok-kaibon": [
        "P1130512.jpg",
        "P1130521.jpg",
        "P1130525.jpg",
        "P1130545.jpg",
        "P1130563.jpg",
        "P1130578.jpg",
        "P1130581.jpg",
        "P1130593.jpg",
        "P1130601.jpg",
        "P1130617.jpg",
        "P1130624.jpg",
    ],

    # 13. IMG_3314 - cangkir lepek motif bunga hijau close up
    "cangkir-motif-bunga-kaibon": [
        "IMG_3314.JPG",
        "IMG_3316.JPG",
        "IMG_3318.JPG",
        "IMG_3322.JPG",
    ],
}

# ─── Proses compress ──────────────────────────────────────────────────────────
log = []
for slug, files in MAPPING.items():
    print(f"\n[PRODUK] {slug}")
    for idx, fname in enumerate(files, start=1):
        src = SRC / fname
        dest = OUT / f"{slug}-{idx}.webp"
        if not src.exists():
            print(f"  SKIP (tidak ada): {fname}")
            continue
        try:
            compress(src, dest)
            log.append((slug, idx, dest.name))
        except Exception as e:
            print(f"  ERROR {fname}: {e}")

print(f"\n\nSELESAI -- total {len(log)} file WebP di {OUT}")
