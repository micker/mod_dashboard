<?php
/**
 * @version       0.5.0 stable $Id: iconview.php yannick berges
 * @package       Joomla
 * @copyright (C) 2018 Berges Yannick - www.com3elles.com
 * @license       GNU/GPL v2
 *
 * special thanks to my master Marc Studer
 *
 * JOOMLA Admin module by Com3elles is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 **/

/**
 * modified lightweight view specically to suit the new Joomla4 Atum Administrator (dashboard) template
 * - ONLY utilises the "custommessage" & "tabbed" sections of mod_dashboard
 * - ONLY designed for display in the "icon" position
 *
 * @RussW (hotmango & thestyleguyz) : 9-Oct-2021
 */

//blocage des accés directs sur ce script
defined('_JEXEC') or die('Accès interdit');

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$document = JFactory::getDocument();
$app      = JFactory::getApplication();
$user     = JFactory::getUser();
$userId   = $user->get('id');

JHtml::_('stylesheet', 'media/mod_dashboard/css/style.css');
JHtml::_('stylesheet', 'media/mod_dashboard/css/iconview.css');
JHtml::_('stylesheet', 'media/mod_dashboard/css/bootstrap-iconpicker.css');

$force_fullwidth = $params->get('force_fullwidth', '1');
if ($force_fullwidth)
{

	$style = '.card-columns {
		grid-template-columns: 1fr;
	}';
	$document->addStyleDeclaration($style);

}

//module config
$hiddefeatured     = $params->get('hiddefeatured', '1');
$hiddepublished    = $params->get('hiddepublished', '1');
$hiddeunpublished  = $params->get('hiddeunpublished', '1');
$hiddearchived     = $params->get('hiddearchived', '1');
$hiddeyouritem     = $params->get('hiddeyouritem', '1');
$hiddetrashed      = $params->get('hiddetrashed', '1');
$actionsloglist    = $params->get('actionsloglist', '1');
$column            = $params->get('column', '4');
$displaycustomtab  = $params->get('displaycustomtab', '1');
$displaycreattab   = $params->get('displaycreattab', '1');
$displaymanagetab  = $params->get('displaymanagetab', '1');
$displayadmintab   = $params->get('displayadmintab', '1');
$displayfreetab    = $params->get('displayfreetab', '1');
$forceheightblock  = $params->get('forceheightblock', '');
$displaycustomtext = $params->get('displaycustomtext', '');
$customtext        = $params->get('customtext', '');
$featurewidth      = $params->get('featuredwidth', '48');
$publishedwidth    = $params->get('publishedwidth', '48');
$unpublishedwidth  = $params->get('unpublishedwidth', '48');
$youritemwidth     = $params->get('youritemwidth', '48');
$trashedwidth      = $params->get('trashedlogwidth', '48');
$archivedwidth     = $params->get('archivedwidth', '48');
$actionslogwidth   = $params->get('actionslogwidth', '48');
$iconsize          = $params->get('iconsize', 'fa-2x');

$nametab     = $params->get('nametab', 'MOD_DASHBOARD_CUSTOM_TAB_NAME'); // customtab name
$freenametab = $params->get('freenametab', 'MOD_DASHBOARD_FREE_TAB_NAME'); // freetab name

//Get Buttom Sections
$hiddebuttonmanageitems         = $params->get('hiddebuttonmanageitems', '1');
$hiddebuttonmanagecategories    = $params->get('hiddebuttonmanagecategories', '1');
$hiddebuttonmanagetags          = $params->get('hiddebuttonmanagetags', '1');
$hiddebuttonmanageauthors       = $params->get('hiddebuttonmanageauthors', '1');
$hiddebuttonmanagegroups        = $params->get('hiddebuttonmanagegroups', '1');
$hiddebuttonmanagefiles         = $params->get('hiddebuttonmanagefiles', '1');
$hiddebuttonprivacy             = $params->get('hiddebuttonprivacy', '1');
$hiddebuttonlogs                = $params->get('hiddebuttonlogs', '1');
$hiddebuttonmanagefieldsarticle = $params->get('hiddebuttonmanagefieldsarticle', '1');
$hiddebuttonmanagefieldsuser    = $params->get('hiddebuttonmanagefieldsusers', '1');
$hiddebuttonadditem             = $params->get('hiddebuttonadditem', '1');
$hiddebuttonaddcategory         = $params->get('hiddebuttonaddcategory', '1');
$hiddebuttonaddtag              = $params->get('hiddebuttonaddtag', '1');
$hiddebuttonadduser             = $params->get('hiddebuttonadduser', '1');
$hiddebuttonaddgroup            = $params->get('hiddebuttonaddgroup', '1');
$hiddebuttonadmin               = $params->get('hiddebuttonadmin', '1');

$displayauthoronly = $params->get('displayauthoronly', '0');

jimport('joomla.application.component.controller');
?>

