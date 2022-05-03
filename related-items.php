<?php
$related_items = get_field('related_items');
if( $related_items ):

    foreach( $related_items as $related_item ):

		$permalink = get_permalink( $related_item->ID );
		$title = get_the_title( $related_item->ID );
        $post_type = get_post_type( $related_item->ID );
		
		?>


		<div class="related-post grid--3 grid--l-1 outline--medium">
			<a class='border--medium-right' href='<?php echo esc_url( $permalink ); ?>' data-aos="fade-up">
				
				<div class='related-post-padding outline--medium'>
					<div class='related-post-image'>
						<div class='related-post-image-fixed-ratio' style='background-image: url(<?php echo get_the_post_thumbnail_url( $related_item->ID ); ?>);'>
						</div>            
					</div>
				</div>

			</a>
			
			<div class="related-text width--l border--medium-right" data-aos="fade-up" data-aos-delay='100'>
				
				<div class=''>      
					<div class="text-small-caps">item</div>
					<h2><?php echo get_the_title( $related_item->ID ); ?></h2>
				</div>
				
				
				<div class="margin-top--m">
					
					<?php if ( $item_testimony = get_field( 'item_testimony', $related_item->ID ) ) : ?>
						<?php echo $item_testimony;
					else:
						echo get_the_excerpt( $related_item->ID); ?>
					<?php endif; ?>
										
				</div>
				
                <?php if ($post_type == 'composer') : ?>
				    <a href='<?php echo esc_url( $permalink ); ?>' class="related-profile-link underline-links text--white"><b>To <?php echo get_the_title( $related_item->ID ); ?>'s profile</b></a>
                <?php endif; ?>

			</div>
			
			<div class='pad--l' data-aos="fade-up" data-aos-delay='200'>
				<?php
				if (get_field('soundcloud_embed', $related_item->ID)) the_field('soundcloud_embed', $related_item->ID);
				?>
			</div>
			
		</div>

    <?php endforeach; ?>
<?php endif; ?>