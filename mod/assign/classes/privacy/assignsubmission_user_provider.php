<?php
//

/**
 * This file contains the assignsubmission_user_provider interface.
 *
 * Assignment Sub plugins should implement this if they store personal information and can retrieve a userid.
 *
 * @package mod_assign
 * @copyright 2018 Adrian Greeve <adrian@moodle.com>
 *
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_assign\privacy;

use core_privacy\local\request\userlist;

defined('MOODLE_INTERNAL') || die();

interface assignsubmission_user_provider extends
        \core_privacy\local\request\plugin\subplugin_provider,
        \core_privacy\local\request\shared_userlist_provider
    {

    /**
     * If you have tables that contain userids and you can generate entries in your tables without creating an
     * entry in the assign_submission table then please fill in this method.
     *
     * @param  userlist $userlist The userlist object
     */
    public static function get_userids_from_context(userlist $userlist);

    /**
     * Deletes all submissions for the submission ids / userids provided in a context.
     * assign_plugin_request_data contains:
     * - context
     * - assign object
     * - submission ids (pluginids)
     * - user ids
     * @param  assign_plugin_request_data $deletedata A class that contains the relevant information required for deletion.
     */
    public static function delete_submissions(assign_plugin_request_data $deletedata);

}
