<?php
// $Id$ 

/*
 * @file search-results.tpl.php
 * Add number of hits to search results
 *
 */
?>
<?php print $simpleclean_search_totals; ?>
<dl class="search-results <?php print $type; ?>-results">
  <?php print $search_results; ?>
</dl>
<?php print $pager; 
