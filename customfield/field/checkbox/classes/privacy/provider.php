<?php
//

/**
 * Privacy Subsystem implementation for customfield_checkbox.
 *
 * @package    customfield_checkbox
 * @copyright  2018 Daniel Neis Araujo <danielneis@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace customfield_checkbox\privacy;

use core_customfield\data_controller;
use core_customfield\privacy\customfield_provider;
use core_privacy\local\request\writer;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for customfield_checkbox implementing null_provider.
 *
 * @copyright  2018 Daniel Neis Araujo <danielneis@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider, customfield_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }

    /**
     * Preprocesses data object that is going to be exported
     *
     * @param data_controller $data
     * @param \stdClass $exportdata
     * @param array $subcontext
     */
    public static function export_customfield_data(data_controller $data, \stdClass $exportdata, array $subcontext) {
        writer::with_context($data->get_context())->export_data($subcontext, $exportdata);
    }

    /**
     * Allows plugins to delete everything they store related to the data (usually files)
     *
     * @param string $dataidstest
     * @param array $params
     * @param array $contextids
     * @return mixed|void
     */
    public static function before_delete_data(string $dataidstest, array $params, array $contextids) {
    }

    /**
     * Allows plugins to delete everything they store related to the field configuration (usually files)
     *
     * @param string $fieldidstest
     * @param array $params
     * @param array $contextids
     */
    public static function before_delete_fields(string $fieldidstest, array $params, array $contextids) {
    }
}
