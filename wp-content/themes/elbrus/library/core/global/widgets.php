<?php

/**** WIDGETS AREA ****/


/* *****************************************************
 * Plugin Name: Elbrus Flickr
 * Description: Retrieve and display photos from Flickr.
 * Version: 1.0
 * ************************************************** */
class ElbrusFlickrWidget extends WP_Widget {

	// Widget setup.
	function __construct() {
		$widget_ops = array('classname' => 'pix-flickr-widget', 'description' => esc_html__('Display images from flickr', 'elbrus') );
		parent::__construct('pix-flickr-widget', esc_html__('Elbrus - Flickr images', 'elbrus'), $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$id = $instance['flickr_id'];
		$nr = ($instance['flickr_nr'] != '') ? $nr = $instance['flickr_nr'] : $nr = 16;
		echo wp_kses_post($before_widget);
		if ($title) echo wp_kses_post($before_title . $title . $after_title);

		echo '<ul class="basicuse flickr-feed clearfix" data-limit="'.esc_attr($nr).'" data-id="'.esc_attr($id).'"></ul>'.wp_kses_post($after_widget);

	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['flickr_nr'] = strip_tags($new_instance['flickr_nr']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
		'title' => esc_html__( 'Latest From Flickr', 'elbrus' ),
		'flickr_nr' => '6',
		'flickr_id' => '7992704@N05'
		);

		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'elbrus'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>"><?php _e('Flickr ID:', 'elbrus'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('flickr_id')); ?>" value="<?php echo esc_attr($instance['flickr_id']); ?>" class="widefat" />
			<?php /* <small style="line-height:12px;"><a href="http://www.idgettr.com">Find your Flickr user or group id</a></small> */ ?>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('flickr_nr')); ?>"><?php esc_html_e('Number of photos:', 'elbrus'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('flickr_nr')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('flickr_nr')); ?>" value="<?php echo esc_attr($instance['flickr_nr']); ?>" class="widefat" />
		</p>
	<?php
	}
}


/* *****************************************************
 * Plugin Name: 3-in-1 Posts
 * Description: Retrieve and display popular/latest posts/latest comments.
 * ************************************************** */
class ElbrusTotalpostsWidget extends WP_Widget {

