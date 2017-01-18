<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'remodal-default', get_stylesheet_directory_uri() . '/css/remodal-default-theme.css' );
    wp_enqueue_style( 'remodal', get_stylesheet_directory_uri() . '/css/remodal.css' );
    // Custom javascript
  wp_enqueue_script( 'global', get_stylesheet_directory_uri() . '/js/global.js', null, null, true );
  //Plugins
  wp_enqueue_script( 'remodal', get_stylesheet_directory_uri() . '/js/remodal.min.js', null, null, true );
 
}


// Login Screen Customization
  function wordpress_login_styling() { ?>
    <style>
      .login #login h1 a {
        background-image: url('<?php echo get_header_image(); ?>');
        background-size: contain;
        width: auto;
        height: 220px;
      }
      body.login{
        background-color: #<?php echo get_background_color(); ?>;
        background-image: url('<?php echo get_background_image(); ?>') !important;
        background-repeat: repeat;
        background-position: center center;
      };

    </style>
  <?php }
  add_action( 'login_enqueue_scripts', 'wordpress_login_styling' );

  function admin_logo_custom_url(){
    $site_url = home_url();
    return ($site_url);
  }
  add_filter('login_headerurl', 'admin_logo_custom_url');

// ajax handler
if ( !function_exists('next_games') ):

add_action('wp_ajax_next_games', 'next_games');
add_action('wp_ajax_nopriv_next_games', 'next_games');

function next_games() {

   global $wpdb;
   $time = date('Y-m-d');
   $events = $wpdb->get_results( "SELECT * FROM wp_em_events WHERE event_end_date >= '$time' ORDER BY event_start_date LIMIT 10");
   $output = array();

	foreach($events as $event) {
		array_push($output, array($event->event_name, get_permalink($event->post_id)));
	} 

   echo json_encode($output);


// HERE THE SOLUTION USING EVENT MANAGER API
//					||
//					||
//				   \  /
// function custom_events_list(){
//         $events = EM_Events::get(array('scope'=>'future','limit'=>10));
//         $start = false;
//         $limit = 3;
//         $count = 1;
//         foreach( $events as $EM_Event ){
//                 if ( !empty($EM_Event->event_name) ){
//                     if ( !$start ) { 
                    
//                      $start = true; 
//                     } 
//                     echo "<div class=event_in_popup>";
//                     	 echo $EM_Event->output("#_EVENTLINK"); 
//                     echo "</div>";
                       
//                         if ( $count == $limit ){ 
//                                 $start = false;
//                                 $count = 1;
//                         }else{
//                                 $count++;
//                         }
//                 }
//         }
// }


// custom_events_list();


die();

}

endif;

