<?php
//

/**
 * Dropbox Rate Limit Encountered.
 *
 * @since       Moodle 3.2
 * @package     repository_dropbox
 * @copyright   Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace repository_dropbox;

defined('MOODLE_INTERNAL') || die();

/**
 * Dropbox Rate Limit Encountered.
 *
 * @package     repository_dropbox
 * @copyright   Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class rate_limit_exception extends dropbox_exception {
    /**
     * Constructor for rate_limit_exception.
     */
    public function __construct() {
        parent::__construct('Rate limit hit');
    }
}
