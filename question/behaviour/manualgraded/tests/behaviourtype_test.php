<?php
//

/**
 * This file contains tests for the manually graded behaviour type class.
 *
 * @package   qbehaviour_manualgraded
 * @category  test
 * @copyright 2015 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once(__DIR__ . '/../../../engine/lib.php');
require_once(__DIR__ . '/../../../engine/tests/helpers.php');


/**
 * Unit tests for the manually graded behaviour type class.
 *
 * @copyright  2015 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbehaviour_manualgraded_type_test extends basic_testcase {

    /** @var qbehaviour_manualgraded_type */
    protected $behaviourtype;

    public function setUp() {
        parent::setUp();
        $this->behaviourtype = question_engine::get_behaviour_type('manualgraded');
    }

    public function test_is_archetypal() {
        $this->assertTrue($this->behaviourtype->is_archetypal());
    }

    public function test_get_unused_display_options() {
        $this->assertEquals(array('correctness', 'marks', 'specificfeedback', 'generalfeedback', 'rightanswer'),
                $this->behaviourtype->get_unused_display_options());
    }

    public function test_can_questions_finish_during_the_attempt() {
        $this->assertFalse($this->behaviourtype->can_questions_finish_during_the_attempt());
    }

    public function test_adjust_random_guess_score() {
        $this->assertEquals(0, $this->behaviourtype->adjust_random_guess_score(0));
        $this->assertEquals(1, $this->behaviourtype->adjust_random_guess_score(1));
    }
}
