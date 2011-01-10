<?php
// $Id$ 

/**
 * @file
 * Theme implementation for comments.
 */
?>
<div class="<?php print $classes . ' ' . $zebra; ?>"<?php print $attributes; ?>>

  <div class="clearfix">
    
  <?php if ($picture): ?>
    <div class="user-picture">
      <?php print $picture; ?>
    </div>
  <?php endif; ?>

    <span class="submitted"><?php print $created; ?> &mdash; <?php print $author; ?></span>

  <?php if ($new) : ?>
    <span class="new"><?php print drupal_ucfirst($new) ?></span>
  <?php endif; ?>

  <?php print $picture ?>

    <?php print render($title_prefix); ?>
    <h3<?php print $title_attributes; ?>><?php print $title ?></h3>
    <?php print render($title_suffix); ?>

    <div class="content"<?php print $content_attributes; ?>>
      <?php hide($content['links']); print render($content); ?>
      <?php if ($signature): ?>
      <div class="clearfix">
        <div>&mdash;</div>
        <?php print $signature ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>