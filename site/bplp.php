<?php
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$cssFile = "./media/com_bplp/css/site.stylesheet.css";
$document->addStyleSheet($cssFile);

$controller	= JControllerLegacy::getInstance('Bplp');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();