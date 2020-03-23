<?php
//

/**
 * Matching question renderer class.
 *
 * @package   qtype_randomsamatch
 * @copyright 2013 Jean-Michel Vedrine
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/match/renderer.php');

/**
 * Generates the output for randomsamatch questions.
 *
 * @copyright 2013 Jean-Michel Vedrine
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_randomsamatch_renderer extends qtype_match_renderer {
    public function format_stem_text($qa, $stemid) {
        $question = $qa->get_question();
        return $question->format_text(
                    $question->stems[$stemid], $question->stemformat[$stemid],
                    $qa, 'question', 'questiontext', $stemid);
    }
}
