<?php
//

/**
 * Test helpers for the random question type.
 *
 * @package    qtype_random
 * @copyright  2013 The Open University
 * @author     Jamie Pratt <me@jamiep.org>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Test helper class for the random question type.
 *
 * @copyright  2013 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_random_test_helper extends question_test_helper {
    public function get_test_questions() {
        return array('basic');
    }

    /**
     * Gets the question form data for a random question which selects just from
     * it's own category and not from sub categories. Category id is not set.
     * @return stdClass
     */
    public function get_random_question_form_data_basic() {
        $form = new stdClass();
        $form->questiontext = array('text' => '');
        $form->includesubcategories = '0';
        return $form;
    }
}
