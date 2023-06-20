<?php

/**
 * @version 3 stable $Id: default.php yannick berges
 * @package Joomla
 * @copyright (C) 2018 Berges Yannick - www.com3elles.com
 * @license GNU/GPL v2

 * special thanks to my master Marc Studer
 * special thanks to Shane for helping

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

define('DS', DIRECTORY_SEPARATOR);
const BASE_PATH_SITE = JPATH_ADMINISTRATOR . DS . 'modules' . DS . 'mod_dashboard';

$document = JFactory::getDocument();
$app       = JFactory::getApplication();
$user      = JFactory::getUser();
$userId    = $user->get('id');



$wa = \Joomla\CMS\Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerStyle('mod_dashboard.style', 'media/mod_dashboard/css/style.css');
$wa->registerStyle('mod_dashboard.style', 'media/mod_dashboard/css/font-awesome.min.css');
$wa->useStyle('mod_dashboard.style');



$force_fullwidth     = $params->get('force_fullwidth', '1');

if ($force_fullwidth) {
	$style = ".card-columns {
		grid-template-columns: 1fr !important;
	}";
	$document->addStyleDeclaration($style);
}

//module config
$displaycustomtab    = $params->get('displaycustomtab', '1');
$displaycreattab     = $params->get('displaycreattab', '1');
$displaymanagetab    = $params->get('displaymanagetab', '1');
$displayadmintab     = $params->get('displayadmintab', '1');
$displayfreetab      = $params->get('displayfreetab', '1');
$displayconfigmodule = $params->get('displayconfigmodule', '1');
$forceheightblock    = $params->get('forceheightblock', '');
$displaycustomtext   = $params->get('displaycustomtext', '');
$customtext          = $params->get('customtext', '');
$displayinfosystem   = $params->get('displayinfosystem', '1');
$iconsize     = $params->get('iconsize', 'fa-2x');
$moduleclass_sfx = $params->get('moduleclass_sfx');

$blockwidth = '45';


//customtab
$nametab = $params->get('nametab', 'MOD_DASHBOARD_CUSTOM_TAB_NAME');

//Get Buttom Sections
$hiddebuttonmanageitems      = $params->get('hiddebuttonmanageitems', '1');
$hiddebuttonmanagecategories = $params->get('hiddebuttonmanagecategories', '1');
$hiddebuttonmanagetags       = $params->get('hiddebuttonmanagetags', '1');
$hiddebuttonmanageauthors    = $params->get('hiddebuttonmanageauthors', '1');
$hiddebuttonmanagegroups     = $params->get('hiddebuttonmanagegroups', '1');
$hiddebuttonmanagefiles      = $params->get('hiddebuttonmanagefiles', '1');
$hiddebuttonprivacy         = $params->get('hiddebuttonprivacy', '1');
$hiddebuttonlogs            = $params->get('hiddebuttonlogs', '1');
$hiddebuttonmanagefieldsarticle            = $params->get('hiddebuttonmanagefieldsarticle', '1');
$hiddebuttonmanagefieldsuser           = $params->get('hiddebuttonmanagefieldsusers', '1');
$hiddebuttonadditem          = $params->get('hiddebuttonadditem', '1');
$hiddebuttonaddcategory      = $params->get('hiddebuttonaddcategory', '1');
$hiddebuttonaddtag           = $params->get('hiddebuttonaddtag', '1');
$hiddebuttonadduser          = $params->get('hiddebuttonadduser', '1');
$hiddebuttonaddgroup         = $params->get('hiddebuttonaddgroup', '1');
$hiddebuttonadmin        = $params->get('hiddebuttonadmin', '1');

$displayauthoronly           = $params->get('displayauthoronly', '0');

//freetab
$freenametab = $params->get('freenametab', 'MOD_DASHBOARD_FREE_TAB_NAME');

//Analytics tab
$displayanalytics      = $params->get('displayanalytics');
$analytics_url = $params->get('analytics_site_url');
$analytics_siteid =  $params->get('analytics_siteid');
$analytics_period = $params->get('analytics_period', 'week');
$analytics_date = $params->get('analytics_date', 'yesterday');
$analytics_height = $params->get('analytics_height', '500');
$analytics_tab_name = $params->get('analytics_tab_name', 'MOD_DASHBOARD_TAB_ANALYTICS');
$analytics_button_name = $params->get('analytics_button', 'MOD_DASHBOARD_LINK_ANALYTICS');
$analytics_token_auth = $params->get('analytics_site_token_auth', '');
$analytics_use_token_auth = $params->get('analytics_use_token', '0');

//
$user = JFactory::getUser();


jimport('joomla.application.component.controller');
?>


<div class="row-fluid <?php echo $moduleclass_sfx; ?>">
	<div class="headerblock">

		<?php if ($displayinfosystem && $displayconfigmodule) : ?>
			<div class="info-bar top list-group-item">
				<ul class="breadcrumb">
					<?php if ($displayinfosystem) : ?>
						<?php foreach ($systme_buttons as $sys_buttons) : ?>
							<li id="<?php echo $sys_buttons['id']; ?>" class="">
								<a href="<?php echo $sys_buttons['link']; ?>">
									<span class="<?php echo $sys_buttons['image']; ?>" aria-hidden="true"></span> <span class="j-links-link"><?php echo $sys_buttons['text']; ?></span>
								</a>
								<span class="divider"> | </span>
							</li>
							<?php // endforeach; 
							?>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		<?php endif; ?>

		<?php if ($displaycustomtext) : ?>
			<div class="modulemessage">
				<?php echo $customtext; ?>
			</div>
		<?php endif; ?>



		<?php if ($displaycustomtab || $displaycreattab || $displaymanagetab || $displayadmintab || $displayfreetab || $displayanalytics) : ?>
			<div class="action">

				<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'general')); ?>
				<?php if ($displaycustomtab) : ?>
					<?php //echo HTMLHelper::_('uitab.addTab', 'myTab', 'custom', Text::_($nametab)); 
					?>
					<?php
					$list_freebuttons = $params->get('free_tab');
					if ($list_freebuttons) : ?>
						<?php foreach ($list_freebuttons as $list_freebuttons_idx => $free_tab) : ?>
							<?php $tabname = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/', '', $free_tab->freenametab)); ?>
							<?php echo HTMLHelper::_('uitab.addTab', 'myTab', $tabname, Text::_($free_tab->freenametab)); ?>
							<div class="row">
								<div class="col-lg-12">
									<nav class="quick-icons dashboard" aria-label="Quick links creation">
										<ul class="nav flex-wrap">
											<?php foreach ($free_tab->free_button as $free_button_idx => $free_button) : ?>
												<li class="quickicon quickicon-single col <?php echo $free_button->displayline ? 'newlinegrid' : ''; ?>">
													<!-- ici boucle de calcul des liens -->
													<?php if ($free_button->displayauthoronly == 1) {
														$filter_byauthor = '&amp;filter[author_id]=' . $user->id;
													} else {
														$filter_byauthor = '';
													}
													?>
													<?php
													switch ($free_button->displayButtonTypeOption) {
														case 1: //add item
															$url_button = "index.php?option=com_content&view=article&layout=edit&catid=$free_button->catid&language=$free_button->button_lang";
															break;
														case 2: //edit item
															$url_button = "index.php?option=com_content&task=article.edit&id=$free_button->itemid";
															break;
														case 3: //cat link
															$url_button = "index.php?option=com_content&view=articles&filter[category_id]=$free_button->catidlist&filter[language]=$free_button->button_lang $filter_byauthor";
															break;
														case 4: //custom link
															$url_button = $free_button->linkbutton;
															break;
													}
													?>
													<a href="<?php echo $url_button; ?>" target="<?php echo $free_button->targetlink; ?>" class="align-items-center">
														<div class="quickicon-icon d-flex align-items-center big">
															<i class="fa 
						<?php if (!empty($free_button->iconbutton)) {
													echo $free_button->iconbutton;
												} else {
													echo 'fa-edit';
												}
						?> <?php echo $iconsize; ?>  
								" <?php if (!empty($free_button->coloricon)) {
													echo 'style="color:' . $free_button->coloricon . ';"';
												} else {
												}
									?>>
															</i>
														</div>
														<div class="quickicon-name d-flex align-items-center">
															<?php echo Text::_($free_button->button_name); ?>
														</div>
													</a>
												</li>

											<?php endforeach; ?>
										</ul>
									</nav>
								</div>
							</div>
							<?php echo HTMLHelper::_('uitab.endTab'); ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<?php //echo HTMLHelper::_('uitab.endTab'); 
					?>
				<?php endif; ?>
				<?php if ($displaycreattab) : ?>
					<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'create', Text::_('MOD_DASHBOARD_TAB_CREATE_D')); ?>
					<div class="row">
						<div class="col-lg-12">
							<nav class="quick-icons dashboard" aria-label="Quick links creation">
								<ul class="nav flex-wrap">
									<?php if ($hiddebuttonadditem) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_content&task=article.add" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-plus-circle <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_ADDITEM'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonaddcategory) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_categories&task=category.add&extension=com_content" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-folder-open <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_ADDCATEGORY'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonaddtag) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_tags&view=tag&task=tag.add" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-tags <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_ADDTAG'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonadduser) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_users&task=user.add" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-user <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_ADDAUTHOR'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonaddgroup) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_users&task=group.add" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-users <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_ADDGROUPS'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
								</ul>
							</nav>
						</div>
					</div>
					<?php echo HTMLHelper::_('uitab.endTab'); ?>
				<?php endif; ?>

				<?php if ($displaymanagetab) : ?>
					<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'manage', Text::_('MOD_DASHBOARD_TAB_MANAGE_D')); ?>
					<div class="row">
						<div class="col-lg-12">
							<nav class="quick-icons dashboard" aria-label="Quick links creation">
								<ul class="nav flex-wrap">
									<?php if ($hiddebuttonmanageitems) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_content&view=articles" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-th-list <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_ITEMLIST'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonmanagecategories) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_categories&extension=com_content" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-folder-open <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_CATLIST'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonmanagetags) : ?>
										<li class="quickicon quickicon-single col">
											<a href="index.php?option=com_tags" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-tags <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_TAGLIST'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonmanageauthors) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_users&view=users" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-user <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_AUTHORLIST'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>

									<?php if ($hiddebuttonmanagegroups) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_users&view=groups" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-users <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_GROUPSLIST'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>

									<?php if ($hiddebuttonmanagefiles) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_media" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-upload <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_FILEMANAGER'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
								</ul>
							</nav>
						</div>
					</div>
					<?php echo HTMLHelper::_('uitab.endTab'); ?>
				<?php endif; ?>


				<?php if ($displayadmintab) : ?>
					<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'admin', Text::_('MOD_DASHBOARD_TAB_ADMIN_D')); ?>
					<div class="row">
						<div class="col-lg-12">
							<nav class="quick-icons dashboard" aria-label="Quick links creation">
								<ul class="nav flex-wrap">
									<?php if ($hiddebuttonprivacy) : ?>
										<li class="quickicon quickicon-single col">
											<a href="index.php?option=com_privacy" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-lock <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_PRIVACY'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonlogs) : ?>
										<li class="quickicon quickicon-single col">
											<a href="index.php?option=com_actionlogs" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-list-alt <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_LOGS'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>

									<?php if ($hiddebuttonprivacy || $hiddebuttonlogs) : ?>
									<?php endif; ?>
									<?php if ($hiddebuttonmanagefieldsuser) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_fields&context=com_users.user" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-user <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_FIELDLIST_USER'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonmanagefieldsarticle) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_fields&context=com_content.article" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-th-list <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_FIELDLIST_ARTICLE'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonadmin) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_config" class="align-items-center">
												<div class="quickicon-icon d-flex align-items-center big">
													<i class="fa fa-cogs <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_GEN'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
								</ul>
							</nav>
						</div>
					</div>
					<?php echo HTMLHelper::_('uitab.endTab'); ?>
				<?php endif; ?>

				<?php if ($displayfreetab) : ?>

				<?php endif; ?>

				<?php if ($displayanalytics && $analytics_url) : ?>
					<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'create', Text::_($analytics_tab_name)); ?>
					<div class="row">
						<div class="col-lg-12">
							<div style="float:right"><a href="<?php echo $analytics_url; ?>" target="_blank" class="btn btn-primary"><?php echo Text::_($analytics_button_name); ?></a></div>
							<?php if ($analytics_token_auth && $analytics_use_token_auth == 1) : ?>
								<iframe src="<?php echo $analytics_url; ?>/index.php?module=Widgetize&action=iframe&moduleToWidgetize=Dashboard&actionToWidgetize=index&idSite=<?php echo $analytics_siteid; ?>&period=<?php echo $analytics_period; ?>&date=<?php echo $analytics_date; ?>&token_auth=<?php echo $analytics_token_auth; ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="<?php echo $analytics_height; ?>px"></iframe>
							<?php elseif ($analytics_use_token_auth == 0) : ?>
								<iframe src="<?php echo $analytics_url; ?>/index.php?module=Widgetize&action=iframe&moduleToWidgetize=Dashboard&actionToWidgetize=index&idSite=<?php echo $analytics_siteid; ?>&period=<?php echo $analytics_period; ?>&date=<?php echo $analytics_date; ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="<?php echo $analytics_height; ?>px"></iframe>
							<?php else : ?>
								<?php echo Text::_('MOD_DASHBOARD_TOKEN_MESSAGE'); ?>
							<?php endif; ?>

						</div>
					</div>
					<?php echo HTMLHelper::_('uitab.endTab'); ?>
				<?php endif; ?>


				<?php echo HTMLHelper::_('uitab.endTabSet'); ?>
			<?php endif; ?>

			</div>
	</div>
	<?php if (!empty($params->get('add_customblock'))) : ?>
		<div class="sep"></div>

		<div class="contentbloc">

			<?php foreach ($params->get('add_customblock') as $block) : ?>

				<?php if ($block->TypofBlock != 'alb') : ?>
					<div class="block <?php echo $block->nameblockcustom; ?> card" style="width:<?php echo $block->width; ?>%">
						<div class="card-header">
							<?php
							//var_dump($block->catidlist);
							//$catidslist = implode(",", $block->catidlist );
							foreach ($block->catidlist as $catidfilter) {
								$catidslist[] = '&filter[category_id][]=' . $catidfilter;
							}
							//var_dump($catidslist);die;
							switch ($block->TypofBlock) {
								case ('fb'):
									$show_all_link = 'index.php?option=com_content&view=featured' . implode('', $catidslist);
									break;
								case ('pb'):
									$show_all_link = 'index.php?option=com_content&view=articles&filter[published]=1' . implode('', $catidslist);
									break;
								case ('upb'):
									$show_all_link = 'index.php?option=com_content&view=articles&filter[published]=0' . implode('', $catidslist);
									break;
								case ('ab'):
									$show_all_link = 'index.php?option=com_content&view=articles&filter[published]=2' . implode('', $catidslist);
									break;
								case ('tb'):
									$show_all_link = 'index.php?option=com_content&view=articles&filter[published]=-2' . implode('', $catidslist);
									break;
								case ('ub'):
									$show_all_link = 'index.php?option=com_content&view=articles&filter[author_id]=' . $user->id . implode('', $catidslist);
									break;
								case ('cb'):
									$show_all_link = 'index.php?option=com_content&view=articles&filter[author_id]=' . $user->id . implode('', $catidslist);
									break;
							}

							?>
							<div class="module-actions">
								<a href='<?php echo $show_all_link ?>' class='adminlink'>
									<?php
									echo Text::_('MOD_DASHBOARD_ALL');
									echo "</a></div>";    ?>
									<h3 class="module-title">
										<i class="fa 
						<?php if (!empty($block->iconbutton)) {
							echo $block->iconbutton;
						} else {
							echo 'fa-star';
						}
						?>  
								" <?php if (!empty($block->coloricon)) {
										echo 'style="color:' . $block->coloricon . ';"';
									} else {
									}
									?>></i>
										<?php echo $block->nameblockcustom; ?>
									</h3>
							</div>
							<div class="card-body" style="height:<?php echo $block->forceheightblock; ?>">

								<table class="table" id="<?php echo str_replace(' ', '', $block->nameblockcustom); ?>">
									<thead>
										<tr>
											<th scope="col" class="w-40"><?php echo Text::_('JGLOBAL_TITLE'); ?></th>
											<th scope="col" class="w-20"><?php echo Text::_('JCATEGORY'); ?></th>
											<th scope="col" class="w-20"><?php echo Text::_('JAUTHOR'); ?></th>
											<th scope="col" class="w-20"><?php echo Text::_('JDATE'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($block->items as $item) :
											$canEdit    = $user->authorise('core.edit',       'com_content.article.' . $item->id);
											$canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
											$canEditOwn = $user->authorise('core.edit.own',   'com_content.article.' . $item->id) && $item->created_by == $userId;
											$canChange  = $user->authorise('core.edit.state', 'com_content.article.' . $item->id) && $canCheckin;
											if ($canChange) :
										?>
												<tr>
													<td>
														<a href="<?php echo $item->link; ?>"><?php echo $item->title; ?>
															<i class="fa fa-edit"></i></a>
													</td>
													<td>
														<span class="small">
															<i class="fa fa-folder"></i>
															<?php echo $item->title; ?>
															</small>
														</span>
													</td>

													<td>
														<span class="small">
															<i class="fa fa-user"></i>
															<?php echo $item->name; ?>
															</small>
														</span>
													</td>
													<td>
														<span class="small">
															<i class="fa fa-calendar"></i>
															<?php echo JHtml::date($item->modified, 'd M Y'); ?>
														</span>
													</td>
												</tr>

											<?php endif; ?>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>

					<?php endif; ?>
					<?php if ($block->TypofBlock == 'alb') : ?>
						<div class="block actionlog card" style="width:<?php echo $block->width; ?>%">
							<div class="card-header">
								<div class="module-actions"> <?php $show_all_link = 'index.php?option=com_actionlogs'; ?>
									<a href='<?php echo $show_all_link ?>' class='adminlink'>
										<?php
										echo Text::_('MOD_DASHBOARD_ALL');
										echo "</a></div>";	?>
										<h3 class="module-title ">
											<i class="fa 
						<?php if (!empty($block->iconbutton)) {
							echo $block->iconbutton;
						} else {
							echo 'fa-star';
						}
						?>  
								" <?php if (!empty($block->coloricon)) {
										echo 'style="color:' . $block->coloricon . ';"';
									} else {
									}
									?>></i>
											<?php echo $block->nameblockcustom; ?>
										</h3>
								</div>
								<div class="card-body" style="height:<?php echo $block->forceheightblock; ?>">


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
																<span class="fa fa-calendar" aria-hidden="true"></span>
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

						<?php endif; ?>


					<?php endforeach; ?>

						</div>

					</div>
				<?php endif; ?>