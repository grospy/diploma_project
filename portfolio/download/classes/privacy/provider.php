<?php
//

/**
 * Privacy class for requesting user data.
 *
 * @package    portfolio_download
 * @copyright  2018 Jake Dallimore <jrhdallimore@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace portfolio_download\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Provider for the portfolio_download plugin.
 *
 * @copyright  2018 Jake Dallimore <jrhdallimore@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
    // This portfolio plugin does not store any data itself.
    // It has no database tables, and it purely acts as a conduit, sending data externally.
    \core_privacy\local\metadata\null_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }
}
