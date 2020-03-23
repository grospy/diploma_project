<?php
//

/**
 * Web interface to list and filter steps
 *
 * @package    tool_behat
 * @copyright  2012 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot . '/' . $CFG->admin . '/tool/behat/locallib.php');
require_once($CFG->libdir . '/behat/classes/behat_config_manager.php');

// This page usually takes an exceedingly long time to load, so we need to
// increase the time limit. At present it takes about a minute on some
// systems, but let's allow room for expansion.
core_php_time_limit::raise(300);

$filter = optional_param('filter', '', PARAM_NOTAGS);
$type = optional_param('type', false, PARAM_ALPHAEXT);
$component = optional_param('component', '', PARAM_ALPHAEXT);

admin_externalpage_setup('toolbehat');

// Getting available steps definitions from behat.
$steps = tool_behat::stepsdefinitions($type, $component, $filter);

// Form.
$componentswithsteps = array('' => get_string('allavailablesteps', 'tool_behat'));

// Complete the components list with the moodle steps definitions.
$behatconfig = new behat_config_util();
$components = $behatconfig->get_components_contexts();
if ($components) {
    foreach ($components as $component => $filepath) {
        // TODO Use a class static attribute instead of the class name.
        $componentswithsteps[$component] = 'Moodle ' . substr($component, 6);
    }
}
$form = new steps_definitions_form(null, array('components' => $componentswithsteps));

// Output contents.
$renderer = $PAGE->get_renderer('tool_behat');
echo $renderer->render_stepsdefinitions($steps, $form);

