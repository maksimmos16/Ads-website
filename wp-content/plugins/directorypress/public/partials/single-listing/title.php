<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/

if ($listing->title()):
?>
	<header class="directorypress-listing-title clearfix">
		<h2 itemprop="name"><?php echo $listing->title(); ?></h2>			
	</header>
<?php endif; ?>

 