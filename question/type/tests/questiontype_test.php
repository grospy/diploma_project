<?php
//

/**
 * Unit tests for the question type base class.
 *
 * @package    moodlecore
 * @subpackage questiontypes
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/type/questiontypebase.php');


/**
 * Tests for some of ../questionbase.php
 *
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_type_testcase extends advanced_testcase {
    public static $includecoverage = array('question/type/questiontypebase.php');

    public function test_save_question_name() {
        $this->resetAfterTest();

        $questiongenerator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $cat = $questiongenerator->create_question_category(array());

        $saq = $questiongenerator->create_question('shortanswer', null,
                array('category' => $cat->id, 'name' => 'Test question'));
        $actual = question_bank::load_question_data($saq->id);

        $this->assertSame('Test question', $actual->name);
    }

    public function test_save_question_zero_name() {
        $this->resetAfterTest();

        $questiongenerator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $cat = $questiongenerator->create_question_category(array());

        $saq = $questiongenerator->create_question('shortanswer', null,
                array('category' => $cat->id, 'name' => '0'));
        $actual = question_bank::load_question_data($saq->id);

        $this->assertSame('0', $actual->name);
    }
}
