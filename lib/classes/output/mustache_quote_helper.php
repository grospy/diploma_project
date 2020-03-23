<?php
//

/**
 * Wrap content in quotes, and escape all quotes used.
 *
 * @package    core
 * @category   output
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

/**
 * Wrap content in quotes, and escape all quotes used.
 *
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mustache_quote_helper {

    /**
     * Wrap content in quotes, and escape all quotes used.
     *
     * Note: This helper is only compatible with the standard {{ }} delimeters.
     *
     * @param string $text The text to parse for arguments.
     * @param Mustache_LambdaHelper $helper Used to render nested mustache variables.
     * @return string
     */
    public function quote($text, \Mustache_LambdaHelper $helper) {
        // Split the text into an array of variables.
        $content = trim($text);
        $content = $helper->render($content);

        // Escape the {{ and the ".
        $content = str_replace('"', '\\"', $content);
        $content = preg_replace('([{}]{2,3})', '{{=<% %>=}}${0}<%={{ }}=%>', $content);
        return '"' . $content . '"';
    }
}
