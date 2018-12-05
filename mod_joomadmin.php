<?php
/**
* @version 0.9.2 stable $Id: default.php yannick berges
* @package Joomla
* @subpackage FLEXIcontent
* @copyright (C) 2017 Berges Yannick - www.com3elles.com
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
jimport( 'joomla.application.component.controller' );
JLoader::register('ModLatestActionsHelper', __DIR__ . '/helper.php');

// Inclut les méthodes du script de soutien
require_once dirname(__FILE__).'/helper.php';
$listFeatured     = modJoomadminHelper::getFeatured($params);
$listPublished    = modJoomadminHelper::getPublished($params);
$listUnpublished  = modJoomadminHelper::getUnpublished($params);
$listArchived     = modJoomadminHelper::getArchived($params);
$listTrashed      = modJoomadminHelper::getTrashed($params);
$listUseritem     = modJoomadminHelper::getUseritem($params);
$listCustomlist   = modJoomadminHelper::getCustomlist($params);
$moduleclass_sfx  = htmlspecialchars($params->get('moduleclass_sfx'));
$systme_buttons   = modJoomadminHelper::getIconFromPlugins($params);
$actionlist       = modJoomadminHelper::getActionlogList($params);

// Get Joomla Layout
require JModuleHelper::getLayoutPath('mod_joomadmin', $params->get('layout', 'default'));
