<?php
defined('_JEXEC') or die;

$controller = JControllerLegacy::getInstance('menuJson');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
