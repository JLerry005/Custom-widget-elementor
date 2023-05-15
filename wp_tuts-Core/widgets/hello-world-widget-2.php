<?php
/**
 * Elementor_Hello_World_Widget_2
 */
class Elementor_Hello_World_Widget_2 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'hello_world_widget_2';
	}

	public function get_title() {
		return esc_html__( 'Hello World 2', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'hello', 'world' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_type',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Select Post Type', 'elementor-addon' ),
				'default' => 'post',
				'options' => [
					'post' => esc_html('post'),
					'slider' => esc_html('slider'),
					'store' => esc_html('store'),
				]
			]
		);

        // $this->add_control(
        //     'images',
        //     [
        //         'label' => __( 'Images', 'elementor' ),
        //         'type' => \Elementor\Controls_Manager::GALLERY,
        //     ]
        // );
        $this->add_control(
            'columns',
            [
                'label' => __( 'Columns', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => __( '2', 'elementor' ),
                    '3' => __( '3', 'elementor' ),
                    '4' => __( '4', 'elementor' ),
                ],
            ]
        );
        // $this->add_control(
		// 	'description',
		// 	[
		// 		'label' => esc_html__( 'Description', 'elementor-addon' ),
		// 		'type' => \Elementor\Controls_Manager::TEXTAREA,
		// 		'default' => esc_html__( 'Hello world', 'elementor-addon' ),
		// 	]
		// );
		$this->end_controls_section();

		// Content Tab End


		// Style Tab Start

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post--title' => 'color: {{VALUE}};',
				],
			],
		);
       

       
		// $this->end_controls_section();

		// Style Tab End

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$columns = $settings['columns'];

		?>

		<p class="hello-world">
			<?php 
			$posts = get_posts(['post_type' => $settings['post_type'], 'post_status' => 'publish']);
			if(!empty($posts)){
				echo '<div id="post-type-col-'.$columns.'">';
					echo '<div class="post-row-container columns-'.$columns.'">';
						foreach($posts as $post){
							$img_src = get_the_post_thumbnail_url( $post->ID, 'FULL' );
							if($img_src == ''  || $img_src == null){
								$img_src = "http://mitchwoo.test/wp-content/uploads/2022/07/logo-2-300x66.png";
							}
							$link = get_permalink( $post->ID );
							$output = '';
							$output .= '<a href="'.$link.'">';
								$output .= '<div class="post-container">';
								$output .= '<div class="post-header">';
								$output .= '<img src="'.$img_src.'" class="post-featured-image" alt="'.$post->title.'"/>';
								$output .= '</div>';
									$output .= '<div class="post-details">';
										$output .= '<h6 class="post-title">'.$post->post_title.'</h6>';
										$output .= '<h6 class="post-titles">'.$post->post_title.'</h6>';
										$output .= '<p>'.substr($post->post_content,0,100).'...</p>';
										
									$output .= '</div>';
									$output .= '<button class="read-more-btn">Read more</button>';
								$output .= '</div>';
							$output .= '</a>';
							echo $output;
						}
					echo '</div>';
				echo '</div>';
			
			}
			?>
		</p>
       <?php
        ?>
	    <p class="hello-world">
			
		</p>
		<?php
	}


}

