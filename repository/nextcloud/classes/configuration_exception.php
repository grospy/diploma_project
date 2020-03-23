<?php
//

/**
 * Exception for when client configuration data is missing.
 *
 * @package    repository_nextcloud
 * @copyright  2017 Project seminar (Learnweb, University of Münster)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace repository_nextcloud;

defined('MOODLE_INTERNAL') || die();

/**
 * Exception for when client configuration data is missing.
 *
 * @package    repository_nextcloud
 * @copyright  2017 Project seminar (Learnweb, University of Münster)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class configuration_exception extends \moodle_exception {

    /**
     * This exception is used when the configuration of the plugin can not be processed or database entries are
     * missing.
     * @param string $hint optional param for additional information of the problem
     * @param string $debuginfo detailed information how to fix problem
     */
    public function __construct($hint = '', $debuginfo = null) {
        parent::__construct('configuration_exception', 'repository_nextcloud', '', $hint, $debuginfo);
    }
}