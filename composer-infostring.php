<?php
$infostring = "";
if ( $composer_country = get_field( 'composer_country' ) ) {
	$infostring .= esc_html( $composer_country );
}
if ($date_of_birth = get_field( 'composer_date_of_birth' ) ) {
	
	if ($infostring == "") {
		$infostring = esc_html( $date_of_birth );
	} else {
		$infostring .= ", " . esc_html( $date_of_birth );
	}
	if ($date_of_death = get_field( 'composer_date_of_death' ) ) {
		$infostring .= " - " . esc_html( $date_of_death );
	}
} else if ( $date_unformatted = get_field( 'composer_date_of_birth_unformatted' ) ) {
	if ($infostring == "") {
		$infostring = esc_html( $date_unformatted );
	} else {
		$infostring .= ", " . esc_html( $date_unformatted );
	}
}
?>
<div class='infostring text--s'><?php echo $infostring; ?></div>