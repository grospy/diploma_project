<?php
//

/**
 * Class for loading/storing issuers from the DB.
 *
 * @package    auth_oauth2
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace auth_oauth2;

defined('MOODLE_INTERNAL') || die();

use core\persistent;

/**
 * Class for loading/storing issuer from the DB
 *
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class linked_login extends persistent {

    const TABLE = 'auth_oauth2_linked_login';

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
            'userid' => array(
                'type' => PARAM_INT
            ),
            'username' => array(
                'type' => PARAM_RAW
            ),
            'email' => array(
                'type' => PARAM_RAW
            ),
            'confirmtoken' => array(
                'type' => PARAM_RAW
            ),
            'confirmtokenexpires' => array(
                'type' => PARAM_INT
            )
        );
    }

    /**
     * Check whether there are any valid linked accounts for this issuer
     * and username combination.
     *
     * @param \core\oauth2\issuer $issuer The issuer
     * @param string $username The username to check
     */
    public static function has_existing_issuer_match(\core\oauth2\issuer $issuer, $username) {
        global $DB;

        $where = "issuerid = :issuerid
              AND username = :username
              AND (confirmtokenexpires = 0 OR confirmtokenexpires > :maxexpiry)";

        $count = $DB->count_records_select(static::TABLE, $where, [
            'issuerid' => $issuer->get('id'),
            'username' => $username,
            'maxexpiry' => (new \DateTime('NOW'))->getTimestamp(),
        ]);

        return $count > 0;
    }

    /**
     * Remove all linked logins that are using issuers that have been deleted.
     *
     * @param int $issuerid The issuer id of the issuer to check, or false to check all (defaults to all)
     * @return boolean
     */
    public static function delete_orphaned($issuerid = false) {
        global $DB;
        // Delete any linked_login entries with a issuerid
        // which does not exist in the issuer table.
        // In the left join, the issuer id will be null
        // where a match linked_login.issuerid is not found.
        $sql = "DELETE FROM {" . self::TABLE . "}
                 WHERE issuerid NOT IN (SELECT id FROM {" . \core\oauth2\issuer::TABLE . "})";
        $params = [];
        if (!empty($issuerid)) {
            $sql .= ' AND issuerid = ?';
            $params['issuerid'] = $issuerid;
        }
        return $DB->execute($sql, $params);
    }

}
