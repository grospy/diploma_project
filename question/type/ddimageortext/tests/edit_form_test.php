<?php
//

/**
 * Unit tests for the drag-and-drop onto image edit form.
 *
 * @package   qtype_ddimageortext
 * @copyright 2019 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
global $CFG;

require_once($CFG->dirroot . '/question/engine/tests/helpers.php');
require_once($CFG->dirroot . '/question/type/edit_question_form.php');
require_once($CFG->dirroot . '/question/type/ddimageortext/edit_ddimageortext_form.php');

/**
 * Unit tests for the drag-and-drop onto image edit form.
 *
 * @copyright  2019 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_ddimageortext_edit_form_test extends advanced_testcase {
    /**
     * Helper method.
     *
     * @return array with two elements:
     *      question_edit_form great a question form instance that can be tested.
     *      stdClass the question category.
     */
    protected function get_form() {
        $this->setAdminUser();
        $this->resetAfterTest();

        $syscontext = context_system::instance();
        $category = question_make_default_categories(array($syscontext));
        $fakequestion = new stdClass();
        $fakequestion->qtype = 'ddimageortext';
        $fakequestion->contextid = $syscontext->id;
        $fakequestion->createdby = 2;
        $fakequestion->category = $category->id;
        $fakequestion->questiontext = 'Test question';
        $fakequestion->options = new stdClass();
        $fakequestion->options->answers = array();
        $fakequestion->formoptions = new stdClass();
        $fakequestion->formoptions->movecontext = null;
        $fakequestion->formoptions->repeatelements = true;
        $fakequestion->inputs = null;

        $form = new qtype_ddimageortext_edit_form(new moodle_url('/'), $fakequestion, $category,
                new question_edit_contexts($syscontext));

        return [$form, $category];
    }

    /**
     * Test the form correctly validates the HTML allowed in items.
     */
    public function test_item_validation() {
        list($form, $category) = $this->get_form();

        $submitteddata = [
            'category' => $category->id,
            'bgimage' => '',
            'nodropzone' => 0,
            'noitems' => 5,
            'drags' => [
                ['dragitemtype' => 'image'],
                ['dragitemtype' => 'image'],
                ['dragitemtype' => 'word'],
                ['dragitemtype' => 'word'],
                ['dragitemtype' => 'word'],
            ],
            'draglabel' => [
                'frog',
                '<b>toad</b>',
                'cat',
                '<span lang="fr"><b>chien</b></span>',
                '<textarea>evil!</textarea>',
            ],
        ];

        $errors = $form->validation($submitteddata, []);

        $this->assertArrayNotHasKey('drags[0]', $errors);
        $this->assertEquals('HTML tags are not allowed in this text which is the alt text for a draggable image.',
                $errors['drags[1]']);
        $this->assertArrayNotHasKey('drags[2]', $errors);
        $this->assertArrayNotHasKey('drags[3]', $errors);
        $this->assertEquals('Only "&lt;br&gt;&lt;sub&gt;&lt;sup&gt;&lt;b&gt;&lt;i&gt;&lt;strong&gt;&lt;em&gt;&lt;span&gt;" ' .
                'tags are allowed in this draggable text.', $errors['drags[4]']);
    }
}
