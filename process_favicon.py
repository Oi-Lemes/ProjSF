from PIL import Image, ImageChops, ImageDraw

def process_favicon(input_path, output_path):
    img = Image.open(input_path).convert("RGBA")
    
    # 1. First, try to crop any solid black borders if present/easy to detect
    # Or simple logic: Assume the circle is the main content.
    # Let's detect the bounding box of non-black pixels to tighten it up first.
    bg = Image.new(img.mode, img.size, (0, 0, 0, 255))
    diff = ImageChops.difference(img, bg)
    # Increase sensitivity a bit to catch near-black
    diff = ImageChops.add(diff, diff, 2.0, -20) 
    bbox = diff.getbbox()
    
    if bbox:
        img = img.crop(bbox)
    
    # 2. Make it a perfect square based on the smaller dimension to fit the circle
    w, h = img.size
    min_dim = min(w, h)
    
    # Center crop to square
    left = (w - min_dim) // 2
    top = (h - min_dim) // 2
    right = (w + min_dim) // 2
    bottom = (h + min_dim) // 2
    
    img = img.crop((left, top, right, bottom))
    
    # 3. Apply Circular Mask for Transparency
    # Create a mask image (L mode)
    mask = Image.new("L", (min_dim, min_dim), 0)
    draw = ImageDraw.Draw(mask)
    # Draw white circle in the center
    draw.ellipse((0, 0, min_dim, min_dim), fill=255)
    
    # Put opacity into alpha channel
    img.putalpha(mask)
    
    # 4. Save
    img.save(output_path, "PNG")
    print(f"Processed favicon saved to {output_path} ({min_dim}x{min_dim})")

if __name__ == "__main__":
    try:
        process_favicon("favicon_source_3.jpg", "favicon.png")
    except Exception as e:
        print(f"Error: {e}")
