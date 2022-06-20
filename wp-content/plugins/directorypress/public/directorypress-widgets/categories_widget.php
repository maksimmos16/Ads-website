<?php
$scroll = 0;
 ?>

<?php echo $args['before_widget']; ?>
<?php if (!empty($title)){
	if (isset($style) && $style == 1){
		echo '<div class="directorypress_category_widget_inner">'.$args['before_title'] . $title . $args['after_title'].'</div>';
	}else{
		echo '<div class="directorypress_category_widget_inner style2">'.$args['before_title'] . $title . $args['after_title'].'</div>';
	}
	
}
?>
<div class="directorypress-widget directorypress-categories-widget">
	<?php
		if ($style == 1){
			echo '<div class="directorypress_category_widget_inner">';
		}else{
			echo '<div class="directorypress_category_widget_inner style2">';
		}
			/* echo directorypress_renderAllCategories(
				$id,
				$parent,
				$depth,
				1, // column
				$counter,
				$subcats,
				1, // cat style
				$cat_icon_type, //icon type
				0, // scroll
				3,
				3,
				2,
				false,
				false,
				false,
				1000,
				1000,
				30,
				array(),
				array()
			);  */
			$directorypress_handler = new directorypress_categories_handler();
			$directorypress_handler->init($instance);
			echo $directorypress_handler->display();
		echo '<div>';
	 ?>
</div>
<?php echo $args['after_widget']; ?>