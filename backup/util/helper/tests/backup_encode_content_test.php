<?php
//

/**
 * @package    core_backup
 * @category   phpunit
 * @copyright  2013 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


global $CFG;
require_once($CFG->dirroot . '/backup/util/includes/backup_includes.php');
require_once($CFG->dirroot . '/backup/moodle2/backup_course_task.class.php');



/**
 * Tests for encoding content links in backup_course_task.
 *
 * The code that this tests is actually in backup/moodle2/backup_course_task.class.php,
 * but there is no place for unit tests near there, and perhaps one day it will
 * be refactored so it becomes more generic.
 */
class backup_course_task_testcase extends basic_testcase {

    /**
     * Test the encode_content_links method for course.
     */
    public function test_course_encode_content_links() {
        global $CFG;
        $httpsroot = "https://moodle.org";
        $httproot = "http://moodle.org";
        $oldroot = $CFG->wwwroot;

        // HTTPS root and links of both types in content.
        $CFG->wwwroot = $httpsroot;
        $encoded = backup_course_task::encode_content_links(
                $httproot . '/course/view.php?id=123, ' .
                $httpsroot . '/course/view.php?id=123, ' .
                $httpsroot . '/grade/index.php?id=123, ' .
                $httpsroot . '/grade/report/index.php?id=123, ' .
                $httpsroot . '/badges/view.php?type=2&id=123 and ' .
                $httpsroot . '/user/index.php?id=123.');
        $this->assertEquals('$@COURSEVIEWBYID*123@$, $@COURSEVIEWBYID*123@$, $@GRADEINDEXBYID*123@$, ' .
                '$@GRADEREPORTINDEXBYID*123@$, $@BADGESVIEWBYID*123@$ and $@USERINDEXVIEWBYID*123@$.', $encoded);

        // HTTP root and links of both types in content.
        $CFG->wwwroot = $httproot;
        $encoded = backup_course_task::encode_content_links(
            $httproot . '/course/view.php?id=123, ' .
            $httpsroot . '/course/view.php?id=123, ' .
            $httproot . '/grade/index.php?id=123, ' .
            $httproot . '/grade/report/index.php?id=123, ' .
            $httproot . '/badges/view.php?type=2&id=123 and ' .
            $httproot . '/user/index.php?id=123.');
        $this->assertEquals('$@COURSEVIEWBYID*123@$, $@COURSEVIEWBYID*123@$, $@GRADEINDEXBYID*123@$, ' .
            '$@GRADEREPORTINDEXBYID*123@$, $@BADGESVIEWBYID*123@$ and $@USERINDEXVIEWBYID*123@$.', $encoded);
        $CFG->wwwroot = $oldroot;
    }
}
