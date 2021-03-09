<?php 

$args_gesschichten = array(
    'post_type'   => 'geschichten',
    'post_status' => 'publish',
    'orderby' => 'rand',
    'posts_per_page'=> '1'
);

landscape_card($args_gesschichten, 'Geschichten & Menschen','', '', '/geschichten'); 

?>