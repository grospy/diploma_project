<?php
//

/**
 * Unit tests for the task that fetch the latest version of H5P content types.
 *
 * @package   core
 * @copyright  2019 Victor Deniz <victor@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_h5p\autoloader;
use core_h5p\h5p_test_factory;

defined('MOODLE_INTERNAL') || die();

/**
 * Class containing unit tests for the task that fetch the latest version of H5P content types.
 *
 * @package   core
 * @copyright  2019 Victor Deniz <victor@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @runTestsInSeparateProcesses
 */
class h5p_get_content_types_task_test extends advanced_testcase {

    protected function setup() {
        global $CFG;
        parent::setUp();

        autoloader::register();

        require_once($CFG->libdir . '/tests/fixtures/testable_core_h5p.php');
    }

    /**
     * Test task execution
     *
     * return void
     */
    public function test_task_execution(): void {

        if (!PHPUNIT_LONGTEST) {
            $this->markTestSkipped('PHPUNIT_LONGTEST is not defined');
        }

        $this->resetAfterTest();

        // Fetch generator.
        $generator = \testing_util::get_data_generator();
        $h5pgenerator = $generator->get_plugin_generator('core_h5p');

        $factory = new h5p_test_factory();
        $core = $factory->get_core();
        $core->set_endpoint($this->getExternalTestFileUrl(''));
        $contenttypespending = ['H5P.Accordion'];

        $h5pgenerator->create_content_types( $contenttypespending, $core);

        // Mock implementation of \core\task\h5p_get_content_types_task::get_core to avoid external systems.
        $mocktask = $this->getMockBuilder(\core\task\h5p_get_content_types_task::class)
            ->setMethods(['get_core'])
            ->getMock();

        $mocktask->expects($this->any())
            ->method('get_core')
            ->willReturn($core);

        $mocktask->execute();
        $this->expectOutputRegex('/1 new content types/');
    }
}
