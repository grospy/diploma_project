<?php
//

/**
 * Element that just generates some text.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\ui;

defined('MOODLE_INTERNAL') || die;

/**
 * Element that just generates some text.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class empty_element extends element {

    /**
     * Constructor
     *
     * @param string $msg The text
     */
    public function __construct($msg = null) {
        if (is_null($msg)) {
            $this->text = '&nbsp;';
        } else {
            $this->text = $msg;
        }
    }

    /**
     * Generate the html (simple case)
     *
     * @return string HTML
     */
    public function html() {
        return $this->text;
    }
}
