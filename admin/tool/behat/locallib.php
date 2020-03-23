<?php
//

/**
 * Behat commands
 *
 * @package    tool_behat
 * @copyright  2012 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/behat/classes/behat_command.php');
require_once($CFG->libdir . '/behat/classes/behat_config_manager.php');
require_once($CFG->dirroot . '/' . $CFG->admin . '/tool/behat/steps_definitions_form.php');

/**
 * Behat commands manager
 *
 * @package    tool_behat
 * @copyright  2012 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_behat {

    /**
     * Lists the available steps definitions
     *
     * @param string $type
     * @param string $component
     * @param string $filter
     * @return array System steps or empty array if case there are no steps
     */
    public static function stepsdefinitions($type, $component, $filter) {

        // We don't require the test environment to be enabled to list the steps definitions
        // so test writers can more easily set up the environment.
        behat_command::behat_setup_problem();

        // The loaded steps depends on the component specified.
        behat_config_manager::update_config_file($component, false);

        // The Moodle\BehatExtension\Definition\Printer\ConsoleDefinitionInformationPrinter will parse this search format.
        if ($type) {
            $filter .= '&&' . $type;
        }

        if ($filter) {
            $filteroption = ' -d ' . escapeshellarg($filter);
        } else {
            $filteroption = ' -di';
        }

        // Get steps definitions from Behat.
        $options = ' --config="'.behat_config_manager::get_steps_list_config_filepath(). '" '.$filteroption;
        list($steps, $code) = behat_command::run($options);

        return $steps;
    }

}
