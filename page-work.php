<?php
/**
 * Work archive — all case studies.
 *
 * Template Name: Work
 *
 * Pulls all published case_study posts in menu order, falling back to
 * date descending. Cards rendered via template-parts/case-study-card.php.
 *
 * @package SethPortfolio
 */

get_header();

$work_query = new WP_Query( [
	'post_type'      => 'case_study',
	'posts_per_page' => -1,
	'post_status'    => 'publish',
	'orderby'        => [ 'menu_order' => 'ASC', 'date' => 'DESC' ],
	'no_found_rows'  => true,
] );
?>

<main id="main" class="site-main pt-16">

	<section class="section">
		<div class="container">

			<!-- Header -->
			<p class="font-mono text-xs text-muted uppercase tracking-widest mb-6" data-animate>
				Work
			</p>

			<h1 class="hdg-2 text-text mb-4" data-animate style="--delay:80ms">
				Selected Projects
			</h1>

			<p class="text-lg text-muted leading-relaxed max-w-xl mb-16" data-animate style="--delay:160ms">
				A selection of client and personal projects. Each one is a case study in solving a real problem with clean, maintainable WordPress engineering.
			</p>

			<!-- Grid -->
			<?php if ( $work_query->have_posts() ) : ?>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
					<?php
					$i = 0;
					while ( $work_query->have_posts() ) :
						$work_query->the_post();
					?>
						<div data-animate style="--delay:<?php echo esc_attr( ( $i % 2 ) * 100 ); ?>ms">
							<?php get_template_part( 'template-parts/case-study-card' ); ?>
						</div>
					<?php
						$i++;
					endwhile;
					wp_reset_postdata();
					?>
				</div>

			<?php else : ?>

				<div class="border border-border rounded p-12 text-center">
					<p class="font-mono text-sm text-muted m-0">No case studies published yet.</p>
				</div>

			<?php endif; ?>

		</div>
	</section>

</main>

<?php get_footer(); ?>
