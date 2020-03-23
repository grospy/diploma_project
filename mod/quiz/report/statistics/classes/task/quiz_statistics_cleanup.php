<?php
//

/**
 * Legacy Cron Quiz Reports Task
 *
 * @package    quiz_statistics
 * @copyright  2017 Michael Hughes, University of Strathclyde
 * @author Michael Hughes <michaelhughes@strath.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
namespace quiz_statistics\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Legacy Cron Quiz Reports Task
 *
 * @package    quiz_statistics
 * @copyright  2017 Michael Hughes
 * @author Michael Hughes
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
class quiz_statistics_cleanup extends \core\task\scheduled_task {
    public function get_name() {
        return get_string('quizstatisticscleanuptask', 'quiz_statistics');
    }

    /**
     * Run the clean up task.
     */
    public function execute() {
        global $DB;

        $expiretime = time() - 4 * HOURSECS;
        $DB->delete_records_select('quiz_statistics', 'timemodified < ?', array($expiretime));

        return true;
    }
}
