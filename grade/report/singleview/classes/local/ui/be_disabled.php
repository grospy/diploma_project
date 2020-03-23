<?php
//

/**
 * be_disabled interface.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\ui;

defined('MOODLE_INTERNAL') || die;

/**
 * Simple interface implemented to add behaviour that an element can be checked to see
 * if it should be disabled.
 */
interface be_disabled {
    /**
     * Am I disabled ?
     *
     * @return bool
     */
    public function is_disabled();
}
