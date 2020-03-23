<?php
//

/**
 * The main interface for recycle bin methods.
 *
 * @package    tool_recyclebin
 * @copyright  2015 University of Kent
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_recyclebin;

defined('MOODLE_INTERNAL') || die();

/**
 * Represents a recyclebin.
 *
 * @package    tool_recyclebin
 * @copyright  2015 University of Kent
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class base_bin {

    /**
     * Is this recyclebin enabled?
     */
    public static function is_enabled() {
        return false;
    }

    /**
     * Returns an item from the recycle bin.
     *
     * @param int $itemid Item ID to retrieve.
     */
    public abstract function get_item($itemid);

    /**
     * Returns a list of items in the recycle bin.
     */
    public abstract function get_items();

    /**
     * Store an item in this recycle bin.
     *
     * @param \stdClass $item Item to store.
     */
    public abstract function store_item($item);

    /**
     * Restore an item from the recycle bin.
     *
     * @param \stdClass $item The item database record
     */
    public abstract function restore_item($item);

    /**
     * Delete an item from the recycle bin.
     *
     * @param \stdClass $item The item database record
     */
    public abstract function delete_item($item);

    /**
     * Empty the recycle bin.
     */
    public function delete_all_items() {
        // Cleanup all items.
        $items = $this->get_items();
        foreach ($items as $item) {
            if ($this->can_delete()) {
                $this->delete_item($item);
            }
        }
    }

    /**
     * Can we view items in this recycle bin?
     */
    public abstract function can_view();

    /**
     * Can we restore items in this recycle bin?
     */
    public abstract function can_restore();

    /**
     * Can we delete this?
     */
    public abstract function can_delete();
}
