<?php
//

/**
 * Callbacks for auth_oauth2
 *
 * @package   auth_oauth2
 * @copyright 2017 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Navigation hook to add to preferences page.
 *
 * @param navigation_node $useraccount
 * @param stdClass $user
 * @param context_user $context
 * @param stdClass $course
 * @param context_course $coursecontext
 */
function auth_oauth2_extend_navigation_user_settings(navigation_node $useraccount,
                                                     stdClass $user,
                                                     context_user $context,
                                                     stdClass $course,
                                                     context_course $coursecontext) {
    global $USER;

    if (\auth_oauth2\api::is_enabled() && !\core\session\manager::is_loggedinas()) {
        if (has_capability('auth/oauth2:managelinkedlogins', $context) && $user->id == $USER->id) {

            $parent = $useraccount->parent->find('useraccount', navigation_node::TYPE_CONTAINER);
            $parent->add(get_string('linkedlogins', 'auth_oauth2'), new moodle_url('/auth/oauth2/linkedlogins.php'));
        }
    }
}

/**
 * Callback to remove linked logins for deleted users.
 *
 * @param stdClass $user
 */
function auth_oauth2_pre_user_delete($user) {
    global $DB;
    $DB->delete_records(auth_oauth2\linked_login::TABLE, ['userid' => $user->id]);
}
