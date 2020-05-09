<?php
//

/**
 * This file contains tests for the question bank column class.
 *
 * @package core_question
 * @copyright 2018 Huong Nguyen <huongnv13@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/editlib.php');
require_once($CFG->dirroot . '/question/tests/fixtures/testable_core_question_column.php');

/**
 * Unit tests for the question bank column class.
 *
 * @package core_question
 * @copyright 2018 Huong Nguyen <huongnv13@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_bank_column_testcase extends advanced_testcase {

    /**
     * Test function display_header multiple sorts with no custom tooltips.
     *
     */
    public function test_column_header_multi_sort_no_tooltips() {
        $this->resetAfterTest();
        $course = $this->getDataGenerator()->create_course();
        $questionbank = new core_question\bank\view(
                new question_edit_contexts(context_course::instance($course->id)),
                new moodle_url('/'),
                $course
        );
        $columnbase = new testable_core_question_column($questionbank);

        $sortable = [
                'apple' => [
                        'field' => 'apple',
                        'title' => 'Apple'
                ],
                'banana' => [
                        'field' => 'banana',
                        'title' => 'Banana'
                ]
        ];
        $columnbase->set_sortable($sortable);

        ob_start();
        $columnbase->display_header();
        $output = ob_get_clean();

        $this->assertContains(' title="Sort by Apple ascending">Apple</a>', $output);
        $this->assertContains(' title="Sort by Banana ascending">Banana</a>', $output);
    }

    /**
     * Test function display_header multiple sorts with custom tooltips.
     *
     */
    public function test_column_header_multi_sort_with_tooltips() {
        $this->resetAfterTest();
        $course = $this->getDataGenerator()->create_course();
        $questionbank = new core_question\bank\view(
                new question_edit_contexts(context_course::instance($course->id)),
                new moodle_url('/'),
                $course
        );
        $columnbase = new testable_core_question_column($questionbank);

        $sortable = [
                'apple' => [
                        'field' => 'apple',
                        'title' => 'Apple',
                        'tip' => 'Apple Tooltips'
                ],
                'banana' => [
                        'field' => 'banana',
                        'title' => 'Banana',
                        'tip' => 'Banana Tooltips'
                ]
        ];
        $columnbase->set_sortable($sortable);

        ob_start();
        $columnbase->display_header();
        $output = ob_get_clean();

        $this->assertContains(' title="Sort by Apple Tooltips ascending">Apple</a>', $output);
        $this->assertContains(' title="Sort by Banana Tooltips ascending">Banana</a>', $output);
    }
}