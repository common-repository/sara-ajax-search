

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>" id="searchform" autocomplete="off">
<label style="width:100%;">
<input type="text" class="field" placeholder="<?php esc_html_e('Search','despreker'); ?>" name="s" id="searchInput"  onkeyup="sas_FetchResults()" style="width:100%" />
</label>

<div id="saraDisplay">

</div>
</form>
