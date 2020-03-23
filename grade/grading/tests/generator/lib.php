<?php
//

/**
 * Generator for the core_grading subsystem generator.
 *
 * @package    core_grading
 * @category   test
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * Generator for the core_grading subsystem generator.
 *
 * @package    core_grading
 * @category   test
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_grading_generator extends component_generator_base {

    /**
     * Create an instance of an advanced grading area.
     *
     * @param context $context
     * @param string $component
     * @param string $areaname An area belonging to the specified component
     * @param string $method An available gradingform type
     * @return gradingform_controller The controller for the created instance
     */
    public function create_instance(context $context, string $component, string $areaname, string $method): gradingform_controller {
        require_once(__DIR__ . '/../../lib.php');

        $manager = get_grading_manager($context, $component, $areaname);
        $manager->set_active_method($method);

        return $manager->get_controller($method);
    }
}
