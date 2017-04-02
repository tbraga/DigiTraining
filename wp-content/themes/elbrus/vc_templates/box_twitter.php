<?php
$transName = $cacheTime = $carousel_class = '';

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $username
 * @var $consumer_key
 * @var $consumer_secret
 * @var $access_token
 * @var $access_token_secret
 * @var $num_of_tweets
 * @var $disable_carousel
 * @var $autoplay
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Twitter
 */
$title = $username = $consumer_key = $consumer_secret = $access_token = $access_token_secret =
$num_of_tweets = $disable_carousel = $autoplay = $css_animation = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$transName = 'vc_list_tweets'.$username;
$cacheTime = 20;
$carousel_class = $disable_carousel == 0 ? 'disable_carousel' : 'enable-owl-carousel';
$twitter_autoplay = is_numeric($autoplay) && $autoplay > 0 ? $autoplay : 'false';
$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
$out = '';

use Abraham\TwitterOAuth\TwitterOAuth;

$out .= '<div class="twitter ' . esc_attr($css_animation_class) . '">
			<div class="slider-title">' . wp_kses_post($title) . ' <i class="fa fa-twitter"></i> <a href="'.esc_url('http://twitter.com/'.$username).'">'.esc_attr($username).'</a></div>
';

if( !empty($username) && !empty($consumer_key) && !empty($consumer_secret) && !empty($access_token) && !empty($access_token_secret)  ){
	$twitterConnection = new TwitterOAuth( $consumer_key , $consumer_secret , $access_token , $access_token_secret	);
	if(false === ($twitterData = get_transient($transName) ) ){

		$twitterConnection = new TwitterOAuth( $consumer_key , $consumer_secret , $access_token , $access_token_secret	);
		$twitterData = $twitterConnection->get(
				  'statuses/user_timeline',
				  array(
					'screen_name'     => $username ,
					'count'           => $num_of_tweets
					)
				);

		if($twitterConnection->getLastHttpCode() !== 200)
		{
			$twitterData = get_transient($transName);
		}
		// Save our new transient.
		set_transient($transName, $twitterData, 60 * $cacheTime);
	}

	if( !empty($twitterData) && is_array($twitterData)  && !isset($twitterData['error'])){
		$i=0;
		$hyperlinks = true;
		$encode_utf8 = true;
		$twitter_users = true;
		$update = true;
$out .= '
		<div class="wrap-section-slider '.esc_attr($carousel_class).' owl-theme" data-single-item="true" data-auto-play="'.esc_attr($twitter_autoplay).'">
';
		foreach($twitterData as $item){
				$msg = $item->text;
				$permalink = esc_url('http://twitter.com/#!/'. $username .'/status/'. $item->id_str);
				if($encode_utf8) $msg = utf8_encode($msg);
					$link = $permalink;
$out .= '
			<div class="slide-item">
		';
				if ($hyperlinks) { $msg = $this->hyperlinks($msg); }
				if ($twitter_users) { $msg = $this->twitter_users($msg); }
$out .= '<p class="large">'.wp_kses_post($msg).'</p>';
				if($update) {
					$time = strtotime($item->created_at);
					if ( ( abs( time() - $time) ) < 86400 )
						$h_time = sprintf( esc_attr__('%s ago', 'elbrus'), human_time_diff( $time ) );
					else
						$h_time = date(esc_attr__('Y/m/d', 'elbrus'), $time);

$out .= '<div class="time">' . wp_kses_post($h_time) . '</div>';
				}
$out .= '
			</div>
';
				$i++;
				if ( $i >= $num_of_tweets ) break;
		}
$out .= '
		</div>
';
	} else {
		$out .= esc_attr__('Sorry , Twitter seems down or responds slowly.', 'elbrus');
	}
}
else{
		$out .= esc_attr__('You need to Setup Twitter API OAuth settings first', 'elbrus');
}

$out .= '</div>';

echo $out;