<?php

/**
 * @version 3.0 stable $Id: default.php yannick berges
 * @package Joomla
 * @copyright (C) 2018 Berges Yannick - www.com3elles.com
 * @license GNU/GPL v2

 * special thanks to my master Marc Studer
 ** special thanks to Shane for helping

 * JOOMLA admin module by Com3elles is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 **/


//blocage des accés directs sur ce script
\defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\Component\Actionlogs\Administrator\Helper\ActionlogsHelper;
use Joomla\Component\Actionlogs\Administrator\Model\ActionlogsModel;
use Joomla\Module\Quickicon\Administrator\Event\QuickIconsEvent;
use Joomla\Registry\Registry;
use Joomla\Database\ParameterType;

abstract class modDashboardHelper
{

	public static function getItems($data)
	{
		//var_dump($data);die;
		//	recuperation utilisateur connecter	
		$user = JFactory::getUser();
		$userid = $user->id;
		$catids = $data->catidlist;
		$limit = $data->count;
		$nom_statut = $data->TypofBlock;
		// recupere la connexion à la BD
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('a.id', 'a.title', 'a.created', 'a.created_by', 'a.modified', 'a.modified_by', 'a.featured', 'a.state', 'a.catid', 'b.name', 'c.title')))
			->from($db->quoteName('#__content', 'a'))
			->join(
				'LEFT',
				$db->quoteName('#__users', 'b') . 'ON' . $db->quoteName('a.created_by') . '=' . $db->quoteName('b.id')
			) // recup utilisateur
			->join(
				'LEFT',
				$db->quoteName('#__categories', 'c') . 'ON' . $db->quoteName('a.catid') . '=' . $db->quoteName('c.id') // recup categorie
			);
		// ici en fonction du statut
		switch ($nom_statut) {

			case ('fb'):
				$featured = 1;
				$query
					->where($db->quoteName('a.featured') . '= :feature')
					->bind(':feature', $featured, ParameterType::INTEGER);
				break;

			case ('pb'):
				$state = 1;
				$query
					->where($db->quoteName('a.state') . '= :state')
					->bind(':state', $state, ParameterType::INTEGER);
				break;

			case ('upb'):
				$state = 0;
				$query
					->where($db->quoteName('a.state') . '= :state')
					->bind(':state', $state, ParameterType::INTEGER);
				break;

			case ('ab'):
				$state = 2;
				$query
					->where($db->quoteName('a.state') . '= :state')
					->bind(':state', $state, ParameterType::INTEGER);
				break;

			case ('tb'):
				$state = -2;
				$query
					->where($db->quoteName('a.state') . '= :state')
					->bind(':state', $state, ParameterType::INTEGER);
				break;
		}
		//ici la categorie
		if(!empty($catids)){
			$query->whereIn($db->quoteName('a.catid'), $catids, ParameterType::LARGE_OBJECT);
			  }
			//ici order
			$query->order('a.modified DESC')

		//ici la limite
		->setLimit($limit);

		$db->setQuery($query);
		$items = $db->loadObjectList();

		foreach ($items as &$item) {
			$item->link = JRoute::_('index.php?option=com_content&task=article.edit&id=' . $item->id);
		}
		return $items;
	}

	public static function getUseritem(&$params)
	{
		$user = JFactory::getUser();
		$userid = $user->id;
		//recupére la connexion à la BD
		$db = JFactory::getDbo();
		$queryUseritem = 'SELECT id, title, catid, created, created_by, modified, modified_by, state FROM #__content WHERE created_by = ' . $user->id . ' ORDER BY modified DESC LIMIT 50';
		$db->setQuery($queryUseritem);
		$itemsUseritem = $db->loadObjectList();
		foreach ($itemsUseritem as &$itemUseritem) {
			$itemUseritem->link = JRoute::_('index.php?option=com_content&task=article.edit&id=' . $itemUseritem->id);
			switch ($itemUseritem->state) {
				case 0:
					$itemUseritem->state = JText::_('JUNPUBLISHED');
					break;
				case 1:
					$itemUseritem->state = JText::_('JPUBLISHED');
					break;
				case 2:
					$itemUseritem->state = JText::_('JARCHIVED');
					break;
				case -2:
					$itemUseritem->state = JText::_('JTRASHED');
					break;
			}
		}
		return $itemsUseritem;
	}


	public static function getIconFromPlugins(Registry $params, CMSApplication $application = null)
	{
		$key     = (string) $params;
		$context = (string) $params->get('context', 'update_quickicon');
		$application = Factory::getApplication();
		PluginHelper::importPlugin('quickicon');
		$buttons[$key] = [];
		$arrays = (array) $application->triggerEvent(
			'onGetIcons',
			new QuickIconsEvent('onGetIcons', ['context' => $context])
		);

		foreach ($arrays as $response) {
			if (!\is_array($response)) {
				continue;
			}

			foreach ($response as $icon) {
				$default = array(
					'link'    => null,
					'image'   => null,
					'text'    => null,
					'name'    => null,
					'linkadd' => null,
					'access'  => true,
					'class'   => null,
					'group'   => 'MOD_QUICKICON',
				);

				$icon = array_merge($default, $icon);

				if (!\is_null($icon['link']) && !\is_null($icon['text'])) {
					$buttons[$key][] = $icon;
				}
			}
		}

		return $buttons[$key];
	}

	public static function getActionlogList(&$params)
	{

		/** @var ActionlogsModelActionlogs $model */
		$model = new ActionlogsModel(['ignore_request' => true]);

		// Set the Start and Limit
		$model->setState('list.start', 0);
		$model->setState('list.limit', $params->get('count', 5));
		$model->setState('list.ordering', 'a.id');
		$model->setState('list.direction', 'DESC');

		$rows = $model->getItems();

		// Load all actionlog plugins language files
		ActionlogsHelper::loadActionLogPluginsLanguage();

		foreach ($rows as $row) {
			$row->message = ActionlogsHelper::getHumanReadableLogMessage($row);
		}

		return $rows;
	}
}
