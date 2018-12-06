<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

jimport('joomla.filesystem.folder');  // JFolder
jimport('joomla.filesystem.file');    // JFile

jimport('cms.html.html');      // JHtml
jimport('cms.html.select');    // JHtmlSelect

jimport('joomla.form.helper'); // JFormHelper
JFormHelper::loadFieldClass('list');   // JFormFieldList

class JFormFieldIconpicker extends JFormField {
                       protected $type = 'Iconpicker';
	// getLabel() left out
	public function getInput() {
                       JHtml::_('jquery.framework');
                       JHtml::_('bootstrap.framework');
                       JHtml::_('script', 'media/mod_joomadmin/css/bootstrap-iconpicker.css');
                       JHtml::_('script', 'media/mod_joomadmin/js/bootstrap-iconpicker-iconset-all.js');
                       JHtml::_('script', 'media/mod_joomadmin/js/bootstrap-iconpicker.js');
                       JHtml::_('stylesheet', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
                       $iconlist = ' <div id="'. $this->id .'-wrapper" name="iconpicker"/></div>';
                       $iconlist .="
                       <script>
                       (function ($) {
                       $('#". $this->id ."-wrapper').iconpicker({
                       align: 'left',
                       arrowClass: 'btn-success',
                       arrowPrevIconClass: 'fa fa-arrow-left',
                       arrowNextIconClass: 'fa fa-arrow-right',
                       cols: 5,
                       rows:3,
                       footer: true,
                       header: true,
                       iconset: 'fontawesome',
                       labelHeader: '" . JText::sprintf( 'JOOMLA_ADMIN_ICONLINK_PAGESINDEX', '{0}', '{1}' ) . "',
                       labelFooter: '" . JText::sprintf( 'JOOMLA_ADMIN_ICONLINK_ICONSINDEX', '{0}', '{1}', '{2}' ) . "',
                       placement: 'bottom',
                       search: true,
                       searchText: '". JText::_('JOOMLA_ADMIN_ICONLINK_SEARCHTEXT') . "',
                       selectedClass: 'btn-primary',
                       unselectedClass: 'btn-default',
                       iconClass: 'fontawesome',
                       iconClassFix: 'fa fa-'
                       });

                       var myfield = $('#" . $this->id . "-wrapper'),
                       input = $('input', myfield);
                       input.attr({'id': '" . $this->id . "', 'name': '" . $this->name . "'});
                       input.val('" . $this->value . "');

                       })(jQuery);
                       </script>";

                       return $iconlist;
                       }
}
