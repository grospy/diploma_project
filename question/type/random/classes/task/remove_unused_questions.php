<?php
//

/**
 * A scheduled task to remove unneeded random questions.
 *
 * @package   qtype_random
 * @category  task
 * @copyright 2018 Bo Pierce <email.bO.pierce@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace qtype_random\task;

defined('MOODLE_INTERNAL') || die();


/**
 * A scheduled task to remove unneeded random questions.
 *
 * @copyright 2018 Bo Pierce <email.bO.pierce@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class remove_unused_questions extends \core\task\scheduled_task {

    public function get_name() {
        return get_string('taskunusedrandomscleanup', 'qtype_random');
    }

    public function execute() {
        global $DB, $CFG;
        require_once($CFG->libdir . '/questionlib.php');

        // Find potentially unused random questions (up to 10000).
        // Note, because we call question_delete_question below,
        // the question will not actually be deleted if something else
        // is using them, but nothing else in Moodle core uses qtype_random,
        // and not many third-party plugins do.
        $unusedrandomids = $DB->get_records_sql("
                SELECT q.id, 1
                  FROM {question} q
             LEFT JOIN {quiz_slots} qslots ON q.id = qslots.questionid
                 WHERE qslots.questionid IS NULL
                   AND q.qtype = ? AND hidden = ?", ['random', 0], 0, 10000);

        $count = 0;
        foreach ($unusedrandomids as $unusedrandomid => $notused) {
            question_delete_question($unusedrandomid);
            // In case the question was not actually deleted (because it was in use somehow
            // mark it as hidden so the query above will not return it again.
            $DB->set_field('question', 'hidden', 1, ['id' => $unusedrandomid]);
            $count += 1;
        }
        mtrace('Cleaned up ' . $count . ' unused random questions.');
    }
}
