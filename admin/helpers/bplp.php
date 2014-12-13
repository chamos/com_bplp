<?php
defined('_JEXEC') or die;

class BplpHelper
{
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId))
		{
			$assetName = 'com_bplp';
			$level = 'component';
		}
		else
		{
			$assetName = 'com_bplp.category.'.(int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_bplp', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}

	public static function addSubmenu($vName = 'livres')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_BPLP_SUBMENU_LIVRES'),
			'index.php?option=com_bplp&view=livres',
			$vName == 'livres'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_BPLP_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_bplp',
			$vName == 'categories'
		);
		if ($vName == 'categories')
		{
			JToolbarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_bplp')),
				'bplps-categories');
		}
		JHtmlSidebar::addEntry(
			JText::_('COM_BPLP_SUBMENU_PREVIEW'),
			'index.php?option=com_bplp&view=preview',
			$vName == 'preview'
		);
	}
}