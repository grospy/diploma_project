<?php
//

/**
 * Task to cleanup old question previews.
 *
 * @package    core
 * @copyright  2013 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\task;

/**
 * A task to cleanup old question previews.
 *
 * @copyright  2013 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_preview_cleanup_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskquestioncron', 'admin');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $CFG;
        require_once($CFG->dirroot . '/question/engine/lib.php');

        // We delete previews that have not been touched for 24 hours.
        $lastmodifiedcutoff = time() - DAYSECS;

        mtrace("\n  Cleaning up old question previews...", '');
        $oldpreviews = new \qubaid_join('{question_usages} quba', 'quba.id',
            'quba.component = :qubacomponent
                    AND NOT EXISTS (
                        SELECT 1
                          FROM {question_attempts}      subq_qa
                          JOIN {question_attempt_steps} subq_qas ON subq_qas.questionattemptid = subq_qa.id
                          JOIN {question_usages}        subq_qu  ON subq_qu.id = subq_qa.questionusageid
                         WHERE subq_qa.questionusageid = quba.id
                           AND subq_qu.component = :qubacomponent2
                           AND (subq_qa.timemodified > :qamodifiedcutoff
                                    OR subq_qas.timecreated > :stepcreatedcutoff)
                    )
            ',
            ['qubacomponent' => 'core_question_preview', 'qubacomponent2' => 'core_question_preview',
                'qamodifiedcutoff' => $lastmodifiedcutoff, 'stepcreatedcutoff' => $lastmodifiedcutoff]);

        \question_engine::delete_questions_usage_by_activities($oldpreviews);
        mtrace('done.');
    }

}
