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

/**
 * modified override specically to suit the new Joomla4 Atum Administrator (dashboard) template
 * - ONLY utilises the "custommessage" & "tabbed" sections of mod_dashboard
 * - ONLY designed for display in the "top" position
 * - ONLY designed for display on dashboard/cpanel pages (does not display on extension pages)
 * -- shows as a collapsable div on non-home dashboard/cpanel pages
 *
 * @RussW (hotmango & thestyleguyz) : 12-October-2021
 */

//blocage des accés directs sur ce script
defined('_JEXEC') or die('Accés interdit');

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\Registry\Registry;

$document	= JFactory::getDocument();
$app		= JFactory::getApplication();
$user		= JFactory::getUser();
$userId		= $user->get('id');

// option & view needed to show the collapsable dashboard in cpanel views but not content views
$input 		= $app->input;
$option		= $input->get('option');
$view		= $input->get('view');

JHtml::_('stylesheet', 'media/mod_dashboard/css/style.css');
JHtml::_('stylesheet', 'media/mod_dashboard/css/topview.css');
JHtml::_('stylesheet', 'media/mod_dashboard/css/bootstrap-iconpicker.css');

$force_fullwidth	= $params->get('force_fullwidth', '1');
if ($force_fullwidth) {

	$style = '.card-columns {
		grid-template-columns: 1fr;
	}';
	$document->addStyleDeclaration($style);

}

//module config
$hiddefeatured					= $params->get('hiddefeatured', '1' );
$hiddepublished					= $params->get('hiddepublished', '1' );
$hiddeunpublished				= $params->get('hiddeunpublished', '1' );
$hiddearchived					= $params->get('hiddearchived', '1' );
$hiddeyouritem					= $params->get('hiddeyouritem', '1' );
$hiddetrashed					= $params->get('hiddetrashed', '1' );
$actionsloglist					= $params->get('actionsloglist', '1' );
$column							= $params->get('column', '4' );
$displaycustomtab				= $params->get('displaycustomtab', '1' );
$displaycreattab				= $params->get('displaycreattab', '1' );
$displaymanagetab				= $params->get('displaymanagetab', '1' );
$displayadmintab				= $params->get('displayadmintab', '1' );
$displayfreetab					= $params->get('displayfreetab', '1' );
//$displayconfigmodule			= $params->get('displayconfigmodule', '1' );
$forceheightblock				= $params->get('forceheightblock', '' );
$displaycustomtext				= $params->get('displaycustomtext','');
$customtext						= $params->get('customtext','');
//$displayinfosystem				= $params->get('displayinfosystem','1');
$featurewidth					= $params->get('featuredwidth','48');
$publishedwidth					= $params->get('publishedwidth','48');
$unpublishedwidth				= $params->get('unpublishedwidth','48');
$youritemwidth					= $params->get('youritemwidth','48');
$trashedwidth					= $params->get('trashedlogwidth','48');
$archivedwidth					= $params->get('archivedwidth','48');
$actionslogwidth				= $params->get('actionslogwidth','48');
$iconsize						= $params->get('iconsize','fa-2x');

$nametab						= $params->get('nametab', 'MOD_DASHBOARD_CUSTOM_TAB_NAME' ); // customtab name
$freenametab					= $params->get('freenametab', 'MOD_DASHBOARD_FREE_TAB_NAME' ); // freetab name

//Get Buttom Sections
$hiddebuttonmanageitems			= $params->get('hiddebuttonmanageitems', '1');
$hiddebuttonmanagecategories	= $params->get('hiddebuttonmanagecategories', '1');
$hiddebuttonmanagetags			= $params->get('hiddebuttonmanagetags', '1');
$hiddebuttonmanageauthors		= $params->get('hiddebuttonmanageauthors', '1');
$hiddebuttonmanagegroups		= $params->get('hiddebuttonmanagegroups', '1');
$hiddebuttonmanagefiles			= $params->get('hiddebuttonmanagefiles', '1');
$hiddebuttonprivacy				= $params->get('hiddebuttonprivacy', '1');
$hiddebuttonlogs				= $params->get('hiddebuttonlogs', '1');
$hiddebuttonmanagefieldsarticle	= $params->get('hiddebuttonmanagefieldsarticle', '1');
$hiddebuttonmanagefieldsuser	= $params->get('hiddebuttonmanagefieldsusers', '1');
$hiddebuttonadditem				= $params->get('hiddebuttonadditem', '1');
$hiddebuttonaddcategory			= $params->get('hiddebuttonaddcategory', '1');
$hiddebuttonaddtag				= $params->get('hiddebuttonaddtag', '1');
$hiddebuttonadduser				= $params->get('hiddebuttonadduser', '1');
$hiddebuttonaddgroup			= $params->get('hiddebuttonaddgroup', '1');
$hiddebuttonadmin				= $params->get('hiddebuttonadmin', '1');

