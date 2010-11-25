<?php
// $Id$

/**
 * @file template.php
 *
 * Contains theme preprocess functions
 */
 
if (is_null(theme_get_setting('simpleclean_show_submenu'))) {  // <-- change this line
  global $theme_key;

  /*
   * The default values for the theme variables. Make sure $defaults exactly
   * matches the $defaults in the theme-settings.php file.
   */
  $defaults = array(             // <-- change this array
    'simpleclean_show_submenu' => 1
  );

  // Get default theme settings.
  $settings = theme_get_settings($theme_key);
  // Don't save the toggle_node_info_ variables.
  if (module_exists('node')) {
    foreach (node_get_types() as $type => $name) {
      unset($settings['toggle_node_info_' . $type]);
    }
  }
  // Save default theme settings.
  variable_set(
    str_replace('/', '_', 'theme_'. $theme_key .'_settings'),
    array_merge($defaults, $settings)
  );
  // Force refresh of Drupal internals.
  theme_get_setting('', TRUE);
}

function simpleclean_preprocess_page(&$vars) {
  // Remove double meta content-type tag
  $vars['head'] = preg_replace('/<meta http-equiv=\"Content-Type\"[^>]*>/', '', $vars['head']);
}

function simpleclean_preprocess_comment_wrapper(&$vars) {
  // Add a "Comments" heading above comments except on forum pages.
  if ($vars['content'] && $vars['node']->type != 'forum') {
    $vars['content'] = '<h2 class="comments">'. t('Comments') .'</h2>'.  $vars['content'];
  }
}

function simpleclean_node_submitted($node) {
  return t('By !username on @date', array(
    '!username' => theme('username', $node),
    '@date' => format_date($node->created, 'custom', 'd M Y')
  ));
}

function simpleclean_comment_submitted($comment) {
  return t('By !username on @date at about @time.', array(
    '!username' => theme('username', $comment),
    '@date' => format_date($comment->timestamp, 'custom', 'd M Y'),
    '@time' => format_date($comment->timestamp, 'custom', 'H:i')
  ));
}

function simpleclean_preprocess_search_results(&$variables) {

  // define the number of results being shown on a page
  $items_per_page = 10;

  // get the current page
  $current_page = $_REQUEST['page']+1;

  // get the total number of results from the $GLOBALS
  $total = $GLOBALS['pager_total_items'][0];
   
  // perform calculation
  $start = 10*$current_page-9;
  $end = $items_per_page * $current_page;
  if ($end>$total) $end = $total;
   
  // set this html to the $variables
  if ($total > 1) {
      $variables['simpleclean_search_totals'] = '<p>'. t('Displaying @start - @end of @total results', array('@start' => $start, '@end' => $end, '@total' => $total)) .'</p>';
  }
  else {
  $variables['simpleclean_search_totals'] = '<p>'. t('Displaying @start - @end of @total result', array('@start' => $start, '@end' => $end, '@total' => $total)) .'</p>';
}
}