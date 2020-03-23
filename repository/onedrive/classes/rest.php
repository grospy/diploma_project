<?php
//

/**
 * Microsoft Graph API Rest Interface.
 *
 * @package    repository_onedrive
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace repository_onedrive;

defined('MOODLE_INTERNAL') || die();

/**
 * Microsoft Graph API Rest Interface.
 *
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class rest extends \core\oauth2\rest {

    /**
     * Define the functions of the rest API.
     *
     * @return array Example:
     *  [ 'listFiles' => [ 'method' => 'get', 'endpoint' => 'http://...', 'args' => [ 'folder' => PARAM_STRING ] ] ]
     */
    public function get_api_functions() {
        return [
            'list' => [
                'endpoint' => 'https://graph.microsoft.com/v1.0/me/drive/{parent}/children',
                'method' => 'get',
                'args' => [
                    '$select' => PARAM_RAW,
                    '$expand' => PARAM_RAW,
                    'parent' => PARAM_RAW,
                    '$skip' => PARAM_INT,
                    '$skipToken' => PARAM_RAW,
                    '$count' => PARAM_INT
                ],
                'response' => 'json'
            ],
            'search' => [
                'endpoint' => 'https://graph.microsoft.com/v1.0/me/drive/{parent}/search(q=\'{search}\')',
                'method' => 'get',
                'args' => [
                    'search' => PARAM_NOTAGS,
                    '$select' => PARAM_RAW,
                    'parent' => PARAM_RAW,
                    '$skip' => PARAM_INT,
                    '$skipToken' => PARAM_RAW,
                    '$count' => PARAM_INT
                ],
                'response' => 'json'
            ],
            'get' => [
                'endpoint' => 'https://graph.microsoft.com/v1.0/me/drive/items/{fileid}',
                'method' => 'get',
                'args' => [
                    'fileid' => PARAM_RAW,
                    '$select' => PARAM_RAW,
                    '$expand' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'create_permission' => [
                'endpoint' => 'https://graph.microsoft.com/v1.0/me/drive/items/{fileid}/invite',
                'method' => 'post',
                'args' => [
                    'fileid' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'create_upload' => [
                'endpoint' => 'https://graph.microsoft.com/v1.0/me/drive/items/{parentid}:/{filename}:/createUploadSession',
                'method' => 'post',
                'args' => [
                    'parentid' => PARAM_RAW,
                    'filename' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'get_file_by_path' => [
                'endpoint' => 'https://graph.microsoft.com/v1.0/me/drive/root:/{fullpath}',
                'method' => 'get',
                'args' => [
                    'fullpath' => PARAM_RAW,
                    '$select' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'create_folder' => [
                'endpoint' => 'https://graph.microsoft.com/v1.0/me/drive/items/{parentid}/children',
                'method' => 'post',
                'args' => [
                    'parentid' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'create_link' => [
                'endpoint' => 'https://graph.microsoft.com/v1.0/me/drive/items/{fileid}/createLink',
                'method' => 'post',
                'args' => [
                    'fileid' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'delete_file_by_path' => [
                'endpoint' => 'https://graph.microsoft.com/v1.0/me/drive/root:/{fullpath}',
                'method' => 'delete',
                'args' => [
                    'fullpath' => PARAM_RAW,
                ],
                'response' => 'json'
            ],
            'delete_permission' => [
                'endpoint' => 'https://graph.microsoft.com/v1.0/me/drive/items/{fileid}/permissions/{permissionid}',
                'method' => 'delete',
                'args' => [
                    'fileid' => PARAM_RAW,
                    'permissionid' => PARAM_RAW
                ],
                'response' => 'json'
            ],
        ];
    }
}
