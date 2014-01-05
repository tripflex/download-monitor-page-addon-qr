<?php
/**
 * Plugin Name: Download Monitor Page Addon QR Code
 * Plugin URI:  https://github.com/tripflex/download-monitor-page-addon-qr
 * Description: Display QR code on Download Monitor information/detail page
 * Author:      Myles McNamara
 * Author URI:  http://smyl.es
 * Version:     1.0
 */

function add_qr_to_page (){
	// global variables needed
	global $dlm_download, $dlm_page_addon;
	// load our qr js file
	wp_enqueue_script('dlm_page_addon_qr_js', plugins_url('/qr.js',__FILE__), array('jquery'));
	wp_enqueue_style('dlm_page_addon_qr_css', plugins_url('/style.css',__FILE__));

	$qr_code_html = '<div class="qr-panel qr-panel-dlm"><div class="qr-panel-heading">QR Code</div><div class="qr-panel-body"><div id="dlm_qrcode"></div></div></div>';
	$qr_code_html .= '
	<script type="text/javascript">
		jQuery(document).ready(function(){
			var qrcode = new QRCode("dlm_qrcode", {
			    text: "'.$dlm_download->get_the_download_link().'",
			    width: 128,
			    height: 128,
			    colorDark : "#000000",
			    colorLight : "#ffffff",
			    correctLevel : QRCode.CorrectLevel.H
			});
		});
	</script>
	';
	// output everything
	echo $qr_code_html;
}

add_action('dlm_page_addon_aside_end', 'add_qr_to_page');