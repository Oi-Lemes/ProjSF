from PIL import Image, ImageChops

def crop_center_circle(image_path):
    img = Image.open(image_path).convert("RGBA")
    
    # Create a mask of non-white pixels (assuming white background based on user request)
    # Also considering transparent pixels
    bg = Image.new(img.mode, img.size, (255, 255, 255, 255))
    diff = ImageChops.difference(img, bg)
    diff = ImageChops.add(diff, diff, 2.0, -100)
    bbox = diff.getbbox()
    
    if bbox:
        # Crop to the content first
        cropped = img.crop(bbox)
        
        # Now make it square to keep it centered
        w, h = cropped.size
        max_dim = max(w, h)
        
        # Create new square image with white background (or transparent if desired, but user said 'white space')
        # Let's use transparent for a favicon usually, but if the original had white, maybe they want white?
        # User said "corta aquele espaço vazio", usually implies transparency or just removing the extra white board.
        # Let's make the background transparent for a modern favicon.
        new_img = Image.new("RGBA", (max_dim, max_dim), (255, 255, 255, 0))
        
        # Paste centered
        offset_x = (max_dim - w) // 2
        offset_y = (max_dim - h) // 2
        new_img.paste(cropped, (offset_x, offset_y))
        
        # Save overwriting
        new_img.save(image_path)
        print(f"Successfully cropped and centered: {max_dim}x{max_dim}")
    else:
        print("No content found to crop.")

if __name__ == "__main__":
    crop_center_circle("favicon.png")
