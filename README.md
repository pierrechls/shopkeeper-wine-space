[![Version](https://img.shields.io/badge/version-2.0.0-green.svg?style=flat-square)](https://img.shields.io/badge/version-1.1.4-green.svg?style=flat-square) [![CMS](https://img.shields.io/badge/CMS-WordPress%20/%20WooCommerce-lightgrey.svg?style=flat-square)](https://img.shields.io/badge/CMS-WordPress%20/%20WooCommerce-lightgrey.svg?style=flat-square) [![PHP version](https://img.shields.io/badge/PHP%20Version->=8.2-lightgrey.svg?style=flat-square)](https://img.shields.io/badge/PHP%20Version->=8.2-lightgrey.svg?style=flat-square) [![Parent Theme](https://img.shields.io/badge/Parent%20Theme-Shopkeeper-lightgrey.svg?style=flat-square)](https://img.shields.io/badge/Parent%20Theme-Shopkeeper-lightgrey.svg?style=flat-square)

# Wine Space 🍇

![preview](https://raw.githubusercontent.com/pierrechls/wine-space-shopkeeper/master/preview.png)

> Wine Space is a Shopkeeper child theme for WordPress using WooCommerce e-commerce plugin

## 🛠 How to use it

### Clone the project

    git clone https://github.com/pierrechls/wine-space-shopkeeper.git

### Add theme to your WordPress

- **Upload** the folder named *wine-space-shopkeeper* to `/wp-content/themes/` folder using your favorite FTP Client
- **Activate** it via your admin interface (`Appearance > Themes`)

### Add Wine Space plugin

- **Upload** the folder named *shopkeeper-wine-space-plugins* from `/plugins/` folder to `/wp-content/plugins/` folder using your favorite FTP Client
- **Activate** it via your admin interface (`Plugins > Search 'Shopkeeper Wine Space Shortcodes' > Activate`)

### Create your main menu

- Go to `Appearance > Menus` and create a menu
- Configure it as "Main navigation menu"
- Add all your links, you can use multiple level (max 3 levels)
- Add classes for using different style
	- **Multi column style** :
		- CSS Class :	`ev-menu-multi-column`
		- Max sub-level : 1
		- Decide the number of column by adding CSS class : `ev-column-6|ev-column-5|ev-column-4|ev-column-3|ev-column-2`
		- For a specific sub item, if you want to force width, please use this CSS class : `ev-column-X-force-X`, exemple `ev-column-6-force-4` (if you want two columns inside a 6 columns bloc) or `ev-column-4-force-2` (if you want two columns inside a 4 columns bloc)
	- **Images style** :
		- CSS Class :	`ev-menu-images`
		- Max sub-level : 1
		- Decide the number of column by adding CSS class : `ev-column-6|ev-column-5|ev-column-4|ev-column-3|ev-column-2`
		- Use the same width/height for all images ⚠️
		- Add your image URL inside the "Title attr" attribute (if you don't see it, check the box inside the "screen options" at the top of the screen)
	- **Multi level style**
		- CSS Class : `ev-menu-multi-level`	
		- Max sub-level : 2
		- If you want to add "See more" links, add a new sub item with this CSS Class : `ev-menu-link-highlight`
	- **Normal style**
		- Max sub-level : 0
		- If you want to highlight the link, please use this CSS Class `ev-menu-link-highlight` 	

### Install external plugins

#### Toolset Types

- **Download** Toolset Types plugin from [here](https://github.com/pierrechls/wp-types)
- **Follow** the instructions
- **Download** the XML file and import it from the plugin (please refer to the *Init content* section)

#### WPforms

- **Download** WPforms plugin from [here](https://github.com/pierrechls/wp-forms)
- **Follow** the instructions
- **Create** forms (for example, you can insert a contact form in your contact page)

#### Advanced Custom Fields

- **Download** ACF plugin from [here](https://github.com/pierrechls/wp-acf)
- **Follow** the instructions
- **Download** the XML file and import it from the plugin (please refer to the *Init content* section)

#### Min/Max Quantities

- **Download** Min/Max Quantities plugin from [here](https://github.com/pierrechls/wc-min-max-quantities)
- **Follow** the instructions
- **Configure** your products with min and max quantities

#### Category and taxonomy terms order

- **Download** Category and taxonomy terms order plugin from [here](https://github.com/pierrechls/taxonomy-terms-order)
- **Follow** the instructions
- **Order** your categories as you want

#### Table Rate Shipping

- **Download** Table Rate Shipping plugin from [here](https://github.com/pierrechls/wc-table-rate-shipping)
- **Follow** the instructions
- **Add your** shipping conditions

### Init content

:construction: WIP

## 📕 Prior installation

You must have [Wordpress](https://wordpress.org/download/) and [WooCommerce](https://fr.wordpress.org/plugins/woocommerce/) installed. You also have to install [Shopkeeper theme](https://themeforest.net/item/shopkeeper-ecommerce-wp-theme-for-woocommerce/9553045).
