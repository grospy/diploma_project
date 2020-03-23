<?php
//

/**
 * Privacy Subsystem implementation for quiz_overview..
 *
 * @package    quiz_overview
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace quiz_overview\privacy;

use \core_privacy\local\request\writer;
use \core_privacy\local\request\transform;
use \core_privacy\local\metadata\collection;
use \core_privacy\manager;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem implementation for quiz_overview..
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
    \core_privacy\local\metadata\provider,
    \core_privacy\local\request\user_preference_provider {

    /**
     * Returns meta data about this system.
     *
     * @param   collection     $collection The initialised collection to add items to.
     * @return  collection     A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection) : collection {
        $collection->add_user_preference('quiz_overview_slotmarks', 'privacy:metadata:preference:quiz_overview_slotmarks');

        return $collection;
    }

    /**
     * Export all user preferences for the plugin.
     *
     * @param   int         $userid The userid of the user whose data is to be exported.
     */
    public static function export_user_preferences(int $userid) {
        $preference = get_user_preferences('quiz_overview_slotmarks', null);
        if (null !== $preference) {
            if (empty($preference)) {
                $description = get_string('privacy:preference:slotmarks:no', 'quiz_overview');
            } else {
                $description = get_string('privacy:preference:slotmarks:yes', 'quiz_overview');
            }

            writer::export_user_preference(
                'quiz_overview',
                'slotmarks',
                transform::yesno($preference),
                $description
            );
        }
    }
}
