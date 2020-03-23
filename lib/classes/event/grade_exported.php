<?php
//

/**
 * Grade report viewed event.
 *
 * @package    core
 * @copyright  2016 Zane Karl <zkarl@oid.ucla.edu>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Grade report viewed event class.
 *
 * @package    core
 * @since      Moodle 3.2
 * @copyright  2016 Zane Karl <zkarl@oid.ucla.edu>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class grade_exported extends base {

    /**
     * Initialise the event data.
     */
    protected function init() {
        if (!($this instanceof grade_exported)) {
            throw new Exception('grade_exported abstract is NOT extended by a valid component.');
        }
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Returns localised export type.
     *
     * @return string
     */
    public static function get_export_type() {
        $classname = explode('\\', get_called_class());
        $exporttype = explode('_', $classname[0]);
        return $exporttype[1];
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventgradeexported', 'gradeexport_'. self::get_export_type());
    }

    /**
     * Returns non-localised description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid'"
                . " exported grades using the ".
                $this->get_export_type() ." export in the gradebook.";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        $url = '/grade/export/' . $this->get_export_type() . '/export.php';
        return new \moodle_url($url, array('id' => $this->courseid));
    }
}