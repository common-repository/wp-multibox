<?php
/*
Plugin Name: WP Multibox
Plugin URI: http://www.3dolab.net/en/wordpress-multibox-plugin
Description: Adds the multibox modal window in unobtrusive way and select the MooTools framework version to be used.
Version: 1.6
Author: 3dolab
Author URI: http://www.3dolab.net

This work is largely based on the WordPress Multibox plugin by Manfred Rutschmann (http://www.rutschmann.biz),
the Multibox script by Samuel Birch (http://www.phatfusion.net) further improved by Liam Smart (http://www.liamsmart.co.uk)
All distributed under GPLv2.
*/


####### Multibox install section
$version = '1.6';
register_activation_hook(__FILE__,'wmp_install');

function wmp_install () {
	get_option('wmp_automatic')==' ' ? update_option( 'wmp_automatic', '1' ) : $wmp_automatic;
	get_option('wmp_regex')=='' ? update_option( 'wmp_regex', 'jpg,jpeg,png,gif,bmp,ico,mp3,wmv,mov,flv,rv,rm,rmvb,swf' ) : $wmp_regex;
	get_option('wmp_moo13')==' ' ? update_option( 'wmp_moo13', '2' ) : $wmp_moo13;
	get_option('wmp_classname')=='' ? update_option( 'wmp_classname', 'wmp' ) : $wmp_classname;
	get_option('wmp_ajaxwp')==' ' ? update_option( 'wmp_ajaxwp', '1' ) : $wmp_automatic;
	get_option('wmp_useoverlay')==' ' ? update_option( 'wmp_useoverlay', '1' ) : $wmp_useoverlay;
	get_option('wmp_initialWidth')=='' ? update_option( 'wmp_initialWidth', '150' ) : $wmp_initialWidth;
	get_option('wmp_initialHeight')=='' ? update_option( 'wmp_initialHeight', '150' ) : $wmp_initialHeight;
	get_option('wmp_showNumbers')==' ' ? update_option( 'wmp_showNumbers', '1' ) : $wmp_showNumbers;
	get_option('wmp_showControls')==' ' ? update_option( 'wmp_showControls', '1' ) : $wmp_showControls;
	get_option('wmp_disableDesc')==' ' ? update_option( 'wmp_disableDesc', '0' ) : $wmp_disableDesc;
	get_option('wmp_activatepdf')==' ' ? update_option( 'wmp_activatepdf', '1' ) : $wmp_activatepdf;
	get_option('wmp_pdfwidth')=='' ? update_option( 'wmp_pdfwidth', '900' ) : $wmp_pdfwidth;
	get_option('wmp_pdfheight')=='' ? update_option( 'wmp_pdfheight', '750' ) : $wmp_pdfheight;
	get_option('wmp_slideshow')==' ' ? update_option( 'wmp_slideshow', '1' ) : $wmp_slideshow;
	get_option('wmp_slideshowTime')=='' ? update_option( 'wmp_slideshowTime', '8500' ) : $wmp_slideshowTime;
	get_option('wmp_deactivateHelp')==' ' ? update_option( 'wmp_deactivateHelp', '1' ) : $wmp_deactivateHelp;
	get_option('wmp_useDesign')==' ' ? update_option( 'wmp_useDesign', '1' ) : $wmp_useDesign;
	get_option('wmp_uDBorderColor')=='' ? update_option( 'wmp_uDBorderColor', '#000000' ) : $wmp_uDBorderColor;
	get_option('wmp_uDBorderWith')=='' ? update_option( 'wmp_uDBorderWith', '20' ) : $wmp_uDBorderWith;
	get_option('wmp_uDBorderRadius')=='' ? update_option( 'wmp_uDBorderRadius', '0' ) : $wmp_uDBorderRadius;
	get_option('wmp_uDBorderPadding')=='' ? update_option( 'wmp_uDBorderPadding', '0' ) : $wmp_uDBorderPadding;
	get_option('wmp_uDBackgroundColor')=='' ? update_option( 'wmp_uDBackgroundColor', '#000000' ) : $wmp_uDBackgroundColor;
	get_option('wmp_uDTitleColor')=='' ? update_option( 'wmp_uDTitleColor', '#FFFFFF' ) : $wmp_uDTitleColor;
	get_option('wmp_uDDescColor')=='' ? update_option( 'wmp_uDDescColor', '#FFFFFF' ) : $wmp_uDDescColor;
	get_option('wmp_useOwnIcons')=='' ? update_option( 'wmp_useOwnIcons', 'images' ) : $wmp_useOwnIcons;
	get_option('wmp_uDOverlayBG')=='' ? update_option( 'wmp_uDOverlayBG', '#000000' ) : $wmp_uDOverlayBG;
}

####### Multibox admin section
		
add_action('admin_menu', 'add_OptionPage');

