<?php
// $Id$ 

/**
 * @file page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the current
 *   path, whether the user is logged in, and so on.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing primary navigation links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links for
 *   the site, if they have been configured.
 *
 * Page content (in order of occurrance in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 *
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the view
 *   and edit tabs when displaying a node).
 *
 * - $content: The main content of the current Drupal page.
 *
 * - $right: The HTML for the right sidebar.
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
  <head>
    <?php print $head ?>
    <title><?php print $head_title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <?php print $styles ?>
    <?php print $scripts ?>
    <!--[if lt IE 7]>
    <style type="text/css" media="all">@import "<?php print base_path() . path_to_theme() ?>/ie6.css";</style>
    <![endif]-->
  </head>
  <body class="<?php print $body_classes; ?>">

  <div id="wrap">

  <div id="header">
    <?php if ($header) { ?>
      <?php print $header ?> 
    <?php } ?>
    
    <div id="logo">
      <?php if ($logo) : ?>
      <a href="<?php print $front_page ?>"><img src="<?php print $logo ?>" alt="Logo" /></a>
      <?php else : ?>
      <?php if ($site_name) { ?>
        <h1 id="logo-text"><a href="<?php print $front_page ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a></h1>
      <?php } ?>
      <?php endif; ?>
      <?php if ($site_slogan) { ?>
        <p id="slogan"><?php print $site_slogan ?></p>
      <?php } ?>
    </div>
    
    <?php if ($search_box): ?>
      <?php print $search_box ?>
    <?php endif; ?>
    
    <div class="clear"></div>

    <div  id="nav">
      <?php if (isset($primary_links)) { ?>
        <?php print theme('links', $primary_links, array('class' => 'links', 'id' => 'navlist')) ?>
      <?php } ?>
    </div>
  </div>

  <div id="content-wrap"> 
    <?php if ($mission) { ?>
      <div id="mission"><?php print $mission ?></div>
    <?php } ?>
    <?php if ($splash) { ?>
      <div id="splash"><?php print $splash ?></div>
    <?php } ?>

    <div id="content">
      <?php if ($title) { ?>
        <h1 class="node-title"><?php print $title ?></h1>
      <?php } ?>
        <div class="tabs"><?php print $tabs ?></div>
        <?php if ($show_messages) { 
          print $messages; } 
        ?>
        <?php print $help ?>
        <?php print $content; ?>
        <?php print $feed_icons; ?>
    </div>
    
    <div id="sidebar">
    
    <?php
      $show_submenu = theme_get_setting('simpleclean_show_submenu');
      if ($show_submenu) {
        $tree = menu_tree_page_data('primary-links'); 
          foreach ($tree as $key => $mi) {
            if ($mi['link']['in_active_trail'] && $tree[$key]['below']) {    
              $menu = menu_tree_output($tree[$key]['below']);
              $menu = $menu . '</div>';
              $link = $mi['link']['link_path'];
              $title = $mi['link']['title'];
              print "<div class=\"submenu\"><h2 class=\"title-subnav\"><a href=\"/$link\">$title</a></h2>";
            }
          }
      print $menu;
      }
    ?>

      <?php if ($right) { ?>
        <?php print $right ?> 
      <?php } ?>        
    </div>

  </div>

  <div class="clear"></div>

  <div id="footer-wrap">
  
  <?php if ($footer) { ?>
    <?php print $footer ?> 
  <?php } ?>        

  <?php if ($footer_message) { ?>
    <div id="footer-message"><?php print $footer_message ?></div>
  <?php } ?>
  
    <div id="footer">
    This site is powered by <a href="http://drupal.org/">Drupal</a>. Theme: <a href="http://drupal.org/projects/simpleclean">Simple Clean</a> by <a href="http://drupal.org/user/765764">acke</a> @ <a href="http://www.happiness.se/">happiness</a>.
    <?php // Feel free to remove credits if you want your site even cleaner ;) /acke ?>    
    </div>
  </div>
    
  <div class="clear"></div>

</div>

<?php print $closure ?>

</body>
</html>