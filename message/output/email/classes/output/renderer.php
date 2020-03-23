<?php
//

/**
 * Contains renderer class.
 *
 * @package   message_email
 * @copyright 2019 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace message_email\output;

defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;

/**
 * Renderer class.
 *
 * @package    message_email
 * @copyright  2019 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Formats the email used to send the certificate by the email_certificate_task.
     *
     * @param email_digest $emaildigest The certificate to email
     * @return string
     */
    public function render_email_digest(email_digest $emaildigest) {
        $data = $emaildigest->export_for_template($this);
        return $this->render_from_template('message_email/' . $this->get_template_name(), $data);
    }
}
