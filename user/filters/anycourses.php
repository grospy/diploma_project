<?php
//

/**
 * This is filter is used to see which students are enroled on any courses
 *
 * @package   core_user
 * @copyright 2014 Krister Viirsaar
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * User filter to distinguish users with no or any enroled courses.
 * @copyright 2014 Krister Viirsaar
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_filter_anycourses extends user_filter_yesno {

    /**
     * Returns the condition to be used with SQL
     *
     * @param array $data filter settings
     * @return array sql string and $params
     */
    public function get_sql_filter($data) {
        $value = $data['value'];

        $not = $value ? '' : 'NOT';

        return array("EXISTS ( SELECT userid FROM {user_enrolments} ) AND " .
            " id $not IN ( SELECT userid FROM {user_enrolments} )", array());
    }
}

