<?php
//

/**
 * Privacy Subsystem helper for mod_quiz.
 *
 * @package    mod_quiz
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_quiz\privacy;

use \core_privacy\local\request\writer;
use \core_privacy\local\request\transform;
use \core_privacy\local\request\contextlist;
use \core_privacy\local\request\approved_contextlist;
use \core_privacy\local\request\deletion_criteria;
use \core_privacy\local\metadata\collection;
use \core_privacy\manager;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/quiz/lib.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');

/**
 * Privacy Subsystem implementation for mod_quiz.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class helper {
    /**
     * Determine the subcontext for the specified quiz attempt.
     *
     * @param   \stdClass       $attempt    The attempt data retrieved from the database.
     * @param   \stdClass       $user       The user record.
     * @return  \array                      The calculated subcontext.
     */
    public static function get_quiz_attempt_subcontext(\stdClass $attempt, \stdClass $user) {
        $subcontext = [
            get_string('attempts', 'mod_quiz'),
        ];
        if ($attempt->userid != $user->id) {
            $subcontext[] = fullname($user);
        }
        $subcontext[] = $attempt->attempt;

        return $subcontext;
    }
}
