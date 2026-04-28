<?php
/**
 * Case study card partial.
 *
 * Expects the loop to be active (called from within a WP_Query loop).
 * ACF calls bail gracefully if the plugin isn't active.
 *
 * @package SethPortfolio
 */

$role  = function_exists( 'get_field' ) ? get_field( 'cs_role' )  : '';
$stack = function_exists( 'get_field' ) ? get_field( 'cs_stack' ) : '';
$year  = function_exists( 'get_field' ) ? get_field( 'cs_year' )  : '';
?>
<article class="relative grid grid-cols-1 grid-rows-2 duration-300 border group/article case-study-card group bg-bg-2 border-border aspect-square focus-within:outline-white focus-within:outline" data-animate>
	<div class="relative h-full overflow-hidden border-b border-border">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="block" tabindex="-1" aria-hidden="true">
				<?php
				the_post_thumbnail(
					'large',
					[
						'class'   => 'group-hover/article:scale-105 duration-300 ease-in-out',
						'loading' => 'lazy',
					]
				);
				?>
			</div>
		<?php endif; ?>
	</div>

	<div class="p-6 case-study-card__body md:p-8">

		<?php if ( $year || $role ) : ?>
			<header class="flex items-center gap-3 mb-3 font-mono text-xs tracking-widest uppercase case-study-card__header text-muted">
				<?php if ( $year ) : ?>
					<span class="case-study-card__year"><?php echo esc_html( $year ); ?></span>
				<?php endif; ?>
				<?php if ( $year && $role ) : ?>
					<span aria-hidden="true">&mdash;</span>
				<?php endif; ?>
				<?php if ( $role ) : ?>
					<span class="case-study-card__role"><?php echo esc_html( $role ); ?></span>
				<?php endif; ?>
			</header>
		<?php endif; ?>

		<h2 class="hdg-4 mt-0 case-study-card__title">
			<a href="<?php the_permalink(); ?>" class="no-underline transition-colors duration-200 focus-visible:outline-none after:absolute after:inset-0 text-text hover:text-accent">
				<?php the_title(); ?>
			</a>
		</h2>

		<?php if ( has_excerpt() ) : ?>
			<p class="mt-3 text-sm leading-relaxed case-study-card__excerpt text-muted">
				<?php the_excerpt(); ?>
			</p>
		<?php endif; ?>

		<?php if ( $stack ) : ?>
			<p class="mt-4 font-mono text-xs case-study-card__stack text-accent">
				<?php echo esc_html( $stack ); ?>
			</p>
		<?php endif; ?>

	</div>
</article>
