<?php
//

/**
 * Drag-and-drop onto image question definition class.
 *
 * @package    qtype_ddimageortext
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/ddimageortext/questionbase.php');


/**
 * Represents a drag-and-drop onto image question.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_ddimageortext_question extends qtype_ddtoimage_question_base {

}


/**
 * Represents one of the choices (draggable images).
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_ddimageortext_drag_item {
    /** @var int Drag item id */
    public $id;

    /** @var string Text for the drag item */
    public $text;

    /** @var int Number of the item */
    public $no;

    /** @var int Group of the item */
    public $group;

    /** @var bool If the drag item can be used multiple times or not */
    public $infinite;

    /**
     * Drag item object setup.
     *
     * @param string $alttextlabel The alt text of the drag item
     * @param int $no Which number drag item this is
     * @param int $group Group of the drag item
     * @param bool $infinite True if the item can be used an unlimited number of times
     * @param int $id id of the item
     */
    public function __construct($alttextlabel, $no, $group = 1, $infinite = false, $id = 0) {
        $this->id = $id;
        $this->text = $alttextlabel;
        $this->no = $no;
        $this->group = $group;
        $this->infinite = $infinite;
    }

    /**
     * Returns the group of this item.
     *
     * @return int
     */
    public function choice_group() {
        return $this->group;
    }

    /**
     * Creates summary text of for the drag item.
     *
     * @return string
     */
    public function summarise() {
        if (trim($this->text) != '') {
            return get_string('summarisechoice', 'qtype_ddimageortext', $this);
        } else {
            return get_string('summarisechoiceno', 'qtype_ddimageortext', $this->no);
        }
    }
}
/**
 * Represents one of the places (drop zones).
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_ddimageortext_drop_zone {
    /** @var int Number of the item */
    public $no;

    /** @var string Alt text for the drop zone item */
    public $text;

    /** @var int Group of the item */
    public $group;

    /** @var array X and Y location of the drop zone */
    public $xy;

    /**
     * Create a drop zone object.
     *
     * @param string $alttextlabel The alt text of the drop zone
     * @param int $no Which number drop zone this is
     * @param int $group Group of the drop zone
     * @param int $x X location
     * @param int $y Y location
     */
    public function __construct($alttextlabel, $no, $group = 1, $x = '', $y = '') {
        $this->no = $no;
        $this->text = $alttextlabel;
        $this->group = $group;
        $this->xy = array($x, $y);
    }

    /**
     * Creates summary text of for the drop zone
     *
     * @return string
     */
    public function summarise() {
        if (trim($this->text) != '') {
            $summariseplace =
                        get_string('summariseplace', 'qtype_ddimageortext', $this);
        } else {
            $summariseplace =
                    get_string('summariseplaceno', 'qtype_ddimageortext', $this->no);
        }
        return $summariseplace;
    }
}
