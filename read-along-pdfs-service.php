<div class='grid--2-1 grid--m-1 stretch outline--medium'>
	<div class='border--medium-right pad--l pdf-container'>
		
		<?php

		$purchases = get_field( 'pdf_embed_purchase' );
		
		foreach( $purchases as $purchase ): 

			if ( $purchase ) : // PDF viewing must be purchased

				$purchase_score_ids = get_field('score_pdf_id', $purchase);

				foreach( $purchase_score_ids as  $key => $purchase_score_id ): 

					$purchase_score_pdf = get_field('score_pdf', $purchase_score_id);

					$url = $purchase_score_pdf['url'];
					$title = $purchase_score_pdf['title'];
					?>
					<h2 class='pdf-title'><?php echo $title; ?></h2>
					<?php

					$current_user = get_current_user_id();

					if( edd_has_user_purchased($current_user, $purchase) ) { 

						?>
						<div class='pdf-max-width'>
							<?php echo do_shortcode('[pdf-embedder url="' . $url . '"]'); ?>
						</div>
						<?php

					} else {

						?>
						<p> Read along with the score. </p>

						<?php
						if ($key === array_key_last($purchase_score_ids)) { //only show the purchase button on the last iteration

							echo do_shortcode('[purchase_link id="' . $purchase . '" text="Purchase" style="button" color="blue"]');
						}
					}
				endforeach;

			endif;
		
		endforeach;
		?>
	</div> <!-- end of left grid element -->
	<div> <!-- empty right grid element -->
	</div>
</div> <!-- end of grid -->