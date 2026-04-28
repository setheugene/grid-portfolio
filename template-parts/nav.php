<?php
/**
 * Primary navigation links.
 *
 * Rendered inside <nav> in header.php. Hardcoded links keep markup
 * predictable and avoid wp_nav_menu() wrapper divs.
 *
 * @package SethPortfolio
 */

$current = trailingslashit( $_SERVER['REQUEST_URI'] ?? '' );
$links   = [
	'/work'    => 'Work',
	'/about'   => 'About',
	'/contact' => 'Contact',
];
?>
<?php foreach ( $links as $path => $label ) :
	$is_current = strpos( $current, $path ) === 0;
?>
	<a
		href="<?php echo esc_url( home_url( $path ) ); ?>"
		class="nav-link"
		<?php echo $is_current ? 'aria-current="page"' : ''; ?>
	>
		<?php echo esc_html( $label ); ?>
	</a>
<?php endforeach; ?>

<a
	href="https://github.com/setheugene"
	class="nav-link text-accent hover:text-accent"
	target="_blank"
	rel="noopener noreferrer"
>
	GitHub ↗
</a>
