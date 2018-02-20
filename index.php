<?php

get_header();

global $shopkeeper_theme_options;

$shopkeeper_theme_options['layout_blog'] = isset($shopkeeper_theme_options['layout_blog'])? $shopkeeper_theme_options['layout_blog'] : 'layout-1';

switch ($shopkeeper_theme_options['layout_blog'])
{        
    case "layout-1":
        include(locate_template('index-layout-1.php'));
        break;
    case "layout-2":
        include(locate_template('index-layout-2.php'));
        break;
    case "layout-3":
        include(locate_template('index-layout-3.php'));
        break;
    default:
        include(locate_template('index-layout-1.php'));
        break;
}

get_footer();