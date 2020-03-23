<?php
//

/**
 * This file contains the polyfil to allow a plugin to operate with Moodle 3.3 up.
 *
 * @package    mod_quiz
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_quiz\privacy;

use core_privacy\local\request\approved_userlist;

defined('MOODLE_INTERNAL') || die();

/**
 * The trait used to provide a backwards compatibility for third-party plugins.
 *
 * @package    mod_quiz
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
trait legacy_quizaccess_polyfill {

    /**
     * Export all user data for the specified user, for the specified quiz.
     *
     * @param   \quiz           $quiz The quiz being exported
     * @param   \stdClass       $user The user to export data for
     * @return  \stdClass       The data to be exported for this access rule.
     */
    public static function export_quizaccess_user_data(\quiz $quiz, \stdClass $user) : \stdClass {
        return static::_export_quizaccess_user_data($quiz, $user);
    }

    /**
     * Delete all data for all users in the specified quiz.
     *
     * @param   \quiz           $quiz The quiz being deleted
     */
    public static function delete_quizaccess_data_for_all_users_in_context(\quiz $quiz) {
        static::_delete_quizaccess_data_for_all_users_in_context($quiz);
    }

    /**
     * Delete all user data for the specified user, in the specified quiz.
     *
     * @param   \quiz           $quiz The quiz being deleted
     * @param   \stdClass       $user The user to export data for
     */
    public static function delete_quizaccess_data_for_user(\quiz $quiz, \stdClass $user) {
        static::_delete_quizaccess_data_for_user($quiz, $user);
    }

    /**
     * Delete all user data for the specified users, in the specified context.
     *
     * @param   approved_userlist $userlist   The approved context and user information to delete information for.
     */
    public static function delete_quizaccess_data_for_users(approved_userlist $userlist) {
        static::_delete_quizaccess_data_for_users($userlist);
    }
}
