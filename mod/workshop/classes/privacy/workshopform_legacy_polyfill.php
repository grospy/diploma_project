<?php
//

/**
 * Provides {@link mod_workshop\privacy\workshopform_legacy_polyfill} trait.
 *
 * @package     mod_workshop
 * @category    privacy
 * @copyright   2018 David Mudrák <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_workshop\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Trait allowing additional (contrib) plugins to have single codebase for 3.3 and 3.4.
 *
 * The signature of the method in the {@link \mod_workshop\privacy\workshopform_provider} interface makes use of scalar
 * type hinting that is available in PHP 7.0 only.  If a plugin wants to implement the interface in 3.3 (and therefore
 * PHP 5.6) with the same codebase, they can make use of this trait. Instead of implementing the interface directly, the
 * workshopform plugin can implement the required logic in the method (note the underscore and missing "int" hint):
 *
 *     public static function _export_assessment_form(\stdClass $user, \context $context, array $subcontext, $assessmentid)
 *
 * and then simply use this trait in their provider class.
 *
 * @copyright 2018 David Mudrák <david@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
trait workshopform_legacy_polyfill {

    /**
     * Return details of the filled assessment form.
     *
     * @param stdClass $user User we are exporting data for
     * @param context $context The workshop activity context
     * @param array $subcontext Subcontext within the context to export to
     * @param int $assessmentid ID of the assessment
     */
    public static function export_assessment_form(\stdClass $user, \context $context, array $subcontext, int $assessmentid) {
        return static::_export_assessment_form($user, $context, $subcontext, $assessmentid);
    }
}
