<?php
//

/**
 * Class that builds an element tree that can be converted to a string
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\ui;

defined('MOODLE_INTERNAL') || die;

/**
 * Class that builds an element tree that can be converted to a string
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class attribute_format {

    /**
     * Used to convert this class to an "element" which can be converted to a string.
     * @return element
     */
    abstract public function determine_format();

    /**
     * Convert this to an element and then to a string
     * @return string
     */
    public function __toString() {
        return $this->determine_format()->html();
    }
}

