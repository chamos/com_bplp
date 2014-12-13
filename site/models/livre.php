<?php
defined('_JEXEC') or die;

class BplpModelLivre extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'state', 'a.state',
				'company', 'a.company',
				'image', 'a.image',
				'url', 'a.url',
				'editeur', 'a.editeur',
				'description', 'a.description',
				'ordering', 'a.ordering', 'a.catid'
			);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		$id = JRequest::getInt('id');
		$this->setState('id', $id);
	}

	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		$query->select(
			$this->getState(
				'list.select',
				'a.* '
			)
		);
		$query->from($db->quoteName('#__livre').' AS a');

		$query->where('(a.state IN (0, 1))');

		if ($id = $this->getState('id'))
		{
			$query->where('a.id = '.(int) $id);
		}

		return $query;
	}
}