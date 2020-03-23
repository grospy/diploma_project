<?php
//

/**
 * Tests for notes library functions.
 *
 * @package    core_notes
 * @copyright  2015 onwards Ankit agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/notes/lib.php');
/**
 * Class core_notes_lib_testcase
 *
 * @package    core_notes
 * @copyright  2015 onwards Ankit agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class core_notes_lib_testcase extends advanced_testcase {

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
     * Tests the core_notes_myprofile_navigation() function.
     */
    public function test_core_notes_myprofile_navigation() {
        global $USER;

        // Set up the test.
        $this->setAdminUser();
        $iscurrentuser = true;

        // Enable notes.
        set_config('enablenotes', true);

        // Check the node tree is correct.
        core_notes_myprofile_navigation($this->tree, $USER, $iscurrentuser, $this->course);
        $reflector = new ReflectionObject($this->tree);
        $nodes = $reflector->getProperty('nodes');
        $nodes->setAccessible(true);
        $this->assertArrayHasKey('notes', $nodes->getValue($this->tree));
    }

    /**
     * Tests the core_notes_myprofile_navigation() function.
     */
    public function test_core_notes_myprofile_navigation_as_guest() {
        global $USER;

        $this->setGuestUser();
        $iscurrentuser = false;

        // Check the node tree is correct.
        core_notes_myprofile_navigation($this->tree, $USER, $iscurrentuser, $this->course);
        $reflector = new ReflectionObject($this->tree);
        $nodes = $reflector->getProperty('nodes');
        $nodes->setAccessible(true);
        $this->assertArrayNotHasKey('notes', $nodes->getValue($this->tree));
    }

    /**
     * Tests the core_notes_myprofile_navigation() function.
     */
    public function test_core_notes_myprofile_navigation_notes_disabled() {
        global $USER;

        $this->setAdminUser();
        $iscurrentuser = false;

        // Disable notes.
        set_config('enablenotes', false);

        // Check the node tree is correct.
        core_notes_myprofile_navigation($this->tree, $USER, $iscurrentuser, $this->course);
        $reflector = new ReflectionObject($this->tree);
        $nodes = $reflector->getProperty('nodes');
        $nodes->setAccessible(true);
        $this->assertArrayNotHasKey('notes', $nodes->getValue($this->tree));
    }
}