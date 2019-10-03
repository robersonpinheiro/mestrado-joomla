<?php
defined('_JEXEC') or die;

class CoringaRouter extends JComponentRouterBase
{
	/**
	 * Build the route for the com_wrapper component
	 *
	 * @param   array  &$query  An array of URL arguments
	 *
	 * @return  array  The URL arguments to use to assemble the subsequent URL.
	 *
	 * @since   3.3
	 */
	public function build(&$query)
	{
		if (isset($query['view']))
		{
			unset($query['view']);
		}

		return array();
	}

	/**
	 * Parse the segments of a URL.
	 *
	 * @param   array  &$segments  The segments of the URL to parse.
	 *
	 * @return  array  The URL attributes to be used by the application.
	 *
	 * @since   3.3
	 */
	public function parse(&$segments)
	{

		$app = JFactory::getApplication();
		$menu = $app->getMenu()->getActive();
		return array('view' => $menu->query['view']);
	}
}

/**
 * Wrapper router functions
 *
 * These functions are proxys for the new router interface
 * for old SEF extensions.
 *
 * @param   array  &$query  An array of URL arguments
 *
 * @return  array  The URL arguments to use to assemble the subsequent URL.
 *
 * @deprecated  4.0  Use Class based routers instead
 */
function CoringaBuildRoute(&$query)
{
	$router = new CoringaRouter;

	return $router->build($query);
}

/**
 * Wrapper router functions
 *
 * These functions are proxys for the new router interface
 * for old SEF extensions.
 *
 * @param   array  $segments  The segments of the URL to parse.
 *
 * @return  array  The URL attributes to be used by the application.
 *
 * @deprecated  4.0  Use Class based routers instead
 */
function CoringaParseRoute($segments)
{
	$router = new CoringaRouter;

	return $router->parse($segments);
}
