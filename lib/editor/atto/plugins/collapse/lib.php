<?php
//

/**
 * Atto text editor integration version file.
 *
 * @package    atto_collapse
 * @copyright  2013 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Initialise the js strings required for this module.
 */
function atto_collapse_strings_for_js() {
    global $PAGE;

    $PAGE->requires->strings_for_js(array('showmore', 'showfewer'), 'atto_collapse');
}

/**
 * Set params for this plugin
 * @param string $elementid
 */
function atto_collapse_params_for_js($elementid, $options, $fpoptions) {
    // Pass the number of visible groups as a param.
    $params = array('showgroups' => get_config('atto_collapse', 'showgroups'));
    return $params;
}

/**
 * Map icons for font-awesome themes.
 */
function atto_collapse_get_fontawesome_icon_map() {
    return [
        'atto_collapse:icon' => 'fa-level-down'
    ];
}
