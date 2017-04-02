<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $image
 * @var $title
 * @var $address
 * @var $width
 * @var $height
 * @var $zoom
 * @var $scrollwheel
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Map
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$out = '';

$img_id = preg_replace( '/[^\d]/', '', $image );
$img_link = wp_get_attachment_image_src( $img_id, 'full' );
$img_link = $img_link[0];
$image_meta = elbrus_pix_wp_get_attachment($img_id);
$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];
$width = $width == '' ? '100%' : $width;
$height = $height == '' ? '300px' : $height;
$zoom = $zoom == '' ? 12 : $zoom;
$scrollwheel = $scrollwheel == '' ? 'false' : $scrollwheel;

$out = '

	<style>

		#contact-map{
			width: '.esc_attr($width).';
			height: '.esc_attr($height).';
			margin: 0 auto;
		}

	</style>

	<div id="contact-map"></div>

<script type="text/javascript">


/*=== initializate google map ====*/

function initMap() {

	var styles = [
		{
			stylers: [
				{hue: "#686868"},
				{saturation: -100},
				{lightness: -40}
			]
		}
	];

geocoder = new google.maps.Geocoder();
var myLatLng = {lat: 34.0522342, lng: -118.2436849};
var address = "'.wp_kses_post($address).'";
var image = "'.esc_url($img_link).'";
var zoom = '.esc_attr($zoom).';
var scrollwheel = '.esc_attr($scrollwheel).';

// Create a map object and specify the DOM element for display.
var map = new google.maps.Map(document.getElementById("contact-map"), {
	center: myLatLng,
	scrollwheel: scrollwheel,
	zoom: zoom
});

map.setOptions({styles: styles});
if (geocoder) {
	  geocoder.geocode( { "address": address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
		  if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
		  map.setCenter(results[0].geometry.location);

			var infowindow = new google.maps.InfoWindow(
				{ content: "<b>"+address+"</b>",
				  size: new google.maps.Size(150,50)
				});

			var marker = new google.maps.Marker({
				position: results[0].geometry.location,
				map: map,
				icon: image,
				title:address
			});
			google.maps.event.addListener(marker, "click", function() {
				infowindow.open(map,marker);
			});

		  } else {
			alert("No results found");
		  }
		} else {
		  alert("Geocode was not successful for the following reason: " + status);
		}
	  });
	}


}

	</script>

<!-- GOOGLE MAP API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAHDFaUVFTKqrrUtBXubJbrUxKKq-t8Fw&amp;callback=initMap" async defer></script>
	';

echo $out;