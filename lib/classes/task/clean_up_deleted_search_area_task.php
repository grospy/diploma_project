<?php
//

/**
 * Adhoc task that clean up data related ro deleted search area.
 *
 * @package    core
 * @copyright  2019 Dmitrii Metelkin <dmitriim@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Class that cleans up data related to deleted search area.
 *
 * Custom data accepted:
 *  - areaid -> String search area id .
 *
 * @package     core
 * @copyright   2019 Dmitrii Metelkin <dmitriim@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class clean_up_deleted_search_area_task extends adhoc_task {

    /**
     * Run the task to clean up deleted search are data.
     */
    public function execute() {
        $areaid = $this->get_custom_data();

        try {
            \core_search\manager::clean_up_non_existing_area($areaid);
        } catch (\core_search\engine_exception $e) {
            mtrace('Search is not configured. Skip deleting index for search area ' . $areaid);
        }
    }
}
