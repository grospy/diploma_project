<?php
//

/**
 * Privacy Subsystem implementation for core_cache.
 *
 * @package    core_cache
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_cache\privacy;

defined('MOODLE_INTERNAL') || die();

use \core_privacy\local\metadata\collection;

/**
 * Privacy Subsystem implementation for core_cache.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
        // Caches store data.
        \core_privacy\local\metadata\provider,

        // The cache subsystem stores data on behalf of other components.
        \core_privacy\local\request\subsystem\plugin_provider,
        \core_privacy\local\request\shared_userlist_provider
    {

    /**
     * Returns meta data about this system.
     *
     * Note, although this plugin does store user data, it is not able to
     * identify it, and that user data is typically very short lived.
     *
     * Therefore it is not realistically possible to export any of this
     * data as it is only identifiable by the plugin storing it, and that
     * plugin should already be exporting the data as part of it's own
     * implementation.
     *
     * @param   collection     $collection The initialised collection to add items to.
     * @return  collection     A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection) : collection {
        // Data is stored in cache stores.
        $collection->add_plugintype_link('cachestore', [], 'privacy:metadata:cachestore');

        // Cache locks do not store any personal user data.

        return $collection;
    }
}