<div class="iconview <?php echo $moduleclass_sfx; ?>">

	<?php if ($displaycustomtext) : ?>
        <div class="headerblock my-0">

            <div class="modulemessage pt-0">
				<?php echo $customtext; ?>
            </div>

        </div><!--/.headerblock-->
	<?php endif; ?>


	<?php if ($displaycustomtab or $displaycreattab or $displaymanagetab or $displayadmintab or $displayfreetab) : ?>

        <div class="action my-0">

			<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'general')); ?>

			<?php if ($displaycustomtab) : ?>

				<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'custom', Text::_($nametab)); ?>

                <div class="row">
                    <div class="col-lg-12">

                        <nav class="quick-icons dashboard" aria-label="Quick custom link">
                            <ul class="nav flex-wrap">
								<?php $list_buttons = $params->get('add_button'); ?>
								<?php if ($list_buttons) : ?>

									<?php foreach ($list_buttons as $list_buttons_idx => $add_button) : ?>

                                        <li class="quickicon quickicon-single col ">
                                            <a href="index.php?option=com_content&view=article&layout=edit&catid=<?php echo $add_button->catid; ?>&language=<?php echo $add_button->button_lang; ?>"
                                               target="<?php echo $add_button->targetlink; ?>">
                                                <div class="quickicon-icon d-flex align-items-end big">
													<?php
													$icon      = !empty($add_button->iconbutton) ? $add_button->iconbutton : 'fa-plus-circle';
													$iconcolor = !empty($add_button->coloricon) ? 'color:' . $add_button->coloricon . ';' : '';
													?>
                                                    <i class="fas <?php echo $icon . ' ' . $iconsize; ?>"
                                                       style="<?php echo $iconcolor; ?>"></i>
                                                </div>
                                                <div class="quickicon-name d-flex align-items-center">
													<?php echo JText::_($add_button->button_name); ?>
                                                </div>
                                            </a>
                                        </li>

										<?php if ($add_button->displayline) : ?>
                                            <hr class="my-0"/>
										<?php endif; ?>

									<?php endforeach; ?>

								<?php endif; // list_buttons ?>


								<?php $list_catbuttons = $params->get('add_cat_button'); ?>
								<?php if ($list_catbuttons) : ?>

									<?php foreach ($list_catbuttons as $list_catbuttons_idx => $cat_button) : ?>
										<?php $filter_byauthor = $cat_button->displayauthoronly == 1 ? '&amp;filter[author_id]=' . $user->id : ''; ?>

                                        <li class="quickicon quickicon-single col">
                                            <a href="index.php?option=com_content&view=articles&filter[category_id]=<?php echo $cat_button->catidlist; ?>&filter[language]=<?php echo $cat_button->button_lang; ?><?php echo $filter_byauthor; ?>"
                                               target="<?php echo $cat_button->targetlink; ?>">
                                                <div class="quickicon-icon d-flex align-items-end big">
													<?php
													$icon      = !empty($cat_button->iconbutton) ? $cat_button->iconbutton : 'fa-th-list';
													$iconcolor = !empty($cat_button->coloricon) ? 'color:' . $cat_button->coloricon . ';' : '';
													?>
                                                    <i class="fas <?php echo $icon . ' ' . $iconsize; ?>"
                                                       style="<?php $iconcolor; ?>"></i>
                                                </div>
                                                <div class="quickicon-name d-flex align-items-center">
													<?php echo JText::_($cat_button->namecatfilter); ?>
                                                </div>
                                            </a>
                                        </li>

										<?php if ($cat_button->displayline) : ?>
                                            <hr class="my-0"/>
										<?php endif; ?>

									<?php endforeach; // endforeach ?>

								<?php endif;  // list_catbuttons ?>


								<?php $list_edititembuttons = $params->get('edit_item_button'); ?>
								<?php if ($list_edititembuttons) : ?>

									<?php foreach ($list_edititembuttons as $list_edititembuttons_idx => $edit_item_button) : ?>

                                        <li class="quickicon quickicon-single col ">
                                            <a href="index.php?option=com_content&task=article.edit&id=<?php echo $edit_item_button->itemid; ?>">
                                                <div class="quickicon-icon d-flex align-items-end big">

													<?php
													$icon      = !empty($edit_item_button->iconbutton) ? $edit_item_button->iconbutton : 'fa-edit';
													$iconcolor = !empty($edit_item_button->coloricon) ? 'color:' . $edit_item_button->coloricon . ';' : '';
													?>
                                                    <i class="fas <?php echo $icon . ' ' . $iconsize; ?>"
                                                       style="<?php echo $iconcolor; ?>"></i>
                                                </div>
                                                <div class="quickicon-name d-flex align-items-center">
													<?php echo JText::_($edit_item_button->nameitemedit); ?>
                                                </div>
                                            </a>
                                        </li>

										<?php if ($edit_item_button->displayline) : ?>
                                            <hr class="my-0"/>
										<?php endif; ?>

									<?php endforeach; //endforeach ?>

								<?php endif; // list_edititembuttons ?>

                            </ul>
                        </nav>

                    </div>
                </div><!--/.row-->

				<?php echo HTMLHelper::_('uitab.endTab'); ?>

			<?php endif; //displaycustomtab ?>


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
												<?php echo JText::_('MOD_DASHBOARD_ADDITEM'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_ADDCATEGORY'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_ADDTAG'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_ADDAUTHOR'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_ADDGROUPS'); ?>
                                            </div>
                                        </a>
                                    </li>
								<?php endif; ?>

                            </ul>
                        </nav>

                    </div>
                </div><!--/.row-->

				<?php echo HTMLHelper::_('uitab.endTab'); ?>

			<?php endif; //displaycreattab ?>


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
												<?php echo JText::_('MOD_DASHBOARD_ITEMLIST'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_CATLIST'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_TAGLIST'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_AUTHORLIST'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_GROUPSLIST'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_FILEMANAGER'); ?>
                                            </div>
                                        </a>
                                    </li>
								<?php endif; ?>

                            </ul>
                        </nav>

                    </div>
                </div><!--/.row-->

				<?php echo HTMLHelper::_('uitab.endTab'); ?>

			<?php endif; //displaymanagetab ?>


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
												<?php echo JText::_('MOD_DASHBOARD_PRIVACY'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_LOGS'); ?>
                                            </div>
                                        </a>
                                    </li>
								<?php endif; ?>

								<?php if ($hiddebuttonprivacy or $hiddebuttonlogs) : ?>
                                    <!-- TODO -->
								<?php endif; ?>

								<?php if ($hiddebuttonmanagefieldsuser) : ?>
                                    <li class="quickicon quickicon-single col ">
                                        <a href="index.php?option=com_fields&context=com_users.user">
                                            <div class="quickicon-icon d-flex align-items-end big">
                                                <i class="fas fa-user <?php echo $iconsize; ?> "></i>
                                            </div>
                                            <div class="quickicon-name d-flex align-items-center">
												<?php echo JText::_('MOD_DASHBOARD_FIELDLIST_USER'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_FIELDLIST_ARTICLE'); ?>
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
												<?php echo JText::_('MOD_DASHBOARD_GEN'); ?>
                                            </div>
                                        </a>
                                    </li>
								<?php endif; ?>

                            </ul>
                        </nav>

                    </div>
                </div><!--/.row-->

				<?php echo HTMLHelper::_('uitab.endTab'); ?>

			<?php endif; //displayadmintab ?>


			<?php if ($displayfreetab) : ?>

				<?php $list_freebuttons = $params->get('free_button'); ?>
				<?php if ($list_freebuttons) : ?>

					<?php foreach ($list_freebuttons as $list_freebuttons_idx => $free_buttons) : ?>

						<?php $tabname = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/', '', $free_buttons->freenametab)); ?>
						<?php echo HTMLHelper::_('uitab.addTab', 'myTab', $tabname, Text::_($free_buttons->freenametab)); ?>

                        <div class="row">
                            <div class="col-lg-12">

                                <nav class="quick-icons dashboard" aria-label="Quick links creation">
                                    <ul class="nav flex-wrap">

										<?php foreach ($free_buttons->free_button as $free_button_idx => $free_button) : ?>

                                            <li class="quickicon quickicon-single col">
                                                <a href="<?php echo $free_button->linkbutton; ?>"
                                                   target="<?php echo $free_button->targetlink; ?>">
                                                    <div class="quickicon-icon d-flex align-items-end big">
														<?php
														$icon      = !empty($free_button->iconbutton) ? $free_button->iconbutton : 'fa-edit';
														$iconcolor = !empty($free_button->coloricon) ? 'color:' . $free_button->coloricon . ';' : '';
														?>
                                                        <i class="fas<?php echo $icon; ?> <?php echo $iconsize; ?>"
                                                           style="<?php echo $free_button->coloricon; ?>"></i>
                                                    </div>
                                                    <div class="quickicon-name d-flex align-items-center">
														<?php echo JText::_($free_button->freebutton); ?>
                                                    </div>
                                                </a>
                                            </li>

											<?php if ($free_button->displayline) : ?>
                                                <hr class="my-0"/>
											<?php endif; ?>

										<?php endforeach; //foreach freebuttons ?>

                                    </ul>
                                </nav>

                            </div>
                        </div><!--/.row-->

						<?php echo HTMLHelper::_('uitab.endTab'); ?>

					<?php endforeach; //foreach list_freebuttons ?>

				<?php endif; //free_buttons ?>

			<?php endif; //displayfreetab ?>

			<?php echo HTMLHelper::_('uitab.endTabSet'); ?>

        </div><!--/.action-->

	<?php endif; //displaytabs ?>

</div><!--/.iconview-->
