<?php
//

/**
 * The quizaccess_user_provider interface provides the expected interface for all 'quizaccess' quizaccesss.
 *
 * Quiz sub plugins should implement this if they store personal information and can retrieve a userid.
 *
 * @package    mod_quiz
 * @copyright  2018 Shamim Rezaie <shamim@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_quiz\privacy;

defined('MOODLE_INTERNAL') || die();

use core_privacy\local\request\approved_userlist;

interface quizaccess_user_provider extends \core_privacy\local\request\plugin\subplugin_provider {

    /**
     * Delete multiple users data within a single context.
     *
     * @param   approved_userlist   $userlist The approved context and user information to delete information for.
     */
    public static function delete_quizaccess_data_for_users(approved_userlist $userlist);
}
