<?php
/**
* @version 0.9.3 stable $Id: default.php yannick berges
* @package Joomla
* @subpackage FLEXIcontent
* @copyright (C) 2016 Berges Yannick - www.com3elles.com
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

JHtml::_('bootstrap.tooltip');
JHTML::_('behavior.modal');
$document = JFactory::getDocument();
$document->addStyleSheet("./modules/mod_flexiadmin/assets/css/style.css",'text/css',"screen");


//module config
$hiddefeatured       = $params->get('hiddefeatured', '1' );
$hiddepublished      = $params->get('hiddepublished', '1' );
$hiddeunpublished    = $params->get('hiddeunpblished', '1' );
$hiddearchived       = $params->get('hiddearchived', '1' );
$hiddeyouritem       = $params->get('hiddeyouritem', '1' );
$hiddetrashed        = $params->get('hiddetrashed', '1' );
$actionsloglist	     = $params->get('actionsloglist', '1' );
$column              = $params->get('column', '4' );
$displaycustomtab    = $params->get('displaycustomtab', '1' );
$displaycreattab     = $params->get('displaycreattab', '1' );
$displaymanagetab    = $params->get('displaymanagetab', '1' );
$displayadmintab     = $params->get('displayadmintab', '1' );
$displayfreetab      = $params->get('displayfreetab', '1' );
$displayconfigmodule = $params->get('displayconfigmodule', '1' );
$forceheightblock    = $params->get('forceheightblock', '' );
$displaycustomtext   = $params->get('displaycustomtext','');
$customtext          = $params->get('customtext','');
$displayinfosystem   = $params->get('displayinfosystem','1');

//customtab
$nametab = $params->get('nametab', 'JOOMLA_ADMIN_CUSTOM_TAB_NAME' );

//Get Buttom Sections
$hiddebuttonmanageitems      = $params->get('hiddebuttonmanageitems'     , '1');
$hiddebuttonmanagecategories = $params->get('hiddebuttonmanagecategories', '1');
$hiddebuttonmanagetags       = $params->get('hiddebuttonmanagetags'      , '1');
$hiddebuttonmanageauthors    = $params->get('hiddebuttonmanageauthors'   , '1');
$hiddebuttonmanagegroups     = $params->get('hiddebuttonmanagegroups'    , '1');
$hiddebuttonmanagefiles      = $params->get('hiddebuttonmanagefiles'     , '1');
$hiddebuttonprivacy         = $params->get('hiddebuttonprivacy'        , '1');
$hiddebuttonlogs            = $params->get('hiddebuttonlogs'       , '1');
$hiddebuttonmanagefieldsarticle            = $params->get('hiddebuttonmanagefieldsarticle'           , '1');
$hiddebuttonmanagefieldsuser           = $params->get('hiddebuttonmanagefieldsusers'           , '1');
$hiddebuttonadditem          = $params->get('hiddebuttonadditem'         , '1');
$hiddebuttonaddcategory      = $params->get('hiddebuttonaddcategory'     , '1');
$hiddebuttonaddtag           = $params->get('hiddebuttonaddtag'          , '1');
$hiddebuttonadduser          = $params->get('hiddebuttonadduser'         , '1');
$hiddebuttonaddgroup         = $params->get('hiddebuttonaddgroup'        , '1');
$hiddebuttonadmin        = $params->get('hiddebuttonadmin'        , '1');

//freetab
$freenametab = $params->get('freenametab', 'JOOMLA_ADMIN_FREE_TAB_NAME' );

//
$user = JFactory::getUser();


jimport( 'joomla.application.component.controller' );
?>


<div class="row-fluid">

<?php if ($displayinfosystem || $displayconfigmodule ) : ?>
	<div class="info-bar">
	<ul class="breadcrumb">
		<?php if ($displayinfosystem) : ?>
	<?php foreach ($systme_buttons as $sys_buttons) :?>
				<?php //echo '<pre>' ,print_r($sys_buttons),'</pre>';?>
		<?php foreach ($sys_buttons as $sys_button) :?>
			<li id="<?php echo $sys_button['id']; ?>" class="list-group-item">
				<a href="<?php echo $sys_button['link']; ?>">
					<span class="<?php echo $sys_button['icon_class']; ?>" aria-hidden="true"></span> <span class="j-links-link"><?php echo $sys_button['text']; ?></span>
				</a>
					<span class="divider">|</span>
				</li>
			<?php endforeach; ?>
	<?php endforeach; ?>
	<?php endif; ?>
		<?php if ($displayconfigmodule) : ?>
	<li>
		<a href="index.php?option=com_modules&task=module.edit&id=<?php echo $module->id;?>">
				<span class="icon-small icon-options" aria-hidden="true"></span><span class="j-links-link"><?php echo JText::_('JOOMLA_ADMIN_DISPLAY_CONFIG_MODULE_TEXT'); ?></span>
		</a>
	</li>
			<?php endif; ?>
	</ul>
	</div>
	<?php endif; ?>

            <?php if ($displaycustomtext) : ?>
                <div class="modulemessage span12">
                    <?php echo $customtext; ?>
                </div>
    <?php endif; ?>



<?php if ($displaycustomtab || $displaycreattab || $displaymanagetab || $displayadmintab || $displayfreetab) : ?>
    <div class="action span12">

	<ul class="nav nav-tabs" role="tablist" id="myTab">
	<?php if ($displaycustomtab) : ?><li class=""><a href="#custom<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_($nametab); ?></a></li> <?php endif; ?>
	<?php if ($displaycreattab) : ?><li class=""><a href="#create<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_('JOOMLA_ADMIN_TAB_CREATE_D'); ?></a></li>  <?php endif; ?>
	<?php if ($displaymanagetab) : ?><li class=""><a href="#manage<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_('JOOMLA_ADMIN_TAB_MANAGE_D'); ?></a></li>  <?php endif; ?>
	<?php if ($displayadmintab) : ?><li class=""><a href="#admin<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_('JOOMLA_ADMIN_TAB_ADMIN_D'); ?></a></li>  <?php endif; ?>
	<?php if ($displayfreetab) : ?><li class=""><a href="#free<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_($freenametab); ?></a></li> <?php endif; ?>
	</ul>

		<div class="tab-content">
				<?php if ($displaycustomtab) : ?>
					<div class="tab-pane fade in active" id="custom<?php echo $module->id;?>">
                  <?php
								$list_buttons = $params->get('add_button');
								if ($list_buttons): ?>
              <?php foreach( $list_buttons as $list_buttons_idx => $add_button ) :?>

                 <a href="index.php?option=com_content&task=article.add&filter_category_id=<?php //echo $add_button->catid; ?>&filter[language]=<?php echo $add_button->button_lang; ?>" >
                          <button type="button" class="btn btn-default btn-lg itemlist">
                             <i class="icon-large icon-plus"></i><br/>
                          <?php echo JText::_($add_button->button_name); ?>
                          </button>
                    </a>
							<?php if ($add_button->displayline) : ?><hr /><?php endif; ?>
              <?php endforeach; ?>
							<?php endif; ?>
              <?php $list_catbuttons = $params->get('add_cat_button');
							if ($list_catbuttons): ?>
              <?php foreach( $list_catbuttons as $list_catbuttons_idx => $cat_button ) :?>

              <a href="index.php?option=com_flexicontent&view=items&filter_category_id=<?php //echo $cat_button->catid; ?>&filter[language]=<?php echo $cat_button->button_lang; ?>" >
                    <button type="button" class="btn btn-default btn-lg itemlist">
                       <i class="icon-large icon-list"></i><br/>
                    <?php echo JText::_($cat_button->namecatfilter); ?>
                    </button>
              </a>
<?php if ($cat_button->displayline) : ?><hr /><?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
              <?php $list_edititembuttons = $params->get('edit_item_button');
							if ($list_edititembuttons): ?>
              <?php foreach( $list_edititembuttons as $list_edititembuttons_idx => $edit_item_button ) :?>

              <a href="index.php?option=com_flexicontent&task=items.edit&cid[]=<?php echo $edit_item_button->itemid; ?>" >
                    <button type="button" class="btn btn-default btn-lg itemlist">
                       <i class="icon-large icon-pencil"></i><br/>
                    <?php echo JText::_($edit_item_button->nameitemedit); ?>
                    </button>
              </a>
<?php if ($edit_item_button->displayline) : ?><hr /><?php endif; ?>
              <?php endforeach; ?>
							<?php endif; ?>
					</div>
					<?php endif; ?>
										<?php if ($displaycreattab) : ?>
										<div class="tab-pane fade" id="create<?php echo $module->id;?>">
										<?php if($hiddebuttonadditem): ?>
											<a href="index.php?option=com_content&task=article.add">
													<button type="button" class="btn btn-default btn-lg itemlist">
														<i class="icon-large icon-file-plus"></i><br/>
													<?php echo JText::_( 'JOOMLA_ADMIN_ADDITEM' ); ?>
													</button>
											</a>
											<?php endif; ?>
											<?php if($hiddebuttonaddcategory): ?>
											<a href="index.php?option=com_categories&task=category.add&extension=com_content">
												<button type="button" class="btn btn-default btn-lg itemlist">
												<i class="icon-large icon-list"></i><br/>
												<?php echo JText::_( 'JOOMLA_ADMIN_ADDCATEGORY' ); ?>
												</button>
											</a>
											<?php endif; ?>
											<?php if($hiddebuttonaddtag): ?>
											<a href="index.php?option=com_tags&view=tag&task=tag.add">
												<button type="button" class="btn btn-default btn-lg itemlist">
												<i class="icon-large icon-tag"></i><br/>
												<?php echo JText::_( 'JOOMLA_ADMIN_ADDTAG' ); ?>
												</button>
											</a>
											<?php endif; ?>
											<?php if($hiddebuttonadduser): ?>
											<a href="index.php?option=com_users&task=user.add">
												<button type="button" class="btn btn-default btn-lg itemlist">
												<i class="icon-large icon-user"></i><br/>
												<?php echo JText::_( 'JOOMLA_ADMIN_ADDAUTHOR' ); ?>
												</button>
											</a>
											<?php endif; ?>
											<?php if($hiddebuttonaddgroup): ?>
											<a href="index.php?option=com_users&task=group.add">
												<button type="button" class="btn btn-default btn-lg itemlist">
												<i class="icon-large icon-users"></i><br/>
												<?php echo JText::_( 'JOOMLA_ADMIN_ADDGROUPS' ); ?>
												</button>
											</a>
											<?php endif; ?>

										</div>
										<?php endif; ?>
										<?php if ($displaymanagetab) : ?>
										<div class="tab-pane fade" id="manage<?php echo $module->id;?>">
											<?php if($hiddebuttonmanageitems): ?>
												<a href="index.php?option=com_flexicontent&view=items">
													<button type="button" class="btn btn-default btn-lg itemlist">
														<i class="icon-large icon-file-2"></i><br/>
														<?php echo JText::_( 'JOOMLA_ADMIN_ITEMLIST' ); ?>
													</button>
												</a>
											<?php endif;?>
											<?php if($hiddebuttonmanagecategories): ?>
												<a href="index.php?option=com_categories&extension=com_content">
													<button type="button" class="btn btn-default btn-lg itemlist">
														<i class="icon-large icon-list"></i><br/>
														<?php echo JText::_( 'JOOMLA_ADMIN_CATLIST' ); ?>
													</button>
												</a>
												<?php endif; ?>
											<?php if($hiddebuttonmanagetags): ?>
								<a href="index.php?option=com_tags">
									<button type="button" class="btn btn-default btn-lg itemlist">
										<i class="icon-large icon-tag"></i><br/>
										<?php echo JText::_( 'JOOMLA_ADMIN_TAGLIST' ); ?>
									</button>
								</a>
								<?php endif; ?>
								<?php if($hiddebuttonmanageauthors): ?>
								<a href="index.php?option=com_users&view=users">
									<button type="button" class="btn btn-default btn-lg itemlist">
										<i class="icon-large icon-user"></i><br/>
										<?php echo JText::_( 'JOOMLA_ADMIN_AUTHORLIST' ); ?>
									</button>
								</a>
								<?php endif; ?>

								<?php if($hiddebuttonmanagegroups): ?>
								<a href="index.php?option=com_users&view=groups">
									<button type="button" class="btn btn-default btn-lg itemlist">
										<i class="icon-large icon-users"></i><br/>
										<?php echo JText::_( 'JOOMLA_ADMIN_GROUPSLIST' ); ?>
									</button>
								</a>
								<?php endif; ?>

								<?php if($hiddebuttonmanagefiles): ?>
								<a href="index.php?option=com_media">
									<button type="button" class="btn btn-default btn-lg itemlist">
										<i class="icon-large icon-upload"></i><br/>
										<?php echo JText::_( 'JOOMLA_ADMIN_FILEMANAGER' ); ?>
									</button>
								</a>
								<?php endif; ?>

										</div>
										<?php endif; ?>
								<?php if ($displayadmintab) : ?>
			<!-- start admin tabs-->
			<div class="tab-pane fade" id="admin<?php echo $module->id;?>">
										<?php if($hiddebuttonprivacy): ?>
										<a href="index.php?option=com_privacy">
											<button type="button" class="btn btn-default btn-lg itemlist">
												<i class="icon-large icon-lock"></i><br/>
												<?php echo JText::_( 'JOOMLA_ADMIN_PRIVACY' ); ?>
											</button>
										</a>
										<?php endif; ?>
									<?php if($hiddebuttonlogs): ?>
									<a href="index.php?option=com_actionlogs">
										<button type="button" class="btn btn-default btn-lg itemlist">
										<i class="icon-large icon-list-2"></i><br/>
										<?php echo JText::_( 'JOOMLA_ADMIN_LOGS' ); ?>
										</button>
									</a>
									<?php endif; ?>

                  <?php if($hiddebuttonprivacy || $hiddebuttonlogs): ?>
                  <hr>
                  <?php endif; ?>
									<?php if($hiddebuttonmanagefieldsuser): ?>
									<a href="index.php?option=com_fields&context=com_users.user">
										<button type="button" class="btn btn-default btn-lg itemlist">
											<i class="icon-large icon-user"></i><br/>
											<?php echo JText::_( 'JOOMLA_ADMIN_FIELDLIST_USER' ); ?>
										</button>
									</a>
									<?php endif; ?>
									<?php if($hiddebuttonmanagefieldsarticle): ?>
									<a href="index.php?option=com_fields&context=com_content.article">
										<button type="button" class="btn btn-default btn-lg itemlist">
										<i class="icon-large icon-stack"></i><br/>
										<?php echo JText::_( 'JOOMLA_ADMIN_FIELDLIST_ARTICLE' ); ?>
										</button>
									</a>
									<?php endif; ?>
						<?php if($hiddebuttonadmin): ?>
					<a href="index.php?option=com_config">
						<button type="button" class="btn btn-default btn-lg itemlist">
							<i class="icon-large icon-options"></i><br/>
						<?php echo JText::_( 'JOOMLA_ADMIN_GEN' ); ?>
						</button>
					</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<!-- end of admin tabs-->
			<?php if ($displayfreetab) : ?>
			<div class="tab-pane fade" id="free<?php echo $module->id;?>">

            <?php $list_freebuttons = $params->get('free_button');
						if ($list_freebuttons): ?>
            <?php foreach( $list_freebuttons as $list_freebuttons_idx => $free_button ) :?>

            <a href="<?php echo $free_button->linkbutton; ?>" >
                  <button type="button" class="btn btn-default btn-lg itemlist">
                     <i class="icon-large <?php echo $free_button->iconbutton; ?>"></i><br/>
                  <?php echo JText::_($free_button->freebutton); ?>
                  </button>
            </a>
<?php if ($free_button->displayline) : ?><hr /><?php endif; ?>
         <?php endforeach; ?>
				 <?php endif; ?>
			</div>
			<?php endif; ?>

 		</div>
		<?php endif; ?>
		<!-- end tabs -->


	</div>
	<!-- end tabs zone -->
</div>
</div>
</div>


<div class="row-fluid">

<?php if ($hiddefeatured) : ?>
    <div class="block featured well well-small span<?php echo $column; ?> ">
	<h3 class="module-title nav-header"><i class="icon-large icon-featured"></i> <?php echo JText::_( 'JOOMLA_ADMIN_FEATURED' ); ?></h3>

	<?php $show_all_link = 'index.php?option=com_content&amp;view=featured'; ?>
	<div style='text-align:right;'>
		<a href='<?php echo $show_all_link ?>' class='adminlink'>
		<?php
		echo JText::_( 'JOOMLA_ADMIN_ALL' );
		echo "</a></div>";	?>
			<div class="row-striped" style="height:<?php echo $forceheightblock; ?>">
				<?php foreach ($listFeatured as $itemFeatured) : ?>
				<div class="row-fluid">
					<div class="span12">
						<div class="span6">
							<a href="<?php echo $itemFeatured->link; ?>"><?php echo $itemFeatured->title; ?>
							<i class="icon-large icon-edit"></i></a>
						</div>
						<div class="span3" style="margin-left: 0 !important;">
							<span class="small">
							<i class="icon-user"></i>
							<small class="hasTooltip" title="" data-original-title="<?php echo JHtml::tooltipText('JOOMLA_ADMIN_MODIFIED_BY')." ". $itemFeatured->name; ?>"><?php echo $itemFeatured->name;?> </small>
							</span>
						</div>
						<div class="span3">
							<span class="small">
							<i class="icon-calendar"></i> <?php echo JHtml::date($itemFeatured->modified, 'd M Y'); ?>
							</span>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
	</div>
	<?php endif; ?>
<?php if ($hiddepublished) : ?>
    <div class="block pending well well-small span<?php echo $column; ?> ">
	<h3 class="module-title nav-header"><i class="icon-large icon-thumbs-down"></i> <?php echo JText::_( 'JOOMLA_ADMIN_PUBLISHED' ); ?></h3>

	<?php $show_all_link = 'index.php?option=com_content&amp;view=articles&amp;filter[published]=1'; ?>
	<div style='text-align:right;'>
		<a href='<?php echo $show_all_link ?>' class='adminlink'>
		<?php
		echo JText::_( 'JOOMLA_ADMIN_ALL' );
		echo "</a></div>";	?>
			<div class="row-striped" style="height:<?php echo $forceheightblock; ?>">
				<?php foreach ($listPublished as $itemPublished) : ?>
				<div class="row-fluid">
					<div class="span12">
						<div class="span6">
							<a href="<?php echo $itemPublished->link; ?>"><?php echo $itemPublished->title; ?>
							<i class="icon-large icon-edit"></i></a>
						</div>
						<div class="span3" style="margin-left: 0 !important;">
							<span class="small">
							<i class="icon-user"></i>
							<small class="hasTooltip" title="" data-original-title="<?php echo JHtml::tooltipText('JOOMLA_ADMIN_MODIFIED_BY')." ". $itemPublished->name; ?>"><?php echo $itemPublished->name;?> </small>
							</span>
						</div>
						<div class="span3">
							<span class="small">
							<i class="icon-calendar"></i> <?php echo JHtml::date($itemPublished->modified, 'd M Y'); ?>
							</span>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
	</div>
	<?php endif; ?>

	<?php if ($hiddeunpublished) : ?>

	<div class="block revised well well-small span<?php echo $column; ?> ">
		<h3 class="module-title nav-header"><i class="icon-large icon-thumbs-up"></i> <?php echo JText::_( 'JOOMLA_ADMIN_UNPUBLISHED' ); ?></h3>
		<?php $show_all_link = 'index.php?option=com_content&amp;view=articles&amp;filter[published]=0'; ?>
		<div style='text-align:right;'>
		<a href='<?php echo $show_all_link ?>' class='adminlink'>
		<?php
		echo JText::_( 'JOOMLA_ADMIN_ALL' );
		echo "</a></div>";	?>
			<div class="row-striped" style="height:<?php echo $forceheightblock; ?>">
				<?php foreach ($listUnpublished as $itemUnpublished) : ?>
				<div class="row-fluid">
					<div class="span12">
						<div class="span6">
							<a href="<?php echo $itemUnpublished->link; ?>"><?php echo $itemUnpublished->title; ?>
							<i class="icon-large icon-edit"></i></a>
						</div>
						<div class="span3" style="margin-left: 0 !important;">
							<span class="small">
							<small class="hasTooltip" title="" data-original-title="<?php echo JHtml::tooltipText('JOOMLA_ADMIN_MODIFIED_BY')." ". $itemUnpublished->name; ?>"><i class="icon-user"></i> <?php echo $itemUnpublished->name; ?></small>
							</span>
						</div>
						<div class="span3">
							<span class="small">
							<i class="icon-calendar"></i> <?php echo JHtml::date($itemUnpublished->modified, 'd M Y'); ?>
							</span>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
	</div>
<?php endif; ?>
<?php if ($hiddearchived) : ?>
	<div class="block inprogress well well-small span<?php echo $column; ?> ">
		<h3 class="module-title nav-header"><i class="icon-large icon-checkin"></i> <?php echo JText::_( 'JOOMLA_ADMIN_ARCHIVED' ); ?></h3>
		<?php		$show_all_link = 'index.php?option=com_content&amp;view=articles&amp;filter[published]=2'; ?>
		<div style='text-align:right;'>
		<a href='<?php echo $show_all_link ?>' class='adminlink'>
		<?php
		echo JText::_( 'JOOMLA_ADMIN_ALL' );
		echo "</a></div>";	?>
			<div class="row-striped" style="height:<?php echo $forceheightblock; ?>">
				<?php foreach ($listArchived as $itemArchived) : ?>
				<div class="row-fluid">
					<div class="span12">
						<div class="span6">
							<a href="<?php echo $itemArchived->link; ?>"><?php echo $itemArchived->title; ?>
							<i class="icon-large icon-edit"></i></a>
						</div>
						<div class="span3" style="margin-left: 0 !important;">
							<span class="small">
							<i class="icon-user"></i>
							<small class="hasTooltip" title="" data-original-title="<?php echo JHtml::tooltipText('JOOMLA_ADMIN_MODIFIED_BY')." ". $itemArchived->name; ?>"><?php echo $itemArchived->name;?> </small>
							</span>
						</div>
						<div class="span3">
							<span class="small"> <i class="icon-calendar"></i> <?php echo JHtml::date($itemArchived->modified, 'd M Y'); ?></span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
	</div>
<?php endif; ?>
<?php if ($hiddeyouritem) : ?>
	<div class="block youritems well well-small span<?php echo $column; ?>">
		<?php $user = JFactory::getUser();		?>
		<h3 class="module-title nav-header">
		<i class="icon-large icon-user"></i>
		<?php echo JText::_( 'JOOMLA_YOUR_ITEM' ); ?> : <?php echo $user->name; ?></h3>
		<?php		$show_all_link = 'index.php?option=com_content&amp;view=articles&amp;filter[author_id]='.$user->id; //TODO add user id?>
		<div style='text-align:right;'>
		<a href='<?php echo $show_all_link ?>' class='adminlink'>
		<?php
		echo JText::_( 'JOOMLA_ADMIN_ALL' );
		echo "</a></div>";	?>
		<div class="row-striped" style="height:<?php echo $forceheightblock; ?>">
			<?php foreach ($listUseritem as $itemUseritem) : ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="span6">
						<a href="<?php echo $itemUseritem->link; ?>"><?php echo $itemUseritem->title; ?>
						<i class="icon-large icon-edit"></i></a>
					</div>
					<div class="span3" style="margin-left: 0 !important;">
						<span class="small">
							<i class="icon-user"></i>

							<small class="hasTooltip" title="" data-original-title="<?php echo JHtml::tooltipText('JOOMLA_ADMIN_CREATED_BY')." ". $user->name; ?>"><?php echo $user->name; ?> </small>
						</span>
					</div>
					<div class="span3">
					<?php echo $itemUseritem->state;?>
					<span class="small">
						<i class="icon-calendar"></i> <?php echo JHtml::date($itemUseritem->modified, 'd M Y'); ?>
					</span>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>
<?php if ($hiddetrashed) : ?>
	<div class="block trashed well well-small span<?php echo $column; ?>">
	<h3 class="module-title nav-header"><i class="icon-large icon-trash"></i>
	<?php echo JText::_( 'JOOMLA_ADMIN_TRASHED' ); ?></h3>
	<?php //TODO filtrage trashed
	$show_all_link = 'index.php?option=com_content&amp;view=articles&amp;filter[published]=-2'; ?>
		<div style='text-align:right;'>
		<a href='<?php echo $show_all_link ?>' class='adminlink'>
		<?php
		echo JText::_( 'JOOMLA_ADMIN_ALL' );
		echo "</a></div>";	?>
      <div class="row-striped" style="height:<?php echo $forceheightblock; ?>">
         <?php foreach ($listTrashed as $itemTrashed) : ?>
         <div class="row-fluid">
            <div class="span12">
               <div class="span6">
                  <a href="<?php echo $itemTrashed->link; ?>"><?php echo $itemTrashed->title; ?>
                  <i class="icon-large icon-edit"></i></a>
               </div>
               <div class="span3" style="margin-left: 0 !important;">
                  <span class="small">
                     <i class="icon-user"></i>

                     <small class="hasTooltip" title="" data-original-title="<?php echo JHtml::tooltipText('JOOMLA_ADMIN_CREATED_BY')." ". $user->name; ?>"><?php echo $user->name; ?> </small>
                  </span>
               </div>
               <div class="span3">
               <?php //echo $itemTrashed->state;?>
               <span class="small">
                  <i class="icon-calendar"></i> <?php echo JHtml::date($itemTrashed->modified, 'd M Y'); ?>
               </span>
               </div>
            </div>
         </div>
         <?php endforeach; ?>
   </div>
	</div>
<?php endif; ?>

<?php if($actionsloglist) : ?>
<div class="block youritems well well-small span<?php echo $column; ?>">
   <h3 class="module-title nav-header">
   <i class="icon-large icon-user"></i>
   <?php echo JText::_('JOOMLA_ADMIN_ACTIONLOGS_BLOCK_NAME'); ?> : </h3>
   <?php		$show_all_link = 'index.php?option=com_actionlogs'; ?>
   <div style='text-align:right;'>
   <a href='<?php echo $show_all_link ?>' class='adminlink'>
   <?php
   echo JText::_( 'JOOMLA_ADMIN_ALL' );
   echo "</a></div>";	?>
<div class="row-striped">
	<?php if (count($actionlist)) : ?>
		<?php foreach ($actionlist as $i => $item) : ?>
			<div class="row-fluid">
				<div class="span8 truncate">
					<?php echo $item->message; ?>
				</div>
				<div class="span4">
					<div class="small pull-right hasTooltip" title="<?php echo JHtml::_('tooltipText', 'JGLOBAL_FIELD_CREATED_LABEL'); ?>">
						<span class="icon-calendar" aria-hidden="true"></span> <?php echo JHtml::_('date', $item->log_date, JText::_('DATE_FORMAT_LC5')); ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php else : ?>
		<div class="row-fluid">
			<div class="span12">
				<div class="alert"><?php echo JText::_('MOD_LATEST_ACTIONS_NO_MATCHING_RESULTS');?></div>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php endif; ?>



<?php if($listCustomlist) : ?>
<?php
foreach( $listCustomlist as $listCustomlist_idx => $customblock ) :?>

<div class="block youritems well well-small span<?php echo $column; ?>">
   <h3 class="module-title nav-header">
   <i class="icon-large icon-user"></i>
   <?php echo JText::_($customblock->nameblockcustom); ?> : </h3>
   <?php		$show_all_link = 'index.php?option=com_content&filter_category_id='.$customblock->catidlist; ?>
   <div style='text-align:right;'>
   <a href='<?php echo $show_all_link ?>' class='adminlink'>
   <?php
   echo JText::_( 'JOOMLA_ADMIN_ALL' );
   echo "</a></div>";	?>
   <div class="row-striped" style="height:<?php echo $forceheightblock; ?>">
      <table class="table table-hover">
         <thead>
            <tr>
            <th><?php echo JText::_( 'JOOMLA_ADMIN_TITLE' ); ?></th>
            <?php if ($customblock->displautblock) : ?><th><?php echo JText::_( 'JOOMLA_ADMIN_AUTHOR' ); ?></th><?php endif; ?>
            <?php
            if(!empty($customblock->extrafieldlist)) {
                      //$customblock= $customblock->listitems;
               $item = $itemmodel->getItem($customblock->listitems->id, $check_view_access=false);
               $items = array(&$item);
                 // Get fields values from the DB,
               FlexicontentFields::getFields($items);
                $arrayExtrafield = explode(',', $customblock->extrafieldlist);
               if(isset($arrayExtrafield[0])) {
               foreach ($arrayExtrafield as $extrafield){
                  FlexicontentFields::getFieldDisplay($item, $extrafield);
                  $label= $item->fields[$extrafield]->label;
                  echo '<th>';
                  echo JText::_($label);
                  echo '</th>';
               }
             }
           }
            ?>
            <?php if ($customblock->displdateblock) : ?><th><?php echo JText::_( 'JOOMLA_ADMIN_DATE' ); ?></th><?php endif; ?>
            </tr>
         </thead>

         <tbody>
         <?php /*foreach ($listCustomlist as $listCustomlist_idx => $customblock) : */?>
            <tr>
            <td>
               <a href="<?php echo $customblock->listitems->link; ?>"><?php echo $customblock->listitems->title; ?>
               <i class="icon-large icon-edit"></i></a>
            </td>
            <?php if ($customblock->displautblock) : ?><td>
               <span class="small">
                  <i class="icon-user"></i>

                  <small class="hasTooltip" title="" data-original-title="<?php echo JHtml::tooltipText('JOOMLA_ADMIN_MODIFIED_BY')." ". $customblock->listitems->name; ?>"><?php echo $customblock->listitems->name;?> </small>
               </span>
            </td>
            <?php endif; ?>
            <?php
            if(!empty($customblock->extrafieldlist)) {
               $item = $itemmodel->getItem($customblock->listitems->id, $check_view_access=false);
               $items = array(&$item);
               $arrayExtrafield = explode(',', $customblock->extrafieldlist);
               if(isset($arrayExtrafield[0])) {
               foreach ($arrayExtrafield as $extrafield){
                 FlexicontentFields::getFieldDisplay($item, $extrafield);
                  $value= $item->fields[$extrafield]->display;
                  echo '<td>';
                  echo $value;
                  echo '</td>';
               }
             }
           }
            ?>
            <?php if ($customblock->displdateblock) : ?>
            <td>
            <span class="small">
               <i class="icon-calendar"></i> <?php echo JHtml::date($customblock->listitems->modified, 'd M Y'); ?>
            </span>
            </td>
            <?php endif; ?>
         </tr>
      <?php/* endforeach; */?>
                  </tbody>
      </table>
</div>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
</div>


<script  type="text/javascript">
jQuery(document).ready(function($){
$('#myTab a:first').tab('show');
});
</script>
