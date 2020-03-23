<?php
//

/**
 * The gradebook interface for a filterable class.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\screen;

defined('MOODLE_INTERNAL') || die;

/**
 * The gradebook interface for a filterable class.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface filterable_items {

    /**
     * Return true/false if this item should be filtered.
     * @param mixed $item (user or grade_item)
     * @return bool
     */
    public static function filter($item);
}
