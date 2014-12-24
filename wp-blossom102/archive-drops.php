<div class="index-3-4-archives clearfix">

	<select class="monarchives" name="archive-dropdown-2" onchange='document.location.href=this.options[this.selectedIndex].value;'>
		<option value=""><?php echo attribute_escape(__('Monthly Archives', 'solostream')); ?></option>
		<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?>
	</select>
	<noscript><input type="submit" value="<?php _e("Go", "solostream"); ?>" /></noscript>


	<form class="catarchives" action="<?php bloginfo('url'); ?>/" method="get">
		<?php 
			$select = wp_dropdown_categories('show_option_none=' . __('Category Archives', 'solostream') .'&show_count=1&orderby=name&echo=0&hierarchical=1&id=catdrop2');
			$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
			echo $select;
		?>
		<noscript><input type="submit" value="<?php _e("Go", "solostream"); ?>" /></noscript>
	</form>

</div>