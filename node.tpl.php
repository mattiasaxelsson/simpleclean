<?php
// $Id$ 
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">
 
<?php if ($page == 0): ?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>

  <?php if ($submitted): ?>
    <span class="submitted"><?php print $submitted; ?></span>
  <?php endif; ?>

  <div class="content clear-block">
    <?php print $content ?>
  </div>

  <div class="clear-block">
    <div class="meta">
    <?php if ($taxonomy): ?>
      <div class="terms"><?php print $terms ?></div>
    <?php endif;?>
    </div>

    <?php if ($links): ?>
      <div class="links"><?php print $links; ?></div>
    <?php endif; ?>
  </div>


<?php if ($page != 0): ?>
  <?php if ($submitted): ?>
    <div class="post-footer">
    <?php print $picture ?>
    <h3><?php print $title ?></h3>
    <span class="submitted"><?php print $submitted; ?></span>
      <?php $account = user_load(array('uid' => $node->uid)); if (!empty($account->signature)) { ?>
        <p><?php print check_plain($account->signature); ?></p>
      <?php } ?>
    </div>
  <?php endif; ?>
<?php endif; ?>
  
</div>
