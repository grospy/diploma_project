<?php
//

/**
 * Checkbox element used for bulk inserting values in the gradebook.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\ui;

use html_writer;

defined('MOODLE_INTERNAL') || die;

/**
 * Checkbox element used for bulk inserting values in the gradebook.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class bulk_insert extends element {

    /**
     * Constructor
     *
     * @param mixed $item The grade item or user.
     */
    public function __construct($item) {
        $this->name = 'bulk_' . $item->id;
        $this->applyname = $this->name_for('apply');
        $this->selectname = $this->name_for('type');
        $this->insertname = $this->name_for('value');
    }

    /**
     * Is this checkbox checked?
     *
     * @param array $data The form data
     * @return bool
     */
    public function is_applied($data) {
        return isset($data->{$this->applyname});
    }

    /**
     * Get the type of this input (user or grade)
     *
     * @param array $data The form data
     * @return string
     */
    public function get_type($data) {
        return $data->{$this->selectname};
    }

    /**
     * Get the value from either the user or grade.
     *
     * @param array $data The form data
     * @return string
     */
    public function get_insert_value($data) {
        return $data->{$this->insertname};
    }

    /**
     * Generate the html for this form element.
     *
     * @return string HTML
     */
    public function html() {
        global $OUTPUT;

        $text = new text_attribute($this->insertname, "0", 'bulk');
        $context = (object) [
            'label' => get_string('bulklegend', 'gradereport_singleview'),
            'applylabel' => get_string('bulkperform', 'gradereport_singleview'),
            'applyname' => $this->applyname,
            'menuname' => $this->selectname,
            'menulabel' => get_string('bulkappliesto', 'gradereport_singleview'),
            'menuoptions' => [
                ['value' => 'all', 'name' => get_string('all_grades', 'gradereport_singleview')],
                ['value' => 'blanks', 'name' => get_string('blanks', 'gradereport_singleview'), 'selected' => true],
            ],
            'valuename' => $this->insertname,
            'valuelabel' => get_string('bulkinsertvalue', 'gradereport_singleview'),
            'valuefield' => $text->html()
        ];

        return $OUTPUT->render_from_template('gradereport_singleview/bulk_insert', $context);
    }

    /**
     * This form element has 3 elements with different suffixes.
     * Generate the name with the suffix.
     *
     * @param string $extend The suffix.
     * @return string
     */
    private function name_for($extend) {
        return "{$this->name}_$extend";
    }
}
