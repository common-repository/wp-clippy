<?php
/*
Plugin Name: WP-Clippy
Plugin URI: http://shinraholdings.com/plugins/wp-clippy
Description: Adds a flash button that copies the value of an element or a string to the clipboard when clicked.
Version: 1.0.0
Author: bitacre
Author URI: http://shinraholdings.com
License: GPLv2 
	Copyright 2012 Shinra Web Holdings (plugins@shinraholdings.com)

Usage: 
	[clippy id="id_of_input_element"]
	[clippy value="string to load directly to clipboard"]
*/

function wpClippy_draw_button( $atts ) {
	extract( shortcode_atts( array( 'id'=>NULL, 'value'=>NULL ), $atts ) );
	$clippy_swf = plugins_url( 'wp-clippy.swf', __FILE__ );

	// if $id and not $value
	if( !empty( $id ) && empty( $value ) )
		$code_script = '<script type="text/javascript" language="javascript">function clippyGetValue(){var strClippy=document.getElementById("' . $id . '").value;return strClippy;}</script>';

	// if not $id and $value
	elseif( empty( $id ) && !empty( $value ) ) $code_script = '<script type="text/javascript" language="javascript">function clippyGetValue(){var strClippy = "' . $value . '";return strClippy;}</script>';
	
	// if neither or both
	else return '<p>Error</p>';
	
	// static embed
	$code_embed = '
	<p id="wp-clippy-embed" style="height:27px; width:auto; padding-top:2px; margin:0; clear:both;">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="68" height="25" id="wp-clippy" align="middle" style="height:25px; width:68px; clear:both; float:none; padding:0; margin:0; border:0;">
		<param name="movie" value="' . $clippy_swf . '" />
		<param name="quality" value="high" />
		<param name="bgcolor" value="#ffffff" />
		<param name="play" value="true" />
		<param name="loop" value="true" />
		<param name="wmode" value="window" />
		<param name="scale" value="showall" />
		<param name="menu" value="true" />
		<param name="devicefont" value="false" />
		<param name="salign" value="" />
		<param name="allowScriptAccess" value="sameDomain" />
	
		<!--[if !IE]>-->
		<object type="application/x-shockwave-flash" data="' . $clippy_swf . '" style="height:25px; width:68px; clear:both; float:none; padding:0; margin:0; border:0;">
			<param name="movie" value="' . $clippy_swf . '" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="play" value="true" />
			<param name="loop" value="true" />
			<param name="wmode" value="window" />
			<param name="scale" value="showall" />
			<param name="menu" value="true" />
			<param name="devicefont" value="false" />
			<param name="salign" value="" />
			<param name="allowScriptAccess" value="sameDomain" />
	
			<!--<![endif]-->
	
		<!--[if !IE]>-->
		</object>
	
	<!--<![endif]-->
	</object>
</p>
';	
return '<!--
Plugin: WP-Clippy
Plugin URI: http://shinraholdings.com/plugins/wp-clippy
WordPress plugin for copying input values or strings to the clipboard.
-->
' . $code_script . $code_embed;
}

add_shortcode('clippy', 'wpClippy_draw_button' );
?>