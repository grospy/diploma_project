<?php
//

/**
 * Mustache helper that will add JS to the end of the page.
 *
 * @package    core
 * @category   output
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

/**
 * Store a list of JS calls to insert at the end of the page.
 *
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      2.9
 */
class mustache_javascript_helper {

    /** @var moodle_page $page - Page used to get requirement manager */
    private $page = null;

    /**
     * Create new instance of mustache javascript helper.
     *
     * @param moodle_page $page Page.
     */
    public function __construct($page) {
        $this->page = $page;
    }

    /**
     * Add the block of text to the page requires so it is appended in the footer. The
     * content of the block can contain further mustache tags which will be resolved.
     *
     * @param string $text The script content of the section.
     * @param \Mustache_LambdaHelper $helper Used to render the content of this block.
     */
    public function help($text, \Mustache_LambdaHelper $helper) {
        $this->page->requires->js_amd_inline($helper->render($text));
    }
}
