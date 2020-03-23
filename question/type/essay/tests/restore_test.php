<?php
//

/**
 * Test restore logic.
 *
 * @package    qtype_essay
 * @copyright  2019 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . "/phpunit/classes/restore_date_testcase.php");

/**
 * Test restore logic.
 *
 * @copyright  2019 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_essay_restore_testcase extends restore_date_testcase  {

    /**
     * Test missing qtype_essay_options creation.
     *
     * Old backup files may contain essays with no qtype_essay_options record.
     * During restore, we add default options for any questions like that.
     * That is what is tested in this file.
     */
    public function test_restore_create_missing_qtype_essay_options() {
        global $DB;

        // Create a course with one essay question in its question bank.
        $generator = $this->getDataGenerator();
        $course = $generator->create_course();
        $contexts = new question_edit_contexts(context_course::instance($course->id));
        $category = question_make_default_categories($contexts->all());
        $questiongenerator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $essay = $questiongenerator->create_question('essay', null, array('category' => $category->id));

        // Remove the options record, which means that the backup will look like a backup made in an old Moodle.
        $DB->delete_records('qtype_essay_options', ['questionid' => $essay->id]);

        // Do backup and restore.
        $newcourseid = $this->backup_and_restore($course);

        // Verify that the restored question has options.
        $contexts = new question_edit_contexts(context_course::instance($newcourseid));
        $newcategory = question_make_default_categories($contexts->all());
        $newessay = $DB->get_record('question', ['category' => $newcategory->id, 'qtype' => 'essay']);
        $this->assertTrue($DB->record_exists('qtype_essay_options', ['questionid' => $newessay->id]));
    }
}
