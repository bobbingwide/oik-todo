<?php
/*
Plugin Name: oik todo list 
Plugin URI: https://www.oik-plugins.com/oik-plugins/oik-todo
Description: oik todo - TODO list custom post type 
Depends: oik base plugin
Version: 0.3.0
Author: bobbingwide
Author URI: https://bobbingwide.com/about-bobbing-wide/
Text Domain: oik-todo
Domain Path: /languages/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

    Copyright 2013-2015, 2023 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/

/**
 * Implement "oik_fields_loaded" action for oik-todo
 */
function oik_todo_init( ) {
  oik_register_oik_todo();
}

/**
 * Implement "oik_admin_menu" to register our plugin server
 */
function oik_todo_oik_admin_menu() {
	oik_register_plugin_server( __FILE__ );
}

/**
 *
 * Return an array of Task size estimates
 *
 * Size    Estimate
 * ------  --------
 * Tiny    < 1 hour
 * Small   < 1 day
 * Medium  2-3 days
 * Large   1-2 weeks
 * V Large up to a month
 */ 
function oik_todo_task_size() {
  $task_size = array( 0
                    , "Tiny"
                    , "Small"
                    , "Medium"
                    , "Large"
                    , "V.Large"
                    );
  return( $task_size );
}

/**
 *
 * Return an array of task complexities 
 * 
 * Trivial - very easy to do
 * Simple - easy to do - e.g. this oik-todo plugin
 * Average - requires a bit of thought / planning / testing
 * Complex - complicated programming or testing or installation/configuration
 * V.Complex - e.g. oik-clone plugin
 */ 
function oik_todo_task_complexity() {
  $task_complexity = array( 0 
                    , "Trivial"
                    , "Simple"
                    , "Average"
                    , "Complex"
                    , "V.Complex"
                    );
  return( $task_complexity );
} 

/**
 * Return an array of the Value of doing this.
 * @deprecated - see Priority category
 * 
 * What's it worth? Why do it? 
 * 
 * 
 */
function oik_todo_task_value() {
  $task_value = array( "None"
                     , "Low"
                     , "Medium"
                     , "Optional"
                     , "Mandatory"
                     , "High"
                     , "V.High"
                     );
  return( $task_value );                     
}

/** 
 * Register custom post type "oik_todo"
 *  
 * The title should contain the task 
 * The description of the task is the content field
 * There should be categories for the Priority and Status
 * Tasks should be hiearchical
 * TODO items can be listed in an archive.
 */
function oik_register_oik_todo() {
  $post_type = 'oik_todo';
  $post_type_args = array();
  $post_type_args['label'] = 'TODO';
  $post_type_args['description'] = 'TODO list items';
  $post_type_args['hierarchical'] = true; 
	$post_type_args['has_archive'] = true;
	$post_type_args['menu_icon'] =  'dashicons-clipboard';

  // This line was after the bw_register_post_type() call.
  // It was probably moved in order to try out some things with oik-types.
  // 
  //$post_type_args['supports'] = array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'publicize', 'author' );
  
  bw_register_post_type( $post_type, $post_type_args );
  //add_post_type_support( $post_type, 'page-attributes' );
  //add_post_type_support( $post_type, 'author' );
  
  
  // bw_register_field( "_oik_todo_ref", "noderef", "Reference" ); 
  bw_register_field( "_oik_todo_start", "date", "Start date" );
  bw_register_field( "_oik_todo_end", "date", "End date" ); 
  bw_register_field( "_oik_todo_size", "select", "Size", array( '#options' => oik_todo_task_size(), '#optional' => true ) ); 
  bw_register_field( "_oik_todo_complexity", "select", "Complexity", array( '#options' => oik_todo_task_complexity(), '#optional' => true ) ); 
  //bw_register_field_for_object_type( "_oik_todo_ref", $post_type );
  bw_register_field_for_object_type( "_oik_todo_start", $post_type );
  bw_register_field_for_object_type( "_oik_todo_end", $post_type );
  bw_register_field_for_object_type( "_oik_todo_size", $post_type );
  bw_register_field_for_object_type( "_oik_todo_complexity", $post_type );
  $taxonomy = 'todo_priority'; 
  $labels = array( "labels" => array( "singular_name" => __( "Priority" ), "name" => __( "Priorities" ) ) );
  bw_register_custom_category( $taxonomy, $post_type, $labels );
  $taxonomy = "todo_status";
  $labels = array( "labels" => array( "singular_name" => __( "Status" ), "name" => __( "Statuses" ) ) );
  bw_register_custom_category( $taxonomy, $post_type, $labels );
  add_filter( "manage_edit-{$post_type}_columns", "oik_todo_columns", 10, 1 );
  add_action( "manage_{$post_type}_posts_custom_column", "bw_custom_column_admin", 10, 2 );
}

/**
 * Columns to display in the admin page
 */
function oik_todo_columns( $columns ) {
  //$columns["_oik_todo_ref"] = __("Reference"); 
  $columns["_oik_todo_start"] = __("Start"); 
  $columns["_oik_todo_end"] = __("End"); 
  bw_trace2();
  return( $columns ); 
} 
 
/**
 * Theme the _oik_todo_ref field
 * 
 * Current unused!
 */    
function _bw_theme_field_default__oik_todo_ref( $key, $value ) {
  e( $value[0] );
}

/** 
 * Function to invoke when oik-todo plugin file is loaded 
 */
function oik_todo_loaded() {
  add_action( 'oik_fields_loaded', 'oik_todo_init' );
	add_action( 'oik_admin_menu', 'oik_todo_oik_admin_menu' );
}

oik_todo_loaded();