function add_OptionPage() 
{
	$mypage = add_options_page('WP Multibox', 'WP Multibox', 8, 'wp-multibox/multibox.php', 'optionsPage');
	add_action( "admin_print_scripts-$mypage", 'add_admin_js' );
}
function add_admin_js() 
{
	$multibox_path = get_option('siteurl')."/wp-content/plugins/wp-multibox/";
	$content='<script src="' . $multibox_path . 'CP/201a.js" type="text/javascript"></script>
	<script type="text/javascript">
	function setColor(inputIn,inputOut) {
		var inputColor = document.getElementById(inputIn).value;
		document.getElementById(inputOut).style.backgroundColor = inputColor;
	}
	</script>
	';
	echo $content;
}

function optionsPage() 
{
	global $_POST;
	$multibox_path = get_option('siteurl')."/wp-content/plugins/wp-multibox/";
	$content.='<div class="wrap">
						<h2>General options for your wordpress multibox plugin</h2><br>
						<div class="updated"><p>
						Visit my site for support: <a href="http://www.3dolab.net/en/wordpress-multibox-plugin">WordPress WP Multibox Plugin home</a>
						</p></div>
	';
	if( $_POST['wmp_update'] == 1 ) 
  {
			update_option( 'wmp_automatic', $_POST['wmp_automatic'] );
			update_option( 'wmp_regex', $_POST['wmp_regex'] );
			update_option( 'wmp_classname', $_POST['wmp_classname'] );
			update_option( 'wmp_ajaxwp', $_POST['wmp_ajaxwp'] );
			update_option( 'wmp_useoverlay', $_POST['wmp_useoverlay'] );
			update_option( 'wmp_initialWidth', $_POST['wmp_initialWidth'] );
			update_option( 'wmp_initialHeight', $_POST['wmp_initialHeight'] );
			update_option( 'wmp_showNumbers', $_POST['wmp_showNumbers'] );
			update_option( 'wmp_showControls', $_POST['wmp_showControls'] );
			update_option( 'wmp_disableDesc', $_POST['wmp_disableDesc'] );
			update_option( 'wmp_activatepdf', $_POST['wmp_activatepdf'] );
			update_option( 'wmp_pdfwidth', $_POST['wmp_pdfwidth'] );
			update_option( 'wmp_pdfheight', $_POST['wmp_pdfheight'] );
			update_option( 'wmp_moo13', $_POST['wmp_moo13'] );
			update_option( 'wmp_slideshow', $_POST['wmp_slideshow'] );
			update_option( 'wmp_slideshowTime', $_POST['wmp_slideshowTime'] );
			update_option( 'wmp_deactivateHelp', $_POST['wmp_deactivateHelp'] );
			update_option( 'wmp_useDesign', $_POST['wmp_useDesign'] );
			update_option( 'wmp_uDBorderColor', $_POST['wmp_uDBorderColor'] );
			update_option( 'wmp_uDBorderWith', $_POST['wmp_uDBorderWith'] );
			update_option( 'wmp_uDBorderRadius', $_POST['wmp_uDBorderRadius'] );
			update_option( 'wmp_uDBorderPadding', $_POST['wmp_uDBorderPadding'] );
			update_option( 'wmp_uDBackgroundColor', $_POST['wmp_uDBackgroundColor'] );
			update_option( 'wmp_uDTitleColor', $_POST['wmp_uDTitleColor'] );
			update_option( 'wmp_uDDescColor', $_POST['wmp_uDDescColor'] );
			update_option( 'wmp_useOwnIcons', $_POST['wmp_useOwnIcons'] );
			update_option( 'wmp_uDOverlayBG', $_POST['wmp_uDOverlayBG'] );
	 		$content.='<div class="updated"><p><strong>Options saved.</strong></p></div>';
	}
			
		$wmp_automatic = get_option('wmp_automatic');
		$wmp_useoverlay = get_option('wmp_useoverlay');
		$wmp_showNumbers = get_option('wmp_showNumbers');
		$wmp_showControls = get_option('wmp_showControls');
		$wmp_disableDesc = get_option('wmp_disableDesc');
		$wmp_activatepdf = get_option('wmp_activatepdf');
		$wmp_moo13 = get_option('wmp_moo13');
		$wmp_ajaxwp = get_option('wmp_ajaxwp');
 		$wmp_slideshow = get_option('wmp_slideshow');
		$wmp_deactivateHelp = get_option('wmp_deactivateHelp');
		$wmp_useDesign = get_option('wmp_useDesign');

		$content.='
			<br>
			<form name="form1" method="post" action="'. str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'">
				<input type="hidden" name="wmp_update" value="1">
				
				<h3>General Options</h3><br>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label style="width: 275px; display: block; float:left; margin-right:10px;" for="wmp_automatic">Automatic Mode:</label>
						';
						$wmp_automatic==1 ? $content.='<input style="float: left;" type="checkbox" name="wmp_automatic" id="wmp_automatic" value="1" checked>' : $content.='<input style="float: left;" type="checkbox" name="wmp_automatic" id="wmp_automatic" value="1">';
						$content.='
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label style="width: 275px; display: block; float:left; margin-right:10px;" for="wmp_moo13">Use mootools v1.3 , v1.25 or mootools 1.11</label>
						<select style="float: left;" name="wmp_moo13" id="wmp_moo13">
						';
						if ($wmp_moo13==2){
						  $content.='<option value="2" selected>MooTools v.1.3.2</option>
							     <option value="1">MooTools v.1.2.5</option>
							     <option value="0">MooTools v.1.1.1</option>
							     ';
						}
						else if ($wmp_moo13==1){
						  $content.='<option value="2">MooTools v.1.3.2</option>
							     <option value="1" selected>MooTools v.1.2.5</option>
							     <option value="0">MooTools v.1.1.1</option>
							     ';
						}
						else{
						  $content.='<option value="2">MooTools v.1.3.2</option>
							     <option value="1">MooTools v.1.2.5</option>
							     <option value="0" selected>MooTools v.1.1.1</option>
							     ';
						}
						$content.='
						</select>
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_regex" style="width: 275px; display: block; float:left; margin-right:10px;">
							Comma seperated list of file extensions for automtatic mode (e.g. jpg,bmp,gif,png)
						</label>
						<textarea  style="float: left;" name="wmp_regex" id="wmp_regex" cols="60" rows="2">' . get_option('wmp_regex') . '</textarea>
						<div style="clear: both"></div>
				</div>
				
				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_classname" style="width: 275px; display: block; float:left; margin-right:10px;">
							Name of the class in the a tag params (also for css an id used)
						</label>
						<input style="float: left;" type="text" size="25" name="wmp_classname" value="' . get_option('wmp_classname') . '"><br><br><br>
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_ajaxwp" style="width: 275px; display: block; float:left; margin-right:10px;" for="wmp_ajaxwp">
							AJAXed WordPress (only available with MooTools 1.3 or 1.2 selected above):
						</label>';
						$wmp_ajaxwp==1 ? $content.='<input style="float: left;" type="checkbox" name="wmp_ajaxwp" id="wmp_ajaxwp" value="1" checked>' : $content.='<input style="float: left;" type="checkbox" name="wmp_ajaxwp" id="wmp_ajaxwp" value="1">';
						$content.='
						<div style="clear: both"></div>
				</div>
				
				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_useoverlay" style="width: 275px; display: block; float:left; margin-right:10px;">
							Use an overlay with opacity for the background
						</label>
						';
						$wmp_useoverlay==1 ? $content.='<input  style="float: left;" type="checkbox" name="wmp_useoverlay" id="wmp_useoverlay" value="1" checked>' : $content.='<input style="float: left;" type="checkbox" name="wmp_useoverlay" id="wmp_useoverlay" value="1">';

						$content.='
						<div style="clear: both"></div>
				</div>
						
				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_initialWidth" style="width: 275px; display: block; float:left; margin-right:10px;">
							Width of the multibox when content is loading
						</label>
						<input  style="float: left;"type="text" size="8" name="wmp_initialWidth" value="' . get_option('wmp_initialWidth') . '">
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_initialHeight" style="width: 275px; display: block; float:left; margin-right:10px;">
							Height of the multibox when content is loading
						</label>
						<input  style="float: left;"type="text" size="8" name="wmp_initialHeight" value="' . get_option('wmp_initialHeight') . '">
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_showNumbers" style="width: 275px; display: block; float:left; margin-right:10px;">
							Shows the number of availible content for loading with the multibox on the page
						</label>
						';
						$wmp_showNumbers==1 ? $content.='<input type="checkbox" style="float: left;" name="wmp_showNumbers" id="wmp_showNumbers" value="1" checked>' : $content.='<input type="checkbox" style="float: left;" name="wmp_showNumbers" id="wmp_showNumbers" value="1">';

						$content.='
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_showControls"  style="width: 275px; display: block; float:left; margin-right:10px;">
							Show the controls like description and arrows for browsing
						</label>
						';
						$wmp_showControls==1 ? $content.='<input  style="float: left;" type="checkbox" name="wmp_showControls" id="wmp_showControls" value="1" checked>' : $content.='<input  style="float: left;" type="checkbox" name="wmp_showControls" id="wmp_showControls" value="1">';

						$content.='
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_disableDesc"  style="width: 275px; display: block; float:left; margin-right:10px;">
							Disable the description (need for NextGen Gallery at the moment)
						</label>
						';
						$wmp_disableDesc==1 ? $content.='<input  style="float: left;" type="checkbox" name="wmp_disableDesc" id="wmp_disableDesc" value="1" checked>' : $content.='<input  style="float: left;" type="checkbox" name="wmp_disableDesc" id="wmp_disableDesc" value="1">';

						$content.='
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_deactivateHelp"  style="width: 275px; display: block; float:left; margin-right:10px;">
							Disable the help icon with version information
						</label>
						';
						$wmp_deactivateHelp==1 ? $content.='<input  style="float: left;" type="checkbox" name="wmp_deactivateHelp" id="wmp_deactivateHelp" value="1" checked>' : $content.='<input  style="float: left;" type="checkbox" name="wmp_deactivateHelp" id="wmp_deactivateHelp" value="1">';

						$content.='
						<div style="clear: both"></div>
				</div>

				<h3>Design options</h3><br>
				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_useDesign" style="width: 275px; display: block; float:left; margin-right:10px;">
							Use this design settings and overwrite the standard design (look at the thumb for more informations)
						</label>
						';
						$wmp_useDesign==1 ? $content.='<input  style="float: left;" type="checkbox" name="wmp_useDesign" id="wmp_useDesign" value="1" checked>' : $content.='<input style="float: left;" type="checkbox" name="wmp_useDesign" id="wmp_useDesign" value="1">';

						$content.='
						&nbsp;<img src="' . $multibox_path . 'design_mini.jpg" style="cursor: pointer;" onclick="window.open(\'' . $multibox_path . 'design.jpg\', \'big\', \'width=662,height=471,status=no,scrollbars=no,resizable=no\');">
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_uDBorderWith" style="width: 275px; display: block; float:left; margin-right:10px;">
							1. Width of the border<br>
							<i>(std: 20 )(without "px")</i>
						</label>
						<input  style="float: left;"type="text" size="8" name="wmp_uDBorderWith" value="' . get_option('wmp_uDBorderWith') . '">
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_uDBorderColor" style="width: 275px; display: block; float:left; margin-right:10px;">
							2. Color of the border, you can make use of <i>transparent</i><br>
							<i>(std: #000000)</i>
						</label>
						<input style="float: left;"type="text" size="8" onkeyup="setColor(\'wmp_uDBorderColor\',\'wmp_uDBorderColorField\')" name="wmp_uDBorderColor" id="wmp_uDBorderColor" value="' . get_option('wmp_uDBorderColor') . '">
						<input class="button-secondary" value="..." onclick="showColorGrid2(\'wmp_uDBorderColor\',\'wmp_uDBorderColorField\');" type="button" title="Select color">
						<input id="wmp_uDBorderColorField" class="button-highlighted" style="background-color: ' . get_option('wmp_uDBorderColor') . ';" type="text" size="4" DISABLED>
						<div id="colorpicker201" class="colorpicker201"></div>
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_uDBorderRadius" style="width: 275px; display: block; float:left; margin-right:10px;">
							3. Radius of all corners from the border above. Works not in I.E.<br>
							<i>(std: 0)</i>
						</label>
						<input  style="float: left;"type="text" size="8" name="wmp_uDBorderRadius" value="' . get_option('wmp_uDBorderRadius') . '">
						<div style="clear: both"></div>
				</div>


				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_uDBorderPadding" style="width: 275px; display: block; float:left; margin-right:10px;">
							4. Padding between image an border<br>
							<i>(std: 0 )(without "px")</i>
						</label>
						<input  style="float: left;"type="text" size="8" name="wmp_uDBorderPadding" value="' . get_option('wmp_uDBorderPadding') . '">
						<div style="clear: both"></div>
				</div>


				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_uDBackgroundColor" style="width: 275px; display: block; float:left; margin-right:10px;">
							5. Background color of the multibox and the control panel, you can make use of <i>transparent</i><br>
							<i>(std: #000000)</i>
						</label>
						<input style="float: left;"type="text" size="8" onkeyup="setColor(\'wmp_uDBackgroundColor\',\'wmp_uDBackgroundColorField\')" name="wmp_uDBackgroundColor" id="wmp_uDBackgroundColor" value="' . get_option('wmp_uDBackgroundColor') . '">
						<input class="button-secondary" value="..." onclick="showColorGrid2(\'wmp_uDBackgroundColor\',\'wmp_uDBackgroundColorField\');" type="button" title="Select color">
						<input id="wmp_uDBackgroundColorField" class="button-highlighted" style="background-color: ' . get_option('wmp_uDBackgroundColor') . ';" type="text" size="4" DISABLED>
						<div id="colorpicker201" class="colorpicker201"></div>
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_uDTitleColor" style="width: 275px; display: block; float:left; margin-right:10px;">
							6. Color of the title text<br>
							<i>(std: #FFFFFF)</i>
						</label>
						<input style="float: left;"type="text" size="8" onkeyup="setColor(\'wmp_uDTitleColor\',\'wmp_uDTitleColorField\')" name="wmp_uDTitleColor" id="wmp_uDTitleColor" value="' . get_option('wmp_uDTitleColor') . '">
						<input class="button-secondary" value="..." onclick="showColorGrid2(\'wmp_uDTitleColor\',\'wmp_uDTitleColorField\');" type="button" title="Select color">
						<input id="wmp_uDTitleColorField" class="button-highlighted" style="background-color: ' . get_option('wmp_uDTitleColor') . ';" type="text" size="4" DISABLED>
						<div id="colorpicker201" class="colorpicker201"></div>
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_uDDescColor" style="width: 275px; display: block; float:left; margin-right:10px;">
							7. Color of the description text<br>
							<i>(std: #FFFFFF)</i>
						</label>
						<input style="float: left;"type="text" size="8" onkeyup="setColor(\'wmp_uDDescColor\',\'wmp_uDDescColorField\')" name="wmp_uDDescColor" id="wmp_uDDescColor" value="' . get_option('wmp_uDDescColor') . '">
						<input class="button-secondary" value="..." onclick="showColorGrid2(\'wmp_uDDescColor\',\'wmp_uDDescColorField\');" type="button" title="Select color">
						<input id="wmp_uDDescColorField" class="button-highlighted" style="background-color: ' . get_option('wmp_uDDescColor') . ';" type="text" size="4" DISABLED>
						<div id="colorpicker201" class="colorpicker201"></div>
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_uDOverlayBG" style="width: 275px; display: block; float:left; margin-right:10px;">
							8. Background color of the transparent overlay<br>
							<i>(std: #000000)</i>
						</label>
						<input style="float: left;"type="text" size="8" onkeyup="setColor(\'wmp_uDOverlayBG\',\'wmp_uDOverlayBGField\')" name="wmp_uDOverlayBG" id="wmp_uDOverlayBG" value="' . get_option('wmp_uDOverlayBG') . '">
						<input class="button-secondary" value="..." onclick="showColorGrid2(\'wmp_uDOverlayBG\',\'wmp_uDOverlayBGField\');" type="button" title="Select color">
						<input id="wmp_uDOverlayBGField" class="button-highlighted" style="background-color: ' . get_option('wmp_uDOverlayBG') . ';" type="text" size="4" DISABLED>
						<div id="colorpicker201" class="colorpicker201"></div>
						<div style="clear: both"></div>
				</div>
				
				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_useOwnIcons" style="width: 275px; display: block; float:left; margin-right:10px;">
							Make use of own icons. Take a look at the images folder. You need ALL icons in an additional folder like "myimages". Please note that the folder must be in the multibox plugin folder, the images must been in png format and all filenames must be like the original image names!<br>
							<i>(std: images)</i>
						</label>
						<input style="float: left;" type="text" size="40" name="wmp_useOwnIcons" value="' . get_option('wmp_useOwnIcons') . '"><br><br><br>
						<div style="clear: both"></div>
				</div>

				
				<h3>Handle PDF files in multibox</h3><br>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_activatepdf"  style="width: 275px; display: block; float:left; margin-right:10px;">
							Activate the multibox for pdf files (opens the acrobat reader in multibox)
						</label>
						';
						$wmp_activatepdf==1 ? $content.='<input  style="float: left;" type="checkbox" name="wmp_activatepdf" id="wmp_activatepdf" value="1" checked>' : $content.='<input  style="float: left;" type="checkbox" name="wmp_activatepdf" id="wmp_activatepdf" value="1">';

						$content.='
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_pdfwidth"  style="width: 275px; display: block; float:left; margin-right:10px;">
							Width of the multibox for pdf files
						</label>
						<input  style="float: left;"type="text" size="8" name="wmp_pdfwidth" value="' . get_option('wmp_pdfwidth') . '">
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_pdfheight"  style="width: 275px; display: block; float:left; margin-right:10px;">
							Height of the multibox for pdf files
						</label>
						<input  style="float: left;"type="text" size="8" name="wmp_pdfheight" value="' . get_option('wmp_pdfheight') . '">
						<div style="clear: both"></div>
				</div>

				<h3>Slideshow:</h3><br>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_slideshow"  style="width: 275px; display: block; float:left; margin-right:10px;">
							Activate the Slideshow in the control panel
						</label>
						';
						$wmp_slideshow==1 ? $content.='<input  style="float: left;" type="checkbox" name="wmp_slideshow" id="wmp_slideshow" value="1" checked>' : $content.='<input  style="float: left;" type="checkbox" name="wmp_slideshow" id="wmp_slideshow" value="1">';

						$content.='
						<div style="clear: both"></div>
				</div>

				<div style="padding: 10px; margin: 0 0 10px 0; background: #EAF3FA;">
						<label for="wmp_slideshowTime"  style="width: 275px; display: block; float:left; margin-right:10px;">
							Stop time for each image in milliseconds (1000 = 1 second!)
						</label>
						<input  style="float: left;"type="text" size="8" name="wmp_slideshowTime" value="' . get_option('wmp_slideshowTime') . '">
						<div style="clear: both"></div>
				</div>
				

			<hr />
			<p class="submit"><input type="submit" name="Submit" value="Update Options" /></p>
			</form></div>';		
	
	echo $content;
	}
		
		
		####### Multibox output section
		
function multibox_load() {
if (!is_admin()) { // avoid the scripts from loading on admin panel
	makeHeaderscripts(get_option('wmp_moo13'), get_option('wmp_ajaxwp') );
	}
}

function multibox_styles() {
if (!is_admin()) { // avoid the scripts from loading on admin panel
	echo makeHeader();
	}
}		

function makeHeaderscripts($moo, $ajaxwp) 
{
	if($moo == 2) 
  	{
		wp_register_script('moocore', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv130/mootools-core-1.3.2-full-nocompat-yc.js', false, '1.3');
		wp_register_script('moomore', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv130/mootools-more-1.3.2.1-yc.js', false, '1.3');
		wp_enqueue_script('moocore');
		wp_enqueue_script('moomore');
		wp_enqueue_script('overlay', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv130/overlay-1.2.js', array('moocore','moomore'), '1.3');
		wp_enqueue_script('multibox', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv130/multibox-1.3.1.js', array('moocore','moomore'), '1.3');
		if($ajaxwp == 1) {
			wp_enqueue_script('mboxajaxwp', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv130/implement-ajaxwp-1.3.js', array('moocore','moomore','multibox','overlay'), '1.3');
			if (class_exists('SitePress')) {
				$language = strtolower(ICL_LANGUAGE_CODE);
				wp_localize_script( 'mboxajaxwp', 'WMPAjaxParams', array( 'WMPclassName' => get_option('wmp_classname'), 'AjaxUrl' => admin_url( 'admin-ajax.php' ), 'BlogUrl' => get_bloginfo('url'), 'AjaxLang' => $language ) );
			} else {
				wp_localize_script( 'mboxajaxwp', 'WMPAjaxParams', array( 'WMPclassName' => get_option('wmp_classname'), 'AjaxUrl' => admin_url( 'admin-ajax.php' ), 'BlogUrl' => get_bloginfo('url') ) );
			}
		}
	}
	else if($moo == 1) 
  	{
		wp_register_script('moocore', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv120/mootools-1.2.5-core-yc.js', false, '1.2');
		wp_register_script('moomore', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv120/mootools-1.2.5.1-more-yc.js', false, '1.2');
		wp_enqueue_script('moocore');
		wp_enqueue_script('moomore');
		wp_enqueue_script('overlay', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv120/overlay-1.2.js', array('moocore','moomore'), '1.2');
		wp_enqueue_script('multibox', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv120/multibox-1.3.1.js', array('moocore','moomore'), '1.2');
		if($ajaxwp == 1) {
		  wp_enqueue_script('mboxajaxwp', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv120/implement-ajaxwp-1.2.js', array('moocore','moomore','multibox','overlay'), '1.2');
			if (class_exists('SitePress')) {
				$language = strtolower(ICL_LANGUAGE_CODE);
				wp_localize_script( 'mboxajaxwp', 'WMPAjaxParams', array( 'WMPclassName' => get_option('wmp_classname'), 'AjaxUrl' => admin_url( 'admin-ajax.php' ), 'BlogUrl' => get_bloginfo('url'), 'AjaxLang' => $language ) );
			} else {
				wp_localize_script( 'mboxajaxwp', 'WMPAjaxParams', array( 'WMPclassName' => get_option('wmp_classname'), 'AjaxUrl' => admin_url( 'admin-ajax.php' ), 'BlogUrl' => get_bloginfo('url') ) );
			}
		}
	}
	else 
	{	wp_register_script('mootools', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv111/mootools.js', false, '1.1');
		wp_enqueue_script('mootools');
		wp_enqueue_script('overlay', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv111/overlay.js', array('mootools'), '1.1');
		wp_enqueue_script('multibox', WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/mtv111/multibox.js', array('mootools'), '1.1');
	}	
}
function makeHeader() 
{	
			//$multibox_path = get_option('siteurl')."/wp-content/plugins/wp-multibox/";
			$multibox_path = WP_PLUGIN_URL . '/'.dirname( plugin_basename(__FILE__)).'/';

			$content =			
			'<!-- added by the wordpress multibox plugin -->
			<!--[if lt IE 7]>
			<style type="text/css">
			.MultiBoxClose, .MultiBoxPrevious, .MultiBoxNext, .MultiBoxNextDisabled, .MultiBoxPreviousDisabled, .MultiBoxHelpButton { 
				behavior: url('.$multibox_path.'iepng/iepngfix.htc); 
			}
			 </style>
			<![endif]--> 
			<link rel="stylesheet" href="' . $multibox_path . 'multibox.css" type="text/css" media="screen" />
			'. getJSconfig() .'
			'. getCSSconfig() .'
			'. getCSSDesignConfig() .'
  		<!-- added by the wordpress multibox plugin -->';
	return $content;
}				
function getCSSDesignConfig() 
{
			global $wp_version, $post, $wp_query;
			$multibox_path = get_option('siteurl')."/wp-content/plugins/wp-multibox/";
			
			if(get_option('wmp_useDesign')=='1') {

				$content='
				 <style type="text/css" media="screen">
				.MultiBoxContainer {
				border-color: ' . get_option('wmp_uDBorderColor') . ';
				border-width: ' . get_option('wmp_uDBorderWith') . 'px;
				padding: ' . get_option('wmp_uDBorderPadding') . 'px;
				-moz-border-radius: ' . get_option('wmp_uDBorderRadius') . 'px;
				-khtml-border-radius: ' . get_option('wmp_uDBorderRadius') . 'px;
				-webkit-border-radius: ' . get_option('wmp_uDBorderRadius') . 'px;
				background-color: ' . get_option('wmp_uDBackgroundColor') . ';
				}
				.MultiBoxControls {background-color: ' . get_option('wmp_uDBackgroundColor') . ';}
				.MultiBoxTitle {color: ' . get_option('wmp_uDTitleColor') . ';}
				.MultiBoxNumber {color: ' . get_option('wmp_uDTitleColor') . ';}
				.MultiBoxDescription {color: ' . get_option('wmp_uDDescColor') . ';}
				.MultiBoxLoading { background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/loader.gif) no-repeat center;}
				.MultiBoxClose {background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/close.png) no-repeat;}
				.MultiBoxPrevious {background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/left.png) no-repeat;}
				.MultiBoxPlayPrevious {background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/leftplay.png) no-repeat;}
				.MultiBoxNext {background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/right.png) no-repeat;}
				.MultiBoxPlayNext {background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/play.png) no-repeat;}
				.MultiBoxPlayNextPause {background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/pause.png) no-repeat;}
				.MultiBoxPlayPreviousPause {background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/pause.png) no-repeat;}
				.MultiBoxPlayPreviousDisabled {background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/leftplayDisabled.png) no-repeat;}
				.MultiBoxPlayNextDisabled {background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/playDisabled.png) no-repeat;}
				.MultiBoxNextDisabled {background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/rightDisabled.png) no-repeat;}
				.MultiBoxPreviousDisabled {background: url(' . $multibox_path.get_option('wmp_useOwnIcons') . '/leftDisabled.png) no-repeat;}
				#Overlay { background-color: ' . get_option('wmp_uDOverlayBG') . ';}
				</style>
			';
			}
		return $content;
}

function getCSSconfig() 
{
			global $wp_version, $post, $wp_query;
			
			get_option('wmp_deactivateHelp')=='1' ? $wmp_deactivateHelp = 'display:none;' : $wmp_deactivateHelp;

			$content='
			 <style type="text/css" media="screen">
			.MultiBoxHelpButton {
				'.$wmp_deactivateHelp.'
			}
			</style>
			';
		return $content;
}
function getJSconfig () 
{

			$multibox_path = get_option('siteurl')."/wp-content/plugins/wp-multibox/";
			global $wp_version, $post, $wp_query;
			get_option('wmp_classname')=='' ? $wmp_classname = 'wmpi' : $wmp_classname = get_option('wmp_classname');
			get_option('wmp_useoverlay')==1 ? $wmp_useoverlay = 'true' : $wmp_useoverlay = 'false';
			get_option('wmp_showNumbers')==1 ? $wmp_showNumbers = 'true' : $wmp_showNumbers = 'false';
			get_option('wmp_showControls')==1 ? $wmp_showControls = 'true' : $wmp_showControls = 'false';
			get_option('wmp_initialWidth')=='' ? $wmp_initialWidth = '150' : $wmp_initialWidth = get_option('wmp_initialWidth');
			get_option('wmp_initialHeight')=='' ? $wmp_initialHeight = '150' : $wmp_initialHeight = get_option('wmp_initialHeight');
			get_option('wmp_slideshow')==1 ? $wmp_slideshow = 'true' : $wmp_slideshow = 'false';
			
			$content='
			<script type="text/javascript">
			var box = {};
			var overlay = {};
						window.addEvent(\'domready\', function(){
							box = new MultiBox(\'' . $wmp_classname . '\', {
								useOverlay: ' . $wmp_useoverlay . ',
								initialWidth: ' . $wmp_initialWidth . ',
								initialHeight: ' . $wmp_initialHeight . ',
								showNumbers: ' . $wmp_showNumbers . ',
								showControls: ' . $wmp_showControls . ',
								path: \'' . $multibox_path .'files/\',
								slideshow: ' . $wmp_slideshow . ',								
								slideshowTime: ' . get_option('wmp_slideshowTime') . '';
								if(get_option('wmp_disableDesc')!='1') {
								$content.=',
								descClassName: \'' . get_option('wmp_classname') . 'Desc\''; }
								$content.=' });
							});
		 </script>
			';
		return $content;
}
function imagebox_create($content)
{
	global $version;

	$multibox_path = get_option('siteurl')."/wp-content/plugins/wp-multibox/";
	get_option('wmp_useDesign')!='1' ? $wmp_useOwnIcons = 'images' : $wmp_useOwnIcons = get_option('wmp_useOwnIcons');

	$regs = get_option('wmp_regex');
	$regsStr = str_replace(',','|', $regs);					
	$regsStr = str_replace(' ','', $regsStr);					

	$content = preg_replace('/<a(.*?)href=(.*?).('.$regsStr.')"(.*?)>/i', '<a$1href=$2.$3" $4 class="' . get_option('wmp_classname') . '" id="' . get_option('wmp_classname') . '1">', $content);
	$content = preg_replace_callback('/(.*?)' . get_option('wmp_classname') . '1(.*?)/i', 'getCount', $content);
	
	preg_match_all('/\[caption(.*?)id="attachment_(.*?)"(.*?)id="' . get_option('wmp_classname') . '(.*?)"(.*?)alt="(.*?)"(.*?)\[\/caption\]/i',$content,$out);
	
	$i=0;
	foreach($out[2] as $dummy) {
		$content.='<div style="display: none;" class="' . get_option('wmp_classname') . 'Desc ' . get_option('wmp_classname') . '' . $out[4][$i] . '">' . $out[6][$i] . '</div>';
		$i++;
	}
	
	if(get_option('wmp_activatepdf')==1) {
		$content = preg_replace('/<a(.*?)href=(.*?).(pdf)"(.*?)>/i', '<a$1href=$2.$3" rel="width:' . get_option('wmp_pdfwidth') .',height:' . get_option('wmp_pdfheight') .'" $4 class="' . get_option('wmp_classname') . '" id="' . get_option('wmp_classname') . '1">', $content);
	}
	
	$content.='';
	return $content;
}

		
function getCount($hit) 
{
	static $i = 1;
	$hit1 = $hit[1];
	$hit2 = $hit[2];
	$out = $hit1.'' . get_option('wmp_classname') . ''.$i.$hit2;
	$i++;
return $out;
}

	####### Multibox description section
	
if(get_option('wmp_automatic')==1) {
	add_filter('the_content', 'imagebox_create', 2);
}
add_action('wp_print_scripts', 'multibox_load');
add_action('wp_head', 'multibox_styles');

	####### AJAX functionality

add_action( 'wp_ajax_nopriv_multibox_ajax_inclusion', 'multibox_ajax_inclusion' );
add_action( 'wp_ajax_multibox_ajax_inclusion', 'multibox_ajax_inclusion' );

function multibox_ajax_inclusion() {

    /*
    if(isset($_REQUEST['target_name']){
	$post_name = $_REQUEST['target_name'];
    }
    */

    if(function_exists('cleaner_gallery_setup')){
		require_once( CLEANER_GALLERY_DIR . 'gallery.php' );
		add_filter( 'cleaner_gallery_image', 'cleaner_gallery_plugin_gallery_image', 10, 4 );
		add_filter( 'cleaner_gallery_caption', 'cleaner_gallery_plugin_image_caption', 10, 3 );
		add_action( 'template_redirect', 'cleaner_gallery_enqueue_script' );
		add_action( 'template_redirect', 'cleaner_gallery_enqueue_style' );
		add_filter( 'cleaner_gallery_defaults', 'cleaner_gallery_default_args' );
    }

    $postID = $_REQUEST['target_id'];
    $ajaxpost = get_post($postID);
    $content = $ajaxpost->post_content;
    //$content = str_replace('[gallery','[gallery id='.$postID,$content);
    //$content = preg_replace('\[\bgallery(.*?)\b\]',apply_filters('post_gallery', '', '$1'),$content);

// missing global $post ?
global $post;
$swap_post = $post;
$post = $ajaxpost;

$content = apply_filters('the_content',$content);
//$content = do_shortcode($ajaxpost->post_content);

    // generate the response
    $response = '<div class="post" id="post-'.$postID.'">
		'.do_shortcode($content).'
		</div><br class="clear" />';

    echo $response;


    $post = $swap_post;
    // IMPORTANT: don't forget to "exit"
    exit;
}
?>