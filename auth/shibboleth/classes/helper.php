<?php
//

/**
 * Contains a helper class for the Shibboleth authentication plugin.
 *
 * @package    auth_shibboleth
 * @copyright  2018 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace auth_shibboleth;

defined('MOODLE_INTERNAL') || die();

/**
 * The helper class for the Shibboleth authentication plugin.
 *
 * @package    auth_shibboleth
 * @copyright  2018 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class helper {

    /**
     * Delete session of user using file sessions.
     *
     * @param string $spsessionid SP-provided Shibboleth Session ID
     * @return \SoapFault or void if everything was fine
     */
    public static function logout_file_session($spsessionid) {
        global $CFG;

        if (!empty($CFG->session_file_save_path)) {
            $dir = $CFG->session_file_save_path;
        } else {
            $dir = $CFG->dataroot . '/sessions';
        }

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                // Read all session files.
                while (($file = readdir($dh)) !== false) {
                    // Check if it is a file.
                    if (is_file($dir.'/'.$file)) {
                        // Read session file data.
                        $data = file($dir.'/'.$file);
                        if (isset($data[0])) {
                            $usersession = self::unserializesession($data[0]);
                            // Check if we have found session that shall be deleted.
                            if (isset($usersession['SESSION']) && isset($usersession['SESSION']->shibboleth_session_id)) {
                                // If there is a match, delete file.
                                if ($usersession['SESSION']->shibboleth_session_id == $spsessionid) {
                                    // Delete session file.
                                    if (!unlink($dir.'/'.$file)) {
                                        return new SoapFault('LogoutError', 'Could not delete Moodle session file.');
                                    }
                                }
                            }
                        }
                    }
                }
                closedir($dh);
            }
        }
    }

    /**
     * Delete session of user using DB sessions.
     *
     * @param string $spsessionid SP-provided Shibboleth Session ID
     */
    public static function logout_db_session($spsessionid) {
        global $CFG, $DB;

        $sessions = $DB->get_records_sql(
            'SELECT userid, sessdata FROM {sessions} WHERE timemodified > ?',
            array(time() - $CFG->sessiontimeout)
        );

        foreach ($sessions as $session) {
            // Get user session from DB.
            if (session_decode(base64_decode($session->sessdata))) {
                if (isset($_SESSION['SESSION']) && isset($_SESSION['SESSION']->shibboleth_session_id)) {
                    // If there is a match, kill the session.
                    if ($_SESSION['SESSION']->shibboleth_session_id == trim($spsessionid)) {
                        // Delete this user's sessions.
                        \core\session\manager::kill_user_sessions($session->userid);
                    }
                }
            }
        }
    }

    /**
     * Unserialize a session string.
     *
     * @param string $serializedstring
     * @return array
     */
    private static function unserializesession($serializedstring) {
        $variables = array();
        $a = preg_split("/(\w+)\|/", $serializedstring, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $counta = count($a);
        for ($i = 0; $i < $counta; $i = $i + 2) {
            $variables[$a[$i]] = unserialize($a[$i + 1]);
        }
        return $variables;
    }
}
