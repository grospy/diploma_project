<?php
//

/**
 * Update Overdue Attempts Task
 *
 * @package    mod_quiz
 * @copyright  2017 Michael Hughes
 * @author Michael Hughes
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_quiz\task;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/quiz/locallib.php');

/**
 * Update Overdue Attempts Task
 *
 * @package    mod_quiz
 * @copyright  2017 Michael Hughes
 * @author Michael Hughes
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
class update_overdue_attempts extends \core\task\scheduled_task {

    public function get_name() {
        return get_string('updateoverdueattemptstask', 'mod_quiz');
    }

    /**
     *
     * Close off any overdue attempts.
     */
    public function execute() {
        global $CFG;

        require_once($CFG->dirroot . '/mod/quiz/cronlib.php');
        $timenow = time();
        $overduehander = new \mod_quiz_overdue_attempt_updater();

        $processto = $timenow - get_config('quiz', 'graceperiodmin');

        mtrace('  Looking for quiz overdue quiz attempts...');

        list($count, $quizcount) = $overduehander->update_overdue_attempts($timenow, $processto);

        mtrace('  Considered ' . $count . ' attempts in ' . $quizcount . ' quizzes.');
    }
}
