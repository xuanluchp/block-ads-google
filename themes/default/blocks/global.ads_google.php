<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 04 May 2014 12:41:32 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_menu_theme_ads_google' ) )
{
	function nv_menu_theme_ads_google_config( $module, $data_block, $lang_block )
	{
		$html = '<tr>';
		$html .= '	<td>ID nhà xuất bản</td>';
		$html .= '	<td><input type="text" name="config_data_ad_client" class="form-control" value="' . $data_block['data_ad_client'] . '"/></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '	<td>Tên quảng cáo google</td>';
		$html .= '	<td><input type="text" name="config_name" class="form-control" value="' . $data_block['name'] . '"/></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '	<td>Chiều rộng quảng cáo</td>';
		$html .= '	<td><input type="text" name="config_width" class="form-control" value="' . $data_block['width'] . '"/></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '	<td>Chiều cao quảng cáo</td>';
		$html .= '	<td><input type="text" name="config_height" class="form-control" value="' . $data_block['height'] . '"/></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '	<td>ID Quảng cáo</td>';
		$html .= '	<td><input type="text" name="config_data_ad_slot" class="form-control" value="' . $data_block['data_ad_slot'] . '"/></td>';
		$html .= '</tr>';
		return $html;
	}

	function nv_menu_theme_ads_google_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array();
		$return['error'] = array();
		$return['config']['data_ad_client'] = $nv_Request->get_title( 'config_data_ad_client', 'post' );
		$return['config']['name'] = $nv_Request->get_title( 'config_name', 'post' );
		$return['config']['width'] = $nv_Request->get_title( 'config_width', 'post' );
		$return['config']['height'] = $nv_Request->get_title( 'config_height', 'post' );
		$return['config']['data_ad_slot'] = $nv_Request->get_title( 'config_data_ad_slot', 'post' );
		return $return;
	}

	function nv_menu_theme_ads_google( $block_config )
	{
		global $global_config, $site_mods;

		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.ads_google.tpl' ) )
		{
			$block_theme = $global_config['module_theme'];
		}
		elseif( file_exists( NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.ads_google.tpl' ) )
		{
			$block_theme = $global_config['site_theme'];
		}
		else
		{
			$block_theme = 'default';
		}

		$xtpl = new XTemplate( 'global.ads_google.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks' );
		$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
		$xtpl->assign( 'BLOCK_THEME', $block_theme );
		$xtpl->assign( 'DATA', $block_config );
		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	}
}

if( defined( 'NV_SYSTEM' ) )
{
	$content = nv_menu_theme_ads_google( $block_config );
}