<?php
//

/**
 * Upgrade library code for the description question type.
 *
 * @package    qtype
 * @subpackage description
 * @copyright  2010 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Class for converting attempt data for description questions when upgrading
 * attempts to the new question engine.
 *
 * This class is used by the code in question/engine/upgrade/upgradelib.php.
 *
 * @copyright  2010 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_description_qe2_attempt_updater extends question_qtype_attempt_updater {
    public function right_answer() {
        return '';
    }

    public function was_answered($state) {
        return false;
    }

    public function response_summary($state) {
        return '';
    }

    public function set_first_step_data_elements($state, &$data) {
    }

    public function supply_missing_first_step_data(&$data) {
    }

    public function set_data_elements_for_step($state, &$data) {
    }
}
