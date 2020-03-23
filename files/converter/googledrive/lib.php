<?php
//

/**
 * This plugin is used to convert documents with google drive.
 *
 * @package    fileconverter_googledrive
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Callback to get the required scopes for system account.
 *
 * @param \core\oauth2\issuer $issuer
 * @return string
 */
function fileconverter_googledrive_oauth2_system_scopes(\core\oauth2\issuer $issuer) {
    if ($issuer->get('id') == get_config('fileconverter_googledrive', 'issuerid')) {
        return 'https://www.googleapis.com/auth/drive';
    }
    return '';
}
