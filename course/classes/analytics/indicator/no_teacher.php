<?php
//

/**
 * No teacher indicator.
 *
 * @package   core_course
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_course\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * No teacher indicator.
 *
 * @package   core_course
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class no_teacher extends \core_analytics\local\indicator\binary {

    /**
     * Teacher role ids.
     *
     * @var array|null
     */
    protected $teacherroleids = null;

    /**
     * Returns the name.
     *
     * If there is a corresponding '_help' string this will be shown as well.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('indicator:noteacher', 'moodle');
    }

    /**
     * required_sample_data
     *
     * @return string[]
     */
    public static function required_sample_data() {
        // We require course because, although calculate_sample only reads context, we need the context to be course
        // or below.
        return array('context', 'course');
    }

    /**
     * calculate_sample
     *
     * @param int $sampleid
     * @param string $sampleorigin
     * @param int|false $notusedstarttime
     * @param int|false $notusedendtime
     * @return float
     */
    public function calculate_sample($sampleid, $sampleorigin, $notusedstarttime = false, $notusedendtime = false) {

        $context = $this->retrieve('context', $sampleid);

        if (is_null($this->teacherroleids)) {
            $this->teacherroleids = array_keys(get_archetype_roles('editingteacher') + get_archetype_roles('teacher'));
        }

        foreach ($this->teacherroleids as $role) {
            // We look for roles, not enrolments as a teacher assigned at category level is supposed to be a
            // course teacher.
            $teachers = get_role_users($role, $context, false, 'u.id', 'u.id');
            if ($teachers) {
                return self::get_max_value();
            }
        }

        return self::get_min_value();
    }
}
