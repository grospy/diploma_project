<?php
//

/**
 * Unit tests for the question_definition base classes.
 *
 * @package   core_question
 * @copyright 2015 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/engine/tests/helpers.php');


/**
 * Test for question_definition base classes.
 *
 * @copyright  2015 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_definition_testcase extends advanced_testcase {
    public function test_make_html_inline() {
        // Base class is abstract, so we need to pick one qusetion type to test this method.
        $mc = test_question_maker::make_a_multichoice_single_question();
        $this->assertEquals('Frog', $mc->make_html_inline('<p>Frog</p>'));
        $this->assertEquals('Frog', $mc->make_html_inline('<p>Frog<br /></p>'));
        $this->assertEquals('Frog<br />Toad', $mc->make_html_inline("<p>Frog</p>\n<p>Toad</p>"));
        $this->assertEquals('<img src="http://example.com/pic.png" alt="Graph" />',
                $mc->make_html_inline(
                    '<p><img src="http://example.com/pic.png" alt="Graph" /></p>'));
        $this->assertEquals("Frog<br />XXX <img src='http://example.com/pic.png' alt='Graph' />",
                $mc->make_html_inline(" <p> Frog </p> \n\r
                    <p> XXX <img src='http://example.com/pic.png' alt='Graph' /> </p> "));
        $this->assertEquals('Frog', $mc->make_html_inline('<p>Frog</p><p></p>'));
        $this->assertEquals('Frog<br />†', $mc->make_html_inline('<p>Frog</p><p>†</p>'));
    }
}
