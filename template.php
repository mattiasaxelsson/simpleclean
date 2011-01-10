<?php
// $Id$

/**
 * @file
 * Contains theme preprocess functions
 */
 
 /**
 * Override or insert variables into the html template.
 */
function simpleclean_preprocess_html(&$vars) {
  // Add conditional CSS for IE6.
  drupal_add_css(path_to_theme() . '/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lt IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
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