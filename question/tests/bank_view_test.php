<?php
//

/**
 * Unit tests for the question bank view class.
 *
 * @package    core_question
 * @category   test
 * @copyright  2018 the Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/editlib.php');


/**
 * Unit tests for the question bank view class.
 *
 * @copyright  2018 the Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_question_bank_view_testcase extends advanced_testcase {

    public function test_viewing_question_bank_should_not_load_individual_questions() {
        $this->resetAfterTest();
        $this->setAdminUser();
        $generator = $this->getDataGenerator();
        /** @var core_question_generator $questiongenerator */
        $questiongenerator = $generator->get_plugin_generator('core_question');

        // Create a course.
        $course = $generator->create_course();
        $context = context_course::instance($course->id);

        // Create a question in the default category.
        $contexts = new question_edit_contexts($context);
        $cat = question_make_default_categories($contexts->all());
        $questiondata = $questiongenerator->create_question('numerical', null,
                ['name' => 'Example question', 'category' => $cat->id]);

        // Ensure the question is not in the cache.
        $cache = cache::make('core', 'questiondata');
        $cache->delete($questiondata->id);

        // Generate the view.
        $view = new core_question\bank\view($contexts, new moodle_url('/'), $course);
        ob_start();
        $view->display('editq', 0, 20, $cat->id . ',' . $context->id, false, false, false);
        $html = ob_get_clean();

        // Verify the output includes the expected question.
        $this->assertContains('Example question', $html);

        // Verify the question has not been loaded into the cache.
        $this->assertFalse($cache->has($questiondata->id));
    }
}
