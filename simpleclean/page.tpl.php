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
    <?php if ($header) { ?><?php print $header ?> <?php } ?>	
    <div id="logo">
      <?php if($logo) : ?>
      <a href="<?php print $front_page ?>"><img src="<?php print $logo ?>" alt="Logo" /></a>
      <?php else : ?>
      <?php if ($site_name) { ?><h1 id="logo-text"><a href="<?php print $front_page ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a></h1><?php } ?>
      <?php endif; ?>
      <?php if ($site_slogan) { ?><p id="slogan"><?php print $site_slogan ?></p><?php } ?>
    </div>
    
    <?php if ($search_box): ?><?php print $search_box ?><?php endif; ?>
    
    <div class="clear"></div>
		
		<div  id="nav">
      <?php if (isset($primary_links)) { ?><?php print theme('links', $primary_links, array('class' => 'links', 'id' => 'navlist')) ?><?php } ?>	
    </div>	
  </div>
	
  <div id="content-wrap"> 
	
    <?php if ($mission) { ?><div id="mission"><?php print $mission ?></div><?php } ?>
    <?php if ($splash) { ?><div id="splash"><?php print $splash ?></div><?php } ?>
				
		<div id="content">
	    <?php if ($title) { ?><h1 class="node-title"><?php print $title ?></h1><?php } ?>
	      <div class="tabs"><?php print $tabs ?></div>
	      <?php if ($show_messages) { print $messages; } ?>
	      <?php print $help ?>
	      <?php print $content; ?>
	      <?php print $feed_icons; ?>				
		</div>
		
		<div id="sidebar">
		
		<?php
		  $show_submenu = theme_get_setting('show_submenu');
		  if ($show_submenu) {
        $tree = menu_tree_page_data('primary-links'); 
          foreach($tree as $key => $mi) {
            if ($mi['link']['in_active_trail'] && $tree[$key]['below']) {    
              $menu = menu_tree_output($tree[$key]['below']);
              $menu = $menu.'</div>';
              $link = $mi['link']['link_path'];
              $title = $mi['link']['title'];
              print "<div class=\"submenu\"><h2 class=\"title-subnav\"><a href=\"/$link\">$title</a></h2>";
            }
          }
      print $menu;
      }
    ?>

      <?php if ($right) { ?><?php print $right ?> <?php } ?>				
    </div>

  </div>

  <div class="clear"></div>

  <div id="footer-wrap">
	
  <?php if ($footer) { ?><?php print $footer ?> <?php } ?>				

  <?php if ($footer_message) { ?><div id="footer-message"><?php print $footer_message ?></div><?php } ?>
	
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