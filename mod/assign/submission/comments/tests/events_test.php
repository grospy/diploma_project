<?php
//

/**
 * Events tests.
 *
 * @package    assignsubmission_comments
 * @category   test
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/mod/assign/lib.php');
require_once($CFG->dirroot . '/mod/assign/locallib.php');
require_once($CFG->dirroot . '/mod/assign/tests/generator.php');
require_once($CFG->dirroot . '/comment/lib.php');

/**
 * Events tests class.
 *
 * @package    assignsubmission_comments
 * @category   test
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class assignsubmission_comments_events_testcase extends advanced_testcase {

    // Use the generator helper.
    use mod_assign_test_generator;

    /**
     * Test comment_created event.
     */
    public function test_comment_created() {
        $this->resetAfterTest();
        $course = $this->getDataGenerator()->create_course();
        $teacher = $this->getDataGenerator()->create_and_enrol($course, 'teacher');
        $student = $this->getDataGenerator()->create_and_enrol($course, 'student');

        $assign = $this->create_instance($course);

        $this->setUser($teacher);
        $submission = $assign->get_user_submission($student->id, true);

        $context = $assign->get_context();
        $options = new stdClass();
        $options->area = 'submission_comments';
        $options->course = $assign->get_course();
        $options->context = $context;
        $options->itemid = $submission->id;
        $options->component = 'assignsubmission_comments';
        $options->showcount = true;
        $options->displaycancel = true;

        $comment = new comment($options);

        // Triggering and capturing the event.
        $sink = $this->redirectEvents();
        $comment->add('New comment');
        $events = $sink->get_events();
        $this->assertCount(1, $events);
        $event = reset($events);
        $sink->close();

        // Checking that the event contains the expected values.
        $this->assertInstanceOf('\assignsubmission_comments\event\comment_created', $event);
        $this->assertEquals($context, $event->get_context());
        $url = new moodle_url('/mod/assign/view.php', array('id' => $assign->get_course_module()->id));
        $this->assertEquals($url, $event->get_url());
        $this->assertEventContextNotUsed($event);
    }

    /**
     * Test comment_deleted event.
     */
    public function test_comment_deleted() {
        $this->resetAfterTest();
        $course = $this->getDataGenerator()->create_course();
        $teacher = $this->getDataGenerator()->create_and_enrol($course, 'teacher');
        $student = $this->getDataGenerator()->create_and_enrol($course, 'student');

        $assign = $this->create_instance($course);

        $this->setUser($teacher);
        $submission = $assign->get_user_submission($student->id, true);

        $context = $assign->get_context();
        $options = new stdClass();
        $options->area    = 'submission_comments';
        $options->course    = $assign->get_course();
        $options->context = $context;
        $options->itemid  = $submission->id;
        $options->component = 'assignsubmission_comments';
        $options->showcount = true;
        $options->displaycancel = true;
        $comment = new comment($options);
        $newcomment = $comment->add('New comment 1');

        // Triggering and capturing the event.
        $sink = $this->redirectEvents();
        $comment->delete($newcomment->id);
        $events = $sink->get_events();
        $this->assertCount(1, $events);
        $event = reset($events);

        // Checking that the event contains the expected values.
        $this->assertInstanceOf('\assignsubmission_comments\event\comment_deleted', $event);
        $this->assertEquals($context, $event->get_context());
        $url = new moodle_url('/mod/assign/view.php', array('id' => $assign->get_course_module()->id));
        $this->assertEquals($url, $event->get_url());
        $this->assertEventContextNotUsed($event);
    }
}
