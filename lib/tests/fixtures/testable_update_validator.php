<?php
//

/**
 * Provides testable_core_update_validator class.
 *
 * @package     core_plugin
 * @category    test
 * @copyright   2013, 2015 David Mudrak <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Provides access to protected methods we want to explicitly test
 *
 * @copyright 2013, 2015 David Mudrak <david@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class testable_core_update_validator extends \core\update\validator {

    public function testable_parse_version_php($fullpath) {
        return parent::parse_version_php($fullpath);
    }

    public function get_plugintype_location($plugintype) {

        $testableroot = make_temp_directory('testable_core_update_validator/plugintypes');
        if (!file_exists($testableroot.'/'.$plugintype)) {
            make_temp_directory('testable_core_update_validator/plugintypes/'.$plugintype);
        }

        return $testableroot.'/'.$plugintype;
    }
}
