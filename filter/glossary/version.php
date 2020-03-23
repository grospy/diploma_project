<?php
//

/**
 * Glossary filter version information
 *
 * @package    filter
 * @subpackage glossary
 * @copyright  2011 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version  = 2019111800;
$plugin->requires = 2019111200;  // Requires this Moodle version.
$plugin->component= 'filter_glossary';

$plugin->dependencies = array('mod_glossary' => 2019111200);
