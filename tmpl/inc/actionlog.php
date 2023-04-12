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
$blockwidth = $displayData['blockwidth'];
$forceheightblock = $displayData['forceheightblock'];
$module_id = $displayData['module_id'];
$module_title = $displayData['module_title'];
$actionlist = $displayData['actionlist'];
//var_dump ($listFeatured);

$document = JFactory::getDocument();
$app       = JFactory::getApplication();
$user      = JFactory::getUser();
$userId    = $user->get('id');

?>
<div class="block actionlog card" style="width:<?php echo $blockwidth; ?>%">
									<div class="card-header">
										<div class="module-actions"> <?php $show_all_link = 'index.php?option=com_actionlogs'; ?>
											<a href='<?php echo $show_all_link ?>' class='adminlink'>
												<?php
												echo Text::_('MOD_DASHBOARD_ALL');
												echo "</a></div>";	?>
												<h3 class="module-title ">
													<i class="fa fa-list-alt"></i>
													<?php echo Text::_('MOD_DASHBOARD_ACTIONLOGS_BLOCK_NAME'); ?> :
												</h3>
										</div>
										<div class="card-body" style="height:<?php echo $forceheightblock; ?>">


											<?php if (count($actionlist)) : ?>
												<table class="table">
													<thead>
														<tr>
															<th scope="col" class="w-80"><?php echo Text::_('MOD_LATESTACTIONS_ACTION'); ?></th>
															<th scope="col" class="w-20"><?php echo Text::_('JDATE'); ?></th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($actionlist as $i => $item) : ?>
															<tr>
																<td>
																	<?php echo $item->message; ?>
																</td>
																<td>
																	<div class="small">
																		<span class="fas fa-calendar" aria-hidden="true"></span>
																		<?php echo JHtml::_('date', $item->log_date, Text::_('DATE_FORMAT_LC5')); ?>
																	</div>
																</td>
															</tr>

														<?php endforeach; ?>
													</tbody>
												</table>
											<?php else : ?>
												<div class="row-fluid">
													<div class="span12">
														<div class="alert">
															<?php echo Text::_('MOD_LATEST_ACTIONS_NO_MATCHING_RESULTS'); ?>
														</div>
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>