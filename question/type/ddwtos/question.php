<?php
//

/**
 * Drag-and-drop words into sentences question definition class.
 *
 * @package   qtype_ddwtos
 * @copyright 2009 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/gapselect/questionbase.php');


/**
 * Represents a drag-and-drop words into sentences question.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_ddwtos_question extends qtype_gapselect_question_base {

    public function summarise_choice($choice) {
        return $this->html_to_text($choice->text, FORMAT_HTML);
    }
}


/**
 * Represents one of the choices (draggable boxes).
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_ddwtos_choice {
    /** @var string Text for the choice */
    public $text;

    /** @var int Group of the choice */
    public $draggroup;

    /** @var bool If the choice can be used an unlimited number of times */
    public $infinite;

    /**
     * Initialize a choice object.
     *
     * @param string $text The text of the choice
     * @param int $draggroup Group of the drop choice
     * @param bool $infinite True if the item can be used an unlimited number of times
     */
    public function __construct($text, $draggroup = 1, $infinite = false) {
        $this->text = $text;
        $this->draggroup = $draggroup;
        $this->infinite = $infinite;
    }

    /**
     * Returns the group of this item.
     *
     * @return int
     */
    public function choice_group() {
        return $this->draggroup;
    }
}
