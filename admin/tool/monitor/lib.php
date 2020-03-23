<?php
//

/**
 * This page lists public api for tool_monitor plugin.
 *
 * @package    tool_monitor
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * This function extends the navigation with the tool items
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param stdClass        $course     The course to object for the tool
 * @param context         $context    The context of the course
 */
function tool_monitor_extend_navigation_course($navigation, $course, $context) {
    if (has_capability('tool/monitor:managerules', $context) && get_config('tool_monitor', 'enablemonitor')) {
        $url = new moodle_url('/admin/tool/monitor/managerules.php', array('courseid' => $course->id));
        $settingsnode = navigation_node::create(get_string('managerules', 'tool_monitor'), $url, navigation_node::TYPE_SETTING,
                null, null, new pix_icon('i/settings', ''));
        $reportnode = $navigation->get('coursereports');

        if (isset($settingsnode) && !empty($reportnode)) {
            $reportnode->add_node($settingsnode);
        }
    }
}

/**
 * This function extends the navigation with the tool items
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param stdClass        $course     The course to object for the tool
 * @param context         $context    The context of the course
 */
function tool_monitor_extend_navigation_frontpage($navigation, $course, $context) {

    if (has_capability('tool/monitor:managerules', $context)) {
        $url = new moodle_url('/admin/tool/monitor/managerules.php', array('courseid' => $course->id));
        $settingsnode = navigation_node::create(get_string('managerules', 'tool_monitor'), $url, navigation_node::TYPE_SETTING,
                null, null, new pix_icon('i/settings', ''));
        $reportnode = $navigation->get('frontpagereports');

        if (isset($settingsnode) && !empty($reportnode)) {
            $reportnode->add_node($settingsnode);
        }
    }
}

/**
 * This function extends the navigation with the tool items for user settings node.
 *
 * @param navigation_node $navigation  The navigation node to extend
 * @param stdClass        $user        The user object
 * @param context         $usercontext The context of the user
 * @param stdClass        $course      The course to object for the tool
 * @param context         $coursecontext     The context of the course
 */
function tool_monitor_extend_navigation_user_settings($navigation, $user, $usercontext, $course, $coursecontext) {
    global $USER, $PAGE;

    // Don't bother doing needless calculations unless we are on the relevant pages.
    $onpreferencepage = $PAGE->url->compare(new moodle_url('/user/preferences.php'), URL_MATCH_BASE);
    $onmonitorpage = $PAGE->url->compare(new moodle_url('/admin/tool/monitor/index.php'), URL_MATCH_BASE);
    if (!$onpreferencepage && !$onmonitorpage) {
        return null;
    }

    // Don't show the setting if the event monitor isn't turned on. No access to other peoples subscriptions.
    if (get_config('tool_monitor', 'enablemonitor') && $USER->id == $user->id) {
        // Now let's check to see if the user has any courses / site rules that they can subscribe to.
        // We skip doing a check here if we are on the event monitor page as the check is done internally on that page.
        if ($onmonitorpage || tool_monitor_can_subscribe()) {
            $url = new moodle_url('/admin/tool/monitor/index.php');
            $subsnode = navigation_node::create(get_string('managesubscriptions', 'tool_monitor'), $url,
                    navigation_node::TYPE_SETTING, null, 'monitor', new pix_icon('i/settings', ''));

            if (isset($subsnode) && !empty($navigation)) {
                $navigation->add_node($subsnode);
            }
        }
    }
}

/**
 * Check if the user has the capacity to subscribe to an event monitor anywhere.
 *
 * @return bool True if a capability in a course is found. False otherwise.
 */
function tool_monitor_can_subscribe() {
    if (has_capability('tool/monitor:subscribe', context_system::instance())) {
        return true;
    }
    $courses = get_user_capability_course('tool/monitor:subscribe', null, true, '', '', 1);
    return empty($courses) ? false : true;
}

/**
 * Get a list of courses and also include 'Site' for site wide rules.
 *
 * @return array|bool Returns an array of courses or false if the user has no permission to subscribe to rules.
 */
function tool_monitor_get_user_courses() {
    // Get the course sorting according to the admin settings.
    $sort = enrol_get_courses_sortingsql();

    $options = array();
    if (has_capability('tool/monitor:subscribe', context_system::instance())) {
        $options[0] = get_string('site');
    }

    $fieldlist = array_merge(
            [
                'fullname',
                'visible',
            ],
            array_values(context_helper::get_preload_record_columns('c'))
        );

    $fields = implode(', ', $fieldlist);
    if ($courses = get_user_capability_course('tool/monitor:subscribe', null, true, $fields, $sort)) {
        foreach ($courses as $course) {
            context_helper::preload_from_record($course);
            $coursectx = context_course::instance($course->id);
            if ($course->visible || has_capability('moodle/course:viewhiddencourses', $coursectx)) {
                $options[$course->id] = format_string($course->fullname, true, array('context' => $coursectx));
            }
        }
    }
    // If there are no courses and there is no site permission then return false.
    if (count($options) < 1) {
        return false;
    } else {
        return $options;
    }
}
