<?php
//

/**
 * Privacy class for requesting user data.
 *
 * @package    core_editor
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_editor\privacy;

defined('MOODLE_INTERNAL') || die();

use \core_privacy\local\metadata\collection;
use core_privacy\local\request\writer;

/**
 * Provider for the editor API.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
        // The Editor subsystem does not store any data itself.
        // It has no database tables, and it purely acts as a conduit to the various editors.
        \core_privacy\local\metadata\provider,

        // The Editor subsystem has user preferences.
        \core_privacy\local\request\user_preference_provider {

    /**
     * Returns meta data about this system.
     *
     * @param   collection     $collection The initialised collection to add items to.
     * @return  collection     A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection) : collection {
        $collection->add_user_preference('htmleditor', 'privacy:metadata:preference:htmleditor');

        return $collection;
    }

    /**
     * Export all user preferences for the plugin.
     *
     * @param   int         $userid The userid of the user whose data is to be exported.
     */
    public static function export_user_preferences(int $userid) {
        $preference = get_user_preferences('htmleditor');
        if (!empty($preference)) {
            $desc = get_string('privacy:preference:htmleditor', 'core_editor',
                    get_string('pluginname', "editor_{$preference}"));
            writer::export_user_preference('core_editor', 'htmleditor', $preference, $desc);
        }
    }
}
