<?php
//

/**
 * Grade item mappings for the activity.
 *
 * @package   mod_workshop
 * @copyright Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

declare(strict_types = 1);

namespace mod_workshop\grades;

use \core_grades\local\gradeitem\itemnumber_mapping;

/**
 * Grade item mappings for the activity.
 *
 * @package   mod_workshop
 * @copyright Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class gradeitems implements itemnumber_mapping {
    /**
     * Return the list of grade item mappings for the workshop.
     *
     * @return array
     */
    public static function get_itemname_mapping_for_component(): array {
        return [
            0 => 'submission',
            1 => 'grading',
        ];
    }
}
