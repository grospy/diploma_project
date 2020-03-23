<?php
//

/**
 * Mustache helper that will convert a timestamp to a date string.
 *
 * @package    core
 * @category   output
 * @copyright  2017 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

defined('MOODLE_INTERNAL') || die();

use Mustache_LambdaHelper;

/**
 * Mustache helper that will convert a timestamp to a date string.
 *
 * @copyright  2017 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mustache_user_date_helper {

    /**
     * Read a timestamp and format from the string.
     *
     * {{#userdate}}1487655635, %Y %m %d{{/userdate}}
     *
     * There is a list of formats in lang/en/langconfig.php that can be used as the date format.
     *
     * Both args are required. The timestamp must come first.
     *
     * @param string $args The text to parse for arguments.
     * @param Mustache_LambdaHelper $helper Used to render nested mustache variables.
     * @return string
     */
    public function transform($args, Mustache_LambdaHelper $helper) {
        // Split the text into an array of variables.
        list($timestamp, $format) = explode(',', $args, 2);
        $timestamp = trim($timestamp);
        $format = trim($format);

        $timestamp = $helper->render($timestamp);
        $format = $helper->render($format);

        return userdate($timestamp, $format);
    }
}
