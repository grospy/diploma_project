<?php
//

/**
 * Abstract class for a form element representing something about a grade_grade.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\ui;

defined('MOODLE_INTERNAL') || die;

/**
 * Abstract class for a form element representing something about a grade_grade.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class grade_attribute_format extends attribute_format implements unique_name {

    /** @var string $name The first part of the name attribute of the form input */
    public $name;

    /** @var string $label The label of the input */
    public $label;

    /** @var grade_grade $grade The grade_grade of the input */
    public $grade;

    /**
     * Constructor
     *
     * @param grade_grade $grade The grade_grade we are editing.
     */
    public function __construct($grade = 0) {
        $this->grade = $grade;
    }

    /**
     * Get a unique name for this form input
     *
     * @return string The form input name attribute.
     */
    public function get_name() {
        return "{$this->name}_{$this->grade->itemid}_{$this->grade->userid}";
    }

    /**
     * Should be overridden by the child class to save the value returned in this input.
     *
     * @param string $value The value from the form.
     * @return string Any error message
     */
    public abstract function set($value);
}
