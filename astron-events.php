
<?php

global $post;
 
$args = array(
  'post_type'=> 'mec-events',
  'orderby'  => 'dstart',
  'order'    => 'ASC',
); 

$events_query = new WP_Query( $args );
 
if($events_query->have_posts() ) : ?>

    <div class="children-wrapper">

        <?php while ( $events_query->have_posts() ) : $events_query->the_post();?>
      
      
          <?php
              $mecStartDate = get_field('mec_start_date', $post->ID);
              $displayStartDate = date("D d M Y", strtotime($mecStartDate));

              $mecEndDate = get_field('mec_end_date', $post->ID);
              $displayEndDate = date("D d M Y", strtotime($mecEndDate));

              $today = date("Y-m-d");
      
              if ($today > $mecStartDate) {
                continue;
              }

          ?>

          <div id="parent-<?php the_ID(); ?>" class="child-page card" style="cursor: pointer;" onclick="window.location='<?php the_permalink(); ?>';">

            
            
            <a class='oxy-post-image' href='<?php the_permalink(); ?>'>
      
      
              <?php
			  if ( has_post_thumbnail() ) { ?>

			  <div class='oxy-post-image-fixed-ratio' style='background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);'>
				  <span role="img" aria-label="<?php echo get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ); ?>"> </span>
			  </div>

			  <?php } else { ?> 

			  <div class='oxy-post-image-fixed-ratio' style='background-image: url("https://studio.rocketclowns.com/astro/wp-content/uploads/2020/02/astronomy.jpg");'>
				<span role="img" aria-label="This is an image that reflects the work of ASTRON."> </span>
			  </div>

			   <?php } ?> 


            </a>
            
            <div class='oxy-post-text'>
              
              
              <div class = 'oxy-post-categories'>
    
                <?php

                $categories = get_the_category();

                foreach ($categories as $category){
                    echo '<a class="oxy-post-category" href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>';
                }
                ?>

              </div>
              
              
              <?php

              if ($mecStartDate == $mecEndDate) {              
                ?>

                <div class="event-dates">
                  <p> <?php echo $displayStartDate ?> </p>
                </div>

              <?php

              } else {
                ?>

                <div class="event-dates">
                  <p> <?php echo $displayStartDate ?> - <?php echo $displayEndDate ?> </p>
                </div>

              <?php

              }

              ?>
              
              
              <div class='oxy-post-title-container'>
                  <a class='oxy-post-title' href='<?php the_permalink(); ?>'><?php the_title(); ?></a>
              </div>
            

              

              <p><?php the_excerpt($post->ID); ?></p>
              
            </div>
            
            
            <div class='oxy-post-end-gradient'>
  			</div>
            
            
            

            <div class="read-more">
              	<span><svg style="overflow: visible" xmlns="http://www.w3.org/2000/svg" fill="#00a4e4" width="28" height="28" viewBox="0 -6 18 18"><path d="M7.5 4.5L6.44 5.56 9.88 9l-3.44 3.44L7.5 13.5 12 9z"/></svg><a href="<?php the_permalink(); ?>" style="color:#00529b; font-size:14px; font-weight:bold">READ MORE</a>
            </div>

            </div>

          <?php endwhile; ?>

     </div>
 
<?php endif; wp_reset_query();
      
      
 /*     
      
      $startday = date("Y-m-d");
      
      $args = array(
        'post_type'=> 'mec-events',
        'orderby' => 'dstart',
        'order'    => 'ASC',
    ); 
      
      $upcoming_events_query = new WP_Query( $args );
    if($upcoming_events_query->have_posts() ) {
        while ( $upcoming_events_query->have_posts() ) {
            $upcoming_events_query->the_post();
          echo the_title();
          
          echo get_post_field('mec_start_date');
          
          echo '<pre>';
print_r(get_post_custom(the_ID()));
echo '</pre>';
        }
    }
    
    
    */

?>