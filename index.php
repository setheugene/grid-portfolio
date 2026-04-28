<?php
/**
 * Fallback template — WordPress requires this file to exist.
 * All real routing is handled by front-page.php, page-work.php, etc.
 *
 * @package SethPortfolio
 */

get_header();
?>

<main id="main" class="site-main">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing found.', 'seth-portfolio' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
