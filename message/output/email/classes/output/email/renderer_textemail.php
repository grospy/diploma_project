<?php
//

/**
 * Email digest as text renderer.
 *
 * @package    message_email
 * @copyright  2019 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace message_email\output\email;

defined('MOODLE_INTERNAL') || die();

/**
 * Email digest as text renderer.
 *
 * @package    message_email
 * @copyright  2019 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer_textemail extends \message_email\output\renderer {

    /**
     * The template name for this renderer.
     *
     * @return string
     */
    public function get_template_name() {
        return 'email_digest_text';
    }
}
