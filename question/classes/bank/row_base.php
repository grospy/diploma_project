<?php
//

/**
 * Base class for 'columns' that are actually displayed as a row following the main question row.
 *
 * @package   core_question
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_question\bank;
defined('MOODLE_INTERNAL') || die();


/**
 * Base class for 'columns' that are actually displayed as a row following the main question row.
 *
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class row_base extends column_base {
    public function is_extra_row() {
        return true;
    }

    protected function display_start($question, $rowclasses) {
        if ($rowclasses) {
            echo '<tr class="' . $rowclasses . '">' . "\n";
        } else {
            echo "<tr>\n";
        }
        echo '<td colspan="' . $this->qbank->get_column_count() . '" class="' . $this->get_name() . '">';
    }

    protected function display_end($question, $rowclasses) {
        echo "</td></tr>\n";
    }
}
