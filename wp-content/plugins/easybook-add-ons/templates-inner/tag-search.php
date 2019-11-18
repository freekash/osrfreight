<?php
/**
 * @package EasyBook Add-Ons
 * @description A custom plugin for EasyBook - Hotel & Tour Booking WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 03-10-2019
 * @version 1.1.7
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


?>
<div class="ltag-filter-wrap">
	<div class="switchbtn text-center">
	    <input id="ltags_filter_<?php echo $tag['value'];?>" class="switchbtn-checkbox" type="checkbox" value="<?php echo $tag['value'];?>" name="ltags[]">
	    <label class="switchbtn-label" for="ltags_filter_<?php echo $tag['value'];?>"><?php echo $tag['label'];?></label>
	</div>
</div>
<!-- end listing-feature-wrap -->

	
