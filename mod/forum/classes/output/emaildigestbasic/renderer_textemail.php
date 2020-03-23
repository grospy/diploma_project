<?php
//

/**
 * Forum post renderable.
 *
 * @package    mod_forum
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\output\emaildigestbasic;

defined('MOODLE_INTERNAL') || die();

/**
 * Forum post renderable.
 *
 * @since      Moodle 3.0
 * @package    mod_forum
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer_textemail extends \mod_forum\output\email\renderer_textemail {

    /**
     * The template name for this renderer.
     *
     * @return string
     */
    public function forum_post_template() {
        return 'forum_post_emaildigestbasic_textemail';
    }

    /**
     * The plaintext version of the e-mail message.
     *
     * @param \stdClass $cm
     * @param \stdClass $post
     * @return string
     */
    public function format_message_text($cm, $post) {
        $context = \context_module::instance($cm->id);
        $message = file_rewrite_pluginfile_urls(
            $post->message,
            'pluginfile.php',
            $context->id,
            'mod_forum',
            'post',
            $post->id,
            [
                'includetoken' => true,
            ]);
        return format_text_email($message, $post->messageformat);
    }
}
