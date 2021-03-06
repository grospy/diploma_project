<?php
//

/**
 * Serve question type files
 *
 * @since      Moodle 2.0
 * @package    qtype_calculatedmulti
 * @copyright  Dongsheng Cai <dongsheng@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Checks file access for calculated multiple-choice questions.
 *
 * @package  qtype_calculatedmulti
 * @category files
 * @param stdClass $course course object
 * @param stdClass $cm course module object
 * @param stdClass $context context object
 * @param string $filearea file area
 * @param array $args extra arguments
 * @param bool $forcedownload whether or not force download
 * @param array $options additional options affecting the file serving
 * @return bool
 */
function qtype_calculatedmulti_pluginfile($course, $cm, $context, $filearea, $args,
        $forcedownload, array $options=array()) {
    global $DB, $CFG;
    require_once($CFG->libdir . '/questionlib.php');
    question_pluginfile($course, $context, 'qtype_calculatedmulti', $filearea, $args,
            $forcedownload, $options);
}
