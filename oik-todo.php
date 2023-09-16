<?php
/*
Plugin Name: oik todo list 
Plugin URI: http://www.oik-plugins.com/oik-plugins/oik-todo.php
Description: oik todo 
Depends: oik base plugin
Version: 0.1
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2013 Bobbing Wide (email : herb@bobbingwide.com )

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

add_action( 'oik_fields_loaded', 'oik_todo_init' );

function oik_todo_init( ) {
  oik_register_oik_todo();
}

/**
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
  $task_size = array( "Tiny"
                    , "Small"
                    , "Medium"
                    , "Large"
                    , "V.Large"
                    );
  return( $task_size );
}


/**
 *
 * Trivial - very easy to do
 * Simple - easy to do - e.g. this oik-todo plugin
 * Average - requires a bit of thought / planning / testing
 * Complex - complicated programming or testing or installation/configuration
 * V.Complex - e.g. oik-clone plugin
 */ 
function oik_todo_task_complexity() {
  $task_complexity = array( "Trivial"
                    , "Simple"
                    , "Average"
                    , "Complex"
                    , "V.Complex"
                    );
  return( $task_complexity );
} 

/**
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
 */
function oik_register_oik_todo() {
  $post_type = 'oik_todo';
  $post_type_args = array();
  $post_type_args['label'] = 'todo';
  $post_type_args['description'] = 'todo list items';
  $post_type_args['hierarchical'] = true; 
  
  
  bw_register_post_type( $post_type, $post_type_args );
  add_post_type_support( $post_type, 'page-attributes' );
  
  bw_register_field( "_oik_todo_ref", "noderef", "Reference" ); 
  bw_register_field( "_oik_todo_start", "date", "Start date" );
  bw_register_field( "_oik_todo_end", "date", "End date" ); 
  bw_register_field( "_oik_todo_size", "select", "Size", array( '#options' => oik_todo_task_size() ) ); 
  bw_register_field( "_oik_todo_complexity", "select", "Complexity", array( '#options' => oik_todo_task_complexity() ) ); 
  
  //bw_register_field_for_object_type( "_oik_todo_ref", $post_type );
  bw_register_field_for_object_type( "_oik_todo_start", $post_type );
  bw_register_field_for_object_type( "_oik_todo_end", $post_type );
  bw_register_field_for_object_type( "_oik_todo_size", $post_type );
  bw_register_field_for_object_type( "_oik_todo_complexity", $post_type );
  $taxonomy = 'todo_priority'; 
  bw_register_custom_category( $taxonomy, $post_type, __( "Priority" ) );
  //register_taxonomy_for_object_type( $taxonomy, $post_type );
  $taxonomy = "todo_status";
  bw_register_custom_category( $taxonomy, $post_type, __( "Status" ) );
  //register_taxonomy_for_object_type( $taxonomy, $post_type );
  add_filter( "manage_edit-${post_type}_columns", "oik_todo_columns", 10, 2 );
  add_action( "manage_${post_type}_posts_custom_column", "bw_custom_column_admin", 10, 2 );
}

function oik_todo_columns( $columns, $arg2 ) {
  //$columns["_oik_todo_ref"] = __("Reference"); 
  $columns["_oik_todo_start"] = __("Start"); 
  $columns["_oik_todo_end"] = __("End"); 
  bw_trace2();
  return( $columns ); 
} 
 
function _bw_theme_field_default__oik_todo_ref( $key, $value ) {
  e( $value[0] );
}







  

 
