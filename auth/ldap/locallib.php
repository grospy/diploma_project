<?php
//

/**
 * Internal library of functions for module auth_ldap
 *
 * @package    auth_ldap
 * @author     David Balch <david.balch@conted.ox.ac.uk>
 * @copyright  2017 The Chancellor Masters and Scholars of the University of Oxford {@link http://www.tall.ox.ac.uk/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Get a list of system roles assignable by the current or a specified user, including their localised names.
 *
 * @param integer|object $user A user id or object. By default (null) checks the permissions of the current user.
 * @return array $roles, each role as an array with id, shortname, localname, and settingname for the config value.
 */
function get_ldap_assignable_role_names($user = null) {
    $roles = array();

    if ($assignableroles = get_assignable_roles(context_system::instance(), ROLENAME_SHORT, false, $user)) {
        $systemroles = role_fix_names(get_all_roles(), context_system::instance(), ROLENAME_ORIGINAL);
        foreach ($assignableroles as $shortname) {
            foreach ($systemroles as $systemrole) {
                if ($systemrole->shortname == $shortname) {
                    $roles[] = array('id' => $systemrole->id,
                                     'shortname' => $shortname,
                                     'localname' => $systemrole->localname,
                                     'settingname' => $shortname . 'context');
                    break;
                }
            }
        }
    }

    return $roles;
}
