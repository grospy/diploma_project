<?php
//

/**
 * Mustache helper render pix icons.
 *
 * @package    core
 * @category   output
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

use Mustache_LambdaHelper;
use renderer_base;

/**
 * This class will call pix_icon with the section content.
 *
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      2.9
 */
class mustache_pix_helper {

    /** @var renderer_base $renderer A reference to the renderer in use */
    private $renderer;

    /**
     * Save a reference to the renderer.
     * @param renderer_base $renderer
     */
    public function __construct(renderer_base $renderer) {
        $this->renderer = $renderer;
    }

    /**
     * Read a pix icon name from a template and get it from pix_icon.
     *
     * {{#pix}}t/edit,component,Anything else is alt text{{/pix}}
     *
     * The args are comma separated and only the first is required.
     *
     * @param string $text The text to parse for arguments.
     * @param Mustache_LambdaHelper $helper Used to render nested mustache variables.
     * @return string
     */
    public function pix($text, Mustache_LambdaHelper $helper) {
        // Split the text into an array of variables.
        $key = strtok($text, ",");
        $key = trim($helper->render($key));
        $component = strtok(",");
        $component = trim($helper->render($component));
        if (!$component) {
            $component = '';
        }
        $component = $helper->render($component);
        $text = strtok("");
        // Allow mustache tags in the last argument.
        $text = trim($helper->render($text));

        return trim($this->renderer->pix_icon($key, $text, $component));
    }
}

