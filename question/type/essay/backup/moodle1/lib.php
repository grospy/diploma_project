<?php
//

/**
 * @package    qtype
 * @subpackage essay
 * @copyright  2011 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Short answer question type conversion handler
 */
class moodle1_qtype_essay_handler extends moodle1_qtype_handler {

    /**
     * @return array
     */
    public function get_question_subpaths() {
        return array();
    }

    /**
     * Appends the essay specific information to the question
     */
    public function process_question(array $data, array $raw) {
        // Data added on the upgrade step 2011031000.
        $this->write_xml('essay', array(
            'id'                     => $this->converter->get_nextid(),
            'responseformat'         => 'editor',
            'responserequired'       => 1,
            'responsefieldlines'     => 15,
            'attachments'            => 0,
            'attachmentsrequired'    => 0,
            'graderinfo'             => '',
            'graderinfoformat'       => FORMAT_HTML,
            'responsetemplate'       => '',
            'responsetemplateformat' => FORMAT_HTML
        ), array('/essay/id'));
    }
}
