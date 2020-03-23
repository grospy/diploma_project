<?php
//

/**
 * Callbacks
 *
 * @package   customfield_textarea
 * @copyright 2018 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Serve the files from the customfield_textarea file areas
 *
 * @param stdClass $course the course object
 * @param stdClass $cm the course module object
 * @param context $context the context
 * @param string $filearea the name of the file area
 * @param array $args extra arguments (itemid, path)
 * @param bool $forcedownload whether or not force download
 * @param array $options additional options affecting the file serving
 * @return bool false if the file not found, just send the file otherwise and do not return
 */
function customfield_textarea_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options=array()) {
    global $DB;

    $itemid = array_shift($args);
    if ($filearea === 'value') {
        // Value of the data, itemid = id in data table.
        $datarecord = $DB->get_record(\core_customfield\data::TABLE, ['id' => $itemid], '*', MUST_EXIST);
        $field = \core_customfield\field_controller::create($datarecord->fieldid);
        $data = \core_customfield\data_controller::create(0, $datarecord, $field);
        $handler = $field->get_handler();
        if ($field->get('type') !== 'textarea' || !$handler->can_view($field, $data->get('instanceid'))
                || $data->get_context()->id != $context->id) {
            send_file_not_found();
        }
    } else if ($filearea === 'defaultvalue') {
        // Default value of the field, itemid = id in the field table.
        $field = \core_customfield\field_controller::create($itemid);
        $handler = $field->get_handler();
        if ($field->get('type') !== 'textarea' || $handler->get_configuration_context()->id != $context->id) {
            send_file_not_found();
        }
    } else {
        send_file_not_found();
    }

    $filename = array_pop($args); // The last item in the $args array.
    $filepath = '/' . ($args ? implode('/', $args) . '/' : '');

    // Retrieve the file from the Files API.
    $fs = get_file_storage();
    $file = $fs->get_file($context->id, 'customfield_textarea', $filearea, $itemid, $filepath, $filename);
    if (!$file) {
        send_file_not_found();
    }

    // We can now send the file back to the browser - in this case with a cache lifetime of 1 day and no filtering.
    send_file($file, 86400, 0, $forcedownload, $options);
}
