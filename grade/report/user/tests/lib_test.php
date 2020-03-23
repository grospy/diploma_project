<?php
//

/**
 * Tests for gradereport_user library functions.
 *
 * @package    gradereport_user
 * @copyright  2015 onwards Ankit agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/grade/report/user/lib.php');

/**
 * Class gradereport_user_lib_testcase.
 *
 * @package    gradereport_user
 * @copyright  2015 onwards Ankit agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class gradereport_user_lib_testcase extends advanced_testcase {

    /**
     * @var stdClass The user.
     */
    private $user;

    /**
     * @var stdClass The course.
     */
    private $course;

    /**
     * @var \core_user\output\myprofile\tree The navigation tree.
     */
    private $tree;

    public function setUp() {
        $this->user = $this->getDataGenerator()->create_user();
        $this->course = $this->getDataGenerator()->create_course();
        $this->tree = new \core_user\output\myprofile\tree();
        $this->resetAfterTest();
    }

    /**
     * Tests the gradereport_user_myprofile_navigation() function.
     */
    public function test_gradereport_user_myprofile_navigation() {
        $this->setAdminUser();
        $iscurrentuser = false;

        gradereport_user_myprofile_navigation($this->tree, $this->user, $iscurrentuser, $this->course);
        $reflector = new ReflectionObject($this->tree);
        $nodes = $reflector->getProperty('nodes');
        $nodes->setAccessible(true);
        $this->assertArrayHasKey('grade', $nodes->getValue($this->tree));
    }

    /**
     * Tests the gradereport_user_myprofile_navigation() function for a user
     * without permission to view the grade node.
     */
    public function test_gradereport_user_myprofile_navigation_without_permission() {
        $this->setUser($this->user);
        $iscurrentuser = true;

        gradereport_user_myprofile_navigation($this->tree, $this->user, $iscurrentuser, $this->course);
        $reflector = new ReflectionObject($this->tree);
        $nodes = $reflector->getProperty('nodes');
        $nodes->setAccessible(true);
        $this->assertArrayNotHasKey('grade', $nodes->getValue($this->tree));
    }
}
