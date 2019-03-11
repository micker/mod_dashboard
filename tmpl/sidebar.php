<?php
/**
* @version 0.5.0 stable $Id: sidebar.php yannick berges
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

JHtml::_('bootstrap.tooltip');
JHTML::_('behavior.modal');
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base(true)."/modules/mod_joomadmin/assets/css/style.css",'text/css',"screen");

//module config
$hiddepending        = $params->get('hiddepending', '1' );
$hidderevised        = $params->get('hidderevised', '1' );
$hiddeinprogess      = $params->get('hiddeinprogess', '1' );
$hiddedraft          = $params->get('hiddedraft', '1' );
$hiddeyouritem       = $params->get('hiddeyouritem', '1' );
$hiddetrashed        = $params->get('hiddetrashed', '1' );
$column              = $params->get('column', '4' );
$displaycustomtab    = $params->get('displaycustomtab', '1' );
$displaycreattab     = $params->get('displaycreattab', '1' );
$displaymanagetab    = $params->get('displaymanagetab', '1' );
$displayadmintab     = $params->get('displayadmintab', '1' );
$displayconfigmodule = $params->get('displayconfigmodule', '1' );
$tabmodsidebar       = $params->get('tabmodsidebar', '0' );
$displayfreetab  = $params->get('displayfreetab', '0' );
$iconsize     = $params->get('iconsize','fa-2x');
$list_freebuttons = $params->get('free_button');


//customtab
$nametab = $params->get('nametab', 'MOD_DASHBOARD_CUSTOM_TAB_NAME' );


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
$freenametab = $params->get('freenametab', 'MOD_DASHBOARD_FREE_TAB_NAME' );

//
$user = JFactory::getUser();

jimport( 'joomla.application.component.controller' );
?>

<div class="row-fluid">
<?php if ($displaycustomtab || $displaycreattab || $displaymanagetab || $displayadmintab || $displayfreetab) : ?>
    <div class="sidebar-nav quick-icons">
	<?php if ($displayconfigmodule) : ?>
	<a href="index.php?option=com_modules&task=module.edit&id=<?php echo $module->id;?>" style="float:right;">
			<i class="icon-small icon-options"></i>

	</a>
	<?php endif; ?>

	<?php if ($tabmodsidebar) : ?>
	<ul class="nav nav-tabs" role="tablist" id="myTab2<?php echo $module->id;?>">
	<?php if ($displaycustomtab) : ?><li class="active"><a href="#custom<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_($nametab); ?></a></li> <?php endif; ?>
	<?php if ($displaycreattab) : ?><li class=""><a href="#create<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_('MOD_DASHBOARD_TAB_CREATE_D'); ?></a></li>  <?php endif; ?>
	<?php if ($displaymanagetab) : ?><li class=""><a href="#manage<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_('MOD_DASHBOARD_TAB_MANAGE_D'); ?></a></li>  <?php endif; ?>
	<?php if ($displayadmintab) : ?><li class=""><a href="#admin<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_('MOD_DASHBOARD_TAB_ADMIN_D'); ?></a></li>  <?php endif; ?>
	<?php if ($displayfreetab) : ?><li class=""><a href="#free<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_($freenametab); ?></a></li> <?php endif; ?>
	</ul>
	<?php endif; ?>
	<?php if ($tabmodsidebar) : ?>
		<div class="tab-content">
	<?php endif; ?>
		<?php if ($displaycustomtab) : ?>
			<div class="tab-pane " id="custom<?php echo $module->id;?>">
			<ul class="j-links-group nav nav-list">
			<?php if ($tabmodsidebar == 0) : ?>
			<li><h2 class="nav-header"><?php echo JText::_($nametab); ?></h2></li>
			<?php endif; ?>
      <?php
    $list_buttons = $params->get('add_button');
    if ($list_buttons): ?>
  <?php foreach( $list_buttons as $list_buttons_idx => $add_button ) :?>
    <li>
     <a href="index.php?option=com_content&view=article&layout=edit&catid=<?php echo $add_button->catid; ?>&language=<?php echo $add_button->button_lang; ?>" >
                 <i class="fa <?php echo $add_button->iconbutton; ?> <?php echo $iconsize; ?> "></i>
              <?php echo JText::_($add_button->button_name); ?>
        </a>
      </li>
  <?php if ($add_button->displayline) : ?><hr /><?php endif; ?>
  <?php endforeach; ?>
  <?php endif; ?>
  <?php $list_catbuttons = $params->get('add_cat_button');
  if ($list_catbuttons): ?>
  <?php foreach( $list_catbuttons as $list_catbuttons_idx => $cat_button ) :?>
    <li>
  <a href="index.php?option=com_content&view=articles&filter[category_id]=<?php echo $cat_button->catidlist; ?>&filter[language]=<?php echo $cat_button->button_lang; ?>" >
           <i class="fa <?php echo $cat_button->iconbutton; ?> <?php echo $iconsize; ?> "></i>
        <?php echo JText::_($cat_button->namecatfilter); ?>
  </a>
</li>
<?php if ($cat_button->displayline) : ?><hr /><?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
  <?php $list_edititembuttons = $params->get('edit_item_button');
  if ($list_edititembuttons): ?>
  <?php foreach( $list_edititembuttons as $list_edititembuttons_idx => $edit_item_button ) :?>
    <li>
  <a href="index.php?option=com_content&task=article.edit&id=<?php echo $edit_item_button->itemid; ?>" >
           <i class="fa <?php echo $edit_item_button->iconbutton; ?> <?php echo $iconsize; ?> "></i>
        <?php echo JText::_($edit_item_button->nameitemedit); ?>
  </a>
</li>
<?php if ($edit_item_button->displayline) : ?><hr /><?php endif; ?>
  <?php endforeach; ?>
  <?php endif; ?>


			</ul>
			</div>
			<?php endif; ?>
			<?php if ($displaycreattab) : ?>
			<div class="tab-pane " id="create<?php echo $module->id;?>">
			<ul class="j-links-group nav nav-list">
			<?php if ($tabmodsidebar == 0) : ?>
			<li><h2 class="nav-header"><?php echo JText::_('MOD_DASHBOARD_TAB_CREATE_D'); ?></h2></li>
			<?php endif; ?>
			<?php if($hiddebuttonadditem): ?>
			<li>
        <a href="index.php?option=com_content&task=article.add">

														<i class="fa fa-plus-circle <?php echo $iconsize; ?> "></i>
													<?php echo JText::_( 'MOD_DASHBOARD_ADDITEM' ); ?>

											</a>
			</li>
				<?php endif; ?>
				<?php if($hiddebuttonaddcategory): ?>
          <li>
          <a href="index.php?option=com_categories&task=category.add&extension=com_content">
      												<i class="fa fa-folder-open <?php echo $iconsize; ?> "></i>
      												<?php echo JText::_( 'MOD_DASHBOARD_ADDCATEGORY' ); ?>
      											</a>
                          </li>
				<?php endif; ?>
				<?php if($hiddebuttonaddtag): ?>
          <li>
          <a href="index.php?option=com_tags&view=tag&task=tag.add">

    												<i class="fa fa-tags <?php echo $iconsize; ?> "></i>
    												<?php echo JText::_( 'MOD_DASHBOARD_ADDTAG' ); ?>

    											</a>
                        </li>
				<?php endif; ?>
				<?php if($hiddebuttonadduser): ?>
          <li>
          <a href="index.php?option=com_users&task=user.add">
        												<i class="fa fa-user <?php echo $iconsize; ?> "></i>
        												<?php echo JText::_( 'MOD_DASHBOARD_ADDAUTHOR' ); ?>
        											</a>
                            </li>
				<?php endif; ?>
				<?php if($hiddebuttonaddgroup): ?>
<li>
          <a href="index.php?option=com_users&task=group.add">
    												<i class="fa fa-users <?php echo $iconsize; ?> "></i>
    												<?php echo JText::_( 'MOD_DASHBOARD_ADDGROUPS' ); ?>
    											</a>
                        </li>
				<?php endif; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php if ($displaymanagetab) : ?>
			<div class="tab-pane " id="manage<?php echo $module->id;?>">
			<ul class="j-links-group nav nav-list">
			<?php if ($tabmodsidebar == 0) : ?>
			<li><h2 class="nav-header"><?php echo JText::_('MOD_DASHBOARD_TAB_MANAGE_D'); ?></h2></li>
			<?php endif; ?>
				<?php if($hiddebuttonmanageitems): ?>
          <li>
          <a href="index.php?option=com_content&view=articles">
    														<i class="fa fa-th-list <?php echo $iconsize; ?> "></i>
    														<?php echo JText::_( 'MOD_DASHBOARD_ITEMLIST' ); ?>
    												</a>
                          </li>
				<?php endif;?>
				<?php if($hiddebuttonmanagecategories): ?>
          <li>
          <a href="index.php?option=com_categories&extension=com_content">
  														<i class="fa fa-folder-open <?php echo $iconsize; ?> "></i>
  														<?php echo JText::_( 'MOD_DASHBOARD_CATLIST' ); ?>
  												</a>
                        </li>
					<?php endif; ?>
				<?php if($hiddebuttonmanagetags): ?>
<li>
          <a href="index.php?option=com_tags">
  										<i class="fa fa-tags <?php echo $iconsize; ?> "></i>
  										<?php echo JText::_( 'MOD_DASHBOARD_TAGLIST' ); ?>

  								</a>
                </li>
	<?php endif; ?>
	<?php if($hiddebuttonmanageauthors): ?>
    <li>
    <a href="index.php?option=com_users&view=users">
    										<i class="fa fa-user <?php echo $iconsize; ?> "></i>
    										<?php echo JText::_( 'MOD_DASHBOARD_AUTHORLIST' ); ?>
    								</a>
                  </li>
	<?php endif; ?>

	<?php if($hiddebuttonmanagegroups): ?>
	<li>
	<a href="index.php?option=com_flexicontent&view=groups">

			<i class="fa fa-user <?php echo $iconsize; ?> "></i>
			<?php echo JText::_( 'MOD_DASHBOARD_GROUPSLIST' ); ?>

	</a>
	</li>
	<?php endif; ?>

	<?php if($hiddebuttonmanagefiles): ?>
<li>
    <a href="index.php?option=com_media">
    										<i class="fa fa-upload <?php echo $iconsize; ?> "></i>
    										<?php echo JText::_( 'MOD_DASHBOARD_FILEMANAGER' ); ?>

    								</a>
                  </li>
	<?php endif; ?>
	</ul>
			</div>
			<?php endif; ?>
			<?php if ($displayadmintab) : ?>
			<div class="tab-pane " id="admin<?php echo $module->id;?>">

			<ul class="j-links-group nav nav-list">
			<?php if ($tabmodsidebar == 0) : ?>
			<li><h2 class="nav-header"><?php echo JText::_('MOD_DASHBOARD_TAB_ADMIN_D'); ?></h2></li>
			<?php endif; ?>
      <?php if($hiddebuttonprivacy): ?>
        <li>
                <a href="index.php?option=com_privacy">
                    <i class="fa fa-lock <?php echo $iconsize; ?> "></i>
                    <?php echo JText::_( 'MOD_DASHBOARD_PRIVACY' ); ?>

                </a>
              </li>
                <?php endif; ?>
              <?php if($hiddebuttonlogs): ?>
                <li>
              <a href="index.php?option=com_actionlogs">
                <i class="fa fa-list-alt <?php echo $iconsize; ?> "></i>
                <?php echo JText::_( 'MOD_DASHBOARD_LOGS' ); ?>

              </a>
            </li>
              <?php endif; ?>
              <?php if($hiddebuttonmanagefieldsuser): ?>
                <li>
      									<a href="index.php?option=com_fields&context=com_users.user">
      											<i class="fa fa-user <?php echo $iconsize; ?> "></i>
      											<?php echo JText::_( 'MOD_DASHBOARD_FIELDLIST_USER' ); ?>
      									</a>
                      </li>
      									<?php endif; ?>
      									<?php if($hiddebuttonmanagefieldsarticle): ?>
                          <li>
      									<a href="index.php?option=com_fields&context=com_content.article">
      										<i class="fa fa-th-list <?php echo $iconsize; ?> "></i>
      										<?php echo JText::_( 'MOD_DASHBOARD_FIELDLIST_ARTICLE' ); ?>
      									</a>
                      </li>
      									<?php endif; ?>
      						<?php if($hiddebuttonadmin): ?>
                    <li>
      					<a href="index.php?option=com_config">
      							<i class="fa fa-cogs <?php echo $iconsize; ?> "></i>
      						<?php echo JText::_( 'MOD_DASHBOARD_GEN' ); ?>
      					</a>
              </li>
      				<?php endif; ?>
				</ul>
			</div>
			<?php endif; ?>
								<?php if ($tabmodsidebar) : ?>
			<div class="tab-pane " id="free<?php echo $module->id;?>">
			<?php endif;?>

			<?php if ($displayfreetab) : ?>
				<?php foreach( $list_freebuttons as $list_freebuttons_idx => $free_buttons ) :?>


			<ul class="j-links-group nav nav-list">
			<li><h2 class="nav-header"><?php echo $free_buttons->freenametab;?></h2></li>
					<?php foreach( $free_buttons->free_button as $free_button_idx => $free_button ) :?>
					<li>
            <a href="<?php echo $free_button->linkbutton; ?>" target="<?php echo $free_button->targetlink; ?>" >
                     <i class="fa <?php echo $free_button->iconbutton; ?> <?php echo $iconsize; ?> "></i>
                  <?php echo JText::_($free_button->freebutton); ?>
            </a>
			</li>
<?php if ($free_button->displayline) : ?><hr /><?php endif; ?>
         <?php endforeach; ?>
			</ul>

			<?php endforeach; ?>
			<?php endif; ?>
			<?php if ($tabmodsidebar) : ?>
			</div>
		<?php endif;?>
		<?php if ($tabmodsidebar) : ?>
		</div>
		<?php endif; ?>
	</div>

	<?php endif; ?>
</div>

<script  type="text/javascript">
jQuery(document).ready(function($){
$('#myTab2<?php echo $module->id;?> a:first').tab('show');
});
</script>
