<?php
//

/**
 * Unit tests for the drag-and-drop markers edit form.
 *
 * @package   qtype_ddmarker
 * @copyright 2019 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
global $CFG;

require_once($CFG->dirroot . '/question/engine/tests/helpers.php');
require_once($CFG->dirroot . '/question/type/edit_question_form.php');
require_once($CFG->dirroot . '/question/type/ddmarker/edit_ddmarker_form.php');

/**
 * Unit tests for the drag-and-drop markers edit form.
 *
 * @copyright  2019 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_ddmarker_edit_form_test extends advanced_testcase {
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
        $fakequestion->qtype = 'ddmarker';
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

        $form = new qtype_ddmarker_edit_form(new moodle_url('/'), $fakequestion, $category,
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
            'bgimage' => 0,
            'nodropzone' => 0,
            'noitems' => 4,
            'drags' => [
                ['label' => 'frog'],
                ['label' => '<b>toad</b>'],
                ['label' => '<span lang="fr"><em>chien</em></span>'],
                ['label' => '<textarea>evil!</textarea>'],
            ],
        ];

        $errors = $form->validation($submitteddata, []);

        $this->assertArrayNotHasKey('drags[0]', $errors);
        $this->assertArrayNotHasKey('drags[1]', $errors);
        $this->assertArrayNotHasKey('drags[2]', $errors);
        $this->assertEquals('Only "&lt;br&gt;&lt;i&gt;&lt;em&gt;&lt;b&gt;&lt;strong&gt;' .
                '&lt;sup&gt;&lt;sub&gt;&lt;u&gt;&lt;span&gt;" tags are allowed in the label for a marker.',
                $errors['drags[3]']);
    }
}
