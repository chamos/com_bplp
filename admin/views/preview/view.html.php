<?php
defined('_JEXEC') or die;

class BplpViewPreview extends JViewLegacy
{
	protected $items;

	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');

		BplpHelper::addSubmenu('preview');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();

		$j3css = <<<ENDCSS
div#toolbar div#toolbar-back button.btn span.icon-back::before {
	content: "";
}
.bplp_title{
	color: #555555;
	font-family: 'Titillium Maps',Arial;
	font-size: 14pt;
}
.mybplp{
	padding-bottom: 20px;
	float: left;
	padding-right: 20px;
}
.bplp_element{
	width: 150px;
	padding-top: 2px;
}
ENDCSS;
		JFactory::getDocument()->addStyleDeclaration($j3css);

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		$state	= $this->get('State');
		$canDo	= BplpHelper::getActions();
		$bar = JToolBar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_BPLP_MANAGER_LIVRES'), '');

		JToolbarHelper::back('COM_bplp_BUTTON_BACK', 'index.php?option=com_bplp');

	}

}