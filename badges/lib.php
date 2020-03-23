<?php
//

/**
 * Defines various library functions.
 *
 * @package   core_badges
 * @copyright 2015 onwards Ankit Agarwal
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Add nodes to myprofile page.
 *
 * @param \core_user\output\myprofile\tree $tree Tree object
 * @param stdClass $user user object
 * @param bool $iscurrentuser
 * @param stdClass $course Course object
 *
 * @return bool
 */
function core_badges_myprofile_navigation(\core_user\output\myprofile\tree $tree, $user, $iscurrentuser, $course) {
    global $CFG, $PAGE, $USER, $SITE;
    require_once($CFG->dirroot . '/badges/renderer.php');
    if (empty($CFG->enablebadges) || (!empty($course) && empty($CFG->badges_allowcoursebadges))) {
        // Y U NO LIKE BADGES ?
        return true;
    }

    // Add category. This node should appear after 'contact' so that administration block appears towards the end. Refer MDL-49928.
    $category = new core_user\output\myprofile\category('badges', get_string('badges', 'badges'), 'contact');
    $tree->add_category($category);
    $context = context_user::instance($user->id);
    $courseid = empty($course) ? 0 : $course->id;

    if ($USER->id == $user->id || has_capability('moodle/badges:viewotherbadges', $context)) {
        $records = badges_get_user_badges($user->id, $courseid, null, null, null, true);
        $renderer = new core_badges_renderer($PAGE, '');

        // Local badges.
        if ($records) {
            $title = get_string('localbadgesp', 'badges', format_string($SITE->fullname));
            $content = $renderer->print_badges_list($records, $user->id, true);
            $localnode = $mybadges = new core_user\output\myprofile\node('badges', 'localbadges', $title, null, null, $content);
            $tree->add_node($localnode);
        }

        // External badges.
        if ($courseid == 0 && !empty($CFG->badges_allowexternalbackpack)) {
            $backpack = get_backpack_settings($user->id);
            if (isset($backpack->totalbadges) && $backpack->totalbadges !== 0) {
                $title = get_string('externalbadgesp', 'badges');
                $content = $renderer->print_badges_list($backpack->badges, $user->id, true, true);
                $externalnode = $mybadges = new core_user\output\myprofile\node('badges', 'externalbadges', $title, null, null,
                    $content);
                $tree->add_node($externalnode);
            }
        }
    }
}
