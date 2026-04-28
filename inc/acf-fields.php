<?php
/**
 * ACF field group registration.
 *
 * Fields are registered in PHP via acf_add_local_field_group() rather than
 * stored in the database. This means field definitions travel with the theme
 * in version control — no JSON exports, no sync step, no database dependency.
 *
 * @package SethPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Case Study field group.
 *
 * Bails silently if ACF isn't active — the theme won't fatal, it just won't
 * have custom field data until the plugin is installed.
 */
function portfolio_register_acf_fields(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( [
		'key'    => 'group_case_study',
		'title'  => 'Case Study Details',
		'fields' => [
			[
				'key'           => 'field_cs_url',
				'label'         => 'Project URL',
				'name'          => 'cs_url',
				'type'          => 'url',
				'instructions'  => 'Link to the live site or project.',
				'required'      => 0,
			],
			[
				'key'           => 'field_cs_role',
				'label'         => 'Your Role',
				'name'          => 'cs_role',
				'type'          => 'text',
				'instructions'  => 'e.g. "Lead Developer" or "Full-Stack Engineer"',
				'required'      => 1,
			],
			[
				'key'           => 'field_cs_stack',
				'label'         => 'Tech Stack',
				'name'          => 'cs_stack',
				'type'          => 'textarea',
				'instructions'  => 'One technology per line, or comma-separated.',
				'required'      => 1,
				'rows'          => 4,
			],
			[
				'key'           => 'field_cs_problem',
				'label'         => 'The Problem',
				'name'          => 'cs_problem',
				'type'          => 'textarea',
				'instructions'  => '1–2 sentences. What challenge did this project solve?',
				'required'      => 1,
				'rows'          => 3,
			],
			[
				'key'           => 'field_cs_solution',
				'label'         => 'What You Built',
				'name'          => 'cs_solution',
				'type'          => 'textarea',
				'instructions'  => '2–3 sentences. What did you actually build or architect?',
				'required'      => 1,
				'rows'          => 4,
			],
			[
				'key'           => 'field_cs_outcome',
				'label'         => 'Outcome',
				'name'          => 'cs_outcome',
				'type'          => 'textarea',
				'instructions'  => '1–2 sentences. Measurable results where possible.',
				'required'      => 1,
				'rows'          => 3,
			],
			[
				'key'           => 'field_cs_year',
				'label'         => 'Year',
				'name'          => 'cs_year',
				'type'          => 'number',
				'instructions'  => '4-digit year the project was completed.',
				'required'      => 1,
				'min'           => 2000,
				'max'           => 2099,
				'step'          => 1,
			],

			// ----------------------------------------------------------------
			// Feature Highlights repeater (requires ACF Pro)
			// ----------------------------------------------------------------
			[
				'key'          => 'field_cs_features',
				'label'        => 'Feature Highlights',
				'name'         => 'cs_features',
				'type'         => 'repeater',
				'instructions' => 'Add one entry per technical feature you want to showcase — code snippet, screenshot, and an optional link.',
				'required'     => 0,
				'min'          => 0,
				'max'          => 0, // unlimited
				'layout'       => 'block',
				'button_label' => 'Add Feature',
				'sub_fields'   => [
					[
						'key'          => 'field_cs_feature_heading',
						'label'        => 'Feature Title',
						'name'         => 'feature_heading',
						'type'         => 'text',
						'instructions' => 'e.g. "Custom Slider", "REST API Endpoint"',
						'required'     => 1,
						'column_width' => '',
					],
					[
						'key'          => 'field_cs_feature_description',
						'label'        => 'Description',
						'name'         => 'feature_description',
						'type'         => 'textarea',
						'instructions' => 'Explain what this feature does, why you built it this way, and any interesting technical decisions.',
						'required'     => 1,
						'rows'         => 4,
						'column_width' => '',
					],
					[
						'key'           => 'field_cs_feature_code',
						'label'         => 'Code Snippet',
						'name'          => 'feature_code',
						'type'          => 'textarea',
						'instructions'  => 'Paste the relevant code. Will be rendered in a <pre><code> block.',
						'required'      => 0,
						'rows'          => 10,
						'new_lines'     => '', // preserve whitespace
						'column_width'  => '',
					],
					[
						'key'          => 'field_cs_feature_language',
						'label'        => 'Code Language',
						'name'         => 'feature_language',
						'type'         => 'select',
						'instructions' => 'Used as a label on the code block.',
						'required'     => 0,
						'choices'      => [
							'php'        => 'PHP',
							'javascript' => 'JavaScript',
							'css'        => 'CSS',
							'html'       => 'HTML',
							'sql'        => 'SQL',
							'bash'       => 'Bash',
							'json'       => 'JSON',
						],
						'default_value' => 'php',
						'allow_null'    => 1,
						'column_width'  => '',
					],
					[
						'key'           => 'field_cs_feature_image',
						'label'         => 'Screenshot',
						'name'          => 'feature_image',
						'type'          => 'image',
						'instructions'  => 'Screenshot of this feature in the live site.',
						'required'      => 0,
						'return_format' => 'array',
						'preview_size'  => 'medium',
						'column_width'  => '',
					],
					[
						'key'          => 'field_cs_feature_url',
						'label'        => 'Feature URL',
						'name'         => 'feature_url',
						'type'         => 'url',
						'instructions' => 'Optional deep link to this specific feature on the live site.',
						'required'     => 0,
						'column_width' => '',
					],
				],
			],
		],
		'location' => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'case_study',
				],
			],
		],
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
	] );
}
add_action( 'acf/init', 'portfolio_register_acf_fields' );