$displayauthoronly				= $params->get('displayauthoronly', '0');

jimport( 'joomla.application.component.controller' );
?>

<?php
 /**
  * only display com_dashboard on Atum com_cpanel pages
  * - display within a collapse with a target button on non-home dashboards (to reduce used screen real-estate)

  * @RussW (hotmango & thestyleguyz) : 12-October-2021
  */
?>

<?php if ($option == 'com_cpanel' AND !empty($view)) { ?>

	<p>
		<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopview" aria-expanded="false" aria-controls="collapseTopview">
			<i class="fas fa-tasks"></i> <?php echo $module->title; ?>
		</button>
	</p>

	<div class="collapse collapseTopview mb-3" id="collapseTopview">

<?php } ?>


<?php if ($option == 'com_cpanel') { ?>

	<div class="card-header">
		<h2 class="h3 mb-0 fw-normal"><span class="fas fa-tasks" aria-hidden="true"></span> <?php echo $module->title; ?></h2>
	</div>


	<div class="topview <?php echo $moduleclass_sfx; ?>">

		<?php if ($displaycustomtext) { ?>
			<div class="headerblock my-0">

				<div class="modulemessage pt-0">
					<?php echo $customtext; ?>
				</div>

			</div><!--/.headerblock-->
		<?php } ?>


		<?php if ($displaycustomtab OR $displaycreattab OR $displaymanagetab OR $displayadmintab OR $displayfreetab) { ?>

			<div class="action my-0">

				<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'general')); ?>

					<?php if ($displaycustomtab) { ?>

						<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'custom', Text::_($nametab)); ?>

						<div class="row">
							<div class="col-lg-12">

								<nav class="quick-icons dashboard" aria-label="Quick custom link">
									<ul class="nav flex-wrap">
									<?php $list_buttons = $params->get('add_button'); ?>
									<?php if ($list_buttons) { ?>

										<?php foreach ($list_buttons as $list_buttons_idx => $add_button ) { ?>

											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_content&view=article&layout=edit&catid=<?php echo $add_button->catid; ?>&language=<?php echo $add_button->button_lang; ?>" target="<?php echo $add_button->targetlink; ?>">
													<div class="quickicon-icon d-flex align-items-end big">
														<?php
															if (!empty($add_button->iconbutton)) {
																$icon = $add_button->iconbutton;

															} else {
																$icon = 'fa-plus-circle';
															}

															if (!empty($add_button->coloricon)) {
																$iconcolor = 'color:'. $add_button->coloricon .';';

															} else {
																$iconcolor = '';
															}
														?>
														<i class="fas <?php echo $icon .' '. $iconsize; ?>" style="<?php echo $iconcolor; ?>"></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_($add_button->button_name); ?>
													</div>
												</a>
											</li>

											<?php if ($add_button->displayline) { ?>
												<hr class="my-0" />
											<?php } ?>

										<?php } //endforeach ?>

									<?php } // list_buttons ?>


									<?php $list_catbuttons = $params->get('add_cat_button'); ?>
									<?php if ($list_catbuttons) { ?>

										<?php foreach ($list_catbuttons as $list_catbuttons_idx => $cat_button ) { ?>

											<?php
												if ($cat_button->displayauthoronly == 1) {
													$filter_byauthor ='&amp;filter[author_id]='.$user->id;

												} else {
													$filter_byauthor='';
												}
											?>

											<li class="quickicon quickicon-single col">
												<a href="index.php?option=com_content&view=articles&filter[category_id]=<?php echo $cat_button->catidlist; ?>&filter[language]=<?php echo $cat_button->button_lang; ?><?php echo $filter_byauthor; ?>" target="<?php echo $cat_button->targetlink; ?>">
													<div class="quickicon-icon d-flex align-items-end big">
														<?php
															if (!empty($cat_button->iconbutton)) {
																$icon = $cat_button->iconbutton;

															} else {
																$icon = 'fa-th-list';
															}

															if (!empty($cat_button->coloricon)) {
																$iconcolor = 'color:'. $cat_button->coloricon .';';

															} else {
																$iconcolor = '';
															}
														?>
														<i class="fas <?php echo $icon .' '. $iconsize; ?>" style="<?php $iconcolor; ?>"></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_($cat_button->namecatfilter); ?>
													</div>
												</a>
											</li>

											<?php if ($cat_button->displayline) { ?>
												<hr class="my-0" />
											<?php } ?>

										<?php } // endforeach ?>

									<?php }  // list_catbuttons ?>


									<?php $list_edititembuttons = $params->get('edit_item_button'); ?>
									<?php if ($list_edititembuttons) { ?>

										<?php foreach ($list_edititembuttons as $list_edititembuttons_idx => $edit_item_button ) { ?>

											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_content&task=article.edit&id=<?php echo $edit_item_button->itemid; ?>">
													<div class="quickicon-icon d-flex align-items-end big">

														<?php
															if (!empty($edit_item_button->iconbutton)) {
																$icon = $edit_item_button->iconbutton;

															} else {
																$icon = 'fa-edit';
															}

															if (!empty($edit_item_button->coloricon)) {
																$iconcolor = 'color:'. $edit_item_button->coloricon .';';

															} else {
																$iconcolor = '';
															}
														?>
														<i class="fas <?php echo $icon .' '. $iconsize; ?> style="<?php echo $iconcolor; ?>"></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_($edit_item_button->nameitemedit); ?>
													</div>
												</a>
											</li>

											<?php if ($edit_item_button->displayline) { ?>
												<hr class="my-0" />
											<?php } ?>

										<?php } //endforeach ?>

									<?php } // list_edititembuttons ?>

									</ul>
								</nav>

							</div>
						</div><!--/.row-->

						<?php echo HTMLHelper::_('uitab.endTab'); ?>

					<?php } //displaycustomtab ?>


					<?php if ($displaycreattab) { ?>

						<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'create', Text::_('MOD_DASHBOARD_TAB_CREATE_D')); ?>

						<div class="row">
							<div class="col-lg-12">

								<nav class="quick-icons dashboard" aria-label="Quick links creation">
									<ul class="nav flex-wrap">

										<?php if ($hiddebuttonadditem) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_content&task=article.add">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-plus-circle <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_ADDITEM' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonaddcategory) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_categories&task=category.add&extension=com_content">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-folder-open <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_ADDCATEGORY' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonaddtag) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_tags&view=tag&task=tag.add">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-tags <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_ADDTAG' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonadduser) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_users&task=user.add">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-user <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_ADDAUTHOR' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonaddgroup) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_users&task=group.add">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-users <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_ADDGROUPS' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

									</ul>
								</nav>

							</div>
						</div><!--/.row-->

						<?php echo HTMLHelper::_('uitab.endTab'); ?>

					<?php } //displaycreattab ?>


					<?php if ($displaymanagetab) { ?>

						<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'manage', Text::_('MOD_DASHBOARD_TAB_MANAGE_D')); ?>

						<div class="row">
							<div class="col-lg-12">

								<nav class="quick-icons dashboard" aria-label="Quick links creation">
									<ul class="nav flex-wrap">

										<?php if ($hiddebuttonmanageitems) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_content&view=articles">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-th-list <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_ITEMLIST' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonmanagecategories) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_categories&extension=com_content">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-folder-open <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_CATLIST' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonmanagetags) { ?>
											<li class="quickicon quickicon-single col">
												<a href="index.php?option=com_tags">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-tags <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_TAGLIST' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonmanageauthors) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_users&view=users">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-user <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_AUTHORLIST' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonmanagegroups) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_users&view=groups">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-users <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_GROUPSLIST' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonmanagefiles) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_media">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-upload <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_FILEMANAGER' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

									</ul>
								</nav>

							</div>
						</div><!--/.row-->

						<?php echo HTMLHelper::_('uitab.endTab'); ?>

					<?php } //displaymanagetab ?>


					<?php if ($displayadmintab) { ?>

						<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'admin', Text::_('MOD_DASHBOARD_TAB_ADMIN_D')); ?>

						<div class="row">
							<div class="col-lg-12">

								<nav class="quick-icons dashboard" aria-label="Quick links creation">
									<ul class="nav flex-wrap">

										<?php if ($hiddebuttonprivacy) { ?>
											<li class="quickicon quickicon-single col">
												<a href="index.php?option=com_privacy">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-lock <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_PRIVACY' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonlogs) { ?>
											<li class="quickicon quickicon-single col">
												<a href="index.php?option=com_actionlogs">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-list-alt <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_LOGS' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonprivacy OR $hiddebuttonlogs) { ?>
											<!-- TODO -->
										<?php } ?>

										<?php if ($hiddebuttonmanagefieldsuser) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_fields&context=com_users.user">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-user <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_FIELDLIST_USER' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonmanagefieldsarticle) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_fields&context=com_content.article">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-th-list <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_FIELDLIST_ARTICLE' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

										<?php if ($hiddebuttonadmin) { ?>
											<li class="quickicon quickicon-single col ">
												<a href="index.php?option=com_config">
													<div class="quickicon-icon d-flex align-items-end big">
														<i class="fas fa-cogs <?php echo $iconsize; ?> "></i>
													</div>
													<div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_( 'MOD_DASHBOARD_GEN' ); ?>
													</div>
												</a>
											</li>
										<?php } ?>

									</ul>
								</nav>

							</div>
						</div><!--/.row-->

						<?php echo HTMLHelper::_('uitab.endTab'); ?>

					<?php } //displayadmintab ?>


					<?php if ($displayfreetab) { ?>

						<?php $list_freebuttons = $params->get('free_button'); ?>
						<?php if ($list_freebuttons) { ?>

							<?php foreach( $list_freebuttons as $list_freebuttons_idx => $free_buttons ) { ?>

								<?php $tabname = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $free_buttons->freenametab)); ?>
								<?php echo HTMLHelper::_('uitab.addTab', 'myTab', $tabname, Text::_($free_buttons->freenametab)); ?>

								<div class="row">
									<div class="col-lg-12">

										<nav class="quick-icons dashboard" aria-label="Quick links creation">
											<ul class="nav flex-wrap">

												<?php foreach( $free_buttons->free_button as $free_button_idx => $free_button ) { ?>

													<li class="quickicon quickicon-single col">
														<a href="<?php echo $free_button->linkbutton; ?>" target="<?php echo $free_button->targetlink; ?>">
															<div class="quickicon-icon d-flex align-items-end big">
																<i class="fas
																<?php if (!empty($free_button->iconbutton)){
																	echo $free_button->iconbutton;
																}else{
																		echo 'fa-edit';}
																		?> <?php echo $iconsize; ?>
																		"
																		<?php if (!empty($free_button->coloricon)){
																	echo 'style="color:'. $free_button->coloricon .';"';
																}else{
																}
																?>>
																	</i></div>
																		<div class="quickicon-name d-flex align-items-center">
																<?php echo JText::_($free_button->freebutton); ?>
															</div>
														</a>
													</li>

													<?php if ($free_button->displayline) { ?>
														<hr class="my-0" />
													<?php } ?>

												<?php } //foreach freebuttons ?>

											</ul>
										</nav>

									</div>
								</div><!--/.row-->

								<?php echo HTMLHelper::_('uitab.endTab'); ?>

							<?php } //foreach list_freebuttons ?>

						<?php } //free_buttons ?>

					<?php } //displayfreetab ?>

				<?php echo HTMLHelper::_('uitab.endTabSet'); ?>

			</div><!--/.action-->

		<?php } //displaytabs ?>

	</div><!--/.topview-->

<?php } ?>


<?php if ($option == 'com_cpanel' AND !empty($view)) { ?>

	</div><!--/.collapseTopview-->

<?php } ?>
