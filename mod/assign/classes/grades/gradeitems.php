<?php
//

/**
 * Grade item mappings for the activity.
 *
 * @package   mod_assign
 * @copyright Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

declare(strict_types = 1);

namespace mod_assign\grades;

use \core_grades\local\gradeitem\itemnumber_mapping;
use \core_grades\local\gradeitem\advancedgrading_mapping;

/**
 * Grade item mappings for the activity.
 *
 * @package   mod_assign
 * @copyright Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class gradeitems implements itemnumber_mapping, advancedgrading_mapping {

    /**
     * Return the list of grade item mappings for the assign.
     *
     * @return array
     */
    public static function get_itemname_mapping_for_component(): array {
        return [
            0 => 'submissions',
        ];
    }

    /**
     * Get the list of advanced grading item names for this component.
     *
     * @return array
     */
    public static function get_advancedgrading_itemnames(): array {
        return [
            'submissions',
        ];
    }
}
