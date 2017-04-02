<?php
/*** The html form for search input. ***/
?>

<div class="form-group search has-feedback" >
	<form action="<?php echo esc_url( site_url() ); ?>" role="search" method="get">
		<input type="text" class="form-control" name="s" id="search" value="<?php esc_attr(the_search_query()); ?>" placeholder="<?php esc_attr_e('Search...', 'elbrus');?>" autocomplete="off">
		<span class="icon icon-Search form-control-feedback"></span>
		<button type="submit"></button>
		<input type="hidden" name="post_type" value="post" />
	</form>
</div>