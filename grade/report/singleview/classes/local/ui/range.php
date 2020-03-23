<?php
//

/**
 * UI element that generates a min/max range (text only).
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\ui;

defined('MOODLE_INTERNAL') || die;

/**
 * UI element that generates a grade_item min/max range (text only).
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class range extends attribute_format {

    /**
     * Constructor
     * @param grade_item $item The grade item
     */
    public function __construct($item) {
        $this->item = $item;
    }

    /**
     * Build this UI element.
     *
     * @return element
     */
    public function determine_format() {
        $decimals = $this->item->get_decimals();

        $min = format_float($this->item->grademin, $decimals);
        $max = format_float($this->item->grademax, $decimals);

        return new empty_element("$min - $max");
    }
}
