<?php
//

/**
 * Google Drive Rest API.
 *
 * @package    fileconverter_googledrive
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace fileconverter_googledrive;

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
            'upload' => [
                'endpoint' => 'https://www.googleapis.com/upload/drive/v3/files',
                'method' => 'post',
                'args' => [
                    'uploadType' => PARAM_RAW,
                    'fields' => PARAM_RAW
                ],
                'response' => 'headers'
            ],
            'upload_content' => [
                'endpoint' => '{uploadurl}',
                'method' => 'put',
                'args' => [
                    'uploadurl' => PARAM_URL
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
            'delete' => [
                'endpoint' => 'https://www.googleapis.com/drive/v3/files/{fileid}',
                'method' => 'delete',
                'args' => [
                    'fileid' => PARAM_RAW
                ],
                'response' => 'json'
            ],
        ];
    }
}
