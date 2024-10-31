<?php 



add_action('wp_ajax_sara_ajax_search' , 'sara_ajax_search');
add_action('wp_ajax_nopriv_sara_ajax_search','sara_ajax_search');


function sara_ajax_search(){
	$sasTotalPost = get_option('dr_sara_search_total');
    $sasThumbnails = get_option('dr_sara_search_thumbnail');
    $sasPostTitle = get_option('dr_sara_search_title');
    
    $sasPostTypes = get_post_types();

    foreach($sasPostTypes as $sasPostType){
        if($sasPostType=='post' || $sasPostType=='page'){
            $dr_sara_type ='dr_sara_search_'.$sasPostType;
            $sasTypeNames[] ='dr_sara_search_'.$sasPostType;
            $dr_sara_type_nams[] =$sasPostType;
            $dr_sara_type = get_option('dr_sara_search_'.$sasPostType);  
		}
		

		foreach($sasTypeNames as $sasTypeName){
			$dr_g = get_option($sasTypeName);
			if($dr_g=='on' && $sasTypeName=="dr_sara_search_".$sasPostType){
				$sasPostTypeArr[] = $sasPostType;
			}
			}

        
	}
	 


	


    $the_query = new WP_Query( array( 'posts_per_page' => $sasTotalPost, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => $sasPostTypeArr ) );
    if( $the_query->have_posts() ) :
        while( $the_query->have_posts() ): $the_query->the_post(); ?>
	<div class="dr-row" style="margin: 5px 0px;">
	<?php 
	if($sasThumbnails=='on'){ ?>
<div class="dr-sm-4">
<?php 

the_post_thumbnail( 'full', array( 'class' => 'dr-img' ) );

?>
</div>
	<?php }
	if($sasPostTitle=='on'){
	?>
<div class="dr-sm-8">
<a href="<?php echo esc_url( post_permalink() ); ?>"><?php the_title();?></a>
</div>
	<?php  } ?>

</div>
           

        <?php endwhile;
		wp_reset_postdata();  
	else: 
		echo '<h3>No Results Found</h3>';
    endif;

    die();
}

// add the ajax fetch js
add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
?>
<script type="text/javascript">
function sas_FetchResults(){
	var keyword = jQuery('#searchInput').val();
	if(keyword == ""){
		jQuery('#saraDisplay').html("");
	} else {
		// if(keyword.length>=3){
		jQuery.ajax({
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			type: 'post',
			data: { action: 'sara_ajax_search', keyword: keyword  },
			success: function(data) {
				jQuery('#saraDisplay').html( data );
			}
		});
	// }
	}
    

}
</script>

<?php

}


// }

?>
