<?php
//

/**
 * Serve question type files.
 *
 * @package   qtype_ddmarker
 * @copyright 2012 The Open University
 * @author    Jamie Pratt <me@jamiep.org>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Checks file access for ddmarker questions.
 *
 * @param object $course The course we are in
 * @param object $cm Course module
 * @param object $context The context object
 * @param string $filearea the name of the file area.
 * @param array $args the remaining bits of the file path.
 * @param bool $forcedownload whether the user must be forced to download the file.
 * @param array $options additional options affecting the file serving
 */
function qtype_ddmarker_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options=array()) {
    global $CFG;
    require_once($CFG->libdir . '/questionlib.php');
    question_pluginfile($course, $context, 'qtype_ddmarker', $filearea, $args, $forcedownload, $options);
}

/**
 * Get icon mapping for font-awesome.
 */
function qtype_ddmarker_get_fontawesome_icon_map() {
    return [
        'qtype_ddmarker:crosshairs' => 'fa-crosshairs',
        'qtype_ddmarker:grid' => 'fa-th',
    ];
}
