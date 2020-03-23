<?php
//

/**
 * Mock handler for site policies
 *
 * @package    core_privacy
 * @copyright  2018 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Mock handler for site policies
 *
 * @package    core_privacy
 * @copyright  2018 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mock_sitepolicy_handler extends \core_privacy\local\sitepolicy\handler {

    /**
     * Returns URL to redirect user to when user needs to agree to site policy
     *
     * This is a regular interactive page for web users. It should have normal Moodle header/footers, it should
     * allow user to view policies and accept them.
     *
     * @param bool $forguests
     * @return moodle_url|null (returns null if site policy is not defined)
     */
    public static function get_redirect_url($forguests = false) {
        return 'http://example.com/policy.php';
    }

    /**
     * Returns URL of the site policy that needs to be displayed to the user (inside iframe or to use in WS such as mobile app)
     *
     * This page should not have any header/footer, it does not also have any buttons/checkboxes. The caller needs to implement
     * the "Accept" button and call {@link self::accept()} on completion.
     *
     * @param bool $forguests
     * @return moodle_url|null
     */
    public static function get_embed_url($forguests = false) {
        return 'http://example.com/view.htm';
    }

    /**
     * Accept site policy for the current user
     *
     * @return bool - false if sitepolicy not defined, user is not logged in or user has already agreed to site policy;
     *     true - if we have successfully marked the user as agreed to the site policy
     */
    public static function accept() {
        global $USER, $DB;
        // Accepts policy on behalf of the current user. We set it to 2 here to check that this callback was called.
        $USER->policyagreed = 2;
        if (!isguestuser()) {
            $DB->update_record('user', ['policyagreed' => 2, 'id' => $USER->id]);
        }
        return true;
    }
}
