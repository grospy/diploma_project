<?php
//

/**
 * Default (core) handler for site policies.
 *
 * @package    core_privacy
 * @copyright  2018 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_privacy\local\sitepolicy;

use moodle_url;

defined('MOODLE_INTERNAL') || die();

/**
 * Default (core) handler for site policies.
 *
 * @package    core_privacy
 * @copyright  2018 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class default_handler extends handler {

    /**
     * Checks if the site has site policy defined
     *
     * @param bool $forguests
     * @return bool
     */
    public static function is_defined($forguests = false) {
        global $CFG;
        if (!empty($CFG->sitepolicyhandler)) {
            // This handler can also be used as a fallback in case of invalid $CFG->sitepolicyhandler,
            // in this case assume that no site policy is set.
            return false;
        }
        if (!$forguests) {
            return !empty($CFG->sitepolicy);
        } else {
            return !empty($CFG->sitepolicyguest);
        }
    }

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
        return static::is_defined($forguests) ? new moodle_url('/user/policy.php') : null;
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
        global $CFG;
        if (!empty($CFG->sitepolicyhandler)) {
            // This handler can also be used as a fallback in case of invalid $CFG->sitepolicyhandler,
            // in this case assume that no site policy is set.
            return null;
        }
        if ($forguests && !empty($CFG->sitepolicyguest)) {
            return new moodle_url($CFG->sitepolicyguest);
        } else if (!$forguests && !empty($CFG->sitepolicy)) {
            return new moodle_url($CFG->sitepolicy);
        }
        return null;
    }
}
