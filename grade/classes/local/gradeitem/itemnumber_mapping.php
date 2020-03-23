<?php
//

/**
 * Grade item, itemnumber mapping.
 *
 * @package   core_grades
 * @copyright Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

declare(strict_types = 1);

namespace core_grades\local\gradeitem;

/**
 * Grade item, itemnumber mapping.
 *
 * @package   core_grades
 * @copyright Andrew Nicols <andrew@nicols.co.uk>
 */
interface itemnumber_mapping {

    /**
     * Get the grade item mapping of item number to item name.
     *
     * @return array
     */
    public static function get_itemname_mapping_for_component(): array;
}
