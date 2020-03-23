<?php
//

/**
 * Embedded answer (Cloze) question importer.
 *
 * @package   qformat_multianswer
 * @copyright 2003 Henrik Kaipe
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Importer that imports a text file containing a single Multianswer question
 * from a text file.
 *
 * @copyright 2003 Henrik Kaipe
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qformat_multianswer extends qformat_default {

    public function provide_import() {
        return true;
    }

    public function readquestions($lines) {
        question_bank::get_qtype('multianswer'); // Ensure the multianswer code is loaded.

        // For this class the method has been simplified as
        // there can never be more than one question for a
        // multianswer import.
        $questions = array();

        $questiontext = array();
        $questiontext['text'] = implode('', $lines);
        $questiontext['format'] = FORMAT_MOODLE;
        $questiontext['itemid'] = '';

        $question = qtype_multianswer_extract_question($questiontext);
        $errors = qtype_multianswer_validate_question($question);
        if ($errors) {
            $this->error(get_string('invalidmultianswerquestion', 'qtype_multianswer', implode(' ', $errors)));
            return array();
        }

        $question->questiontext = $question->questiontext['text'];
        $question->questiontextformat = 0;

        $question->qtype = 'multianswer';
        $question->generalfeedback = '';
        $question->generalfeedbackformat = FORMAT_MOODLE;
        $question->length = 1;
        $question->penalty = 0.3333333;

        if (!empty($question)) {
            $question->name = $this->create_default_question_name($question->questiontext, get_string('questionname', 'question'));
            $questions[] = $question;
        }

        return $questions;
    }
}
