<?php
//

/**
 * Renderer for the grade user report
 *
 * @package   gradereport_user
 * @copyright 2010 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Custom renderer for the user grade report
 *
 * To get an instance of this use the following code:
 * $renderer = $PAGE->get_renderer('gradereport_user');
 *
 * @copyright 2010 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class gradereport_user_renderer extends plugin_renderer_base {

    public function graded_users_selector($report, $course, $userid, $groupid, $includeall) {
        global $USER;

        $select = grade_get_graded_users_select($report, $course, $userid, $groupid, $includeall);
        $output = html_writer::tag('div', $this->output->render($select), array('id'=>'graded_users_selector'));
        $output .= html_writer::tag('p', '', array('style'=>'page-break-after: always;'));

        return $output;
    }

    /**
     * Creates and renders the single select box for the user view.
     *
     * @param int $userid The selected userid
     * @param int $userview The current view user setting constant
     * @return string
     */
    public function view_user_selector($userid, $userview) {
        global $PAGE, $USER;
        $url = $PAGE->url;
        if ($userid != $USER->id) {
            $url->param('userid', $userid);
        }

        $options = array(GRADE_REPORT_USER_VIEW_USER => get_string('otheruser', 'gradereport_user'),
                GRADE_REPORT_USER_VIEW_SELF => get_string('myself', 'gradereport_user'));
        $select = new single_select($url, 'userview', $options, $userview, null);

        $select->label = get_string('viewas', 'gradereport_user');

        $output = html_writer::tag('div', $this->output->render($select), array('class' => 'view_users_selector'));

        return $output;
    }

}
