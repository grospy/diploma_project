<?php
//

/**
 * LTI Authentication plugin.
 *
 * @package auth_lti
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

/**
 * LTI Authentication plugin.
 *
 * @package auth_lti
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class auth_plugin_lti extends auth_plugin_base {

    /**
     * Constructor.
     */
    public function __construct() {
        $this->authtype = 'lti';
    }

    /**
     * Users can not log in via the traditional login form.
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool Authentication success or failure
     */
    public function user_login($username, $password) {
        return false;
    }
}
