<?php
//

/**
 * @package    moodlecore
 * @subpackage backup-moodle2
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/backup/moodle2/restore_qtype_extrafields_plugin.class.php');

/**
 * Restore plugin class that provides the necessary information
 * needed to restore one shortanswer qtype plugin
 *
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_qtype_shortanswer_plugin extends restore_qtype_extrafields_plugin {
    /**
     * Process the qtype/shortanswer element
     */
    public function process_shortanswer($data) {
        $this->really_process_extra_question_fields($data);
    }
}
