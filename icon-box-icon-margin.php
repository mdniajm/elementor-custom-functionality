<?php
// Add "Icon Margin" to the Icon Box widget (applies to the icon element)
add_action(
  'elementor/element/icon-box/section_style_icon/after_section_end',
  function( $element, $args ) {
    /** @var \Elementor\Widget_Base $element */
    $element->start_controls_section(
      'my_icon_box_extra_spacing',
      [
        'label' => __( 'Extra Spacing', 'your-textdomain' ),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        'condition' => [
          'selected_icon[value]!' => '',
        ],
      ]
    );

    $element->add_responsive_control(
      'my_icon_margin',
      [
        'label' => __( 'Icon Margin', 'your-textdomain' ),
        'type'  => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
        'selectors'  => [
          // Margin on the clickable icon (a/span.elementor-icon)
          '{{WRAPPER}} .elementor-icon-box-icon .elementor-icon' =>
            'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $element->end_controls_section();
  },
  10,
  2
);
