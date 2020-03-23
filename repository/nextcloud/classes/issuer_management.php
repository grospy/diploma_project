<?php
//
//

/**
 * Provide static functions for creating and validating issuers.
 *
 * @package    repository_nextcloud
 * @copyright  2018 Jan Dageförde (Learnweb, University of Münster)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace repository_nextcloud;

defined('MOODLE_INTERNAL') || die();

/**
 * Provide static functions for creating and validating issuers.
 *
 * @package    repository_nextcloud
 * @copyright  2018 Jan Dageförde (Learnweb, University of Münster)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class issuer_management {

    /**
     * Check if an issuer provides all endpoints that are required by repository_nextcloud.
     * @param \core\oauth2\issuer $issuer An issuer.
     * @return bool True, if all endpoints exist; false otherwise.
     */
    public static function is_valid_issuer(\core\oauth2\issuer $issuer) {
        $endpointwebdav = false;
        $endpointocs = false;
        $endpointtoken = false;
        $endpointauth = false;
        $endpointuserinfo = false;
        $endpoints = \core\oauth2\api::get_endpoints($issuer);
        foreach ($endpoints as $endpoint) {
            $name = $endpoint->get('name');
            switch ($name) {
                case 'webdav_endpoint':
                    $endpointwebdav = true;
                    break;
                case 'ocs_endpoint':
                    $endpointocs = true;
                    break;
                case 'token_endpoint':
                    $endpointtoken = true;
                    break;
                case 'authorization_endpoint':
                    $endpointauth = true;
                    break;
                case 'userinfo_endpoint':
                    $endpointuserinfo = true;
                    break;
            }
        }
        return $endpointwebdav && $endpointocs && $endpointtoken && $endpointauth && $endpointuserinfo;
    }

    /**
     * Returns the parsed url parts of an endpoint of an issuer.
     * @param string $endpointname
     * @param \core\oauth2\issuer $issuer
     * @return array parseurl [scheme => https/http, host=>'hostname', port=>443, path=>'path']
     * @throws configuration_exception if an endpoint is undefined
     */
    public static function parse_endpoint_url(string $endpointname, \core\oauth2\issuer $issuer) : array {
        $url = $issuer->get_endpoint_url($endpointname);
        if (empty($url)) {
            throw new configuration_exception(get_string('endpointnotdefined', 'repository_nextcloud', $endpointname));
        }
        return parse_url($url);
    }
}
