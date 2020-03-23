<?php
//

/**
 * Provides testable_flexible_table class.
 *
 * @package     core
 * @subpackage  fixtures
 * @category    test
 * @copyright   2015 David Mudrak <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Testable subclass of flexible_table providing access to some protected methods.
 *
 * @copyright 2015 David Mudrak <david@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class testable_flexible_table extends flexible_table {

    /**
     * Provides access to flexible_table::can_be_reset() method.
     *
     * @return bool
     */
    public function can_be_reset() {
        return parent::can_be_reset();
    }
}
