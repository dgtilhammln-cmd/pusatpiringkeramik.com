from PIL import Image
import shutil

# Open PNG and resize to proper ICO sizes
img = Image.open('public/favicon_backup.png').convert('RGBA')

sizes = [16, 32, 48]
images = []
for s in sizes:
    im = img.resize((s, s), Image.LANCZOS)
    images.append(im)

# Save as actual multi-size ICO
images[0].save(
    'public/favicon.ico',
    format='ICO',
    sizes=[(16, 16), (32, 32), (48, 48)],
    append_images=images[1:]
)

# Save PNG favicons for modern browsers
images[1].save('public/favicon-32x32.png', format='PNG')
images[0].save('public/favicon-16x16.png', format='PNG')
images[1].save('public_html/favicon-32x32.png', format='PNG')
images[0].save('public_html/favicon-16x16.png', format='PNG')

shutil.copy('public/favicon.ico', 'public_html/favicon.ico')

ico_size = len(open('public/favicon.ico', 'rb').read())
print(f'Done! ICO size: {ico_size} bytes')
print(f'Saved: favicon.ico (multi-size 16/32/48), favicon-32x32.png, favicon-16x16.png')
