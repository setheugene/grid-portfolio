<?php
/**
 * About page template.
 *
 * Template Name: About
 *
 * Sections: Header → Bio → Skills → Experience → Links.
 * Content is hardcoded — this page changes rarely and keeping it in PHP
 * means it's readable in the repo without touching the WP admin.
 *
 * @package SethPortfolio
 */

get_header();
?>

<main id="main" class="pt-16 site-main">

	<!-- =====================================================================
	     Page Header
	     ===================================================================== -->
	<section class="section">
		<div class="container">

			<p class="mb-6 font-mono text-xs tracking-widest uppercase text-muted" data-animate>
				About
			</p>

			<h1 class="max-w-2xl mb-8 hdg-2 text-text" data-animate style="--delay:80ms">
				I build WordPress the way it was meant to be built.
			</h1>

			<p class="max-w-2xl mb-6 text-lg leading-relaxed text-muted" data-animate style="--delay:160ms">
				I'm Seth Wills, a senior WordPress engineer with 8 years of experience turning complex requirements into clean, fast, maintainable code. I've worked across agencies, startups, and direct client engagements — building everything from headless WordPress APIs to performance-tuned editorial platforms.
			</p>

			<p class="max-w-2xl text-lg leading-relaxed text-muted" data-animate style="--delay:200ms">
				I care about the craft: semantic markup, sub-second load times, and code that the next engineer can actually understand. Currently open to senior engineering roles — full-time or contract.
			</p>

		</div>
	</section>

	<!-- =====================================================================
	     Skills
	     ===================================================================== -->
	<section class="section">
		<div class="container">

			<h2 class="mb-10 font-mono text-center hdg-2 text-muted" data-animate>
				Skills &amp; Tools
			</h2>

		</div>

		<?php
		$skill_groups = [
			[
				'category' => 'WordPress',
				'skills'   => [
					'Custom theme development (no page builders)',
					'Custom Post Types & Taxonomies',
					'Gutenberg block development',
					'REST API — custom endpoints & authentication',
					'Advanced Custom Fields (programmatic registration)',
					'Multisite architecture',
					'WP-CLI scripting & migrations',
					'WooCommerce customisation',
				],
			],
			[
				'category' => 'Languages',
				'skills'   => [
					'PHP 8 — OOP, traits, typed properties',
					'JavaScript ES6+ (no framework dependency)',
					'HTML5 — semantic, accessible markup',
					'CSS — custom properties, Grid, Flexbox',
					'SQL — complex queries, schema design',
					'Bash scripting',
				],
			],
			[
				'category' => 'Tools & Workflow',
				'skills'   => [
					'Git — feature branch workflow, PR reviews',
					'Local by Flywheel / Flywheel / WP Engine',
					'Tailwind CSS',
					'Composer & PSR-4 autoloading',
					'GitHub Actions (basic CI)',
					'Figma — reading and implementing designs',
				],
			],
			[
				'category' => 'SEO & Performance',
				'skills'   => [
					'Lighthouse ≥ 95 across all categories',
					'Core Web Vitals optimisation',
					'Yoast SEO — schema, sitemaps, meta',
					'WebP image pipelines',
					'Server-side rendering, minimal JS footprint',
					'Accessibility — WCAG 2.1 AA',
				],
			],
		];
		?>

		<div class="">
			<div class="grid w-full grid-cols-2 gap-px border bg-border border-border">
				<?php foreach ( $skill_groups as $index => $group ) : ?>
					<div class="p-8 overflow-y-auto bg-bg aspect-square" data-animate style="--delay:<?php echo esc_attr( $index * 60 ); ?>ms">
						<h2 class="mb-6 font-mono text-xs tracking-widest uppercase text-accent">
							<?php echo esc_html( $group['category'] ); ?>
						</h2>
						<ul class="p-0 m-0 space-y-3 list-none">
							<?php foreach ( $group['skills'] as $skill ) : ?>
								<li class="flex items-start gap-3 text-sm leading-snug text-muted">
									<span class="mt-1 text-border shrink-0" aria-hidden="true">—</span>
									<?php echo esc_html( $skill ); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

	</section>

	<!-- =====================================================================
	     Experience Timeline
	     ===================================================================== -->
	<section class="section">
		<div class="container">

			<p class="mb-10 font-mono text-xs tracking-widest uppercase text-muted" data-animate>
				Experience
			</p>

			<?php
			$experience = [
				[
					'period'  => '2021 — Present',
					'role'    => 'Lead Web Developer',
					'company' => 'Lifted Logic — Overland Park, KS',
					'detail'  => 'Own the boilerplate codebases the entire dev team builds from — an investment that cut average site build time from 75 hours to 25. Lead code reviews, run developer one-on-ones, and mentor junior engineers across a team of 6. Architect and ship custom WordPress themes including multisites and WooCommerce builds, and develop internal plugins to standardize functionality across the client portfolio. Integrated third-party APIs including Salesforce and Google Translate. Primary technical point of contact for cross-department and client communication.',
				],
				[
					'period'  => '2020 — 2021',
					'role'    => 'Coding Instructor',
					'company' => 'NuCamp Coding Bootcamp — Remote',
					'detail'  => 'Taught HTML, CSS, Bootstrap, JavaScript, jQuery, and Git to a new cohort of students every five weeks. Built a learning environment focused on realistic expectations and leaving no one behind — practical communication and teaching under a tight curriculum cadence.',
				],
				[
					'period'  => '2019 — 2021',
					'role'    => 'Web Developer',
					'company' => 'MAKE Digital — Kansas City, MO',
					'detail'  => 'Built marketing sites across WordPress and Drupal. Wrote custom WordPress themes using the Sage boilerplate and Laravel Blade components. Maintained multiple client codebases and collaborated with other developers to ship new features and UI updates against existing code.',
				],
			];
			?>

			<div class="relative">
				<!-- Timeline rule -->
				<div class="absolute top-0 left-[7px] w-px h-full bg-border hidden md:block" aria-hidden="true"></div>

				<div class="space-y-12">
					<?php foreach ( $experience as $index => $job ) : ?>
						<div
							class="relative flex flex-col gap-1 md:pl-10"
							data-animate
							style="--delay:<?php echo esc_attr( $index * 100 ); ?>ms"
						>
							<!-- Timeline dot -->
							<div class="absolute left-0 top-1.5 w-3.5 h-3.5 rounded-full border-2 border-accent bg-bg hidden md:block" aria-hidden="true"></div>

							<div class="flex flex-wrap items-center mb-1 gap-x-4 gap-y-1">
								<span class="font-mono text-xs tracking-widest uppercase text-muted">
									<?php echo esc_html( $job['period'] ); ?>
								</span>
								<span class="font-mono text-xs text-border" aria-hidden="true">—</span>
								<span class="font-mono text-xs tracking-widest uppercase text-muted">
									<?php echo esc_html( $job['company'] ); ?>
								</span>
							</div>

							<h3 class="mb-2 hdg-5 text-text">
								<?php echo esc_html( $job['role'] ); ?>
							</h3>

							<p class="max-w-xl m-0 text-sm leading-relaxed text-muted">
								<?php echo esc_html( $job['detail'] ); ?>
							</p>

						</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>
	</section>


</main>

<?php get_footer(); ?>
