<?php
//

/**
 * The assignsubmission_file submission_updated event.
 *
 * @package    assignsubmission_file
 * @copyright  2014 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace assignsubmission_file\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The assignsubmission_file submission_updated event class.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - int filesubmissioncount: The number of files uploaded.
 * }
 *
 * @package    assignsubmission_file
 * @since      Moodle 2.7
 * @copyright  2014 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class submission_updated extends \mod_assign\event\submission_updated {

    /**
     * Init method.
     */
    protected function init() {
        parent::init();
        $this->data['objecttable'] = 'assignsubmission_file';
    }

    /**
     * Returns non-localised description of what happened.
     *
     * @return string
     */
    public function get_description() {
        $descriptionstring = "The user with id '$this->userid' updated a file submission and uploaded " .
            "'{$this->other['filesubmissioncount']}' file/s in the assignment with course module id " .
            "'$this->contextinstanceid'";
        if (!empty($this->other['groupid'])) {
            $descriptionstring .= " for the group with id '{$this->other['groupid']}'.";
        } else {
            $descriptionstring .= ".";
        }

        return $descriptionstring;
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();
        if (!isset($this->other['filesubmissioncount'])) {
            throw new \coding_exception('The \'filesubmissioncount\' value must be set in other.');
        }
    }

    public static function get_objectid_mapping() {
        // No mapping available for 'assignsubmission_file'.
        return array('db' => 'assignsubmission_file', 'restore' => \core\event\base::NOT_MAPPED);
    }
}
