<?php
//

/**
 * Mock class for get_content.
 *
 * @package tool_mobile
 * @copyright 2018 Juan Leyva
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_mobile\output;

defined('MOODLE_INTERNAL') || die;

/**
 * Mock class for get_content.
 *
 * @package tool_mobile
 * @copyright 2018 Juan Leyva
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mobile {

    /**
     * Returns a test view.
     * @param  array $args Arguments from tool_mobile_get_content WS
     * @return array       HTML, javascript and otherdata
     */
    public static function test_view($args) {
        $args = (object) $args;

        return array(
            'templates' => array(
                array(
                    'id' => 'main',
                    'html' => 'The HTML code',
                ),
            ),
            'javascript' => 'alert();',
            'otherdata' => array('otherdata1' => $args->param1),
            'restrict' => array('users' => array(1, 2), 'courses' => array(3, 4)),
            'files' => array()
        );
    }

    /**
     * Returns a test view disabled.
     * @param  array $args Arguments from tool_mobile_get_content WS
     * @return array       HTML, javascript and otherdata
     */
    public static function test_view_disabled($args) {
        $args = (object) $args;

        return array(
            'templates' => array(
                array(
                    'id' => 'main',
                    'html' => 'The HTML code',
                ),
            ),
            'javascript' => 'alert();',
            'otherdata' => array('otherdata1' => $args->param1),
            'restrict' => array('users' => array(1, 2), 'courses' => array(3, 4)),
            'files' => array(),
            'disabled' => true,
        );
    }
}
