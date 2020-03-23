<?php
//

/**
 * Google Drive Rest API.
 *
 * @package    repository_googledocs
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace repository_googledocs;

defined('MOODLE_INTERNAL') || die();

/**
 * Google Drive Rest API.
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
                'endpoint' => 'https://www.googleapis.com/drive/v3/files',
                'method' => 'get',
                'args' => [
                    'corpus' => PARAM_RAW,
                    'orderBy' => PARAM_RAW,
                    'fields' => PARAM_RAW,
                    'pageSize' => PARAM_INT,
                    'pageToken' => PARAM_RAW,
                    'q' => PARAM_RAW,
                    'spaces' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'get' => [
                'endpoint' => 'https://www.googleapis.com/drive/v3/files/{fileid}',
                'method' => 'get',
                'args' => [
                    'fields' => PARAM_RAW,
                    'fileid' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'copy' => [
                'endpoint' => 'https://www.googleapis.com/drive/v3/files/{fileid}/copy',
                'method' => 'post',
                'args' => [
                    'fields' => PARAM_RAW,
                    'fileid' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'delete' => [
                'endpoint' => 'https://www.googleapis.com/drive/v3/files/{fileid}',
                'method' => 'delete',
                'args' => [
                    'fileid' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'create' => [
                'endpoint' => 'https://www.googleapis.com/drive/v3/files',
                'method' => 'post',
                'args' => [
                    'fields' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'update' => [
                'endpoint' => 'https://www.googleapis.com/drive/v3/files/{fileid}',
                'method' => 'patch',
                'args' => [
                    'fileid' => PARAM_RAW,
                    'fields' => PARAM_RAW,
                    'addParents' => PARAM_RAW,
                    'removeParents' => PARAM_RAW
                ],
                'response' => 'json'
            ],
            'create_permission' => [
                'endpoint' => 'https://www.googleapis.com/drive/v3/files/{fileid}/permissions',
                'method' => 'post',
                'args' => [
                    'fileid' => PARAM_RAW,
                    'emailMessage' => PARAM_RAW,
                    'sendNotificationEmail' => PARAM_RAW,
                    'transferOwnership' => PARAM_RAW,
                ],
                'response' => 'json'
            ],
            'update_permission' => [
                'endpoint' => 'https://www.googleapis.com/drive/v3/files/{fileid}/permissions/{permissionid}',
                'method' => 'patch',
                'args' => [
                    'fileid' => PARAM_RAW,
                    'permissionid' => PARAM_RAW,
                    'emailMessage' => PARAM_RAW,
                    'sendNotificationEmail' => PARAM_RAW,
                    'transferOwnership' => PARAM_RAW,
                ],
                'response' => 'json'
            ],
        ];
    }
}
