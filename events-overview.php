<?php

/* https://webnus.net/dox/modern-events-calendar/overriding-mec-single-event-page/ */

global $post;

// Get the first 10 upcoming events:
 
$upcoming_events_args = array(
	'post_type'=> 'mec-events',
	'orderby'  => 'dstart',
	'order'    => 'ASC',
	'posts_per_page' => '10',
	'meta_query' => array(
        array(
            'key' => 'mec_start_date',
            'value' => date("Y-m-d"),
            'compare' => '>=',
            'type' => 'DATE'
        )
    )
); 

$upcoming_events_query = new WP_Query( $upcoming_events_args );
 
if($upcoming_events_query->have_posts() ) : ?>

	<div class="heading-block border-dark-all" >
		<h1>Upcoming events</h1>
	</div>

    <div class="upcoming-events-overview-wrapper">

        <?php while ( $upcoming_events_query->have_posts() ) : $upcoming_events_query->the_post();?>
      
      
			<?php		
		
			$mecStartDate = get_field('mec_start_date');		
			$displayStartDate = date("l, j F Y", strtotime($mecStartDate));
		
			$mecEndDate = get_field('mec_end_date');
			$displayEndtDate = date("l, j F Y", strtotime($mecEndDate));

			$startTimeString = get_field('mec_start_time_hour') . ':' . get_field('mec_start_time_minutes') . ' ' . get_field('mec_start_time_ampm'); 
			$startTimeFormat = DateTime::createFromFormat('h:i A', $startTimeString);
			$startTime_24 = $startTimeFormat->format('H:i');

			$endTimeString = get_field('mec_end_time_hour') . ':' . get_field('mec_end_time_minutes') . ' ' . get_field('mec_end_time_ampm'); 
			$endTimeFormat = DateTime::createFromFormat('h:i A', $endTimeString);
			$endTime_24 = $endTimeFormat->format('H:i');

			$timeString = $displayStartDate . '. ' . $startTime_24 . ' - ' . $endTime_24;		

			?>
		
			<div id="event-container-grid-<?php the_ID(); ?>" class="event-container-grid">
				
				<div class="event-grid-left pad--l border-dark-all">
					
					<a class='oxy-post-image' href='<?php the_permalink(); ?>'>
      
      
						<?php
						if ( has_post_thumbnail() ) { ?>

						<div class='oxy-post-image-fixed-ratio-66 border-dark-all' style='background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);'>
							<span role="img" aria-label="<?php echo get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ); ?>"> </span>
						</div>

						<?php } else { ?>

						<div class='oxy-post-image-fixed-ratio-66' style='background-image: url("https://studio.rocketclowns.com/don/wp-content/uploads/2022/01/volksblur5.jpg");'>
							<span role="img" aria-label="This is an image that reflects the work of Donemus."> </span>
						</div>

						<?php } ?>

					</a>
					
				</div> <!-- end of event-grid-left -->
				
				
				<div class="event-grid-middle pad--l owl--s border-dark-top border-dark-right border-dark-bottom">
					
					<div class="event-text">
						
						<div class="event-date">
					
						<?php

						if ($mecStartDate == $mecEndDate) {              
						?>

						<div class="event-dates">
							<p> <?php echo $timeString; ?> </p>
						</div>

						<?php

						} else {							
							// TODO: different end date
							?>
							<div class="event-dates">
								<p> <?php echo $timeString; ?> </p>
							</div>
							<?php
						}

						?>
					</div> <!-- end of event date -->
						
						<a class='oxy-post-title link-normal-text-color' href='<?php the_permalink(); ?>'><h2><?php the_title(); ?></h2></a>
						
						<span class='oxy-post-content'><?php the_excerpt(); ?></span>
						
						<button type="button" class='btn--read-more btn--base' onclick="window.location.href='<?php the_permalink(); ?>';">About this event</button>
						
						<?php
						$related_composers = get_field('related_composers');
						if( $related_composers ):

							foreach( $related_composers as $related_composer ): 
								$permalink = get_permalink( $related_composer->ID );
								$title = get_the_title( $related_composer->ID );
								//$custom_field = get_field( 'field_name', $related_composer->ID );
								?>
						
								<div class="profile-link underline-links"><a class='link-normal-text-color link-bold'href='<?php echo esc_url( $permalink ); ?>'>To <?php echo esc_html( $title ); ?>'s profile</a></div>

							<?php endforeach; ?>
						<?php endif; ?>
						
						
						
					</div>
										
				</div> <!-- end of event-grid-middle -->
				
				
				<div class="event-grid-right pad--l border-dark-top border-dark-right border-dark-bottom">
					
					<span>Location:</span>
					
					<?php
					$single = new MEC_skin_single();
					$single_event_main = $single->get_event_mec(get_the_ID());
					$single_event_obj = $single_event_main[0];
					
					// Location Widget
					$single->display_location_widget($single_event_obj); // Show Location
					?>
					
				</div> <!-- end of event-grid-right -->
				
			</div> <!-- end of event-container-grid -->

		<?php endwhile; ?>
		
	</div> <!-- end of upcoming-events-overview-wrapper -->

<?php endif; wp_reset_query();



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


	<div class="heading-block border-dark-all" >
		<h1>Past events</h1>
	</div>

	<div class="past-events-overview-wrapper">

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
			?>


		
			<div id="past-event-container-grid" class="event-container-grid">
				
				<div class="event-grid-left border-dark-all">
					
					<?php echo $displayStartDate; ?>
					
				</div> <!-- end of event-grid-left -->
				
				
				<div class="event-grid-middle border-dark-top border-dark-right border-dark-bottom">
					
					<a class='oxy-post-title link-normal-text-color' href='<?php the_permalink(); ?>'><h2><?php the_title(); ?></h2></a>
					
				</div> <!-- end of event-grid-middle -->
				
				
				<div class="event-grid-right border-dark-top border-dark-right border-dark-bottom">
					
					<button type="button" class='btn--read-more btn--base' onclick="window.location.href='<?php the_permalink(); ?>';">About this event</button>
					
				</div> <!-- end of event-grid-right -->
				
			</div> <!-- end of event-container-grid -->

		<?php endwhile; ?>
		
	</div> <!-- end of past-events-overview-wrapper -->

	
	

<?php endif; wp_reset_query();
?>