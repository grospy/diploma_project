<?php
//

/**
 * Recycle bin cron task.
 *
 * @package    tool_recyclebin
 * @copyright  2015 University of Kent
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_recyclebin\task;

/**
 * This task deletes expired category recyclebin items.
 *
 * @package    tool_recyclebin
 * @copyright  2015 University of Kent
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cleanup_category_bin extends \core\task\scheduled_task {

    /**
     * Task name.
     */
    public function get_name() {
        return get_string('taskcleanupcategorybin', 'tool_recyclebin');
    }

    /**
     * Delete all expired items.
     */
    public function execute() {
        global $DB;

        // Check if the category bin is disabled or there is no expiry time.
        $lifetime = get_config('tool_recyclebin', 'categorybinexpiry');
        if (!\tool_recyclebin\category_bin::is_enabled() || $lifetime <= 0) {
            return true;
        }

        // Get the items we can delete.
        $items = $DB->get_recordset_select('tool_recyclebin_category', 'timecreated <= :timecreated',
            array('timecreated' => time() - $lifetime));
        foreach ($items as $item) {
            mtrace("[tool_recyclebin] Deleting item '{$item->id}' from the category recycle bin ...");
            $bin = new \tool_recyclebin\category_bin($item->categoryid);
            $bin->delete_item($item);
        }
        $items->close();

        return true;
    }
}
