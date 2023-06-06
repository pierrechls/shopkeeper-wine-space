<?php

// LOAD THEME LANGUAGES
add_action( 'after_setup_theme', 'ev_lang_setup' );
function ev_lang_setup() {
	$lang = apply_filters('wine-space-shopkeeper', get_template_directory()  . '/languages');
	load_theme_textdomain('shopkeeper', $lang);
	load_child_theme_textdomain( 'wine-space-shopkeeper', get_stylesheet_directory() . '/languages' );
}

?>