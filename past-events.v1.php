<?php

/* https://webnus.net/dox/modern-events-calendar/overriding-mec-single-event-page/ */

global $post;

// Get the last 10 past events:
 
$past_events_args = array(
	'post_type'=> 'mec-events',
	'orderby'  => 'dstart',
	'order'    => 'DESC',
	'posts_per_page' => '10',
	'meta_query' => array(
        array(
            'key' => 'mec_start_date',
            'value' => date("Y-m-d"),
            'compare' => '<',
            'type' => 'DATE'
        )
    )
); 

$past_events_query = new WP_Query( $past_events_args );

if($past_events_query->have_posts() ) : ?>


	<div class="heading-block outline-dark" data-aos="fade-up" data-aos-delay="0">
		<h1>Past events</h1>
	</div>

	<div class="past-events-overview-wrapper">
		
		<div id="past-event-container-grid" class="event-container-grid">
			
			<?php $gridindex = 1; ?>

			<?php while ( $past_events_query->have_posts() ) : $past_events_query->the_post();?>


				<?php			

				$mecStartDate = get_field('mec_start_date');
				$displayStartDate = date("l, j F Y", strtotime($mecStartDate));

				$mecEndDate = get_field('mec_end_date');
				$displayEndtDate = date("l, j F Y", strtotime($mecEndDate));

			/*

				$startTimeString = get_field('mec_start_time_hour') . ':' . get_field('mec_start_time_minutes') . ' ' . get_field('mec_start_time_ampm'); 
				$startTimeFormat = DateTime::createFromFormat('h:i A', $startTimeString);
				$startTime_24 = $startTimeFormat->format('H:i');

				$endTimeString = get_field('mec_end_time_hour') . ':' . get_field('mec_end_time_minutes') . ' ' . get_field('mec_end_time_ampm'); 
				$endTimeFormat = DateTime::createFromFormat('h:i A', $endTimeString);
				$endTime_24 = $endTimeFormat->format('H:i');

				$timeString = $displayStartDate . '. ' . $startTime_24 . ' - ' . $endTime_24;		
	*/
				

				switch($gridindex){ 
					case 1: 
					echo '<div class="event-grid-left outline-dark owl--m" data-aos="fade-up" data-aos-delay="0">'; 
					break; 
					case 2: 
					echo '<div class="event-grid-middle outline-dark owl--m" data-aos="fade-up" data-aos-delay="100">'; 
					break; 
					case 3: 
					echo '<div class="event-grid-right outline-dark owl--m" data-aos="fade-up" data-aos-delay="200">'; 
					break;  
				}
			
				?>
		
					
				<div class="event-date"><p><?php echo $displayStartDate; ?></p></div>
					<a class='oxy-post-title link-normal-text-color' href='<?php the_permalink(); ?>'><h2><?php the_title(); ?></h2></a>
			<span class='oxy-post-content'><?php the_excerpt(); ?></span>		
			<button type="button" class='btn--read-more btn--base btn--s' onclick="window.location.href='<?php the_permalink(); ?>';">About this event</button>

					
				</div> <!-- end of event-grid-->
				
				<?php
					$gridindex ++;
					if($gridindex == 4) $gridindex =1;
		?>

		<?php endwhile; ?>
		
		</div> <!-- end of event-container-grid -->
		
	</div> <!-- end of past-events-overview-wrapper -->

	
	

<?php endif; wp_reset_query();
?>