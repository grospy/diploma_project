<?php
//

/**
 *  core_customfield field value renderable.
 *
 * @package   core_customfield
 * @copyright 2018 Daniel Neis Araujo <danielneis@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_customfield\output;

use core_customfield\data_controller;

defined('MOODLE_INTERNAL') || die;

/**
 * core_customfield field value renderable class.
 *
 * @package   core_customfield
 * @copyright 2018 Daniel Neis Araujo <danielneis@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class field_data implements \renderable, \templatable {

    /** @var \core_customfield\data_controller */
    protected $data;

    /**
     * Renderable constructor.
     *
     * @param \core_customfield\data_controller $data
     */
    public function __construct(\core_customfield\data_controller $data) {
        $this->data = $data;
    }

    /**
     * Returns the data value formatted for the output
     *
     * @return mixed|null
     */
    public function get_value() {
        return $this->data->export_value();
    }

    /**
     * Returns the field type (checkbox, date, text, ...)
     *
     * @return string
     */
    public function get_type() : string {
        return $this->data->get_field()->get('type');
    }

    /**
     * Returns the field short name
     *
     * @return string
     */
    public function get_shortname() : string {
        return $this->data->get_field()->get('shortname');
    }

    /**
     * Returns the field name formatted for the output
     *
     * @return string
     */
    public function get_name() : string {
        return $this->data->get_field()->get_formatted_name();
    }

    /**
     * Returns the data controller used to create this object if additional attributes are needed
     *
     * @return data_controller
     */
    public function get_data_controller() : data_controller {
        return $this->data;
    }

    /**
     * Export data for using as template context.
     *
     * @param \renderer_base $output
     * @return \stdClass
     */
    public function export_for_template(\renderer_base $output) {
        $value = $this->get_value();
        return (object)[
            'value' => $value,
            'type' => $this->get_type(),
            'shortname' => $this->get_shortname(),
            'name' => $this->get_name(),
            'hasvalue' => ($value !== null),
            'instanceid' => $this->data->get('instanceid')
        ];
    }
}
