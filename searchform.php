<?php
?>
<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<input type="search" class="form-control" placeholder="Enter Search" value="<?php echo get_search_query() ?>" name="s" title="Search" />
	<button type="submit" id="searchsubmit" class = "btn" value="SEARCH" placeholder="Search" title = "SEARCH">SEARCH</button>
</form>


