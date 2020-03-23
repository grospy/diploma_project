<?php
//
/**
 * Privacy Subsystem implementation for datafield_textarea.
 *
 * @package    datafield_textarea
 * @copyright  2018 Carlos Escobedo <carlos@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace datafield_textarea\privacy;

use core_privacy\local\request\transform;
use core_privacy\local\request\writer;
use mod_data\privacy\datafield_provider;

defined('MOODLE_INTERNAL') || die();
/**
 * Privacy Subsystem for datafield_textarea implementing null_provider.
 *
 * @copyright  2018 Carlos Escobedo <carlos@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider,
        datafield_provider {
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
     * Exports data about one record in {data_content} table.
     *
     * @param \context_module $context
     * @param \stdClass $recordobj record from DB table {data_records}
     * @param \stdClass $fieldobj record from DB table {data_fields}
     * @param \stdClass $contentobj record from DB table {data_content}
     * @param \stdClass $defaultvalue pre-populated default value that most of plugins will use
     */
    public static function export_data_content($context, $recordobj, $fieldobj, $contentobj, $defaultvalue) {
        $subcontext = [$recordobj->id, $contentobj->id];
        $defaultvalue->content = writer::with_context($context)
            ->rewrite_pluginfile_urls($subcontext, 'mod_data', 'content', $contentobj->id,
            $defaultvalue->content);
        $defaultvalue->contentformat = $defaultvalue->content1;
        unset($defaultvalue->content1);

        $defaultvalue->field['autolink'] = transform::yesno($fieldobj->param1);
        $defaultvalue->field['rows'] = $fieldobj->param3;
        $defaultvalue->field['cols'] = $fieldobj->param2;
        if ($fieldobj->param5) {
            $defaultvalue->field['maxbytes'] = $fieldobj->param5;
        }
        writer::with_context($context)->export_data($subcontext, $defaultvalue);
    }

    /**
     * Allows plugins to delete locally stored data.
     *
     * @param \context_module $context
     * @param \stdClass $recordobj record from DB table {data_records}
     * @param \stdClass $fieldobj record from DB table {data_fields}
     * @param \stdClass $contentobj record from DB table {data_content}
     */
    public static function delete_data_content($context, $recordobj, $fieldobj, $contentobj) {

    }
}