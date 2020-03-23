<?php
//

/**
 * The quizaccess_provider interface provides the expected interface for all 'quizaccess' quizaccesss.
 *
 * @package    mod_quiz
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_quiz\privacy;

defined('MOODLE_INTERNAL') || die();

use \core_privacy\local\request\contextlist;
use \core_privacy\local\request\approved_contextlist;

/**
 * The quizaccess_provider interface provides the expected interface for all 'quizaccess' quizaccesss.
 *
 * @package    mod_quiz
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface quizaccess_provider extends \core_privacy\local\request\plugin\subplugin_provider {

    /**
     * Export all user data for the specified user, for the specified quiz.
     *
     * @param   \quiz           $quiz The quiz being exported
     * @param   \stdClass       $user The user to export data for
     * @return  \stdClass       The data to be exported for this access rule.
     */
    public static function export_quizaccess_user_data(\quiz $quiz, \stdClass $user) : \stdClass;

    /**
     * Delete all data for all users in the specified quiz.
     *
     * @param   \quiz           $quiz The quiz being deleted
     */
    public static function delete_quizaccess_data_for_all_users_in_context(\quiz $quiz);

    /**
     * Delete all user data for the specified user, in the specified quiz.
     *
     * @param   \quiz           $quiz The quiz being deleted
     * @param   \stdClass       $user The user to export data for
     */
    public static function delete_quizaccess_data_for_user(\quiz $quiz, \stdClass $user);
}
