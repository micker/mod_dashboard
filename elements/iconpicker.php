<?php

/**
 * @version 0.5.0 stable $Id: iconpicker.php yannick berges
 * @package Joomla
 * @copyright (C) 2018 Berges Yannick - www.com3elles.com
 * @license GNU/GPL v2

 * special thanks to my master Marc Studer
 * Elisa Foltyn coolcat-creations

 * JOOMLA admin module by Com3elles is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 **/

defined('JPATH_PLATFORM') or die;



jimport('cms.html.html');      // JHtml
jimport('cms.html.select');    // JHtmlSelect

jimport('joomla.form.helper'); // JFormHelper
JFormHelper::loadFieldClass('list');   // JFormFieldList
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\Registry\Registry;

class JFormFieldIconpicker extends JFormField
{
  protected $type = 'Iconpicker';
  // getLabel() left out
  public function getInput()

// joomla font '../../../media/vendor/fontawesome-free/css/fontawesome.min.css',

  {
    JHtml::_('stylesheet', 'media/mod_dashboard/css/style.css');
    JHtml::_('script', 'media/mod_dashboard/js/universal-icon-picker.min.js');


    $iconlist = ' <div class="input-group mb-3">
    <span class="input-group-text" id="' . $this->id . '-icon">
    <i class="fa '.$this->value.'"></i>
    </span>
    <input id="' . $this->id . '-wrapper" value="'.$this->value.'" name="' . $this->name . '-wrapper"  class="form-control"/><button id="' . $this->id . '-clear" class="btn btn-outline-secondary">
    Reset
    </button></div>';
    $iconlist .= "
    <script>
        document.addEventListener('DOMContentLoaded', function(event) {
        var uip = new UniversalIconPicker('#" . $this->id . "-wrapper', {
            iconLibraries: [
              'font-awesome.min.json'
            ],
            iconLibrariesCss: [
            '../../../media/mod_dashboard/css/font-awesome.min.css'
            ],
            resetSelector: '#" . $this->id . "-clear',  // must be an ID or '' if no reset button
            onSelect: function(jsonIconData) {
            document.getElementById('" . $this->id . "-wrapper').value = jsonIconData.iconClass;
            document.getElementById('" . $this->id . "-icon').innerHTML = jsonIconData.iconHtml;
            },
            onReset: function() {
              document.getElementById('" . $this->id . "-wrapper').value = '';
            }
            });
        });
    </script>
 ";
    return $iconlist;
  }
}
