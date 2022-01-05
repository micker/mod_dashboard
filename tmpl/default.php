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

$document = JFactory::getDocument();
$app       = JFactory::getApplication();
$user      = JFactory::getUser();
$userId    = $user->get('id');


//JHTML::_('behavior.modal');
//JHtml::_('stylesheet', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
JHtml::_('stylesheet', 'media/mod_dashboard/css/style.css');
JHtml::_('stylesheet', 'media/mod_dashboard/css/bootstrap-iconpicker.css');

$force_fullwidth     = $params->get('force_fullwidth', '1');

if ($force_fullwidth) {
	$style = ".card-columns {
		grid-template-columns: 1fr !important;
	}";
	$document->addStyleDeclaration($style);
}

//module config
$hiddefeatured       = $params->get('hiddefeatured', '1');
$hiddepublished      = $params->get('hiddepublished', '1');
$hiddeunpublished    = $params->get('hiddeunpublished', '1');
$hiddearchived       = $params->get('hiddearchived', '1');
$hiddeyouritem       = $params->get('hiddeyouritem', '1');
$hiddetrashed        = $params->get('hiddetrashed', '1');
$actionsloglist	     = $params->get('actionsloglist', '1');
$column              = $params->get('column', '4');
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
$featurewidth      = $params->get('featuredwidth', '48');
$publishedwidth      = $params->get('publishedwidth', '48');
$unpublishedwidth    = $params->get('unpublishedwidth', '48');
$youritemwidth       = $params->get('youritemwidth', '48');
$trashedwidth     = $params->get('trashedlogwidth', '48');
$archivedwidth       = $params->get('archivedwidth', '48');
$actionslogwidth     = $params->get('actionslogwidth', '48');
$iconsize     = $params->get('iconsize', 'fa-2x');


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



		<?php if ($displaycustomtab || $displaycreattab || $displaymanagetab || $displayadmintab || $displayfreetab) : ?>
			<div class="action">

				<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'general')); ?>
				<?php if ($displaycustomtab) : ?>
					<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'custom', Text::_($nametab)); ?>
					<div class="row">
						<div class="col-lg-12">
							<nav class="quick-icons dashboard" aria-label="Quick custom link">
								<ul class="nav flex-wrap">
									<?php
									$list_buttons = $params->get('add_button');
									if ($list_buttons) : ?>

										<?php foreach ($list_buttons as $list_buttons_idx => $add_button) : ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_content&view=article&layout=edit&catid=<?php echo $add_button->catid; ?>&language=<?php echo $add_button->button_lang; ?>" target="<?php echo $add_button->targetlink; ?>">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas 
						<?php if (!empty($add_button->iconbutton)) {
												echo $add_button->iconbutton;
											} else {
												echo 'fa-plus-circle';
											}
						?> <?php echo $iconsize; ?> 
								" <?php if (!empty($add_button->coloricon)) {
												echo 'style="color:' . $add_button->coloricon . ';"';
											} else {
											}
									?>></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo Text::_($add_button->button_name); ?>
													</div>
												</a>
											</li>
											<?php if ($add_button->displayline) : ?>
												<hr class="mt-3 mb-3" />
											<?php endif; ?>
										<?php endforeach; ?>
									<?php endif; ?>
									<?php $list_catbuttons = $params->get('add_cat_button');
									if ($list_catbuttons) : ?>
										<?php foreach ($list_catbuttons as $list_catbuttons_idx => $cat_button) : ?>

											<?php if ($cat_button->displayauthoronly == 1) {
												$filter_byauthor = '&amp;filter[author_id]=' . $user->id;
											} else {
												$filter_byauthor = '';
											}
											?>
											<li class="quickicon quickicon-single col">
												<a href="index.php?option=com_content&view=articles&filter[category_id]=<?php echo $cat_button->catidlist; ?>&filter[language]=<?php echo $cat_button->button_lang; ?><?php echo $filter_byauthor; ?>" target="<?php echo $cat_button->targetlink; ?>">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas 
						<?php if (!empty($cat_button->iconbutton)) {
												echo $cat_button->iconbutton;
											} else {
												echo 'fa-th-list';
											}
						?> <?php echo $iconsize; ?> 
							 " <?php if (!empty($cat_button->coloricon)) {
												echo 'style="color:' . $cat_button->coloricon . ';"';
											} else {
											}
								?>>
														</i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo Text::_($cat_button->namecatfilter); ?>
													</div>
												</a>
											</li>
											<?php if ($cat_button->displayline) : ?>
												<hr class="mt-3 mb-3" /><?php endif; ?>
										<?php endforeach; ?>
									<?php endif; ?>
									<?php $list_edititembuttons = $params->get('edit_item_button');
									if ($list_edititembuttons) : ?>
										<?php foreach ($list_edititembuttons as $list_edititembuttons_idx => $edit_item_button) : ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_content&task=article.edit&id=<?php echo $edit_item_button->itemid; ?>">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas 
						<?php if (!empty($edit_item_button->iconbutton)) {
												echo $edit_item_button->iconbutton;
											} else {
												echo 'fa-edit';
											}
						?> <?php echo $iconsize; ?>
								 " <?php if (!empty($edit_item_button->coloricon)) {
												echo 'style="color:' . $edit_item_button->coloricon . ';"';
											} else {
											}
									?>>
														</i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo Text::_($edit_item_button->nameitemedit); ?>
													</div>
												</a>
											</li>
											<?php if ($edit_item_button->displayline) : ?>
												<hr class="mt-3 mb-3" /><?php endif; ?>
										<?php endforeach; ?>
									<?php endif; ?>
								</ul>
							</nav>
						</div>
					</div>
					<?php echo HTMLHelper::_('uitab.endTab'); ?>
				<?php endif; ?>
				<?php if ($displaycreattab) : ?>
					<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'create', Text::_('MOD_DASHBOARD_TAB_CREATE_D')); ?>
					<div class="row">
						<div class="col-lg-12">
							<nav class="quick-icons dashboard" aria-label="Quick links creation">
								<ul class="nav flex-wrap">
									<?php if ($hiddebuttonadditem) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_content&task=article.add">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-plus-circle <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_ADDITEM'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonaddcategory) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_categories&task=category.add&extension=com_content">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-folder-open <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_ADDCATEGORY'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonaddtag) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_tags&view=tag&task=tag.add">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-tags <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_ADDTAG'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonadduser) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_users&task=user.add">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-user <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_ADDAUTHOR'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonaddgroup) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_users&task=group.add">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-users <?php echo $iconsize; ?> "></i>
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
											<a href="index.php?option=com_content&view=articles">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-th-list <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_ITEMLIST'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonmanagecategories) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_categories&extension=com_content">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-folder-open <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_CATLIST'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonmanagetags) : ?>
										<li class="quickicon quickicon-single col">
											<a href="index.php?option=com_tags">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-tags <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_TAGLIST'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonmanageauthors) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_users&view=users">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-user <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_AUTHORLIST'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>

									<?php if ($hiddebuttonmanagegroups) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_users&view=groups">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-users <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_GROUPSLIST'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>

									<?php if ($hiddebuttonmanagefiles) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_media">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-upload <?php echo $iconsize; ?> "></i>
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
											<a href="index.php?option=com_privacy">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-lock <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_PRIVACY'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonlogs) : ?>
										<li class="quickicon quickicon-single col">
											<a href="index.php?option=com_actionlogs">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-list-alt <?php echo $iconsize; ?> "></i>
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
											<a href="index.php?option=com_fields&context=com_users.user">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-user <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_FIELDLIST_USER'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonmanagefieldsarticle) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_fields&context=com_content.article">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-th-list <?php echo $iconsize; ?> "></i>
												</div>
												<div class="quickicon-name d-flex align-items-center">
													<?php echo Text::_('MOD_DASHBOARD_FIELDLIST_ARTICLE'); ?>
												</div>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($hiddebuttonadmin) : ?>
										<li class="quickicon quickicon-single col ">
											<a href="index.php?option=com_config">
												<div class="quickicon-icon d-flex align-items-end big">
													<i class="fas fa-cogs <?php echo $iconsize; ?> "></i>
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
					<?php
					$list_freebuttons = $params->get('free_button');
					if ($list_freebuttons) : ?>
						<?php foreach ($list_freebuttons as $list_freebuttons_idx => $free_buttons) : ?>
							<?php $tabname = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/', '', $free_buttons->freenametab)); ?>
							<?php echo HTMLHelper::_('uitab.addTab', 'myTab', $tabname, Text::_($free_buttons->freenametab)); ?>
							<div class="row">
								<div class="col-lg-12">
									<nav class="quick-icons dashboard" aria-label="Quick links creation">
										<ul class="nav flex-wrap">
											<?php foreach ($free_buttons->free_button as $free_button_idx => $free_button) : ?>
												<li class="quickicon quickicon-single col">
													<a href="<?php echo $free_button->linkbutton; ?>" target="<?php echo $free_button->targetlink; ?>">
														<div class="quickicon-icon d-flex align-items-end big">
															<i class="fas 
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
															<?php echo Text::_($free_button->freebutton); ?>
														</div>
													</a>
												</li>
												<?php if ($free_button->displayline) : ?>
													<hr class="mt-3 mb-3" /><?php endif; ?>
											<?php endforeach; ?>
										</ul>
									</nav>
								</div>
							</div>
							<?php echo HTMLHelper::_('uitab.endTab'); ?>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php echo HTMLHelper::_('uitab.endTabSet'); ?>
			<?php endif; ?>

			</div>
	</div>

	<div class="sep"></div>

	<div class="contentbloc">

		<?php if ($hiddefeatured) : ?>
			<div class="block featured card" style="width:<?php echo $featurewidth; ?>%">
				<div class="card-header">
					<?php $show_all_link = 'index.php?option=com_content&amp;view=featured'; ?>
					<div class="module-actions">
						<a href='<?php echo $show_all_link ?>' class='adminlink'>
							<?php
							echo Text::_('MOD_DASHBOARD_ALL');
							echo "</a></div>";	?>
							<h3 class="module-title"><i class="fas fa-star featured"></i>
								<?php echo Text::_('MOD_DASHBOARD_FEATURED'); ?></h3>
					</div>
					<div class="card-body" style="height:<?php echo $forceheightblock; ?>">

						<table class="table" id="<?php echo str_replace(' ', '', $module->title) . $module->id; ?>">
							<thead>
								<tr>
									<th scope="col" class="w-40"><?php echo Text::_('JGLOBAL_TITLE'); ?></th>
									<th scope="col" class="w-20"><?php echo Text::_('JAUTHOR'); ?></th>
									<th scope="col" class="w-20"><?php echo Text::_('JDATE'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($listFeatured as $itemFeatured) :
									$canEdit    = $user->authorise('core.edit',       'com_content.article.' . $itemFeatured->id);
									$canCheckin = $user->authorise('core.manage',     'com_checkin') || $itemFeatured->checked_out == $userId || $itemFeatured->checked_out == 0;
									$canEditOwn = $user->authorise('core.edit.own',   'com_content.article.' . $itemFeatured->id) && $itemFeatured->created_by == $userId;
									$canChange  = $user->authorise('core.edit.state', 'com_content.article.' . $itemFeatured->id) && $canCheckin;
									if ($canChange) :
								?>
										<tr>
											<td>
												<a href="<?php echo $itemFeatured->link; ?>"><?php echo $itemFeatured->title; ?>
													<i class="fa fa-edit"></i></a>
											</td>
											<td>
												<span class="small">
													<i class="fa fa-user"></i>
													<?php echo $itemFeatured->name; ?>
													</small>
												</span>
											</td>
											<td>
												<span class="small">
													<i class="fas fa-calendar"></i>
													<?php echo JHtml::date($itemFeatured->modified, 'd M Y'); ?>
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
			<?php if ($hiddepublished) : ?>
				<div class="block published card" style="width:<?php echo $publishedwidth; ?>%">
					<div class="card-header">

						<?php $show_all_link = 'index.php?option=com_content&amp;view=articles&amp;filter[published]=1'; ?>
						<div class="module-actions">
							<a href='<?php echo $show_all_link ?>' class='adminlink'>
								<?php
								echo Text::_('MOD_DASHBOARD_ALL');
								echo "</a></div>";	?>
								<h3 class="module-title "><i class="fa fa-check"></i>
									<?php echo Text::_('MOD_DASHBOARD_PUBLISHED'); ?></h3>


						</div>
						<div class="card-body" style="height:<?php echo $forceheightblock; ?>">

							<table class="table" id="<?php echo str_replace(' ', '', $module->title) . $module->id; ?>">
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
				<?php endif; ?>

				<?php if ($hiddeunpublished) : ?>

					<div class="block unpublished card" style="width:<?php echo $unpublishedwidth; ?>%">
						<div class="card-header">
							<?php $show_all_link = 'index.php?option=com_content&amp;view=articles&amp;filter[published]=0'; ?>
							<div class="module-actions">
								<a href='<?php echo $show_all_link ?>' class='adminlink'>
									<?php
									echo Text::_('MOD_DASHBOARD_ALL');
									echo "</a></div>";	?>
									<h3 class="module-title"><i class="fa fa-thumbs-down"></i>
										<?php echo Text::_('MOD_DASHBOARD_UNPUBLISHED'); ?></h3>

							</div>

							<div class="card-body" style="height:<?php echo $forceheightblock; ?>">

								<table class="table" id="<?php echo str_replace(' ', '', $module->title) . $module->id; ?>">
									<thead>
										<tr>
											<th scope="col" class="w-40"><?php echo Text::_('JGLOBAL_TITLE'); ?></th>
											<th scope="col" class="w-20"><?php echo Text::_('JAUTHOR'); ?></th>
											<th scope="col" class="w-20"><?php echo Text::_('JDATE'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($listUnpublished as $itemUnpublished) :
											$canEdit    = $user->authorise('core.edit',       'com_content.article.' . $itemUnpublished->id);
											$canCheckin = $user->authorise('core.manage',     'com_checkin') || $itemUnpublished->checked_out == $userId || $itemUnpublished->checked_out == 0;
											// $canEditOwn = $user->authorise('core.edit.own',   'com_content.article.' . $itemUnpublished->id) && $$itemUnpublished->created_by == $userId;
											$canChange  = $user->authorise('core.edit.state', 'com_content.article.' . $itemUnpublished->id) && $canCheckin;
											if ($canChange) :
										?>
												<tr>
													<td>
														<a href="<?php echo $itemUnpublished->link; ?>"><?php echo $itemUnpublished->title; ?>
															<i class="fa fa-edit"></i></a>
													</td>
													<td>
														<span class="small">
															<i class="fa fa-user"></i> <?php echo $itemUnpublished->name; ?></small>
														</span>
													</td>
													<td>
														<span class="small">
															<i class="fas fa-calendar"></i>
															<?php echo JHtml::date($itemUnpublished->modified, 'd M Y'); ?>
														</span>
													</td>
												</tr>
											<?php endif; ?>
										<?php endforeach; ?>
									<tbody>
								</table>
							</div>
						</div>
					<?php endif; ?>
					<?php if ($hiddearchived) : ?>
						<div class="block archived card" style="width:<?php echo $archivedwidth; ?>%">
							<div class="card-header">
								<?php $show_all_link = 'index.php?option=com_content&amp;view=articles&amp;filter[published]=2'; ?>
								<div class="module-actions">
									<a href='<?php echo $show_all_link ?>' class='adminlink'>
										<?php
										echo Text::_('MOD_DASHBOARD_ALL');
										echo "</a></div>";	?>
										<h3 class="module-title"><i class="fa fa-archive"></i>
											<?php echo Text::_('MOD_DASHBOARD_ARCHIVED'); ?></h3>

								</div>
								<div class="card-body" style="height:<?php echo $forceheightblock; ?>">

									<table class="table" id="<?php echo str_replace(' ', '', $module->title) . $module->id; ?>">
										<thead>
											<tr>
												<th scope="col" class="w-40"><?php echo Text::_('JGLOBAL_TITLE'); ?></th>
												<th scope="col" class="w-20"><?php echo Text::_('JAUTHOR'); ?></th>
												<th scope="col" class="w-20"><?php echo Text::_('JDATE'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($listArchived as $itemArchived) :
												$canEdit    = $user->authorise('core.edit',       'com_content.article.' . $itemArchived->id);
												$canCheckin = $user->authorise('core.manage',     'com_checkin') || $itemArchived->checked_out == $userId || $itemArchived->checked_out == 0;
												$canEditOwn = $user->authorise('core.edit.own',   'com_content.article.' . $itemArchived->id) && $itemArchived->created_by == $userId;
												$canChange  = $user->authorise('core.edit.state', 'com_content.article.' . $itemArchived->id) && $canCheckin;
												if ($canChange) :
											?>
													<tr>
														<td>
															<a href="<?php echo $itemArchived->link; ?>"><?php echo $itemArchived->title; ?>
																<i class="fa fa-edit"></i></a>
														</td>
														<td>
															<span class="small">
																<i class="fa fa-user"></i>
																<?php echo $itemArchived->name; ?>
															</span>
														</td>
														<td>
															<span class="small"> <i class="fas fa-calendar"></i>
																<?php echo JHtml::date($itemArchived->modified, 'd M Y'); ?></span>
														</td>
													</tr>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
						</tbody>
						</table>
							</div>
						</div>
					<?php endif; ?>
					<?php if ($hiddeyouritem) : ?>
						<div class="block youritems card" style="width:<?php echo $youritemwidth; ?>%">
							<div class="card-header">
								<div class="module-actions">
									<?php $show_all_link = 'index.php?option=com_content&amp;view=articles&amp;filter[author_id]=' . $user->id; //TODO add user id
									?>
									<a href='<?php echo $show_all_link ?>' class='adminlink'>
										<?php
										echo Text::_('MOD_DASHBOARD_ALL');
										echo "</a></div>";	?>

										<?php $user = JFactory::getUser();		?>
										<h3 class="module-title">
											<i class="fa fa-user"></i>
											<?php echo Text::_('JOOMLA_YOUR_ITEM'); ?> : <?php echo $user->name; ?>
										</h3>

								</div>
								<div class="card-body" style="height:<?php echo $forceheightblock; ?>">

									<table class="table" id="<?php echo str_replace(' ', '', $module->title) . $module->id; ?>">
										<thead>
											<tr>
												<th scope="col" class="w-40"><?php echo Text::_('JGLOBAL_TITLE'); ?></th>
												<th scope="col" class="w-20"><?php echo Text::_('JAUTHOR'); ?></th>
												<th scope="col" class="w-20"><?php echo Text::_('JSTATES'); ?></th>
												<th scope="col" class="w-20"><?php echo Text::_('JDATE'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($listUseritem as $itemUseritem) :
												$canEdit    = $user->authorise('core.edit',       'com_content.article.' . $itemUseritem->id);
												$canCheckin = $user->authorise('core.manage',     'com_checkin') || $itemUseritem->checked_out == $userId || $itemUseritem->checked_out == 0;
												$canEditOwn = $user->authorise('core.edit.own',   'com_content.article.' . $itemUseritem->id) && $itemUseritem->created_by == $userId;
												$canChange  = $user->authorise('core.edit.state', 'com_content.article.' . $itemUseritem->id) && $canCheckin;
												if ($canChange) :

											?>
													<tr>
														<td>
															<a href="<?php echo $itemUseritem->link; ?>"><?php echo $itemUseritem->title; ?>
																<i class="fa fa-edit"></i></a>
														</td>
														<td>
															<span class="small">
																<i class="fa fa-user"></i>

																<small class="hasTooltip" title="" data-original-title="<?php echo JHtml::tooltipText('MOD_DASHBOARD_CREATED_BY') . " " . $user->name; ?>"><?php echo $user->name; ?>
																</small>
															</span>
														</td>
														<td>
															<?php echo $itemUseritem->state; ?>
														</td>
														<td>
															<span class="small">
																<i class="fas fa-calendar"></i>
																<?php echo JHtml::date($itemUseritem->modified, 'd M Y'); ?>
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
						<?php if ($hiddetrashed) : ?>
							<div class="block trashed card" style="width:<?php echo $trashedwidth; ?>%">
								<div class="card-header">

									<?php
									$show_all_link = 'index.php?option=com_content&amp;view=articles&amp;filter[published]=-2'; ?>
									<div class="module-actions">
										<a href='<?php echo $show_all_link ?>' class='adminlink'>
											<?php
											echo Text::_('MOD_DASHBOARD_ALL');
											echo "</a></div>";	?>

											<h3 class="module-title "><i class="fa fa-trash"></i>
												<?php echo Text::_('MOD_DASHBOARD_TRASHED'); ?></h3>

									</div>
									<div class="card-body" style="height:<?php echo $forceheightblock; ?>">

										<table class="table" id="<?php echo str_replace(' ', '', $module->title) . $module->id; ?>">
											<thead>
												<tr>
													<th scope="col" class="w-40"><?php echo Text::_('JGLOBAL_TITLE'); ?></th>
													<th scope="col" class="w-40"><?php echo Text::_('JAUTHOR'); ?></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($listTrashed as $itemTrashed) :
													$canEdit    = $user->authorise('core.edit',       'com_content.article.' . $itemTrashed->id);
													$canCheckin = $user->authorise('core.manage',     'com_checkin') || $itemTrashed->checked_out == $userId || $itemTrashed->checked_out == 0;
													$canEditOwn = $user->authorise('core.edit.own',   'com_content.article.' . $itemTrashed->id) && $itemTrashed->created_by == $userId;
													$canChange  = $user->authorise('core.edit.state', 'com_content.article.' . $itemTrashed->id) && $canCheckin;
													if ($canChange) :
												?>
														<tr>
															<td>
																<a href="<?php echo $itemTrashed->link; ?>"><?php echo $itemTrashed->title; ?>
																	<i class="fa fa-edit"></i></a>
															</td>
															<td>
																<span class="small">
																	<i class="fa fa-user"></i><?php echo $user->name; ?>
																</span>
															</td>
															<td>
																<span class="small">
																	<i class="fas fa-calendar"></i>
																	<?php echo JHtml::date($itemTrashed->modified, 'd M Y'); ?>
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

							<?php if ($actionsloglist) : ?>
								<div class="block actionlog card" style="width:<?php echo $actionslogwidth; ?>%">
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
								<?php endif; ?>



								<?php if ($listCustomlist) : ?>
									<?php
									foreach ($listCustomlist as $listCustomlist_idx => $customblock) : ?>
										<div class="block <?php echo $customblock->catidlist; ?> card" style="width:<?php echo $customblock->width; ?>%">
											<div class="card-header">
												<div class="module-actions">
													<?php $show_all_link = 'index.php?option=com_content&filter_category_id=' . $customblock->catidlist; ?>

													<a href='<?php echo $show_all_link ?>' class='adminlink'>
														<?php
														echo Text::_('MOD_DASHBOARD_ALL');
														echo "</a></div>";	?>
														<h3 class="module-title ">
															<i class="fa fa-user"></i>
															<?php echo Text::_($customblock->nameblockcustom); ?> :
														</h3>
												</div>
												<div class="card-body" style="height:<?php echo $forceheightblock; ?>">

													<table class="table" id="<?php echo str_replace(' ', '', $module->title) . $module->id; ?>">
														<thead>
															<tr>
																<th scope="col" class="w-40"><?php echo Text::_('JGLOBAL_TITLE'); ?></th>
																<?php if ($customblock->displautblock) : ?>
																	<th scope="col" class="w-40"><?php echo Text::_('JAUTHOR'); ?></th>
																<?php endif; ?>
																<?php if ($customblock->displdateblock) : ?>
																	<th scope="col" class="w-20"><?php echo Text::_('JDATE'); ?></th>
																<?php endif; ?>
															</tr>
														</thead>
														<tbody>

															<?php foreach ($customblock->listitems as $itemcustomblock) :
																$canEdit    = $user->authorise('core.edit',       'com_content.article.' . $itemcustomblock->id);
																$canCheckin = $user->authorise('core.manage',     'com_checkin') || $itemcustomblock->checked_out == $userId || $itemcustomblock->checked_out == 0;
																$canEditOwn = $user->authorise('core.edit.own',   'com_content.article.' . $itemcustomblock->id) && $itemcustomblock->created_by == $userId;
																$canChange  = $user->authorise('core.edit.state', 'com_content.article.' . $itemcustomblock->id) && $canCheckin;
																if ($canChange) :
															?>
																	<tr>
																		<td>
																			<a href="<?php echo $itemcustomblock->link; ?>"><?php echo $itemcustomblock->title; ?>
																				<i class="fa fa-edit"></i></a>
																		</td>
																		<?php if ($customblock->displautblock) : ?>
																			<td>
																				<span class="small">
																					<i class="fa fa-user"></i>

																					<small><?php echo $itemcustomblock->name; ?>
																					</small>
																				</span>
																			</td>
																		<?php endif; ?>
																		<?php if ($customblock->displdateblock) : ?>
																			<td>
																				<span class="small">
																					<i class="fas fa-calendar"></i>
																					<?php echo JHtml::date($itemcustomblock->modified, 'd M Y'); ?>
																				</span>
																			</td>
																		<?php endif; ?>
																	<?php endif; ?>
																<?php endforeach; ?>
																	</tr>
														</tbody>
													</table>
												</div>
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
										</div>

								</div>

