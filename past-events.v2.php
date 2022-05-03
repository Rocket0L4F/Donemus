<?php

/* https://webnus.net/dox/modern-events-calendar/overriding-mec-single-event-page/ */

global $post;

$currentMonth = date('m'); //01
$currentYear = date('Y'); //2022

// Get the last 10 past events:
 
$past_events_args = array(
	'post_type'=> 'mec-events',
	'orderby'  => 'dstart',
	'order'    => 'DESC',
	'posts_per_page' => -1,
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

?>

<div class="heading-block outline-dark" data-aos="fade-up" data-aos-delay="0">
    <h1>Past events</h1>
</div>

<div class="past-events-overview-wrapper">
    
    <div id="past-event-container-grid" class="event-container-grid">

        <div class="event-grid-left outline-dark owl--m" data-aos="fade-up" data-aos-delay="0">

            <?php
                $date = date("Y-m-d");
                $newdate = date("Y-m-d", strtotime ( '-1 month' , strtotime ( $date ) )) ;
                echo $newdate;
            ?>

            <?php while ( $past_events_query->have_posts() ) : $past_events_query->the_post();

                $mecStartDate = get_field('mec_start_date');
                $eventMonth = date('m', strtotime($mecStartDate));
                $eventYear = date('Y', strtotime($mecStartDate));

                if ($eventMonth == $currentMonth && $eventYear == $currentYear) : ?>
                    <a class='oxy-post-title link-normal-text-color' href='<?php the_permalink(); ?>'><h2><?php the_title(); ?></h2></a>
                <?php endif; ?>

            <?php endwhile; 
            rewind_posts(); ?>

        </div>

        <?php
        $currentMonth -= 1;
        if ($currentMonth == 0) {
            $currentYear =- 1;
            $currentMonth = 12;
        }
        ?>


        <div class="event-grid-middle outline-dark owl--m" data-aos="fade-up" data-aos-delay="100">

            <?php
                $date = date("Y-m-d");
                $newdate = date("Y-m-d", strtotime ( '-1 month' , strtotime ( $date ) )) ;
                echo $newdate;
            ?>

            <?php while ( $past_events_query->have_posts() ) : $past_events_query->the_post();

                $mecStartDate = get_field('mec_start_date');
                $eventMonth = date('m', strtotime($mecStartDate));
                $eventYear = date('Y', strtotime($mecStartDate));

                if ($eventMonth == $currentMonth && $eventYear == $currentYear) : ?>
                    <a class='oxy-post-title link-normal-text-color' href='<?php the_permalink(); ?>'><h2><?php the_title(); ?></h2></a>
                <?php endif; ?>

            <?php endwhile; 
            rewind_posts(); ?>

        </div>

        <?php
        $currentMonth -= 1;
        if ($currentMonth == 0) {
            $currentYear =- 1;
            $currentMonth = 12;
        }
        ?>


        <div class="event-grid-right outline-dark owl--m" data-aos="fade-up" data-aos-delay="200">

            <?php
                $date = date("Y-m-d");
                $newdate = date("Y-m-d", strtotime ( '-2 month' , strtotime ( $date ) )) ;
                echo $newdate;
            ?>

            <?php while ( $past_events_query->have_posts() ) : $past_events_query->the_post();

                $mecStartDate = get_field('mec_start_date');
                $eventMonth = date('m', strtotime($mecStartDate));
                $eventYear = date('Y', strtotime($mecStartDate));

                if ($eventMonth == $currentMonth && $eventYear == $currentYear) : ?>
                    <a class='oxy-post-title link-normal-text-color' href='<?php the_permalink(); ?>'><h2><?php the_title(); ?></h2></a>
                <?php endif; ?>

            <?php endwhile; 
            rewind_posts(); ?>

        </div>
    
    </div> <!-- end of event-container-grid -->
    
</div> <!-- end of past-events-overview-wrapper -->

<?php wp_reset_query();
?>