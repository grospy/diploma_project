<?php
//

/**
 * mod_workshop fixtures
 *
 * @package    mod_workshop
 * @category   phpunit
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Test subclass that makes all the protected methods we want to test public.
 */
class testable_workshop extends workshop {

    public function aggregate_submission_grades_process(array $assessments) {
        parent::aggregate_submission_grades_process($assessments);
    }

    public function aggregate_grading_grades_process(array $assessments, $timegraded = null) {
        parent::aggregate_grading_grades_process($assessments, $timegraded);
    }

}
