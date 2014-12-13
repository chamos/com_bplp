<?php
defined('_JEXEC') or die;

class BplpViewLivres extends JViewLegacy
{
	protected $items;

	protected $state;

	protected $pagination;

	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->state		= $this->get('State');
		$this->pagination	= $this->get('Pagination');

		BplpHelper::addSubmenu('livres');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		$state	= $this->get('State');

		$canDo	= BplpHelper::getActions($state->get('filter.category_id'));

		$user	= JFactory::getUser();
		$bar = JToolBar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_BPLP_MANAGER_LIVRES'), '');

		if (count($user->getAuthorisedCategories('com_bplp', 'core.create')) > 0)
		{
			JToolbarHelper::addNew('livre.add');
		}

		if ($canDo->get('core.edit'))
		{
			JToolbarHelper::editList('livre.edit');
		}
		if ($canDo->get('core.edit.state')) {

			JToolbarHelper::publish('livres.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('livres.unpublish', 'JTOOLBAR_UNPUBLISH', true);

			JToolbarHelper::archiveList('livres.archive');
			JToolbarHelper::checkin('livres.checkin');
		}
		$state	= $this->get('State');
		if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'livres.delete', 'JTOOLBAR_EMPTY_TRASH');
		} elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('livres.trash');
		}
		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_bplp');
		}

		JHtmlSidebar::setAction('index.php?option=com_bplp&view=livres');

		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_state',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
		);
	}

	protected function getSortFields()
	{
		return array(
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.state' => JText::_('JSTATUS'),
			'a.title' => JText::_('JGLOBAL_TITLE'),
			'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}
}