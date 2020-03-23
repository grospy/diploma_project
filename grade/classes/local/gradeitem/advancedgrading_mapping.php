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
interface advancedgrading_mapping {

    /**
     * Get the list of advanced grading item names for this component.
     *
     * @return array
     */
    public static function get_advancedgrading_itemnames(): array;
}
