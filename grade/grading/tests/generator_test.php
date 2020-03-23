<?php
//

/**
 * Generator testcase for the gradingforum_rubric generator.
 *
 * @package    core_grading
 * @category   test
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tests\core_grading;

use advanced_testcase;
use context_module;
use gradingform_controller;
use gradingform_rubric_controller;

/**
 * Generator testcase for the core_grading generator.
 *
 * @package    core_grading
 * @category   test
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class generator_testcase extends advanced_testcase {

    /**
     * Test gradingform controller creation.
     */
    public function test_create_instance(): void {
        $this->resetAfterTest(true);

        // Fetch generators.
        $generator = \testing_util::get_data_generator();
        $gradinggenerator = $generator->get_plugin_generator('core_grading');

        // Create items required for testing.
        $course = $generator->create_course();
        $module = $generator->create_module('assign', ['course' => $course]);
        $user = $generator->create_user();
        $context = context_module::instance($module->cmid);

        // The assignment module has an itemumber 0 which is an advanced grading area called 'submissions'.
        $component = 'mod_assign';
        $area = 'submissions';
        $controller = $gradinggenerator->create_instance($context, $component, $area, 'rubric');

        // This should be a rubric.
        $this->assertInstanceOf(gradingform_controller::class, $controller);
        $this->assertInstanceOf(gradingform_rubric_controller::class, $controller);

        $this->assertEquals($context, $controller->get_context());
        $this->assertEquals($component, $controller->get_component());
        $this->assertEquals($area, $controller->get_area());
    }
}
