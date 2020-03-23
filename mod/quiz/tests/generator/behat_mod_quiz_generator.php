<?php
//

/**
 * Behat data generator for mod_quiz.
 *
 * @package   mod_quiz
 * @category  test
 * @copyright 2019 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * Behat data generator for mod_quiz.
 *
 * @copyright 2019 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_mod_quiz_generator extends behat_generator_base {

    protected function get_creatable_entities(): array {
        return [
            'group overrides' => [
                'datagenerator' => 'override',
                'required' => ['quiz', 'group'],
                'switchids' => ['quiz' => 'quiz', 'group' => 'groupid'],
            ],
            'user overrides' => [
                'datagenerator' => 'override',
                'required' => ['quiz', 'user'],
                'switchids' => ['quiz' => 'quiz', 'user' => 'userid'],
            ],
        ];
    }

    /**
     * Look up the id of a quiz from its name.
     *
     * @param string $quizname the quiz name, for example 'Test quiz'.
     * @return int corresponding id.
     */
    protected function get_quiz_id(string $quizname): int {
        global $DB;

        if (!$id = $DB->get_field('quiz', 'id', ['name' => $quizname])) {
            throw new Exception('There is no quiz with name "' . $quizname . '" does not exist');
        }
        return $id;
    }
}
