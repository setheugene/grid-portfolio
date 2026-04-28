<footer class="border-t site-footer border-border bg-bg">

	<!-- Big square link tiles -->
	<div class="grid grid-cols-1 md:grid-cols-3">

		<a
			href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
			class="border-b footer-tile group border-border md:border-b-0 md:border-r md:border-border"
		>
			<span class="footer-tile__label">Get in touch</span>
			<span class="footer-tile__heading">Contact →</span>
		</a>

		<a
			href="https://github.com/setheugene"
			class="border-b footer-tile group border-border md:border-b-0 md:border-r md:border-border"
			target="_blank"
			rel="noopener noreferrer"
		>
			<span class="footer-tile__label">View the source</span>
			<span class="footer-tile__heading">GitHub ↗</span>
		</a>

		<a
			href="<?php echo esc_url( get_template_directory_uri() . '/assets/seth-wills-resume.pdf' ); ?>"
			class="footer-tile group"
			download
		>
			<span class="footer-tile__label">Download</span>
			<span class="footer-tile__heading">Resume ↓</span>
		</a>

	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
