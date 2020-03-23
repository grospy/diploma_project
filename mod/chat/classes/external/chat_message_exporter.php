<?php
//

/**
 * Class for exporting a chat message.
 *
 * @package    mod_chat
 * @copyright  2017 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_chat\external;
defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Class for exporting a chat message.
 *
 * @copyright  2017 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class chat_message_exporter extends exporter {

    /**
     * Defines exporter properties.
     *
     * @return array
     */
    protected static function define_properties() {
        return array(
            'id' => array(
                'type' => PARAM_INT,
                'description' => 'The message record id.',
            ),
            'chatid' => array(
                'type' => PARAM_INT,
                'description' => 'The chat id.',
                'default' => 0,
            ),
            'userid' => array(
                'type' => PARAM_INT,
                'description' => 'The user who wrote the message.',
                'default' => 0,
            ),
            'groupid' => array(
                'type' => PARAM_INT,
                'description' => 'The group this message belongs to.',
                'default' => 0,
            ),
            'issystem' => array(
                'type' => PARAM_BOOL,
                'description' => 'Whether is a system message or not.',
                'default' => false,
            ),
            'message' => array(
                'type' => PARAM_RAW,
                'description' => 'The message text.',
            ),
            'timestamp' => array(
                'type' => PARAM_INT,
                'description' => 'The message timestamp (indicates when the message was sent).',
                'default' => 0,
            ),
        );
    }

    /**
     * Defines related information.
     *
     * @return array
     */
    protected static function define_related() {
        return array(
            'context' => 'context',
        );
    }

    /**
     * Get the formatting parameters for the name.
     *
     * @return array
     */
    protected function get_format_parameters_for_message() {
        return [
            'component' => 'mod_chat',
        ];
    }
}
