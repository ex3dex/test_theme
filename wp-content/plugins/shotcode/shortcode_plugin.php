<?php
/*
Plugin Name: Next Game Shortcode
Description: Add buttons shortcode.
Version: 0.1
License: GPL
Author: Michael Malashevych
Author URI: none
*/

function button_template(){
?>
<button data-remodal-target="modal" class="next_games">
			Next Games
		</button>
		<div class="remodal" data-remodal-id="modal"
		  data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
			<div class="remodal_wrapper" id="remodal_wrapper">
				
			</div>
		  <button data-remodal-action="close" class="remodal-close clear_html"></button>
		  
		  <button data-remodal-action="confirm" class="remodal-confirm clear_html">OK</button>
		</div>
<?php
}
function button_shortcode() {
    ob_start();
    button_template();
    $button = ob_get_clean();
    return $button;
}
add_shortcode( 'next_games', 'button_shortcode' );

?>