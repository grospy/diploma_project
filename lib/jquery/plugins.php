<?php
//

/**
 * This file describes jQuery plugins available in the Moodle
 * core component. These can be included in page using:
 *   $PAGE->requires->jquery();
 *   $PAGE->requires->jquery_plugin('ui');
 *   $PAGE->requires->jquery_plugin('ui-css');
 *
 * Please note that other moodle plugins can not use the same
 * jquery plugin names, only one is loaded if collision detected.
 *
 * Any Moodle plugin may add jquery/plugins.php that defines extra
 * jQuery plugins.
 *
 * Themes and other plugins may override any jquery plugin,
 * for example to override default jQueryUI theme.
 *
 * @package    core
 * @copyright  2013 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$plugins = array(
    'jquery'  => array('files' => array('jquery-3.4.1.min.js')),
    'ui'      => array('files' => array('ui-1.12.1/jquery-ui.min.js')),
    'ui-css'  => array('files' => array('ui-1.12.1/theme/smoothness/jquery-ui.min.css')),
);
