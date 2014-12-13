<?php
defined('_JEXEC') or die;

class BplpController extends JControllerLegacy
{
	protected $default_view = 'livres';

	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/bplp.php';

		$view   = $this->input->get('view', 'livres');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');

		if ($view == 'livre' && $layout == 'edit' && !$this->checkEditId('com_bplp.edit.livre', $id))
		{
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_bplp&view=livres', false));

			return false;
		}

		parent::display();

		return $this;
	}
}