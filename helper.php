<?php
/**
* @version 0.9.3 stable $Id: default.php yannick berges
* @package Joomla
* @subpackage FLEXIcontent
* @copyright (C) 2015 Berges Yannick - www.com3elles.com
* @license GNU/GPL v2

* special thanks to ggppdk and emmanuel dannan for flexicontent
* special thanks to my master Marc Studer

* FLEXIadmin module is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
**/

//blocage des accés directs sur ce script
defined('_JEXEC') or die('Accés interdit');
abstract class modJoomadminHelper
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
					$itemUseritem->state=JText::_('FLEXI_UNPUBLISHED');
				break;
				case 1:
					$itemUseritem->state=JText::_('FLEXI_PUBLISHED');
				break;
				case 2:
					$itemUseritem->state=JText::_('FLEXI_ARCHIVED');
				break;
				case -2:
					$itemUseritem->state=JText::_('FLEXI_TRASHED');
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
		global $globalcats;
		// loop your result
		foreach( $list_customblocks as $list_customblocks_idx => $customblock ){
        		$_catid = $customblock->catidlist;
        		$catlist = !empty($globalcats[$_catid]->descendants) ? $globalcats[$_catid]->descendants : $_catid;
        		$catids_join = ' JOIN #__flexicontent_cats_item_relations AS rel ON rel.itemid = a.id ';
       			$catids_where = ' rel.catid IN ('.$catlist.') ';
			$queryCustomlist = 'SELECT DISTINCT  a.id,b.name, a.title, a.catid, a.created, a.created_by, a.modified, a.modified_by FROM #__content AS a LEFT JOIN #__users AS b ON a.created_by = b.id '.$catids_join.'WHERE '.  $catids_where.' AND state = 1 ORDER BY modified DESC LIMIT '. (int) $params->get('count');
			$db->setQuery( $queryCustomlist );
			$itemsCustomlist = $db->loadObjectList();
			//print_r ($itemsCustomlist) ;
			foreach ($itemsCustomlist as &$itemCustomlist) {
				$itemCustomlist->link = JRoute::_('index.php?option=com_content&task=article.edit&id='.$itemCustomlist->id);
			}
			$customblock->listitems = $itemCustomlist;
		}
	}
		return $list_customblocks;
	}
	/**
	 * getIconFromPlugins
	 *
	 * @param \JRegistry $params
	 *
	 * @return  array
	 */
	public static function getIconFromPlugins($params)
	{
		// Include buttons defined by published quickicon plugins
		//$keys = array_keys($buttons);
		JPluginHelper::importPlugin('quickicon');
		$app    = JFactory::getApplication();
		$arrays = (array) $app->triggerEvent('onGetIcons', array('mod_quickicon'));
		// Extensions plugin image map
		foreach ($arrays as $response)
		{
			foreach ($response as $icon)
			{
				$default = array(
					'link'   => null,
					'text'   => null,
					'image'  => 'joomla',
					'access' => true,
					'class'  => 'ak-icon-item'
				);
				$icon = array_merge($default, $icon);
				if (!is_null($icon['link']) && !is_null($icon['text']))
				{
					$icon['icon_class'] = 'icon-' . $icon['image'];
					unset($icon['image']);
					// Set params
					if (isset($icon['params']))
					{
						$icon['params'] = ($icon['params'] instanceof JRegistry) ? $icon['params'] : new JRegistry();
					}
					else
					{
						$icon['params'] = new JRegistry;
					}
					if (!isset ($keys[0]))
					{
						$keys[0] = null;
					}
					if (!isset ($buttons[$keys[0]]))
					{
						$buttons[$keys[0]] = array();
					}
					$systme_buttons[$keys[0]][] = $icon;
				}
			}
		}
		return $systme_buttons;
	}
	public static function getActionlogList(&$params)
	{
		JLoader::register('ActionlogsModelActionlogs', JPATH_ADMINISTRATOR . '/components/com_actionlogs/models/actionlogs.php');
		JLoader::register('ActionlogsHelper', JPATH_ADMINISTRATOR . '/components/com_actionlogs/helpers/actionlogs.php');

		/* @var ActionlogsModelActionlogs $model */
		$model = JModelLegacy::getInstance('Actionlogs', 'ActionlogsModel', array('ignore_request' => true));

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
