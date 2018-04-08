<?php
// Return if no message to show
if ( empty( $message ) )
	return;

if ( $background || $fontcolor ) {
	$styleclass = 'announce-userstyle';
	$inlinestyle = ' style="';
	$inlinestyle .= ( $background ) ? 'background:' . sanitize_hex_color( $background ).';' : '';
	$inlinestyle .= ( $fontcolor ) ? 'color:' . sanitize_hex_color( $fontcolor ).';' : '';
	$inlinestyle .= '" ';
} else $inlinestyle = $styleclass = '';
?>

<div class="announce-widget <?php echo $styleclass; ?>" <?php echo $inlinestyle;?>>
	<?php if ( !empty( $url ) ) echo '<a href="' . esc_url( $url ) . '" ' . hybridextend_get_attr( 'announce-link' ) . '><span>' . __( 'Click Here', 'dollah' ) . '</span></a>'; ?>
	<div class="announce-box table">
		<?php if ( !empty( $icon ) ) : ?>
			<div class="announce-box-icon table-cell-mid"><i class="fa <?php echo sanitize_html_class( $icon ) ?>"></i></div>
		<?php endif; ?>
		<div class="announce-box-content table-cell-mid">
			<?php echo wp_kses_post( $message ); ?>
		</div>
	</div>
</div>