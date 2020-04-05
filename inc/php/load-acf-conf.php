<?php

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
          'page_title' 	=> 'Wine Space Settings',
          'menu_title'	=> 'WS Settings',
          'menu_slug' 	=> 'ws-general-settings',
          'capability'	=> 'edit_posts',
          'redirect'		=> false
      ));
  
      acf_add_options_sub_page(array(
          'page_title' 	=> 'Wine Space Header Settings',
          'menu_title'	=> 'Header',
          'parent_slug'	=> 'ws-general-settings',
      ));
  
      acf_add_options_sub_page(array(
          'page_title' 	=> 'Wine Space Footer Settings',
          'menu_title'	=> 'Footer',
          'parent_slug'	=> 'ws-general-settings',
      ));
  
    acf_add_options_sub_page(array(
          'page_title' 	=> 'Wine Space Flash Message Settings',
          'menu_title'	=> 'Flash Message',
          'parent_slug'	=> 'ws-general-settings',
      ));
  }

?>