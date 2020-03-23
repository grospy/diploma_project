<?php
//

/**
 * Provides {@link mod_workshop\privacy\workshopform_provider} interface.
 *
 * @package     mod_workshop
 * @category    privacy
 * @copyright   2018 David Mudrák <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_workshop\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Interface for grading strategy subplugins implementing the privacy API.
 *
 * @copyright 2018 David Mudrák <david@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface workshopform_provider extends
        \core_privacy\local\request\plugin\subplugin_provider,
        \core_privacy\local\request\shared_userlist_provider
    {

    /**
     * Return details of the filled assessment form.
     *
     * @param stdClass $user User we are exporting data for
     * @param context $context The workshop activity context
     * @param array $subcontext Subcontext within the context to export to
     * @param int $assessmentid ID of the assessment
     */
    public static function export_assessment_form(\stdClass $user, \context $context, array $subcontext, int $assessmentid);
}
