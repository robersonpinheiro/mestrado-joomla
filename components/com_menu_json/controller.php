<?php

defined('_JEXEC') or die;

/**
 * Content Component Controller
 *
 * @since  1.5
 */
class menuJsonController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JControllerLegacy  This object to support chaining.
	 *
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = array())
	{
		$cachable = true;

		// Set the default view name and format from the Request.
		$vName = $this->input->get('view', 'menu');

		$this->input->set('view', $vName);

		return parent::display($cachable, array('Itemid' => 'INT'));
	}
}
