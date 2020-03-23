<?php
//

/**
 * Data activity filter version information
 *
 * @package    filter
 * @subpackage data
 * @copyright  2011 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version  = 2019111800;
$plugin->requires = 2019111200;  // Requires this Moodle version.
$plugin->component= 'filter_data';

$plugin->dependencies = array('mod_data' => 2019111200);
