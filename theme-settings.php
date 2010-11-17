<?php
// An example themes/garland/theme-settings.php file.

/**
* Implementation of THEMEHOOK_settings() function.
*
* @param $saved_settings
*   array An array of saved settings for this theme.
* @return
*   array A form array.
*/
function phptemplate_settings($saved_settings) {
  /*
   * The default values for the theme variables. Make sure $defaults exactly
   * matches the $defaults in the template.php file.
   */
  $defaults = array(
    'show_submenu' => 1,
  );

  // Merge the saved variables and their default values
  $settings = array_merge($defaults, $saved_settings);

  // Create the form widgets using Forms API
  $form['show_submenu'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show submenu (subnavigation in right column)'),
    '#default_value' => $settings['show_submenu'],
  );

  // Return the additional form widgets
  return $form;
}
?>