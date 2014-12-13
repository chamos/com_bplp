<?php
defined('_JEXEC') or die;

class BplpViewLivre extends JViewLegacy
{
	protected $item;

	protected $form;

	public function display($tpl = null)
	{
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$canDo		= BplpHelper::getActions($this->item->catid, 0);

		JToolbarHelper::title(JText::_('COM_BPLP_MANAGER_LIVRE'), '');

		if ($canDo->get('core.edit')||(count($user->getAuthorisedCategories('com_bplp', 'core.create'))))
		{
			JToolbarHelper::apply('livre.apply');
			JToolbarHelper::save('livre.save');
		}
		if (count($user->getAuthorisedCategories('com_bplp', 'core.create'))){
			JToolbarHelper::save2new('livre.save2new');
		}
		// If an existing item, can save to a copy.
		if (!$isNew && (count($user->getAuthorisedCategories('com_bplp', 'core.create')) > 0))
		{
			JToolbarHelper::save2copy('livre.save2copy');
		}

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('livre.cancel');
		}
		else
		{
			JToolbarHelper::cancel('livre.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}