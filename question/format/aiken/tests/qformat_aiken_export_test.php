<?php
//
/**
 * Unit tests for export/import description (info) for question category in the Moodle XML format.
 *
 * @package    qformat_aiken
 * @copyright  2018 Jean-Michel Vedrine
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/questionlib.php');
require_once($CFG->dirroot . '/question/format.php');
require_once($CFG->dirroot . '/question/format/aiken/format.php');
require_once($CFG->dirroot . '/question/engine/tests/helpers.php');
require_once($CFG->dirroot . '/question/editlib.php');

/**
 * Unit tests for the Aiken question format export.
 *
 * @copyright  2018 Jean-Michel vedrine)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qformat_aiken_export_test extends advanced_testcase {
    /**
     * Assert that 2 strings are the same, ignoring ends of line.
     * We need to override this function because we don't want any output
     * @param   string    $expectedtext The expected string.
     * @param   string    $text The actual string.
     */
    public function assert_same_aiken($expectedtext, $text) {
        $this->assertEquals(str_replace("\r\n", "\n", $expectedtext),
                str_replace("\r\n", "\n", $text));
    }

    public function test_export_questions() {
        $this->resetAfterTest();
        $this->setAdminUser();
        // Create a new course category and and a new course in that.
        $category = $this->getDataGenerator()->create_category();
        $course = $this->getDataGenerator()->create_course(array('category' => $category->id));
        $generator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $context = context_coursecat::instance($category->id);
        $cat = $generator->create_question_category(array('contextid' => $context->id));
        $question1 = $generator->create_question('shortanswer', null,
                array('category' => $cat->id));
        $question2 = $generator->create_question('essay', null,
                array('category' => $cat->id));
        $question3 = $generator->create_question('numerical', null,
                array('category' => $cat->id));
        $question4  = $generator->create_question('multichoice', 'one_of_four',
                array('category' => $cat->id));
        $question4  = $generator->create_question('multichoice', 'two_of_four',
                array('category' => $cat->id));
        $exporter = new qformat_aiken();
        $exporter->category = $cat;
        $exporter->setCourse($course);
        $expectedoutput = <<<EOT
Which is the oddest number?
A) One
B) Two
C) Three
D) Four
ANSWER: A

EOT;
        $this->assert_same_aiken($expectedoutput, $exporter->exportprocess());
    }

    public function test_export_multiline_question() {
        $this->resetAfterTest();
        $this->setAdminUser();
        // Create a new course category and and a new course in that.
        $category = $this->getDataGenerator()->create_category();
        $course = $this->getDataGenerator()->create_course(array('category' => $category->id));
        $generator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $context = context_coursecat::instance($category->id);
        $cat = $generator->create_question_category(array('contextid' => $context->id));
        $question  = $generator->create_question('multichoice', 'one_of_four',
                array('category' => $cat->id));
        $question->questiontext = <<<EOT
<p>Which is the</p>
<p>oddest number?</p>
EOT;
        $exporter = new qformat_aiken();
        $exporter->category = $cat;
        $exporter->setCourse($course);
        $expectedoutput = <<<EOT
Which is the oddest number?
A) One
B) Two
C) Three
D) Four
ANSWER: A

EOT;
        $this->assert_same_aiken($expectedoutput, $exporter->exportprocess());
    }
}
