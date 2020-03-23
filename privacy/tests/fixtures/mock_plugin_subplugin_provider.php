<?php
//

/**
 * Test provider using a fake plugin name.
 *
 * @package core_privacy
 * @copyright 2018 Jake Dallimore <jrhdallimore@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_testcomponent3\privacy;

use core_privacy\local\metadata\collection;

/**
 * Mock shared_data_provider for unit tests.
 * @copyright 2018 Jake Dallimore <jrhdallimore@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\provider, \core_privacy\local\request\plugin\subplugin_provider {
    /**
     * Returns meta data about this system.
     *
     * @param   collection     $collection The initialised collection to add items to.
     * @return  collection     A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection) : collection {
        $collection = new collection('testcomponent3');
        $collection->add_database_table('testtable', ['testfield1', 'testfield2'], 'testsummary');
        return $collection;
    }
}
