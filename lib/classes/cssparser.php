<?php
//

/**
 * Moodle implementation of CSS parsing.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Moodle CSS parser.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_cssparser extends \Sabberworm\CSS\Parser {

    /**
     * Constructor.
     *
     * @param string $css The CSS content.
     */
    public function __construct($css) {
        $settings = \Sabberworm\CSS\Settings::create();
        $settings->withLenientParsing();
        parent::__construct($css, $settings);
    }

}
