<?php
//

/**
 * Test provider using a fake plugin name.
 *
 * @package core_privacy
 * @copyright 2018 Jake Dallimore <jrhdallimore@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_testcomponent\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\contextlist;

/**
 * Mock core_user_data_provider for unit tests.
 * @copyright 2018 Jake Dallimore <jrhdallimore@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\provider, \core_privacy\local\request\plugin\provider {
    /**
     * @return array The array of metadata.
     */
    public static function get_metadata(collection $collection) : collection {
        $collection = new collection('testcomponent');
        $collection->add_database_table('testtable', ['testfield1', 'testfield2'], 'testsummary');
        return $collection;
    }

    /**
     * Get the list of contexts that contain user information for the specified user.
     *
     * @param   int $userid The user to search.
     * @return  contextlist   $contextlist  The contextlist containing the list of contexts used in this plugin.
     */
    public static function get_contexts_for_userid(int $userid): contextlist {
        $cl = new contextlist();
        $cl->add_from_sql("SELECT c.id FROM {context} c WHERE c.id = :id", ['id' => \context_system::instance()->id]);

        return $cl;
    }

    /**
     * Export all user data for the specified user, in the specified contexts.
     *
     * @param   approved_contextlist $contextlist The approved contexts to export information for.
     */
    public static function export_user_data(approved_contextlist $contextlist) {
        // This does nothing. We only want to confirm this can be called via the \core_privacy\manager.
    }

    /**
     * Delete all use data which matches the specified deletion criteria.
     *
     * @param   context         $context   The specific context to delete data for.
     */
    public static function delete_data_for_all_users_in_context(\context $context) {
        // This does nothing. We only want to confirm this can be called via the \core_privacy\manager.
    }

    /**
     * Delete all user data for the specified user, in the specified contexts.
     *
     * @param   approved_contextlist $contextlist The approved contexts and user information to delete information for.
     */
    public static function delete_data_for_user(approved_contextlist $contextlist) {
        // This does nothing. We only want to confirm this can be called via the \core_privacy\manager.
    }
}
