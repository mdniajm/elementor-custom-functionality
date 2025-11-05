<?php
/**
 * Elementor – Extend Button widget icon (View/Shape/Colors/Border/Radius/Spacing)
 * + proper vertical centering of icon & text
 *
 * Put this in your theme's functions.php or a small helper plugin.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/*------------------------------
 * CONTENT tab: View + Shape
 *------------------------------*/
add_action( 'elementor/element/button/section_button/before_section_end', function( $widget ) {

	/** @var \Elementor\Widget_Base $widget */

	// Icon View (Default / Stacked / Framed)
	$widget->add_control(
		'icon_view',
		[
			'label'        => __( 'Icon View', 'your-textdomain' ),
			'type'         => \Elementor\Controls_Manager::SELECT,
			'options'      => [
				'default' => __( 'Default', 'your-textdomain' ),
				'stacked' => __( 'Stacked', 'your-textdomain' ),
				'framed'  => __( 'Framed',  'your-textdomain' ),
			],
			'default'      => 'default',
			'condition'    => [ 'selected_icon[value]!' => '' ],
			'prefix_class' => 'elementor-button-icon-view-',
		]
	);

	// Icon Shape (maps to border-radius)
	$widget->add_control(
		'icon_shape',
		[
			'label'     => __( 'Icon Shape', 'your-textdomain' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'options'   => [
				'square'  => __( 'Square',  'your-textdomain' ),
				'rounded' => __( 'Rounded', 'your-textdomain' ),
				'circle'  => __( 'Circle',  'your-textdomain' ),
			],
			'default'   => 'circle',
			'condition' => [
				'icon_view!'            => 'default',
				'selected_icon[value]!' => '',
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-button .elementor-button-icon' => '{{VALUE}}',
			],
			'selectors_dictionary' => [
				'square'  => 'border-radius:0;',
				'rounded' => 'border-radius:8px;',
				'circle'  => 'border-radius:50%;',
			],
		]
	);

}, 10 );

/*------------------------------
 * STYLE tab: full icon styling
 *------------------------------*/
add_action( 'elementor/element/button/section_style/after_section_end', function( $widget ) {

	/** @var \Elementor\Widget_Base $widget */

	$widget->start_controls_section(
		'button_icon_style_extra',
		[
			'label'     => __( 'Icon (Extra)', 'your-textdomain' ),
			'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
			'condition' => [ 'selected_icon[value]!' => '' ],
		]
	);

	/* Center icon + text vertically & horizontally */
	$widget->add_control(
		'button_icon_fix_alignment',
		[
			'type'     => \Elementor\Controls_Manager::HIDDEN,
			'default'  => 'yes',
			'selectors'=> [
				// This is the wrapper that holds icon + text — make it flex
				'{{WRAPPER}} .elementor-button-content-wrapper' =>
					'display:flex; align-items:center; justify-content:center;',
				// Keep the icon itself centered inside its box
				'{{WRAPPER}} .elementor-button .elementor-button-icon' =>
					'display:flex; align-items:center; justify-content:center; line-height:1;',
			],
		]
	);

	/* Gap between icon and text (supports icon left/right) */
	$widget->add_responsive_control(
		'button_icon_spacing',
		[
			'label'      => __( 'Icon Spacing', 'your-textdomain' ),
			'type'       => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', 'rem', 'custom' ],
			'selectors'  => [
				'{{WRAPPER}} .elementor-button .elementor-button-icon.elementor-align-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .elementor-button .elementor-button-icon.elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
			],
		]
	);

	/* Padding inside the icon box (for stacked/framed) */
	$widget->add_responsive_control(
		'button_icon_padding',
		[
			'label'      => __( 'Icon Padding', 'your-textdomain' ),
			'type'       => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', 'rem', 'custom' ],
			'default'    => [ 'size' => 10, 'unit' => 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .elementor-button .elementor-button-icon' => 'padding: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [ 'icon_view!' => 'default' ],
		]
	);

	/* Border width (Framed view) */
	$widget->add_responsive_control(
		'button_icon_border_width',
		[
			'label'      => __( 'Border Width', 'your-textdomain' ),
			'type'       => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', 'rem', 'custom' ],
			'default'    => [ 'top'=>2, 'right'=>2, 'bottom'=>2, 'left'=>2, 'unit'=>'px' ],
			'selectors'  => [
				'{{WRAPPER}} .elementor-button .elementor-button-icon' =>
					'border-style:solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition'  => [ 'icon_view' => 'framed' ],
		]
	);

	/* Optional: fine control over radius (overrides Shape when used) */
	$widget->add_responsive_control(
		'button_icon_border_radius',
		[
			'label'      => __( 'Border Radius (override)', 'your-textdomain' ),
			'type'       => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
			'selectors'  => [
				'{{WRAPPER}} .elementor-button .elementor-button-icon' =>
					'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition'  => [ 'icon_view!' => 'default' ],
		]
	);

	/* Color tabs (Normal/Hover) – same behavior as Icon Box */
	$widget->start_controls_tabs( 'button_icon_colors_tabs' );

	// Normal
	$widget->start_controls_tab( 'button_icon_colors_normal', [ 'label' => __( 'Normal', 'your-textdomain' ) ] );

	$widget->add_control(
		'button_icon_primary_color',
		[
			'label'     => __( 'Primary Color', 'your-textdomain' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				// Stacked: background
				'{{WRAPPER}}.elementor-button-icon-view-stacked .elementor-button .elementor-button-icon' =>
					'background-color: {{VALUE}};',
				// Framed/Default: glyph + border
				'{{WRAPPER}}.elementor-button-icon-view-framed  .elementor-button .elementor-button-icon,
				 {{WRAPPER}}.elementor-button-icon-view-default .elementor-button .elementor-button-icon' =>
					'color: {{VALUE}}; fill: {{VALUE}}; border-color: {{VALUE}};',
			],
		]
	);

	$widget->add_control(
		'button_icon_secondary_color',
		[
			'label'     => __( 'Secondary Color', 'your-textdomain' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'condition' => [ 'icon_view!' => 'default' ],
			'selectors' => [
				// Framed: inner background
				'{{WRAPPER}}.elementor-button-icon-view-framed .elementor-button .elementor-button-icon' =>
					'background-color: {{VALUE}};',
				// Stacked: glyph color
				'{{WRAPPER}}.elementor-button-icon-view-stacked .elementor-button .elementor-button-icon' =>
					'color: {{VALUE}}; fill: {{VALUE}};',
			],
		]
	);

	$widget->end_controls_tab();

	// Hover
	$widget->start_controls_tab( 'button_icon_colors_hover', [ 'label' => __( 'Hover', 'your-textdomain' ) ] );

	$widget->add_control(
		'button_icon_hover_primary_color',
		[
			'label'     => __( 'Primary Color', 'your-textdomain' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				// Stacked: background on hover
				'{{WRAPPER}}.elementor-button-icon-view-stacked .elementor-button:hover .elementor-button-icon,
				 {{WRAPPER}}.elementor-button-icon-view-stacked .elementor-button:focus  .elementor-button-icon' =>
					'background-color: {{VALUE}};',
				// Framed/Default: glyph + border on hover
				'{{WRAPPER}}.elementor-button-icon-view-framed  .elementor-button:hover .elementor-button-icon,
				 {{WRAPPER}}.elementor-button-icon-view-default .elementor-button:hover .elementor-button-icon,
				 {{WRAPPER}}.elementor-button-icon-view-framed  .elementor-button:focus  .elementor-button-icon,
				 {{WRAPPER}}.elementor-button-icon-view-default .elementor-button:focus  .elementor-button-icon' =>
					'color: {{VALUE}}; fill: {{VALUE}}; border-color: {{VALUE}};',
			],
		]
	);

	$widget->add_control(
		'button_icon_hover_secondary_color',
		[
			'label'     => __( 'Secondary Color', 'your-textdomain' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'condition' => [ 'icon_view!' => 'default' ],
			'selectors' => [
				'{{WRAPPER}}.elementor-button-icon-view-framed .elementor-button:hover .elementor-button-icon,
				 {{WRAPPER}}.elementor-button-icon-view-framed .elementor-button:focus  .elementor-button-icon' =>
					'background-color: {{VALUE}};',
				'{{WRAPPER}}.elementor-button-icon-view-stacked .elementor-button:hover .elementor-button-icon,
				 {{WRAPPER}}.elementor-button-icon-view-stacked .elementor-button:focus  .elementor-button-icon' =>
					'color: {{VALUE}}; fill: {{VALUE}};',
			],
		]
	);

	$widget->add_control(
		'button_icon_colors_transition_duration',
		[
			'label'      => __( 'Transition Duration', 'your-textdomain' ),
			'type'       => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 's', 'ms', 'custom' ],
			'default'    => [ 'unit' => 's' ],
			'selectors'  => [
				'{{WRAPPER}} .elementor-button .elementor-button-icon' => 'transition-duration: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$widget->end_controls_tab();
	$widget->end_controls_tabs();

	$widget->end_controls_section();

}, 10 );
