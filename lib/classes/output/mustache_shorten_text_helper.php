<?php
//

/**
 * Mustache helper shorten text.
 *
 * @package    core
 * @category   output
 * @copyright  2017 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

defined('MOODLE_INTERNAL') || die();

use Mustache_LambdaHelper;
use renderer_base;

/**
 * This class will call shorten_text with the section content.
 *
 * @copyright  2017 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mustache_shorten_text_helper {

    /**
     * Read a length and text component from the string.
     *
     * {{#shortentext}}50,Some test to shorten{{/shortentext}}
     *
     * Both args are required. The length must come first.
     *
     * @param string $args The text to parse for arguments.
     * @param Mustache_LambdaHelper $helper Used to render nested mustache variables.
     * @return string
     */
    public function shorten($args, Mustache_LambdaHelper $helper) {
        // Split the text into an array of variables.
        list($length, $text) = explode(',', $args, 2);
        $length = trim($length);
        $text = trim($text);

        // Allow mustache tags in the text.
        $text = $helper->render($text);

        return shorten_text($text, $length);
    }
}

