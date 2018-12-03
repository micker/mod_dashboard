<?php
/**
* @version 0.10.1 stable $Id: default.php yannick berges
* @package Joomla
* @subpackage FLEXIcontent
* @copyright (C) 2015 Berges Yannick - www.com3elles.com
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
$document->addStyleSheet(JUri::base(true)."/modules/mod_flexiadmin/assets/css/style.css",'text/css',"screen");

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

//id catlist
$catidlist1       = $params->get('catidlist1', '1' );
$nameblockcustom1 = $params->get('nameblockcustom1', '' );
$displblock1	  = $params->get('displblock1', '' );
$catidlist2       = $params->get('catidlist2', '1' );
$nameblockcustom2 = $params->get('nameblockcustom2', '' );
$displblock2 	  = $params->get('displblock2', '' );
$catidlist3       = $params->get('catidlist3', '1' );
$nameblockcustom3 = $params->get('nameblockcustom3', '' );
$displblock3 	  = $params->get('displblock3', '' );
$catidlist4       = $params->get('catidlist4', '1' );
$nameblockcustom4 = $params->get('nameblockcustom4', '' );
$displblock4      = $params->get('displblock4', '' );
$catidlist5       = $params->get('catidlist5', '1' );
$nameblockcustom5 = $params->get('nameblockcustom5', '' );
$displblock5      = $params->get('displblock5', '' );
$catidlist6       = $params->get('catidlist6', '1' );
$nameblockcustom6 = $params->get('nameblockcustom6', '' );
$displblock6 	  = $params->get('displblock6', '' );
$catidlist7       = $params->get('catidlist7', '1' );
$nameblockcustom7 = $params->get('nameblockcustom7', '' );
$displblock7      = $params->get('displblock7', '' );
$catidlist8       = $params->get('catidlist8', '1' );
$nameblockcustom8 = $params->get('nameblockcustom8', '' );
$displblock8      = $params->get('displblock8', '' );
$catidlist9       = $params->get('catidlist9', '1' );
$nameblockcustom9 = $params->get('nameblockcustom9', '' );
$displblock9      = $params->get('displblock9', '' );
$catidlist10      = $params->get('catidlist10', '1' );
$nameblockcustom10= $params->get('nameblockcustom10', '' );
$displblock10 	  = $params->get('displblock10', '' );


//customtab
$nametab = $params->get('nametab', 'FLEXI_ADMIN_CUSTOM_TAB_NAME' );

//bouton add
$namebutton1  = $params->get('namebutton1', '' );
$type1        = $params->get('types1', '' );
$maincat1     = $params->get('catids1', '' );
$dispb1 	  = $params->get('dispb1', '' );
$namebutton2  = $params->get('namebutton2', '' );
$type2        = $params->get('types2', '' );
$maincat2     = $params->get('catids2', '' );
$dispb2       = $params->get('dispb2', '' );
$namebutton3  = $params->get('namebutton3', '' );
$type3        = $params->get('types3', '' );
$maincat3     = $params->get('catids3', '' );
$dispb3       = $params->get('dispb3', '' );
$namebutton4  = $params->get('namebutton4', '' );
$type4        = $params->get('types4', '' );
$maincat4     = $params->get('catids4', '' );
$dispb4       = $params->get('dispb4', '' );
$namebutton5  = $params->get('namebutton5', '' );
$type5        = $params->get('types5', '' );
$maincat5     = $params->get('catids5', '' );
$dispb5       = $params->get('dispb5', '' );
$namebutton6  = $params->get('namebutton6', '' );
$type6        = $params->get('types6', '' );
$maincat6     = $params->get('catids6', '' );
$dispb6       = $params->get('dispb6', '' );
$namebutton7  = $params->get('namebutton7', '' );
$type7        = $params->get('types7', '' );
$maincat7     = $params->get('catids7', '' );
$dispb7       = $params->get('dispb7', '' );
$namebutton8  = $params->get('namebutton8', '' );
$type8        = $params->get('types8', '' );
$maincat8     = $params->get('catids8', '' );
$dispb8       = $params->get('dispb8', '' );
$namebutton9  = $params->get('namebutton9', '' );
$type9        = $params->get('types9', '' );
$maincat9     = $params->get('catids9', '' );
$dispb9       = $params->get('dispb9', '' );
$namebutton10 = $params->get('namebutton10', '' );
$type10       = $params->get('types10', '' );
$maincat10    = $params->get('catids10', '' );
$dispb10      = $params->get('dispb10', '' );


//category filter
$filtercat1     = $params->get('filtercatids1', '' );
$namecatfilter1 = $params->get('namecatfilter1', '' );
$dispc1 		= $params->get('dispc1', '' );
$filtercat2     = $params->get('filtercatids2', '' );
$namecatfilter2 = $params->get('namecatfilter2', '' );
$dispc2 		= $params->get('dispc2', '' );
$filtercat3     = $params->get('filtercatids3', '' );
$namecatfilter3 = $params->get('namecatfilter3', '' );
$dispc3 		= $params->get('dispc3', '' );
$filtercat4     = $params->get('filtercatids4', '' );
$namecatfilter4 = $params->get('namecatfilter4', '' );
$dispc4 		= $params->get('dispc4', '' );
$filtercat5     = $params->get('filtercatids5', '' );
$namecatfilter5 = $params->get('namecatfilter5', '' );
$dispc5 		= $params->get('dispc5', '' );
$filtercat6     = $params->get('filtercatids6', '' );
$namecatfilter6 = $params->get('namecatfilter6', '' );
$dispc6 		= $params->get('dispc6', '' );
$filtercat7     = $params->get('filtercatids7', '' );
$namecatfilter7 = $params->get('namecatfilter7', '' );
$dispc7 		= $params->get('dispc7', '' );
$filtercat8     = $params->get('filtercatids8', '' );
$namecatfilter8 = $params->get('namecatfilter8', '' );
$dispc8 		= $params->get('dispc8', '' );
$filtercat9     = $params->get('filtercatids9', '' );
$namecatfilter9 = $params->get('namecatfilter9', '' );
$dispc9 		= $params->get('dispc9', '' );
$filtercat10    = $params->get('filtercatids10', '' );
$namecatfilter10= $params->get('namecatfilter10', '' );
$dispc10 		= $params->get('dispc10', '' );


//edit special item
$itemedit1     = $params->get('itemid1', '' );
$nameitemedit1 = $params->get('nameitemedit1', '' );
$dispi1        = $params->get('dispi1', '' );
$itemedit2     = $params->get('itemid2', '' );
$nameitemedit2 = $params->get('nameitemedit2', '' );
$dispi2        = $params->get('dispi2', '' );
$itemedit3     = $params->get('itemid3', '' );
$nameitemedit3 = $params->get('nameitemedit3', '' );
$dispi3        = $params->get('dispi3', '' );
$itemedit4     = $params->get('itemid4', '' );
$nameitemedit4 = $params->get('nameitemedit4', '' );
$dispi4        = $params->get('dispi4', '' );
$itemedit5     = $params->get('itemid5', '' );
$nameitemedit5 = $params->get('nameitemedit5', '' );
$dispi5        = $params->get('dispi5', '' );
$itemedit6     = $params->get('itemid6', '' );
$nameitemedit6 = $params->get('nameitemedit6', '' );
$dispi6        = $params->get('dispi6', '' );
$itemedit7     = $params->get('itemid7', '' );
$nameitemedit7 = $params->get('nameitemedit7', '' );
$dispi7        = $params->get('dispi7', '' );
$itemedit8     = $params->get('itemid8', '' );
$nameitemedit8 = $params->get('nameitemedit8', '' );
$dispi8        = $params->get('dispi8', '' );
$itemedit9     = $params->get('itemid9', '' );
$nameitemedit9 = $params->get('nameitemedit9', '' );
$dispi9        = $params->get('dispi9', '' );
$itemedit10    = $params->get('itemid10', '' );
$nameitemedit10= $params->get('nameitemedit10', '' );
$dispi10        = $params->get('dispi10', '' );

//Get Buttom Sections
$hiddebuttonmanageitems      = $params->get('hiddebuttonmanageitems'     , '1');
$hiddebuttonmanagecategories = $params->get('hiddebuttonmanagecategories', '1');
$hiddebuttonmanagetypes      = $params->get('hiddebuttonmanagetypes'     , '1');
$hiddebuttonmanagetags       = $params->get('hiddebuttonmanagetags'      , '1');
$hiddebuttonmanagefields     = $params->get('hiddebuttonmanagefields'    , '1');
$hiddebuttonmanageauthors    = $params->get('hiddebuttonmanageauthors'   , '1');
$hiddebuttonmanagegroups     = $params->get('hiddebuttonmanagegroups'    , '1');
$hiddebuttonmanagefiles      = $params->get('hiddebuttonmanagefiles'     , '1');
$hiddebuttonimportcontent    = $params->get('hiddebuttonimportcontent'   , '1');
$hiddebuttonstats            = $params->get('hiddebuttonstats'           , '1');
$hiddebuttonindex            = $params->get('hiddebuttonindex'           , '1');
$hiddebuttonaddtypes         = $params->get('hiddebuttonaddtypes'        , '1');
$hiddebuttonaddfields        = $params->get('hiddebuttonaddfields'       , '1');
$hiddebuttonadmin            = $params->get('hiddebuttonadmin'           , '1');
$hiddebuttonadditem          = $params->get('hiddebuttonadditem'         , '1');
$hiddebuttonaddcategory      = $params->get('hiddebuttonaddcategory'     , '1');
$hiddebuttonaddtag           = $params->get('hiddebuttonaddtag'          , '1');
$hiddebuttonadduser          = $params->get('hiddebuttonadduser'         , '1');
$hiddebuttonaddgroup         = $params->get('hiddebuttonaddgroup'         , '1');

//freetab
$freenametab = $params->get('freenametab', 'FLEXI_ADMIN_FREE_TAB_NAME' );


//free bouton
$dispfreebutton1  = $params->get('dispf1', '' );
$freebutton1  = $params->get('freebutton1', '' );
$linkbutton1  = $params->get('linkbutton1', '' );
$iconbutton1  = $params->get('iconbutton1', '' );
$dispfreebutton2  = $params->get('dispf2', '' );
$freebutton2  = $params->get('freebutton2', '' );
$linkbutton2  = $params->get('linkbutton2', '' );
$iconbutton2  = $params->get('iconbutton2', '' );
$dispfreebutton2  = $params->get('dispf2', '' );
$freebutton3  = $params->get('freebutton3', '' );
$linkbutton3  = $params->get('linkbutton3', '' );
$iconbutton3  = $params->get('iconbutton3', '' );
$dispfreebutton3  = $params->get('dispf3', '' );
$freebutton4  = $params->get('freebutton4', '' );
$linkbutton4  = $params->get('linkbutton4', '' );
$iconbutton4  = $params->get('iconbutton4', '' );
$dispfreebutton4  = $params->get('dispf4', '' );
$freebutton5  = $params->get('freebutton5', '' );
$linkbutton5  = $params->get('linkbutton5', '' );
$iconbutton5  = $params->get('iconbutton5', '' );
$dispfreebutton5  = $params->get('dispf5', '' );
$freebutton6  = $params->get('freebutton6', '' );
$linkbutton6  = $params->get('linkbutton6', '' );
$iconbutton6  = $params->get('iconbutton6', '' );
$dispfreebutton6  = $params->get('dispf6', '' );
$freebutton7  = $params->get('freebutton7', '' );
$linkbutton7  = $params->get('linkbutton7', '' );
$iconbutton7  = $params->get('iconbutton7', '' );
$dispfreebutton7  = $params->get('dispf7', '' );
$freebutton8  = $params->get('freebutton8', '' );
$linkbutton8  = $params->get('linkbutton8', '' );
$iconbutton8  = $params->get('iconbutton8', '' );
$dispfreebutton8  = $params->get('dispf8', '' );
$freebutton9  = $params->get('freebutton9', '' );
$linkbutton9  = $params->get('linkbutton9', '' );
$iconbutton9  = $params->get('iconbutton9', '' );
$dispfreebutton9  = $params->get('dispf9', '' );
$freebutton10  = $params->get('freebutton10', '' );
$linkbutton10  = $params->get('linkbutton10', '' );
$iconbutton10  = $params->get('iconbutton10', '' );
$dispfreebutton10  = $params->get('dispf10', '' );

jimport( 'joomla.application.component.controller' );
// Check if component is installed
if ( !JComponentHelper::isEnabled( 'com_flexicontent', true) ) {
   echo 'This modules requires component FLEXIcontent!';
   return;
}
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
	<ul class="nav nav-tabs" role="tablist" id="myTab2">
	<?php if ($displaycustomtab) : ?><li class="active"><a href="#custom<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_($nametab); ?></a></li> <?php endif; ?>
	<?php if ($displaycreattab) : ?><li class=""><a href="#create<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_('FLEXI_ADMIN_TAB_CREATE_D'); ?></a></li>  <?php endif; ?>
	<?php if ($displaymanagetab) : ?><li class=""><a href="#manage<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_('FLEXI_ADMIN_TAB_MANAGE_D'); ?></a></li>  <?php endif; ?>
	<?php if ($displayadmintab) : ?><li class=""><a href="#admin<?php echo $module->id;?>" data-toggle="tab"><?php echo JText::_('FLEXI_ADMIN_TAB_ADMIN_D'); ?></a></li>  <?php endif; ?>
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
			<?php if ($dispb1) : ?>
			<li>
			<a href="index.php?option=com_flexicontent&controller=items&task=items.add&typeid=<?php echo $type1;?>&maincat=<?php echo $maincat1; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($namebutton1); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispb2) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&controller=items&task=items.add&typeid=<?php echo $type2;?>&maincat=<?php echo $maincat2; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($namebutton2); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispb3) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&controller=items&task=items.add&typeid=<?php echo $type3;?>&maincat=<?php echo $maincat3; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($namebutton3); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispb4) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&controller=items&task=items.add&typeid=<?php echo $type4;?>&maincat=<?php echo $maincat4; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($namebutton4); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispb5) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&controller=items&task=items.add&typeid=<?php echo $type5;?>&maincat=<?php echo $maincat5; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($namebutton5); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispb6) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&controller=items&task=items.add&typeid=<?php echo $type6;?>&maincat=<?php echo $maincat6; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($namebutton6); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispb7) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&controller=items&task=items.add&typeid=<?php echo $type7;?>&maincat=<?php echo $maincat7; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($namebutton7); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispb8) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&controller=items&task=items.add&typeid=<?php echo $type8;?>&maincat=<?php echo $maincat8; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($namebutton8); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispb9) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&controller=items&task=items.add&typeid=<?php echo $type9;?>&maincat=<?php echo $maincat9; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($namebutton9); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispb10) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&controller=items&task=items.add&typeid=<?php echo $type10;?>&maincat=<?php echo $maincat10; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($namebutton10); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<li>
			<?php if ($dispc1) : ?>
				<a href="index.php?option=com_flexicontent&view=items&filter_cats=<?php echo $filtercat1; ?>" >
						
							<i class="icon-large icon-list"></i> 
						<?php echo JText::_($namecatfilter1); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispc2) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=items&filter_cats=<?php echo $filtercat2; ?>" >
						
							<i class="icon-large icon-list"></i> 
						<?php echo JText::_($namecatfilter2); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispc3) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=items&filter_cats=<?php echo $filtercat3; ?>" >
						
							<i class="icon-large icon-list"></i> 
						<?php echo JText::_($namecatfilter3); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispc4) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=items&filter_cats=<?php echo $filtercat4; ?>" >
						
							<i class="icon-large icon-list"></i> 
						<?php echo JText::_($namecatfilter4); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispc5) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=items&filter_cats=<?php echo $filtercat5; ?>" >
						
							<i class="icon-large icon-list"></i> 
						<?php echo JText::_($namecatfilter5); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispc6) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=items&filter_cats=<?php echo $filtercat6; ?>" >
						
							<i class="icon-large icon-list"></i> 
						<?php echo JText::_($namecatfilter6); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispc7) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=items&filter_cats=<?php echo $filtercat7; ?>" >
						
							<i class="icon-large icon-list"></i> 
						<?php echo JText::_($namecatfilter7); ?>
						
				</a>
			</li>	
			<?php endif; ?>
			<?php if ($dispc8) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=items&filter_cats=<?php echo $filtercat8; ?>" >
						
							<i class="icon-large icon-list"></i> 
						<?php echo JText::_($namecatfilter8); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispc9) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=items&filter_cats=<?php echo $filtercat9; ?>" >
						
							<i class="icon-large icon-list"></i> 
						<?php echo JText::_($namecatfilter9); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispc10) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=items&filter_cats=<?php echo $filtercat10; ?>" >
						
							<i class="icon-large icon-list"></i> 
						<?php echo JText::_($namecatfilter10); ?>
						
				</a>
			</li>	
			<?php endif; ?>
			<?php if ($dispi1) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&task=items.edit&cid[]=<?php echo $itemedit1; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($nameitemedit1); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispi2) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&task=items.edit&cid[]=<?php echo $itemedit2; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($nameitemedit2); ?>
						
				</a>
			</li>	
			<?php endif; ?>
			<?php if ($dispi3) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&task=items.edit&cid[]=<?php echo $itemedit3; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($nameitemedit3); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispi4) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&task=items.edit&cid[]=<?php echo $itemedit4; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($nameitemedit4); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispi5) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&task=items.edit&cid[]=<?php echo $itemedit5; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($nameitemedit5); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispi6) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&task=items.edit&cid[]=<?php echo $itemedit6; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($nameitemedit6); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispi7) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&task=items.edit&cid[]=<?php echo $itemedit7; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($nameitemedit7); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispi8) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&task=items.edit&cid[]=<?php echo $itemedit8; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($nameitemedit8); ?>
						
				</a>
			</li>
			<?php endif; ?>
			<?php if ($dispi9) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&task=items.edit&cid[]=<?php echo $itemedit9; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($nameitemedit9); ?>
						
				</a>
			</li>	
			<?php endif; ?>
			<?php if ($dispi10) : ?>
			<li>
				<a href="index.php?option=com_flexicontent&task=items.edit&cid[]=<?php echo $itemedit10; ?>" >
						
							<i class="icon-large icon-file-plus"></i> 
						<?php echo JText::_($nameitemedit10); ?>
						
				</a>
			</li>	
			<?php endif; ?>
			</ul>
			</div>
			<?php endif; ?>
			<?php if ($displaycreattab) : ?>
			<div class="tab-pane " id="create<?php echo $module->id;?>"> 
			<ul class="j-links-group nav nav-list">
			<?php if ($tabmodsidebar == 0) : ?>
			<li><h2 class="nav-header"><?php echo JText::_('FLEXI_ADMIN_TAB_CREATE_D'); ?></h2></li>
			<?php endif; ?>
			<?php if($hiddebuttonadditem): ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=types&format=raw" 
							class="modal" 
							rel="{size: {x: 700, y: 300}, closable: true}">
							<i class="icon-large icon-file-plus"></i>
						<span class="j-links-link"><?php echo JText::_( 'FLEXI_ADMIN_ADDITEM' ); ?></span>
				</a>
			</li>
				<?php endif; ?>
				<?php if($hiddebuttonaddcategory): ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=category"> 
					<i class="icon-large icon-list"></i>
					<span class="j-links-link"><?php echo JText::_( 'FLEXI_ADMIN_ADDCATEGORY' ); ?></span>
				</a>
			</li>
				<?php endif; ?>
				<?php if($hiddebuttonaddtag): ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=tag">
					<i class="icon-large icon-tag"></i>
					<span class="j-links-link"><?php echo JText::_( 'FLEXI_ADMIN_ADDTAG' ); ?></span>
				</a>
			</li>
				<?php endif; ?>
				<?php if($hiddebuttonadduser): ?>
			<li>
				<a href="index.php?option=com_flexicontent&task=users.add">
					<i class="icon-large icon-user"></i> 
					<span class="j-links-link"><?php echo JText::_( 'FLEXI_ADMIN_ADDAUTHOR' ); ?></span>
				</a>
			</li>
				<?php endif; ?>
				<?php if($hiddebuttonaddgroup): ?>
			<li>
				<a href="index.php?option=com_flexicontent&view=groups.add">
					<i class="icon-large icon-users"></i>
					<span class="j-links-link"><?php echo JText::_( 'FLEXI_ADMIN_ADDGROUPS' ); ?></span>
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
			<li><h2 class="nav-header"><?php echo JText::_('FLEXI_ADMIN_TAB_MANAGE_D'); ?></h2></li>
			<?php endif; ?>
				<?php if($hiddebuttonmanageitems): ?>
				<li>
					<a href="index.php?option=com_flexicontent&view=items">
						
							<i class="icon-large icon-file-2"></i> 
							<?php echo JText::_( 'FLEXI_ADMIN_ITEMLIST' ); ?></span>

					</a>
				</li>
				<?php endif;?>
				<?php if($hiddebuttonmanagecategories): ?>
				<li>
					<a href="index.php?option=com_flexicontent&view=categories">
						  
							<i class="icon-large icon-list"></i> 
							<?php echo JText::_( 'FLEXI_ADMIN_CATLIST' ); ?>
						
					</a>
				</li>
					<?php endif; ?>
				<?php if($hiddebuttonmanagetags): ?>
				<li>
	<a href="index.php?option=com_flexicontent&view=tags">
		  
			<i class="icon-large icon-tag"></i> 
			<?php echo JText::_( 'FLEXI_ADMIN_TAGLIST' ); ?>
		
	</a>
	</li>
	<?php endif; ?>
	<?php if($hiddebuttonmanageauthors): ?>
	<li>
	<a href="index.php?option=com_flexicontent&view=users">
		  
			<i class="icon-large icon-user"></i> 
			<?php echo JText::_( 'FLEXI_ADMIN_AUTHORLIST' ); ?>
		
	</a>
	</li>
	<?php endif; ?>
	
	<?php if($hiddebuttonmanagegroups): ?>
	<li>
	<a href="index.php?option=com_flexicontent&view=groups">
		  
			<i class="icon-large icon-users"></i> 
			<?php echo JText::_( 'FLEXI_ADMIN_GROUPSLIST' ); ?>
		
	</a>
	</li>
	<?php endif; ?>
		
	<?php if($hiddebuttonmanagefiles): ?>
	<li>
	<a href="index.php?option=com_flexicontent&view=filemanager">
		  
			<i class="icon-large icon-upload"></i> 
			<?php echo JText::_( 'FLEXI_ADMIN_FILEMANAGER' ); ?>
		
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
			<li><h2 class="nav-header"><?php echo JText::_('FLEXI_ADMIN_TAB_ADMIN_D'); ?></h2></li>
			<?php endif; ?>
					<?php if($hiddebuttonmanagetypes): ?>
					<li>
					<a href="index.php?option=com_flexicontent&view=types">
						  
							<i class="icon-large icon-book"></i> 
							<?php echo JText::_( 'FLEXI_ADMIN_TYPELIST' ); ?>
						
					</a>
					</li>
					<?php endif; ?>
				<?php if($hiddebuttonaddtypes): ?>
				<li>
				<a href="index.php?option=com_flexicontent&view=type">
					  
					<i class="icon-large icon-book"></i> 
					<?php echo JText::_( 'FLEXI_ADMIN_ADDTYPE' ); ?>
					
				</a>
				</li>				
				<?php endif; ?>
				<?php if($hiddebuttonmanagefields): ?>
				<li>
				<a href="index.php?option=com_flexicontent&view=fields">
					  
						<i class="icon-large icon-stack"></i> 
						<?php echo JText::_( 'FLEXI_ADMIN_FIELDLIST' ); ?>
					
				</a>
				</li>
				<?php endif; ?>
				<?php if($hiddebuttonaddfields): ?>
				<li>
				<a href="index.php?option=com_flexicontent&view=field">
					  
					<i class="icon-large icon-stack"></i> 
					<?php echo JText::_( 'FLEXI_ADMIN_ADDFIELD' ); ?>
					
				</a>
				</li>
				<?php endif; ?>
	<?php if($hiddebuttonimportcontent): ?><li>
	<a href="index.php?option=com_flexicontent&view=import">
		  
			<i class="icon-large icon-loop"></i> 
			<?php echo JText::_( 'FLEXI_ADMIN_IMPORT' ); ?>
		
	</a>
	</li>
	<?php endif; ?>
	<?php if($hiddebuttonstats): ?>
	<li>
	<a href="index.php?option=com_flexicontent&view=stats">
		  
			<i class="icon-large icon-pie"></i> 
			<?php echo JText::_( 'FLEXI_ADMIN_STATS' ); ?>
		
	</a>
	</li>
	<?php endif; ?>
	<?php if($hiddebuttonindex): ?>
	<li>
	<a href="index.php?option=com_flexicontent&view=search">
		  
			<i class="icon-large icon-search"></i> 
			<?php echo JText::_( 'FLEXI_ADMIN_SEARCH' ); ?>
		
	</a>
	</li>
    <?php endif; ?>
	<?php if($hiddebuttonadmin): ?>
	<li>
				<a href="index.php?option=com_flexicontent">
					  
						<i class="icon-large icon-options"></i> 
						<?php echo JText::_( 'FLEXI_ADMIN_GEN' ); ?>
					
				</a>
				</li>
				<?php endif; ?>
				</ul>
			</div> 
			<?php endif; ?>
			<?php if ($displayfreetab) : ?>
			<div class="tab-pane " id="free<?php echo $module->id;?>"> 
			
			<ul class="j-links-group nav nav-list" style="margin-top:20px;">
			<?php if ($tabmodsidebar == 0) : ?>
			<li><h2 class="nav-header"><?php echo JText::_($freenametab); ?></h2></li>
			<?php endif; ?>
<?php if ($dispfreebutton1) : ?>
<li>
						<a href="<?php echo $linkbutton1; ?>" >
									<i class="icon-large <?php echo $iconbutton1; ?>"></i> 
								<?php echo JText::_($freebutton1); ?>
						</a>
						</li>
			<?php endif; ?>
			<?php if ($dispfreebutton2) : ?>
			<li>
						<a href="<?php echo $linkbutton2; ?>" >
									<i class="icon-large <?php echo $iconbutton2; ?>"></i>
								<?php echo JText::_($freebutton2); ?>
						</a>
						</li>
			<?php endif; ?>
			<?php if ($dispfreebutton3) : ?>
			<li>
						<a href="<?php echo $linkbutton3; ?>" >
									<i class="icon-large <?php echo $iconbutton3; ?>"></i>
								<?php echo JText::_($freebutton3); ?>
						</a>
						</li>
			<?php endif; ?>
			<?php if ($dispfreebutton4) : ?>
			<li>
						<a href="<?php echo $linkbutton4; ?>" >
									<i class="icon-large <?php echo $iconbutton4; ?>"></i> 
								<?php echo JText::_($freebutton4); ?>
						</a>
						</li>
			<?php endif; ?>
						<?php if ($dispfreebutton5) : ?>
						<li>
						<a href="<?php echo $linkbutton5; ?>" >
									<i class="icon-large <?php echo $iconbutton5; ?>"></i> 
								<?php echo JText::_($freebutton5); ?>
						</a>
						</li>
			<?php endif; ?>
						<?php if ($dispfreebutton6) : ?>
						<li>
						<a href="<?php echo $linkbutton6; ?>" >
									<i class="icon-large <?php echo $iconbutton6; ?>"></i>
								<?php echo JText::_($freebutton6); ?>
						
						</a>
						</li>
			<?php endif; ?>
						<?php if ($dispfreebutton7) : ?>
						<li>
						<a href="<?php echo $linkbutton7; ?>" >
									<i class="icon-large <?php echo $iconbutton7; ?>"></i>
								<?php echo JText::_($freebutton7); ?>
								
						</a>
						</li>
			<?php endif; ?>
						<?php if ($dispfreebutton8) : ?>
						<li>
						<a href="<?php echo $linkbutton8; ?>" >
								
									<i class="icon-large <?php echo $iconbutton8; ?>"></i>
								<?php echo JText::_($freebutton8); ?>
								
						</a></li>
			<?php endif; ?>
						<?php if ($dispfreebutton9) : ?>
						<li>
						<a href="<?php echo $linkbutton9; ?>" >
								
									<i class="icon-large <?php echo $iconbutton9; ?>"></i>
								<?php echo JText::_($freebutton9); ?>
								
						</a>
						</li>
			<?php endif; ?>
						<?php if ($dispfreebutton10) : ?>
						<li>
						<a href="<?php echo $linkbutton10; ?>" >
								
									<i class="icon-large <?php echo $iconbutton10; ?>"></i> 
								<?php echo JText::_($freebutton10); ?>
								
						</a>
						</li>
						</ul>
			<?php endif; ?>
			</div>
			<?php endif; ?>
			
		<?php if ($tabmodsidebar) : ?>	
		</div>  
		<?php endif; ?>		
	</div> 

	<?php endif; ?>
</div>

<script  type="text/javascript">
jQuery(document).ready(function($){
$('#myTab2 a:first').tab('show');
});
</script>





