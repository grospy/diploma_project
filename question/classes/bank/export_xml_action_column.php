<?php
//

/**
 * Question bank column export the question in Moodle XML format.
 *
 * @package   core_question
 * @copyright 2019 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_question\bank;
defined('MOODLE_INTERNAL') || die();


/**
 * Question bank column export the question in Moodle XML format.
 *
 * @copyright 2019 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class export_xml_action_column extends menu_action_column_base {
    /** @var string avoids repeated calls to get_string('duplicate'). */
    protected $strexportasxml;

    public function init() {
        parent::init();
        $this->strexportasxml = get_string('exportasxml', 'question');
    }

    public function get_name() {
        return 'exportasxmlaction';
    }

    protected function get_url_icon_and_label(\stdClass $question): array {
        if (!question_has_capability_on($question, 'view')) {
            return [null, null, null];
        }

        return [question_get_export_single_question_url($question),
                't/download', $this->strexportasxml];
    }
}
