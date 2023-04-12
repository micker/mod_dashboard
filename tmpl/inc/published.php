<?php

/**
 * @version 0.5.0 stable $Id: default.php yannick berges
 * @package Joomla
 * @copyright (C) 2018 Berges Yannick - www.com3elles.com
 * @license GNU/GPL v2

 * special thanks to my master Marc Studer

 * JOOMLA Admin module by Com3elles is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 **/

//blocage des accés directs sur ce script
defined('_JEXEC') or die('Accés interdit');

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\Registry\Registry;
use Joomla\CMS\Helper\ModuleHelper;

$displayData = $displayData ?? [];
$blockdwidth = $displayData['blockwidth'];
$forceheightblock = $displayData['forceheightblock'];
$module_id = $displayData['module_id'];
$module_title = $displayData['module_title'];
$listPublished = $displayData['listPublished'];
//var_dump ($listFeatured);

$document = JFactory::getDocument();
$app       = JFactory::getApplication();
$user      = JFactory::getUser();
$userId    = $user->get('id');

?>

<div class="block published card" style="width:<?php echo $blockdwidth; ?>%">
    <div class="card-header">

        <?php $show_all_link = 'index.php?option=com_content&amp;view=articles&amp;filter[published]=1'; ?>
        <div class="module-actions">
            <a href='<?php echo $show_all_link ?>' class='adminlink'>
                <?php
                echo Text::_('MOD_DASHBOARD_ALL');
                echo "</a></div>";    ?>
                <h3 class="module-title "><i class="fa fa-check"></i>
                    <?php echo Text::_('MOD_DASHBOARD_PUBLISHED'); ?></h3>


        </div>
        <div class="card-body" style="height:<?php echo $forceheightblock; ?>">

            <table class="table" id="<?php echo str_replace(' ', '', $module_title) . $module_id; ?>">
                <thead>
                    <tr>
                        <th scope="col" class="w-40"><?php echo Text::_('JGLOBAL_TITLE'); ?></th>
                        <th scope="col" class="w-20"><?php echo Text::_('JAUTHOR'); ?></th>
                        <th scope="col" class="w-20"><?php echo Text::_('JDATE'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listPublished as $itemPublished) :
                        $canEdit    = $user->authorise('core.edit',       'com_content.article.' . $itemPublished->id);
                        $canCheckin = $user->authorise('core.manage',     'com_checkin') || $itemPublished->checked_out == $userId || $itemPublished->checked_out == 0;
                        $canEditOwn = $user->authorise('core.edit.own',   'com_content.article.' . $itemPublished->id) && $itemPublished->created_by == $userId;
                        $canChange  = $user->authorise('core.edit.state', 'com_content.article.' . $itemPublished->id) && $canCheckin;
                        if ($canChange) :
                    ?>
                            <tr>
                                <td>
                                    <a href="<?php echo $itemPublished->link; ?>"><?php echo $itemPublished->title; ?>
                                        <i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <span class="small">
                                        <i class="fa fa-user"></i>
                                        <?php echo $itemPublished->name; ?>
                                        </small>
                                    </span>
                                </td>
                                <td>
                                    <span class="small">
                                        <i class="fas fa-calendar"></i>
                                        <?php echo JHtml::date($itemPublished->modified, 'd M Y'); ?>
                                    </span>
                                </td>

                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>