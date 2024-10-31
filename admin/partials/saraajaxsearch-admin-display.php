<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://khadkaravi.com.np/
 * @since      1.0.0
 *
 * @package    Saraajaxsearch
 * @subpackage Saraajaxsearch/admin/partials
 */

add_action("admin_menu", "add_new_menu_items");
function add_new_menu_items()
{
    add_menu_page(
        "Sara Ajax Search",
        "Sara Search",
        "manage_options",
        "dr-sara-ajax",
        "dr_sara_ajax_option_page",
        "",
        99
    );
    add_action('admin_init','sara_ajax_register_setting');

}
function sara_ajax_register_setting(){
    register_setting('dr-sara-ajax-search-group','dr_sara_search_total');
    register_setting('dr-sara-ajax-search-group','dr_sara_search_thumbnail');
    register_setting('dr-sara-ajax-search-group','dr_sara_search_title');
    $sasPostTypes = get_post_types();
foreach($sasPostTypes as $sasPostType){
    if($sasPostType=='post' || $sasPostType=='page'){
        register_setting('dr-sara-ajax-search-group','dr_sara_search_'.$sasPostType);  
    }
    
}
register_setting('dr-sara-ajax-search-group','dr_sara_search_d_post');
  
}

function dr_sara_ajax_option_page()
{
    ?>
        <div class="wrap">
        <div id="icon-options-general" class="icon32"></div>
        <h1><?php _e('Dashboard','saraajaxsearch'); ?></h1>
       

        <?php
            //we check if the page is visited by click on the tabs or on the menu button.
            //then we get the active tab.
            $currentTab = "sara-search";
            if(isset($_GET["tab"]))
            {
                if($_GET["tab"] == "sara-search")
                {
                    $currentTab = "sara-search";
                }
                else
                {
                    $currentTab = "basic-options";
                }
            }
        ?>
       
        <!-- wordpress provides the styling for tabs. -->
        <h2 class="nav-tab-wrapper">
            <!-- when tab buttons are clicked we jump back to the same page but with a new parameter that represents the clicked tab. accordingly we make it active -->
            <a href="?page=dr-sara-ajax&tab=sara-search" class="nav-tab <?php if($currentTab == 'sara-search'){echo 'nav-tab-active';} ?> "><?php _e('Welcome!', 'saraajaxsearch'); ?></a>
            <a href="?page=dr-sara-ajax&tab=basic-options" class="nav-tab <?php if($currentTab == 'basic-options'){echo 'nav-tab-active';} ?>"><?php _e('Basic Settings', 'saraajaxsearch'); ?></a>
        </h2>
        <form method="post" action="options.php">
        <?php
        
           do_settings_sections("dr-sara-ajax");

           settings_fields( 'dr-sara-ajax-search-group' );
           do_settings_sections('dr-sara-ajax-search-group');
          
       ?>  
        </form>
        <div class="row">
<div class="dr-sara-ytd">
<div class="col-md-12 ">

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-outline-dark video-btn rounded-0" data-toggle="modal"
    data-src="https://www.youtube.com/embed/s_l4fRxq_RI" data-target="#myModal">
   <?php _e(' Watch Setup','saraajaxsearch'); ?>
  </button>
 





  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-body">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <!-- 16:9 aspect ratio -->
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/s_l4fRxq_RI" id="video"
              allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
         
        </div>

      </div>
    </div>
  </div>


</div>
</div>

         <div class="col-md-12 text-center mt-1">
       
         <a href="https://www.youtube.com/channel/UCMpYrMP-jk-07DWx6C473qQ?sub_confirmation=1" target="_BLANK" >
         <div class="py-0">
        
            <div class="g-ytsubscribe" data-channelid="UCMpYrMP-jk-07DWx6C473qQ" data-layout="full" data-count="default"></div>
         </a>
            <!-- <h4>Follow Us</h4> -->
            
            <br>
            <span><b style='color:#575252;'><?php _e('Develop By:','saraajaxsearch'); ?></b> <a href="<?php echo esc_url('https://profiles.wordpress.org/ravikhadka/'); ?>" target="_BLANK"><?php _e('Ravi Khadka','saraajaxsearch'); ?></a> <?php _e('and','saraajaxsearch'); ?> <a href="<?php echo esc_url('https://profiles.wordpress.org/saralaphuyal/'); ?>" target="_BLANK">
                                    <?php _e('Sarala Phuyal','saraajaxsearch'); ?>
                                    </a></span>
            </div>
            <ul class="social-network social-circle">
             <li><a href="<?php echo esc_url('https://www.facebook.com/srdeveloperravi/'); ?>" target="_BLANK" class="icoFacebook" title="Facebook"><i class="dashicons dashicons-facebook-alt"></i></a></li>
             <li><a href="<?php echo esc_url('https://www.instagram.com/developerravi/'); ?>" target="_BLANK" class="icoInstagram" title="Instagram"><i class="dashicons dashicons-instagram"></i></a></li>
             <li><a href="<?php echo esc_url('https://profiles.wordpress.org/saralaphuyal/'); ?>" target="_BLANK" class="icoWordpress" title="WordPress"><i class="dashicons dashicons-wordpress"></i></a></li>




            </ul>				
		</div>
       </div>
         </div>
 
    <?php
}


