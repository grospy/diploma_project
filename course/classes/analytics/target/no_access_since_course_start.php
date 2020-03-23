<?php
//

/**
 * No accesses since the start of the course.
 *
 * @package   core_course
 * @copyright 2019 David Monllaó {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_course\analytics\target;

defined('MOODLE_INTERNAL') || die();

/**
 * No accesses since the start of the course.
 *
 * @package   core_course
 * @copyright 2019 David Monllaó {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class no_access_since_course_start extends no_recent_accesses {

    /**
     * Only past stuff whose start matches the course start.
     *
     * @param  \core_analytics\local\time_splitting\base $timesplitting
     * @return bool
     */
    public function can_use_timesplitting(\core_analytics\local\time_splitting\base $timesplitting): bool {
        return ($timesplitting instanceof \core_analytics\local\time_splitting\after_start);
    }

    /**
     * Returns the name.
     *
     * If there is a corresponding '_help' string this will be shown as well.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('target:noaccesssincecoursestart', 'course');
    }

    /**
     * Returns the body message for the insight.
     *
     * @param  \context     $context
     * @param  string       $contextname
     * @param  \stdClass    $user
     * @param  \moodle_url  $insighturl
     * @return array                        The plain text message and the HTML message
     */
    public function get_insight_body(\context $context, string $contextname, \stdClass $user, \moodle_url $insighturl): array {
        global $OUTPUT;

        $a = (object)['coursename' => $contextname, 'userfirstname' => $user->firstname];
        $fullmessage = get_string('noaccesssincestartinfomessage', 'course', $a) . PHP_EOL . PHP_EOL . $insighturl->out(false);
        $fullmessagehtml = $OUTPUT->render_from_template('core_analytics/insight_info_message',
            ['url' => $insighturl->out(false), 'insightinfomessage' => get_string('noaccesssincestartinfomessage', 'course', $a)]
        );

        return [$fullmessage, $fullmessagehtml];
    }

}