	// Widget setup.
	function __construct() {
		$widget_ops = array('classname' => 'widget_pix_totalposts', 'description' => esc_html__('Retrieve and display popular/latest posts/latest comments.', 'elbrus') );
		parent::__construct('pix-totalposts-widget', esc_html__('Elbrus Popular/Latest posts/Last comments', 'elbrus'), $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['post_title']);

		echo wp_kses_post($before_widget);
		if ($title) echo wp_kses_post($before_title . $title . $after_title);
		$post_count = $instance['post_count'];
		$post_category = $instance['post_category'];

		global $post;
		$args = array( 'posts_per_page' => $post_count);
		if (!empty($post_category))
		$args['category'] = $post_category;
		?>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#pix_totalposts_pop" data-toggle="tab"><?php esc_html_e('Recent', 'elbrus')?></a></li>
			<li><a href="#pix_totalposts_rec" data-toggle="tab"><?php esc_html_e('Popular', 'elbrus')?></a></li>
			<li><a href="#pix_totalposts_com" data-toggle="tab"><?php esc_html_e('Comments', 'elbrus')?></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="pix_totalposts_pop">

					<?php $myposts = get_posts( $args );
					if ($myposts):
						foreach( $myposts as $post ) :	setup_postdata($post);  ?>
							<div class="media-tab">
								<?php if (has_post_thumbnail()) : ?>
								<a href="<?php the_permalink()?>" class="media-tab-thumb">
									<?php the_post_thumbnail('elbrus-post-thumb-small', array('class'=>'media-object') ); ?>
								</a>
								<?php endif; ?>
								<div class="media-body">
									<h5 class="media-heading"><a href="<?php esc_url(the_permalink())?>"><?php echo elbrus_limit_words( get_the_title(), 9)?></a></h5>
									<time datetime="<?php echo esc_attr(get_the_time('Y-m-d')); ?>"><i class="icon-calendar fa fa-calendar"></i><?php echo get_the_time('F d, Y'); ?></time>
								</div>
							</div>
						<?php endforeach;
					endif; ?>

			</div>
			<div class="tab-pane fade" id="pix_totalposts_rec">
				<?php
				$args ['orderby'] = 'comment_count';
				$myposts = get_posts( $args );

				if ($myposts):
					foreach( $myposts as $post ) :	setup_postdata($post);  ?>
						<div class="media-tab">
							<?php if (has_post_thumbnail()) : ?>
							<a href="<?php the_permalink()?>" class="media-tab-thumb">
								<?php the_post_thumbnail('elbrus-post-thumb-small', array('class'=>'media-object') ); ?>
							</a>
							<?php endif; ?>
							<div class="media-body">
								<h5 class="media-heading"><a href="<?php esc_url(the_permalink())?>"><?php echo elbrus_limit_words( get_the_title(), 9)?></a></h5>
								<time datetime="<?php echo esc_attr(get_the_time('Y-m-d')); ?>"><i class="icon-calendar fa fa-calendar"></i><?php echo get_the_time('F d, Y'); ?></time>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<div class="tab-pane fade" id="pix_totalposts_com">
				<?php
				global $wpdb;
				$sql = $wpdb->prepare("SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,70) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '%d' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT %d", 1, 5);
				$comments = $wpdb->get_results($sql);
				foreach ($comments as $comment) :?>
					<div class="media-tab  media-tab-comment">
						<a href="<?php echo esc_url(get_permalink($comment->ID).'#comment-'.$comment->comment_ID)?>" title="<?php echo esc_attr(strip_tags($comment->comment_author).' '.esc_html__('on ', 'elbrus').' '.$comment->post_title)?>" class="pull-left">
							<?php echo get_avatar($comment, '60'); ?>
						</a>
						<div class="media-body">

							<a href="<?php echo esc_url(get_permalink($comment->ID).'#comment-'.$comment->comment_ID)?>" title="<?php echo esc_attr(strip_tags($comment->comment_author).' '.esc_html__('on', 'elbrus').' '.$comment->post_title)?>">

								<?php echo strip_tags($comment->comment_author)?>
							</a>
							<div class="tab-comment-body"><p><?php echo strip_tags($comment->com_excerpt)?></p></div>

							<time datetime="<?php echo esc_attr(get_the_time('Y-m-d')); ?>"><i class="icon-calendar fa fa-calendar"></i><?php echo get_the_time('F d, Y'); ?></time>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php echo wp_kses_post($after_widget);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['post_title'] = strip_tags($new_instance['post_title']);
		$instance['post_count'] = strip_tags($new_instance['post_count']);
		$instance['post_category'] = strip_tags($new_instance['post_category']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'post_title' => esc_html__('Blog posts', 'elbrus' ),
			'post_count' => '3',
			'post_category' => ''
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('post_title')); ?>"><?php esc_html_e('Title', 'elbrus'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('post_title')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('post_title')); ?>" value="<?php echo esc_attr($instance['post_title']); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('post_count')); ?>"><?php esc_html_e('Number of Posts to show', 'elbrus'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('post_count')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('post_count')); ?>" value="<?php echo esc_attr($instance['post_count']); ?>" class="widefat" />
		</p>

		 <p>
			<label for="<?php echo esc_attr($this->get_field_id('post_category')); ?>"><?php esc_html_e('Category (Leave Blank to show from all categories)', 'elbrus'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('post_category')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('post_category')); ?>" value="<?php echo esc_attr($instance['post_category']); ?>" class="widefat" />
		</p>
	<?php
	}
}

//////////////////////////////////////////
class ElbrusCatsWidget extends WP_Widget {

	// Widget setup.
	function __construct() {
		$widget_ops = array('classname' => 'widget_portfolio_category', 'description' => esc_html__('Display Portfolio Categories', 'elbrus') );
		parent::__construct('pix-cats-widget', esc_html__('Elbrus - Portfolio Categories', 'elbrus'), $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['cats_title']);

		echo wp_kses_post($before_widget);
		if ($title) echo wp_kses_post($before_title . $title . $after_title);

		$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0');
		$categories = get_categories($args);
		echo '<ul>';
		$i=0;
		foreach($categories as $category){
			$i++;
			$class = $i == count($categories) ? 'class="li-last"' : '';
			?>
			<li <?php echo wp_kses_post($class)?>><a href="<?php echo esc_url(get_category_link( $category->term_id )); ?>"><?php echo wp_kses_post($category->name); ?></a></li>
			<?php
		}
		echo '</ul>';
		echo wp_kses_post($after_widget);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['cats_title'] = strip_tags($new_instance['cats_title']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'cats_title' => esc_html__( 'Portfolio Categories', 'elbrus' ),
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('cats_title')); ?>"><?php esc_html_e('Title', 'elbrus'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('cats_title')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('cats_title')); ?>" value="<?php echo esc_attr($instance['cats_title']); ?>" class="widefat" />
		</p>

	<?php
	}
}

add_action( 'widgets_init', 'elbrus_load_widgets' );
function elbrus_load_widgets() {
	register_widget( 'ElbrusFlickrWidget' );
	register_widget( 'ElbrusTotalpostsWidget' );
	register_widget( 'ElbrusCatsWidget' );
}