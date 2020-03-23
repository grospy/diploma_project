<?php
//

/**
 * Privacy Subsystem implementation for gradereport_user.
 *
 * @package    gradereport_user
 * @copyright  2018 Sara Arjona <sara@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_user\privacy;

defined('MOODLE_INTERNAL') || die();

use \core_privacy\local\metadata\collection;
use \core_privacy\local\request\transform;
use \core_privacy\local\request\writer;

require_once $CFG->libdir.'/grade/constants.php';


/**
 * Privacy Subsystem for gradereport_user implementing null_provider.
 *
 * @copyright  2018 Sara Arjona <sara@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
    \core_privacy\local\metadata\provider,
    \core_privacy\local\request\user_preference_provider {

    /**
     * Returns meta data about this system.
     *
     * @param   collection     $itemcollection The initialised item collection to add items to.
     * @return  collection     A listing of user data stored through this system.
     */
    public static function get_metadata(collection $items) : collection {
        // User preferences (shared between different courses).
        $items->add_user_preference('gradereport_user_view_user', 'privacy:metadata:preference:gradereport_user_view_user');

        return $items;
    }

    /**
     * Store all user preferences for the plugin.
     *
     * @param   int         $userid The userid of the user whose data is to be exported.
     */
    public static function export_user_preferences(int $userid) {
        $prefvalue = get_user_preferences('gradereport_user_view_user', null, $userid);
        if ($prefvalue !== null) {
            $transformedvalue = transform::yesno($prefvalue);
            writer::export_user_preference(
                'gradereport_user',
                'gradereport_user_view_user',
                $transformedvalue,
                get_string('privacy:metadata:preference:gradereport_user_view_user', 'gradereport_user')
            );
        }
    }
}
