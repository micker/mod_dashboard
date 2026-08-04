<?php
/**
 * @version 0.6.0 stable $Id: iconpicker.php yannick berges
 * @package Joomla
 * @copyright (C) 2018 Berges Yannick - www.com3elles.com
 * @license GNU/GPL v2
 *
 * special thanks to my master Marc Studer
 * Elisa Foltyn coolcat-creations
 *
 * JOOMLA admin module by Com3elles is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 **/

defined('_JEXEC') or die;

use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * Form Field class for icon picker
 *
 * @since  0.6.0
 */
class JFormFieldIconpicker extends FormField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  0.6.0
     */
    protected $type = 'Iconpicker';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   0.6.0
     */
    protected function getInput()
    {
       
        // Charger les assets CSS
        HTMLHelper::_('stylesheet', 'media/mod_dashboard/css/style.css');
        HTMLHelper::_('stylesheet', 'media/mod_dashboard/css/font-awesome.min.css');
        
        // Charger le script JS principal
       HTMLHelper::_('script', 'media/mod_dashboard/js/universal-icon-picker.min.js');

        $id    = htmlspecialchars($this->id, ENT_QUOTES, 'UTF-8');
    $name  = htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8');
    $value = htmlspecialchars((string) $this->value, ENT_QUOTES, 'UTF-8');

    $iconlist = ' <div class="input-group mb-3">
    <span class="input-group-text" id="' . $id . '-icon">
    <i class="fa '.$value.'"></i>
    </span>
    <input id="' . $id . '-wrapper" value="'.$value.'" name="' . $name . '-wrapper"  class="form-control"/><button type="button" id="' . $id . '-clear" class="btn btn-outline-secondary">
    Reset
    </button></div>';
    $iconlist .= "
    <script>
        document.addEventListener('DOMContentLoaded', function(event) {
        var uip = new UniversalIconPicker('#" . $id . "-wrapper', {
            iconLibraries: [
              'font-awesome.min.json'
            ],
            iconLibrariesCss: [
            '../../../media/mod_flexiadmin/css/font-awesome.min.css'
            ],
            resetSelector: '#" . $id . "-clear',  // must be an ID or '' if no reset button
            onSelect: function(jsonIconData) {
            document.getElementById('" . $id . "-wrapper').value = jsonIconData.iconClass;
            document.getElementById('" . $id . "-icon').innerHTML = jsonIconData.iconHtml;
            },
            onReset: function() {
              document.getElementById('" . $id . "-wrapper').value = '';
            }
            });
        });
    </script>
 ";
    return $iconlist;
  }
}
