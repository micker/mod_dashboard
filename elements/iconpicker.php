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

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

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
        $doc = Factory::getApplication()->getDocument();
        
        // Charger les assets CSS
        $doc->addStyleSheet(Uri::root(true) . '/media/mod_dashboard/css/style.css');
        $doc->addStyleSheet(Uri::root(true) . '/media/mod_dashboard/css/font-awesome.min.css');
        
        // Charger le script JS principal
        $doc->addScript(Uri::root(true) . '/media/mod_dashboard/js/universal-icon-picker.min.js');

        // Utiliser WAI-ARIA pour l'accessibilité
        $iconlist = '<div class="input-group mb-3">';
        $iconlist .= '    <span class="input-group-text" id="' . $this->id . '-icon" aria-label="' . Text::_('MOD_DASHBOARD_ICON_PREVIEW') . '">';
        $iconlist .= '        <i class="fa ' . htmlspecialchars($this->value, ENT_QUOTES, 'UTF-8') . '"></i>';
        $iconlist .= '    </span>';
        $iconlist .= '    <input type="text" ';
        $iconlist .= '        id="' . $this->id . '-wrapper" ';
        $iconlist .= '        value="' . htmlspecialchars($this->value, ENT_QUOTES, 'UTF-8') . '" ';
        $iconlist .= '        name="' . $this->name . '-wrapper" ';
        $iconlist .= '        class="form-control" ';
        $iconlist .= '        aria-describedby="' . $this->id . '-icon" />';
        $iconlist .= '    <button type="button" ';
        $iconlist .= '        id="' . $this->id . '-clear" ';
        $iconlist .= '        class="btn btn-outline-secondary">';
        $iconlist .= '        ' . Text::_('JCLEAR') . '';
        $iconlist .= '    </button>';
        $iconlist .= '</div>';

        // Ajouter le JavaScript inline avec timeout maximum
        $script = "
(function() {
    let attempts = 0;
    const maxAttempts = 50; // 5 secondes maximum (50 * 100ms)
    
    function initIconPicker() {
        attempts++;
        
        if (typeof UniversalIconPicker === 'undefined') {
            if (attempts < maxAttempts) {
                setTimeout(initIconPicker, 100);
            } else {
                console.error('UniversalIconPicker library failed to load after ' + (maxAttempts * 100 / 1000) + ' seconds');
                console.error('Please check if the file exists at: ' + '" . Uri::root(true) . "/media/mod_dashboard/js/universal-icon-picker.min.js');
            }
            return;
        }
        
        try {
            const uip = new UniversalIconPicker('#" . $this->id . "-wrapper', {
                iconLibraries: [
                    'font-awesome.min.json'
                ],
                iconLibrariesCss: [
                    '" . Uri::root(true) . "/media/mod_dashboard/css/font-awesome.min.css'
                ],
                resetSelector: '#" . $this->id . "-clear',
                onSelect: function(jsonIconData) {
                    const wrapperInput = document.getElementById('" . $this->id . "-wrapper');
                    const iconSpan = document.getElementById('" . $this->id . "-icon');
                    if (wrapperInput) {
                        wrapperInput.value = jsonIconData.iconClass;
                    }
                    if (iconSpan) {
                        iconSpan.innerHTML = jsonIconData.iconHtml;
                    }
                },
                onReset: function() {
                    const wrapperInput = document.getElementById('" . $this->id . "-wrapper');
                    const iconSpan = document.getElementById('" . $this->id . "-icon');
                    if (wrapperInput) {
                        wrapperInput.value = '';
                    }
                    if (iconSpan) {
                        iconSpan.innerHTML = '<i class=\"fa\"></i>';
                    }
                }
            });
            console.log('UniversalIconPicker initialized successfully for field: " . $this->id . "');
        } catch (error) {
            console.error('Error initializing UniversalIconPicker:', error);
        }
    }
    
    // Attendre que la page soit complètement chargée
    window.addEventListener('load', function() {
        setTimeout(initIconPicker, 100);
    });
})();
";

        $doc->addScriptDeclaration($script);

        return $iconlist;
    }
}