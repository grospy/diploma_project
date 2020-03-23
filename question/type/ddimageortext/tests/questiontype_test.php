<?php
//

/**
 * Unit tests for the drag-and-drop onto image question definition class.
 *
 * @package   qtype_ddimageortext
 * @copyright 2010 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/engine/tests/helpers.php');
require_once($CFG->dirroot . '/question/type/ddimageortext/tests/helper.php');


/**
 * Unit tests for the drag-and-drop onto image question definition class.
 *
 * @copyright 2010 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_ddimageortext_test extends basic_testcase {
    /** @var qtype_ddimageortext instance of the question type class to test. */
    protected $qtype;

    protected function setUp() {
        $this->qtype = question_bank::get_qtype('ddimageortext');;
    }

    protected function tearDown() {
        $this->qtype = null;
    }

    public function test_name() {
        $this->assertEquals($this->qtype->name(), 'ddimageortext');
    }

    public function test_can_analyse_responses() {
        $this->assertTrue($this->qtype->can_analyse_responses());
    }
}
