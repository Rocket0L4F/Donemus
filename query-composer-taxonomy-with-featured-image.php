<?php

$args = array(
	'post_type' => 'composer',
	'orderby' => 'rand',
	'posts_per_page' => 1,
	'tax_query' => array(
		array(
			'taxonomy' => 'attribute',
			'field'    => 'slug',
			'terms'    => 'editorschoice',
		),
	),
	'meta_query' => array(
		array(
			 'key' 		=> '_thumbnail_id',
			 'compare' 	=> 'EXISTS'
        ),
	),
);

?>