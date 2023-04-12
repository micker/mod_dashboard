<?php

/**
 * @version 3 stable $Id: default.php yannick berges
 * @package Joomla
 * @copyright (C) 2018 Berges Yannick - www.com3elles.com
 * @license GNU/GPL v2

 * special thanks to my master Marc Studer
 * special thanks to Shane for helping

 * Joomla admin module by Com3elles is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 **/

//blocage des accés directs sur ce script
defined('_JEXEC') or die('Accés interdit');
jimport('joomla.application.component.controller');
JLoader::register('ModLatestActionsHelper', __DIR__ . '/helper.php');

// Inclut les méthodes du script de soutien
require_once dirname(__FILE__) . '/helper.php';
//$listFeatured     = modDashboardHelper::getFeatured($params);
//$listPublished    = modDashboardHelper::getPublished($params);
//$listUnpublished  = modDashboardHelper::getUnpublished($params);
//$listArchived     = modDashboardHelper::getArchived($params);
//$listTrashed      = modDashboardHelper::getTrashed($params);
//$listUseritem     = modDashboardHelper::getUseritem($params);

foreach ($params->get('add_customblock') as $customBlock) {
    $items = modDashboardHelper::getItems($customBlock) ?? [];

    $customBlock->items = $items;
    // var_dump($customBlock);
}


//$listCustomlist   = modDashboardHelper::getCustomlist($params);
//$moduleclass_sfx  = htmlspecialchars($params->get('moduleclass_sfx'));
$systme_buttons   = modDashboardHelper::getIconFromPlugins($params);
$actionlist       = modDashboardHelper::getActionlogList($params);

// Get Joomla Layout
require JModuleHelper::getLayoutPath('mod_dashboard', $params->get('layout', 'default'));
