<?php
//

/**
 * @package    qtype
 * @subpackage shortanswer
 * @copyright  2011 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Short answer question type conversion handler
 */
class moodle1_qtype_shortanswer_handler extends moodle1_qtype_handler {

    /**
     * @return array
     */
    public function get_question_subpaths() {
        return array(
            'ANSWERS/ANSWER',
            'SHORTANSWER',
        );
    }

    /**
     * Appends the shortanswer specific information to the question
     */
    public function process_question(array $data, array $raw) {

        // Convert and write the answers first.
        if (isset($data['answers'])) {
            $this->write_answers($data['answers'], $this->pluginname);
        }

        // Convert and write the shortanswer extra fields.
        foreach ($data['shortanswer'] as $shortanswer) {
            $shortanswer['id'] = $this->converter->get_nextid();
            $this->write_xml('shortanswer', $shortanswer, array('/shortanswer/id'));
        }
    }
}
