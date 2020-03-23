<?php
//

/**
 * Helper class to to test column_base class.
 *
 * @package core_question
 * @copyright 2018 Huong Nguyen <huongnv13@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Helper class to to test column_base class.
 *
 * @package core_question
 * @copyright 2018 Huong Nguyen <huongnv13@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class testable_core_question_column extends \core_question\bank\column_base {

    /** @var array sortable columns. */
    private $sortable = [];

    /**
     * Output the column header cell.
     */
    public function is_sortable() {
        return $this->sortable;
    }

    /**
     * Set the sortable columns for testing.
     *
     * @param array $sortable
     */
    public function set_sortable(array $sortable) {
        $this->sortable = $sortable;
    }

    protected function display_content($question, $rowclasses) {
        echo 'Test Column';
    }

    public function get_name() {
        return 'test_column';
    }

    protected function get_title() {
        return 'Test Column';
    }
}
