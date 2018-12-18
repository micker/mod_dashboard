<?php
/**
* @version 0.5.0 stable $Id: iconpicker.php yannick berges
* @package Joomla
* @copyright (C) 2015 Berges Yannick - www.com3elles.com
* @license GNU/GPL v2

* special thanks to my master Marc Studer
* Elisa Foltyn coolcat-creations

* JOOMLAdmin module is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
**/

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
                       JHtml::_('stylesheet', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

                       JHtml::_('stylesheet', 'media/mod_joomadmin/css/bootstrap-iconpicker.min.css');
                       JHtml::_('script', 'media/mod_joomadmin/js/bootstrap.min.js');
                       JHtml::_('script', 'media/mod_joomadmin/js/bootstrap-iconpicker-iconset-all.min.js');
                       JHtml::_('script', 'media/mod_joomadmin/js/bootstrap-iconpicker.min.js');


                       //LOADING VIA CDN
                       //JHtml::_('stylesheet', ' https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/css/bootstrap-iconpicker.min.css');
                       //JHtml::_('script', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
                       //JHtml::_('script', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/js/bootstrap-iconpicker-iconset-all.min.js');
                       //JHtml::_('script', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/js/bootstrap-iconpicker.min.js');

                       $iconlist = ' <button id="'. $this->id .'-wrapper" class="btn btn-secondary"/></button>';
                       $iconlist .="
                       <script>
                       (function ($) {
                       $('#". $this->id ."-wrapper').iconpicker({
                       align: 'left',
                       arrowClass: 'btn-success',
                       arrowPrevIconClass: 'fa fa-arrow-left',
                       arrowNextIconClass: 'fa fa-arrow-right',
                       cols: 5,
                       rows:5,
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
                       iconClassFix: 'fa fa-',
                       icon:'" . $this->value . "'
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
