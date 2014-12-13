<?php
defined('_JEXEC') or die;

class BplpControllerPreview extends JControllerAdmin
{
	public function getModel($name = 'Preview', $prefix = 'BplpModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}