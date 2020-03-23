<?php
//

/**
 * Privacy class for requesting user data.
 *
 * @package    core_grading
 * @copyright  2018 Adrian Greeve <adriangreeve.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_grading\privacy;

defined('MOODLE_INTERNAL') || die();

interface gradingform_provider_v2 extends
    \core_privacy\local\request\plugin\subsystem_provider,
    \core_privacy\local\request\shared_userlist_provider
{

    /**
     * Export user data relating to an instance ID.
     *
     * @param  \context $context Context to use with the export writer.
     * @param  int $instanceid The instance ID to export data for.
     * @param  array $subcontext The directory to export this data to.
     */
    public static function export_gradingform_instance_data(\context $context, int $instanceid, array $subcontext);

    /**
     * Deletes all user data related to the provided instance IDs.
     *
     * @param  array  $instanceids The instance IDs to delete information from.
     */
    public static function delete_gradingform_for_instances(array $instanceids);
}
