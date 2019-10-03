<?php
defined('_JEXEC') or die;

/**
 * Wrapper view class.
 * 
 * @since  1.5
 */
class MenuJsonViewMenu extends JViewLegacy
{
	public function display($tpl = null)
	{		
		$menus = $this->get('Menus');

		echo json_encode($menus);
	}
}
