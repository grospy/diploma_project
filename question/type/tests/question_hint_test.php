<?php
//

/**
 * Unit tests for the question_hint and subclasses.
 *
 * @package   core_question
 * @copyright 2008 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/type/questiontypebase.php');


/**
 * Test for question_hint and subclasses.
 *
 * @copyright  2010 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_hint_testcase extends advanced_testcase {
    public function test_basic() {
        $row = new stdClass();
        $row->id = 123;
        $row->hint = 'A hint';
        $row->hintformat = FORMAT_HTML;
        $hint = question_hint::load_from_record($row);
        $this->assertEquals($row->id, $hint->id);
        $this->assertEquals($row->hint, $hint->hint);
        $this->assertEquals($row->hintformat, $hint->hintformat);
    }

    public function test_with_parts() {
        $row = new stdClass();
        $row->id = 123;
        $row->hint = 'A hint';
        $row->hintformat = FORMAT_HTML;
        $row->shownumcorrect = 1;
        $row->clearwrong = 1;

        $hint = question_hint_with_parts::load_from_record($row);
        $this->assertEquals($row->id, $hint->id);
        $this->assertEquals($row->hint, $hint->hint);
        $this->assertEquals($row->hintformat, $hint->hintformat);
        $this->assertNotEmpty($hint->shownumcorrect);
        $this->assertNotEmpty($hint->clearwrong);
    }
}