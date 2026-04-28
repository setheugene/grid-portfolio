<?php
/**
 * Single case study template.
 *
 * Sections: Hero image → Title + meta → Problem / Solution / Outcome → Features → Back link.
 * Content lives entirely in ACF fields — the_content() is never called.
 *
 * @package SethPortfolio
 */

get_header();

// Bail if somehow we land here without a post.
if ( ! have_posts() ) {
	wp_redirect( home_url( '/work' ) );
	exit;
}

the_post();

// Pull ACF fields once; bail gracefully if ACF isn't active.
$has_acf  = function_exists( 'get_field' );
$url      = $has_acf ? get_field( 'cs_url' )      : '';
$role     = $has_acf ? get_field( 'cs_role' )     : '';
$stack    = $has_acf ? get_field( 'cs_stack' )    : '';
$problem  = $has_acf ? get_field( 'cs_problem' )  : '';
$solution = $has_acf ? get_field( 'cs_solution' ) : '';
$outcome  = $has_acf ? get_field( 'cs_outcome' )  : '';
$year     = $has_acf ? get_field( 'cs_year' )     : '';
$features = $has_acf ? get_field( 'cs_features' ) : [];
?>

<main id="main" class="site-main pt-16">

	<!-- =====================================================================
	     Featured Image (full-bleed)
	     ===================================================================== -->
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="w-full bg-bg-2 border-b border-border">
			<?php
			the_post_thumbnail(
				'full',
				[
					'class' => 'w-full max-h-[480px] object-cover',
					'sizes' => '100vw',
				]
			);
			?>
		</div>
	<?php endif; ?>

	<!-- =====================================================================
	     Title + Meta
	     ===================================================================== -->
	<section class="section">
		<div class="container">

			<!-- Back link -->
			<a
				href="<?php echo esc_url( home_url( '/work' ) ); ?>"
				class="inline-flex items-center gap-2 font-mono text-xs text-muted uppercase tracking-widest no-underline hover:text-white transition-colors duration-200 mb-10 group"
			>
				<span class="transition-transform duration-200 group-hover:-translate-x-0.5" aria-hidden="true">←</span>
				All Work
			</a>

			<!-- Meta row -->
			<div class="flex flex-wrap items-center gap-x-6 gap-y-2 font-mono text-xs text-muted uppercase tracking-widest mb-6">
				<?php if ( $year ) : ?>
					<span><?php echo esc_html( $year ); ?></span>
				<?php endif; ?>
				<?php if ( $role ) : ?>
					<span class="before:content-['—'] before:mr-6 before:text-border"><?php echo esc_html( $role ); ?></span>
				<?php endif; ?>
				<?php if ( $url ) : ?>
					<a
						href="<?php echo esc_url( $url ); ?>"
						class="before:content-['—'] before:mr-6 before:text-border text-accent hover:text-white transition-colors no-underline"
						target="_blank"
						rel="noopener noreferrer"
					>
						Live Site ↗
					</a>
				<?php endif; ?>
			</div>

			<!-- Title -->
			<h1 class="hdg-2 text-text mb-6">
				<?php the_title(); ?>
			</h1>

			<!-- Tech stack -->
			<?php if ( $stack ) : ?>
				<p class="font-mono text-xs text-accent tracking-wide">
					<?php echo esc_html( $stack ); ?>
				</p>
			<?php endif; ?>

		</div>
	</section>

	<!-- =====================================================================
	     Case Study Sections: Problem / Solution / Outcome
	     ===================================================================== -->
	<?php
	$sections = [
		[
			'label'   => 'The Problem',
			'content' => $problem,
		],
		[
			'label'   => 'What I Built',
			'content' => $solution,
		],
		[
			'label'   => 'Outcome',
			'content' => $outcome,
		],
	];

	$alt = false;
	foreach ( $sections as $cs_section ) :
		if ( empty( $cs_section['content'] ) ) {
			continue;
		}
		$alt = ! $alt;
	?>
		<section class="section<?php echo $alt ? ' section--alt' : ''; ?>">
			<div class="container">
				<div class="max-w-2xl" data-animate>
					<h2 class="font-mono text-xs text-muted uppercase tracking-widest mb-4">
						<?php echo esc_html( $cs_section['label'] ); ?>
					</h2>
					<p class="text-text text-lg leading-relaxed m-0">
						<?php echo wp_kses_post( $cs_section['content'] ); ?>
					</p>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

	<!-- =====================================================================
	     Feature Highlights
	     ===================================================================== -->
	<?php if ( ! empty( $features ) ) : ?>

		<section class="section section--alt">
			<div class="container">

				<p class="font-mono text-xs text-muted uppercase tracking-widest mb-12" data-animate>
					Under the Hood
				</p>

				<div class="space-y-24">
					<?php foreach ( $features as $i => $feature ) :
						$f_heading  = $feature['feature_heading']     ?? '';
						$f_desc     = $feature['feature_description'] ?? '';
						$f_code     = $feature['feature_code']        ?? '';
						$f_lang     = $feature['feature_language']    ?? 'php';
						$f_image    = $feature['feature_image']       ?? null;
						$f_url      = $feature['feature_url']         ?? '';
					?>

						<article class="feature" data-animate style="--delay:<?php echo esc_attr( ( $i % 3 ) * 80 ); ?>ms">

							<!-- Feature heading + description -->
							<div class="mb-8">
								<h2 class="hdg-3 text-text mb-4">
									<?php echo esc_html( $f_heading ); ?>
								</h2>
								<p class="text-muted text-base leading-relaxed max-w-2xl">
									<?php echo wp_kses_post( $f_desc ); ?>
								</p>
							</div>

							<!-- Code + Image: side-by-side on desktop when both present -->
							<?php $has_code  = ! empty( $f_code );
								  $has_image = ! empty( $f_image ); ?>

							<?php if ( $has_code || $has_image ) : ?>
								<div class="grid grid-cols-1 <?php echo ( $has_code && $has_image ) ? 'lg:grid-cols-2' : ''; ?> gap-6 items-start">

									<?php if ( $has_code ) : ?>
										<div class="code-block rounded overflow-hidden border border-border">
											<!-- Toolbar -->
											<div class="flex items-center justify-between px-4 py-2.5 bg-bg border-b border-border">
												<div class="flex items-center gap-1.5" aria-hidden="true">
													<span class="w-3 h-3 rounded-full bg-border"></span>
													<span class="w-3 h-3 rounded-full bg-border"></span>
													<span class="w-3 h-3 rounded-full bg-border"></span>
												</div>
												<?php if ( $f_lang ) : ?>
													<span class="font-mono text-xs text-muted uppercase tracking-widest">
														<?php echo esc_html( $f_lang ); ?>
													</span>
												<?php endif; ?>
											</div>
											<!-- Code -->
											<pre class="code-block__pre m-0 p-6 overflow-x-auto bg-bg text-sm leading-relaxed"><code class="font-mono text-text/80 whitespace-pre"><?php echo esc_html( $f_code ); ?></code></pre>
										</div>
									<?php endif; ?>

									<?php if ( $has_image ) :
										$img_url = $f_image['url']    ?? '';
										$img_alt = $f_image['alt']    ?? esc_attr( $f_heading );
										$img_w   = $f_image['width']  ?? '';
										$img_h   = $f_image['height'] ?? '';
									?>
										<figure class="m-0 rounded overflow-hidden border border-border">
											<img
												src="<?php echo esc_url( $img_url ); ?>"
												alt="<?php echo esc_attr( $img_alt ); ?>"
												<?php if ( $img_w ) echo 'width="' . esc_attr( $img_w ) . '"'; ?>
												<?php if ( $img_h ) echo 'height="' . esc_attr( $img_h ) . '"'; ?>
												loading="lazy"
												class="w-full h-auto block"
											>
											<?php if ( $f_url ) : ?>
												<figcaption class="px-4 py-3 bg-bg-2 border-t border-border">
													<a
														href="<?php echo esc_url( $f_url ); ?>"
														class="font-mono text-xs text-accent hover:text-white transition-colors no-underline"
														target="_blank"
														rel="noopener noreferrer"
													>
														View on site ↗
													</a>
												</figcaption>
											<?php endif; ?>
										</figure>
									<?php endif; ?>

								</div>
							<?php endif; ?>

							<!-- Standalone link if image is absent -->
							<?php if ( $f_url && ! $has_image ) : ?>
								<div class="mt-6">
									<a
										href="<?php echo esc_url( $f_url ); ?>"
										class="inline-flex items-center gap-2 font-mono text-xs text-accent uppercase tracking-widest no-underline hover:text-white transition-colors"
										target="_blank"
										rel="noopener noreferrer"
									>
										View on site
										<span aria-hidden="true">↗</span>
									</a>
								</div>
							<?php endif; ?>

						</article>

						<?php if ( $i < count( $features ) - 1 ) : ?>
							<hr class="border-border">
						<?php endif; ?>

					<?php endforeach; ?>
				</div>

			</div>
		</section>

	<?php endif; ?>

	<!-- =====================================================================
	     Footer Nav
	     ===================================================================== -->
	<section class="section">
		<div class="container flex items-center justify-between flex-wrap gap-4">

			<a
				href="<?php echo esc_url( home_url( '/work' ) ); ?>"
				class="inline-flex items-center gap-2 font-mono text-xs text-muted uppercase tracking-widest no-underline hover:text-white transition-colors duration-200 group"
			>
				<span class="transition-transform duration-200 group-hover:-translate-x-0.5" aria-hidden="true">←</span>
				All Work
			</a>

			<?php if ( $url ) : ?>
				<a
					href="<?php echo esc_url( $url ); ?>"
					class="inline-flex items-center gap-2 bg-accent text-bg font-medium text-sm px-6 py-3 rounded-sm hover:bg-white transition-colors duration-200 no-underline"
					target="_blank"
					rel="noopener noreferrer"
				>
					View Live Site
					<span aria-hidden="true">↗</span>
				</a>
			<?php endif; ?>

		</div>
	</section>

</main>

<?php get_footer(); ?>
