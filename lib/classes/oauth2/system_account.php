<?php
//

/**
 * When using OAuth sometimes it makes sense to authenticate as a system user, and not the current user.
 *
 * @package    core
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\oauth2;

defined('MOODLE_INTERNAL') || die();

use core\persistent;

/**
 * Class for loading/storing oauth2 refresh tokens from the DB.
 *
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class system_account extends persistent {

    const TABLE = 'oauth2_system_account';

    /**
     * Return the definition of the properties of this model.
     *
     * @return array
     */
    protected static function define_properties() {
        return array(
            'issuerid' => array(
                'type' => PARAM_INT
            ),
            'refreshtoken' => array(
                'type' => PARAM_RAW,
            ),
            'grantedscopes' => array(
                'type' => PARAM_RAW,
            ),
            'email' => array(
                'type' => PARAM_RAW,
            ),
            'username' => array(
                'type' => PARAM_RAW,
            )
        );
    }
}
