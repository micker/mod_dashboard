<?php
/**
* @version 0.5.0 stable $Id: default.php yannick berges
* @package Joomla
* @copyright (C) 2018 Berges Yannick - www.com3elles.com
* @license GNU/GPL v2

* special thanks to my master Marc Studer

* JOOMLA admin module by Com3elles is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
**/

/*namespace Joomla\Module\Dashboard\Administrator\helper;*/

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

abstract class modDashboardHelper
{
	public static function getFeatured(&$params)
	{
		// recupere la connexion à la BD
		$db = JFactory::getDbo();
		$queryFeatured = 'SELECT a.id, a.title, b.name , a.catid, a.created, a.created_by, a.modified, a.modified_by, a.featured FROM #__content  AS a LEFT JOIN #__users AS b ON a.created_by = b.id WHERE featured = 1 ORDER BY modified DESC LIMIT '. (int) $params->get('count');
		$db->setQuery( $queryFeatured );
		$itemsFeatured = $db->loadObjectList();
		//print_r ($itemsRevised) ;
		foreach ($itemsFeatured as &$itemFeatured) {
			$itemFeatured->link = JRoute::_('index.php?option=com_content&task=article.edit&id='.$itemFeatured->id);
		}
		return $itemsFeatured;
	}
	public static function getPublished(&$params)
	{
		// recupere la connexion à la BD
		$db = JFactory::getDbo();
		$queryPublished = 'SELECT a.id,b.name, a.title, a.catid, a.created, a.created_by, a.modified, a.modified_by FROM #__content AS a LEFT JOIN #__users AS b ON a.created_by = b.id WHERE state = 1 ORDER BY modified DESC LIMIT '. (int) $params->get('count');
		$db->setQuery( $queryPublished );
		$itemsPublished = $db->loadObjectList();
		foreach ($itemsPublished as &$itemPublished) {
			$itemPublished->link = JRoute::_('index.php?option=com_content&task=article.edit&id='.$itemPublished->id);
		}
		return $itemsPublished;
	}
	public static function getUnpublished(&$params)
	{
		// recupere la connexion à la BD
		$db = JFactory::getDbo();
		$queryUnpublished = 'SELECT a.id,b.name, a.title, a.catid, a.created, a.created_by, a.modified, a.modified_by FROM #__content AS a LEFT JOIN #__users AS b ON a.created_by = b.id WHERE state = 0 ORDER BY modified DESC LIMIT '. (int) $params->get('count');
		$db->setQuery( $queryUnpublished );
		$itemsUnpublished = $db->loadObjectList();
		foreach ($itemsUnpublished as &$itemUnpublished) {
			$itemUnpublished->link = JRoute::_('index.php?option=com_content&task=article.edit&id='.$itemUnpublished->id);
		}
		return $itemsUnpublished;
	}
	public static function getArchived(&$params)
	{
		// recupere la connexion à la BD
		$db = JFactory::getDbo();
		$queryArchived = 'SELECT a.id,b.name, a.title, a.catid, a.created, a.created_by, a.modified, a.modified_by FROM #__content AS a LEFT JOIN #__users AS b ON a.created_by = b.id WHERE state = 2 ORDER BY modified DESC LIMIT '. (int) $params->get('count');
		$db->setQuery( $queryArchived );
		$itemsArchived = $db->loadObjectList();
		foreach ($itemsArchived as &$itemArchived) {
			$itemArchived->link = JRoute::_('index.php?option=com_flexicontent&task=article.edit&id='.$itemArchived->id);
	}
		return $itemsArchived;
	}
	public static function getTrashed(&$params)
	{
		// recupere la connexion à la BD
		$db = JFactory::getDbo();
		$queryTrashed = 'SELECT a.id,b.name, a.title, a.catid, a.created, a.created_by, a.modified, a.modified_by FROM #__content AS a LEFT JOIN #__users AS b ON a.created_by = b.id WHERE state = -2 ORDER BY modified DESC LIMIT '. (int) $params->get('count');
		$db->setQuery( $queryTrashed );
		$itemsTrashed = $db->loadObjectList();
		foreach ($itemsTrashed as &$itemTrashed) {
			$itemTrashed->link = JRoute::_('index.php?option=com_content&task=article.edit&id='.$itemTrashed->id);
		}
		return $itemsTrashed;
	}
	public static function getUseritem(&$params)
	{
		$user = JFactory::getUser();
		$userid = $user->id;
		//recupére la connexion à la BD
		$db = JFactory::getDbo();
		$queryUseritem = 'SELECT id, title, catid, created, created_by, modified, modified_by, state FROM #__content WHERE created_by = '.$user->id.' ORDER BY modified DESC LIMIT '. (int) $params->get('count');
		$db->setQuery( $queryUseritem );
		$itemsUseritem = $db->loadObjectList();
		foreach ($itemsUseritem as &$itemUseritem) {
			$itemUseritem->link = JRoute::_('index.php?option=com_content&task=article.edit&id='.$itemUseritem->id);
			switch ($itemUseritem->state){
				case 0:
					$itemUseritem->state=JText::_('JUNPUBLISHED');
				break;
				case 1:
					$itemUseritem->state=JText::_('JPUBLISHED');
				break;
				case 2:
					$itemUseritem->state=JText::_('JARCHIVED');
				break;
				case -2:
					$itemUseritem->state=JText::_('JTRASHED');
				break;
			}
		}
		return $itemsUseritem;
	}
	public static function getCustomlist(&$params)
	{
		$list_customblocks = $params->get('add_customblock');
		if ($list_customblocks){
		$db = JFactory::getDbo();
		// loop your result
		foreach( $list_customblocks as $list_customblocks_idx => $customblock ){
        		//$catid = $customblock->catidlist;
			$queryCustomlist = 'SELECT a.id, a.title, b.name , a.catid, a.created, a.created_by, a.modified, a.modified_by, a.featured FROM #__content  AS a LEFT JOIN #__users AS b ON a.created_by = b.id WHERE catid= '. $customblock->catidlist .' AND state = 1 ORDER BY modified DESC LIMIT '. (int) $params->get('count');
			$db->setQuery( $queryCustomlist );
			$itemsCustomlist = $db->loadObjectList();
			foreach ($itemsCustomlist as &$itemCustomlist) {
					$itemCustomlist->link = JRoute::_('index.php?option=com_content&task=article.edit&id='.$itemCustomlist->id);
			}
			$customblock->listitems = $itemsCustomlist;
		}
	}
		return $list_customblocks;
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

			foreach ($arrays as $response)
			{
				if (!\is_array($response))
				{
					continue;
				}

				foreach ($response as $icon)
				{
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

					if (!\is_null($icon['link']) && !\is_null($icon['text']))
					{
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

		foreach ($rows as $row)
		{
			$row->message = ActionlogsHelper::getHumanReadableLogMessage($row);
		}

		return $rows;
	} 


}
