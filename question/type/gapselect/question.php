<?php
//

/**
 * Select from drop down list question definition class.
 *
 * @package    qtype_gapselect
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/gapselect/questionbase.php');


/**
 * Represents select missing words question.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_gapselect_question extends qtype_gapselect_question_base {
    // Is actually exactly the same.
}


/**
 * Represents one of the choices (select box option).
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_gapselect_choice {
    /** @var string Text for the choice */
    public $text;

    /** @var int Selection group of the choice */
    public $selectgroup;

    /**
     * Creates summary text of for the drag item.
     *
     * @param string $text The text of the choice
     * @param int $selectgroup The select group of the choice
     */
    public function __construct($text, $selectgroup = 1) {
        $this->text = $text;
        $this->selectgroup = $selectgroup;
    }

    /**
     * Returns the group of this item.
     *
     * @return int
     */
    public function choice_group() {
        return $this->selectgroup;
    }
}
