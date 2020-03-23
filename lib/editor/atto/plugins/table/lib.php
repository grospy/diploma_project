<?php
//

/**
 * Atto text editor integration version file.
 *
 * @package    atto_table
 * @copyright  2013 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Initialise the js strings required for this module.
 */
function atto_table_strings_for_js() {
    global $PAGE;

    $PAGE->requires->strings_for_js(array('createtable',
                                          'updatetable',
                                          'appearance',
                                          'headers',
                                          'caption',
                                          'columns',
                                          'rows',
                                          'numberofcolumns',
                                          'numberofrows',
                                          'both',
                                          'edittable',
                                          'addcolumnafter',
                                          'addrowafter',
                                          'movecolumnright',
                                          'movecolumnleft',
                                          'moverowdown',
                                          'moverowup',
                                          'deleterow',
                                          'deletecolumn',
                                          'captionposition',
                                          'borders',
                                          'bordersize',
                                          'bordercolour',
                                          'borderstyles',
                                          'none',
                                          'all',
                                          'backgroundcolour',
                                          'width',
                                          'outer',
                                          'noborder',
                                          'themedefault',
                                          'dotted',
                                          'dashed',
                                          'solid'),
                                    'atto_table');

    $PAGE->requires->strings_for_js(array('top',
                                          'bottom'),
                                    'editor');
}

/**
 * Set params for this plugin
 * @param string $elementid
 * @param string $options
 * @param string $foptions
 */
function atto_table_params_for_js($elementid, $options, $foptions) {
    $params = array('allowBorders' => (bool) get_config('atto_table', 'allowborders'),
                    'allowWidth' => (bool) get_config('atto_table', 'allowwidth'),
                    'allowBackgroundColour' => (bool) get_config('atto_table', 'allowbackgroundcolour'));
    return $params;
}
