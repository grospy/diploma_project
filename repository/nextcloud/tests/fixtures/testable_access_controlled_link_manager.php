<?php
//

/**
 * Test support class for testing access_controlled_link_manager.
 *
 * @package    repository_nextcloud
 * @copyright  2018 Nina Herrmann (Learnweb, University of Münster)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

use core\oauth2\client;
use repository_nextcloud\access_controlled_link_manager;
use repository_nextcloud\ocs_client;

/**
 * Test support class for testing access_controlled_link_manager.
 *
 * @package    repository_nextcloud
 * @copyright  2018 Nina Herrmann (Learnweb, University of Münster)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class testable_access_controlled_link_manager extends access_controlled_link_manager {

    /**
     * Access_controlled_link_manager constructor.
     * @param ocs_client $ocsclient
     * @param client $systemoauthclient
     * @param ocs_client $systemocsclient
     * @param \core\oauth2\issuer $issuer
     * @param string $repositoryname
     * @param \webdav_client $systemdav
     */
    public function __construct($ocsclient, $systemoauthclient, $systemocsclient, \core\oauth2\issuer $issuer, $repositoryname,
                                $systemdav) {
        $this->ocsclient = $ocsclient;
        $this->systemoauthclient = $systemoauthclient;
        $this->systemocsclient = $systemocsclient;
        $this->repositoryname = $repositoryname;
        $this->issuer = $issuer;
        $this->systemwebdavclient = $systemdav;
    }
}
