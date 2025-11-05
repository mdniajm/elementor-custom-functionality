# Elementor Custom Functionality

A collection of standalone PHP extensions that enhance **Elementor Free** widgets without modifying any core Elementor files.

Each file is modular — you can enable only the features you need.  
Works with both **Elementor Free** and **Elementor Pro**.

---

## 📌 Included Extensions

### 1️⃣ `basic-gallery-image-sizing.php`
Enhances the **Basic Gallery** widget by adding missing image controls:

| Control | Description |
|---------|-------------|
| **Image Width** | Set custom width per gallery image |
| **Image Height** | Set custom height (cropped or scaled) |
| **Object Fit** | `cover`, `contain`, `fill`, `none`, `scale-down` |
| **Image Position** | Align the image inside the container (`center`, `top`, `bottom`, etc.) |

✅ Makes gallery items the same size  
✅ No custom CSS needed  
✅ Great for grid layouts, masonry images, portfolio items

---

### 2️⃣ `icon-box-icon-margin.php`
Adds missing spacing controls to the **Icon Box** widget:

| Control | Purpose |
|---------|---------|
| **Icon Margin** | Adjust space around icon (top, right, bottom, left) |
| **Responsive Control** | Works on desktop, tablet, mobile |

✅ No more custom CSS for icon spacing  
✅ Useful for pixel-perfect layout alignment

---

### 3️⃣ `extend-button-widget-icon.php`
Upgrades the **Button** widget to support full icon styling (similar to Icon Box widget):

| Feature | Description |
|---------|-------------|
| **Icon View** | `Default`, `Stacked`, `Framed` |
| **Icon Shape** | `Square`, `Rounded`, `Circle` |
| **Icon Padding** | Inner spacing of icon box |
| **Border Width / Radius** | Full control, responsive |
| **Primary / Secondary Colors** | Normal & Hover states |
| **Icon Spacing** | Gap between icon & text |
| **Auto Center Alignment** | Text stays vertically centered beside icon |

✅ Makes Elementor Free button as powerful as Elementor Pro’s button  
✅ 100% CSS-free customization inside Elementor UI

---

## 🛠️ Installation & Usage

### ✅ Option A — Add to `functions.php`

require_once get_stylesheet_directory() . '/basic-gallery-image-sizing.php';
require_once get_stylesheet_directory() . '/icon-box-icon-margin.php';
require_once get_stylesheet_directory() . '/extend-button-widget-icon.php';


## ✅ **Option B — Use as a Mini Plugin (Recommended)**

### 1️⃣ Create a folder:

```
/wp-content/plugins/elementor-custom-functionality/
```

### 2️⃣ Create a file inside it named `plugin.php`:

```php
<?php
/**
 * Plugin Name: Elementor Custom Functionality
 * Description: Adds extra controls to core Elementor widgets.
 * Author: Md Naiem
 * Version: 1.0.0
 */

require_once __DIR__ . '/basic-gallery-image-sizing.php';
require_once __DIR__ . '/icon-box-icon-margin.php';
require_once __DIR__ . '/extend-button-widget-icon.php';
```

### 3️⃣ Go to WordPress → Plugins → Activate ✅

---

## 🔄 Compatibility

| Software | Status |
|----------|--------|
| Elementor Free 3.x | ✅ Compatible |
| Elementor Pro | ✅ No conflict |
| WordPress 6.x | ✅ Tested |
| PHP 7.4 – 8.2 | ✅ Supported |

---

## ⚠️ Notes

- These extensions hook into Elementor API — no core overwrite.
- Fully update-safe (does NOT modify Elementor plugin files).
- If Elementor changes widget markup in future updates, small tweaks may be needed.
- Can be safely shipped inside client projects or theme bundles.

---

## 🤝 Contributing

Pull requests, issues, and feature requests are welcome.

### Ideas you can contribute:

- ✅ More widget extensions
- ✅ Global settings UI
- ✅ Repeater field enhancements
- ✅ Translation / i18n support
- ✅ Code documentation improvements

---

## 📄 License

MIT License — free for personal and commercial use.

---

## 👤 Author

**Md Niaj Makhdum**  
GitHub: [https://github.com/mdniajm](https://github.com/mdniajm)
