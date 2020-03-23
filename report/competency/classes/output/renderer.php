<?php
//

/**
 * Renderer class for report_competency
 *
 * @package    report_competency
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace report_competency\output;

defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;
use renderable;

/**
 * Renderer class for competency breakdown report
 *
 * @package    report_competency
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Defer to template.
     *
     * @param report $page
     * @return string html for the page
     */
    public function render_report(report $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('report_competency/report', $data);
    }

    /**
     * Defer to template.
     *
     * @param user_course_navigation $nav
     * @return string
     */
    public function render_user_course_navigation(user_course_navigation $nav) {
        $data = $nav->export_for_template($this);
        return parent::render_from_template('report_competency/user_course_navigation', $data);
    }

    /**
     * Output a nofication.
     *
     * @param string $message the message to print out
     * @return string HTML fragment.
     * @see \core\output\notification
     */
    public function notify_message($message) {
        $n = new \core\output\notification($message, \core\output\notification::NOTIFY_INFO);
        return $this->render($n);
    }

    /**
     * Output an error notification.
     *
     * @param string $message the message to print out
     * @return string HTML fragment.
     * @see \core\output\notification
     */
    public function notify_problem($message) {
        $n = new \core\output\notification($message, \core\output\notification::NOTIFY_ERROR);
        return $this->render($n);
    }

    /**
     * Output a success notification.
     *
     * @param string $message the message to print out
     * @return string HTML fragment.
     * @see \core\output\notification
     */
    public function notify_success($message) {
        $n = new \core\output\notification($message, \core\output\notification::NOTIFY_SUCCESS);
        return $this->render($n);
    }
}
