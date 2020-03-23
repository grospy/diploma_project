<?php
//

/**
 * Exception for when an OCS request fails
 *
 * @package    repository_nextcloud
 * @copyright  2017 Jan Dageförde (Learnweb, University of Münster)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace repository_nextcloud;

defined('MOODLE_INTERNAL') || die();

/**
 * Exception for when an OCS request fails
 *
 * @package    repository_nextcloud
 * @copyright  2017 Jan Dageförde (Learnweb, University of Münster)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class request_exception extends \moodle_exception {

    /**
     * An OCS request has failed.
     *
     * @param string $hint optional param for additional information of the problem
     * @param string $debuginfo detailed information how to fix problem
     */
    public function __construct($hint = '', $debuginfo = null) {
        parent::__construct('request_exception', 'repository_nextcloud', '', $hint, $debuginfo);
    }
}