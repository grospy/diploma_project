<?php
//

/**
 * Loads/stores oauth2 access tokens in DB for system accounts in order to use a single token across multiple sessions.
 *
 * @package    core
 * @copyright  2018 Jan Dageförde <jan.dagefoerde@ercis.uni-muenster.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\oauth2;

defined('MOODLE_INTERNAL') || die();

use core\persistent;

/**
 * Loads/stores oauth2 access tokens in DB for system accounts in order to use a single token across multiple sessions.
 *
 * When a system user is authenticated via OAuth, we need to use a single access token across user sessions,
 * because we want to avoid using multiple tokens at the same time for a single remote user. Reasons are that,
 * first, redeeming the refresh token for an access token requires an additional request, and second, there is
 * no guarantee that redeeming the refresh token doesn't invalidate *all* corresponding previous access tokes.
 * As a result, we would need to either continuously request lots and lots of new access tokens, or persist the
 * access token in the DB where it can be used from all sessions. Let's do the latter!
 *
 * @copyright  2018 Jan Dageförde <jan.dagefoerde@ercis.uni-muenster.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class access_token extends persistent {

    /** The table name. */
    const TABLE = 'oauth2_access_token';

    /**
     * Return the definition of the properties of this model.
     *
     * @return array
     */
    protected static function define_properties() {
        return array(
            // Issuer id instead of the system account id because, at the time of storing/loading a token we may not
            // know the system account id.
            'issuerid' => array(
                'type' => PARAM_INT
            ),
            'token' => array(
                'type' => PARAM_RAW,
            ),
            'expires' => array(
                'type' => PARAM_INT,
            ),
            'scope' => array(
                'type' => PARAM_RAW,
            ),
        );
    }
}
