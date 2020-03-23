<?php
//

/**
 * Tests for mod/assign/submission/onlinetext/locallib.php
 *
 * @package   assignsubmission_onlinetext
 * @copyright 2016 Cameron Ball
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/mod/assign/tests/generator.php');

/**
 * Unit tests for mod/assign/submission/onlinetext/locallib.php
 *
 * @copyright  2016 Cameron Ball
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class assignsubmission_onlinetext_locallib_testcase extends advanced_testcase {

    // Use the generator helper.
    use mod_assign_test_generator;

    /**
     * Test submission_is_empty
     *
     * @dataProvider submission_is_empty_testcases
     * @param string $submissiontext The online text submission text
     * @param bool $expected The expected return value
     */
    public function test_submission_is_empty($submissiontext, $expected) {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $student = $this->getDataGenerator()->create_and_enrol($course, 'student');
        $assign = $this->create_instance($course, [
                'assignsubmission_onlinetext_enabled' => true,
            ]);

        $this->setUser($student->id);

        $plugin = $assign->get_submission_plugin_by_type('onlinetext');
        $result = $plugin->submission_is_empty((object) [
                'onlinetext_editor' => [
                    'text' => $submissiontext,
                ],
            ]);
        $this->assertTrue($result === $expected);
    }

    /**
     * Test new_submission_empty
     *
     * @dataProvider submission_is_empty_testcases
     * @param string $submissiontext The file submission data
     * @param bool $expected The expected return value
     */
    public function test_new_submission_empty($submissiontext, $expected) {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $student = $this->getDataGenerator()->create_and_enrol($course, 'student');
        $assign = $this->create_instance($course, [
                'assignsubmission_onlinetext_enabled' => true,
            ]);

        $this->setUser($student->id);

        $result = $assign->new_submission_empty((object) [
                'onlinetext_editor' => [
                    'text' => $submissiontext,
                ],
            ]);

        $this->assertTrue($result === $expected);
    }

    /**
     * Dataprovider for the test_submission_is_empty testcase
     *
     * @return array of testcases
     */
    public function submission_is_empty_testcases() {
        return [
            'Empty submission string' => ['', true],
            'Empty submission null' => [null, true],
            'Value 0' => [0, false],
            'String 0' => ['0', false],
            'Text' => ['Ai! laurië lantar lassi súrinen, yéni únótimë ve rámar aldaron!', false],
            'Image' => ['<img src="test.jpg" />', false],
            'Video' => ['<video controls="true"><source src="test.mp4"></video>', false],
            'Audio' => ['<audio controls="true"><source src="test.mp3"></audio>', false],
        ];
    }
}
