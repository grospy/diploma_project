<?php
//

/**
 * Question related functions.
 *
 * This file was created just because Fragment API expects callbacks to be defined on lib.php.
 *
 * Please, do not add new functions to this file.
 *
 * @package   core_question
 * @copyright 2018 Simey Lameze <simey@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Question tags fragment callback.
 *
 * @param array $args Arguments to the form.
 * @return null|string The rendered form.
 */
function core_question_output_fragment_tags_form($args) {

    if (!empty($args['id'])) {
        global $CFG, $DB;
        require_once($CFG->dirroot . '/question/type/tags_form.php');
        require_once($CFG->libdir . '/questionlib.php');
        $id = clean_param($args['id'], PARAM_INT);
        $editingcontext = $args['context'];

        $question = $DB->get_record('question', ['id' => $id]);

        if ($coursecontext = $editingcontext->get_course_context(false)) {
            $course = $DB->get_record('course', ['id' => $coursecontext->instanceid]);
            $filtercourses = [$course];
        } else {
            $filtercourses = null;
        }

        // Load the question tags and filter the course tags by the current
        // course.
        get_question_options($question, true, $filtercourses);

        $category = $question->categoryobject;
        $questioncontext = \context::instance_by_id($category->contextid);
        $contexts = new \question_edit_contexts($editingcontext);

        $formoptions = [
            'editingcontext' => $editingcontext,
            'questioncontext' => $questioncontext,
            'contexts' => $contexts->all()
        ];
        $data = [
            'id' => $question->id,
            'questioncategory' => $category->name,
            'questionname' => $question->name,
            'categoryid' => $category->id,
            'contextid' => $category->contextid,
            'context' => $questioncontext->get_context_name(),
            'tags' => isset($question->tags) ? $question->tags : [],
            'coursetags' => isset($question->coursetags) ? $question->coursetags : [],
        ];

        $cantag = question_has_capability_on($question, 'tag');
        $mform = new \core_question\form\tags(null, $formoptions, 'post', '', null, $cantag, $data);
        $mform->set_data($data);

        return $mform->render();
    }
}
