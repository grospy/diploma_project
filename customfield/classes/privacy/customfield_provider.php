<?php
//

/**
 * Contains interface customfield_provider
 *
 * @package core_customfield
 * @copyright 2018 Marina Glancy
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_customfield\privacy;

use core_customfield\data_controller;

defined('MOODLE_INTERNAL') || die();

/**
 * Interface customfield_provider, all customfield plugins need to implement it
 *
 * @package core_customfield
 * @copyright 2018 Marina Glancy
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface customfield_provider extends
        \core_privacy\local\request\plugin\subplugin_provider,

        // The customfield plugins do not need to do anything themselves for the shared_userlist.
        // This is all handled by the component core_customfield.
        \core_privacy\local\request\shared_userlist_provider
    {

    /**
     * Preprocesses data object that is going to be exported
     *
     * Minimum implementation:
     *     writer::with_context($data->get_context())->export_data($subcontext, $exportdata);
     *
     * @param data_controller $data
     * @param \stdClass $exportdata generated object to be exported
     * @param array $subcontext subcontext to use when exporting
     * @return mixed
     */
    public static function export_customfield_data(data_controller $data, \stdClass $exportdata, array $subcontext);

    /**
     * Allows plugins to delete everything they store related to the data (usually files)
     *
     * If plugin does not store any related files or other information, implement as an empty function
     *
     * @param string $dataidstest select query for data id (note that it may also return data for other field types)
     * @param array $params named parameters for the select query
     * @param array $contextids list of affected data contexts
     * @return mixed
     */
    public static function before_delete_data(string $dataidstest, array $params, array $contextids);

    /**
     * Allows plugins to delete everything they store related to the field configuration (usually files)
     *
     * The implementation should not delete data or anything related to the data, since "before_delete_data" is
     * invoked separately.
     *
     * If plugin does not store any related files or other information, implement as an empty function
     *
     * @param string $fieldidstest select query for field id (note that it may also return fields of other types)
     * @param array $params named parameters for the select query
     * @param int[] $contextids list of affected configuration contexts
     */
    public static function before_delete_fields(string $fieldidstest, array $params, array $contextids);
}
