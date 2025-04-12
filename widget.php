<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class GS_Custom_Testimonial extends \Elementor\Widget_Base {

	// Your widget's name, title, icon and category
    public function get_name() {
        return 'gs_custom_testimonial';
    }

    public function get_title() {
        return __( 'GS Custom Testimonial', 'gs-custom-testimonial' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

	public function get_script_depends() {
        return [ 'swiper' ];
    }



	// Your widget's sidebar settings
	protected function _register_controls() {

    // === SLIDER OPTIONS ===
    $this->start_controls_section(
        'section_slider_options',
        [
            'label' => __( 'Slider Options', 'plugin-name' ),
        ]
    );

    $this->add_control(
        'auto_slide',
        [
            'label' => __( 'Auto Slide', 'plugin-name' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]
    );

    $this->add_control(
        'infinite_loop',
        [
            'label' => __( 'Infinite Loop', 'plugin-name' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]
    );

    $this->add_control(
        'arrows',
        [
            'label' => __( 'Show Arrows', 'plugin-name' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]
    );

    $this->add_control(
        'pagination',
        [
            'label' => __( 'Show Pagination', 'plugin-name' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]
    );

    $this->add_responsive_control(
        'slider_width',
        [
            'label' => __( 'Width', 'plugin-name' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%', 'vw', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => 100, 'max' => 1600 ] ],
            'selectors' => [
                '{{WRAPPER}} .testimonial-slider-container' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'slider_height',
        [
            'label' => __( 'Height', 'plugin-name' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'vh', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => 100, 'max' => 1200 ] ],
            'selectors' => [
                '{{WRAPPER}} .testimonial-slider-container' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'border_radius',
        [
            'label' => __( 'Border Radius', 'plugin-name' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'vh' ],
            'selectors' => [
                '{{WRAPPER}} .testimonial-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();

    // === TESTIMONIALS REPEATER ===
    $this->start_controls_section(
        'section_testimonials',
        [
            'label' => __( 'Testimonials', 'plugin-name' ),
        ]
    );

    $repeater = new Repeater();

    $repeater->add_control( 'name', [
        'label' => __( 'Name', 'plugin-name' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'John Doe', 'plugin-name' ),
    ]);

    $repeater->add_control( 'badge', [
        'label' => __( 'Badge Image', 'plugin-name' ),
        'type' => Controls_Manager::MEDIA,
    ]);

    $repeater->add_control( 'photo', [
        'label' => __( 'User Image', 'plugin-name' ),
        'type' => Controls_Manager::MEDIA,
    ]);

    $repeater->add_control( 'rating', [
        'label' => __( 'Rating (1-5)', 'plugin-name' ),
        'type' => Controls_Manager::NUMBER,
        'min' => 1,
        'max' => 5,
        'default' => 5,
    ]);

    $repeater->add_control( 'title', [
        'label' => __( 'Title', 'plugin-name' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'Excellent Product!', 'plugin-name' ),
    ]);

    $repeater->add_control( 'content', [
        'label' => __( 'Content', 'plugin-name' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __( 'This is a great product!', 'plugin-name' ),
    ]);

    $this->add_control( 'testimonials', [
        'label' => __( 'Testimonials List', 'plugin-name' ),
        'type' => Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [],
        'title_field' => '{{{ name }}}',
    ]);

    $this->end_controls_section();

    // === STYLE: Section Background & Radius ===
    $this->start_controls_section(
        'section_styles',
        [
            'label' => __( 'Styles', 'plugin-name' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control( 'section_background', [
        'label' => __( 'Section Background Color', 'plugin-name' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .testimonial-slider-container' => 'background-color: {{VALUE}};',
        ],
    ]);

    $this->add_control( 'section_border_radius', [
        'label' => __( 'Section Border Radius', 'plugin-name' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-slider-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]);

    $this->add_control( 'user_image_size', [
        'label' => __( 'User Image Size', 'plugin-name' ),
        'type' => Controls_Manager::SLIDER,
        'range' => [ 'px' => [ 'min' => 20, 'max' => 150 ] ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-photo' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        ],
    ]);

    $this->add_control( 'user_image_radius', [
        'label' => __( 'User Image Border Radius', 'plugin-name' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-photo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]);
		
	$this->add_control(
    'rating_show_hide',
    [
        'label' => __( 'Show Rating', 'plugin-name' ),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
    ]
);

$this->add_control(
    'rating_star_color',
    [
        'label' => __( 'Star Color', 'plugin-name' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .testimonial-rating .star' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'rating_star_size',
    [
        'label' => __( 'Star Size', 'plugin-name' ),
        'type' => Controls_Manager::SLIDER,
        'range' => [ 'px' => [ 'min' => 10, 'max' => 50 ] ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-rating .star' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
    ]
);
    $this->end_controls_section();

    // === STYLE: Arrow & Pagination ===
    $this->start_controls_section(
        'nav_style_section',
        [
            'label' => __( 'Arrow & Pagination Style', 'plugin-name' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control( 'nav_color', [
        'label' => __( 'Arrow Color', 'plugin-name' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'color: {{VALUE}};',
        ],
    ]);

   $this->add_control(
    'arrow_size',
    [
        'label' => __( 'Arrow Size', 'plugin-name' ),
        'type' => Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'min' => 10,
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .swiper-button-prev:after, {{WRAPPER}} .swiper-button-next:after' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
    ]
);

    $this->add_control( 'pagination_color', [
        'label' => __( 'Pagination Bullet Color', 'plugin-name' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
        ],
    ]);

    $this->add_control( 'pagination_active_color', [
        'label' => __( 'Active Bullet Color', 'plugin-name' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
        ],
    ]);

    $this->add_control( 'pagination_size', [
        'label' => __( 'Pagination Bullet Size', 'plugin-name' ),
        'type' => Controls_Manager::SLIDER,
        'range' => [ 'px' => [ 'min' => 4, 'max' => 20 ] ],
        'selectors' => [
            '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        ],
    ]);

    $this->end_controls_section();
}


	protected function render() {
    $settings = $this->get_settings_for_display();
    $slider_id = 'testimonial-slider-' . esc_attr( $this->get_id() );

    echo '<div id="' . esc_attr( $slider_id ) . '" class="testimonial-slider-container swiper">';
    echo '<div class="swiper-wrapper">';

    foreach ( $settings['testimonials'] as $testimonial ) {
        echo '<div class="swiper-slide testimonial-slide">';
        echo '<div class="testimonial-header">';
        if ( $testimonial['photo']['url'] ) {
            echo '<img class="testimonial-photo" src="' . esc_url( $testimonial['photo']['url'] ) . '" alt="' . esc_attr( $testimonial['name'] ) . '">';
        }
        echo '<strong>' . esc_html( $testimonial['name'] ) . '</strong>';
        if ( $testimonial['badge']['url'] ) {
            echo '<img class="testimonial-badge" src="' . esc_url( $testimonial['badge']['url'] ) . '" alt="badge">';
        }
        echo '</div>';

        echo '<div class="testimonial-rating">';
$rating = floatval( $testimonial['rating'] );

for ( $i = 1; $i <= 5; $i++ ) {
    if ( $rating >= $i ) {
        echo '<span class="star full">&#9733;</span>'; // Full star
    } elseif ( $rating >= $i - 0.5 ) {
        echo '<span class="star half">&#9733;</span>'; // Half star
    } else {
        echo '<span class="star empty">&#9733;</span>'; // Empty star
    }
}
echo '</div>';


        echo '<h4>' . esc_html( $testimonial['title'] ) . '</h4>';
        echo '<p>' . esc_html( $testimonial['content'] ) . '</p>';
        echo '</div>';
    }

    echo '</div>'; // swiper-wrapper

    if ( $settings['pagination'] === 'yes' ) {
        echo '<div class="swiper-pagination"></div>';
    }

    if ( $settings['arrows'] === 'yes' ) {
        echo '<div class="swiper-button-prev"></div><div class="swiper-button-next"></div>';
    }

    echo '</div>'; // swiper

    // Inline JS
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('#<?php echo esc_js( $slider_id ); ?>', {
            loop: <?php echo $settings['infinite_loop'] === 'yes' ? 'true' : 'false'; ?>,
            autoplay: <?php echo $settings['auto_slide'] === 'yes' ? '{ delay: 4000 }' : 'false'; ?>,
            navigation: {
                nextEl: '#<?php echo esc_js( $slider_id ); ?> .swiper-button-next',
                prevEl: '#<?php echo esc_js( $slider_id ); ?> .swiper-button-prev'
            },
            pagination: {
                el: '#<?php echo esc_js( $slider_id ); ?> .swiper-pagination',
                clickable: true
            },
            slidesPerView: 1,
            spaceBetween: 20
        });
    });
    </script>

    <style>
    /* Container */
    .testimonial-slider-container {
		background: #ffff;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        padding: 24px;
        overflow: hidden;
    }

    /* Individual Slide */
    .testimonial-slide {
        display: flex;
        flex-direction: column;
        gap: 16px;
        padding: 20px;
        transition: transform 0.3s ease;
    }

    .testimonial-slide:hover {
        transform: translateY(-4px);
    }

    /* Header Section */
    .testimonial-header {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .testimonial-photo {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
    }

    .testimonial-badge {
        width: 18px;
        height: 18px;
    }

    /* Rating */
    .testimonial-rating {
    display: flex;
    gap: 4px;
    align-items: center;
}

.testimonial-rating .star {
    font-size: 1em; /* Use Elementor control here if needed */
    color: #ccc;
    position: relative;
}

.testimonial-rating .star.full {
    color: #ffc107; /* Gold */
}

.testimonial-rating .star.half {
    color: #ccc;
}

.testimonial-rating .star.half::before {
    content: '\2605';
    color: #ffc107;
    position: absolute;
    width: 50%;
    overflow: hidden;
    left: 0;
}


    /* Text Content */
    .testimonial-slide h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .testimonial-slide p {
        margin: 0;
        font-size: 14px;
        color: #444;
        line-height: 1.6;
    }

    /* Swiper Navigation */
    .swiper-button-prev,
    .swiper-button-next {
		 font-size: 24px;
    width: 30px;
    height: 30px;
        color: #333;
        transition: color 0.3s ease;
    }

    .swiper-button-prev:hover,
    .swiper-button-next:hover {
        color: #000;
    }
		
	.swiper-button-next:after, .swiper-button-prev:after {
    font-size: 24px;
	}

    /* Swiper Pagination */
    .swiper-pagination-bullet {
        background-color: #ccc;
        opacity: 1;
    }

    .swiper-pagination-bullet-active {
        background-color: #000;
    }
    </style>
    <?php
}
}
