<?php
// Template modification Hook
do_action( 'dollah_template_before_footer' );

// Get Footer Columns
$columns = dollah_get_footer_columns();
$alphas = range('a', 'e');
$structure = dollah_footer_structure();
$footercols = array();
$footerdisplay = false;
for ( $i=0; $i < $columns; $i++ ) {
	$footercols[ 'hoot-footer-' . $alphas[ $i ] ] = $structure[ $i ];
	if ( is_active_sidebar( 'hoot-footer-' . $alphas[ $i ] ) )
		$footerdisplay = true;
}
$inline_nav = ( $columns == 1 ) ? 'inline_nav' : '';

// Return if nothing to show
if ( !$footerdisplay )
	return;
?>

<footer <?php hybridextend_attr( 'footer', '', "footer hgrid-stretch footer-highlight-typo {$inline_nav}" ); ?>>
	<div class="hgrid">
		<?php foreach ( $footercols as $key => $span ) { ?>
			<div class="<?php echo 'hgrid-span-' . $span ; ?> footer-column">
				<?php dynamic_sidebar( $key ); ?>
			</div>
		<?php } ?>
	</div>
</footer><!-- #footer -->

<?php
// Template modification Hook
do_action( 'dollah_template_after_footer' );