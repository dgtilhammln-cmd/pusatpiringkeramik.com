#!/usr/bin/env python3
"""
Process Toyoki folder: compress semua foto ke WebP, rename sesuai slug produk,
simpan ke public/storage/services/toyoki/ dan storage/app/public/services/toyoki/
"""

import os, shutil
from pathlib import Path
from PIL import Image

BASE     = Path(__file__).parent
SRC      = BASE / "Toyoki"
OUT_PUB  = BASE / "public" / "storage" / "services" / "toyoki"
OUT_APP  = BASE / "storage" / "app" / "public" / "services" / "toyoki"

OUT_PUB.mkdir(parents=True, exist_ok=True)
OUT_APP.mkdir(parents=True, exist_ok=True)

QUALITY = 82
MAX_W   = 1400

def compress(src_path: Path, dest_pub: Path, dest_app: Path):
    with Image.open(src_path) as img:
        img = img.convert("RGB")
        if img.width > MAX_W:
            ratio = MAX_W / img.width
            img = img.resize((MAX_W, int(img.height * ratio)), Image.LANCZOS)
        img.save(dest_pub, "WEBP", quality=QUALITY, method=6)
        shutil.copy2(dest_pub, dest_app)
    orig_kb = src_path.stat().st_size // 1024
    new_kb  = dest_pub.stat().st_size // 1024
    print(f"  OK {dest_pub.name}  ({orig_kb}KB -> {new_kb}KB)")

# ─── Pemetaan foto ke slug produk (14 produk, total 41 foto) ──────────────────
MAPPING = {
    # 1. Cangkir Set Tropical Toyoki (3 foto)
    "cangkir-set-tropical-toyoki": [
        "PCG-00007.jpg",
        "Cangkir Set Tropical Biru.jpg",
        "Cangkir Set Tropical Merah.jpg",
    ],

    # 2. Tea Set Keramik Motif Bunga Toyoki (3 foto)
    "tea-set-keramik-motif-bunga-toyoki": [
        "DSC09287.JPG",
        "DSC09278.JPG",
        "DSC09281.JPG",
    ],

    # 3. Dinner Set Ayam Jago Toyoki (3 foto)
    "dinner-set-ayam-jago-toyoki": [
        "PCG-00894.jpg",
        "PCG-00892.jpg",
        "PCG-00884.jpg",
    ],

    # 4. Mangkok Ayam Jago 6.25 Inch Toyoki (1 foto)
    "mangkok-ayam-jago-625-inch-toyoki": [
        "Mangkok 6.25 inch Ayam Jago Toyoki.jpg",
    ],

    # 5. Mangkok Soto Ayam Jago 4.75 Inch Toyoki (1 foto)
    "mangkok-soto-ayam-jago-475-inch-toyoki": [
        "Mangkok Soto 4.75 inch Ayam Jago Toyoki.jpg",
    ],

    # 6. Mangkok Saus Sambal Ayam Jago Toyoki (1 foto)
    "mangkok-saus-sambal-ayam-jago-toyoki": [
        "Mangkok Saus Sambal Toyoki.jpg",
    ],

    # 7. Piring Makan Ayam Jago 8 Inch Toyoki (1 foto)
    "piring-makan-ayam-jago-8-inch-toyoki": [
        "Piring Makan 8 inch Ayam Toyoki.jpg",
    ],

    # 8. Piring dan Mangkok List Coklat Toyoki (3 foto)
    "piring-dan-mangkok-list-coklat-toyoki": [
        "PCG-00002.jpg",
        "Mangkok Keramik 6 inch List Coklat.jpg",
        "PCG-00610.jpg",
    ],

    # 9. Piring Makan Keramik Motif Bunga Toyoki (5 foto)
    "piring-makan-keramik-motif-bunga-toyoki": [
        "PCG-00606.jpg",
        "PCG-00607.jpg",
        "PCG2-18.jpg",
        "PCG2-19.jpg",
        "PCG2-21.jpg",
    ],

    # 10. Cangkir Set Motif Mawar Toyoki (2 foto)
    "cangkir-set-motif-mawar-toyoki": [
        "PCG2-14.jpg",
        "PCG2-13.jpg",
    ],

    # 11. Mug Keramik Mawar Biru Papa Mama Toyoki (3 foto)
    "mug-keramik-mawar-biru-papa-mama-toyoki": [
        "PCG-00883.jpg",
        "PCG-00881.jpg",
        "PCG-00882.jpg",
    ],

    # 12. Mangkok Two Tone Pastel Toyoki (8 foto)
    "mangkok-two-tone-pastel-toyoki": [
        "PCG-00004.jpg",
        "PCG2-23.jpg",
        "PCG2-24.jpg",
        "PCG2-25.jpg",
        "PCG2-26.jpg",
        "PCG2-27.jpg",
        "PCG2-28.jpg",
        "PCG2-29.jpg",
    ],

    # 13. Mug Keramik Two Tone Retro Toyoki (4 foto)
    "mug-keramik-two-tone-retro-toyoki": [
        "DSC06214.JPG",
        "DSC06215.JPG",
        "DSC06216.JPG",
        "DSC06217.JPG",
    ],

    # 14. Mug Keramik Solid Color Toyoki (3 foto)
    "mug-keramik-solid-color-toyoki": [
        "DSC06218.JPG",
        "DSC06219.JPG",
        "DSC06220.JPG",
    ],
}

total_processed = 0
for slug, files in MAPPING.items():
    print(f"\n[PRODUK] {slug}")
    for idx, fname in enumerate(files, start=1):
        src = SRC / fname
        dest_pub = OUT_PUB / f"{slug}-{idx}.webp"
        dest_app = OUT_APP / f"{slug}-{idx}.webp"
        if not src.exists():
            print(f"  SKIP (tidak ada): {fname}")
            continue
        try:
            compress(src, dest_pub, dest_app)
            total_processed += 1
        except Exception as e:
            print(f"  ERROR {fname}: {e}")

print(f"\n\nSELESAI -- total {total_processed} file WebP berhasil diproses.")

