<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function set_up_bfb_cookie_banner() {
    $banner_data = array(
        'header'        =>  get_option('bigfoot_banner_header'),
        'banner_text'   =>  get_option('bigfoot_banner_text'),
    );
    $can_we_show_banner = true;
    foreach($banner_data as $item => $value) {
        if(empty($value)) {
            $can_we_show_banner = false;
        }
    }
		
    if($can_we_show_banner) {
        show_big_footer_banner($banner_data);
    }
}

function show_big_footer_banner($data) {
    echo "<div id='big-footer-banner' style='display:none;'>";
    echo "<div class='big-footer-banner-inner'>";
    echo "<span id='bfb-closer'>&#x2715;</span>";
    echo "<h2>" . $data['header'] . "</h2>";
    echo $data['banner_text'];
    echo "<button id='bfb-button'>Got it</button>";
    echo "</div></div>";
}

?>
