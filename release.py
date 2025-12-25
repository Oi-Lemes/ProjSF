import os
import shutil
import glob

def build_site():
    # 1. Define source and destination
    source_dir = os.getcwd()
    dist_dir = os.path.join(source_dir, 'out')

    print(f"🚀 Iniciando preparação do site em: {dist_dir}")

    # 2. Clean previous build
    if os.path.exists(dist_dir):
        shutil.rmtree(dist_dir)
    os.makedirs(dist_dir)

    # 3. Define White-list (Files to Copy)
    # We explicitly list what we want to avoid accidental dev files
    files_to_copy = [
        'index.html',
        'style.css',
        'script.js',
        'pix_payment.js',
        'favicon.png',
        'checkout-basic.html',
        'checkout-premium.html',
        'checkout-basic.php',    # Including PHP just in case user decides to use it later
        'checkout-premium.php',
        'author-maria.jpg',
        'author-image.jpg',
        'guarantee-logo.png',
        'checkout-product.jpg',
        'video-poster.jpg'
    ]

    # Add all bonus images dynamically
    bonus_images = glob.glob('bonus-*.jpg')
    files_to_copy.extend(bonus_images)
    
    # Add all favicon source images just in case
    favicon_sources = glob.glob('favicon_source*.jpg')
    files_to_copy.extend(favicon_sources)

    # 4. Copy Files
    for filename in files_to_copy:
        src = os.path.join(source_dir, filename)
        dst = os.path.join(dist_dir, filename)
        
        if os.path.exists(src):
            shutil.copy2(src, dst)
            print(f"✅ Copiado: {filename}")
        else:
            print(f"⚠️ Aviso: Arquivo não encontrado: {filename}")

    # 5. Copy Directories
    dirs_to_copy = ['video', 'attached_assets']
    
    for d in dirs_to_copy:
        src_path = os.path.join(source_dir, d)
        dst_path = os.path.join(dist_dir, d)
        
        if os.path.exists(src_path):
            shutil.copytree(src_path, dst_path)
            print(f"✅ Pasta copiada: {d}")
        else:
            print(f"⚠️ Aviso: Pasta não encontrada: {d}")

    # 6. Create ZIP (Optional convenience)
    shutil.make_archive('site_para_upload', 'zip', dist_dir)
    print("\n📦 Arquivo 'site_para_upload.zip' criado com sucesso!")
    print("\n🎉 CONCLUÍDO! A pasta 'out' está pronta para a Hostinger.")

if __name__ == "__main__":
    build_site()
