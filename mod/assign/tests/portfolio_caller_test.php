<?php
//

/**
 * Tests behaviour of the assign_portfolio_caller class.
 *
 * @package mod_assign
 * @category test
 * @copyright Brendan Cox <brendan.cox@totaralearning.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/mod/assign/locallib.php');
require_once($CFG->dirroot . '/group/lib.php');

/**
 * Class mod_assign_portfolio_caller_testcase
 *
 * Tests behaviour of the assign_portfolio_caller class.
 *
 * @copyright Brendan Cox <brendan.cox@totaralearning.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_assign_portfolio_caller_testcase extends advanced_testcase {

    /**
     * Test an assignment file is loaded for a user who submitted it.
     */
    public function test_user_submission_file_is_loaded() {
        $this->resetAfterTest(true);

        $user = $this->getDataGenerator()->create_user();
        $course = $this->getDataGenerator()->create_course();

        /* @var mod_assign_generator $assigngenerator */
        $assigngenerator = $this->getDataGenerator()->get_plugin_generator('mod_assign');

        $activityrecord = $assigngenerator->create_instance(array('course' => $course->id));
        $cm = get_coursemodule_from_instance('assign', $activityrecord->id);
        $context = context_module::instance($cm->id);
        $assign = new mod_assign_testable_assign($context, $cm, $course);

        $submission = $assign->get_user_submission($user->id, true);

        $fs = get_file_storage();
        $dummy = (object) array(
            'contextid' => $context->id,
            'component' => 'assignsubmission_file',
            'filearea' => ASSIGNSUBMISSION_FILE_FILEAREA,
            'itemid' => $submission->id,
            'filepath' => '/',
            'filename' => 'myassignmnent.pdf'
        );
        $file = $fs->create_file_from_string($dummy, 'Content of ' . $dummy->filename);

        $caller = new assign_portfolio_caller(array('cmid' => $cm->id, 'fileid' => $file->get_id()));
        $caller->set('user', $user);
        $caller->load_data();
        $this->assertEquals($file->get_contenthash(), $caller->get_sha1_file());

        // This processes the file either by fileid or by other fields in the file table.
        // We should get the same outcome with either approach.
        $caller = new assign_portfolio_caller(
            array(
                'cmid' => $cm->id,
                'sid' => $submission->id,
                'area' => ASSIGNSUBMISSION_FILE_FILEAREA,
                'component' => 'assignsubmission_file',
            )
        );
        $caller->set('user', $user);
        $caller->load_data();
        $this->assertEquals($file->get_contenthash(), $caller->get_sha1_file());
    }

    /**
     * Test an assignment file is not loaded for a user that did not submit it.
     */
    public function test_different_user_submission_file_is_not_loaded() {
        $this->resetAfterTest(true);

        $user = $this->getDataGenerator()->create_user();
        $course = $this->getDataGenerator()->create_course();

        /* @var mod_assign_generator $assigngenerator */
        $assigngenerator = $this->getDataGenerator()->get_plugin_generator('mod_assign');

        $activityrecord = $assigngenerator->create_instance(array('course' => $course->id));
        $cm = get_coursemodule_from_instance('assign', $activityrecord->id);
        $context = context_module::instance($cm->id);
        $assign = new mod_assign_testable_assign($context, $cm, $course);

        $submission = $assign->get_user_submission($user->id, true);

        $fs = get_file_storage();
        $dummy = (object) array(
            'contextid' => $context->id,
            'component' => 'assignsubmission_file',
            'filearea' => ASSIGNSUBMISSION_FILE_FILEAREA,
            'itemid' => $submission->id,
            'filepath' => '/',
            'filename' => 'myassignmnent.pdf'
        );
        $file = $fs->create_file_from_string($dummy, 'Content of ' . $dummy->filename);

        // Now add second user.
        $wronguser = $this->getDataGenerator()->create_user();

        $caller = new assign_portfolio_caller(array('cmid' => $cm->id, 'fileid' => $file->get_id()));
        $caller->set('user', $wronguser);

        $this->expectException(portfolio_caller_exception::class);
        $this->expectExceptionMessage('Sorry, the requested file could not be found');

        $caller->load_data();
    }

    /**
     * Test an assignment file is loaded for a user who is part of a group that submitted it.
     */
    public function test_group_submission_file_is_loaded() {
        $this->resetAfterTest(true);

        $user = $this->getDataGenerator()->create_user();
        $course = $this->getDataGenerator()->create_course();

        $groupdata = new stdClass();
        $groupdata->courseid = $course->id;
        $groupdata->name = 'group1';
        $groupid = groups_create_group($groupdata);
        $this->getDataGenerator()->enrol_user($user->id, $course->id);
        groups_add_member($groupid, $user);

        /* @var mod_assign_generator $assigngenerator */
        $assigngenerator = $this->getDataGenerator()->get_plugin_generator('mod_assign');

        $activityrecord = $assigngenerator->create_instance(array('course' => $course->id));
        $cm = get_coursemodule_from_instance('assign', $activityrecord->id);
        $context = context_module::instance($cm->id);
        $assign = new mod_assign_testable_assign($context, $cm, $course);

        $submission = $assign->get_group_submission($user->id, $groupid, true);

        $fs = get_file_storage();
        $dummy = (object) array(
            'contextid' => $context->id,
            'component' => 'assignsubmission_file',
            'filearea' => ASSIGNSUBMISSION_FILE_FILEAREA,
            'itemid' => $submission->id,
            'filepath' => '/',
            'filename' => 'myassignmnent.pdf'
        );
        $file = $fs->create_file_from_string($dummy, 'Content of ' . $dummy->filename);

        $caller = new assign_portfolio_caller(array('cmid' => $cm->id, 'fileid' => $file->get_id()));
        $caller->set('user', $user);
        $caller->load_data();
        $this->assertEquals($file->get_contenthash(), $caller->get_sha1_file());

        // This processes the file either by fileid or by other fields in the file table.
        // We should get the same outcome with either approach.
        $caller = new assign_portfolio_caller(
            array(
                'cmid' => $cm->id,
                'sid' => $submission->id,
                'area' => ASSIGNSUBMISSION_FILE_FILEAREA,
                'component' => 'assignsubmission_file',
            )
        );
        $caller->set('user', $user);
        $caller->load_data();
        $this->assertEquals($file->get_contenthash(), $caller->get_sha1_file());
    }

    /**
     * Test an assignment file is not loaded for a user who is not part of a group that submitted it.
     */
    public function test_different_group_submission_file_is_not_loaded() {
        $this->resetAfterTest(true);

        $user = $this->getDataGenerator()->create_user();
        $course = $this->getDataGenerator()->create_course();

        $groupdata = new stdClass();
        $groupdata->courseid = $course->id;
        $groupdata->name = 'group1';
        $groupid = groups_create_group($groupdata);
        $this->getDataGenerator()->enrol_user($user->id, $course->id);
        groups_add_member($groupid, $user);

        /* @var mod_assign_generator $assigngenerator */
        $assigngenerator = $this->getDataGenerator()->get_plugin_generator('mod_assign');

        $activityrecord = $assigngenerator->create_instance(array('course' => $course->id));
        $cm = get_coursemodule_from_instance('assign', $activityrecord->id);
        $context = context_module::instance($cm->id);
        $assign = new mod_assign_testable_assign($context, $cm, $course);

        $submission = $assign->get_group_submission($user->id, $groupid,true);

        $fs = get_file_storage();
        $dummy = (object) array(
            'contextid' => $context->id,
            'component' => 'assignsubmission_file',
            'filearea' => ASSIGNSUBMISSION_FILE_FILEAREA,
            'itemid' => $submission->id,
            'filepath' => '/',
            'filename' => 'myassignmnent.pdf'
        );
        $file = $fs->create_file_from_string($dummy, 'Content of ' . $dummy->filename);

        // Now add second user.
        $wronguser = $this->getDataGenerator()->create_user();

        // Create a new group for the wrong user.
        $groupdata = new stdClass();
        $groupdata->courseid = $course->id;
        $groupdata->name = 'group2';
        $groupid = groups_create_group($groupdata);
        $this->getDataGenerator()->enrol_user($wronguser->id, $course->id);
        groups_add_member($groupid, $wronguser);

        // In the negative test for the user, we loaded the caller via fileid. Switching to the other approach this time.
        $caller = new assign_portfolio_caller(
            array(
                'cmid' => $cm->id,
                'sid' => $submission->id,
                'area' => ASSIGNSUBMISSION_FILE_FILEAREA,
                'component' => 'assignsubmission_file',
            )
        );
        $caller->set('user', $wronguser);

        $this->expectException(portfolio_caller_exception::class);
        $this->expectExceptionMessage('Sorry, the requested file could not be found');

        $caller->load_data();
    }
}