add_action("admin_init", "display_options");
function display_options()
{
    
    //here we display the sections and options in the settings page based on the active tab
    if(isset($_GET["tab"]))
    {
        if($_GET["tab"] == "sara-search")
        {
            add_settings_section("sara_ajax_search_dashboard_section", "", "sara_ajax_search_msg", "dr-sara-ajax");
           
        }
        else
        {
            add_settings_section("dr_sara_basic_setting", "", "sara_ajax_display_basic_settings", "dr-sara-ajax");
        }
    }
    else
    {
        add_settings_section("sara_ajax_search_dashboard_section", "", "sara_ajax_search_msg", "dr-sara-ajax");
        
    }
   
}
function sara_ajax_search_msg(){
  ?>
  <div class="container my-5">
  
  <center>
  <table class='body-wrap' style='text-align:center;width:95%;font-family:arial,sans-serif;border:12px solid rgba(126, 122, 122, 0.08);border-spacing:4px 20px;' >
        <tr>
       <h3 class="py-4 text-info"><?php _e('Sara Ajax Search','saraajaxsearch'); ?></h3>
          </tr>
          <tr>
            <td>
                <center>
                    <table bgcolor='#FFFFFF'  border='0'>
                        <tbody>
                            <tr class="">
                                <td style='color:#202020;'>
                                    <h1 style='color:#575252;text-align:center;' class="text-dark py-3"><?php _e('Welcome to Sara Ajax Search','saraajaxsearch'); ?></h1>

                                </td>
                            </tr>
                            <tr style='text-align:center;color:#575252;font-size:14px;'>
                                <td>
                                    <span><h3 class="pt-3 text-success"> <?php _e('Congratulations','saraajaxsearch'); ?><h3></span>
                                </td>
                            </tr>
                            <tr style='text-align:center;color:#a2a2a2;font-size:14px;'>
                                <td>
                                    <span><?php 
                                    _e('Now You can use live ajax search feature in your website.','saraajaxsearch');
                                    ?></span>
                                </td>
                               
                            </tr>
                           
                        </tbody>
                       
                    </table>
                    <br><br>
                </center>
            </td>
          
        </tr>
    </table></center>

  
       
  

  
</div>

  
  <?php 
}

function sara_ajax_display_basic_settings()
{
    settings_fields("dr-sara-ajax");

    $sasTotalPost = get_option('dr_sara_search_total');
    $sasThumbnails = get_option('dr_sara_search_thumbnail');
    $sasPostTitle = get_option('dr_sara_search_title');
    $sasDisplayInPost = get_option('dr_sara_search_d_post');
    
    $sasPostTypes = get_post_types();

    foreach($sasPostTypes as $sasPostType){
        if($sasPostType=='post' || $sasPostType=='page'){
            $dr_sara_type ='dr_sara_search_'.$sasPostType;
            $sasTypeNames[] ='dr_sara_search_'.$sasPostType;
            $dr_sara_type = get_option('dr_sara_search_'.$sasPostType);  
        }
        
    }
   
    ?>
    
    <div class="container pt-4">

<div class="row py-2">
<div class="custom-control">
<label ><?php _e('How many posts would you like to show in the search?','saraajaxsearch'); ?></label>
          <input type="number" name="dr_sara_search_total" min='1' value="<?php echo $sasTotalPost; ?>" >    
      </div>
</div>

  <div class="row py-2">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" name ="dr_sara_search_thumbnail" id="customSwitch1" <?php if($sasThumbnails=='on'){ echo 'checked';} ?>>
        <label class="custom-control-label" for="customSwitch1"><?php _e('Do you show the picture?','saraajaxsearch'); ?></label>
    </div>
  </div>

    <div class="row py-2">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" name="dr_sara_search_title" id="customSwitch2" <?php if($sasPostTitle=='on'){ echo 'checked'; } ?>>
        <label class="custom-control-label " for="customSwitch2"><?php _e('Do you show the title?','saraajaxsearch'); ?></label>
    </div>
  </div>  
 
<?php $sasPostTypes = get_post_types();
$dr_i = 35;
foreach($sasPostTypes as $sasPostType){
    if($sasPostType=='post' || $sasPostType=='page'){
        ?>
         <div class="row py-2">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" name="dr_sara_search_<?php echo $sasPostType; ?>" id="customSwitch<?php echo $dr_i; ?>" <?php 
         foreach($sasTypeNames as $sasTypeName){
            $dr_g = get_option($sasTypeName);
            if($dr_g=='on' && $sasTypeName=="dr_sara_search_".$sasPostType){
                echo 'checked';
            }
            }
        ?>>
        <label class="custom-control-label " for="customSwitch<?php echo $dr_i; ?>"><?php _e('do you like to display search result from '.$sasPostType,'saraajaxsearch'); ?></label>
    </div>
  </div>
        <?php
    }
    $dr_i++;
}
?> 



<div class="row py-2">
  <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" name ="dr_sara_search_d_post" id="customSwitch4" <?php if($sasDisplayInPost=='on'){ echo 'checked';} ?>>
      <label class="custom-control-label" for="customSwitch4"><?php _e('Do you want to show in the every post?','saraajaxsearch'); ?></label>
  </div>
</div>


<div class="row py-2">
<div class="custom-control">
<label ><?php _e('copy this shortcode'); ?></label>
          <input type="text" name="shortcode" min='1' value="[sara_search]" readonly>    
      </div>
</div>

<div class="container-fluid">
     <?php submit_button(); ?>
</div>



    <?php
}

