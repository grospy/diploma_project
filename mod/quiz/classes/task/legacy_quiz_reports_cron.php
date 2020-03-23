<?php
//

/**
 * Legacy Cron Quiz Reports Task
 *
 * @package    mod_quiz
 * @copyright  2017 Michael Hughes
 * @author Michael Hughes
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
namespace mod_quiz\task;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/quiz/locallib.php');

/**
 * Legacy Cron Quiz Reports Task
 *
 * @package    mod_quiz
 * @copyright  2017 Michael Hughes
 * @author Michael Hughes
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
class legacy_quiz_reports_cron extends \core\task\scheduled_task {

    public function get_name() {
        return get_string('legacyquizreportscron', 'mod_quiz');
    }

    /**
     * Execute all quizreport sub-plugins cron tasks.
     */
    public function execute() {
        cron_execute_plugin_type('quiz', 'quiz reports');
    }
}
