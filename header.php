<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-bg text-text' ); ?>>
<?php wp_body_open(); ?>

<header class="site-header sticky top-0 z-50 bg-bg/90 backdrop-blur-sm border-b border-border">
	<div class="site-header__inner container flex items-center justify-between h-16">

		<a
			href="<?php echo esc_url( home_url( '/' ) ); ?>"
			class="site-logo font-display text-xl text-white no-underline hover:text-accent transition-colors duration-200"
			aria-label="<?php bloginfo( 'name' ); ?> — home"
		>
			Seth
		</a>

		<button
			class="nav-toggle flex flex-col gap-[6px] md:hidden p-2 cursor-pointer bg-transparent border-0"
			aria-label="Toggle navigation"
			aria-expanded="false"
			aria-controls="primary-nav"
		>
			<span class="nav-toggle__bar block w-5 h-0.5 bg-text transition-all duration-200 origin-center"></span>
			<span class="nav-toggle__bar block w-5 h-0.5 bg-text transition-all duration-200"></span>
			<span class="nav-toggle__bar block w-5 h-0.5 bg-text transition-all duration-200 origin-center"></span>
		</button>

		<nav id="primary-nav" class="site-nav hidden md:flex items-center gap-8" aria-label="Primary">
			<?php get_template_part( 'template-parts/nav' ); ?>
		</nav>

	</div>
</header>
