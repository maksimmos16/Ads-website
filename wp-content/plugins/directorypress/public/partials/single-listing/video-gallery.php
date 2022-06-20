<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/
global $DIRECTORYPRESS_ADIMN_SETTINGS;
$images = array();
$image_number = count($listing->images);
$width = 177;
$height = 120;

//if(!$slider_nav){
	//$nonav_class = 'slick-carousel-nonav';
//}else{
	//$nonav_class = 'slick-carousel2';
//}

?>
<?php if ($listing->videos): ?>
<div class="directorypress-listing-video-gallery-wrapper">
	<div class="directorypress-video-field-name"><?php echo esc_html__('Videos', 'DIRETORYPRESS'); ?></div>
	<div class="directorypress-listing-video-gallery">
		<?php
			foreach ($listing->videos AS $video):
				if (strlen($video['id']) == 11):
					echo '<div><iframe width="100%" height="400" class="directorypress-video-iframe fitvidsignore" src="//www.youtube.com/embed/'.$video['id'].'" frameborder="0" allowfullscreen></iframe></div>';
				elseif (strlen($video['id']) == 9):
					echo '<div><iframe width="100%" height="400" class="directorypress-video-iframe fitvidsignore" src="https://player.vimeo.com/video/'.$video['id'].'?color=d1d1d1&title=0&byline=0&portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
				endif;
			endforeach;
		?>
	</div>
	<div class="video-slider-nav">
		<?php
		foreach ($listing->videos AS $video):
			if (strlen($video['id']) == 11) {
				$image_url = "http://i.ytimg.com/vi/" . $video['id'] . "/0.jpg";
			} elseif (strlen($video['id']) == 8 || strlen($video['id']) == 9) {
				$data = file_get_contents("http://vimeo.com/api/v2/video/" . $video['id'] . ".json");
				$data = json_decode($data);
				$image_url = $data[0]->thumbnail_medium;
			}
			echo '<div><img src="'.$image_url.'" alt="video" width="172" height="110" /></div>';
		endforeach;
		?>
	</div>
</div>
<?php endif; ?>


 